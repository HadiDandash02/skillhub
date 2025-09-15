

<?php $__env->startSection('content'); ?>
<div class="edit-quiz-page">
    <!-- Professional Header Section -->
    <section class="quiz-header-section">
        <div class="quiz-header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-edit"></i>
                    <span>Quiz Management</span>
                </div>
                <h1 class="header-title">Edit Quiz</h1>
                <p class="header-description">Update and refine your quiz questions and settings</p>
                <div class="header-breadcrumb">
                    <a href="<?php echo e(url()->previous()); ?>" class="breadcrumb-link">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Course</span>
                    </a>
                    <i class="fas fa-chevron-right"></i>
                    <span class="breadcrumb-current">Edit Quiz</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Wrapper -->
    <div class="quiz-content-wrapper">
        <div class="quiz-content-container">
            
            <!-- Quiz Info Card -->
            <div class="quiz-info-card">
                <div class="quiz-info-header">
                    <div class="quiz-icon">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <div class="quiz-details">
                        <h3 class="quiz-title"><?php echo e($quiz->title); ?></h3>
                        <p class="quiz-subtitle">Editing quiz configuration and questions</p>
                        <div class="quiz-meta">
                            <span class="meta-item">
                                <i class="fas fa-calendar"></i>
                                Created <?php echo e($quiz->created_at->diffForHumans()); ?>

                            </span>
                            <?php if($quiz->updated_at != $quiz->created_at): ?>
                            <span class="meta-item">
                                <i class="fas fa-clock"></i>
                                Last updated <?php echo e($quiz->updated_at->diffForHumans()); ?>

                            </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Form Card -->
            <div class="form-card">
                <div class="form-header">
                    <h3 class="form-title">
                        <i class="fas fa-cog"></i>
                        Quiz Configuration
                    </h3>
                    <p class="form-subtitle">Update your quiz details and questions</p>
                </div>

                <div class="form-container">
                    <form method="POST" action="<?php echo e(route('admin.quizzes.update', $quiz->id)); ?>" onsubmit="prepareQuizData()" class="quiz-form">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        
                        <input type="hidden" name="course_id" value="<?php echo e($quiz->course_id); ?>">
                        
                        <!-- Basic Quiz Info -->
                        <div class="quiz-basics-section">
                            <h4 class="section-title">
                                <i class="fas fa-info-circle"></i>
                                Basic Information
                            </h4>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="title" class="form-label">
                                        <i class="fas fa-heading"></i>
                                        Quiz Title<span class="required">*</span>
                                    </label>
                                    <input type="text" id="title" name="title" class="form-control" required 
                                           value="<?php echo e($quiz->title); ?>"
                                           placeholder="Enter a compelling quiz title">
                                </div>
                                
                                <div class="form-group form-group-full">
                                    <label for="description" class="form-label">
                                        <i class="fas fa-align-left"></i>
                                        Description<span class="required">*</span>
                                    </label>
                                    <textarea id="description" name="description" class="form-control" rows="4" required 
                                              placeholder="Describe what this quiz covers and its learning objectives..."><?php echo e($quiz->description); ?></textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Questions Section -->
                        <div class="questions-section">
                            <div class="questions-header">
                                <h4 class="section-title">
                                    <i class="fas fa-question-circle"></i>
                                    <span class="question-counter">Quiz Questions (0)</span>
                                </h4>
                                <div class="questions-stats">
                                    <div class="stat-item">
                                        <i class="fas fa-list"></i>
                                        <span id="total-questions">0</span>
                                        <small>Questions</small>
                                    </div>
                                    <div class="stat-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span id="completed-questions">0</span>
                                        <small>Complete</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="questions-container" class="questions-container">
                                <!-- Questions will be added here dynamically -->
                                
                                <!-- Empty State -->
                                <div class="empty-questions-state" id="empty-state" style="display: none;">
                                    <div class="empty-icon">
                                        <i class="fas fa-question-circle"></i>
                                    </div>
                                    <h3 class="empty-title">No Questions Found</h3>
                                    <p class="empty-description">Start building your quiz by adding your first question. You can include multiple choice options and specify the correct answer.</p>
                                    <button type="button" onclick="addQuestion()" class="btn-add-first-question">
                                        <i class="fas fa-plus-circle"></i>
                                        <span>Add Your First Question</span>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Dynamic Add Question Button (will be moved after each question) -->
                            <div class="add-question-section" id="add-question-section">
                                <button type="button" onclick="addQuestion()" class="btn-add-question-dynamic">
                                    <i class="fas fa-plus"></i>
                                    <span>Add Another Question</span>
                                </button>
                                <div class="question-tips">
                                    <div class="tip-item">
                                        <i class="fas fa-lightbulb"></i>
                                        <span>Keep questions clear and concise</span>
                                    </div>
                                    <div class="tip-item">
                                        <i class="fas fa-target"></i>
                                        <span>Provide 3-4 answer options for best results</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden inputs for form submission -->
                        <input type="hidden" name="questions" id="questions_json">
                        <input type="hidden" name="answers" id="answers_json">

                        <!-- Form Actions -->
                        <div class="form-actions">
                            <button type="submit" class="btn-primary">
                                <i class="fas fa-save"></i>
                                <span>Update Quiz</span>
                            </button>
                            <a href="<?php echo e(url()->previous()); ?>" class="btn-secondary">
                                <i class="fas fa-times"></i>
                                <span>Cancel</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Professional Quiz Edit System Styles */
:root {
    /* Primary Color Scheme - Matching other blades */
    --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
    --primary-color: #2563eb;
    --primary-dark: #1d4ed8;
    --accent-color: #10b981;
    --accent-dark: #059669;
    
    /* Secondary colors */
    --secondary-color: #f59e0b;
    --warning-color: #ef4444;
    --success-color: #10b981;
    
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

/* Additional Professional Enhancements */
@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeOut {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(-20px);
    }
}

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

/* Real-time Validation Styles */
.validation-success {
    border-color: var(--success-color) !important;
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1) !important;
}

.validation-error {
    border-color: var(--warning-color) !important;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
}

/* Professional Page Layout */
.edit-quiz-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
    overflow-x: hidden;
}

.edit-quiz-page::before {
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
.quiz-header-section {
    position: relative;
    z-index: 2;
    padding: 4rem 0 2rem;
    color: white;
}

.quiz-header-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.header-content {
    text-align: center;
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
    font-size: clamp(2.5rem, 4vw, 3.5rem);
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
    margin-bottom: 2rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

.header-breadcrumb {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    margin-top: 1.5rem;
    font-size: 0.95rem;
    opacity: 0.9;
}

.breadcrumb-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: white;
    text-decoration: none;
    transition: all var(--animation-speed) var(--animation-curve);
    padding: 0.5rem 1rem;
    border-radius: 8px;
}

.breadcrumb-link:hover {
    color: #fbbf24;
    background: rgba(255, 255, 255, 0.1);
    transform: translateY(-1px);
}

.breadcrumb-current {
    font-weight: 600;
}

/* Content Wrapper */
.quiz-content-wrapper {
    position: relative;
    z-index: 2;
    background: var(--surface-light);
    border-radius: 40px 40px 0 0;
    margin-top: -1rem;
    padding: 3rem 0 2rem;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
}

.quiz-content-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 2rem;
}

/* Quiz Info Card */
.quiz-info-card {
    background: var(--surface-white);
    border-radius: var(--border-radius);
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    position: relative;
    overflow: hidden;
    animation: fadeInUp 0.6s ease forwards;
    animation-delay: 0.1s;
}

.quiz-info-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--secondary-color);
}

.quiz-info-header {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.quiz-icon {
    width: 60px;
    height: 60px;
    background: var(--secondary-color);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.quiz-details {
    flex: 1;
}

.quiz-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 0.5rem 0;
}

.quiz-subtitle {
    font-size: 0.875rem;
    color: var(--text-light);
    margin: 0 0 1rem 0;
}

.quiz-meta {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8rem;
    color: var(--text-light);
}

.meta-item i {
    color: var(--secondary-color);
}

/* Form Card */
.form-card {
    background: var(--surface-white);
    border-radius: var(--border-radius-large);
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    overflow: hidden;
    animation: fadeInUp 0.6s ease forwards;
    animation-delay: 0.2s;
}

.form-header {
    background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
    padding: 2rem 2.5rem;
    border-bottom: 1px solid var(--border-light);
}

.form-title {
    margin: 0 0 0.5rem 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.form-title i {
    color: var(--primary-color);
}

.form-subtitle {
    margin: 0;
    font-size: 0.875rem;
    color: var(--text-light);
}

/* Form Container */
.form-container {
    padding: 2.5rem;
}

/* Quiz Basics Section */
.quiz-basics-section {
    margin-bottom: 3rem;
    padding-bottom: 2rem;
    border-bottom: 2px solid var(--border-light);
}

.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 2rem 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.section-title i {
    color: var(--primary-color);
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group-full {
    grid-column: 1 / -1;
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
    box-sizing: border-box;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    transform: translateY(-1px);
}

.form-control::placeholder {
    color: var(--text-light);
}

textarea.form-control {
    resize: vertical;
    min-height: 120px;
    line-height: 1.6;
}

/* Questions Section */
.questions-section {
    margin-bottom: 3rem;
}

.questions-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
    padding: 1.5rem;
    background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
    border-radius: var(--border-radius);
    border: 1px solid var(--border-light);
}

.question-counter {
    transition: all var(--animation-speed) var(--animation-curve);
}

.questions-stats {
    display: flex;
    gap: 2rem;
    align-items: center;
}

.stat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.25rem;
    padding: 0.75rem 1rem;
    background: var(--surface-white);
    border-radius: 12px;
    border: 1px solid var(--border-light);
    box-shadow: var(--shadow-subtle);
    min-width: 80px;
}

.stat-item i {
    color: var(--primary-color);
    font-size: 1.25rem;
}

.stat-item span {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1;
}

.stat-item small {
    font-size: 0.75rem;
    color: var(--text-light);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 600;
}

/* Empty State Styling */
.empty-questions-state {
    text-align: center;
    padding: 4rem 2rem;
    background: var(--surface-white);
    border-radius: var(--border-radius);
    border: 2px dashed var(--border-light);
    transition: all var(--animation-speed) var(--animation-curve);
}

.empty-questions-state:hover {
    border-color: var(--primary-color);
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

.empty-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    color: white;
    font-size: 3rem;
    animation: pulse 2s infinite;
}

.empty-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.empty-description {
    font-size: 1rem;
    color: var(--text-light);
    margin-bottom: 2rem;
    max-width: 500px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

.btn-add-first-question {
    background: var(--primary-gradient);
    color: white;
    padding: 1.25rem 2.5rem;
    border: none;
    border-radius: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.125rem;
    box-shadow: var(--shadow-medium);
    position: relative;
    overflow: hidden;
}

.btn-add-first-question::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.btn-add-first-question:hover::before {
    left: 100%;
}

.btn-add-first-question:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: var(--shadow-large);
}

/* Dynamic Add Question Section */
.add-question-section {
    margin-top: 2rem;
    padding: 2rem;
    background: linear-gradient(135deg, var(--surface-light) 0%, var(--surface-white) 100%);
    border-radius: var(--border-radius);
    border: 1px solid var(--border-light);
    text-align: center;
    animation: slideInUp 0.6s ease forwards;
}

.btn-add-question-dynamic {
    background: var(--accent-color);
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1rem;
    margin-bottom: 1.5rem;
    box-shadow: var(--shadow-medium);
}

.btn-add-question-dynamic:hover {
    background: var(--accent-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow-large);
}

.question-tips {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
}

.tip-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-light);
    font-size: 0.875rem;
    font-weight: 500;
}

.tip-item i {
    color: var(--accent-color);
    font-size: 1rem;
}

.questions-container {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

/* Individual Question Block */
.question-block {
    background: var(--surface-light);
    border: 2px solid var(--border-light);
    border-radius: var(--border-radius);
    padding: 2rem;
    position: relative;
    transition: all var(--animation-speed) var(--animation-curve);
    animation: fadeInUp 0.6s ease forwards;
}

.question-block:hover {
    border-color: var(--primary-color);
    box-shadow: var(--shadow-medium);
}

.question-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.question-header h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.question-number {
    background: var(--primary-color);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
    font-weight: 700;
}

.question-status {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.completion-indicator {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: var(--border-light);
    transition: all var(--animation-speed) var(--animation-curve);
}

.completion-indicator.completed {
    background: var(--success-color);
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
}

.btn-remove-question {
    background: var(--warning-color);
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
}

.btn-remove-question:hover {
    background: #dc2626;
    transform: translateY(-2px);
}

/* Question Text Input */
.question-text-input {
    background-color: #fef9c3 !important; /* light yellow */
    border: 2px solid #facc15 !important; /* amber border */
    font-weight: 500;
    color: var(--text-primary);
    margin-bottom: 5px;
}

.question-text-input:focus {
    border-color: #f59e0b !important;
    box-shadow: 0 0 0 3px rgba(251, 191, 36, 0.1) !important;
}

/* Field Helper */
.field-helper {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8rem;
    color: var(--text-light);
    margin-top: 0.5rem;
    transition: all var(--animation-speed) var(--animation-curve);
}

.field-helper i {
    color: var(--accent-color);
}

.field-helper.success {
    color: var(--success-color);
}

.field-helper.error {
    color: var(--warning-color);
}

/* Options Section */
.options-section {
    margin-bottom: 2rem;
}

.options-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    margin-bottom: 1rem;
}

.option-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    background: var(--surface-white);
    padding: 0.75rem;
    border-radius: 12px;
    border: 1px solid var(--border-light);
    transition: all var(--animation-speed) var(--animation-curve);
}

.option-item:hover {
    border-color: var(--primary-color);
    box-shadow: var(--shadow-subtle);
}

.option-item.filled {
    border-color: var(--success-color);
    background: rgba(34, 197, 94, 0.05);
}

.option-number {
    background: var(--primary-color);
    color: white;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.875rem;
    font-weight: 700;
    flex-shrink: 0;
}

.option-item input {
    flex: 1;
    padding: 0.75rem 1rem;
    border: 1px solid var(--border-light);
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all var(--animation-speed) var(--animation-curve);
    background: var(--surface-white);
}

.option-item input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
}

.btn-remove-option {
    background: transparent;
    color: var(--warning-color);
    border: none;
    padding: 0.5rem;
    border-radius: 50%;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.btn-remove-option:hover {
    background: #fef2f2;
    color: #dc2626;
    transform: scale(1.1);
}

.btn-add-option {
    background: var(--surface-white);
    color: var(--primary-color);
    border: 2px dashed var(--border-light);
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    margin-top: 0.5rem;
}

.btn-add-option:hover {
    border-color: var(--primary-color);
    background: rgba(37, 99, 235, 0.05);
    transform: translateY(-1px);
}

/* Correct Answer Input */
.correct-answer-input {
    background-color: #dcfce7 !important; /* light green */
    border: 2px solid #22c55e !important; /* green border */
    font-weight: 500;
    margin-bottom: 5px;
    color: #064e3b;
}

.correct-answer-input:focus {
    border-color: var(--success-color) !important;
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1) !important;
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    padding-top: 2rem;
    border-top: 1px solid var(--border-light);
    flex-wrap: wrap;
}

.btn-primary {
    background: var(--primary-gradient);
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
    min-width: 160px;
    justify-content: center;
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-large);
}

.btn-secondary {
    background: var(--surface-gray);
    color: var(--text-secondary);
    border: 2px solid var(--border-light);
    padding: 1rem 2rem;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
    min-width: 160px;
    justify-content: center;
}

.btn-secondary:hover {
    background: var(--text-secondary);
    color: white;
    transform: translateY(-2px);
}

/* Loading States */
.loading {
    pointer-events: none;
    opacity: 0.8;
}

.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    border: 2px solid var(--border-light);
    border-top: 2px solid var(--primary-color);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    transform: translate(-50%, -50%);
}

@keyframes spin {
    from { transform: translate(-50%, -50%) rotate(0deg); }
    to { transform: translate(-50%, -50%) rotate(360deg); }
}

/* Enhanced Responsive Design */
@media (max-width: 1024px) {
    .options-grid {
        grid-template-columns: 1fr;
    }
    
    .questions-stats {
        gap: 1rem;
    }
    
    .tip-item {
        flex-direction: column;
        text-align: center;
        gap: 0.25rem;
    }
}

@media (max-width: 768px) {
    .quiz-content-wrapper {
        border-radius: 20px 20px 0 0;
        padding: 2rem 0 1rem;
    }

    .quiz-content-container {
        padding: 0 1rem;
    }

    .form-container {
        padding: 2rem;
    }

    .questions-header {
        flex-direction: column;
        align-items: stretch;
        gap: 1.5rem;
    }

    .questions-stats {
        justify-content: center;
    }

    .question-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .question-status {
        width: 100%;
        justify-content: space-between;
    }

    .form-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-primary,
    .btn-secondary {
        width: 100%;
    }

    .header-breadcrumb {
        flex-direction: column;
        gap: 0.5rem;
    }

    .question-tips {
        flex-direction: column;
        gap: 1rem;
    }

    .empty-questions-state {
        padding: 3rem 1.5rem;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        font-size: 2.5rem;
    }
}

@media (max-width: 480px) {
    .quiz-header-section {
        padding: 2rem 0 1rem;
    }

    .quiz-header-container {
        padding: 0 1rem;
    }

    .header-title {
        font-size: 2rem;
    }

    .form-card,
    .quiz-info-card {
        margin-bottom: 1.5rem;
    }

    .question-block {
        padding: 1.5rem;
    }

    .stat-item {
        min-width: 70px;
        padding: 0.5rem 0.75rem;
    }

    .stat-item span {
        font-size: 1.25rem;
    }

    .question-number {
        width: 36px;
        height: 36px;
        font-size: 0.875rem;
    }

    .option-number {
        width: 28px;
        height: 28px;
        font-size: 0.8rem;
    }
}

/* Focus States for Accessibility */
.form-control:focus,
.btn-primary:focus,
.btn-secondary:focus,
.btn-add-question:focus,
.btn-remove-question:focus,
.btn-add-option:focus,
.breadcrumb-link:focus {
    outline: 3px solid rgba(37, 99, 235, 0.5);
    outline-offset: 2px;
}

/* High Contrast Mode Support */
@media (prefers-contrast: high) {
    .form-card,
    .quiz-info-card,
    .question-block,
    .option-item {
        border-width: 3px;
    }
    
    .question-number,
    .option-number {
        border: 2px solid currentColor;
    }
}

/* Reduced Motion Support */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
    
    .question-number {
        animation: none !important;
    }
    
    .empty-icon {
        animation: none !important;
    }
}

/* Success States */
.success-flash {
    animation: successPulse 0.6s ease;
}

@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
}
</style>

<script>
    let questionCount = 0;
    const existingQuestions = <?php echo $quiz->questions; ?>; // assuming this is JSON
    const existingAnswers = <?php echo $quiz->answers; ?>;

    function addQuestion(data = null) {
        const container = document.getElementById('questions-container');
        const emptyState = document.getElementById('empty-state');
        const addQuestionSection = document.getElementById('add-question-section');
        const index = questionCount++;

        const questionText = data?.question || '';
        const options = data?.options || ['', ''];
        const correct = data?.correct_answer || '';

        // Hide empty state and show add question section
        if (emptyState && emptyState.style.display !== 'none') {
            emptyState.style.display = 'none';
        }
        if (addQuestionSection) {
            addQuestionSection.style.display = 'block';
        }

        let optionsHtml = '';
        options.forEach((opt, i) => {
            optionsHtml += `
                <div class="option-item" data-option="${i + 1}">
                    <div class="option-number">${String.fromCharCode(65 + i)}</div>
                    <input type="text" 
                           name="question[${index}][options][]" 
                           value="${opt}" 
                           placeholder="Enter option ${String.fromCharCode(65 + i)}" 
                           required
                           oninput="validateOption(this)">
                    <button type="button" class="btn-remove-option" onclick="removeOption(this)" data-tooltip="Remove this option">
                        <i class="fas fa-times"></i>
                    </button>
                </div>`;
        });

        const html = `
        <div class="question-block" id="question-block-${index}" data-index="${index}">
            <div class="question-header">
                <h3>
                    <span class="question-number">${index + 1}</span>
                    Question #${index + 1}
                </h3>
                <div class="question-status">
                    <div class="completion-indicator" id="completion-${index}"></div>
                    <button type="button" onclick="removeQuestion(${index})" class="btn-remove-question" data-tooltip="Delete this question">
                        <i class="fas fa-trash"></i>
                        <span>Remove</span>
                    </button>
                </div>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-question"></i>
                    Question Text<span class="required">*</span>
                </label>
                <input type="text" name="question[${index}][text]" value="${questionText}" 
                       class="form-control question-text-input" required 
                       placeholder="What would you like to ask? Make it clear and specific..."
                       oninput="validateQuestion(this, ${index})">
                <div class="field-helper">
                    <i class="fas fa-lightbulb"></i>
                    <span>Write a clear, specific question that tests understanding</span>
                </div>
            </div>
            
            <div class="form-group options-section">
                <label class="form-label">
                    <i class="fas fa-list"></i>
                    Answer Options<span class="required">*</span>
                    <small style="font-weight: normal; color: var(--text-light); margin-left: 0.5rem;">
                        (At least 2 required)
                    </small>
                </label>
                <div class="options-grid" id="options-${index}">
                    ${optionsHtml}
                </div>
                <button type="button" class="btn-add-option" onclick="addOption(${index})" data-tooltip="Add another option">
                    <i class="fas fa-plus"></i>
                    <span>Add Option</span>
                </button>
            </div>
            
            <div class="form-group">
                <label class="form-label">
                    <i class="fas fa-check-circle"></i>
                    Correct Answer<span class="required">*</span>
                </label>
                <input type="text" name="question[${index}][correct]" value="${correct}" 
                       class="form-control correct-answer-input" required 
                       placeholder="Enter the correct answer exactly as it appears in options above..."
                       oninput="validateCorrectAnswer(this, ${index})">
                <div class="field-helper">
                    <i class="fas fa-info-circle"></i>
                    <span>This must match exactly one of the options above (case-sensitive)</span>
                </div>
            </div>
        </div>`;
        
        container.insertAdjacentHTML('beforeend', html);
        
        // Move add question section to after the last question
        const newQuestion = document.getElementById(`question-block-${index}`);
        if (newQuestion && addQuestionSection) {
            newQuestion.parentNode.insertBefore(addQuestionSection, newQuestion.nextSibling);
        }
        
        // Add smooth scroll to new question (only for manually added questions)
        if (!data) {
            setTimeout(() => {
                newQuestion.scrollIntoView({ behavior: 'smooth', block: 'center' });
                
                // Focus on question input
                const questionInput = newQuestion.querySelector('.question-text-input');
                if (questionInput) {
                    questionInput.focus();
                }
            }, 100);
        }
        
        updateQuestionNumbers();
        updateStats();
        updateProgress();
    }

    function addOption(index) {
        const container = document.getElementById(`options-${index}`);
        const optionCount = container.querySelectorAll('.option-item').length;
        const optionLetter = String.fromCharCode(65 + optionCount);
        
        const inputHTML = `
            <div class="option-item" data-option="${optionCount + 1}">
                <div class="option-number">${optionLetter}</div>
                <input type="text" 
                       name="question[${index}][options][]" 
                       placeholder="Enter option ${optionLetter}" 
                       required
                       oninput="validateOption(this)">
                <button type="button" class="btn-remove-option" onclick="removeOption(this)" data-tooltip="Remove this option">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', inputHTML);
        
        // Focus on the new input
        const newInput = container.lastElementChild.querySelector('input');
        newInput.focus();
        
        // Update option letters
        updateOptionLetters(container);
        updateProgress();
    }

    function removeOption(button) {
        const optionItem = button.closest('.option-item');
        const container = optionItem.parentElement;
        
        // Don't allow removing if only 2 options remain
        if (container.querySelectorAll('.option-item').length <= 2) {
            showNotification('Each question must have at least 2 options.', 'warning');
            return;
        }
        
        optionItem.style.animation = 'fadeOut 0.3s ease forwards';
        setTimeout(() => {
            optionItem.remove();
            updateOptionLetters(container);
            updateProgress();
        }, 300);
    }

    function removeQuestion(index) {
        const block = document.getElementById(`question-block-${index}`);
        if (block) {
            // Confirm deletion
            if (confirm('Are you sure you want to remove this question? This action cannot be undone.')) {
                block.style.animation = 'fadeOut 0.3s ease forwards';
                setTimeout(() => {
                    block.remove();
                    updateQuestionNumbers();
                    updateStats();
                    updateProgress();
                    
                    // Show empty state if no questions
                    const remainingQuestions = document.querySelectorAll('.question-block');
                    if (remainingQuestions.length === 0) {
                        document.getElementById('empty-state').style.display = 'block';
                        document.getElementById('add-question-section').style.display = 'none';
                    }
                }, 300);
            }
        }
    }

    function updateQuestionNumbers() {
        const blocks = document.querySelectorAll('.question-block');
        blocks.forEach((block, index) => {
            const numberSpan = block.querySelector('.question-number');
            const headerText = block.querySelector('.question-header h3');
            
            if (numberSpan) {
                numberSpan.textContent = index + 1;
            }
            
            // Update the full header text
            if (headerText) {
                const newHeaderText = headerText.innerHTML.replace(/Question #\d+/, `Question #${index + 1}`);
                headerText.innerHTML = newHeaderText;
            }
            
            // Update data-index
            block.setAttribute('data-index', index);
        });
    }

    function updateOptionLetters(container) {
        const options = container.querySelectorAll('.option-item');
        options.forEach((option, index) => {
            const numberDiv = option.querySelector('.option-number');
            const input = option.querySelector('input');
            const letter = String.fromCharCode(65 + index);
            
            if (numberDiv) {
                numberDiv.textContent = letter;
            }
            if (input) {
                input.placeholder = `Enter option ${letter}`;
            }
        });
    }

    function updateStats() {
        const totalQuestions = document.querySelectorAll('.question-block').length;
        const completedQuestions = document.querySelectorAll('.question-block.completed').length;
        
        document.getElementById('total-questions').textContent = totalQuestions;
        document.getElementById('completed-questions').textContent = completedQuestions;
        
        // Update counter in header
        const counter = document.querySelector('.question-counter');
        if (counter) {
            counter.textContent = `Quiz Questions (${totalQuestions})`;
        }
    }

    function updateProgress() {
        const blocks = document.querySelectorAll('.question-block');
        blocks.forEach((block, index) => {
            const questionInput = block.querySelector('.question-text-input');
            const optionInputs = block.querySelectorAll('input[name*="[options]"]');
            const correctInput = block.querySelector('.correct-answer-input');
            const completionIndicator = block.querySelector('.completion-indicator');
            
            let isComplete = true;
            
            // Check question text
            if (!questionInput || !questionInput.value.trim()) {
                isComplete = false;
            }
            
            // Check options (at least 2 filled)
            const filledOptions = Array.from(optionInputs).filter(input => input.value.trim());
            if (filledOptions.length < 2) {
                isComplete = false;
            }
            
            // Check correct answer
            if (!correctInput || !correctInput.value.trim()) {
                isComplete = false;
            }
            
            // Update completion indicator and block state
            if (isComplete) {
                block.classList.add('completed');
                if (completionIndicator) {
                    completionIndicator.classList.add('completed');
                }
            } else {
                block.classList.remove('completed');
                if (completionIndicator) {
                    completionIndicator.classList.remove('completed');
                }
            }
        });
        
        updateStats();
    }

    function validateQuestion(input, index) {
        const value = input.value.trim();
        const helper = input.parentElement.querySelector('.field-helper');
        
        if (value.length > 0) {
            input.classList.add('validation-success');
            input.classList.remove('validation-error');
            if (helper) {
                helper.classList.add('success');
                helper.classList.remove('error');
                helper.innerHTML = '<i class="fas fa-check-circle"></i><span>Great! Your question is clear and specific.</span>';
            }
        } else {
            input.classList.remove('validation-success');
            input.classList.add('validation-error');
            if (helper) {
                helper.classList.remove('success');
                helper.classList.add('error');
                helper.innerHTML = '<i class="fas fa-exclamation-circle"></i><span>Please enter a question.</span>';
            }
        }
        
        updateProgress();
    }

    function validateOption(input) {
        const value = input.value.trim();
        const optionItem = input.closest('.option-item');
        
        if (value.length > 0) {
            optionItem.classList.add('filled');
            input.classList.add('validation-success');
            input.classList.remove('validation-error');
        } else {
            optionItem.classList.remove('filled');
            input.classList.remove('validation-success');
            input.classList.add('validation-error');
        }
        
        updateProgress();
    }

    function validateCorrectAnswer(input, index) {
        const value = input.value.trim();
        const block = document.getElementById(`question-block-${index}`);
        const optionInputs = block.querySelectorAll('input[name*="[options]"]');
        const options = Array.from(optionInputs).map(opt => opt.value.trim()).filter(Boolean);
        const helper = input.parentElement.querySelector('.field-helper');
        
        if (value && options.includes(value)) {
            input.classList.add('validation-success');
            input.classList.remove('validation-error');
            if (helper) {
                helper.classList.add('success');
                helper.classList.remove('error');
                helper.innerHTML = '<i class="fas fa-check-circle"></i><span>Perfect! This matches one of your options.</span>';
            }
        } else if (value) {
            input.classList.remove('validation-success');
            input.classList.add('validation-error');
            if (helper) {
                helper.classList.remove('success');
                helper.classList.add('error');
                helper.innerHTML = '<i class="fas fa-exclamation-circle"></i><span>This doesn\'t match any of your options exactly.</span>';
            }
        } else {
            input.classList.remove('validation-success', 'validation-error');
            if (helper) {
                helper.classList.remove('success', 'error');
                helper.innerHTML = '<i class="fas fa-info-circle"></i><span>This must match exactly one of the options above (case-sensitive)</span>';
            }
        }
        
        updateProgress();
    }

    function showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
            <span>${message}</span>
        `;
        
        // Add styles
        notification.style.cssText = `
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: ${type === 'success' ? 'var(--success-color)' : type === 'warning' ? 'var(--warning-color)' : 'var(--primary-color)'};
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 600;
            box-shadow: var(--shadow-large);
            z-index: 10000;
            animation: slideInRight 0.4s ease;
        `;
        
        document.body.appendChild(notification);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.4s ease forwards';
            setTimeout(() => {
                if (document.body.contains(notification)) {
                    document.body.removeChild(notification);
                }
            }, 400);
        }, 3000);
    }

    function prepareQuizData() {
        const blocks = document.querySelectorAll('[data-index]');
        const questions = {};
        const answers = {};

        let isValid = true;
        const errors = [];

        blocks.forEach((block, i) => {
            const index = `question_${i + 1}`;
            const questionTextInput = block.querySelector(`input[name*="[text]"]`);
            const optionInputs = block.querySelectorAll(`input[name*="[options]"]`);
            const correctAnswerInput = block.querySelector(`input[name*="[correct]"]`);

            if (!questionTextInput || !correctAnswerInput) {
                isValid = false;
                errors.push(`Question ${i + 1}: Missing required fields`);
                return;
            }

            const questionText = questionTextInput.value.trim();
            const options = Array.from(optionInputs).map(opt => opt.value.trim()).filter(Boolean);
            const correctAnswer = correctAnswerInput.value.trim();

            // Enhanced validation
            if (!questionText) {
                isValid = false;
                errors.push(`Question ${i + 1}: Question text is required`);
                questionTextInput.classList.add('validation-error');
            }

            if (options.length < 2) {
                isValid = false;
                errors.push(`Question ${i + 1}: At least 2 options are required`);
            }

            if (!correctAnswer) {
                isValid = false;
                errors.push(`Question ${i + 1}: Correct answer is required`);
                correctAnswerInput.classList.add('validation-error');
            } else if (!options.includes(correctAnswer)) {
                isValid = false;
                errors.push(`Question ${i + 1}: Correct answer "${correctAnswer}" must match exactly one of the options`);
                correctAnswerInput.classList.add('validation-error');
            }

            // Check for duplicate options
            const uniqueOptions = [...new Set(options)];
            if (uniqueOptions.length !== options.length) {
                isValid = false;
                errors.push(`Question ${i + 1}: Duplicate options found - each option must be unique`);
            }

            // Check for empty options
            const emptyOptions = Array.from(optionInputs).filter(input => !input.value.trim());
            if (emptyOptions.length > 0) {
                isValid = false;
                errors.push(`Question ${i + 1}: All visible options must be filled`);
                emptyOptions.forEach(input => input.classList.add('validation-error'));
            }

            if (isValid) {
                questions[index] = {
                    question: questionText,
                    options: options,
                    correct_answer: correctAnswer
                };

                answers[index] = correctAnswer;
            }
        });

        if (!isValid) {
            showNotification('Please fix the validation errors before submitting.', 'warning');
            
            // Scroll to first error
            const firstError = document.querySelector('.validation-error');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
            
            // Show detailed errors in console for debugging
            console.log('Validation errors:', errors);
            return false;
        }

        if (Object.keys(questions).length === 0) {
            showNotification('Please add at least one question to update the quiz.', 'warning');
            return false;
        }

        document.getElementById('questions_json').value = JSON.stringify(questions);
        document.getElementById('answers_json').value = JSON.stringify(answers);
        
        // Show loading state
        const submitBtn = document.querySelector('.btn-primary');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Updating Quiz...</span>';
        submitBtn.disabled = true;
        submitBtn.classList.add('loading');
        
        // Show success notification
        showNotification('Quiz validation successful! Updating your quiz...', 'success');
        
        return true;
    }

    // Enhanced form interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Load existing questions on page load
        setTimeout(() => {
            for (const [key, value] of Object.entries(existingQuestions)) {
                addQuestion(value);
            }
            
            // If no questions exist, show empty state
            if (Object.keys(existingQuestions).length === 0) {
                document.getElementById('empty-state').style.display = 'block';
                document.getElementById('add-question-section').style.display = 'none';
            }
            
            // Update stats after loading questions
            updateStats();
            updateProgress();
        }, 100);
        
        // Enhanced form validation
        const form = document.querySelector('.quiz-form');
        const titleInput = document.getElementById('title');
        const descriptionInput = document.getElementById('description');

        // Real-time validation feedback for basic info
        [titleInput, descriptionInput].forEach(input => {
            if (input) {
                input.addEventListener('input', function() {
                    if (this.value.trim().length > 0) {
                        this.classList.add('validation-success');
                        this.classList.remove('validation-error');
                    } else {
                        this.classList.remove('validation-success');
                        this.classList.add('validation-error');
                    }
                });

                input.addEventListener('blur', function() {
                    if (!this.value.trim()) {
                        this.classList.add('validation-error');
                    }
                });
            }
        });

        // Enhanced button interactions
        document.addEventListener('click', function(e) {
            if (e.target.matches('.btn-add-question, .btn-add-option, .btn-add-first-question, .btn-add-question-dynamic')) {
                e.target.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    e.target.style.transform = '';
                }, 150);
            }
        });

        // Auto-resize textareas
        const textareas = document.querySelectorAll('textarea');
        textareas.forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        });

        // Enhanced keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Add question with Ctrl+Q
            if (e.ctrlKey && e.key === 'q') {
                e.preventDefault();
                addQuestion();
            }
            
            // Save with Ctrl+S
            if (e.ctrlKey && e.key === 's') {
                e.preventDefault();
                if (prepareQuizData()) {
                    form.submit();
                }
            }

            // Escape to cancel current action
            if (e.key === 'Escape') {
                const focused = document.activeElement;
                if (focused && focused.tagName === 'INPUT') {
                    focused.blur();
                }
            }
        });

        // Form submission enhancement
        form.addEventListener('submit', function(e) {
            if (!prepareQuizData()) {
                e.preventDefault();
                return false;
            }
        });

        // Prevent accidental form submission
        form.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.target.tagName === 'INPUT') {
                e.preventDefault();
                
                // Move to next input or add option/question
                const inputs = Array.from(this.querySelectorAll('input[type="text"]:not([readonly])'));
                const currentIndex = inputs.indexOf(e.target);
                
                if (currentIndex < inputs.length - 1) {
                    inputs[currentIndex + 1].focus();
                } else {
                    // Add new option or question based on context
                    const questionBlock = e.target.closest('.question-block');
                    if (questionBlock && e.target.name.includes('[options]')) {
                        const index = questionBlock.getAttribute('data-index');
                        addOption(parseInt(index));
                    }
                }
            }
        });

        // Advanced tooltips
        document.addEventListener('mouseover', function(e) {
            if (e.target.hasAttribute('data-tooltip')) {
                e.target.classList.add('tooltip');
            }
        });

        console.log('🎯 Professional Quiz Editor with enhanced features loaded successfully!');
        console.log(`📝 Loaded ${Object.keys(existingQuestions).length} existing questions`);
    });

    // Add notification animations
    const notificationStyles = document.createElement('style');
    notificationStyles.textContent = `
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }
            to {
                opacity: 0;
                transform: translateX(100px);
            }
        }
        
        /* Enhanced Tooltips */
        .tooltip {
            position: relative;
        }

        .tooltip::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: -45px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 6px;
            font-size: 0.75rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            pointer-events: none;
        }

        .tooltip:hover::after {
            opacity: 1;
            visibility: visible;
            bottom: -40px;
        }
        
        /* Question Progress Bar - REMOVED */
        
        /* Loading spinner overlay */
        .btn-primary.loading {
            position: relative;
            color: transparent;
        }
        
        .btn-primary.loading .fas {
            color: white;
        }
    `;
    document.head.appendChild(notificationStyles);
</script>

<!-- FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Desktop\SkillHubProject\resources\views/admin/quizzes/edit.blade.php ENDPATH**/ ?>