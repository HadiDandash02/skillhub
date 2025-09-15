<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class Judge0Service
{
    protected $baseUrl;
    protected $headers;
    protected $supportedLanguages;

    public function __construct()
    {
        $this->baseUrl = 'https://judge0-ce.p.rapidapi.com';
        $this->headers = [
            'X-RapidAPI-Key' => env('JUDGE0_API_KEY'),
            'X-RapidAPI-Host' => 'judge0-ce.p.rapidapi.com',
            'Content-Type' => 'application/json',
        ];

        $this->initializeSupportedLanguages();
    }

    /**
     * Main execute method that your controller calls
     */
    public function execute($code, $testCases, $languageId, $functionName = null, $timeLimit = 5)
    {
        $results = [
            'success' => false,
            'test_results' => [],
            'error_message' => null,
            'total_execution_time' => 0
        ];

        try {
            $allTestsPassed = true;
            $totalExecutionTime = 0;

            foreach ($testCases as $index => $testCase) {
                $testResult = $this->executeTestCase($code, $testCase, $languageId, $functionName, $timeLimit);
                
                $results['test_results'][] = [
                    'test_case_id' => $testCase->id ?? $index,
                    'input' => $testCase->input,
                    'expected' => $testCase->expected_output,
                    'actual' => $testResult['output'],
                    'passed' => $testResult['passed'],
                    'execution_time' => $testResult['execution_time'],
                    'memory_used' => $testResult['memory_used'],
                    'error' => $testResult['error'],
                    'description' => $testCase->description ?? "Test case " . ($index + 1)
                ];

                if (!$testResult['passed']) {
                    $allTestsPassed = false;
                }

                if ($testResult['error'] && !$results['error_message']) {
                    $results['error_message'] = $testResult['error'];
                }

                $totalExecutionTime += $testResult['execution_time'];
            }

            $results['success'] = $allTestsPassed;
            $results['total_execution_time'] = $totalExecutionTime;

        } catch (Exception $e) {
            Log::error("Judge0 execution failed: " . $e->getMessage());
            $results['error_message'] = $e->getMessage();
        }

        return $results;
    }

    /**
     * Execute a single test case
     */
    private function executeTestCase($code, $testCase, $languageId, $functionName, $timeLimit)
    {
        $result = [
            'output' => null,
            'passed' => false,
            'execution_time' => 0,
            'memory_used' => 0,
            'error' => null
        ];

        try {
            // Wrap user code with test execution logic
            $wrappedCode = $this->wrapCodeForExecution($code, $testCase, $languageId, $functionName);
            
            // Submit to Judge0
            $submissionResult = $this->submitCode($wrappedCode, $languageId, $testCase->input ?? '', $timeLimit);
            
            // Parse results
            $result['execution_time'] = $submissionResult['time'] ?? 0;
            $result['memory_used'] = ($submissionResult['memory'] ?? 0) / 1024; // Convert to MB
            
            if ($submissionResult['status']['id'] == 3) { // Accepted
                $result['output'] = trim($submissionResult['stdout'] ?? '');
                $result['passed'] = $this->compareOutputs($result['output'], $testCase->expected_output);
            } else {
                // Handle different error statuses
                $result['error'] = $this->getErrorMessage($submissionResult['status'], $submissionResult);
                $result['output'] = trim($submissionResult['stdout'] ?? '') ?: trim($submissionResult['stderr'] ?? '');
            }

        } catch (Exception $e) {
            $result['error'] = $e->getMessage();
        }

        return $result;
    }

    /**
     * Submit code to Judge0 API
     */
    public function submitCode($sourceCode, $languageId, $stdin = '', $timeLimit = 5)
    {
        // Judge0 CE free tier limits: cpu_time_limit <= 20s, wall_time_limit <= 30s
        $cpuTimeLimit = min($timeLimit, 20.0);
        $wallTimeLimit = min($timeLimit + 2, 30.0);
        
        $response = Http::withHeaders($this->headers)
            ->withoutVerifying()
            ->post($this->baseUrl . '/submissions?base64_encoded=false&wait=true', [
                'source_code' => $sourceCode,
                'language_id' => $languageId,
                'stdin' => $stdin,
                'cpu_time_limit' => $cpuTimeLimit,
                'memory_limit' => 128000, // 128MB (this should be fine)
                'wall_time_limit' => $wallTimeLimit
            ]);

        if (!$response->successful()) {
            throw new Exception('Judge0 API request failed: ' . $response->body());
        }

        return $response->json();
    }

    /**
     * Wrap user code with test execution logic based on language
     */
    private function wrapCodeForExecution($code, $testCase, $languageId, $functionName)
    {
        switch ($languageId) {
            case 63: // JavaScript (Node.js)
                return $this->wrapJavaScriptCode($code, $testCase->input, $functionName);
            case 71: // Python
                return $this->wrapPythonCode($code, $testCase->input, $functionName);
            case 62: // Java
                return $this->wrapJavaCode($code, $testCase->input, $functionName);
            case 54: // C++
                return $this->wrapCppCode($code, $testCase->input, $functionName);
            case 50: // C
                return $this->wrapCCode($code, $testCase->input, $functionName);
            case 68: // PHP
                return $this->wrapPhpCode($code, $testCase->input, $functionName);
            case 72: // Ruby
                return $this->wrapRubyCode($code, $testCase->input, $functionName);
            case 60: // Go
                return $this->wrapGoCode($code, $testCase->input, $functionName);
            default:
                return $code; // For languages that don't need wrapping
        }
    }
private function wrapJavaScriptCode($code, $input, $functionName)
{
    $functionName = $functionName ?: 'solution';
    $inputValue = $this->parseInputValue($input);

    // Use the function name provided by the challenge
    $codeWithGlobal = "(function() {\n{$code}\n\nglobal.{$functionName} = {$functionName};\n})();";

    return "{$codeWithGlobal}

try {
    const input = {$inputValue};
    let result;

    if (Array.isArray(input) && input.length > 1) {
        result = {$functionName}(...input);
    } else if (Array.isArray(input) && input.length === 1) {
        result = {$functionName}(input[0]);
    } else {
        result = {$functionName}(input);
    }

    console.log(result);
} catch (error) {
    console.error('Error: ' + error.message);
}";
}

    private function wrapPythonCode($code, $input, $functionName)
    {
        $functionName = $functionName ?: 'solution';
        $inputValue = $this->parseInputValue($input);
        
        return "{$code}

try:
    input_data = {$inputValue}
    
    if isinstance(input_data, list) and len(input_data) > 1:
        result = {$functionName}(input_data)
    elif isinstance(input_data, list) and len(input_data) == 1:
        result = {$functionName}(input_data[0])
    else:
        result = {$functionName}(input_data)
    
    print(result)
except Exception as e:
    print(f'Error: {e}')";
    }

    private function wrapJavaCode($code, $input, $functionName)
    {
        // For Java, let's use a simpler approach
        return "import java.util.*;

public class Main {
    {$code}
    
    public static void main(String[] args) {
        try {
            // Hardcoded for findMax method with array input
            String input = \"{$input}\";
            if (input.startsWith(\"[\") && input.endsWith(\"]\")) {
                // Parse array: [1,3,5,2] -> int[]
                input = input.substring(1, input.length() - 1);
                String[] parts = input.split(\",\");
                int[] numbers = new int[parts.length];
                for (int i = 0; i < parts.length; i++) {
                    numbers[i] = Integer.parseInt(parts[i].trim());
                }
                System.out.println(findMax(numbers));
            }
        } catch (Exception e) {
            System.err.println(\"Error: \" + e.getMessage());
        }
    }
}";
    }

    private function wrapCppCode($code, $input, $functionName)
    {
        return "#include <iostream>
#include <string>
#include <vector>
using namespace std;

{$code}

int main() {
    try {
        auto result = solution();
        cout << result << endl;
    } catch (const exception& e) {
        cerr << \"Error: \" << e.what() << endl;
        return 1;
    }
    return 0;
}";
    }

    private function wrapCCode($code, $input, $functionName)
    {
        return "#include <stdio.h>
#include <stdlib.h>
#include <string.h>

{$code}

int main() {
    int result = solution();
    printf(\"%d\\n\", result);
    return 0;
}";
    }

    private function wrapPhpCode($code, $input, $functionName)
    {
        $functionName = $functionName ?: 'solution';
        
        return "<?php
{$code}

try {
    \$result = {$functionName}();
    echo \$result;
} catch (Exception \$e) {
    echo 'Error: ' . \$e->getMessage();
}
?>";
    }

    private function wrapRubyCode($code, $input, $functionName)
    {
        $functionName = $functionName ?: 'solution';
        
        return "{$code}

begin
    result = {$functionName}()
    puts result
rescue => e
    puts \"Error: #{e.message}\"
end";
    }

    private function wrapGoCode($code, $input, $functionName)
    {
        return "package main

import \"fmt\"

{$code}

func main() {
    defer func() {
        if r := recover(); r != nil {
            fmt.Printf(\"Error: %v\\n\", r)
        }
    }()
    
    result := solution()
    fmt.Println(result)
}";
    }

    /**
     * Parse input value for code wrapping
     */
    private function parseInputValue($input)
{
    $input = trim($input);

    // If already JSON-like, don't change it
    if (preg_match('/^[\[\{]/', $input)) {
        return $input;
    }

    // If it's a list of numbers separated by commas (e.g., "1, 2, 3")
    if (preg_match('/^\s*-?\d+(\s*,\s*-?\d+)*\s*$/', $input)) {
        return '[' . $input . ']';
    }

    // Quoted string
    if (preg_match('/^["\']/', $input)) {
        return $input;
    }

    // Numeric
    if (is_numeric($input)) {
        return $input;
    }

    // Default to string
    return '"' . $input . '"';
}


    /**
     * Compare outputs
     */
    private function compareOutputs($actual, $expected)
    {
        // Normalize both outputs
        $actualNormalized = trim(preg_replace('/\s+/', ' ', $actual));
        $expectedNormalized = trim(preg_replace('/\s+/', ' ', $expected));
        
        return $actualNormalized === $expectedNormalized;
    }

    /**
     * Get error message based on Judge0 status
     */
    private function getErrorMessage($status, $data)
    {
        $statusMessages = [
            4 => 'Wrong Answer',
            5 => 'Time Limit Exceeded',
            6 => 'Compilation Error: ' . ($data['compile_output'] ?? ''),
            7 => 'Runtime Error (SIGSEGV)',
            8 => 'Runtime Error (SIGXFSZ)',
            9 => 'Runtime Error (SIGFPE)',
            10 => 'Runtime Error (SIGABRT)',
            11 => 'Runtime Error (NZEC)',
            12 => 'Runtime Error (Other)',
            13 => 'Internal Error',
            14 => 'Exec Format Error'
        ];

        return $statusMessages[$status['id']] ?? 'Unknown Error: ' . $status['description'];
    }

    /**
     * Initialize supported languages
     */
    private function initializeSupportedLanguages()
    {
        $this->supportedLanguages = [
            'javascript' => 63,
            'python' => 71,
            'java' => 62,
            'cpp' => 54,
            'c' => 50,
            'csharp' => 51,
            'php' => 68,
            'ruby' => 72,
            'go' => 60,
            'rust' => 73,
            'swift' => 83,
            'kotlin' => 78,
            'sql' => 82,
            'bash' => 46,
            'perl' => 85,
            'r' => 80,
            'typescript' => 74,
            'scala' => 81,
            'haskell' => 61,
        ];
    }

    /**
     * Get language ID by name
     */
    public function getLanguageId($languageName)
    {
        return $this->supportedLanguages[$languageName] ?? null;
    }

    /**
     * Get all supported languages
     */
    public function getSupportedLanguages()
    {
        return $this->supportedLanguages;
    }

    /**
     * Check if language is supported
     */
    public function isLanguageSupported($languageName)
    {
        return isset($this->supportedLanguages[$languageName]);
    }

    /**
     * Get Judge0 API languages (for reference)
     */
    public function getLanguages()
    {
        $response = Http::withHeaders($this->headers)
            ->withoutVerifying()
            ->get($this->baseUrl . '/languages');
        return $response->json();
    }
}