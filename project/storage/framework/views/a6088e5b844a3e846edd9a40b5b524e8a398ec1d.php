

<?php $__env->startSection('content'); ?>
<div class="job-page">
    <!-- Professional Header Section -->
    <section class="header-section">
        <div class="header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-briefcase"></i>
                    <span>New Job</span>
                </div>
                <h1 class="header-title">Create New Job Listing</h1>
                <p class="header-description">Connect talented professionals with exciting opportunities</p>
            </div>
            <div class="header-actions">
                <a href="<?php echo e(route('careerM.jobs')); ?>" class="btn-secondary-header">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Jobs</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-container">
            <form method="POST" action="<?php echo e(route('careerM.jobs.store')); ?>" class="edit-job-form">
                <?php echo csrf_field(); ?>

                <!-- Basic Information Card -->
                <div class="card form-card">
                    <div class="card-header">
                        <div class="section-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h2 class="card-title">Basic Job Information</h2>
                    </div>
                    <div class="card-body">
                        <!-- Job Title -->
                        <div class="form-group">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading"></i>
                                Job Title<span class="required">*</span>
                            </label>
                            <input type="text" name="title" id="title" value="<?php echo e(old('title')); ?>" 
                                   class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required placeholder="e.g. Senior Frontend Developer">
                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="form-error"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="row">
                            <!-- Company -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company" class="form-label">
                                        <i class="fas fa-building"></i>
                                        Company<span class="required">*</span>
                                    </label>
                                    <div class="company-field-wrapper">
    <input type="text" name="company" id="company" 
        value="<?php echo e(old('company', $companyName ?? '')); ?>"
        class="form-control <?php if(!empty($companyName)): ?> company-readonly <?php endif; ?> <?php $__errorArgs = ['company'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
        required placeholder="Company name"
        <?php if(!empty($companyName)): ?> readonly <?php endif; ?>>
    <?php if(!empty($companyName)): ?>
        <div class="readonly-overlay">
            <i class="fas fa-lock"></i>
            <span>Read Only</span>
        </div>
    <?php endif; ?>
</div>
                                   
                                    <?php $__errorArgs = ['company'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="form-error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="location" class="form-label">
                                        <i class="fas fa-map-marker-alt"></i>
                                        Location<span class="required">*</span>
                                    </label>
                                    <input type="text" name="location" id="location" 
                                           value="<?php echo e(old('location')); ?>" class="form-control <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           required placeholder="e.g. New York, NY">
                                    <?php $__errorArgs = ['location'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="form-error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Employment Type -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employment_type" class="form-label">
                                        <i class="fas fa-clock"></i>
                                        Employment Type<span class="required">*</span>
                                    </label>
                                    <select name="employment_type" id="employment_type" class="form-control employment-dropdown <?php $__errorArgs = ['employment_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                        <option value="">Select employment type</option>
                                        <option value="Full-time" <?php echo e(old('employment_type') == 'Full-time' ? 'selected' : ''); ?>>Full-time</option>
                                        <option value="Part-time" <?php echo e(old('employment_type') == 'Part-time' ? 'selected' : ''); ?>>Part-time</option>
                                        <option value="Contract" <?php echo e(old('employment_type') == 'Contract' ? 'selected' : ''); ?>>Contract</option>
                                        <option value="Temporary" <?php echo e(old('employment_type') == 'Temporary' ? 'selected' : ''); ?>>Temporary</option>
                                        <option value="Internship" <?php echo e(old('employment_type') == 'Internship' ? 'selected' : ''); ?>>Internship</option>
                                    </select>
                                    <?php $__errorArgs = ['employment_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="form-error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <!-- Experience Level -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="experience_level" class="form-label">
                                        <i class="fas fa-chart-line"></i>
                                        Experience Level
                                    </label>
                                    <select name="experience_level" id="experience_level" class="form-control experience-dropdown <?php $__errorArgs = ['experience_level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <option value="">Select experience level</option>
                                        <option value="Entry Level" <?php echo e(old('experience_level') == 'Entry Level' ? 'selected' : ''); ?>>Entry Level</option>
                                        <option value="Mid Level" <?php echo e(old('experience_level') == 'Mid Level' ? 'selected' : ''); ?>>Mid Level</option>
                                        <option value="Senior Level" <?php echo e(old('experience_level') == 'Senior Level' ? 'selected' : ''); ?>>Senior Level</option>
                                        <option value="Executive" <?php echo e(old('experience_level') == 'Executive' ? 'selected' : ''); ?>>Executive</option>
                                    </select>
                                    <?php $__errorArgs = ['experience_level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="form-error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Salary Range -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="salary_range" class="form-label">
                                        <i class="fas fa-dollar-sign"></i>
                                        Salary Range
                                    </label>
                                    <input type="text" name="salary_range" id="salary_range" 
                                           value="<?php echo e(old('salary_range')); ?>" class="form-control <?php $__errorArgs = ['salary_range'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                           placeholder="e.g. $60,000 - $80,000">
                                    <?php $__errorArgs = ['salary_range'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="form-error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>

                            <!-- Application Deadline -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="deadline" class="form-label">
                                        <i class="fas fa-calendar-alt"></i>
                                        Application Deadline
                                    </label>
                                    <input type="date" name="deadline" id="deadline" 
                                           value="<?php echo e(old('deadline')); ?>" class="form-control <?php $__errorArgs = ['deadline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <?php $__errorArgs = ['deadline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="form-error"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Remote Option -->
                        <div class="form-group">
                            <div class="checkbox-group">
                                <input type="checkbox" name="remote_option" id="remote_option" value="1" 
                                       <?php echo e(old('remote_option') ? 'checked' : ''); ?> class="checkbox-input">
                                <label for="remote_option" class="checkbox-label">
                                    <i class="fas fa-home"></i>
                                    Remote work available
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Job Details Card -->
                <div class="card form-card">
                    <div class="card-header">
                        <div class="section-icon">
                            <i class="fas fa-file-text"></i>
                        </div>
                        <h2 class="card-title">Job Details</h2>
                    </div>
                    <div class="card-body">
                        <!-- Job Description -->
                        <div class="form-group">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left"></i>
                                Job Description<span class="required">*</span>
                            </label>
                            <textarea name="description" id="description" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                      rows="6" required placeholder="Provide a detailed job description"><?php echo e(old('description')); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="form-error"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Requirements -->
                        <div class="form-group">
                            <label for="requirements" class="form-label">
                                <i class="fas fa-clipboard-check"></i>
                                Requirements
                            </label>
                            <textarea name="requirements" id="requirements" class="form-control <?php $__errorArgs = ['requirements'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                      rows="4" placeholder="List the job requirements (one per line)"><?php echo e(old('requirements')); ?></textarea>
                            <small class="form-help">Enter each requirement on a new line</small>
                            <?php $__errorArgs = ['requirements'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="form-error"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Responsibilities -->
                        <div class="form-group">
                            <label for="responsibilities" class="form-label">
                                <i class="fas fa-tasks"></i>
                                Key Responsibilities
                            </label>
                            <textarea name="responsibilities" id="responsibilities" class="form-control <?php $__errorArgs = ['responsibilities'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                      rows="4" placeholder="List the key responsibilities (one per line)"><?php echo e(old('responsibilities')); ?></textarea>
                            <small class="form-help">Enter each responsibility on a new line</small>
                            <?php $__errorArgs = ['responsibilities'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="form-error"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Skills Required -->
                        <div class="form-group">
                            <label for="skills_required" class="form-label">
                                <i class="fas fa-code"></i>
                                Required Skills
                            </label>
                            <input type="text" name="skills_required" id="skills_required" 
                                   value="<?php echo e(old('skills_required')); ?>" class="form-control <?php $__errorArgs = ['skills_required'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   placeholder="e.g. JavaScript, React, Node.js, SQL">
                            <small class="form-help">Enter skills separated by commas</small>
                            <?php $__errorArgs = ['skills_required'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="form-error"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Benefits -->
                        <div class="form-group">
                            <label for="benefits" class="form-label">
                                <i class="fas fa-gift"></i>
                                Benefits & Perks
                            </label>
                            <textarea name="benefits" id="benefits" class="form-control <?php $__errorArgs = ['benefits'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                      rows="4" placeholder="List the benefits and perks (one per line)"><?php echo e(old('benefits')); ?></textarea>
                            <small class="form-help">Enter each benefit on a new line</small>
                            <?php $__errorArgs = ['benefits'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="form-error"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>

                <!-- Company Information Card -->
                <div class="card form-card">
                    <div class="card-header">
                        <div class="section-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <h2 class="card-title">Company Information</h2>
                    </div>
                    <div class="card-body">
                        <!-- Company Description -->
                        <div class="form-group">
                            <label for="company_description" class="form-label">
                                <i class="fas fa-info-circle"></i>
                                About the Company
                            </label>
                            <textarea name="company_description" id="company_description" class="form-control <?php $__errorArgs = ['company_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                      rows="4" placeholder="Tell candidates about your company..."><?php echo e(old('company_description')); ?></textarea>
                            <small class="form-help">Describe your company culture, mission, and values</small>
                            <?php $__errorArgs = ['company_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="form-error"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="submit-group">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-plus"></i> Create Job Listing
                        </button>
                        <a href="<?php echo e(route('careerM.jobs')); ?>" class="btn-cancel">
                            <i class="fas fa-times"></i>
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Professional Job Management System Styles - LIGHT THEME ONLY */
:root {
    /* Primary Color Scheme */
    --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
    --primary-color: #2563eb;
    --primary-dark: #1d4ed8;
    --accent-color: #10b981;
    --accent-dark: #059669;
    
    /* Glass morphism effects */
    --glass-bg: rgba(255, 255, 255, 0.1);
    --glass-border: rgba(255, 255, 255, 0.2);
    
    /* Text colors - FORCED LIGHT THEME */
    --text-primary: #1a202c;
    --text-secondary: #4a5568;
    --text-light: #718096;
    
    /* Surface colors - FORCED LIGHT THEME */
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

/* Force light backgrounds for all elements within job page */
.job-page .form-control,
.job-page input,
.job-page select,
.job-page textarea,
.job-page .form-card,
.job-page .card-body,
.job-page .content-wrapper {
    background-color: #ffffff !important;
    color: #1a202c !important;
}

.job-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
    overflow-x: hidden;
    margin-top: -1px;
}

.job-page::before {
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

.card-title {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
}

.card-body {
    padding: 2.5rem;
}

/* Form Groups */
.form-group {
    margin-bottom: 2rem;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: var(--text-primary);
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.form-label i {
    color: var(--primary-color);
    width: 16px;
}

.required {
    color: #ef4444;
    margin-left: 3px;
}

/* Form Controls */
.form-control,
input[type="text"],
input[type="date"],
select,
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
input[type="date"]:focus,
select:focus,
textarea:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    transform: translateY(-1px);
}

/* Enhanced Dropdown Styling */
.employment-dropdown,
.experience-dropdown {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 16px;
    padding-right: 3rem;
    cursor: pointer;
}

.employment-dropdown:hover,
.experience-dropdown:hover {
    background-color: var(--surface-light);
    border-color: var(--primary-color);
}

.employment-dropdown:focus,
.experience-dropdown:focus {
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2310b981' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
}

textarea {
    resize: vertical;
    min-height: 120px;
    line-height: 1.6;
}

/* Form Help Text */
.form-help {
    display: block;
    margin-top: 0.5rem;
    font-size: 0.8rem;
    color: var(--text-light);
    font-style: italic;
}

/* Checkbox Styling */
.checkbox-group {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    background: var(--surface-light);
    border-radius: 12px;
    border: 2px solid var(--border-light);
    transition: all var(--animation-speed) var(--animation-curve);
    cursor: pointer;
}

.checkbox-group:hover {
    border-color: var(--primary-color);
    background: rgba(37, 99, 235, 0.05);
}

.checkbox-input {
    width: 20px;
    height: 20px;
    border: 2px solid var(--border-light);
    border-radius: 4px;
    cursor: pointer;
    position: relative;
    appearance: none;
    background: white;
    transition: all 0.2s ease;
}

.checkbox-input:checked {
    background: var(--primary-gradient);
    border-color: var(--primary-color);
}

.checkbox-input:checked::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 12px;
    font-weight: bold;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
    color: var(--text-primary);
    cursor: pointer;
    margin: 0;
    text-transform: none;
    letter-spacing: normal;
}

.checkbox-label i {
    color: var(--accent-color);
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

/* Row Layout */
.row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
}

.col-md-6 {
    display: flex;
    flex-direction: column;
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
    text-decoration: none;
    min-width: 200px;
    justify-content: center;
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
    color: var(--text-light);
    font-weight: 600;
    padding: 1.25rem 2rem;
    font-size: 1rem;
    border: 2px solid var(--border-light);
    border-radius: 12px;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    min-width: 150px;
    justify-content: center;
}

.btn-cancel:hover {
    border-color: var(--text-light);
    color: var(--text-primary);
    transform: translateY(-2px);
    background: var(--surface-white);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .row {
        grid-template-columns: 1fr;
    }
    
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

    .submit-group {
        padding: 1.5rem;
        flex-direction: column;
    }

    .btn-submit,
    .btn-cancel {
        width: 100%;
        min-width: auto;
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
    input[type="date"],
    select,
    textarea {
        padding: 0.875rem 1rem;
    }

    .checkbox-group {
        padding: 0.75rem;
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

.form-card:nth-child(1) { animation-delay: 0.1s; }
.form-card:nth-child(2) { animation-delay: 0.2s; }
.form-card:nth-child(3) { animation-delay: 0.3s; }

/* Focus States for Accessibility */
.btn-submit:focus,
.btn-cancel:focus,
.form-control:focus,
input:focus,
select:focus,
textarea:focus,
.checkbox-input:focus {
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

/* Enhanced Form Interactions */
.form-group {
    transition: all var(--animation-speed) var(--animation-curve);
}

.form-group:hover {
    transform: translateY(-2px);
}

/* Professional Input Placeholders */
.form-control::placeholder,
input::placeholder,
textarea::placeholder {
    color: var(--text-light);
    opacity: 0.7;
    font-style: italic;
}

/* Enhanced Date Input Styling */
input[type="date"] {
    position: relative;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3crect x='3' y='4' width='18' height='18' rx='2' ry='2'%3e%3c/rect%3e%3cline x1='16' y1='2' x2='16' y2='6'%3e%3c/line%3e%3cline x1='8' y1='2' x2='8' y2='6'%3e%3c/line%3e%3cline x1='3' y1='10' x2='21' y2='10'%3e%3c/line%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 18px;
    padding-right: 3rem;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    opacity: 0;
    position: absolute;
    right: 0;
    width: 50px;
    height: 100%;
    cursor: pointer;
}

/* Enhanced Error States */
.form-group.has-error {
    animation: shake 0.5s ease-in-out;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-5px); }
    75% { transform: translateX(5px); }
}

/* Professional Submit Button Hover Effects */
.btn-submit:hover {
    background: linear-gradient(135deg, #1d4ed8, #059669);
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(37, 99, 235, 0.4);
}

.btn-submit:active {
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.3);
}

/* Enhanced Checkbox Animation */
.checkbox-input {
    position: relative;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.checkbox-input:checked {
    transform: scale(1.1);
}

.checkbox-input:checked::after {
    animation: checkmarkAppear 0.3s ease;
}

@keyframes checkmarkAppear {
    0% {
        opacity: 0;
        transform: translate(-50%, -50%) scale(0);
    }
    100% {
        opacity: 1;
        transform: translate(-50%, -50%) scale(1);
    }
}

/* Enhanced Visual Hierarchy */
.card-header .section-icon {
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    transition: all 0.3s ease;
}

.form-card:hover .section-icon {
    transform: scale(1.05) rotate(5deg);
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
}

/* High Contrast Mode Support */
@media (prefers-contrast: high) {
    .form-card {
        border-width: 2px;
    }
    
    .form-control,
    input,
    select,
    textarea {
        border-width: 3px;
    }
}

/* Reduced Motion Support */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🎯 Professional Career Manager Job Creation Form Loaded');

    // Enhanced form interactions
    document.querySelectorAll('.form-control, input, select, textarea').forEach(element => {
        element.addEventListener('focus', function() {
            this.closest('.form-group').style.transform = 'scale(1.02)';
            this.closest('.form-group').style.zIndex = '10';
        });
        
        element.addEventListener('blur', function() {
            this.closest('.form-group').style.transform = '';
            this.closest('.form-group').style.zIndex = '';
        });
    });

    // Auto-resize textareas
    document.querySelectorAll('textarea').forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = Math.min(this.scrollHeight, 300) + 'px';
        });
        
        // Initial resize
        textarea.style.height = 'auto';
        textarea.style.height = Math.min(textarea.scrollHeight, 300) + 'px';
    });

    // Enhanced button interactions
    document.querySelectorAll('.btn-submit, .btn-cancel').forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.02)';
        });
        
        button.addEventListener('mouseleave', function() {
            if (this.classList.contains('btn-submit')) {
                this.style.transform = 'translateY(-3px)';
            } else {
                this.style.transform = '';
            }
        });
    });

    // Enhanced checkbox interaction
    document.querySelectorAll('.checkbox-group').forEach(group => {
        const checkbox = group.querySelector('.checkbox-input');
        
        group.addEventListener('click', function(e) {
            if (e.target !== checkbox) {
                checkbox.checked = !checkbox.checked;
                checkbox.dispatchEvent(new Event('change'));
            }
        });
        
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                group.style.background = 'rgba(37, 99, 235, 0.1)';
                group.style.borderColor = 'var(--primary-color)';
            } else {
                group.style.background = 'var(--surface-light)';
                group.style.borderColor = 'var(--border-light)';
            }
        });
    });

    // Skills input enhancement
    const skillsInput = document.getElementById('skills_required');
    if (skillsInput) {
        skillsInput.addEventListener('input', function() {
            const skills = this.value.split(',').map(skill => skill.trim()).filter(skill => skill);
            if (skills.length > 0) {
                this.style.borderColor = 'var(--accent-color)';
            } else {
                this.style.borderColor = 'var(--border-light)';
            }
        });
    }

    // Form validation enhancement
    const form = document.querySelector('.edit-job-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.btn-submit');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Job...';
            submitBtn.disabled = true;
            submitBtn.classList.add('loading');
        });
    }

    // Date input minimum date (today)
    const deadlineInput = document.getElementById('deadline');
    if (deadlineInput) {
        const today = new Date().toISOString().split('T')[0];
        deadlineInput.setAttribute('min', today);
    }

    // Enhanced dropdown interactions
    document.querySelectorAll('select').forEach(select => {
        select.addEventListener('change', function() {
            if (this.value) {
                this.style.borderColor = 'var(--accent-color)';
                this.style.background = 'rgba(16, 185, 129, 0.05)';
            } else {
                this.style.borderColor = 'var(--border-light)';
                this.style.background = 'var(--surface-white)';
            }
        });
    });

    // Enhanced error handling
    document.querySelectorAll('.is-invalid').forEach(element => {
        element.closest('.form-group').classList.add('has-error');
        
        element.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('is-invalid');
                this.closest('.form-group').classList.remove('has-error');
                const errorSpan = this.parentNode.querySelector('.form-error');
                if (errorSpan) {
                    errorSpan.style.display = 'none';
                }
            }
        });
    });

    // Professional form progression
    const formCards = document.querySelectorAll('.form-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    formCards.forEach(card => {
        observer.observe(card);
    });

    // Enhanced keyboard navigation
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + Enter to submit form
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            const submitBtn = document.querySelector('.btn-submit');
            if (submitBtn && !submitBtn.disabled) {
                submitBtn.click();
            }
        }
        
        // Escape to cancel
        if (e.key === 'Escape') {
            const cancelBtn = document.querySelector('.btn-cancel');
            if (cancelBtn) {
                const confirmLeave = confirm('Are you sure you want to cancel? Any unsaved changes will be lost.');
                if (confirmLeave) {
                    window.location.href = cancelBtn.href;
                }
            }
        }
    });

    // Success animation for form elements
    document.querySelectorAll('.form-control, input, select, textarea').forEach(element => {
        element.addEventListener('blur', function() {
            if (this.value && this.checkValidity()) {
                this.classList.add('success-flash');
                setTimeout(() => {
                    this.classList.remove('success-flash');
                }, 600);
            }
        });
    });

    console.log('✅ Professional Career Manager Job Creation Form Ready!');
});

// Utility function for debouncing
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}
</script>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Desktop\SkillHubProject\resources\views/careerManager/jobs/create-job.blade.php ENDPATH**/ ?>