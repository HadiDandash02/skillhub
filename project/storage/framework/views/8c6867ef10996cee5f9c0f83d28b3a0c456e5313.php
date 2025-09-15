

<?php $__env->startSection('content'); ?>
<div class="course-index-page">
    <!-- Professional Header Section -->
    <section class="index-header-section">
        <div class="index-header-container">
            <h1 class="index-page-title">Manage Courses</h1>
            <p class="index-subtitle">
                Create, edit, and manage your educational content with our professional course management system
            </p>
        </div>
    </section>

    <!-- Professional Content Wrapper -->
    <div class="index-content-wrapper">
        <div class="index-content-container">
            
            <!-- Search and Management Controls -->
            <div class="management-controls">
                <div class="search-section">
                    <div class="search-container">
                        <div class="search-input-wrapper">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" id="searchInput" class="search-input" placeholder="Search courses by title or category...">
                        </div>
                    </div>
                </div>

                <div class="filter-section">
                    <form method="GET" action="<?php echo e(route('instructor.courses')); ?>" class="difficulty-filter-form">
                        <div class="filter-container">
                            <div class="filter-input-wrapper">
                                <i class="fas fa-filter filter-icon"></i>
                                <select name="difficulty" class="difficulty-select">
                                    <option value="all">All Difficulties</option>
                                    <option value="Beginner" <?php echo e(request('difficulty') == 'Beginner' ? 'selected' : ''); ?>>Beginner</option>
                                    <option value="Intermediate" <?php echo e(request('difficulty') == 'Intermediate' ? 'selected' : ''); ?>>Intermediate</option>
                                    <option value="Advanced" <?php echo e(request('difficulty') == 'Advanced' ? 'selected' : ''); ?>>Advanced</option>
                                </select>
                            </div>
                            <button type="submit" class="filter-btn">
                                <i class="fas fa-search"></i>
                                <span>Apply Filter</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Professional Table Container -->
            <div class="professional-table-container professional-fade-in">
                <div class="table-header">
                    <div class="table-title-section">
                        <h2 class="table-title">
                            <i class="fas fa-graduation-cap"></i>
                            Course Overview
                        </h2>
                        <p class="table-subtitle">Manage your educational content</p>
                    </div>
                    <div class="table-actions">
                        <a href="<?php echo e(route('instructor.courses.create')); ?>" class="btn-add-course">
                            <i class="fas fa-plus"></i>
                            <span>Add New Course</span>
                        </a>
                        <div class="table-stats">
                            <i class="fas fa-chart-bar"></i>
                            <span id="courseCount"><?php echo e(count($courses)); ?> Total Courses</span>
                        </div>
                    </div>
                </div>
                
                <div class="table-container">
                    <div class="courses-scrollable-container" id="coursesScrollContainer">
                        <div class="professional-table-responsive">
                            <table class="professional-table">
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
                                                <i class="fas fa-book"></i>
                                                <span>Title</span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="th-content">
                                                <i class="fas fa-tags"></i>
                                                <span>Category</span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="th-content">
                                                <i class="fas fa-chart-line"></i>
                                                <span>Difficulty</span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="th-content">
                                                <i class="fas fa-list"></i>
                                                <span>Chapters</span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="th-content">
                                                <i class="fas fa-brain"></i>
                                                <span>Quizzes</span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="th-content">
                                                <i class="fas fa-trophy"></i>
                                                <span>Challenges</span>
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
                                <tbody id="courseTableBody">
                                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="course-row">
                                        <td class="id-cell">
                                            <span class="course-id">#<?php echo e($course->id); ?></span>
                                        </td>
                                        <td class="title-cell">
                                            <span class="course-title"><?php echo e($course->title); ?></span>
                                        </td>
                                        <td class="category-cell">
                                            <span class="course-category"><?php echo e($course->category); ?></span>
                                        </td>
                                        <td class="difficulty-cell">
                                            <span class="difficulty-badge difficulty-<?php echo e(strtolower($course->difficulty)); ?>">
                                                <i class="fas fa-<?php echo e($course->difficulty === 'Beginner' ? 'leaf' : ($course->difficulty === 'Intermediate' ? 'star' : 'fire')); ?>"></i>
                                                <?php echo e($course->difficulty); ?>

                                            </span>
                                        </td>
                                        <td class="count-cell">
                                            <span class="professional-count-badge"><?php echo e($course->chapters->count()); ?></span>
                                        </td>
                                        <td class="count-cell">
                                            <span class="professional-count-badge"><?php echo e($course->quizzes->count()); ?></span>
                                        </td>
                                        <td class="count-cell">
                                            <span class="professional-count-badge"><?php echo e($course->challenges->count()); ?></span>
                                        </td>
                                        <td class="actions-cell">
                                            <div class="action-buttons-container">
                                                <a href="<?php echo e(route('instructor.courses.edit', $course->id)); ?>" class="btn-professional btn-edit">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="<?php echo e(route('instructor.courses.delete', $course->id)); ?>" method="POST" class="professional-inline-form">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn-professional btn-delete" onclick="return confirm('Are you sure?')">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </form>
                                                <a href="<?php echo e(route('courses.show', $course->id)); ?>" class="btn-professional btn-view">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* =======================================================
   COMPLETE PROFESSIONAL COURSE MANAGEMENT SYSTEM STYLES
   ======================================================= */

:root {
    /* Primary Color Scheme - Consistent with other blades */
    --primary-color: #2563eb;
    --primary-dark: #1d4ed8;
    --primary-light: #3b82f6;
    --accent-color: #10b981;
    --accent-dark: #059669;
    
    /* Professional gradients */
    --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
    --secondary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --danger-gradient: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
    
    /* Glass morphism effects */
    --glass-bg: rgba(255, 255, 255, 0.1);
    --glass-border: rgba(255, 255, 255, 0.2);
    --dark-glass: rgba(0, 0, 0, 0.1);
    
    /* Text colors */
    --text-primary: #1a202c;
    --text-secondary: #4a5568;
    --text-light: #718096;
    --text-white: #ffffff;
    
    /* Surface colors */
    --surface-white: #ffffff;
    --surface-light: #f7fafc;
    --surface-gray: #edf2f7;
    --surface-dark: #2d3748;
    --border-light: rgba(0, 0, 0, 0.06);
    --border-medium: rgba(0, 0, 0, 0.12);
    
    /* Shadows */
    --shadow-subtle: 0 1px 3px rgba(0, 0, 0, 0.05);
    --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
    --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 25px rgba(0, 0, 0, 0.1);
    --shadow-premium: 0 25px 50px rgba(0, 0, 0, 0.15);
    
    /* Border radius */
    --border-radius: 16px;
    --border-radius-lg: 20px;
    --border-radius-xl: 24px;
    
    /* Animation */
    --animation-speed: 0.3s;
    --animation-curve: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Professional Page Layout for Index */
.course-index-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
    overflow-x: hidden;
}

.course-index-page::before {
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

/* Professional Header Section for Index */
.index-header-section {
    position: relative;
    z-index: 2;
    padding: 4rem 0 2rem;
    color: white;
    text-align: center;
}

.index-header-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.index-page-title {
    font-size: clamp(2.5rem, 4vw, 3.5rem);
    font-weight: 800;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, #ffffff 0%, #f0f8ff 100%);
    background-clip: text;
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
}

.index-subtitle {
    font-size: 1.25rem;
    opacity: 0.9;
    max-width: 600px;
    margin: 0 auto 2rem;
    line-height: 1.6;
}

/* Professional Content Wrapper for Index */
.index-content-wrapper {
    position: relative;
    z-index: 2;
    background: var(--surface-light);
    border-radius: 40px 40px 0 0;
    margin-top: -1rem;
    padding: 3rem 0 2rem;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
    min-height: 60vh;
}

.index-content-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
}

/* Management Controls */
.management-controls {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    margin-bottom: 3rem;
}

.search-section,
.filter-section {
    background: var(--surface-white);
    border-radius: var(--border-radius);
    padding: 2rem;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
}

.search-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.search-input-wrapper {
    position: relative;
}

.search-icon {
    position: absolute;
    left: 1.25rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-light);
    font-size: 1rem;
    z-index: 2;
}

.search-input {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid var(--border-light);
    border-radius: 12px;
    font-size: 1rem;
    transition: all var(--animation-speed) var(--animation-curve);
    background: var(--surface-white);
    color: var(--text-primary);
    box-sizing: border-box;
}

.search-input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    transform: translateY(-1px);
}

.search-input::placeholder {
    color: var(--text-light);
}

.difficulty-filter-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.filter-container {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.filter-input-wrapper {
    position: relative;
}

.filter-icon {
    position: absolute;
    left: 1.25rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-light);
    font-size: 1rem;
    z-index: 2;
}

.difficulty-select {
    width: 100%;
    padding: 1rem 1rem 1rem 3rem;
    border: 2px solid var(--border-light);
    border-radius: 12px;
    font-size: 1rem;
    background: var(--surface-white);
    color: var(--text-primary);
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    box-sizing: border-box;
}

.difficulty-select:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.filter-btn {
    padding: 1rem 1.5rem;
    background: var(--primary-gradient);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.filter-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

/* Premium Table Container */
.professional-table-container {
    background: var(--surface-white);
    border-radius: var(--border-radius-xl);
    box-shadow: var(--shadow-premium);
    border: 1px solid var(--border-light);
    overflow: hidden;
    margin-bottom: 2rem;
}

.table-header {
    background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
    padding: 2rem 2.5rem;
    border-bottom: 1px solid var(--border-light);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.table-title-section {
    flex: 1;
}

.table-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin: 0 0 0.5rem 0;
}

.table-title i {
    color: var(--primary-color);
    font-size: 1.25rem;
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
    flex-wrap: wrap;
}

.table-stats {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
    color: var(--text-light);
    padding: 0.5rem 1rem;
    background: var(--surface-light);
    border-radius: 50px;
}

/* Table Styles with Scrollable Container */
.table-container {
    padding: 2.5rem;
}

.courses-scrollable-container {
    max-height: 600px;
    overflow-y: auto;
    border: 1px solid var(--border-light);
    border-radius: 16px;
    background: var(--surface-white);
    box-shadow: var(--shadow-lg);
}

/* Professional Table Styling */
.professional-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: var(--surface-white);
    min-width: 1000px;
}

.professional-table thead {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    color: white;
    position: sticky;
    top: 0;
    z-index: 10;
}

.professional-table th {
    padding: 1.5rem 1rem;
    text-align: center;
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border: none;
    position: relative;
}

.professional-table th:first-child {
    border-radius: 16px 0 0 0;
}

.professional-table th:last-child {
    border-radius: 0 16px 0 0;
}

.th-content {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    justify-content: center;
}

.th-content i {
    font-size: 0.875rem;
}

.professional-table td {
    padding: 1.25rem 1rem;
    text-align: center;
    border-bottom: 1px solid var(--border-light);
    vertical-align: middle;
    font-size: 0.95rem;
    color: var(--text-secondary);
}

.course-row {
    transition: all var(--animation-speed) var(--animation-curve);
}

.course-row:hover {
    background: linear-gradient(135deg, var(--surface-light) 0%, rgba(37, 99, 235, 0.02) 100%);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

.course-row:last-child td {
    border-bottom: none;
}

/* Cell Styles */
.id-cell {
    width: 80px;
}

.course-id {
    font-weight: 600;
    color: var(--text-light);
    font-size: 0.875rem;
}

.title-cell {
    min-width: 200px;
    text-align: left;
}

.course-title {
    font-weight: 600;
    color: var(--text-primary);
}

.category-cell {
    min-width: 150px;
}

.course-category {
    color: var(--text-secondary);
}

.difficulty-cell {
    min-width: 140px;
}

.count-cell {
    width: 100px;
}

.actions-cell {
    min-width: 250px;
}

/* Professional Difficulty Badges */
.difficulty-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: capitalize;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    min-width: 90px;
    justify-content: center;
}

.difficulty-beginner {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
}

.difficulty-intermediate {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
}

.difficulty-advanced {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
}

/* Professional Action Buttons */
.action-buttons-container {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
    flex-wrap: wrap;
    align-items: center;
}

.btn-professional {
    padding: 0.6rem 1rem;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 0.8rem;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    min-width: 80px;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.btn-professional::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s ease;
}

.btn-professional:hover::before {
    left: 100%;
}

.btn-professional:hover {
    transform: translateY(-2px);
}

.btn-edit {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
}

.btn-edit:hover {
    background: linear-gradient(135deg, #d97706, #b45309);
    box-shadow: 0 4px 16px rgba(245, 158, 11, 0.4);
}

.btn-delete {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
    padding: 0.8rem;
}

.btn-delete:hover {
    background: linear-gradient(135deg, #dc2626, #b91c1c);
    box-shadow: 0 4px 16px rgba(239, 68, 68, 0.4);
}

.btn-view {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    color: white;
    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.3);
}

.btn-view:hover {
    background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
    box-shadow: 0 4px 16px rgba(37, 99, 235, 0.4);
}

/* Add Course Button */
.btn-add-course {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    color: white;
    padding: 1rem 2rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 700;
    font-size: 1.1rem;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: all var(--animation-speed) var(--animation-curve);
    box-shadow: var(--shadow-lg);
    border: none;
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.btn-add-course::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.6s ease;
}

.btn-add-course:hover::before {
    left: 100%;
}

.btn-add-course:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-premium);
}

/* Professional Badge Styling for Counts */
.professional-count-badge {
    background: var(--primary-gradient);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 24px;
    height: 24px;
}

.professional-table-responsive {
    width: 100%;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    margin-bottom: 1rem;
    border-radius: var(--border-radius-xl);
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--border-light);
    background: var(--surface-white);
}

/* Professional Scrollbar Styling for Course Table */
.courses-scrollable-container::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.courses-scrollable-container::-webkit-scrollbar-track {
    background: var(--surface-light);
    border-radius: 4px;
}

.courses-scrollable-container::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    border-radius: 4px;
}

.courses-scrollable-container::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, var(--primary-dark), var(--accent-dark));
}

.courses-scrollable-container::-webkit-scrollbar-corner {
    background: var(--surface-light);
}

/* Firefox Scrollbar Support */
.courses-scrollable-container {
    scrollbar-width: thin;
    scrollbar-color: var(--primary-color) var(--surface-light);
}

/* Professional Animation Classes */
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

.professional-fade-in {
    animation: fadeInUp 0.6s ease forwards;
}

/* Professional Inline Form Styling */
.professional-inline-form {
    display: inline-block;
    margin: 0;
}

/* Professional Responsive Design */
@media (max-width: 1200px) {
    .management-controls {
        grid-template-columns: 1fr;
    }
    
    .courses-scrollable-container {
        max-height: 500px;
    }
}

@media (max-width: 768px) {
    .index-content-wrapper {
        border-radius: 20px 20px 0 0;
        padding: 2rem 0 1rem;
    }

    .index-content-container {
        padding: 0 1rem;
    }

    .action-buttons-container {
        flex-direction: column;
        gap: 0.5rem;
    }

    .btn-professional {
        width: 100%;
        min-width: auto;
    }

    .table-header {
        padding: 1.5rem;
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .table-container {
        padding: 1.5rem;
    }

    .professional-table {
        font-size: 0.875rem;
        min-width: 800px;
        white-space: nowrap;
    }

    .professional-table th,
    .professional-table td {
        padding: 1rem 0.75rem;
    }

    .professional-table-responsive {
        border-radius: var(--border-radius);
    }
    
    .courses-scrollable-container {
        max-height: 400px;
    }

    .search-section,
    .filter-section {
        padding: 1.5rem;
    }
}

@media (max-width: 480px) {
    .index-header-section {
        padding: 2rem 0 1rem;
    }

    .index-header-container {
        padding: 0 1rem;
    }

    .index-page-title {
        font-size: 2rem;
    }

    .professional-table {
        min-width: 700px;
    }

    .professional-table th,
    .professional-table td {
        padding: 0.75rem 0.5rem;
    }
    
    .courses-scrollable-container {
        max-height: 350px;
    }

    .search-section,
    .filter-section {
        padding: 1rem;
    }
}

/* Focus States for Accessibility */
.search-input:focus,
.difficulty-select:focus,
.filter-btn:focus,
.btn-professional:focus,
.btn-add-course:focus {
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
    .professional-table-container,
    .search-section,
    .filter-section {
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
</style>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Professional Course Management with Search loaded');
    
    // Enhanced search functionality
    const searchInput = document.getElementById("searchInput");
    const courseRows = document.querySelectorAll("#courseTableBody .course-row");
    const courseCountElement = document.getElementById("courseCount");
    const originalCount = courseCountElement.textContent;
    
    if (searchInput) {
        searchInput.addEventListener("keyup", function() {
            const searchText = this.value.toLowerCase().trim();
            let visibleCount = 0;
            
            courseRows.forEach(row => {
                const titleCell = row.querySelector('.course-title');
                const categoryCell = row.querySelector('.course-category');
                
                if (titleCell && categoryCell) {
                    const title = titleCell.textContent.toLowerCase();
                    const category = categoryCell.textContent.toLowerCase();
                    
                    if (title.includes(searchText) || category.includes(searchText)) {
                        row.style.display = "";
                        visibleCount++;
                        // Add search highlight animation
                        row.style.animation = 'fadeInUp 0.3s ease forwards';
                    } else {
                        row.style.display = "none";
                    }
                }
            });
            
            // Update course count
            if (courseCountElement) {
                const newText = searchText ? 
                    `Found: ${visibleCount} courses` : 
                    originalCount;
                courseCountElement.innerHTML = `<i class="fas fa-chart-bar"></i> ${newText}`;
            }
        });
    }

    // Enhanced table row animations on load
    courseRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        row.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
        
        setTimeout(() => {
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, index * 100);
    });
    
    // Professional button interactions
    const buttons = document.querySelectorAll('.btn-professional, .btn-add-course, .filter-btn');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px) scale(1.02)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
        
        button.addEventListener('click', function(e) {
            // Add ripple effect
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
    
    // Enhanced delete confirmations
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const courseTitle = this.closest('.course-row').querySelector('.course-title').textContent;
            const confirmation = confirm(`Are you sure you want to delete the course "${courseTitle}"? This action cannot be undone.`);
            
            if (confirmation) {
                // Add loading state
                this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Deleting...';
                this.style.pointerEvents = 'none';
                
                // Submit form
                this.closest('form').submit();
            }
        });
    });

    // Enhanced form interactions
    const formInputs = document.querySelectorAll('.search-input, .difficulty-select');
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.closest('.search-input-wrapper, .filter-input-wrapper').style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.closest('.search-input-wrapper, .filter-input-wrapper').style.transform = '';
        });
    });

    // Difficulty badge interactions
    const difficultyBadges = document.querySelectorAll('.difficulty-badge');
    difficultyBadges.forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.2)';
        });
        
        badge.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = this.style.boxShadow.replace('0 4px 15px rgba(0, 0, 0, 0.2)', '');
        });
    });

    // Auto-refresh search results
    let searchTimeout;
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                // Trigger search after 300ms of no typing
                const event = new Event('keyup');
                this.dispatchEvent(event);
            }, 300);
        });
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        // Quick search with '/' key
        if (e.key === '/' && !e.ctrlKey && !e.metaKey) {
            e.preventDefault();
            if (searchInput) {
                searchInput.focus();
            }
        }
        
        // Clear search with 'Escape' key
        if (e.key === 'Escape' && searchInput === document.activeElement) {
            searchInput.value = '';
            const event = new Event('keyup');
            searchInput.dispatchEvent(event);
            searchInput.blur();
        }
    });

    // Success flash animation for actions
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('success')) {
        const tableContainer = document.querySelector('.professional-table-container');
        if (tableContainer) {
            tableContainer.style.animation = 'successPulse 0.6s ease';
        }
    }

    // Initialize tooltips for action buttons
    const actionButtons = document.querySelectorAll('.btn-professional');
    actionButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            const btnText = this.textContent.trim();
            this.title = `${btnText} this course`;
        });
    });

    // Smooth scrolling for scrollable container
    const scrollableContainer = document.getElementById('coursesScrollContainer');
    if (scrollableContainer) {
        scrollableContainer.style.scrollBehavior = 'smooth';
    }

    // Enhanced table row hover effects
    courseRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    });

    // Count badge animations
    const countBadges = document.querySelectorAll('.professional-count-badge');
    countBadges.forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
        });
        
        badge.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });

    // Filter form enhancement
    const filterForm = document.querySelector('.difficulty-filter-form');
    if (filterForm) {
        filterForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.filter-btn');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Applying...</span>';
            submitBtn.style.pointerEvents = 'none';
        });
    }

    console.log('✨ Professional Course Management with Search fully initialized!');
});

// CSS for ripple effect and animations
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
    
    @keyframes successPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.02); }
        100% { transform: scale(1); }
    }
    
    .success-flash {
        animation: successPulse 0.6s ease;
    }
`;
document.head.appendChild(rippleStyle);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ACER NITRO\Desktop\SkillHubProject\resources\views/instructor/courses/index.blade.php ENDPATH**/ ?>