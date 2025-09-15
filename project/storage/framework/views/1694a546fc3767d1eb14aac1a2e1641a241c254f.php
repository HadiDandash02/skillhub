

<?php $__env->startSection('content'); ?>
<div class="jobs-management-page">
    <!-- Professional Header Section -->
    <section class="jobs-header-section">
        <div class="jobs-header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-briefcase"></i>
                    <span>Job Management</span>
                </div>
                <h1 class="header-title">Manage Job Listings</h1>
                <p class="header-description">Create, edit, and manage career opportunities for platform users</p>
                <!-- Back Button - Now under description -->
                <div class="back-button-container">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="back-button">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Dashboard</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Wrapper -->
    <div class="jobs-content-wrapper">
        <div class="jobs-content-container">
            
            <!-- Quick Actions Section -->
            <div class="quick-actions-section">
                <div class="action-card primary-action">
                    <div class="action-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="action-content">
                        <h3 class="action-title">Create New Job Listing</h3>
                        <p class="action-description">Post new career opportunities for platform users</p>
                    </div>
                    <a href="<?php echo e(route('admin.jobs.create')); ?>" class="action-button">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Jobs Table Card -->
            <div class="table-card">
                <div class="table-header">
                    <div class="table-title-section">
                        <h3 class="table-title">
                            <i class="fas fa-briefcase"></i>
                            Job Listings Overview
                        </h3>
                        <p class="table-subtitle">Manage and monitor all career opportunities</p>
                    </div>
                    <div class="table-actions">
                        <div class="job-stats">
                            <?php
                                $totalCompanies = collect($jobs)->pluck('company')->unique()->count();
                                $totalLocations = collect($jobs)->pluck('location')->unique()->count();
                            ?>
                            <div class="stat-badge">
                                <i class="fas fa-building"></i>
                                <span><?php echo e($totalCompanies); ?> Companies</span>
                            </div>
                            <div class="stat-badge">
                                <i class="fas fa-map-marker-alt"></i>
                                <span><?php echo e($totalLocations); ?> Locations</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-container">
                    <div class="jobs-scrollable-container" id="jobsScrollContainer">
                        <div class="table-responsive">
                            <table class="jobs-table">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="th-content">
                                                <i class="fas fa-hashtag"></i>
                                                <span>ID</span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="th-content">
                                                <i class="fas fa-briefcase"></i>
                                                <span>Job Details</span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="th-content">
                                                <i class="fas fa-building"></i>
                                                <span>Company</span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="th-content">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <span>Location</span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="th-content">
                                                <i class="fas fa-cogs"></i>
                                                <span>Actions</span>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="job-row">
                                        <td class="id-cell">
                                            <span class="job-id">#<?php echo e($job->id); ?></span>
                                        </td>
                                        <td class="job-cell">
                                            <div class="job-info">
                                                <div class="job-avatar">
                                                    <i class="fas fa-briefcase"></i>
                                                </div>
                                                <div class="job-details">
                                                    <h4 class="job-title"><?php echo e($job->title); ?></h4>
                                                    <p class="job-description">
                                                        <i class="fas fa-info-circle"></i>
                                                        <?php echo e(Str::limit($job->description ?? 'No description available', 50)); ?>

                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="company-cell">
                                            <div class="company-info">
                                                <span class="company-badge">
                                                    <i class="fas fa-building"></i>
                                                    <?php echo e($job->company); ?>

                                                </span>
                                            </div>
                                        </td>
                                        <td class="location-cell">
                                            <div class="location-info">
                                                <span class="location-badge">
                                                    <i class="fas fa-map-marker-alt"></i>
                                                    <?php echo e($job->location); ?>

                                                </span>
                                            </div>
                                        </td>
                                        <td class="actions-cell">
                                            <div class="action-buttons">
                                                <button type="button" class="btn btn-edit" onclick="window.location.href='<?php echo e(route('admin.jobs.edit', $job->id)); ?>'" title="Edit Job">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Edit</span>
                                                </button>
                                                <form action="<?php echo e(route('admin.jobs.delete', $job->id)); ?>" method="POST" class="delete-form">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-delete" title="Delete Job">
                                                        <i class="fas fa-trash"></i>
                                                        <span>Delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <?php if(count($jobs) == 0): ?>
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="empty-title">No Job Listings Found</h3>
                    <p class="empty-description">Start by creating your first job listing to attract talent to your platform</p>
                    <a href="<?php echo e(route('admin.jobs.create')); ?>" class="btn-empty-action">
                        <i class="fas fa-plus"></i>
                        <span>Create First Job</span>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
/* Professional Job Management System Styles */
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

/* Back Button Styles */
.back-button-container {
    text-align: center;
    margin: 2rem 0;
}

.back-button {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    backdrop-filter: blur(20px);
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    color: white;
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 600;
    transition: all var(--animation-speed) var(--animation-curve);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.back-button:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    color: white;
}

.back-button i {
    font-size: 0.875rem;
    transition: transform var(--animation-speed) var(--animation-curve);
}

.back-button:hover i {
    transform: translateX(-3px);
}

/* Professional Page Layout */
.jobs-management-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
    overflow-x: hidden;
}

.jobs-management-page::before {
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
.jobs-header-section {
    position: relative;
    z-index: 2;
    padding: 4rem 0 2rem;
    color: white;
}

.jobs-header-container {
    max-width: 1400px;
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
    max-width: 700px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

/* Content Wrapper */
.jobs-content-wrapper {
    position: relative;
    z-index: 2;
    background: var(--surface-light);
    border-radius: 40px 40px 0 0;
    margin-top: -1rem;
    padding: 3rem 0 2rem;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
}

.jobs-content-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
}

/* Quick Actions Section */
.quick-actions-section {
    margin-bottom: 3rem;
}

.action-card {
    background: var(--surface-white);
    border-radius: var(--border-radius);
    padding: 2rem;
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    display: flex;
    align-items: center;
    gap: 1.5rem;
    transition: all var(--animation-speed) var(--animation-curve);
    position: relative;
    overflow: hidden;
}

.action-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--primary-gradient);
}

.action-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-large);
}

.action-icon {
    width: 64px;
    height: 64px;
    background: var(--primary-gradient);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.action-content {
    flex: 1;
}

.action-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 0.5rem 0;
}

.action-description {
    color: var(--text-secondary);
    margin: 0;
    line-height: 1.5;
}

.action-button {
    width: 48px;
    height: 48px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    transition: all var(--animation-speed) var(--animation-curve);
}

.action-button:hover {
    transform: scale(1.1);
    color: white;
}

/* Table Card */
.table-card {
    background: var(--surface-white);
    border-radius: var(--border-radius-large);
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    overflow: hidden;
}

.table-header {
    background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
    padding: 2rem 2.5rem;
    border-bottom: 1px solid var(--border-light);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table-title-section {
    flex: 1;
}

.table-title {
    margin: 0 0 0.5rem 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.table-title i {
    color: var(--primary-color);
}

.table-subtitle {
    margin: 0;
    font-size: 0.875rem;
    color: var(--text-light);
}

.table-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.job-stats {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.stat-badge {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--surface-light);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    border: 1px solid var(--border-light);
    font-size: 0.875rem;
    color: var(--text-secondary);
    font-weight: 500;
}

/* Table Styles with Scrollable Container */
.table-container {
    padding: 2.5rem;
}

.jobs-scrollable-container {
    max-height: 600px;
    overflow-y: auto;
    border: 1px solid var(--border-light);
    border-radius: 16px;
    background: var(--surface-white);
}

.table-responsive {
    overflow-x: auto;
    border-radius: 16px;
    box-shadow: var(--shadow-subtle);
}

.jobs-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: var(--surface-white);
    min-width: 1000px;
}

.jobs-table thead {
    background: var(--primary-gradient);
    color: white;
    position: sticky;
    top: 0;
    z-index: 10;
}

.jobs-table th {
    padding: 1.5rem 1.25rem;
    text-align: left;
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border: none;
    position: relative;
}

.jobs-table th:first-child {
    border-radius: 16px 0 0 0;
}

.jobs-table th:last-child {
    border-radius: 0 16px 0 0;
}

.th-content {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.th-content i {
    font-size: 0.875rem;
}

.jobs-table td {
    padding: 1.25rem;
    border-bottom: 1px solid var(--border-light);
    vertical-align: middle;
    font-size: 0.95rem;
}

.job-row {
    transition: all var(--animation-speed) var(--animation-curve);
}

.job-row:hover {
    background: linear-gradient(135deg, var(--surface-light) 0%, rgba(37, 99, 235, 0.02) 100%);
}

.job-row:last-child td {
    border-bottom: none;
}

/* Cell Styles */
.id-cell {
    width: 80px;
}

.job-id {
    font-weight: 600;
    color: var(--text-light);
    font-size: 0.875rem;
}

.job-cell {
    min-width: 300px;
}

.job-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.job-avatar {
    width: 48px;
    height: 48px;
    background: var(--primary-gradient);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.125rem;
    flex-shrink: 0;
}

.job-details {
    flex: 1;
}

.job-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 0.25rem 0;
    line-height: 1.3;
}

.job-description {
    font-size: 0.875rem;
    color: var(--text-light);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.375rem;
}

.company-cell,
.location-cell {
    min-width: 150px;
}

.company-badge,
.location-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--surface-light);
    color: var(--text-secondary);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
    border: 1px solid var(--border-light);
}

.company-badge:hover,
.location-badge:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-1px);
}

.actions-cell {
    min-width: 100px;
    text-align: center;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
    align-items: stretch;
    min-width: 90px;
}

.delete-form {
    margin: 0;
    display: block;
    width: 100%;
}

.btn {
    padding: 0.4rem 0.6rem;
    border: none;
    cursor: pointer;
    border-radius: 6px;
    text-decoration: none;
    color: white;
    font-size: 0.7rem;
    font-weight: 600;
    transition: all var(--animation-speed) var(--animation-curve);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.3rem;
    width: 100%;
    min-height: 32px;
    box-sizing: border-box;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

.btn-edit {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.btn-edit:hover {
    background: linear-gradient(135deg, #d97706, #b45309);
}

.btn-delete {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

.btn-delete:hover {
    background: linear-gradient(135deg, #dc2626, #b91c1c);
}

.btn i {
    font-size: 0.7rem;
}

/* Custom Scrollbar Styling for Jobs Table */
.jobs-scrollable-container::-webkit-scrollbar {
    width: 8px;
}

.jobs-scrollable-container::-webkit-scrollbar-track {
    background: var(--surface-light);
    border-radius: 4px;
}

.jobs-scrollable-container::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    border-radius: 4px;
}

.jobs-scrollable-container::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, var(--primary-dark), var(--accent-dark));
}

/* Firefox Scrollbar Styling */
.jobs-scrollable-container {
    scrollbar-width: thin;
    scrollbar-color: var(--primary-color) var(--surface-light);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: var(--text-light);
}

.empty-icon {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    color: var(--text-light);
}

.empty-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: var(--text-secondary);
}

.empty-description {
    font-size: 1rem;
    margin-bottom: 2rem;
    line-height: 1.6;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.btn-empty-action {
    background: var(--primary-gradient);
    color: white;
    padding: 1rem 2rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all var(--animation-speed) var(--animation-curve);
}

.btn-empty-action:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-large);
    color: white;
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

.job-row {
    animation: fadeInUp 0.4s ease forwards;
}

.job-row:nth-child(1) { animation-delay: 0.1s; }
.job-row:nth-child(2) { animation-delay: 0.15s; }
.job-row:nth-child(3) { animation-delay: 0.2s; }
.job-row:nth-child(4) { animation-delay: 0.25s; }
.job-row:nth-child(5) { animation-delay: 0.3s; }

/* Responsive Design */
@media (max-width: 1200px) {
    .table-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .job-stats {
        width: 100%;
        justify-content: flex-start;
    }
    
    .jobs-scrollable-container {
        max-height: 500px;
    }
}

@media (max-width: 768px) {
    .back-button-container {
        margin: 1.5rem 0;
    }
    
    .back-button {
        padding: 0.625rem 1.25rem;
        font-size: 0.8rem;
    }
    
    .jobs-content-wrapper {
        border-radius: 20px 20px 0 0;
        padding: 2rem 0 1rem;
    }

    .jobs-content-container {
        padding: 0 1rem;
    }

    .table-container {
        padding: 1.5rem;
    }

    .action-buttons {
        gap: 0.25rem;
        min-width: 80px;
    }

    .btn {
        padding: 0.35rem 0.5rem;
        font-size: 0.65rem;
        min-height: 28px;
    }

    .jobs-table {
        min-width: 800px;
    }

    .jobs-table th,
    .jobs-table td {
        padding: 1rem 0.75rem;
    }
    
    .jobs-scrollable-container {
        max-height: 400px;
    }
}

@media (max-width: 480px) {
    .back-button {
        width: 100%;
        justify-content: center;
        max-width: 200px;
    }
    
    .jobs-header-section {
        padding: 2rem 0 1rem;
    }

    .jobs-header-container {
        padding: 0 1rem;
    }

    .header-title {
        font-size: 2rem;
    }

    .action-card {
        padding: 1.5rem;
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }

    .jobs-table {
        min-width: 700px;
    }

    .jobs-table th,
    .jobs-table td {
        padding: 0.75rem 0.5rem;
    }
    
    .jobs-scrollable-container {
        max-height: 350px;
        padding: 0.75rem;
    }
}

/* Focus States for Accessibility */
.action-button:focus,
.btn:focus {
    outline: 3px solid rgba(37, 99, 235, 0.5);
    outline-offset: 2px;
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

/* High Contrast Mode Support */
@media (prefers-contrast: high) {
    .table-card,
    .action-card {
        border-width: 2px;
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

/* Success Animation */
.success-flash {
    animation: successPulse 0.6s ease;
}

@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
}

/* Professional Scrollbar Styling */
.table-responsive::-webkit-scrollbar {
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background: var(--surface-light);
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: var(--primary-color);
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: var(--primary-dark);
}

/* Interactive Elements Enhancement */
.job-row:hover .job-title {
    color: var(--primary-color);
}

.job-row:hover .job-avatar {
    transform: scale(1.05);
}
</style>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Enhanced JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced table row animations
    const tableRows = document.querySelectorAll('.job-row');
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            row.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, index * 75);

        // Enhanced hover effect
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
            this.style.boxShadow = '0 8px 25px rgba(0, 0, 0, 0.1)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    });

    // Enhanced button interactions
    const buttons = document.querySelectorAll('.btn, .action-button');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px) scale(1.05)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });

        // Add ripple effect on click
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Enhanced delete confirmation
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const jobTitle = this.closest('.job-row').querySelector('.job-title').textContent;
            const confirmation = confirm(`Are you sure you want to delete the job listing "${jobTitle}"? This action cannot be undone.`);
            
            if (confirmation) {
                // Add loading state
                const deleteBtn = this.querySelector('.btn-delete');
                deleteBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Deleting...</span>';
                deleteBtn.style.pointerEvents = 'none';
                
                // Submit form
                this.submit();
            }
        });
    });

    // Action card interactions
    const actionCards = document.querySelectorAll('.action-card');
    actionCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });

    // Badge interactions
    const badges = document.querySelectorAll('.company-badge, .location-badge');
    badges.forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05) translateY(-1px)';
        });
        
        badge.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });

    // Job avatar interactions
    const jobAvatars = document.querySelectorAll('.job-avatar');
    jobAvatars.forEach(avatar => {
        avatar.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1) rotate(5deg)';
        });
        
        avatar.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });

    // Success flash animation for page actions
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success')) {
        const tableCard = document.querySelector('.table-card');
        if (tableCard) {
            tableCard.classList.add('success-flash');
        }
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        // Quick navigation to add job with 'n' key
        if (e.key === 'n' && !e.ctrlKey && !e.metaKey && e.target.tagName !== 'INPUT') {
            e.preventDefault();
            const addButton = document.querySelector('.action-button');
            if (addButton) {
                addButton.click();
            }
        }
    });

    // Initialize tooltips for action buttons
    const actionButtons = document.querySelectorAll('.btn');
    actionButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            const btnText = this.querySelector('span').textContent;
            const jobTitle = this.closest('.job-row').querySelector('.job-title').textContent;
            this.title = `${btnText} "${jobTitle}"`;
        });
    });

    // Lazy loading for job content
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '50px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const badges = entry.target.querySelectorAll('.company-badge, .location-badge');
                badges.forEach((badge, index) => {
                    setTimeout(() => {
                        badge.style.animation = 'fadeInUp 0.4s ease forwards';
                    }, index * 100);
                });
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.company-cell, .location-cell').forEach(cell => {
        observer.observe(cell);
    });

    // Statistics counter animation
    const statBadges = document.querySelectorAll('.stat-badge');
    statBadges.forEach((badge, index) => {
        badge.style.opacity = '0';
        badge.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            badge.style.transition = 'all 0.4s ease';
            badge.style.opacity = '1';
            badge.style.transform = 'translateY(0)';
        }, 200 + (index * 100));
    });

    // Smooth scrolling for scrollable container
    const scrollableContainer = document.getElementById('jobsScrollContainer');
    if (scrollableContainer) {
        scrollableContainer.style.scrollBehavior = 'smooth';
    }

    console.log('🚀 Professional Job Management with Scrollable Table loaded successfully!');
});

// Add CSS for ripple effect
const rippleStyle = document.createElement('style');
rippleStyle.textContent = `
    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(rippleStyle);
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Desktop\SkillHubProject\resources\views/admin/jobs/index.blade.php ENDPATH**/ ?>