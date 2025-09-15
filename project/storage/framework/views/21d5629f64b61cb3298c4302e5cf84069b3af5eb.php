

<?php $__env->startSection('title', $quiz->title . ' - Quiz Assessment | SkillHub'); ?>
<?php $__env->startSection('description', 'Take the ' . $quiz->title . ' quiz to test your knowledge and skills.'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    /* Professional Quiz Interface Styles */
    :root {
        --primary: #4f46e5;
        --primary-dark: #4338ca;
        --secondary: #6366f1;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-500: #6b7280;
        --gray-600: #4b5563;
        --gray-700: #374151;
        --gray-800: #1f2937;
        --gray-900: #111827;
        --white: #ffffff;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        --border-radius: 12px;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        line-height: 1.6;
        color: var(--gray-800);
        background: var(--gray-50);
    }

    /* Main Container */
    .quiz-wrapper {
        min-height: 100vh;
        padding: 2rem 0;
    }

    .quiz-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    /* Quiz Header */
    .quiz-header {
        background: var(--white);
        border-radius: var(--border-radius);
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-lg);
        text-align: center;
        border: 1px solid var(--gray-200);
    }

    .quiz-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: #2563eb;
        color: var(--white);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .quiz-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }

    .quiz-description {
        color: var(--gray-600);
        font-size: 1.125rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Progress Bar */
    .progress-container {
        background: var(--white);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-200);
    }

    .progress-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .progress-title {
        font-weight: 600;
        color: var(--gray-800);
    }

    .progress-stats {
        font-size: 0.875rem;
        color: var(--gray-600);
    }

    .progress-bar {
        width: 100%;
        height: 8px;
        background: var(--gray-200);
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        width: 0%;
        transition: width 0.5s ease;
        border-radius: 4px;
    }

    /* Quiz Form */
    .quiz-form {
        background: var(--white);
        border-radius: var(--border-radius);
        padding: 2rem;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--gray-200);
        margin-bottom: 2rem;
    }

    /* Question Styles */
    .question {
        border: 2px solid var(--gray-200);
        border-radius: var(--border-radius);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        background: var(--gray-50);
        transition: var(--transition);
    }

    .question:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-md);
    }

    .question.answered {
        border-color: var(--success);
        background: #f0fdf4;
    }

    .question-header {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .question-number {
        background: #2563eb;
        color: var(--white);
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.875rem;
        flex-shrink: 0;
    }

    .question.answered .question-number {
        background: var(--success);
    }

    .question-text {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-800);
        line-height: 1.5;
    }

    /* Options */
    .options-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .option {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: var(--white);
        border: 2px solid var(--gray-200);
        border-radius: var(--border-radius);
        padding: 1rem;
        cursor: pointer;
        transition: var(--transition);
    }

    .option:hover {
        border-color: var(--primary);
        background: #f8fafc;
    }

    .option.selected {
        border-color: #2563eb;
        background: #eff6ff;
    }

    .option-radio {
        width: 20px;
        height: 20px;
        border: 2px solid var(--gray-300);
        border-radius: 50%;
        position: relative;
        flex-shrink: 0;
        transition: var(--transition);
    }

    .option.selected .option-radio {
        border-color: #2563eb;
        background: #2563eb;
    }

    .option.selected .option-radio::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 8px;
        height: 8px;
        background: var(--white);
        border-radius: 50%;
        transform: translate(-50%, -50%);
    }

    .option-text {
        font-size: 1rem;
        color: var(--gray-700);
        line-height: 1.5;
    }

    .option.selected .option-text {
        color: #2563eb;
        font-weight: 500;
    }

    .option-input {
        display: none;
    }

    /* Submit Section */
    .submit-section {
        text-align: center;
        padding: 2rem 0 1rem;
        border-top: 1px solid var(--gray-200);
        margin-top: 2rem;
    }

    .submit-btn {
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        color: var(--white);
        border: none;
        border-radius: var(--border-radius);
        padding: 1rem 2rem;
        font-size: 1.125rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: var(--shadow-md);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        min-width: 160px;
        justify-content: center;
    }

    .submit-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .submit-btn:disabled {
        background: var(--gray-400);
        cursor: not-allowed;
        transform: none;
        box-shadow: var(--shadow-sm);
    }

    .submit-btn.ready {
        background: #2563eb;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.8; }
    }

    /* Modal Overlay */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(8px);
        z-index: 1000;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
        overflow-y: auto;
    }

    .modal-overlay.show {
        opacity: 1;
        visibility: visible;
    }

    /* Result Modal */
    .result-modal {
        background: var(--white);
        border-radius: 20px;
        padding: 2rem;
        max-width: 500px;
        width: 100%;
        text-align: center;
        box-shadow: var(--shadow-2xl);
        transform: scale(0.9) translateY(20px);
        transition: transform 0.3s ease;
        position: relative;
        border: 1px solid var(--gray-200);
        max-height: 90vh;
        overflow-y: auto;
        margin: auto;
    }

    .modal-overlay.show .result-modal {
        transform: scale(1) translateY(0);
    }

    .result-close {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: var(--gray-100);
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        color: var(--gray-600);
    }

    .result-close:hover {
        background: var(--gray-200);
        color: var(--gray-800);
    }

    .result-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--success), #059669);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: var(--white);
        font-size: 2rem;
        animation: bounceIn 0.6s ease;
    }

    .result-icon.low-score {
        background: linear-gradient(135deg, var(--warning), #d97706);
    }

    .result-icon.fail-score {
        background: linear-gradient(135deg, var(--danger), #dc2626);
    }

    @keyframes bounceIn {
        0%, 20%, 40%, 60%, 80% {
            animation-timing-function: cubic-bezier(0.215, 0.610, 0.355, 1.000);
        }
        0% {
            opacity: 0;
            transform: scale3d(.3, .3, .3);
        }
        20% {
            transform: scale3d(1.1, 1.1, 1.1);
        }
        40% {
            transform: scale3d(.9, .9, .9);
        }
        60% {
            opacity: 1;
            transform: scale3d(1.03, 1.03, 1.03);
        }
        80% {
            transform: scale3d(.97, .97, .97);
        }
        100% {
            opacity: 1;
            transform: scale3d(1, 1, 1);
        }
    }

    .result-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }

    .result-subtitle {
        color: var(--gray-600);
        font-size: 1rem;
        margin-bottom: 1.5rem;
    }

    .result-score {
        font-size: 2.5rem;
        font-weight: 800;
        background: #2563eb;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1.5rem;
        line-height: 1;
    }

    .result-percentage {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 1.5rem;
    }

    .result-details {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .result-item {
        text-align: center;
        padding: 1rem 0.75rem;
        background: var(--gray-50);
        border-radius: var(--border-radius);
        border: 2px solid var(--gray-100);
        transition: var(--transition);
    }

    .result-item:hover {
        border-color: var(--primary);
        background: #f8fafc;
    }

    .result-value {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.25rem;
    }

    .result-label {
        font-size: 0.75rem;
        color: var(--gray-600);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-weight: 500;
    }

    .result-message {
        background: #2563eb;
        color: var(--white);
        padding: 0.875rem 1.25rem;
        border-radius: var(--border-radius);
        margin-bottom: 1.5rem;
        font-weight: 500;
        font-size: 0.875rem;
    }

    .result-message.warning {
        background: linear-gradient(135deg, var(--warning), #d97706);
    }

    .result-message.danger {
        background: linear-gradient(135deg, var(--danger), #dc2626);
    }

    .result-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-primary {
        background: #2563eb;
        color: var(--white);
        border: none;
        border-radius: var(--border-radius);
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
        cursor: pointer;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
    }

    .btn-secondary {
        background: var(--white);
        color: var(--gray-700);
        border: 2px solid var(--gray-300);
        border-radius: var(--border-radius);
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
        cursor: pointer;
    }

    .btn-secondary:hover {
        border-color: #2563eb;
        color: #2563eb;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    /* Navigation */
    .quiz-navigation {
        text-align: center;
    }

    .btn-back {
        background: var(--white);
        color: var(--gray-700);
        border: 2px solid var(--gray-300);
        border-radius: var(--border-radius);
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: var(--transition);
    }

    .btn-back:hover {
        border-color: #2563eb;
        color: #2563eb;
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .quiz-wrapper {
            padding: 1rem 0;
        }

        .quiz-header,
        .quiz-form,
        .progress-container {
            padding: 1.5rem;
        }

        .quiz-title {
            font-size: 1.5rem;
        }

        .question {
            padding: 1rem;
        }

        .question-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .result-modal {
            padding: 1.5rem;
            margin: 0.5rem;
            max-height: 95vh;
        }

        .result-details {
            grid-template-columns: 1fr;
            gap: 0.5rem;
        }

        .result-actions {
            flex-direction: column;
        }

        .submit-btn {
            width: 100%;
        }

        .result-score {
            font-size: 2rem;
        }

        .result-icon {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
    }

    /* Loading States */
    .loading {
        opacity: 0.7;
        pointer-events: none;
    }

    .spinner {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* Focus States */
    .option:focus-within {
        outline: 2px solid var(--primary);
        outline-offset: 2px;
    }

    .submit-btn:focus {
        outline: 2px solid var(--primary);
        outline-offset: 2px;
    }

    .result-close:focus {
        outline: 2px solid var(--primary);
        outline-offset: 2px;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="quiz-wrapper">
    <div class="quiz-container">
        <!-- Quiz Header -->
        <div class="quiz-header">
            <div class="quiz-badge">
                <i class="fas fa-brain"></i>
                Quiz Assessment
            </div>
            <h1 class="quiz-title"><?php echo e($quiz->title); ?></h1>
            <p class="quiz-description"><?php echo e($quiz->description); ?></p>
        </div>

        <!-- Progress Container -->
        <div class="progress-container">
            <div class="progress-header">
                <span class="progress-title">Progress</span>
                <span class="progress-stats">
                    <span id="answered-count">0</span> of <?php echo e(count($questions)); ?> answered
                </span>
            </div>
            <div class="progress-bar">
                <div class="progress-fill" id="progress-fill"></div>
            </div>
        </div>

        <!-- Quiz Form -->
        <div class="quiz-form">
            <form method="POST" action="<?php echo e(route('quiz.submit', $quiz->id)); ?>" id="quiz-form">
                <?php echo csrf_field(); ?>
                <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="question" data-question="<?php echo e($index); ?>">
                        <div class="question-header">
                            <div class="question-number"><?php echo e($loop->iteration); ?></div>
                            <div class="question-text"><?php echo e($question['question']); ?></div>
                        </div>
                        
                        <div class="options-list">
                            <?php $__currentLoopData = $question['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionIndex => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="option" for="q<?php echo e($index); ?>_<?php echo e($optionIndex); ?>">
                                    <input type="radio" 
                                           id="q<?php echo e($index); ?>_<?php echo e($optionIndex); ?>"
                                           name="answers[<?php echo e($index); ?>]" 
                                           value="<?php echo e($option); ?>" 
                                           class="option-input">
                                    <div class="option-radio"></div>
                                    <div class="option-text"><?php echo e($option); ?></div>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <div class="submit-section">
                    <button type="submit" class="submit-btn" id="submit-btn" disabled>
                        <i class="fas fa-paper-plane"></i>
                        Submit Quiz
                    </button>
                </div>
            </form>
        </div>

        <!-- Navigation -->
        <div class="quiz-navigation">
            <a href="<?php echo e(route('courses.show', $quiz->course_id)); ?>" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                Back to course
            </a>
        </div>
    </div>
</div>

<!-- Result Modal -->
<?php if(session()->has('score')): ?>
<div class="modal-overlay show" id="result-modal">
    <div class="result-modal">
        <button class="result-close" onclick="closeResultModal()">
            <i class="fas fa-times"></i>
        </button>
        
        <?php
            $score = session('score');
            $total = count($questions);
            $percentage = round(($score / $total) * 100);
        ?>
        
        <div class="result-icon <?php echo e($percentage >= 80 ? '' : ($percentage >= 60 ? 'low-score' : 'fail-score')); ?>">
            <?php if($percentage >= 80): ?>
                <i class="fas fa-trophy"></i>
            <?php elseif($percentage >= 60): ?>
                <i class="fas fa-medal"></i>
            <?php else: ?>
                <i class="fas fa-redo"></i>
            <?php endif; ?>
        </div>
        
        <h2 class="result-title">
            <?php if($percentage >= 80): ?>
                Excellent Work!
            <?php elseif($percentage >= 60): ?>
                Good Job!
            <?php else: ?>
                Keep Trying!
            <?php endif; ?>
        </h2>
        
        <p class="result-subtitle">
            <?php if($percentage >= 80): ?>
                You've mastered this topic
            <?php elseif($percentage >= 60): ?>
                You're on the right track
            <?php else: ?>
                Practice makes perfect
            <?php endif; ?>
        </p>
        
        <div class="result-score"><?php echo e($score); ?>/<?php echo e($total); ?></div>
        <div class="result-percentage"><?php echo e($percentage); ?>% Score</div>
        
        <div class="result-message <?php echo e($percentage >= 80 ? '' : ($percentage >= 60 ? 'warning' : 'danger')); ?>">
            <?php if($percentage >= 80): ?>
                <i class="fas fa-star"></i>
                Outstanding! You've demonstrated excellent understanding of the material.
            <?php elseif($percentage >= 60): ?>
                <i class="fas fa-thumbs-up"></i>
                Well done! You have a good grasp of most concepts.
            <?php else: ?>
                <i class="fas fa-lightbulb"></i>
                Don't worry! Review the material and try again to improve your score.
            <?php endif; ?>
        </div>
        
        <div class="result-details">
            <div class="result-item">
                <div class="result-value"><?php echo e($score); ?></div>
                <div class="result-label">Correct</div>
            </div>
            <div class="result-item">
                <div class="result-value"><?php echo e($total - $score); ?></div>
                <div class="result-label">Incorrect</div>
            </div>
            <div class="result-item">
                <div class="result-value"><?php echo e($percentage); ?>%</div>
                <div class="result-label">Score</div>
            </div>
        </div>
        
        <div class="result-actions">
            <?php if($percentage < 80): ?>
                <button class="btn-primary" onclick="retakeQuiz()">
                    <i class="fas fa-redo"></i>
                    Retake Quiz
                </button>
            <?php endif; ?>
            <a href="<?php echo e(route('courses.show', $quiz->course_id)); ?>" class="btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Back to Course
            </a>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const totalQuestions = <?php echo e(count($questions)); ?>;
    let answeredQuestions = 0;
    
    // Get DOM elements
    const form = document.getElementById('quiz-form');
    const submitBtn = document.getElementById('submit-btn');
    const progressFill = document.getElementById('progress-fill');
    const answeredCount = document.getElementById('answered-count');
    const questions = document.querySelectorAll('.question');
    const options = document.querySelectorAll('.option');
    
    // Handle option selection
    options.forEach(option => {
        option.addEventListener('click', function() {
            const input = this.querySelector('.option-input');
            const question = this.closest('.question');
            const questionOptions = question.querySelectorAll('.option');
            
            // Remove selected class from all options in this question
            questionOptions.forEach(opt => opt.classList.remove('selected'));
            
            // Add selected class to clicked option
            this.classList.add('selected');
            
            // Check the radio input
            input.checked = true;
            
            // Mark question as answered
            if (!question.classList.contains('answered')) {
                question.classList.add('answered');
                answeredQuestions++;
                updateProgress();
            }
        });
    });
    
    // Update progress
    function updateProgress() {
        const percentage = (answeredQuestions / totalQuestions) * 100;
        progressFill.style.width = percentage + '%';
        answeredCount.textContent = answeredQuestions;
        
        // Enable submit button when all questions are answered
        if (answeredQuestions === totalQuestions) {
            submitBtn.disabled = false;
            submitBtn.classList.add('ready');
            submitBtn.innerHTML = '<i class="fas fa-check-circle"></i> Submit Quiz';
        }
        
        // Check for milestones
        checkProgressMilestones();
    }
    
    // Make updateProgress globally available
    window.updateProgress = updateProgress;
    
    // Handle form submission
    form.addEventListener('submit', function(e) {
        if (answeredQuestions < totalQuestions) {
            e.preventDefault();
            
            // Show custom alert
            showCustomAlert('Please answer all questions before submitting.');
            
            // Scroll to first unanswered question
            const firstUnanswered = document.querySelector('.question:not(.answered)');
            if (firstUnanswered) {
                firstUnanswered.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            return;
        }
        
        // Show loading state
        submitBtn.innerHTML = '<i class="fas fa-spinner spinner"></i> Submitting...';
        submitBtn.disabled = true;
        form.classList.add('loading');
    });
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && e.target.classList.contains('option-input')) {
            e.target.closest('.option').click();
        }
        
        // Close modal with Escape key
        if (e.key === 'Escape') {
            closeResultModal();
        }
    });
    
    console.log('Quiz interface initialized successfully!');
});

// Result Modal Functions
function closeResultModal() {
    const modal = document.getElementById('result-modal');
    if (modal) {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }
}

function retakeQuiz() {
    // Reset form
    const form = document.getElementById('quiz-form');
    const questions = document.querySelectorAll('.question');
    const options = document.querySelectorAll('.option');
    const submitBtn = document.getElementById('submit-btn');
    const progressFill = document.getElementById('progress-fill');
    const answeredCount = document.getElementById('answered-count');
    
    // Reset all selections
    form.reset();
    questions.forEach(q => q.classList.remove('answered'));
    options.forEach(opt => opt.classList.remove('selected'));
    
    // Reset progress
    progressFill.style.width = '0%';
    answeredCount.textContent = '0';
    
    // Reset submit button
    submitBtn.disabled = true;
    submitBtn.classList.remove('ready');
    submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Submit Quiz';
    
    // Close modal
    closeResultModal();
    
    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
    
    // Reset answered questions counter
    answeredQuestions = 0;
    
    // Update navigation if it exists
    if (window.questionNav) {
        window.questionNav.update();
    }
}

// Custom alert function
function showCustomAlert(message) {
    // Create alert modal
    const alertModal = document.createElement('div');
    alertModal.className = 'modal-overlay show';
    alertModal.innerHTML = `
        <div class="result-modal" style="max-width: 400px;">
            <div class="result-icon" style="background: linear-gradient(135deg, var(--warning), #d97706); width: 60px; height: 60px; font-size: 1.5rem;">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 style="font-size: 1.25rem; margin-bottom: 1rem; color: var(--gray-800);">Incomplete Quiz</h3>
            <p style="color: var(--gray-600); margin-bottom: 2rem;">${message}</p>
            <button class="btn-primary" onclick="closeCustomAlert()" style="width: 100%;">
                <i class="fas fa-check"></i>
                Understood
            </button>
        </div>
    `;
    
    document.body.appendChild(alertModal);
    
    // Auto close after 3 seconds
    setTimeout(() => {
        closeCustomAlert();
    }, 3000);
}

function closeCustomAlert() {
    const alerts = document.querySelectorAll('.modal-overlay:not(#result-modal)');
    alerts.forEach(alert => {
        alert.classList.remove('show');
        setTimeout(() => {
            if (alert.parentNode) {
                alert.parentNode.removeChild(alert);
            }
        }, 300);
    });
}

// Click outside modal to close
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('modal-overlay')) {
        if (e.target.id === 'result-modal') {
            closeResultModal();
        } else {
            closeCustomAlert();
        }
    }
});

// Confetti animation for high scores
function triggerConfetti() {
    // Simple confetti effect using CSS animations
    const confettiColors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#feca57', '#ff9ff3'];
    
    for (let i = 0; i < 50; i++) {
        createConfettiPiece(confettiColors[Math.floor(Math.random() * confettiColors.length)]);
    }
}

function createConfettiPiece(color) {
    const confetti = document.createElement('div');
    confetti.style.cssText = `
        position: fixed;
        width: 10px;
        height: 10px;
        background: ${color};
        left: ${Math.random() * 100}vw;
        top: -10px;
        z-index: 1001;
        pointer-events: none;
        animation: fall 3s linear forwards;
    `;
    
    document.body.appendChild(confetti);
    
    setTimeout(() => {
        if (confetti.parentNode) {
            confetti.parentNode.removeChild(confetti);
        }
    }, 3000);
}

// Add confetti animation CSS
const confettiStyle = document.createElement('style');
confettiStyle.textContent = `
    @keyframes fall {
        0% {
            transform: translateY(-100vh) rotate(0deg);
            opacity: 1;
        }
        100% {
            transform: translateY(100vh) rotate(720deg);
            opacity: 0;
        }
    }
`;
document.head.appendChild(confettiStyle);

// Trigger confetti for high scores
<?php if(session()->has('score')): ?>
    <?php
        $score = session('score');
        $total = count($questions);
        $percentage = round(($score / $total) * 100);
    ?>
    
    <?php if($percentage >= 80): ?>
        setTimeout(() => {
            triggerConfetti();
        }, 500);
    <?php endif; ?>
<?php endif; ?>

// Sound effects for better user experience
const audioContext = typeof AudioContext !== 'undefined' ? AudioContext : webkitAudioContext;

function playSuccessSound() {
    if (!audioContext) return;
    
    try {
        const ctx = new audioContext();
        const oscillator = ctx.createOscillator();
        const gainNode = ctx.createGain();
        
        oscillator.connect(gainNode);
        gainNode.connect(ctx.destination);
        
        oscillator.frequency.setValueAtTime(523.25, ctx.currentTime); // C5
        oscillator.frequency.setValueAtTime(659.25, ctx.currentTime + 0.1); // E5
        oscillator.frequency.setValueAtTime(783.99, ctx.currentTime + 0.2); // G5
        
        gainNode.gain.setValueAtTime(0.3, ctx.currentTime);
        gainNode.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.3);
        
        oscillator.start(ctx.currentTime);
        oscillator.stop(ctx.currentTime + 0.3);
    } catch (e) {
        // Silently fail if audio context is not available
    }
}

function playWarningSound() {
    if (!audioContext) return;
    
    try {
        const ctx = new audioContext();
        const oscillator = ctx.createOscillator();
        const gainNode = ctx.createGain();
        
        oscillator.connect(gainNode);
        gainNode.connect(ctx.destination);
        
        oscillator.frequency.setValueAtTime(400, ctx.currentTime);
        oscillator.frequency.setValueAtTime(350, ctx.currentTime + 0.1);
        
        gainNode.gain.setValueAtTime(0.2, ctx.currentTime);
        gainNode.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + 0.2);
        
        oscillator.start(ctx.currentTime);
        oscillator.stop(ctx.currentTime + 0.2);
    } catch (e) {
        // Silently fail if audio context is not available
    }
}

// Progress milestone celebrations
function checkProgressMilestones() {
    const totalQuestions = <?php echo e(count($questions)); ?>;
    const percentage = (answeredQuestions / totalQuestions) * 100;
    
    if (percentage === 25) {
        showMilestoneMessage("Great start! 25% complete 🎯");
    } else if (percentage === 50) {
        showMilestoneMessage("Halfway there! 50% complete 🚀");
    } else if (percentage === 75) {
        showMilestoneMessage("Almost done! 75% complete ⭐");
    } else if (percentage === 100) {
        showMilestoneMessage("All questions answered! Ready to submit 🎉");
        playSuccessSound();
    }
}

function showMilestoneMessage(message) {
    const milestone = document.createElement('div');
    milestone.className = 'milestone-toast';
    milestone.innerHTML = `
        <div class="milestone-content">
            <i class="fas fa-check-circle"></i>
            <span>${message}</span>
        </div>
    `;
    
    // Add milestone styles if not already added
    if (!document.querySelector('#milestone-styles')) {
        const milestoneStyles = document.createElement('style');
        milestoneStyles.id = 'milestone-styles';
        milestoneStyles.textContent = `
            .milestone-toast {
                position: fixed;
                top: 20px;
                right: 20px;
                background: linear-gradient(135deg, var(--success), #059669);
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 12px;
                box-shadow: var(--shadow-lg);
                z-index: 1002;
                animation: slideInRight 0.5s ease, fadeOut 0.5s ease 2.5s forwards;
                max-width: 300px;
            }
            
            .milestone-content {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                font-weight: 600;
                font-size: 0.875rem;
            }
            
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
            
            @keyframes fadeOut {
                from {
                    opacity: 1;
                    transform: translateX(0);
                }
                to {
                    opacity: 0;
                    transform: translateX(100%);
                }
            }
            
            @media (max-width: 768px) {
                .milestone-toast {
                    left: 20px;
                    right: 20px;
                    max-width: none;
                }
            }
        `;
        document.head.appendChild(milestoneStyles);
    }
    
    document.body.appendChild(milestone);
    
    setTimeout(() => {
        if (milestone.parentNode) {
            milestone.parentNode.removeChild(milestone);
        }
    }, 3000);
}

// Enhanced quiz analytics
function trackQuizAnalytics() {
    const startTime = Date.now();
    const analytics = {
        questionsAnswered: 0,
        timeSpent: 0,
        answerPattern: [],
        difficultyRating: null
    };
    
    // Track answer patterns
    document.querySelectorAll('.option-input').forEach(input => {
        input.addEventListener('change', function() {
            const questionIndex = this.name.match(/\d+/)[0];
            const answerTime = Date.now();
            
            analytics.answerPattern.push({
                question: questionIndex,
                timestamp: answerTime,
                timeFromStart: answerTime - startTime
            });
        });
    });
    
    // Store analytics for potential future use
    window.quizAnalytics = analytics;
}

// Quiz timer (optional feature)
function initializeQuizTimer(durationMinutes = 30) {
    const timerDisplay = document.createElement('div');
    timerDisplay.className = 'quiz-timer';
    timerDisplay.innerHTML = `
        <div class="timer-content">
            <i class="fas fa-clock"></i>
            <span id="timer-text">${durationMinutes}:00</span>
        </div>
    `;
    
    // Add timer styles
    const timerStyles = document.createElement('style');
    timerStyles.textContent = `
        .quiz-timer {
            position: fixed;
            top: 20px;
            left: 20px;
            background: var(--white);
            border: 2px solid var(--gray-200);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            box-shadow: var(--shadow-md);
            z-index: 1001;
            transition: all 0.3s ease;
        }
        
        .quiz-timer.warning {
            border-color: var(--warning);
            background: #fef3c7;
            animation: pulse 1s infinite;
        }
        
        .quiz-timer.danger {
            border-color: var(--danger);
            background: #fee2e2;
            animation: pulse 0.5s infinite;
        }
        
        .timer-content {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            color: var(--gray-800);
            font-size: 0.875rem;
        }
        
        @media (max-width: 768px) {
            .quiz-timer {
                left: 50%;
                transform: translateX(-50%);
                top: 10px;
            }
        }
    `;
    document.head.appendChild(timerStyles);
    
    document.querySelector('.quiz-header').appendChild(timerDisplay);
    
    let timeLeft = durationMinutes * 60;
    const timerText = document.getElementById('timer-text');
    
    const countdown = setInterval(() => {
        timeLeft--;
        const minutes = Math.floor(timeLeft / 60);
        const seconds = timeLeft % 60;
        
        timerText.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
        
        // Warning states
        if (timeLeft <= 300 && timeLeft > 60) { // Last 5 minutes
            timerDisplay.classList.add('warning');
        } else if (timeLeft <= 60) { // Last minute
            timerDisplay.classList.remove('warning');
            timerDisplay.classList.add('danger');
        }
        
        // Auto-submit when time runs out
        if (timeLeft <= 0) {
            clearInterval(countdown);
            document.getElementById('quiz-form').submit();
        }
    }, 1000);
    
    return countdown;
}

// Auto-save functionality
function initializeAutoSave() {
    const AUTOSAVE_KEY = `quiz_${window.location.pathname}_autosave`;
    let autoSaveTimeout;
    
    // Load saved answers on page load
    function loadSavedAnswers() {
        const saved = localStorage.getItem(AUTOSAVE_KEY);
        if (saved) {
            try {
                const answers = JSON.parse(saved);
                let loadedCount = 0;
                
                Object.keys(answers).forEach(questionIndex => {
                    const input = document.querySelector(`input[name="answers[${questionIndex}]"][value="${answers[questionIndex]}"]`);
                    if (input) {
                        input.checked = true;
                        const option = input.closest('.option');
                        const question = input.closest('.question');
                        
                        // Apply visual states
                        option.classList.add('selected');
                        question.classList.add('answered');
                        loadedCount++;
                    }
                });
                
                // Update global counter
                answeredQuestions = loadedCount;
                
                // Update progress after loading
                if (window.updateProgress) {
                    window.updateProgress();
                }
                
                // Show recovery message if answers were loaded
                if (loadedCount > 0) {
                    showRecoveryMessage();
                }
            } catch (e) {
                console.log('Could not load saved answers');
            }
        }
    }
    
    // Save answers to localStorage
    function saveAnswers() {
        const answers = {};
        document.querySelectorAll('input[type="radio"]:checked').forEach(input => {
            const match = input.name.match(/answers\[(\d+)\]/);
            if (match) {
                answers[match[1]] = input.value;
            }
        });
        
        if (Object.keys(answers).length > 0) {
            localStorage.setItem(AUTOSAVE_KEY, JSON.stringify(answers));
        }
    }
    
    // Clear saved data
    function clearSavedAnswers() {
        localStorage.removeItem(AUTOSAVE_KEY);
    }
    
    // Show recovery message
    function showRecoveryMessage() {
        const recoveryToast = document.createElement('div');
        recoveryToast.className = 'recovery-toast';
        recoveryToast.innerHTML = `
            <div class="recovery-content">
                <i class="fas fa-history"></i>
                <span>Previous answers restored!</span>
                <button onclick="this.parentElement.parentElement.remove()" class="recovery-close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        // Add recovery styles
        if (!document.querySelector('#recovery-styles')) {
            const recoveryStyles = document.createElement('style');
            recoveryStyles.id = 'recovery-styles';
            recoveryStyles.textContent = `
                .recovery-toast {
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: linear-gradient(135deg, var(--primary), var(--secondary));
                    color: white;
                    padding: 1rem 1.5rem;
                    border-radius: 12px;
                    box-shadow: var(--shadow-lg);
                    z-index: 1003;
                    animation: slideInRight 0.5s ease;
                    max-width: 300px;
                }
                
                .recovery-content {
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                    font-weight: 600;
                    font-size: 0.875rem;
                }
                
                .recovery-close {
                    background: rgba(255, 255, 255, 0.2);
                    border: none;
                    border-radius: 50%;
                    width: 24px;
                    height: 24px;
                    color: white;
                    cursor: pointer;
                    margin-left: auto;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    transition: background 0.2s ease;
                }
                
                .recovery-close:hover {
                    background: rgba(255, 255, 255, 0.3);
                }
                
                @media (max-width: 768px) {
                    .recovery-toast {
                        left: 20px;
                        right: 20px;
                        max-width: none;
                    }
                }
            `;
            document.head.appendChild(recoveryStyles);
        }
        
        document.body.appendChild(recoveryToast);
        
        setTimeout(() => {
            if (recoveryToast.parentNode) {
                recoveryToast.remove();
            }
        }, 5000);
    }
    
    // Auto-save on answer change
    document.addEventListener('change', function(e) {
        if (e.target.type === 'radio' && e.target.name.startsWith('answers[')) {
            clearTimeout(autoSaveTimeout);
            autoSaveTimeout = setTimeout(saveAnswers, 500);
        }
    });
    
    // Clear saved data on successful submission
    document.getElementById('quiz-form').addEventListener('submit', function() {
        clearSavedAnswers();
    });
    
    // Load saved answers on initialization
    loadSavedAnswers();
    
    return {
        save: saveAnswers,
        load: loadSavedAnswers,
        clear: clearSavedAnswers
    };
}


// Scroll to question function
function scrollToQuestion(index) {
    const question = document.querySelector(`.question[data-question="${index}"]`);
    if (question) {
        // Update current indicator
        document.querySelectorAll('.nav-item').forEach(item => item.classList.remove('current'));
        const currentNavItem = document.querySelector(`.nav-item[data-question="${index}"]`);
        if (currentNavItem) {
            currentNavItem.classList.add('current');
        }
        
        // Smooth scroll
        question.scrollIntoView({ 
            behavior: 'smooth', 
            block: 'center',
            inline: 'nearest'
        });
        
        // Highlight question briefly
        question.style.transform = 'scale(1.02)';
        question.style.transition = 'transform 0.3s ease';
        setTimeout(() => {
            question.style.transform = '';
        }, 600);
    }
}

// Toggle navigation visibility
function toggleNavigation() {
    const navGrid = document.getElementById('nav-grid');
    const toggleBtn = document.querySelector('.nav-toggle');
    
    if (navGrid && toggleBtn) {
        navGrid.classList.toggle('collapsed');
        toggleBtn.classList.toggle('collapsed');
    }
}

// Keyboard shortcuts
function initializeKeyboardShortcuts() {
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + S to save (prevent default browser save)
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            if (window.autoSave) {
                window.autoSave.save();
                showMilestoneMessage("Progress saved! 💾");
            }
        }
        
        // Ctrl/Cmd + Enter to submit
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            e.preventDefault();
            const submitBtn = document.getElementById('submit-btn');
            if (!submitBtn.disabled) {
                submitBtn.click();
            }
        }
        
        // Arrow keys for question navigation
        if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
            const questions = document.querySelectorAll('.question');
            const current = document.querySelector('.question.current') || questions[0];
            const currentIndex = Array.from(questions).indexOf(current);
            
            let nextIndex;
            if (e.key === 'ArrowDown') {
                nextIndex = Math.min(currentIndex + 1, questions.length - 1);
            } else {
                nextIndex = Math.max(currentIndex - 1, 0);
            }
            
            if (nextIndex !== currentIndex) {
                questions.forEach(q => q.classList.remove('current'));
                questions[nextIndex].classList.add('current');
                scrollToQuestion(nextIndex);
            }
        }
    });
}

// Initialize all enhanced features
document.addEventListener('DOMContentLoaded', function() {
    // Initialize analytics tracking
    trackQuizAnalytics();
    
    // Initialize auto-save
    window.autoSave = initializeAutoSave();
    
    // Initialize navigation (only on larger screens)
    if (window.innerWidth > 1024) {
        window.questionNav = initializeQuestionNavigation();
    }
    
    // Initialize keyboard shortcuts
    initializeKeyboardShortcuts();
    
    console.log('All enhanced quiz features initialized successfully!');
});

// Uncomment the line below to enable a 30-minute timer
// initializeQuizTimer(30);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Desktop\SkillHubProject\resources\views/quiz/show.blade.php ENDPATH**/ ?>