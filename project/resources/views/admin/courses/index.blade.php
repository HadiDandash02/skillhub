@extends('layouts.app')

@section('content')
<div class="courses-management-page">
    <!-- Professional Header Section -->
    <section class="courses-header-section">
        <div class="courses-header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Course Management</span>
                </div>
                <h1 class="header-title">Manage Courses</h1>
                <p class="header-description">Create, edit, and manage your educational content with our comprehensive course management system</p>
                
                <!-- Back Button - Now under description -->
                <div class="back-button-container">
                    <a href="{{ route('admin.dashboard') }}" class="back-button">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Dashboard</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Wrapper -->
    <div class="courses-content-wrapper">
        <div class="courses-content-container">
            
            <!-- Quick Actions Section -->
            <div class="quick-actions-section">
                <div class="action-card primary-action">
                    <div class="action-icon">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="action-content">
                        <h3 class="action-title">Create New Course</h3>
                        <p class="action-description">Start building your next educational masterpiece</p>
                    </div>
                    <a href="{{ route('admin.courses.create') }}" class="action-button">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

            <!-- Courses Table Card -->
            <div class="table-card">
                <div class="table-header">
                    <div class="table-title-section">
                        <h3 class="table-title">
                            <i class="fas fa-graduation-cap"></i>
                            Course Overview
                        </h3>
                        <p class="table-subtitle">Manage and monitor all educational content</p>
                    </div>
                    <div class="table-actions">
                        <div class="course-stats">
                            @php
                                $totalChapters = $courses->sum(function($course) { return $course->chapters->count(); });
                                $totalQuizzes = $courses->sum(function($course) { return $course->quizzes->count(); });
                                $totalChallenges = $courses->sum(function($course) { return $course->challenges->count(); });
                            @endphp
                            <div class="stat-badge">
                                <i class="fas fa-list"></i>
                                <span>{{ $totalChapters }} Chapters</span>
                            </div>
                            <div class="stat-badge">
                                <i class="fas fa-brain"></i>
                                <span>{{ $totalQuizzes }} Quizzes</span>
                            </div>
                            <div class="stat-badge">
                                <i class="fas fa-trophy"></i>
                                <span>{{ $totalChallenges }} Challenges</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-container">
                    <div class="courses-scrollable-container" id="coursesScrollContainer">
                        <div class="table-responsive">
                            <table class="courses-table">
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
                                                <span>Course Details</span>
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
                                                <i class="fas fa-layer-group"></i>
                                                <span>Content</span>
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
                                    @foreach($courses as $course)
                                    <tr class="course-row">
                                        <td class="id-cell">
                                            <span class="course-id">#{{ $course->id }}</span>
                                        </td>
                                        <td class="course-cell">
                                            <div class="course-info">
                                                <div class="course-avatar">
                                                    <i class="fas fa-graduation-cap"></i>
                                                </div>
                                                <div class="course-details">
                                                    <h4 class="course-title">{{ $course->title }}</h4>
                                                    <p class="course-instructor">
                                                        <i class="fas fa-user-tie"></i>
                                                        {{ $course->instructor ?? 'Not specified' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="category-cell">
                                            <span class="category-badge">
                                                <i class="fas fa-tag"></i>
                                                {{ $course->category }}
                                            </span>
                                        </td>
                                        <td class="difficulty-cell">
                                            @php
                                                $difficultyLower = strtolower($course->difficulty ?? 'beginner');
                                                $difficultyIcon = $course->difficulty === 'Beginner' ? 'leaf' : ($course->difficulty === 'Intermediate' ? 'star' : 'fire');
                                            @endphp
                                            <span class="difficulty-badge difficulty-{{ $difficultyLower }}">
                                                <i class="fas fa-{{ $difficultyIcon }}"></i>
                                                <span>{{ $course->difficulty ?? 'Beginner' }}</span>
                                            </span>
                                        </td>
                                        <td class="content-cell">
                                            <div class="content-metrics">
                                                <div class="metric-item">
                                                    <span class="metric-badge chapters">
                                                        <i class="fas fa-list"></i>
                                                        {{ $course->chapters->count() }}
                                                    </span>
                                                    <small>Chapters</small>
                                                </div>
                                                <div class="metric-item">
                                                    <span class="metric-badge quizzes">
                                                        <i class="fas fa-brain"></i>
                                                        {{ $course->quizzes->count() }}
                                                    </span>
                                                    <small>Quizzes</small>
                                                </div>
                                                <div class="metric-item">
                                                    <span class="metric-badge challenges">
                                                        <i class="fas fa-trophy"></i>
                                                        {{ $course->challenges->count() }}
                                                    </span>
                                                    <small>Challenges</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="actions-cell">
                                            <div class="action-buttons">
                                                <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-edit" title="Edit Course">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Edit</span>
                                                </a>
                                                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-view" title="View Course">
                                                    <i class="fas fa-eye"></i>
                                                    <span>View</span>
                                                </a>
                                                <form action="{{ route('admin.courses.delete', $course->id) }}" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-delete" title="Delete Course">
                                                        <i class="fas fa-trash"></i>
                                                        <span>Delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
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
/* Professional Course Management System Styles */
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
.courses-management-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
    overflow-x: hidden;
}

.courses-management-page::before {
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
.courses-header-section {
    position: relative;
    z-index: 2;
    padding: 4rem 0 2rem;
    color: white;
}

.courses-header-container {
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
.courses-content-wrapper {
    position: relative;
    z-index: 2;
    background: var(--surface-light);
    border-radius: 40px 40px 0 0;
    margin-top: -1rem;
    padding: 3rem 0 2rem;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
}

.courses-content-container {
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

.course-stats {
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

.courses-scrollable-container {
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

.courses-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: var(--surface-white);
    min-width: 1000px;
}

.courses-table thead {
    background: var(--primary-gradient);
    color: white;
    position: sticky;
    top: 0;
    z-index: 10;
}

.courses-table th {
    padding: 1.5rem 1.25rem;
    text-align: left;
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border: none;
    position: relative;
}

.courses-table th:first-child {
    border-radius: 16px 0 0 0;
}

.courses-table th:last-child {
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

.courses-table td {
    padding: 1.25rem;
    border-bottom: 1px solid var(--border-light);
    vertical-align: middle;
    font-size: 0.95rem;
}

.course-row {
    transition: all var(--animation-speed) var(--animation-curve);
}

.course-row:hover {
    background: linear-gradient(135deg, var(--surface-light) 0%, rgba(37, 99, 235, 0.02) 100%);
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

.course-cell {
    min-width: 300px;
}

.course-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.course-avatar {
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

.course-details {
    flex: 1;
}

.course-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 0.25rem 0;
    line-height: 1.3;
}

.course-instructor {
    font-size: 0.875rem;
    color: var(--text-light);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.375rem;
}

.category-cell {
    min-width: 120px;
}

.category-badge {
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

.difficulty-cell {
    min-width: 130px;
    text-align: center;
}

/* Difficulty Badges */
.difficulty-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: capitalize;
    min-width: 110px;
    justify-content: center;
    box-shadow: var(--shadow-subtle);
}

.difficulty-beginner {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.difficulty-intermediate {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
}

.difficulty-advanced {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

.content-cell {
    min-width: 200px;
}

.content-metrics {
    display: flex;
    gap: 0.75rem;
    flex-wrap: wrap;
}

.metric-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.25rem;
}

.metric-badge {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.25rem 0.5rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
    min-width: 32px;
    justify-content: center;
}

.metric-badge.chapters {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
}

.metric-badge.quizzes {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.metric-badge.challenges {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
}

.metric-item small {
    font-size: 0.7rem;
    color: var(--text-light);
    text-align: center;
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

.btn-view {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
}

.btn-view:hover {
    background: linear-gradient(135deg, #1d4ed8, #1e40af);
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

/* Custom Scrollbar Styling for Courses Table */
.courses-scrollable-container::-webkit-scrollbar {
    width: 8px;
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

/* Firefox Scrollbar Styling */
.courses-scrollable-container {
    scrollbar-width: thin;
    scrollbar-color: var(--primary-color) var(--surface-light);
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

.course-row {
    animation: fadeInUp 0.4s ease forwards;
}

.course-row:nth-child(1) { animation-delay: 0.1s; }
.course-row:nth-child(2) { animation-delay: 0.15s; }
.course-row:nth-child(3) { animation-delay: 0.2s; }
.course-row:nth-child(4) { animation-delay: 0.25s; }
.course-row:nth-child(5) { animation-delay: 0.3s; }

/* Responsive Design */
@media (max-width: 1200px) {
    .table-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .course-stats {
        width: 100%;
        justify-content: flex-start;
    }
    
    .courses-scrollable-container {
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
    
    .courses-content-wrapper {
        border-radius: 20px 20px 0 0;
        padding: 2rem 0 1rem;
    }

    .courses-content-container {
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

    .courses-table {
        min-width: 900px;
    }

    .courses-table th,
    .courses-table td {
        padding: 1rem 0.75rem;
    }

    .content-metrics {
        flex-direction: column;
        gap: 0.5rem;
    }

    .metric-item {
        flex-direction: row;
        justify-content: space-between;
        width: 100%;
    }
    
    .courses-scrollable-container {
        max-height: 400px;
    }
}

@media (max-width: 480px) {
    .back-button {
        width: 100%;
        justify-content: center;
        max-width: 200px;
    }
    
    .courses-header-section {
        padding: 2rem 0 1rem;
    }

    .courses-header-container {
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

    .courses-table {
        min-width: 800px;
    }

    .courses-table th,
    .courses-table td {
        padding: 0.75rem 0.5rem;
    }
    
    .courses-scrollable-container {
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

/* Enhanced Visual Hierarchy */
.action-card:nth-child(1) {
    animation: fadeInUp 0.6s ease forwards;
    animation-delay: 0.1s;
}

.table-card {
    animation: fadeInUp 0.6s ease forwards;
    animation-delay: 0.2s;
}

/* Professional Scrollbar Styling for Table Container */
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
.course-row:hover .course-title {
    color: var(--primary-color);
}

.course-row:hover .course-avatar {
    transform: scale(1.05);
}

.metric-badge:hover {
    transform: scale(1.05);
}

.difficulty-badge:hover {
    transform: scale(1.05);
}

.category-badge:hover {
    background: var(--primary-color);
    color: white;
}
</style>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Enhanced JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced table row animations
    const tableRows = document.querySelectorAll('.course-row');
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
            
            const courseTitle = this.closest('.course-row').querySelector('.course-title').textContent;
            const confirmation = confirm(`Are you sure you want to delete the course "${courseTitle}"? This action cannot be undone and will remove all associated content.`);
            
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

    // Metric badge interactions
    const metricBadges = document.querySelectorAll('.metric-badge, .difficulty-badge, .category-badge');
    metricBadges.forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
            this.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.2)';
        });
        
        badge.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    });

    // Course avatar interactions
    const courseAvatars = document.querySelectorAll('.course-avatar');
    courseAvatars.forEach(avatar => {
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
        // Quick navigation to add course with 'n' key
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
            const courseTitle = this.closest('.course-row').querySelector('.course-title').textContent;
            this.title = `${btnText} "${courseTitle}"`;
        });
    });

    // Lazy loading for course content metrics
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '50px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const metrics = entry.target.querySelectorAll('.metric-badge');
                metrics.forEach((metric, index) => {
                    setTimeout(() => {
                        metric.style.animation = 'fadeInUp 0.4s ease forwards';
                    }, index * 100);
                });
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    document.querySelectorAll('.content-metrics').forEach(metrics => {
        observer.observe(metrics);
    });

    // Smooth scrolling for scrollable container
    const scrollableContainer = document.getElementById('coursesScrollContainer');
    if (scrollableContainer) {
        scrollableContainer.style.scrollBehavior = 'smooth';
    }

    console.log('🚀 Professional Course Management with Scrollable Table loaded successfully!');
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

@endsection