@extends('layouts.app')

@section('content')
<div class="challenge-page">
    <!-- Premium Header Section -->
    <section class="header-section">
        <div class="header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-plus-circle"></i>
                    <span>New Challenge</span>
                </div>
                <h1 class="header-title">Create New Challenge</h1>
                <p class="header-description">Design an interactive coding challenge to test students' skills and knowledge</p>
            </div>
            <div class="header-actions">
                <a href="{{ url()->previous()}}" class="btn-secondary-header">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Challenges</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Premium Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-container">
            <form method="POST" action="{{ route('instructor.challenges.store') }}" class="challenge-form">
                @csrf

                @if(isset($course))
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <div class="course-banner">
                        <div class="course-icon">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="course-info">
                            <span class="course-label">Adding challenge to</span>
                            <h3 class="course-title">{{ $course->title }}</h3>
                        </div>
                    </div>
                @endif

                <!-- Challenge Information Section -->
                <div class="form-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h2 class="section-title">Challenge Information</h2>
                        <div class="section-subtitle">Define the core details of your coding challenge</div>
                    </div>

                    <div class="form-grid">
                        <div class="form-group span-full">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading"></i>
                                Challenge Title
                            </label>
                            <input type="text" name="title" id="title" class="form-input" required 
                                   placeholder="e.g., Python Array Manipulation Challenge">
                            <div class="form-hint">Choose a clear, descriptive title that explains what students will learn</div>
                        </div>

                        <div class="form-group span-full">
                            <label for="language_name" class="form-label">
                                <i class="fas fa-code"></i>
                                Programming Language
                            </label>
                            <div class="select-wrapper">
                                <select name="language_name" id="language_name" class="form-select" required>
                                    <option value="">Select Programming Language...</option>
                                    <option value="javascript" data-id="63">JavaScript</option>
                                    <option value="python" data-id="71">Python</option>
                                    <option value="java" data-id="62">Java</option>
                                    <option value="cpp" data-id="54">C++</option>
                                    <option value="c" data-id="50">C</option>
                                    <option value="csharp" data-id="51">C#</option>
                                    <option value="php" data-id="68">PHP</option>
                                    <option value="ruby" data-id="72">Ruby</option>
                                    <option value="go" data-id="60">Go</option>
                                    <option value="rust" data-id="73">Rust</option>
                                    <option value="swift" data-id="83">Swift</option>
                                    <option value="kotlin" data-id="78">Kotlin</option>
                                    <option value="sql" data-id="82">SQL</option>
                                    <option value="r" data-id="80">R</option>
                                    <option value="scala" data-id="81">Scala</option>
                                    <option value="haskell" data-id="61">Haskell</option>
                                </select>
                                <i class="fas fa-chevron-down select-arrow"></i>
                            </div>
                            <input type="hidden" name="language_id" id="language_id">
                            <div class="form-hint">Students can only submit solutions in this language</div>
                        </div>

                        <div class="form-group span-full">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left"></i>
                                Description
                            </label>
                            <textarea name="description" id="description" class="form-textarea" rows="3" required 
                                      placeholder="Describe what this challenge is about and what students will learn..."></textarea>
                        </div>

                        <div class="form-group span-full">
                            <label for="instructions" class="form-label">
                                <i class="fas fa-list-ol"></i>
                                Instructions
                            </label>
                            <textarea name="instructions" id="instructions" class="form-textarea" rows="4" required 
                                      placeholder="Provide detailed step-by-step instructions for solving the challenge..."></textarea>
                        </div>

                        <div class="form-group span-full">
                            <label for="code_placeholder" class="form-label">
                                <i class="fas fa-code"></i>
                                Code Template
                            </label>
                            <textarea name="code_placeholder" id="code_placeholder" class="form-textarea code-editor" rows="6" required 
                                      placeholder="Provide starter code template for students..."></textarea>
                            <div class="form-hint">This template helps students get started and provides the function structure</div>
                        </div>

                        <div class="form-group span-full">
                            <label for="expected_output" class="form-label">
                                <i class="fas fa-bullseye"></i>
                                Expected Output Description
                            </label>
                            <textarea name="expected_output" id="expected_output" class="form-textarea" rows="2" required 
                                      placeholder="Describe what the function should return or output..."></textarea>
                        </div>

                        <div class="form-group">
                            <label for="difficulty" class="form-label">
                                <i class="fas fa-chart-line"></i>
                                Difficulty Level
                            </label>
                            <div class="select-wrapper">
                                <select name="difficulty" id="difficulty" class="form-select">
                                    <option value="easy">Easy</option>
                                    <option value="medium" selected>Medium</option>
                                    <option value="hard">Hard</option>
                                </select>
                                <i class="fas fa-chevron-down select-arrow"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time_limit" class="form-label">
                                <i class="fas fa-clock"></i>
                                Time Limit (seconds)
                            </label>
                            <input type="number" name="time_limit" id="time_limit" class="form-input" value="10" min="1" max="20">
                            <div class="form-hint">Maximum 20 seconds for Judge0 free tier</div>
                        </div>

                        <div class="form-group">
                            <label for="test_function_name" class="form-label">
                                <i class="fas fa-function"></i>
                                Function Name
                            </label>
                            <input type="text" name="test_function_name" id="test_function_name" class="form-input" 
                                   placeholder="e.g., solution, reverseString">
                            <div class="form-hint">Main function name to test (optional)</div>
                        </div>
                    </div>
                </div>

                <!-- Test Cases Section -->
                <div class="form-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-flask"></i>
                        </div>
                        <h2 class="section-title">Test Cases</h2>
                        <div class="section-subtitle">Add test cases to validate student solutions. First 2 will be visible to students.</div>
                    </div>

                    <div id="testCasesContainer" class="test-cases-container">
                        <!-- Test Case 1 -->
                        <div class="test-case-card" data-index="0">
                            <div class="test-case-header">
                                <div class="test-case-info">
                                    <div class="test-case-number">1</div>
                                    <div class="test-case-details">
                                        <h4 class="test-case-title">Test Case 1</h4>
                                        <span class="visibility-badge visible">
                                            <i class="fas fa-eye"></i>
                                            Visible to Students
                                        </span>
                                    </div>
                                </div>
                                <button type="button" class="btn-remove" onclick="removeTestCase(0)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>

                            <div class="test-case-content">
                                <div class="test-case-grid">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="fas fa-sign-in-alt"></i>
                                            Input
                                        </label>
                                        <input type="text" name="test_cases[0][input]" class="form-input" placeholder='"hello"' required>
                                        <div class="form-hint">Use quotes for strings, brackets for arrays: [1,2,3]</div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="fas fa-sign-out-alt"></i>
                                            Expected Output
                                        </label>
                                        <input type="text" name="test_cases[0][expected_output]" class="form-input" placeholder='olleh' required>
                                        <div class="form-hint">The exact expected result</div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-comment"></i>
                                        Description (optional)
                                    </label>
                                    <input type="text" name="test_cases[0][description]" class="form-input" placeholder="Basic string reversal test">
                                </div>

                                <input type="hidden" name="test_cases[0][is_hidden]" value="0">
                            </div>
                        </div>

                        <!-- Test Case 2 -->
                        <div class="test-case-card" data-index="1">
                            <div class="test-case-header">
                                <div class="test-case-info">
                                    <div class="test-case-number">2</div>
                                    <div class="test-case-details">
                                        <h4 class="test-case-title">Test Case 2</h4>
                                        <span class="visibility-badge visible">
                                            <i class="fas fa-eye"></i>
                                            Visible to Students
                                        </span>
                                    </div>
                                </div>
                                <button type="button" class="btn-remove" onclick="removeTestCase(1)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>

                            <div class="test-case-content">
                                <div class="test-case-grid">
                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="fas fa-sign-in-alt"></i>
                                            Input
                                        </label>
                                        <input type="text" name="test_cases[1][input]" class="form-input" placeholder='"world"' required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="fas fa-sign-out-alt"></i>
                                            Expected Output
                                        </label>
                                        <input type="text" name="test_cases[1][expected_output]" class="form-input" placeholder='dlrow' required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        <i class="fas fa-comment"></i>
                                        Description (optional)
                                    </label>
                                    <input type="text" name="test_cases[1][description]" class="form-input" placeholder="Another basic test">
                                </div>

                                <input type="hidden" name="test_cases[1][is_hidden]" value="0">
                            </div>
                        </div>
                    </div>

                    <div class="test-case-actions">
                        <button type="button" class="btn-outline" onclick="addTestCase()">
                            <i class="fas fa-plus"></i>
                            <span>Add Test Case</span>
                        </button>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save"></i>
                        <span>Create Challenge</span>
                    </button>
                    <a href="{{ url()->previous() }}" class="btn-secondary">
                        <i class="fas fa-times"></i>
                        <span>Cancel</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Ultra-Professional Challenge Form Styling */
:root {
    --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
    --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    --glass-bg: rgba(255, 255, 255, 0.1);
    --glass-border: rgba(255, 255, 255, 0.2);
    --text-primary: #1a202c;
    --text-secondary: #4a5568;
    --text-light: #718096;
    --surface-white: #ffffff;
    --surface-light: #f7fafc;
    --surface-gray: #edf2f7;
    --border-light: rgba(0, 0, 0, 0.06);
    --shadow-subtle: 0 1px 3px rgba(0, 0, 0, 0.05);
    --shadow-medium: 0 4px 12px rgba(0, 0, 0, 0.15);
    --shadow-large: 0 8px 25px rgba(0, 0, 0, 0.2);
    --shadow-premium: 0 20px 40px rgba(0, 0, 0, 0.1);
    --border-radius: 20px;
    --border-radius-large: 24px;
    --animation-speed: 0.4s;
    --animation-curve: cubic-bezier(0.4, 0, 0.2, 1);
}

body {
    margin: 0;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    line-height: 1.6;
    color: var(--text-primary);
    background: #f8fafc;
}

/* Premium Page Layout */
.challenge-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
    overflow-x: hidden;
}

.challenge-page::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
    z-index: 1;
}

/* Premium Header Section */
.header-section {
    position: relative;
    z-index: 2;
    padding: 4rem 0 2rem;
    color: white;
}

.header-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

.header-content {
    flex: 1;
}

.header-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    backdrop-filter: blur(20px);
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.header-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, #ffffff 0%, #f0f8ff 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.header-description {
    font-size: 1.125rem;
    opacity: 0.9;
    max-width: 500px;
}

.header-actions .btn-secondary-header {
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    backdrop-filter: blur(20px);
    color: white;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all var(--animation-speed) var(--animation-curve);
}

.btn-secondary-header:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
}

/* Content Wrapper */
.content-wrapper {
    position: relative;
    z-index: 2;
    background: var(--surface-light);
    border-radius: 40px 40px 0 0;
    margin-top: -1rem;
    padding: 3rem 0 2rem;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
}

.content-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 2rem;
}

/* Course Banner */
.course-banner {
    background: linear-gradient(135deg, var(--primary-gradient));
    padding: 2rem;
    border-radius: var(--border-radius-large);
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    box-shadow: var(--shadow-medium);
}

.course-icon {
    width: 60px;
    height: 60px;
    color: white;
    background: linear-gradient(135deg, #2563eb, #10b981);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.course-label {
    font-size: 0.875rem;
    opacity: 0.8;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    display: block;
    margin-bottom: 0.25rem;
}

.course-title {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
}

/* Form Sections */
.form-section {
    background: var(--surface-white);
    border-radius: var(--border-radius-large);
    margin-bottom: 2rem;
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    overflow: hidden;
}

.section-header {
    background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
    padding: 2rem 2.5rem;
    border-bottom: 1px solid var(--border-light);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.section-icon {
    width: 48px;
    height: 48px;
    background: var(--primary-gradient);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0 0 0.25rem 0;
    color: var(--text-primary);
}

.section-subtitle {
    font-size: 0.875rem;
    color: var(--text-light);
    margin: 0;
}

/* Form Grid */
.form-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    padding: 2.5rem;
}

.span-full {
    grid-column: 1 / -1;
}

/* Form Elements */
.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: var(--text-primary);
    font-size: 0.875rem;
}

.form-label i {
    color: var(--text-light);
    width: 16px;
}

.form-input,
.form-textarea,
.form-select {
    padding: 1rem 1.25rem;
    border: 2px solid var(--border-light);
    border-radius: 12px;
    font-size: 1rem;
    transition: all var(--animation-speed) var(--animation-curve);
    background: var(--surface-white);
    color: var(--text-primary);
    font-family: inherit;
}

.form-input:focus,
.form-textarea:focus,
.form-select:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
}

.form-textarea {
    resize: vertical;
    min-height: 120px;
    line-height: 1.6;
}

.code-editor {
    font-family: 'Fira Code', 'Courier New', monospace;
    background: #1a1a1a;
    color: #e5e5e5;
    border-color: #333;
}

.code-editor:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
}

/* Select Wrapper */
.select-wrapper {
    position: relative;
}

.select-arrow {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-light);
    pointer-events: none;
    transition: transform var(--animation-speed) var(--animation-curve);
}

.select-wrapper:focus-within .select-arrow {
    transform: translateY(-50%) rotate(180deg);
}

.form-select {
    appearance: none;
    padding-right: 3rem;
    cursor: pointer;
}

.form-hint {
    font-size: 0.75rem;
    color: var(--text-light);
    margin-top: 0.25rem;
}

/* Test Cases */
.test-cases-container {
    padding: 2.5rem;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.test-case-card {
    background: var(--surface-light);
    border: 2px solid var(--border-light);
    border-radius: var(--border-radius);
    overflow: hidden;
    transition: all var(--animation-speed) var(--animation-curve);
}

.test-case-card:hover {
    border-color: #667eea;
    box-shadow: var(--shadow-medium);
}

.test-case-header {
    background: var(--primary-gradient);
    color: white;
    padding: 1.5rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.test-case-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.test-case-number {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.125rem;
}

.test-case-title {
    margin: 0 0 0.25rem 0;
    font-size: 1.125rem;
    font-weight: 600;
}

.visibility-badge {
    font-size: 0.75rem;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.visibility-badge.visible {
    background: rgba(34, 197, 94, 0.2);

}

.visibility-badge.hidden {
    background: rgba(251, 191, 36, 0.2);
    color: #d97706;
}

.btn-remove {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
    border: none;
    padding: 0.75rem;
    border-radius: 50%;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-remove:hover {
    background: rgba(239, 68, 68, 0.3);
    transform: scale(1.1);
}

.test-case-content {
    padding: 2rem;
    background: var(--surface-white);
}

.test-case-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

/* Test Case Actions */
.test-case-actions {
    text-align: center;
    padding: 0 2.5rem 2.5rem;
}

/* Buttons */
.btn-primary,
.btn-secondary,
.btn-outline {
    padding: 1rem 2rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: all var(--animation-speed) var(--animation-curve);
    cursor: pointer;
    border: none;
    position: relative;
    overflow: hidden;
}

.btn-primary {
    background: var(--primary-gradient);
    color: white;
    box-shadow: var(--shadow-medium);
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.btn-primary:hover::before {
    left: 100%;
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-large);
}

.btn-secondary {
    background: var(--surface-gray);
    color: var(--text-secondary);
    border: 2px solid var(--border-light);
}

.btn-secondary:hover {
    background: var(--surface-light);
    transform: translateY(-2px);
}

.btn-outline {
    background: transparent;
    color: #667eea;
    border: 2px solid #667eea;
}

.btn-outline:hover {
    background: #667eea;
    color: white;
    transform: translateY(-2px);
}

/* Form Actions */
.form-actions {
    padding: 2rem 2.5rem;
    background: var(--surface-light);
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    border-top: 1px solid var(--border-light);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .form-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .header-container {
        flex-direction: column;
        text-align: center;
    }

    .content-wrapper {
        border-radius: 20px 20px 0 0;
        padding: 2rem 0 1rem;
    }

    .content-container {
        padding: 0 1rem;
    }

    .form-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
        padding: 2rem;
    }

    .section-header {
        padding: 1.5rem;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .test-case-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .test-cases-container {
        padding: 1.5rem;
    }

    .test-case-content {
        padding: 1.5rem;
    }

    .form-actions {
        flex-direction: column;
        padding: 1.5rem;
    }

    .course-banner {
        flex-direction: column;
        text-align: center;
        padding: 1.5rem;
    }
}

@media (max-width: 480px) {
    .header-section {
        padding: 2rem 0 1rem;
    }

    .header-container {
        padding: 0 1rem;
    }

    .form-input,
    .form-textarea,
    .form-select {
        padding: 0.875rem 1rem;
    }

    .test-case-header {
        padding: 1rem 1.5rem;
    }

    .btn-primary,
    .btn-secondary,
    .btn-outline {
        padding: 0.875rem 1.5rem;
        font-size: 0.9rem;
    }
}

/* Advanced Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-section {
    animation: fadeInUp 0.6s ease forwards;
}

.form-section:nth-child(2) { animation-delay: 0.1s; }
.form-section:nth-child(3) { animation-delay: 0.2s; }

/* Focus States */
.btn-primary:focus,
.btn-secondary:focus,
.btn-outline:focus {
    outline: 3px solid rgba(102, 126, 234, 0.5);
    outline-offset: 2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let testCaseIndex = 2; // Starting from index 2 since we have 0 and 1

    // Language code templates
    function getLanguageTemplate(language) {
        const templates = {
            javascript: `// JavaScript Solution
function solution() {
    // Write your solution here
    // Example: return "Hello World";
}`,
            python: `# Python Solution
def solution():
    # Write your solution here
    # Example: return "Hello World"
    pass`,
            java: `// Java Solution
public static String solution(String input) {
    // Write your solution here
    // Example: return "Hello World";
    return "";
}`,
            cpp: `// C++ Solution
#include <iostream>
#include <string>
using namespace std;

string solution() {
    // Write your solution here
    // Example: return "Hello World";
    return "";
}`,
            c: `// C Solution
#include <stdio.h>
#include <string.h>

int solution() {
    // Write your solution here
    // Example: return 42;
    return 0;
}`,
            php: `<` + `?php
// PHP Solution
function solve() {
    // Write your solution here
    // Example: return "Hello World";
}
?` + `>`,
            ruby: `# Ruby Solution
def solution
    # Write your solution here
    # Example: "Hello World"
end`,
            go: `// Go Solution
package main

func solution() string {
    // Write your solution here
    // Example: return "Hello World"
    return ""
}`,
            csharp: `// C# Solution
using System;

public class Solution {
    public static string solution(string input) {
        // Write your solution here
        // Example: return "Hello World";
        return "";
    }
}`,
            rust: `// Rust Solution
fn solution() -> String {
    // Write your solution here
    // Example: "Hello World".to_string()
    String::new()
}`,
            kotlin: `// Kotlin Solution
fun solution(): String {
    // Write your solution here
    // Example: return "Hello World"
    return ""
}`,
            swift: `// Swift Solution
func solution() -> String {
    // Write your solution here
    // Example: return "Hello World"
    return ""
}`,
            scala: `// Scala Solution
object Solution {
    def solution(): String = {
        // Write your solution here
        // Example: "Hello World"
        ""
    }
}`,
            haskell: `-- Haskell Solution
solution :: String -> String
solution input = 
    -- Write your solution here
    -- Example: "Hello World"
    ""`,
            r: `# R Solution
solution <- function() {
    # Write your solution here
    # Example: return("Hello World")
    return("")
}`,
            sql: `-- SQL Solution
-- Write your SQL query here
-- Example: SELECT 'Hello World' as result;
SELECT * FROM table_name;`
        };
        
        return templates[language] || `// ${language.charAt(0).toUpperCase() + language.slice(1)} Solution
// Write your solution here`;
    }

    // Handle language selection
    document.getElementById('language_name').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const languageId = selectedOption.getAttribute('data-id');
        const languageName = selectedOption.value;
        
        // Set the language ID
        document.getElementById('language_id').value = languageId;
        
        // Update code placeholder with language-specific template
        if (languageName) {
            document.getElementById('code_placeholder').value = getLanguageTemplate(languageName);
        }
        
        // Update function name placeholder based on language
        const functionNameField = document.getElementById('test_function_name');
        if (languageName === 'python') {
            functionNameField.placeholder = 'e.g., solution, reverse_string';
        } else if (languageName === 'java' || languageName === 'csharp') {
            functionNameField.placeholder = 'e.g., solution, reverseString';
        } else {
            functionNameField.placeholder = 'e.g., solution, reverseString';
        }

        // Add visual feedback
        this.style.borderColor = '#10b981';
        setTimeout(() => {
            this.style.borderColor = '';
        }, 1000);
    });

    // Add test case function
    window.addTestCase = function() {
        const container = document.getElementById('testCasesContainer');
        const isHidden = testCaseIndex >= 2; // First 2 are visible, rest are hidden
        
        const testCaseHtml = `
            <div class="test-case-card" data-index="${testCaseIndex}">
                <div class="test-case-header">
                    <div class="test-case-info">
                        <div class="test-case-number">${testCaseIndex + 1}</div>
                        <div class="test-case-details">
                            <h4 class="test-case-title">Test Case ${testCaseIndex + 1}</h4>
                            <span class="visibility-badge ${isHidden ? 'hidden' : 'visible'}">
                                <i class="fas fa-${isHidden ? 'eye-slash' : 'eye'}"></i>
                                ${isHidden ? 'Hidden from Students' : 'Visible to Students'}
                            </span>
                        </div>
                    </div>
                    <button type="button" class="btn-remove" onclick="removeTestCase(${testCaseIndex})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>

                <div class="test-case-content">
                    <div class="test-case-grid">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-sign-in-alt"></i>
                                Input
                            </label>
                            <input type="text" name="test_cases[${testCaseIndex}][input]" class="form-input" placeholder='"example"' required>
                            <div class="form-hint">Use quotes for strings, brackets for arrays</div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-sign-out-alt"></i>
                                Expected Output
                            </label>
                            <input type="text" name="test_cases[${testCaseIndex}][expected_output]" class="form-input" placeholder='expected_result' required>
                            <div class="form-hint">The exact expected result</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-comment"></i>
                            Description (optional)
                        </label>
                        <input type="text" name="test_cases[${testCaseIndex}][description]" class="form-input" placeholder="Test case description">
                    </div>

                    <input type="hidden" name="test_cases[${testCaseIndex}][is_hidden]" value="${isHidden ? '1' : '0'}">
                </div>
            </div>
        `;
        
        container.insertAdjacentHTML('beforeend', testCaseHtml);
        
        // Animate the new test case
        const newTestCase = container.lastElementChild;
        newTestCase.style.opacity = '0';
        newTestCase.style.transform = 'translateY(20px)';
        requestAnimationFrame(() => {
            newTestCase.style.transition = 'all 0.4s ease';
            newTestCase.style.opacity = '1';
            newTestCase.style.transform = 'translateY(0)';
        });
        
        testCaseIndex++;
    };

    // Remove test case function
    window.removeTestCase = function(index) {
        const testCase = document.querySelector(`[data-index="${index}"]`);
        if (testCase) {
            testCase.style.transition = 'all 0.3s ease';
            testCase.style.opacity = '0';
            testCase.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                testCase.remove();
            }, 300);
        }
    };

    // Form validation with enhanced UX
    document.querySelector('.challenge-form').addEventListener('submit', function(e) {
        const languageSelect = document.getElementById('language_name');
        if (!languageSelect.value) {
            e.preventDefault();
            
            // Enhanced error display
            languageSelect.style.borderColor = '#ef4444';
            languageSelect.focus();
            
            // Create error message
            const errorMsg = document.createElement('div');
            errorMsg.className = 'error-message';
            errorMsg.style.cssText = `
                background: #fef2f2;
                color: #dc2626;
                padding: 1rem;
                border-radius: 8px;
                border: 1px solid #fecaca;
                margin-top: 1rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                animation: shake 0.5s ease-in-out;
            `;
            errorMsg.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Please select a programming language for this challenge.';
            
            languageSelect.parentNode.appendChild(errorMsg);
            
            setTimeout(() => {
                languageSelect.style.borderColor = '';
                errorMsg.remove();
            }, 3000);
            
            return false;
        }

        const testCases = document.querySelectorAll('.test-case-card');
        if (testCases.length < 1) {
            e.preventDefault();
            
            const container = document.getElementById('testCasesContainer');
            const errorMsg = document.createElement('div');
            errorMsg.className = 'error-message';
            errorMsg.style.cssText = `
                background: #fef2f2;
                color: #dc2626;
                padding: 1rem;
                border-radius: 8px;
                border: 1px solid #fecaca;
                margin-bottom: 1rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
            `;
            errorMsg.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Please add at least one test case.';
            
            container.insertBefore(errorMsg, container.firstChild);
            
            setTimeout(() => {
                errorMsg.remove();
            }, 3000);
            
            return false;
        }
        
        // Validate that all test cases have input and expected output
        let isValid = true;
        testCases.forEach((testCase, index) => {
            const input = testCase.querySelector('input[name*="[input]"]').value.trim();
            const output = testCase.querySelector('input[name*="[expected_output]"]').value.trim();
            
            if (!input || !output) {
                isValid = false;
                testCase.style.borderColor = '#ef4444';
                testCase.scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else {
                testCase.style.borderColor = '';
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            
            // Show global error message
            const form = this;
            const errorMsg = document.createElement('div');
            errorMsg.className = 'error-message';
            errorMsg.style.cssText = `
                background: #fef2f2;
                color: #dc2626;
                padding: 1rem;
                border-radius: 8px;
                border: 1px solid #fecaca;
                margin-bottom: 1rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 1000;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            `;
            errorMsg.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Please fill in all test case inputs and expected outputs.';
            
            document.body.appendChild(errorMsg);
            
            setTimeout(() => {
                errorMsg.remove();
            }, 4000);
            
            return false;
        }

        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Creating Challenge...</span>';
        submitBtn.disabled = true;
    });

    // Enhanced form interactions
    document.querySelectorAll('.form-input, .form-textarea, .form-select').forEach(element => {
        element.addEventListener('focus', function() {
            this.parentNode.style.transform = 'scale(1.02)';
        });
        
        element.addEventListener('blur', function() {
            this.parentNode.style.transform = '';
        });
    });

    // Auto-resize textareas
    document.querySelectorAll('.form-textarea').forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });

    console.log('🚀 Professional Challenge Creation Form initialized!');
});

// Add shake animation for errors
const style = document.createElement('style');
style.textContent = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
`;
document.head.appendChild(style);
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection