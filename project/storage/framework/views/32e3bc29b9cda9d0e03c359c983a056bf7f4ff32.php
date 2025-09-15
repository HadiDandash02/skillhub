

<?php $__env->startSection('content'); ?>
<div class="career-services-page">
    <?php if(auth()->guard()->guest()): ?>
    <!-- Professional Guest Section -->
    <section class="guest-header-section">
        <div class="guest-header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-briefcase"></i>
                    <span>Career Services</span>
                </div>
                <h1 class="header-title">Unlock Your Career Potential</h1>
                <p class="header-description">
                    Access job listings, build your resume, track applications, and get expert career advice—all in one place.
                    Sign up now to take control of your career journey!
                </p>
            </div>
        </div>
    </section>

    <!-- Content Wrapper for Guest -->
    <div class="guest-content-wrapper">
        <div class="guest-content-container">
            <!-- Highlights Section -->
            <div class="highlights-grid">
                <div class="highlight-card">
                    <div class="highlight-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3 class="highlight-title">Job Listings</h3>
                    <p class="highlight-description">Explore exclusive job opportunities tailored to your skills and location.</p>
                </div>

                <div class="highlight-card">
                    <div class="highlight-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h3 class="highlight-title">Resume Builder</h3>
                    <p class="highlight-description">Create a professional resume that stands out, quickly and easily.</p>
                </div>

                <div class="highlight-card">
                    <div class="highlight-icon">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3 class="highlight-title">Career Advice</h3>
                    <p class="highlight-description">Learn how to ace interviews, network effectively, and more.</p>
                </div>

                <div class="highlight-card">
                    <div class="highlight-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h3 class="highlight-title">Job Tracker</h3>
                    <p class="highlight-description">Track your job applications and stay organized effortlessly.</p>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="cta-section">
                <a href="/careerservices/login" class="btn-cta btn-primary">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Log In to Unlock Features</span>
                </a>
                <a href="<?php echo e(route('register')); ?>" class="btn-cta btn-secondary">
                    <i class="fas fa-user-plus"></i>
                    <span>Register Now</span>
                </a>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <?php if(auth()->guard()->check()): ?>
    <!-- Professional Header Section for Authenticated Users -->
    <section class="auth-header-section">
        <div class="auth-header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-briefcase"></i>
                    <span>Career Hub</span>
                </div>
                <h1 class="header-title">Career Services</h1>
                <p class="header-description">Your comprehensive career management platform</p>
            </div>
        </div>
    </section>

    <!-- Content Wrapper for Authenticated Users -->
    <div class="auth-content-wrapper">
        <div class="auth-content-container">
            
            <!-- Feedback Messages -->
            <?php if(session('success')): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?php echo e(session('error')); ?></span>
                </div>
            <?php endif; ?>

            <!-- Job Listings Section - REPLACE THE EXISTING SECTION WITH THIS -->
<div class="service-card">
    <div class="service-header">
        <div class="service-icon">
            <i class="fas fa-search"></i>
        </div>
        <h2 class="service-title">Job Listings</h2>
    </div>
    <div class="service-content">
        <?php if($jobListings->count() > 0): ?>
            <!-- Search Bar for Jobs -->
            <div class="search-section">
                <div class="search-bar">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="jobSearch" class="search-input" placeholder="Search jobs by title, company, or location...">
                    <button class="search-clear" id="jobSearchClear" style="display: none;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="jobs-container">
                <div class="jobs-grid" id="jobsGrid">
                    <?php $__currentLoopData = $jobListings->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="job-card" data-searchable="<?php echo e(strtolower($job->title . ' ' . $job->company . ' ' . $job->location)); ?>">
                            <div class="job-header">
                                <h4 class="job-title"><?php echo e($job->title); ?></h4>
                                <div class="job-company">
                                    <i class="fas fa-building"></i>
                                    <span><?php echo e($job->company); ?></span>
                                </div>
                            </div>
                            <div class="job-details">
                                <div class="job-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?php echo e($job->location); ?></span>
                                    <?php if($job->remote_option ?? false): ?>
                                        <span class="remote-badge">Remote</span>
                                    <?php endif; ?>
                                </div>
                                <div class="job-meta-info">
                                    <span class="job-type">
                                        <i class="fas fa-clock"></i>
                                        <?php echo e($job->employment_type ?? 'Full-time'); ?>

                                    </span>
                                    <span class="job-salary">
                                        <i class="fas fa-dollar-sign"></i>
                                        <?php echo e($job->salary_range ?? 'Competitive'); ?>

                                    </span>
                                </div>
                                <p class="job-description"><?php echo e(Str::limit($job->description, 120)); ?></p>
                                
                                <?php if($job->skills_required && is_array($job->skills_required)): ?>
                                    <div class="job-skills">
                                        <?php $__currentLoopData = array_slice($job->skills_required, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="skill-tag-small"><?php echo e($skill); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(count($job->skills_required) > 3): ?>
                                            <span class="skill-tag-small more-skills">+<?php echo e(count($job->skills_required) - 3); ?> more</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="job-actions">
                                <a href="<?php echo e(route('jobs.show', $job->id)); ?>" class="btn-view-details">
                                    <i class="fas fa-eye"></i>
                                    <span>View Details</span>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Hidden jobs for load more -->
                <div class="hidden-jobs" id="hiddenJobs" style="display: none;">
                    <?php $__currentLoopData = $jobListings->skip(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="job-card" data-searchable="<?php echo e(strtolower($job->title . ' ' . $job->company . ' ' . $job->location)); ?>">
                            <div class="job-header">
                                <h4 class="job-title"><?php echo e($job->title); ?></h4>
                                <div class="job-company">
                                    <i class="fas fa-building"></i>
                                    <span><?php echo e($job->company); ?></span>
                                </div>
                            </div>
                            <div class="job-details">
                                <div class="job-location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span><?php echo e($job->location); ?></span>
                                    <?php if($job->remote_option ?? false): ?>
                                        <span class="remote-badge">Remote</span>
                                    <?php endif; ?>
                                </div>
                                <div class="job-meta-info">
                                    <span class="job-type">
                                        <i class="fas fa-clock"></i>
                                        <?php echo e($job->employment_type ?? 'Full-time'); ?>

                                    </span>
                                    <span class="job-salary">
                                        <i class="fas fa-dollar-sign"></i>
                                        <?php echo e($job->salary_range ?? 'Competitive'); ?>

                                    </span>
                                </div>
                                <p class="job-description"><?php echo e(Str::limit($job->description, 120)); ?></p>
                                
                                <?php if($job->skills_required && is_array($job->skills_required)): ?>
                                    <div class="job-skills">
                                        <?php $__currentLoopData = array_slice($job->skills_required, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="skill-tag-small"><?php echo e($skill); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(count($job->skills_required) > 3): ?>
                                            <span class="skill-tag-small more-skills">+<?php echo e(count($job->skills_required) - 3); ?> more</span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="job-actions">
                                <a href="<?php echo e(route('jobs.show', $job->id)); ?>" class="btn-view-details">
                                    <i class="fas fa-eye"></i>
                                    <span>View Details</span>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <?php if($jobListings->count() > 5): ?>
                    <div class="load-more-section">
                        <button id="loadMoreJobs" class="btn-load-more">
                            <i class="fas fa-chevron-down"></i>
                            <span>Show <?php echo e($jobListings->count() - 5); ?> More Jobs</span>
                        </button>
                        <button id="showLessJobs" class="btn-load-more" style="display: none;">
                            <i class="fas fa-chevron-up"></i>
                            <span>Show Less</span>
                        </button>
                    </div>
                <?php endif; ?>

                <div class="search-results-info" id="jobSearchResults" style="display: none;">
                    <span class="results-count"></span>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <h3 class="empty-title">No Job Listings Available</h3>
                <p class="empty-description">Check back soon for new opportunities!</p>
            </div>
        <?php endif; ?>
    </div>
</div>

            <!-- Resume Builder Section -->
            <div class="service-card">
                <div class="service-header">
                    <div class="service-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h2 class="service-title">Resume Builder</h2>
                </div>
                <div class="service-content">
                    <div class="text-center">
                        <p class="mb-4">Create a professional resume with our easy-to-use template builder.</p>
                        <a href="<?php echo e(route('resume.builder')); ?>" class="btn-generate">
                            <i class="fas fa-edit"></i>
                            <span>Build Professional Resume</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Career Advice Section -->
<div class="service-card">
    <div class="service-header">
        <div class="service-icon">
            <i class="fas fa-lightbulb"></i>
        </div>
        <h2 class="service-title">Career Advice</h2>
    </div>
    <div class="service-content">
        <?php if(count($careerAdvices) > 0): ?>
            <!-- Search Bar for Career Advice -->
            <div class="search-section">
                <div class="search-bar">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="adviceSearch" class="search-input" placeholder="Search career advice by title, category, or company...">
                    <button class="search-clear" id="adviceSearchClear" style="display: none;">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="advice-container">
                <div class="advice-scrollable-container" id="adviceScrollContainer">
                    <div class="advice-categories" id="adviceCategories">
                        <?php $__currentLoopData = $careerAdvices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $advices): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="advice-category" data-category="<?php echo e(strtolower($category)); ?>">
                                <h3 class="category-title">
                                    <i class="fas fa-tag"></i>
                                    <?php echo e(ucfirst($category)); ?> Tips
                                </h3>
                                <div class="advice-grid">
                                    <?php $__currentLoopData = $advices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $advice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="advice-card" data-searchable="<?php echo e(strtolower($advice->title . ' ' . $category . ' ' . ($advice->careerManager->company_name ?? ''))); ?>">
                                            <div class="advice-header">
                                                <h4 class="advice-title"><?php echo e($advice->title); ?></h4>
                                                <div class="advice-meta">
                                                    <div class="advice-company">
                                                        <i class="fas fa-building"></i>
                                                        <span><?php echo e($advice->careerManager->company_name ?? 'Career Expert'); ?></span>
                                                    </div>
                                                    <div class="advice-date">
                                                        <i class="fas fa-calendar"></i>
                                                        <span><?php echo e($advice->created_at->format('M d, Y')); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="advice-content">
                                                <p class="advice-excerpt"><?php echo e(Str::limit($advice->content, 120)); ?></p>
                                            </div>
                                            <div class="advice-actions">
                                                <a href="<?php echo e(route('careerAdvice.show', $advice->id)); ?>" class="btn-read-more">
                                                    <i class="fas fa-arrow-right"></i>
                                                    <span>Read More</span>
                                                </a>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <div class="search-results-info" id="adviceSearchResults" style="display: none;">
                    <span class="results-count"></span>
                </div>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-lightbulb"></i>
                </div>
                <h3 class="empty-title">No Career Advice Available</h3>
                <p class="empty-description">Career advice content will be available soon!</p>
            </div>
        <?php endif; ?>
    </div>
</div>

            <!-- Job Application Tracker Section -->
            <div class="service-card">
                <div class="service-header">
                    <div class="service-icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <h2 class="service-title">Job Application Tracker</h2>
                </div>
                <div class="service-content">
                    <?php if(Auth::user()->jobApplications->count() > 0): ?>
                        <!-- Search Bar for Applications -->
                        <div class="search-section">
                            <div class="search-bar">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" id="applicationSearch" class="search-input" placeholder="Search applications by job title, company, or status...">
                                <button class="search-clear" id="applicationSearchClear" style="display: none;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="applications-container">
                            <div class="tracker-scrollable-container" id="trackerScrollContainer">
                                <div class="tracker-table-container" id="trackerContainer">
                                    <table class="tracker-table">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <i class="fas fa-briefcase"></i>
                                                    Job Title
                                                </th>
                                                <th>
                                                    <i class="fas fa-building"></i>
                                                    Company
                                                </th>
                                                <th>
                                                    <i class="fas fa-flag"></i>
                                                    Status
                                                </th>
                                                <th>
                                                    <i class="fas fa-calendar"></i>
                                                    Applied Date
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="applicationsTableBody">
                                            <?php $__currentLoopData = Auth::user()->jobApplications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $application): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="tracker-row" data-searchable="<?php echo e(strtolower($application->jobListing->title . ' ' . $application->jobListing->company . ' ' . $application->status)); ?>">
                                                    <td class="job-title-cell">
                                                        <strong><?php echo e($application->jobListing->title); ?></strong>
                                                    </td>
                                                    <td class="company-cell">
                                                        <?php echo e($application->jobListing->company); ?>

                                                    </td>
                                                    <td class="status-cell">
                                                        <?php
                                                            $status = strtolower($application->status);
                                                        ?>
                                                        <?php if($status === 'applied'): ?>
                                                            <span class="status-badge status-applied">
                                                                <i class="fas fa-paper-plane"></i>
                                                                Applied
                                                            </span>
                                                        <?php elseif($status === 'pending'): ?>
                                                            <span class="status-badge status-pending">
                                                                <i class="fas fa-clock"></i>
                                                                Pending
                                                            </span>
                                                        <?php elseif($status === 'accepted'): ?>
                                                            <span class="status-badge status-accepted">
                                                                <i class="fas fa-check-circle"></i>
                                                                Accepted
                                                            </span>
                                                        <?php elseif($status === 'rejected'): ?>
                                                            <span class="status-badge status-rejected">
                                                                <i class="fas fa-times-circle"></i>
                                                                Rejected
                                                            </span>
                                                        <?php else: ?>
                                                            <span class="status-badge status-default">
                                                                <i class="fas fa-info-circle"></i>
                                                                <?php echo e(ucfirst($application->status)); ?>

                                                            </span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="date-cell">
                                                        <?php echo e($application->created_at->format('M d, Y')); ?>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="search-results-info" id="applicationSearchResults" style="display: none;">
                                <span class="results-count"></span>
                            </div>
                        </div>
                    <?php else: ?>
                        <div class="empty-state">
                            <div class="empty-icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                            <h3 class="empty-title">No Applications Yet</h3>
                            <p class="empty-description">Start applying to jobs to track your applications here!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<style>
/* Professional Career Services System Styles */
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

/* Career Advice Meta Styling */
.advice-meta {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-top: 0.75rem;
    padding-top: 0.75rem;
    border-top: 1px solid var(--border-light);
}

.advice-company,
.advice-date {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8rem;
    color: var(--text-light);
    font-weight: 500;
}

.advice-company i {
    color: var(--primary-color);
    width: 14px;
    text-align: center;
}

.advice-date i {
    color: var(--text-light);
    width: 14px;
    text-align: center;
}

.advice-company span {
    font-weight: 600;
    color: var(--text-secondary);
}

/* Enhanced advice header spacing */
.advice-header {
    margin-bottom: 1rem;
}

.advice-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 0.5rem 0;
    line-height: 1.4;
}

/* Responsive adjustments for advice meta */
@media (max-width: 768px) {
    .advice-meta {
        gap: 0.375rem;
    }
    
    .advice-company,
    .advice-date {
        font-size: 0.75rem;
    }
}

@media (max-width: 480px) {
    .advice-meta {
        flex-direction: column;
        gap: 0.25rem;
    }
}

/* Additional CSS for Updated Job Cards - ADD TO THE EXISTING STYLE SECTION */

/* Enhanced Job Card Styling */
.job-meta-info {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}

.job-type,
.job-salary {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.875rem;
    color: var(--text-light);
    font-weight: 500;
}

.job-type i,
.job-salary i {
    font-size: 0.8rem;
    color: var(--primary-color);
}

/* Remote Badge in Job Location */
.job-location .remote-badge {
    background: var(--accent-color);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    margin-left: 0.5rem;
}

/* Job Skills Section */
.job-skills {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.skill-tag-small {
    background: rgba(37, 99, 235, 0.1);
    color: var(--primary-color);
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
    border: 1px solid rgba(37, 99, 235, 0.2);
}

.skill-tag-small.more-skills {
    background: rgba(107, 114, 128, 0.1);
    color: var(--text-light);
    border: 1px solid rgba(107, 114, 128, 0.2);
}

/* Enhanced Job Actions */
.job-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
    padding-top: 1rem;
    border-top: 1px solid var(--border-light);
}

.job-posted {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    color: var(--text-light);
    font-size: 0.8rem;
    font-weight: 500;
}

.job-posted i {
    font-size: 0.75rem;
    color: var(--text-light);
}

/* View Details Button */
.btn-view-details {
    background: var(--primary-color);
    color: white;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    font-size: 0.875rem;
    position: relative;
    overflow: hidden;
}

.btn-view-details::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.btn-view-details:hover::before {
    left: 100%;
}

.btn-view-details:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
    color: white;
}

/* Enhanced Job Card Layout */
.job-card {
    display: flex;
    flex-direction: column;
    height: 100%;
    min-height: 280px;
}

.job-details {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.job-description {
    flex: 1;
    margin-bottom: 1rem;
}

/* Hover Effects for Job Cards */
.job-card:hover .job-title {
    color: var(--primary-color);
}

.job-card:hover .skill-tag-small {
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(37, 99, 235, 0.2);
}

/* Focus States */
.btn-view-details:focus {
    outline: 3px solid rgba(37, 99, 235, 0.5);
    outline-offset: 2px;
}

/* Loading State for View Details Button */
.btn-view-details.loading {
    pointer-events: none;
    opacity: 0.8;
}

.btn-view-details.loading i {
    animation: spin 1s linear infinite;
}

/* Enhanced Animation for Skills */
.skill-tag-small {
    transition: all var(--animation-speed) var(--animation-curve);
}

.job-card:hover .skill-tag-small:nth-child(1) {
    animation-delay: 0.1s;
}

.job-card:hover .skill-tag-small:nth-child(2) {
    animation-delay: 0.2s;
}

.job-card:hover .skill-tag-small:nth-child(3) {
    animation-delay: 0.3s;
}

/* Responsive Adjustments for Job Cards */
@media (max-width: 768px) {
    .job-actions {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    
    .job-posted {
        justify-content: center;
    }
    
    .btn-view-details {
        width: 100%;
        justify-content: center;
    }
    
    .job-meta-info {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .job-skills {
        gap: 0.375rem;
    }
    
    .skill-tag-small {
        font-size: 0.7rem;
        padding: 0.2rem 0.6rem;
    }
}

@media (max-width: 480px) {
    .job-card {
        min-height: 320px;
    }
    
    .job-meta-info {
        gap: 0.375rem;
    }
    
    .job-type,
    .job-salary {
        font-size: 0.8rem;
    }
}

/* Professional Page Layout */
.career-services-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
    overflow-x: hidden;
}

.career-services-page::before {
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

/* Guest Section Styles */
.guest-header-section {
    position: relative;
    z-index: 2;
    padding: 4rem 0 2rem;
    color: white;
    text-align: center;
}

.guest-header-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
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
    max-width: 700px;
    margin: 0 auto;
    line-height: 1.6;
}

.guest-content-wrapper {
    position: relative;
    z-index: 2;
    background: var(--surface-light);
    border-radius: 40px 40px 0 0;
    margin-top: -1rem;
    padding: 3rem 0 2rem;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
}

.guest-content-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

/* Highlights Grid */
.highlights-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
    margin-bottom: 3rem;
}

.highlight-card {
    background: var(--surface-white);
    border-radius: var(--border-radius);
    padding: 2rem;
    text-align: center;
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    transition: all var(--animation-speed) var(--animation-curve);
}

.highlight-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-large);
}

.highlight-icon {
    width: 64px;
    height: 64px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 1.5rem;
}

.highlight-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.highlight-description {
    color: var(--text-secondary);
    line-height: 1.6;
    margin: 0;
}

/* CTA Section */
.cta-section {
    text-align: center;
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-cta {
    padding: 1rem 2rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 700;
    font-size: 1rem;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: all var(--animation-speed) var(--animation-curve);
    min-width: 200px;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.btn-primary {
    background: var(--primary-gradient);
    color: white;
    box-shadow: var(--shadow-medium);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-large);
    color: white;
}

.btn-secondary {
    background: var(--surface-white);
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
}

.btn-secondary:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-3px);
    box-shadow: var(--shadow-medium);
}

/* Auth Section Styles */
.auth-header-section {
    position: relative;
    z-index: 2;
    padding: 3rem 0 2rem;
    color: white;
}

.auth-header-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    text-align: center;
}

.auth-content-wrapper {
    position: relative;
    z-index: 2;
    background: var(--surface-light);
    border-radius: 40px 40px 0 0;
    margin-top: -1rem;
    padding: 3rem 0 2rem;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
}

.auth-content-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

/* Alert Messages */
.alert {
    padding: 1rem 1.5rem;
    border-radius: 12px;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 500;
}

.alert-success {
    background: #dcfce7;
    color: #166534;
    border: 1px solid #bbf7d0;
}

.alert-error {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

/* Service Cards */
.service-card {
    background: var(--surface-white);
    border-radius: var(--border-radius-large);
    margin-bottom: 2rem;
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    overflow: hidden;
}

.service-header {
    background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
    padding: 2rem 2.5rem;
    border-bottom: 1px solid var(--border-light);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.service-icon {
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

.service-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
}

.service-content {
    padding: 2.5rem;
}

/* Search Section Styles */
.search-section {
    margin-bottom: 2rem;
}

.search-bar {
    position: relative;
    max-width: 500px;
    margin: 0 auto;
}

.search-input {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid var(--border-light);
    border-radius: 50px;
    font-size: 1rem;
    transition: all var(--animation-speed) var(--animation-curve);
    background: var(--surface-white);
    color: var(--text-primary);
    font-family: inherit;
    box-sizing: border-box;
}

.search-input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    transform: translateY(-1px);
}

.search-icon {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-light);
    pointer-events: none;
}

.search-clear {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--text-light);
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 50%;
    transition: all var(--animation-speed) var(--animation-curve);
}

.search-clear:hover {
    background: var(--surface-light);
    color: var(--text-primary);
}

.search-results-info {
    text-align: center;
    margin-top: 1rem;
    padding: 1rem;
    background: var(--surface-light);
    border-radius: 12px;
    color: var(--text-secondary);
    font-weight: 500;
}

/* Load More Section */
.load-more-section {
    text-align: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border-light);
}

.btn-load-more {
    background: var(--surface-white);
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
    padding: 1rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    font-family: inherit;
    font-size: 1rem;
}

.btn-load-more:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

/* Job Cards */
.jobs-grid {
    display: grid;
    gap: 1.5rem;
}

.job-card {
    background: var(--surface-light);
    border: 1px solid var(--border-light);
    border-radius: 16px;
    padding: 2rem;
    transition: all var(--animation-speed) var(--animation-curve);
}

.job-card:hover {
    box-shadow: var(--shadow-medium);
    transform: translateY(-2px);
}

.job-card.hidden {
    display: none;
}

.job-header {
    margin-bottom: 1rem;
}

.job-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 0.5rem 0;
}

.job-company {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.job-details {
    margin-bottom: 1.5rem;
}

.job-location {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-light);
    margin-bottom: 1rem;
}

.job-description {
    color: var(--text-secondary);
    line-height: 1.6;
    margin: 0;
}

.job-actions {
    text-align: right;
}

.apply-form {
    display: inline-block;
    margin: 0;
}

.btn-apply {
    background: var(--accent-color);
    color: white;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-apply:hover {
    background: var(--accent-dark);
    transform: translateY(-2px);
}

/* Resume Form */
.btn-generate {
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
    text-decoration: none;
    margin-top: 10px;
    position: relative;
    overflow: hidden;
}

.btn-generate::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.btn-generate:hover::before {
    left: 100%;
}

.btn-generate:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-large);
}

/* Career Advice - Updated with Scrollable Container */
.advice-scrollable-container {
    max-height: 600px;
    overflow-y: auto;
    border: 1px solid var(--border-light);
    border-radius: 16px;
    background: var(--surface-white);
    padding: 1rem;
}

.advice-categories {
    display: flex;
    flex-direction: column;
    gap: 3rem;
}

.advice-category {
    margin-bottom: 2rem;
}

.advice-category.hidden {
    display: none;
}

.category-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--border-light);
}

.advice-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 1.5rem;
}

.advice-card {
    background: var(--surface-light);
    border: 1px solid var(--border-light);
    border-radius: 16px;
    padding: 1.5rem;
    transition: all var(--animation-speed) var(--animation-curve);
}

.advice-card:hover {
    box-shadow: var(--shadow-medium);
    transform: translateY(-2px);
}

.advice-card.hidden {
    display: none;
}

.advice-header {
    margin-bottom: 1rem;
}

.advice-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0;
    line-height: 1.4;
}

.advice-content {
    margin-bottom: 1.5rem;
}

.advice-excerpt {
    color: var(--text-secondary);
    line-height: 1.6;
    margin: 0;
}

.advice-actions {
    text-align: right;
}

.btn-read-more {
    background: var(--primary-color);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.875rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all var(--animation-speed) var(--animation-curve);
}

.btn-read-more:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    color: white;
}

/* Job Tracker - Updated with Scrollable Container */
.tracker-scrollable-container {
    max-height: 500px;
    overflow-y: auto;
    border: 1px solid var(--border-light);
    border-radius: 16px;
    background: var(--surface-white);
}

.tracker-table-container {
    overflow-x: auto;
    border-radius: 16px;
    box-shadow: var(--shadow-subtle);
}

.tracker-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: var(--surface-white);
    min-width: 800px;
}

.tracker-table thead {
    background: var(--primary-gradient);
    color: white;
    position: sticky;
    top: 0;
    z-index: 10;
}

.tracker-table th {
    padding: 1.5rem 1rem;
    text-align: left;
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border: none;
    position: relative;
}

.tracker-table th:first-child {
    border-radius: 16px 0 0 0;
}

.tracker-table th:last-child {
    border-radius: 0 16px 0 0;
}

.tracker-table th i {
    margin-right: 0.5rem;
}

.tracker-table td {
    padding: 1.25rem 1rem;
    border-bottom: 1px solid var(--border-light);
    vertical-align: middle;
    font-size: 0.95rem;
    color: var(--text-secondary);
}

.tracker-row {
    transition: all var(--animation-speed) var(--animation-curve);
}

.tracker-row:hover {
    background: linear-gradient(135deg, var(--surface-light) 0%, rgba(37, 99, 235, 0.02) 100%);
}

.tracker-row:last-child td {
    border-bottom: none;
}

.tracker-row.hidden {
    display: none;
}

.job-title-cell {
    font-weight: 600;
    color: var(--text-primary) !important;
}

.company-cell {
    color: var(--text-secondary);
}

.status-cell {
    text-align: center;
}

.date-cell {
    color: var(--text-light);
    font-size: 0.875rem;
}

/* Status Badges */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: capitalize;
    min-width: 90px;
    justify-content: center;
}

.status-applied {
    background: linear-gradient(135deg, #4f46e5, #3730a3);
    color: white;
    box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3);
}

.status-pending {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
}

.status-accepted {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
}

.status-rejected {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
}

.status-default {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    color: white;
    box-shadow: 0 2px 8px rgba(107, 114, 128, 0.3);
}

/* Empty States */
.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    color: var(--text-light);
}

.empty-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: var(--text-light);
}

.empty-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--text-secondary);
}

.empty-description {
    font-size: 1rem;
    margin: 0;
    line-height: 1.6;
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

.service-card {
    animation: fadeInUp 0.6s ease forwards;
}

.highlight-card {
    animation: fadeInUp 0.6s ease forwards;
}

/* Custom Scrollbar Styling */
.advice-scrollable-container::-webkit-scrollbar,
.tracker-scrollable-container::-webkit-scrollbar {
    width: 8px;
}

.advice-scrollable-container::-webkit-scrollbar-track,
.tracker-scrollable-container::-webkit-scrollbar-track {
    background: var(--surface-light);
    border-radius: 4px;
}

.advice-scrollable-container::-webkit-scrollbar-thumb,
.tracker-scrollable-container::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    border-radius: 4px;
}

.advice-scrollable-container::-webkit-scrollbar-thumb:hover,
.tracker-scrollable-container::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, var(--primary-dark), var(--accent-dark));
}

/* Firefox Scrollbar Styling */
.advice-scrollable-container,
.tracker-scrollable-container {
    scrollbar-width: thin;
    scrollbar-color: var(--primary-color) var(--surface-light);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .cta-section {
        flex-direction: column;
        align-items: center;
    }
    
    .advice-grid {
        grid-template-columns: 1fr;
    }
    
    .advice-scrollable-container {
        max-height: 500px;
    }
    
    .tracker-scrollable-container {
        max-height: 400px;
    }
}

@media (max-width: 768px) {
    .guest-content-wrapper,
    .auth-content-wrapper {
        border-radius: 20px 20px 0 0;
        padding: 2rem 0 1rem;
    }

    .guest-content-container,
    .auth-content-container {
        padding: 0 1rem;
    }

    .service-content {
        padding: 2rem;
    }

    .service-header {
        padding: 1.5rem;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .highlights-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .btn-cta {
        width: 100%;
        max-width: 300px;
    }

    .tracker-table {
        font-size: 0.875rem;
        min-width: 700px;
    }

    .tracker-table th,
    .tracker-table td {
        padding: 1rem 0.75rem;
    }
    
    .status-badge {
        min-width: 80px;
        font-size: 0.75rem;
        padding: 0.375rem 0.75rem;
    }

    .search-bar {
        max-width: 100%;
    }
    
    .advice-scrollable-container {
        max-height: 400px;
    }
    
    .tracker-scrollable-container {
        max-height: 350px;
    }
    
    .advice-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .guest-header-section,
    .auth-header-section {
        padding: 2rem 0 1rem;
    }

    .guest-header-container,
    .auth-header-container {
        padding: 0 1rem;
    }

    .header-title {
        font-size: 2rem;
    }

    .job-card {
        padding: 1.5rem;
    }

    .advice-card {
        padding: 1.25rem;
    }

    .tracker-table {
        min-width: 650px;
    }

    .tracker-table th,
    .tracker-table td {
        padding: 0.75rem 0.5rem;
    }
    
    .advice-scrollable-container {
        max-height: 350px;
        padding: 0.75rem;
    }
    
    .tracker-scrollable-container {
        max-height: 300px;
    }
}

/* Focus States for Accessibility */
.btn-cta:focus,
.btn-apply:focus,
.btn-generate:focus,
.btn-read-more:focus,
.search-input:focus,
.btn-load-more:focus {
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

/* Hover Effects for Interactive Elements */
.job-card:hover .job-title {
    color: var(--primary-color);
}

.advice-card:hover .advice-title {
    color: var(--primary-color);
}

/* Professional Table Hover Effects */
.tracker-row:hover .job-title-cell {
    color: var(--primary-color) !important;
}

/* Success Animation */
.success-flash {
    animation: successPulse 0.6s ease;
}

@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
}

/* Enhanced Visual Hierarchy */
.service-card:nth-child(odd) {
    animation-delay: 0.1s;
}

.service-card:nth-child(even) {
    animation-delay: 0.2s;
}

.highlight-card:nth-child(1) { animation-delay: 0.1s; }
.highlight-card:nth-child(2) { animation-delay: 0.2s; }
.highlight-card:nth-child(3) { animation-delay: 0.3s; }
.highlight-card:nth-child(4) { animation-delay: 0.4s; }

/* Professional Scrollbar Styling for Table Container */
.tracker-table-container::-webkit-scrollbar {
    height: 8px;
}

.tracker-table-container::-webkit-scrollbar-track {
    background: var(--surface-light);
    border-radius: 4px;
}

.tracker-table-container::-webkit-scrollbar-thumb {
    background: var(--primary-color);
    border-radius: 4px;
}

.tracker-table-container::-webkit-scrollbar-thumb:hover {
    background: var(--primary-dark);
}
</style>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Job Listings Functionality
    const jobSearch = document.getElementById('jobSearch');
    const jobSearchClear = document.getElementById('jobSearchClear');
    const jobsGrid = document.getElementById('jobsGrid');
    const hiddenJobs = document.getElementById('hiddenJobs');
    const loadMoreJobsBtn = document.getElementById('loadMoreJobs');
    const showLessJobsBtn = document.getElementById('showLessJobs');
    const jobSearchResults = document.getElementById('jobSearchResults');

    let allJobCards = [];
    let isJobsExpanded = false;

    // Initialize job cards
    function initializeJobCards() {
        const visibleCards = Array.from(jobsGrid.querySelectorAll('.job-card'));
        const hiddenCards = hiddenJobs ? Array.from(hiddenJobs.querySelectorAll('.job-card')) : [];
        allJobCards = [...visibleCards, ...hiddenCards];
    }

    // Job search functionality
    if (jobSearch) {
        jobSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            if (searchTerm) {
                jobSearchClear.style.display = 'block';
                performJobSearch(searchTerm);
            } else {
                jobSearchClear.style.display = 'none';
                resetJobDisplay();
            }
        });

        jobSearchClear.addEventListener('click', function() {
            jobSearch.value = '';
            this.style.display = 'none';
            resetJobDisplay();
        });
    }

    function performJobSearch(searchTerm) {
        let visibleCount = 0;
        
        allJobCards.forEach(card => {
            const searchableText = card.getAttribute('data-searchable');
            if (searchableText && searchableText.includes(searchTerm)) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Move all matching cards to visible grid
        allJobCards.forEach(card => {
            if (card.style.display !== 'none') {
                jobsGrid.appendChild(card);
            }
        });

        // Hide load more buttons during search
        if (loadMoreJobsBtn) loadMoreJobsBtn.style.display = 'none';
        if (showLessJobsBtn) showLessJobsBtn.style.display = 'none';
        
        // Show search results
        jobSearchResults.style.display = 'block';
        jobSearchResults.querySelector('.results-count').textContent = 
            `Found ${visibleCount} job${visibleCount !== 1 ? 's' : ''} matching "${searchTerm}"`;
    }

    function resetJobDisplay() {
        // Reset to initial state
        jobSearchResults.style.display = 'none';
        
        if (isJobsExpanded) {
            // Show all cards
            allJobCards.forEach(card => {
                card.style.display = 'block';
                jobsGrid.appendChild(card);
            });
            if (loadMoreJobsBtn) loadMoreJobsBtn.style.display = 'none';
            if (showLessJobsBtn) showLessJobsBtn.style.display = 'block';
        } else {
            // Show only first 5
            allJobCards.forEach((card, index) => {
                card.style.display = 'block';
                if (index < 5) {
                    jobsGrid.appendChild(card);
                } else if (hiddenJobs) {
                    hiddenJobs.appendChild(card);
                }
            });
            if (loadMoreJobsBtn) loadMoreJobsBtn.style.display = 'block';
            if (showLessJobsBtn) showLessJobsBtn.style.display = 'none';
        }
    }

    // Load more jobs functionality
    if (loadMoreJobsBtn) {
        loadMoreJobsBtn.addEventListener('click', function() {
            if (hiddenJobs) {
                const hiddenCards = Array.from(hiddenJobs.querySelectorAll('.job-card'));
                hiddenCards.forEach(card => {
                    jobsGrid.appendChild(card);
                });
            }
            
            isJobsExpanded = true;
            this.style.display = 'none';
            if (showLessJobsBtn) showLessJobsBtn.style.display = 'block';
        });
    }

    if (showLessJobsBtn) {
        showLessJobsBtn.addEventListener('click', function() {
            if (hiddenJobs) {
                allJobCards.forEach((card, index) => {
                    if (index >= 5) {
                        hiddenJobs.appendChild(card);
                    }
                });
            }
            
            isJobsExpanded = false;
            this.style.display = 'none';
            if (loadMoreJobsBtn) loadMoreJobsBtn.style.display = 'block';
            
            // Scroll to jobs section
            document.querySelector('.service-card').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'start' 
            });
        });
    }

    // Career Advice Functionality - Updated for Scrollable Container
    const adviceSearch = document.getElementById('adviceSearch');
    const adviceSearchClear = document.getElementById('adviceSearchClear');
    const adviceCategories = document.getElementById('adviceCategories');
    const adviceSearchResults = document.getElementById('adviceSearchResults');

    let allAdviceCards = [];

    // Initialize advice cards
    function initializeAdviceCards() {
        const visibleCards = adviceCategories ? Array.from(adviceCategories.querySelectorAll('.advice-card')) : [];
        allAdviceCards = [...visibleCards];
    }

    // Advice search functionality
    if (adviceSearch) {
        adviceSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            if (searchTerm) {
                adviceSearchClear.style.display = 'block';
                performAdviceSearch(searchTerm);
            } else {
                adviceSearchClear.style.display = 'none';
                resetAdviceDisplay();
            }
        });

        adviceSearchClear.addEventListener('click', function() {
            adviceSearch.value = '';
            this.style.display = 'none';
            resetAdviceDisplay();
        });
    }

    function performAdviceSearch(searchTerm) {
        let visibleCount = 0;
        
        // Hide all categories first
        const categories = document.querySelectorAll('.advice-category');
        categories.forEach(cat => cat.style.display = 'none');
        
        // Create a temporary container for search results
        let searchContainer = document.getElementById('searchResultsContainer');
        if (!searchContainer) {
            searchContainer = document.createElement('div');
            searchContainer.id = 'searchResultsContainer';
            searchContainer.className = 'advice-categories';
            adviceCategories.parentNode.insertBefore(searchContainer, adviceCategories);
        }
        
        searchContainer.innerHTML = '';
        
        allAdviceCards.forEach(card => {
            const searchableText = card.getAttribute('data-searchable');
            if (searchableText && searchableText.includes(searchTerm)) {
                const clonedCard = card.cloneNode(true);
                const wrapper = document.createElement('div');
                wrapper.className = 'advice-category';
                wrapper.appendChild(clonedCard);
                searchContainer.appendChild(wrapper);
                visibleCount++;
            }
        });
        
        // Show search results
        adviceSearchResults.style.display = 'block';
        adviceSearchResults.querySelector('.results-count').textContent = 
            `Found ${visibleCount} advice article${visibleCount !== 1 ? 's' : ''} matching "${searchTerm}"`;
    }

    function resetAdviceDisplay() {
        // Remove search container
        const searchContainer = document.getElementById('searchResultsContainer');
        if (searchContainer) {
            searchContainer.remove();
        }
        
        // Reset to initial state
        adviceSearchResults.style.display = 'none';
        
        const categories = document.querySelectorAll('.advice-category');
        categories.forEach(cat => cat.style.display = 'block');
    }

    // Job Applications Tracker Functionality - Updated for Scrollable Container
    const applicationSearch = document.getElementById('applicationSearch');
    const applicationSearchClear = document.getElementById('applicationSearchClear');
    const applicationsTableBody = document.getElementById('applicationsTableBody');
    const applicationSearchResults = document.getElementById('applicationSearchResults');

    let allApplicationRows = [];

    // Initialize application rows
    function initializeApplicationRows() {
        const visibleRows = applicationsTableBody ? Array.from(applicationsTableBody.querySelectorAll('.tracker-row')) : [];
        allApplicationRows = [...visibleRows];
    }

    // Application search functionality
    if (applicationSearch) {
        applicationSearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            if (searchTerm) {
                applicationSearchClear.style.display = 'block';
                performApplicationSearch(searchTerm);
            } else {
                applicationSearchClear.style.display = 'none';
                resetApplicationDisplay();
            }
        });

        applicationSearchClear.addEventListener('click', function() {
            applicationSearch.value = '';
            this.style.display = 'none';
            resetApplicationDisplay();
        });
    }

    function performApplicationSearch(searchTerm) {
        let visibleCount = 0;
        
        allApplicationRows.forEach(row => {
            const searchableText = row.getAttribute('data-searchable');
            if (searchableText && searchableText.includes(searchTerm)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Show search results
        applicationSearchResults.style.display = 'block';
        applicationSearchResults.querySelector('.results-count').textContent = 
            `Found ${visibleCount} application${visibleCount !== 1 ? 's' : ''} matching "${searchTerm}"`;
    }

    function resetApplicationDisplay() {
        // Reset to initial state
        applicationSearchResults.style.display = 'none';
        
        allApplicationRows.forEach(row => {
            row.style.display = '';
        });
    }

    // Initialize all sections
    initializeJobCards();
    initializeAdviceCards();
    initializeApplicationRows();

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

    // Enhanced button interactions
    const buttons = document.querySelectorAll('.btn-apply, .btn-generate, .btn-read-more, .btn-cta, .btn-load-more');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px) scale(1.02)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });

    // Application tracking interactions
    const trackerRows = document.querySelectorAll('.tracker-row');
    trackerRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        row.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
        
        setTimeout(() => {
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Job cards stagger animation
    const jobCards = document.querySelectorAll('.job-card');
    jobCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
        
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 150);
    });

    // Advice cards stagger animation
    const adviceCards = document.querySelectorAll('.advice-card');
    adviceCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
        
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Search input enhancements
    const searchInputs = document.querySelectorAll('.search-input');
    searchInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.02)';
            this.parentElement.style.boxShadow = '0 4px 20px rgba(37, 99, 235, 0.15)';
        });
        
        input.addEventListener('blur', function() {
            this.parentElement.style.transform = '';
            this.parentElement.style.boxShadow = '';
        });
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + K to focus job search
        if ((e.ctrlKey || e.metaKey) && e.key === 'k' && jobSearch) {
            e.preventDefault();
            jobSearch.focus();
        }
        
        // Escape to clear active search
        if (e.key === 'Escape') {
            const activeInput = document.activeElement;
            if (activeInput && activeInput.classList.contains('search-input')) {
                activeInput.value = '';
                activeInput.dispatchEvent(new Event('input'));
                activeInput.blur();
            }
        }
    });

    // Smooth scrolling for scrollable containers
    const scrollableContainers = document.querySelectorAll('.advice-scrollable-container, .tracker-scrollable-container');
    scrollableContainers.forEach(container => {
        container.style.scrollBehavior = 'smooth';
    });

    

    // Add scroll indicators after a short delay to ensure DOM is ready
    setTimeout(addScrollIndicators, 500);

    console.log('🚀 Enhanced Professional Career Services with Scrollable Containers loaded successfully!');
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Desktop\SkillHubProject\resources\views/careerservices.blade.php ENDPATH**/ ?>