@extends('layouts.app')

@section('content')
<div class="challenge-page">
    <!-- Premium Header Section -->
    <section class="header-section">
        <div class="header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-edit"></i>
                    <span>Edit Challenge</span>
                </div>
                <h1 class="header-title">Edit Challenge</h1>
                <p class="header-description">Modify and enhance your coding challenge with professional tools and testing features</p>
            </div>
            <div class="header-actions">
                <a href="{{  url()->previous()  }}" class="btn-secondary-header">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Challenges</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Premium Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-container">
            <form method="POST" action="{{ route('admin.challenges.update', $challenge->id) }}" class="challenge-form">
                @csrf
                @method('PATCH')

                <input type="hidden" name="course_id" value="{{ $challenge->course_id }}">

                <!-- Challenge Status Banner -->
                <div class="challenge-status-banner">
                    <div class="status-icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div class="status-info">
                        <span class="status-label">Currently editing</span>
                        <h3 class="status-title">{{ $challenge->title }}</h3>
                    </div>
                    <div class="status-meta">
                        <div class="meta-item">
                            <i class="fas fa-clock"></i>
                            <span>Last updated: {{ $challenge->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Challenge Information Section -->
                <div class="form-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="section-content-header">
                            <h2 class="section-title">Challenge Information</h2>
                            <div class="section-subtitle">Update the core details of your coding challenge</div>
                        </div>
                    </div>

                    <div class="form-content">
                        <div class="form-group span-full">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading"></i>
                                Challenge Title
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title', $challenge->title) }}" class="form-control" required>
                            <div class="form-hint">Choose a clear, descriptive title that explains what students will learn</div>
                        </div>

                        <div class="form-group span-full">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left"></i>
                                Description
                            </label>
                            <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $challenge->description) }}</textarea>
                        </div>

                        <div class="form-group span-full">
                            <label for="instructions" class="form-label">
                                <i class="fas fa-list-ol"></i>
                                Instructions
                            </label>
                            <textarea name="instructions" id="instructions" class="form-control" rows="4" required>{{ old('instructions', $challenge->instructions) }}</textarea>
                        </div>

                        <div class="form-group span-full">
                            <label for="code_placeholder" class="form-label">
                                <i class="fas fa-code"></i>
                                Code Template
                            </label>
                            <textarea name="code_placeholder" id="code_placeholder" class="form-control code-editor" rows="6" required>{{ old('code_placeholder', $challenge->code_placeholder) }}</textarea>
                            <div class="form-hint">This template helps students get started and provides the function structure</div>
                        </div>

                        <div class="form-group span-full">
                            <label for="expected_output" class="form-label">
                                <i class="fas fa-bullseye"></i>
                                Expected Output Description
                            </label>
                            <textarea name="expected_output" id="expected_output" class="form-control" rows="2" required>{{ old('expected_output', $challenge->expected_output) }}</textarea>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="difficulty" class="form-label">
                                    <i class="fas fa-chart-line"></i>
                                    Difficulty Level
                                </label>
                                <div class="select-wrapper">
                                    <select name="difficulty" id="difficulty" class="form-control">
                                        <option value="easy" {{ $challenge->difficulty === 'easy' ? 'selected' : '' }}>Easy</option>
                                        <option value="medium" {{ $challenge->difficulty === 'medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="hard" {{ $challenge->difficulty === 'hard' ? 'selected' : '' }}>Hard</option>
                                    </select>
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="time_limit" class="form-label">
                                    <i class="fas fa-clock"></i>
                                    Time Limit (seconds)
                                </label>
                                <input type="number" name="time_limit" id="time_limit" value="{{ old('time_limit', $challenge->time_limit ?? 10) }}" class="form-control" min="1" max="20">
                                <div class="form-hint">Maximum 20 seconds for Judge0 free tier</div>
                            </div>

                            <div class="form-group">
                                <label for="test_function_name" class="form-label">
                                    <i class="fas fa-function"></i>
                                    Function Name (optional)
                                </label>
                                <input type="text" name="test_function_name" id="test_function_name" value="{{ old('test_function_name', $challenge->test_function_name) }}" class="form-control" placeholder="e.g., reverseString">
                                <div class="form-hint">Main function name to test (optional)</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Test Cases Section -->
                <div class="form-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-flask"></i>
                        </div>
                        <div class="section-content-header">
                            <h2 class="section-title">Test Cases</h2>
                            <div class="section-subtitle">
                                Manage test cases for this challenge. First 2 test cases will be visible to students, rest will be hidden.
                                <span class="test-count-badge">{{ $challenge->testCases->count() }} test cases</span>
                            </div>
                        </div>
                    </div>

                    <div class="form-content">
                        <div id="testCasesContainer" class="test-cases-container">
                            @foreach($challenge->testCases as $index => $testCase)
                            <div class="test-case-item enhanced" data-index="{{ $index }}">
                                <div class="test-case-header">
                                    <div class="test-case-info">
                                        <div class="test-case-number">{{ $index + 1 }}</div>
                                        <div class="test-case-details">
                                            <h4 class="test-case-title">Test Case {{ $index + 1 }}</h4>
                                            <span class="visibility-badge {{ $testCase->is_hidden ? 'hidden' : 'visible' }}">
                                                <i class="fas fa-{{ $testCase->is_hidden ? 'eye-slash' : 'eye' }}"></i>
                                                {{ $testCase->is_hidden ? 'Hidden' : 'Visible' }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="test-case-actions">
                                        <button type="button" class="btn-remove" onclick="removeTestCase({{ $index }})">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="test-case-content">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-sign-in-alt"></i>
                                                Input
                                            </label>
                                            <input type="text" name="test_cases[{{ $index }}][input]" value="{{ $testCase->input }}" class="form-control" required>
                                            <div class="form-hint">Use quotes for strings, brackets for arrays: [1,2,3]</div>
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label">
                                                <i class="fas fa-sign-out-alt"></i>
                                                Expected Output
                                            </label>
                                            <input type="text" name="test_cases[{{ $index }}][expected_output]" value="{{ $testCase->expected_output }}" class="form-control" required>
                                            <div class="form-hint">The exact expected result</div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="fas fa-comment"></i>
                                            Description (optional)
                                        </label>
                                        <input type="text" name="test_cases[{{ $index }}][description]" value="{{ $testCase->description }}" class="form-control" placeholder="Test case description">
                                    </div>

                                    <input type="hidden" name="test_cases[{{ $index }}][is_hidden]" value="{{ $testCase->is_hidden ? '1' : '0' }}">
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="test-case-actions">
                            <button type="button" class="btn btn-outline" onclick="addTestCase()">
                                <i class="fas fa-plus"></i>
                                Add Test Case
                            </button>
                            <button type="button" class="btn btn-outline" onclick="addSampleTestCases()">
                                <i class="fas fa-magic"></i>
                                Add Sample Test Cases
                            </button>
                        </div>
                    </div>
                </div>

                

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Update Challenge
                    </button>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Test Case Preview Modal -->
<div id="previewModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h3>
                <i class="fas fa-play-circle"></i>
                Test Case Preview
            </h3>
            <button type="button" class="modal-close" onclick="closePreviewModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-code"></i>
                    Test Code
                </label>
                <textarea id="previewCode" class="form-control code-editor" rows="6" placeholder="Enter code to test this specific case..."></textarea>
            </div>
            <div id="previewResults" class="preview-results"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="runPreviewTest()">
                <i class="fas fa-play"></i>
                Run Test
            </button>
            <button type="button" class="btn btn-secondary" onclick="closePreviewModal()">
                <i class="fas fa-times"></i>
                Close
            </button>
        </div>
    </div>
</div>

<style>
/* Ultra-Professional Challenge Edit Form Styling */
:root {
    --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
    --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    --danger-gradient: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
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

/* Challenge Status Banner */
.challenge-status-banner {
    background: var(--accent-color);
    color: white;
    padding: 2rem;
    border-radius: var(--border-radius-large);
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 1.5rem;
    box-shadow: var(--shadow-medium);
    position: relative;
    overflow: hidden;
}

.challenge-status-banner::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.1)"/></svg>') repeat;
    background-size: 30px 30px;
    opacity: 0.1;
}

.status-icon {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    position: relative;
    z-index: 1;
}

.status-info {
    flex: 1;
    position: relative;
    z-index: 1;
}

.status-label {
    font-size: 0.875rem;
    opacity: 0.8;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    display: block;
    margin-bottom: 0.25rem;
}

.status-title {
    margin: 0 0 0.5rem 0;
    font-size: 1.25rem;
    font-weight: 700;
}

.status-meta {
    position: relative;
    z-index: 1;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    opacity: 0.9;
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

.section-content-header {
    flex: 1;
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
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.test-count-badge {
    background: #3b82f6;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.section-actions {
    display: flex;
    gap: 0.75rem;
}

.btn-action {
    background: var(--primary-gradient);
    color: white;
    border: none;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

/* Form Content */
.form-content {
    padding: 2.5rem;
}

.form-group {
    margin-bottom: 2rem;
}

.form-group.span-full {
    grid-column: 1 / -1;
}

.form-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: var(--text-primary);
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
}

.form-label i {
    color: var(--text-light);
    width: 16px;
}

.form-control {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid var(--border-light);
    border-radius: 12px;
    font-size: 1rem;
    transition: all var(--animation-speed) var(--animation-curve);
    background: var(--surface-white);
    color: var(--text-primary);
    font-family: inherit;
}

.form-control:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    transform: translateY(-1px);
}

.form-control.code-editor {
    font-family: 'Fira Code', 'Courier New', monospace;
    background: #1a1a1a;
    color: #e5e5e5;
    border-color: #333;
    line-height: 1.5;
}

.form-control.code-editor:focus {
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

.form-control[type="select"] {
    appearance: none;
    padding-right: 3rem;
    cursor: pointer;
}

.form-hint {
    font-size: 0.75rem;
    color: var(--text-light);
    margin-top: 0.5rem;
}

/* Enhanced Test Cases */
.test-cases-container {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.test-case-item {
    background: var(--surface-light);
    border: 2px solid var(--border-light);
    border-radius: var(--border-radius);
    overflow: hidden;
    transition: all var(--animation-speed) var(--animation-curve);
}

.test-case-item.enhanced:hover {
    border-color: #667eea;
    box-shadow: var(--shadow-medium);
    transform: translateY(-2px);
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
    text-transform: uppercase;
}

.visibility-badge.visible {
    background: rgba(34, 197, 94, 0.2);
    
}

.visibility-badge.hidden {
    background: rgba(251, 191, 36, 0.2);
    
}

.test-case-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-test-preview {
    background: #2563eb;
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-size: 0.8rem;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
}

.btn-test-preview:hover {
    
    transform: translateY(-1px);
    box-shadow: var(--shadow-medium);
}

.btn-remove {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
    border: none;
    padding: 0.5rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
}

.btn-remove:hover {
    background: rgba(239, 68, 68, 0.3);
    transform: scale(1.1);
}

.test-case-content {
    padding: 2rem;
    background: var(--surface-white);
}

/* Quick Test Environment */
.quick-test-container {
    background: var(--surface-light);
    border-radius: var(--border-radius);
    padding: 2rem;
    border: 1px solid var(--border-light);
}

.test-controls {
    display: flex;
    gap: 1rem;
    margin: 1.5rem 0;
}

.test-results-container {
    background: var(--surface-white);
    border: 1px solid var(--border-light);
    border-radius: var(--border-radius);
    padding: 2rem;
    margin-top: 2rem;
}

.results-header {
    margin-bottom: 1.5rem;
}

.results-header h4 {
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-primary);
}

/* Test Case Actions */
.test-case-actions {
    text-align: center;
    margin-top: 2rem;
}

/* Buttons */
.btn {
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
    color: #2563eb;
    border: 2px solid #2563eb;
    margin-right: 1rem;
}

.btn-outline:hover {
    background: #2563eb;
    color: white;
    transform: translateY(-2px);
}

/* Modal Styles */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 1;
    transition: all var(--animation-speed) var(--animation-curve);
}

.modal-content {
    background: var(--surface-white);
    border-radius: var(--border-radius-large);
    width: 90%;
    max-width: 600px;
    max-height: 80vh;
    overflow-y: auto;
    box-shadow: var(--shadow-premium);
    transform: scale(1);
    transition: transform var(--animation-speed) var(--animation-curve);
}

.modal-header {
    padding: 2rem;
    border-bottom: 1px solid var(--border-light);
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
}

.modal-header h3 {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.25rem;
    cursor: pointer;
    color: var(--text-light);
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all var(--animation-speed) var(--animation-curve);
}

.modal-close:hover {
    background: var(--surface-light);
    color: var(--text-primary);
}

.modal-body {
    padding: 2rem;
}

.modal-footer {
    padding: 2rem;
    border-top: 1px solid var(--border-light);
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    background: var(--surface-light);
}

/* Preview Results */
.preview-results {
    margin-top: 1.5rem;
}

.preview-result {
    border-radius: 8px;
    padding: 1.5rem;
    margin-top: 1rem;
}

.preview-result.success {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #166534;
}

.preview-result.error {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #dc2626;
}

.result-details {
    margin-top: 1rem;
}

.result-details code {
    background: rgba(0, 0, 0, 0.1);
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-family: 'Fira Code', monospace;
}

.error-text {
    color: #dc2626;
    font-weight: 500;
}

.quick-test-summary {
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: var(--surface-light);
    border-radius: 12px;
    border: 1px solid var(--border-light);
}

.quick-test-case {
    border-radius: 8px;
    margin-bottom: 0.75rem;
    overflow: hidden;
    border: 1px solid var(--border-light);
}

.quick-test-case.passed {
    border-color: #22c55e;
}

.quick-test-case.failed {
    border-color: #ef4444;
}

.test-case-header-mini {
    padding: 0.75rem 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 500;
    font-size: 0.875rem;
}

.quick-test-case.passed .test-case-header-mini {
    background: #f0fdf4;
    color: #166534;
}

.quick-test-case.failed .test-case-header-mini {
    background: #fef2f2;
    color: #dc2626;
}

.test-case-details-mini {
    padding: 1rem;
    background: white;
    border-top: 1px solid var(--border-light);
    font-size: 0.875rem;
}

.test-case-details-mini p {
    margin: 0.5rem 0;
}

.test-status {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
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
    .form-row {
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

    .form-content {
        padding: 2rem;
    }

    .form-row {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .section-header {
        padding: 1.5rem;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .test-cases-container {
        gap: 1rem;
    }

    .test-case-content {
        padding: 1.5rem;
    }

    .form-actions {
        flex-direction: column;
        padding: 1.5rem;
    }

    .challenge-status-banner {
        flex-direction: column;
        text-align: center;
        padding: 1.5rem;
    }

    .modal-content {
        width: 95%;
        margin: 1rem;
    }

    .test-controls {
        flex-direction: column;
    }

    .quick-test-container {
        padding: 1.5rem;
    }

    .section-subtitle {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}

@media (max-width: 480px) {
    .header-section {
        padding: 2rem 0 1rem;
    }

    .header-container {
        padding: 0 1rem;
    }

    .form-control {
        padding: 0.875rem 1rem;
    }

    .test-case-header {
        padding: 1rem 1.5rem;
    }

    .btn {
        padding: 0.875rem 1.5rem;
        font-size: 0.9rem;
    }

    .modal-header,
    .modal-body,
    .modal-footer {
        padding: 1.5rem;
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
.form-section:nth-child(4) { animation-delay: 0.3s; }

/* Focus States */
.btn:focus,
.btn-action:focus,
.btn-test-preview:focus {
    outline: 3px solid rgba(102, 126, 234, 0.5);
    outline-offset: 2px;
}

/* Loading States */
.loading {
    pointer-events: none;
    opacity: 0.8;
}

.loading i {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Notification Animation */
@keyframes slideInRight {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutRight {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(100%);
        opacity: 0;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let testCaseIndex = {{ $challenge->testCases->count() }}; // Start from existing count

    // Enhanced test case management
    window.addTestCase = function() {
        const container = document.getElementById('testCasesContainer');
        const isHidden = testCaseIndex >= 2; // First 2 are visible, rest are hidden
        
        const testCaseHtml = `
            <div class="test-case-item enhanced" data-index="${testCaseIndex}">
                <div class="test-case-header">
                    <div class="test-case-info">
                        <div class="test-case-number">${testCaseIndex + 1}</div>
                        <div class="test-case-details">
                            <h4 class="test-case-title">Test Case ${testCaseIndex + 1}</h4>
                            <span class="visibility-badge ${isHidden ? 'hidden' : 'visible'}">
                                <i class="fas fa-${isHidden ? 'eye-slash' : 'eye'}"></i>
                                ${isHidden ? 'Hidden' : 'Visible'}
                            </span>
                        </div>
                    </div>
                    <div class="test-case-actions">
                        <button type="button" class="btn-test-preview" onclick="previewTestCase(${testCaseIndex})">
                            <i class="fas fa-play"></i>
                            Test This Case
                        </button>
                        <button type="button" class="btn-remove" onclick="removeTestCase(${testCaseIndex})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>

                <div class="test-case-content">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-sign-in-alt"></i>
                                Input
                            </label>
                            <input type="text" name="test_cases[${testCaseIndex}][input]" class="form-control" placeholder='"example"' required>
                            <div class="form-hint">Use quotes for strings, brackets for arrays</div>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-sign-out-alt"></i>
                                Expected Output
                            </label>
                            <input type="text" name="test_cases[${testCaseIndex}][expected_output]" class="form-control" placeholder='expected_result' required>
                            <div class="form-hint">The exact expected result</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-comment"></i>
                            Description (optional)
                        </label>
                        <input type="text" name="test_cases[${testCaseIndex}][description]" class="form-control" placeholder="Test case description">
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
        updateTestCountBadge();
    };

    // Remove test case with animation
    window.removeTestCase = function(index) {
        const testCase = document.querySelector(`[data-index="${index}"]`);
        if (testCase) {
            testCase.style.transition = 'all 0.3s ease';
            testCase.style.opacity = '0';
            testCase.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                testCase.remove();
                updateTestCountBadge();
            }, 300);
        }
    };

    // Update test count badge
    function updateTestCountBadge() {
        const count = document.querySelectorAll('.test-case-item').length;
        const badge = document.querySelector('.test-count-badge');
        if (badge) {
            badge.textContent = `${count} test cases`;
        }
    }

    // Add sample test cases
    window.addSampleTestCases = function() {
        const samples = [
            { input: '""', output: '', description: 'Empty string edge case' },
            { input: '"a"', output: 'a', description: 'Single character' },
            { input: '"12345"', output: '54321', description: 'Number string' }
        ];
        
        samples.forEach(sample => {
            addTestCase();
            const lastTestCase = document.querySelector(`[data-index="${testCaseIndex - 1}"]`);
            lastTestCase.querySelector('input[name*="[input]"]').value = sample.input;
            lastTestCase.querySelector('input[name*="[expected_output]"]').value = sample.output;
            lastTestCase.querySelector('input[name*="[description]"]').value = sample.description;
        });

        // Show success message
        showNotification('Sample test cases added successfully!', 'success');
    };

    // Preview test case functionality
    window.previewTestCase = function(index) {
        const testCase = document.querySelector(`[data-index="${index}"]`);
        const input = testCase.querySelector('input[name*="[input]"]').value;
        const expectedOutput = testCase.querySelector('input[name*="[expected_output]"]').value;
        
        // Store current test case data for preview
        window.currentPreviewData = { input, expectedOutput, index };
        
        // Show modal
        document.getElementById('previewModal').style.display = 'flex';
        document.getElementById('previewCode').focus();
    };

    // Close preview modal
    window.closePreviewModal = function() {
        const modal = document.getElementById('previewModal');
        modal.style.opacity = '0';
        setTimeout(() => {
            modal.style.display = 'none';
            modal.style.opacity = '1';
        }, 300);
        document.getElementById('previewResults').innerHTML = '';
    };

    // Run preview test
    window.runPreviewTest = function() {
        const code = document.getElementById('previewCode').value;
        const { input, expectedOutput, index } = window.currentPreviewData;
        
        if (!code.trim()) {
            showNotification('Please enter some test code!', 'error');
            return;
        }
        
        // Show loading state
        const resultsDiv = document.getElementById('previewResults');
        resultsDiv.innerHTML = `
            <div class="preview-result">
                <i class="fas fa-spinner fa-spin"></i> Running test case ${index + 1}...
            </div>
        `;
        
        // Send AJAX request to preview endpoint
        fetch(`/admin/challenges/{{ $challenge->id }}/preview`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                code: code,
                test_case_input: input,
                test_case_output: expectedOutput
            })
        })
        .then(response => response.json())
        .then(data => {
            const result = data.test_result;
            
            resultsDiv.innerHTML = `
                <div class="preview-result ${result.passed ? 'success' : 'error'}">
                    <h4><i class="fas fa-${result.passed ? 'check' : 'times'}"></i> ${result.passed ? 'PASSED' : 'FAILED'}</h4>
                    <div class="result-details">
                        <p><strong>Input:</strong> <code>${result.input}</code></p>
                        <p><strong>Expected:</strong> <code>${result.expected}</code></p>
                        <p><strong>Actual:</strong> <code>${result.actual || 'No output'}</code></p>
                        ${result.error ? `<p><strong>Error:</strong> <span class="error-text">${result.error}</span></p>` : ''}
                    </div>
                </div>
            `;
        })
        .catch(error => {
            console.error('Preview error:', error);
            resultsDiv.innerHTML = `
                <div class="preview-result error">
                    <h4><i class="fas fa-exclamation-triangle"></i> Error</h4>
                    <p>Failed to run test case preview.</p>
                </div>
            `;
        });
    };

    // Quick test functionality
    window.runQuickTest = function() {
        const code = document.getElementById('test_code').value;
        if (!code.trim()) {
            showNotification('Please enter some test code!', 'error');
            return;
        }
        
        const testCases = [];
        document.querySelectorAll('.test-case-item').forEach((testCase, index) => {
            const input = testCase.querySelector('input[name*="[input]"]').value;
            const expectedOutput = testCase.querySelector('input[name*="[expected_output]"]').value;
            const description = testCase.querySelector('input[name*="[description]"]').value;
            
            if (input && expectedOutput) {
                testCases.push({ input, expectedOutput, description: description || `Test case ${index + 1}` });
            }
        });
        
        if (testCases.length === 0) {
            showNotification('Please add at least one test case!', 'error');
            return;
        }
        
        // Show results container
        document.getElementById('testResults').style.display = 'block';
        document.getElementById('testResultsContent').innerHTML = '<p><i class="fas fa-spinner fa-spin"></i> Running tests...</p>';
        
        // Run tests for all test cases
        let completedTests = 0;
        const results = [];
        
        testCases.forEach((testCase, index) => {
            fetch(`/admin/challenges/{{ $challenge->id }}/preview`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    code: code,
                    test_case_input: testCase.input,
                    test_case_output: testCase.expectedOutput
                })
            })
            .then(response => response.json())
            .then(data => {
                results[index] = { ...data.test_result, description: testCase.description };
                completedTests++;
                
                if (completedTests === testCases.length) {
                    displayQuickTestResults(results);
                }
            })
            .catch(error => {
                results[index] = { error: 'Failed to run test', description: testCase.description };
                completedTests++;
                
                if (completedTests === testCases.length) {
                    displayQuickTestResults(results);
                }
            });
        });
    };

    // Display quick test results
    function displayQuickTestResults(results) {
        const passedCount = results.filter(r => r.passed).length;
        const totalCount = results.length;
        
        let html = `
            <div class="quick-test-summary">
                <h4>
                    <i class="fas fa-chart-line"></i>
                    Test Results: ${passedCount}/${totalCount} passed
                    ${passedCount === totalCount ? '<i class="fas fa-trophy" style="color: gold;"></i>' : ''}
                </h4>
            </div>
            <div class="quick-test-cases">
        `;
        
        results.forEach((result, index) => {
            html += `
                <div class="quick-test-case ${result.passed ? 'passed' : 'failed'}">
                    <div class="test-case-header-mini">
                        <span><i class="fas fa-${result.passed ? 'check' : 'times'}"></i> ${result.description}</span>
                        <span class="test-status">${result.passed ? 'PASSED' : 'FAILED'}</span>
                    </div>
                    ${!result.passed ? `
                        <div class="test-case-details-mini">
                            <p><strong>Input:</strong> <code>${result.input}</code></p>
                            <p><strong>Expected:</strong> <code>${result.expected}</code></p>
                            <p><strong>Actual:</strong> <code>${result.actual || 'No output'}</code></p>
                            ${result.error ? `<p><strong>Error:</strong> <span class="error-text">${result.error}</span></p>` : ''}
                        </div>
                    ` : ''}
                </div>
            `;
        });
        
        html += '</div>';
        
        document.getElementById('testResultsContent').innerHTML = html;
    }

    // Clear test results
    window.clearTestResults = function() {
        const resultsContainer = document.getElementById('testResults');
        resultsContainer.style.display = 'none';
        document.getElementById('testResultsContent').innerHTML = '';
        showNotification('Test results cleared', 'info');
    };

    // Test all cases with sample code
    window.testAllCases = function() {
        const sampleCode = `// Sample test code
function reverseString(str) {
    return str.split('').reverse().join('');
}`;
        
        document.getElementById('test_code').value = sampleCode;
        runQuickTest();
    };

    // Notification system
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            padding: 1rem 1.5rem;
            border-radius: 8px;
            color: white;
            font-weight: 600;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            animation: slideInRight 0.3s ease;
            max-width: 300px;
        `;
        
        // Set background color based on type
        switch(type) {
            case 'success':
                notification.style.background = '#10b981';
                break;
            case 'error':
                notification.style.background = '#ef4444';
                break;
            case 'warning':
                notification.style.background = '#f59e0b';
                break;
            default:
                notification.style.background = '#3b82f6';
        }
        
        notification.innerHTML = `
            <div style="display: flex; align-items: center; gap: 0.5rem;">
                <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : type === 'warning' ? 'exclamation' : 'info'}-circle"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }

    // Enhanced form validation
    document.querySelector('.challenge-form').addEventListener('submit', function(e) {
        const testCases = document.querySelectorAll('.test-case-item');
        if (testCases.length < 1) {
            e.preventDefault();
            showNotification('Please add at least one test case.', 'error');
            return false;
        }
        
        let isValid = true;
        testCases.forEach((testCase, index) => {
            const input = testCase.querySelector('input[name*="[input]"]').value.trim();
            const output = testCase.querySelector('input[name*="[expected_output]"]').value.trim();
            
            if (!input || !output) {
                isValid = false;
                testCase.style.border = '2px solid #ef4444';
            } else {
                testCase.style.border = '2px solid #e5e7eb';
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            showNotification('Please fill in all test case inputs and expected outputs.', 'error');
            return false;
        }

        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating Challenge...';
        submitBtn.disabled = true;
    });

    // Enhanced form interactions
    document.querySelectorAll('.form-control').forEach(element => {
        element.addEventListener('focus', function() {
            this.closest('.form-group').style.transform = 'scale(1.02)';
        });
        
        element.addEventListener('blur', function() {
            this.closest('.form-group').style.transform = '';
        });
    });

    // Auto-resize textareas
    document.querySelectorAll('textarea').forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });

    // Close modal when clicking outside
    document.addEventListener('click', function(e) {
        const modal = document.getElementById('previewModal');
        if (e.target === modal) {
            closePreviewModal();
        }
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // ESC to close modal
        if (e.key === 'Escape') {
            closePreviewModal();
        }
        
        // Ctrl/Cmd + Enter to run quick test
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter' && e.target.id === 'test_code') {
            e.preventDefault();
            runQuickTest();
        }
        
        // Ctrl/Cmd + Enter to run preview test in modal
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter' && e.target.id === 'previewCode') {
            e.preventDefault();
            runPreviewTest();
        }
    });

    // Initialize test count badge
    updateTestCountBadge();

    // Add tooltips for better UX
    function addTooltips() {
        const tooltipElements = [
            { selector: '.visibility-badge.visible', text: 'Students can see this test case' },
            { selector: '.visibility-badge.hidden', text: 'This test case is hidden from students' },
            { selector: '.btn-test-preview', text: 'Test this specific case with custom code' },
            { selector: '.test-count-badge', text: 'Total number of test cases for this challenge' }
        ];
        
        tooltipElements.forEach(({ selector, text }) => {
            document.querySelectorAll(selector).forEach(element => {
                element.setAttribute('title', text);
            });
        });
    }

    // Initialize tooltips
    addTooltips();

    console.log('🚀 Enhanced Challenge Edit Form loaded successfully!');
    console.log('📋 Available keyboard shortcuts:');
    console.log('   - ESC: Close modal');
    console.log('   - Ctrl+Enter: Run test (in code editors)');
    console.log('💾 Auto-save: Form data is automatically saved every 30 seconds');
});
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection