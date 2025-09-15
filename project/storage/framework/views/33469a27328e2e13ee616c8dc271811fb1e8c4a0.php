

<?php $__env->startSection('content'); ?>
<div class="career-advice-page">
    <!-- Professional Header Section -->
    <!-- Professional Header Section -->
<section class="advice-header-section">
    <div class="advice-header-container">
        <div class="header-content">
            <div class="header-badge">
                <i class="fas fa-lightbulb"></i>
                <span>Career Advice</span>
            </div>
            <h1 class="header-title"><?php echo e($advice->title); ?></h1>
            <div class="header-meta">
                <div class="meta-item">
                    <i class="fas fa-tag"></i>
                    <span><?php echo e(ucfirst($advice->category)); ?></span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-building"></i>
                    <span><?php echo e($advice->careerManager->company_name ?? 'Career Expert'); ?></span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-calendar"></i>
                    <span><?php echo e($advice->created_at->format('M d, Y')); ?></span>
                </div>
                <div class="meta-item">
                    <i class="fas fa-clock"></i>
                    <span><?php echo e(ceil(str_word_count(strip_tags($advice->content)) / 200)); ?> min read</span>
                </div>
            </div>
        </div>
        <div class="header-actions">
            <a href="<?php echo e(url()->previous()); ?>" class="btn-back-header">
                <i class="fas fa-arrow-left"></i>
                <span>Back</span>
            </a>
        </div>
    </div>
</section>

    <!-- Content Wrapper -->
    <div class="advice-content-wrapper">
        <div class="advice-content-container">
            
            <!-- Main Content Card -->
            <article class="advice-content-card">
                <div class="content-header">
                    <div class="content-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="content-info">
                        <h2 class="content-title">Article Content</h2>
                        <p class="content-subtitle">Professional career guidance and insights</p>
                    </div>
                </div>
                
                <div class="content-body">
                    <div class="advice-text">
                        <?php echo $advice->content; ?>

                    </div>
                </div>

                <!-- Article Footer -->
<div class="content-footer">
    <div class="article-info">
        <div class="article-tags">
            <span class="tag-label">
                <i class="fas fa-tags"></i>
                Category:
            </span>
            <span class="category-tag">
                <i class="fas fa-<?php echo e($advice->category === 'interview' ? 'handshake' : ($advice->category === 'networking' ? 'users' : ($advice->category === 'resume' ? 'file-alt' : 'briefcase'))); ?>"></i>
                <?php echo e(ucfirst($advice->category)); ?>

            </span>
        </div>
        
        <div class="article-company">
            <span class="company-label">
                <i class="fas fa-building"></i>
                Published by:
            </span>
            <span class="company-name">
                <?php echo e($advice->careerManager->company_name ?? 'Career Expert'); ?>

            </span>
        </div>
    </div>
    
    <div class="article-actions">
        <button class="btn-action btn-share" onclick="shareArticle()">
            <i class="fas fa-share-alt"></i>
            <span>Share</span>
        </button>
        <button class="btn-action btn-print" onclick="window.print()">
            <i class="fas fa-print"></i>
            <span>Print</span>
        </button>
    </div>
</div>
            </article>

            <!-- Navigation Card -->
            

            <!-- Related Articles Card (if you want to add this feature later) -->
            <!--
            <div class="related-card">
                <div class="related-header">
                    <div class="related-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3 class="related-title">Related Articles</h3>
                </div>
                <div class="related-content">
                    <div class="related-item">
                        <h4 class="related-item-title">Example Related Article</h4>
                        <p class="related-item-excerpt">Brief description of the related article...</p>
                        <a href="#" class="related-item-link">Read More</a>
                    </div>
                </div>
            </div>
            -->
        </div>
    </div>
</div>

<style>
/* Professional Career Advice Show Page Styles */
:root {
    /* Primary Color Scheme - Matching other blades */
    --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
    --primary-color: #2563eb;
    --primary-dark: #1d4ed8;
    --accent-color: #10b981;
    --accent-dark: #059669;
    
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
.career-advice-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
    overflow-x: hidden;
}

.career-advice-page::before {
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
.advice-header-section {
    position: relative;
    z-index: 2;
    padding: 4rem 0 2rem;
    color: white;
}

.advice-header-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
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
    line-height: 1.2;
    margin-bottom: 1.5rem;
    background: linear-gradient(135deg, #ffffff 0%, #f0f8ff 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.header-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    margin-bottom: 1rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
    opacity: 0.9;
}

.meta-item i {
    width: 16px;
    text-align: center;
}

.header-actions .btn-back-header {
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

.btn-back-header:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
    color: white;
}

/* Content Wrapper */
.advice-content-wrapper {
    position: relative;
    z-index: 2;
    background: var(--surface-light);
    border-radius: 40px 40px 0 0;
    margin-top: -1rem;
    padding: 3rem 0 2rem;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
}

.advice-content-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 2rem;
    display: grid;
    gap: 2rem;
}

/* Main Content Card */
.advice-content-card {
    background: var(--surface-white);
    border-radius: var(--border-radius-large);
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    overflow: hidden;
}

.content-header {
    background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
    padding: 2rem 2.5rem;
    border-bottom: 1px solid var(--border-light);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.content-icon {
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

.content-info {
    flex: 1;
}

.content-title {
    margin: 0 0 0.25rem 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
}

.content-subtitle {
    margin: 0;
    font-size: 0.95rem;
    color: var(--text-light);
}

.content-body {
    padding: 3rem 2.5rem;
}

/* Article Content Styling */
.advice-text {
    font-size: 1.125rem;
    line-height: 1.8;
    color: var(--text-secondary);
    max-width: none;
}

.advice-text h1,
.advice-text h2,
.advice-text h3,
.advice-text h4 {
    color: var(--text-primary);
    font-weight: 700;
    margin: 2rem 0 1rem 0;
    line-height: 1.4;
}

.advice-text h1 {
    font-size: 1.875rem;
    border-bottom: 3px solid var(--primary-color);
    padding-bottom: 0.5rem;
}

.advice-text h2 {
    font-size: 1.5rem;
    color: var(--primary-color);
}

.advice-text h3 {
    font-size: 1.25rem;
}

.advice-text p {
    margin-bottom: 1.5rem;
    text-align: justify;
}

.advice-text ul,
.advice-text ol {
    margin: 1.5rem 0;
    padding-left: 2rem;
}

.advice-text li {
    margin-bottom: 0.75rem;
    line-height: 1.7;
}

.advice-text blockquote {
    background: var(--surface-light);
    border-left: 4px solid var(--primary-color);
    padding: 1.5rem 2rem;
    margin: 2rem 0;
    border-radius: 0 12px 12px 0;
    font-style: italic;
    position: relative;
}

.advice-text blockquote::before {
    content: '"';
    font-size: 3rem;
    color: var(--primary-color);
    opacity: 0.3;
    position: absolute;
    top: 0.5rem;
    left: 0.5rem;
    font-family: Georgia, serif;
}

.advice-text strong {
    color: var(--text-primary);
    font-weight: 600;
}

.advice-text a {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    border-bottom: 1px solid transparent;
    transition: all var(--animation-speed) var(--animation-curve);
}

.advice-text a:hover {
    border-bottom-color: var(--primary-color);
}

.advice-text code {
    background: var(--surface-gray);
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-family: 'Monaco', 'Menlo', 'Consolas', monospace;
    font-size: 0.9em;
}

.advice-text pre {
    background: var(--surface-gray);
    padding: 1.5rem;
    border-radius: 12px;
    overflow-x: auto;
    margin: 1.5rem 0;
}

/* Content Footer */
.content-footer {
    padding: 2rem 2.5rem;
    background: var(--surface-light);
    border-top: 1px solid var(--border-light);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 1.5rem;
}

.article-info {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.article-tags,
.article-company {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.tag-label,
.company-label {
    font-size: 0.875rem;
    color: var(--text-light);
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.company-name {
    background: linear-gradient(135deg, var(--surface-white), var(--surface-gray));
    color: var(--text-primary);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    border: 1px solid var(--border-light);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.category-tag {
    background: var(--primary-gradient);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-transform: capitalize;
}

@media (max-width: 768px) {
    .content-footer {
        flex-direction: column;
        align-items: flex-start;
        gap: 1.5rem;
    }
    
    .article-actions {
        width: 100%;
        justify-content: space-between;
    }
    
    .btn-action {
        flex: 1;
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .article-info {
        width: 100%;
    }
    
    .article-tags,
    .article-company {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}

.article-actions {
    display: flex;
    gap: 0.75rem;
}

.btn-action {
    padding: 0.75rem 1rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
}

.btn-share {
    background: var(--accent-color);
    color: white;
}

.btn-share:hover {
    background: var(--accent-dark);
    transform: translateY(-2px);
}

.btn-print {
    background: var(--surface-gray);
    color: var(--text-secondary);
}

.btn-print:hover {
    background: #e2e8f0;
    transform: translateY(-2px);
}

/* Navigation Card */
.navigation-card {
    background: var(--surface-white);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    overflow: hidden;
}

.nav-header {
    background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
    padding: 1.5rem 2rem;
    border-bottom: 1px solid var(--border-light);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.nav-icon {
    width: 40px;
    height: 40px;
    background: var(--accent-color);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
}

.nav-title {
    margin: 0;
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--text-primary);
}

.nav-content {
    padding: 1.5rem 2rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.nav-link {
    padding: 1rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    transition: all var(--animation-speed) var(--animation-curve);
}

.nav-link.primary {
    background: var(--primary-gradient);
    color: white;
}

.nav-link.primary:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
    color: white;
}

.nav-link.secondary {
    background: var(--surface-light);
    color: var(--text-secondary);
    border: 1px solid var(--border-light);
}

.nav-link.secondary:hover {
    background: var(--surface-gray);
    transform: translateY(-2px);
    color: var(--text-primary);
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

.advice-content-card {
    animation: fadeInUp 0.6s ease forwards;
}

.navigation-card {
    animation: fadeInUp 0.6s ease 0.2s forwards;
    opacity: 0;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .advice-header-container {
        flex-direction: column;
        text-align: center;
    }
    
    .header-meta {
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .advice-content-wrapper {
        border-radius: 20px 20px 0 0;
        padding: 2rem 0 1rem;
    }

    .advice-content-container {
        padding: 0 1rem;
    }

    .content-body {
        padding: 2rem 1.5rem;
    }

    .content-header {
        padding: 1.5rem;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .content-footer {
        padding: 1.5rem;
        flex-direction: column;
        align-items: flex-start;
    }

    .nav-content {
        padding: 1.25rem 1.5rem;
    }

    .nav-header {
        padding: 1.25rem 1.5rem;
    }

    .header-meta {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
}

@media (max-width: 480px) {
    .advice-header-section {
        padding: 2rem 0 1rem;
    }

    .advice-header-container {
        padding: 0 1rem;
    }

    .header-title {
        font-size: 1.75rem;
    }

    .advice-text {
        font-size: 1rem;
    }

    .advice-text h1 {
        font-size: 1.5rem;
    }

    .advice-text h2 {
        font-size: 1.25rem;
    }

    .article-actions {
        width: 100%;
        justify-content: space-between;
    }

    .btn-action {
        flex: 1;
        justify-content: center;
    }
}

/* Print Styles */
@media print {
    .career-advice-page {
        background: white;
    }
    
    .advice-header-section {
        background: white;
        color: var(--text-primary);
        padding: 1rem 0;
    }
    
    .header-badge,
    .header-actions,
    .navigation-card,
    .article-actions {
        display: none;
    }
    
    .advice-content-wrapper {
        background: white;
        box-shadow: none;
        border-radius: 0;
    }
    
    .advice-content-card {
        box-shadow: none;
        border: 1px solid #ddd;
    }
}

/* Focus States for Accessibility */
.btn-action:focus,
.nav-link:focus,
.btn-back-header:focus {
    outline: 3px solid rgba(37, 99, 235, 0.5);
    outline-offset: 2px;
}
</style>

<script>
function shareArticle() {
    if (navigator.share) {
        navigator.share({
            title: document.title,
            text: 'Check out this career advice article',
            url: window.location.href
        }).catch(console.error);
    } else {
        // Fallback: copy URL to clipboard
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Article URL copied to clipboard!');
        }).catch(() => {
            alert('Unable to share. URL: ' + window.location.href);
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Enhanced button interactions
    document.querySelectorAll('.btn-action, .nav-link').forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px) scale(1.02)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });

    console.log('🎨 Professional Career Advice page loaded!');
});
</script>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Desktop\SkillHubProject\resources\views/careerAdvice/show.blade.php ENDPATH**/ ?>