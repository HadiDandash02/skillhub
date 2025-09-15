@extends('layouts.app')

@section('content')
<div class="advice-page">
    <!-- Professional Header Section -->
    <section class="header-section">
        <div class="header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-lightbulb"></i>
                    <span>New Advice</span>
                </div>
                <h1 class="header-title">Create Career Advice</h1>
                <p class="header-description">Share valuable insights to guide professional growth</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('careerM.career-advice') }}" class="btn-secondary-header">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Advice</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-container">
            <form method="POST" action="{{ route('careerM.career-advice.store') }}" class="create-advice-form">
                @csrf

                <!-- Basic Information Card -->
                <div class="card form-card">
                    <div class="card-header">
                        <div class="section-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <h2 class="card-title">Advice Details</h2>
                        <button type="button" class="btn-hints" onclick="toggleWritingTips()">
                            <i class="fas fa-lightbulb"></i>
                            <span>Writing Tips</span>
                        </button>
                    </div>
                    <div class="card-body">
                        <!-- Title -->
                        <div class="form-group">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading"></i>
                                Title<span class="required">*</span>
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" 
                                   class="form-control @error('title') is-invalid @enderror" required placeholder="Enter advice title">
                            @error('title')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="form-group">
                            <label for="category" class="form-label">
                                <i class="fas fa-tags"></i>
                                Category<span class="required">*</span>
                            </label>
                            <input type="text" name="category" id="category" 
                                   value="{{ old('category') }}" class="form-control @error('category') is-invalid @enderror" 
                                   required placeholder="e.g. Interview Tips, Resume Writing, Career Development">
                            @error('category')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Company -->
                        <div class="form-group">
                            <label for="company" class="form-label">
                                <i class="fas fa-building"></i>
                                Company<span class="required">*</span>
                            </label>
                            <div class="company-field-wrapper">
                                <input type="text" name="company" id="company"
                                       value="{{ old('company', $companyName ?? '') }}"
                                       class="form-control @if(!empty($companyName)) company-readonly @endif @error('company') is-invalid @enderror"
                                       required placeholder="Company name"
                                       @if(!empty($companyName)) readonly @endif>
                                @if(!empty($companyName))
                                    <div class="readonly-overlay">
                                        <i class="fas fa-lock"></i>
                                        <span>Read Only</span>
                                    </div>
                                @endif
                            </div>
                            @if(!empty($companyName))
                            @endif
                            @error('company')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="form-group">
                            <label for="content" class="form-label">
                                <i class="fas fa-align-left"></i>
                                Content<span class="required">*</span>
                            </label>
                            <textarea name="content" id="content" class="form-control @error('content') is-invalid @enderror" 
                                      rows="10" required placeholder="Write your career advice content here... Share practical tips, insights, and actionable guidance that will help professionals advance in their careers.">{{ old('content') }}</textarea>
                            @error('content')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                            <div class="form-help">
                                <i class="fas fa-info-circle"></i>
                                <span>Provide detailed, actionable advice that will genuinely help career development</span>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="submit-group">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-plus"></i> Create Career Advice
                        </button>
                        <a href="{{ route('careerM.career-advice') }}" class="btn-cancel">Cancel</a>
                    </div>
                </div>
            </form>

            <!-- Writing Tips Popup -->
            <div id="writing-tips-popup" class="tips-popup" style="display: none;">
                <div class="tips-popup-content">
                    <div class="tips-popup-header">
                        <h3 class="tips-popup-title">
                            <i class="fas fa-star"></i>
                            Writing Tips
                        </h3>
                        <button type="button" class="btn-close-tips" onclick="toggleWritingTips()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="tips-popup-body">
                        <div class="tips-grid">
                            <div class="tip-item">
                                <div class="tip-icon">
                                    <i class="fas fa-bullseye"></i>
                                </div>
                                <div class="tip-content">
                                    <h4 class="tip-title">Be Specific</h4>
                                    <p class="tip-description">Provide concrete examples and actionable steps rather than generic advice</p>
                                </div>
                            </div>

                            <div class="tip-item">
                                <div class="tip-icon">
                                    <i class="fas fa-user-check"></i>
                                </div>
                                <div class="tip-content">
                                    <h4 class="tip-title">Know Your Audience</h4>
                                    <p class="tip-description">Consider the experience level and career stage of your readers</p>
                                </div>
                            </div>

                            <div class="tip-item">
                                <div class="tip-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="tip-content">
                                    <h4 class="tip-title">Focus on Growth</h4>
                                    <p class="tip-description">Emphasize strategies that lead to long-term career development</p>
                                </div>
                            </div>

                            <div class="tip-item">
                                <div class="tip-icon">
                                    <i class="fas fa-lightbulb"></i>
                                </div>
                                <div class="tip-content">
                                    <h4 class="tip-title">Share Insights</h4>
                                    <p class="tip-description">Include personal experiences and industry knowledge</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Writing tips popup toggle
    function toggleWritingTips() {
        const popup = document.getElementById('writing-tips-popup');
        const isVisible = popup.style.display !== 'none';
        
        if (isVisible) {
            popup.style.animation = 'fadeOut 0.3s ease forwards';
            setTimeout(() => {
                popup.style.display = 'none';
            }, 300);
        } else {
            popup.style.display = 'flex';
            popup.style.animation = 'fadeIn 0.3s ease forwards';
        }
    }

    // Close popup when clicking outside
    document.addEventListener('click', function(event) {
        const popup = document.getElementById('writing-tips-popup');
        const hintsBtn = document.querySelector('.btn-hints');
        
        if (popup && !popup.contains(event.target) && !hintsBtn.contains(event.target)) {
            if (popup.style.display !== 'none') {
                toggleWritingTips();
            }
        }
    });

    // Enhanced form interactions
    document.addEventListener('DOMContentLoaded', function() {
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

        // Character counter for content
        const contentTextarea = document.getElementById('content');
        const charCounter = document.createElement('div');
        charCounter.className = 'char-counter';
        charCounter.innerHTML = '<i class="fas fa-keyboard"></i> <span id="char-count">0</span> characters';
        contentTextarea.parentNode.appendChild(charCounter);

        contentTextarea.addEventListener('input', function() {
            document.getElementById('char-count').textContent = this.value.length;
        });

        console.log('🎨 Professional Career Advice Form loaded!');
    });
</script>

<style>
/* Professional Career Advice System Styles */
:root {
    /* Primary Color Scheme - Matching LMS and Challenge pages */
    --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
    --primary-color: #2563eb;
    --primary-dark: #1d4ed8;
    --accent-color: #10b981;
    
    /* Glass morphism effects */
    --glass-bg: rgba(255, 255, 255, 0.1);
    --glass-border: rgba(255, 255, 255, 0.2);
    
    /* Text colors */
    --text-primary: #1a202c;
    --text-secondary: #4a5568;
    --text-light: #718096;
    
    /* Surface colors */
    --surface-white: #ffffff;
    --surface-light: #f7fafc;
    --surface-gray: #edf2f7;
    --border-light: rgba(0, 0, 0, 0.06);
    
    /* Shadows */
    --shadow-subtle: 0 1px 3px rgba(0, 0, 0, 0.05);
    --shadow-medium: 0 4px 12px rgba(0, 0, 0, 0.15);
    --shadow-large: 0 8px 25px rgba(0, 0, 0, 0.2);
    --shadow-premium: 0 20px 40px rgba(0, 0, 0, 0.1);
    
    /* Border radius */
    --border-radius: 20px;
    --border-radius-large: 24px;
    
    /* Animation */
    --animation-speed: 0.4s;
    --animation-curve: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Professional Page Layout */
.advice-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
    overflow-x: hidden;
}

.advice-page::before {
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

/* Professional Header Section */
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
    color: white;
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

/* Form Sections */
.form-card {
    background: var(--surface-white);
    border-radius: var(--border-radius-large);
    margin-bottom: 2rem;
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
    padding: 2rem 2.5rem;
    border-bottom: 1px solid var(--border-light);
    display: flex;
    align-items: center;
    gap: 1rem;
    justify-content: space-between;
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

.tips-icon {
    background: linear-gradient(135deg, #f59e0b, #f97316);
}

.card-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
}

/* Hints Button */
.btn-hints {
    background: linear-gradient(135deg, #f59e0b, #f97316);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all var(--animation-speed) var(--animation-curve);
    box-shadow: var(--shadow-subtle);
}

.btn-hints:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
    background: linear-gradient(135deg, #d97706, #ea580c);
}

/* Writing Tips Popup */
.tips-popup {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(8px);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 4rem 2rem 2rem;
}

.tips-popup-content {
    background: var(--surface-white);
    border-radius: var(--border-radius-large);
    box-shadow: var(--shadow-premium);
    max-width: 600px;
    width: 100%;
    max-height: 70vh;
    display: flex;
    flex-direction: column;
    border: 1px solid var(--border-light);
}

.tips-popup-body {
    padding: 2rem;
    overflow-y: auto;
    flex: 1;
}

/* Custom Scrollbar for Popup Body */
.tips-popup-body::-webkit-scrollbar {
    width: 8px;
}

.tips-popup-body::-webkit-scrollbar-track {
    background: var(--surface-light);
    border-radius: 4px;
    margin: 0.5rem 0;
}

.tips-popup-body::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #f59e0b, #f97316);
    border-radius: 4px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

.tips-popup-body::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #d97706, #ea580c);
}

/* Firefox scrollbar */
.tips-popup-body {
    scrollbar-width: thin;
    scrollbar-color: #f59e0b var(--surface-light);
}

.tips-popup-header {
    background: linear-gradient(135deg, #fef7e6 0%, #fff3cd 100%);
    padding: 1.5rem 2rem;
    border-bottom: 1px solid var(--border-light);
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-radius: var(--border-radius-large) var(--border-radius-large) 0 0;
    flex-shrink: 0;
}

.tips-popup-title {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.tips-popup-title i {
    color: #f59e0b;
}

.btn-close-tips {
    background: transparent;
    border: none;
    color: var(--text-light);
    font-size: 1.25rem;
    cursor: pointer;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all var(--animation-speed) var(--animation-curve);
}

.btn-close-tips:hover {
    background: rgba(0, 0, 0, 0.1);
    color: var(--text-primary);
}

.tips-popup-body {
    padding: 2rem;
}

.card-body {
    padding: 2.5rem;
}

/* Form Groups */
.form-group {
    margin-bottom: 2rem;
    transition: transform var(--animation-speed) var(--animation-curve);
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

.required {
    color: #ef4444;
    margin-left: 3px;
}

/* Form Controls */
.form-control,
input[type="text"],
textarea {
    width: 100%;
    padding: 1rem 1.25rem;
    border: 2px solid var(--border-light);
    border-radius: 12px;
    font-size: 1rem;
    transition: all var(--animation-speed) var(--animation-curve);
    background: var(--surface-white);
    color: var(--text-primary);
    font-family: inherit;
    box-sizing: border-box;
}

.form-control:focus,
input[type="text"]:focus,
textarea:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    transform: translateY(-1px);
}

textarea {
    resize: vertical;
    min-height: 200px;
    line-height: 1.6;
}

/* Form Help */
.form-help {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 0.5rem;
    font-size: 0.875rem;
    color: var(--text-light);
    font-style: italic;
}

.form-help i {
    color: var(--accent-color);
}

/* Character Counter */
.char-counter {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 0.5rem;
    font-size: 0.875rem;
    color: var(--text-light);
}

.char-counter i {
    color: var(--primary-color);
}

/* Invalid State */
.is-invalid {
    border-color: #ef4444 !important;
    background-color: #fef2f2;
}

.form-error {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    display: block;
    font-weight: 500;
}

/* Submit Group */
.submit-group {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    margin-top: 3rem;
    padding: 2rem 2.5rem;
    background: var(--surface-light);
    border-top: 1px solid var(--border-light);
}

.btn-submit {
    background: var(--primary-gradient);
    color: white;
    font-weight: 700;
    padding: 1.25rem 2.5rem;
    font-size: 1.15rem;
    border-radius: 12px;
    border: none;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    position: relative;
    overflow: hidden;
}

.btn-submit::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.btn-submit:hover::before {
    left: 100%;
}

.btn-submit:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-large);
}

.btn-cancel {
    background: transparent;
    color: var(--text-secondary);
    font-weight: 600;
    padding: 1.25rem 2rem;
    font-size: 1rem;
    border: 2px solid var(--border-light);
    border-radius: 12px;
    text-decoration: none;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-cancel:hover {
    border-color: var(--text-light);
    color: var(--text-primary);
    transform: translateY(-1px);
}

/* Tips Card */
.tips-card {
    background: linear-gradient(135deg, #fef7e6 0%, #fff3cd 100%);
    border: 1px solid rgba(245, 158, 11, 0.2);
}

.tips-grid {
    display: grid;
    gap: 1.5rem;
}

.tip-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 12px;
    border: 1px solid rgba(245, 158, 11, 0.1);
    transition: all var(--animation-speed) var(--animation-curve);
}

.tip-item:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-subtle);
}

.tip-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #f59e0b, #f97316);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    flex-shrink: 0;
}

.tip-content {
    flex: 1;
}

.tip-title {
    margin: 0 0 0.5rem 0;
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
}

.tip-description {
    margin: 0;
    font-size: 0.875rem;
    color: var(--text-secondary);
    line-height: 1.5;
}

/* Popup Animations */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes fadeOut {
    from {
        opacity: 1;
        transform: scale(1);
    }
    to {
        opacity: 0;
        transform: scale(0.9);
    }
}

/* Responsive Design */
@media (max-width: 1024px) {
    .header-container {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 768px) {
    .content-wrapper {
        border-radius: 20px 20px 0 0;
        padding: 2rem 0 1rem;
    }

    .content-container {
        padding: 0 1rem;
    }

    .card-body {
        padding: 2rem;
    }

    .card-header {
        padding: 1.5rem;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .btn-hints {
        align-self: flex-end;
    }

    .tips-popup {
        padding: 2rem 1rem 1rem;
    }

    .tips-popup-content {
        max-height: 85vh;
    }

    .tips-popup-header {
        padding: 1rem 1.5rem;
    }

    .tips-popup-body {
        padding: 1.5rem;
    }

    .submit-group {
        padding: 1.5rem;
        flex-direction: column;
    }

    .tip-item {
        padding: 1rem;
    }
}

@media (max-width: 480px) {
    .header-section {
        padding: 2rem 0 1rem;
    }

    .header-container {
        padding: 0 1rem;
    }

    .header-title {
        font-size: 2rem;
    }

    .form-control,
    input[type="text"],
    textarea {
        padding: 0.875rem 1rem;
    }

    textarea {
        min-height: 150px;
    }

    .tip-item {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
}

/* Animations */
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

.form-card {
    animation: fadeInUp 0.6s ease forwards;
}

.tips-card {
    animation: fadeInUp 0.6s ease forwards;
    animation-delay: 0.2s;
}

/* Focus States for Accessibility */
.btn-submit:focus,
.btn-cancel:focus,
.form-control:focus,
input:focus,
textarea:focus {
    outline: 3px solid rgba(37, 99, 235, 0.5);
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

/* Success States */
.success-flash {
    animation: successPulse 0.6s ease;
}

@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}
</style>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection