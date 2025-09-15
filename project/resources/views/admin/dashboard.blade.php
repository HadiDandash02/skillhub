@extends('layouts.app')

@section('content')
<div class="dashboard-page">
    <!-- Professional Header Section -->
    <section class="dashboard-header-section">
        <div class="dashboard-header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Admin Dashboard</span>
                </div>
                <h1 class="header-title">Platform Overview</h1>
                <p class="header-description">Monitor performance, manage content, and track platform growth</p>
                <div class="header-meta">
                    <div class="meta-item">
                        <i class="fas fa-calendar"></i>
                        <span>{{ date('F j, Y') }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-clock"></i>
                        <span id="current-time"></span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-user-shield"></i>
                        <span>Administrator</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Wrapper -->
    <div class="dashboard-content-wrapper">
        <div class="dashboard-content-container">
            
            <!-- Key Metrics Cards with Dynamic Data -->
            <div class="metrics-grid">
                <div class="metric-card users-card">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="metric-trend {{ $usersGrowth >= 0 ? 'positive' : 'negative' }}">
                            <i class="fas fa-arrow-{{ $usersGrowth >= 0 ? 'up' : 'down' }}"></i>
                            <span>{{ $usersGrowth >= 0 ? '+' : '' }}{{ $usersGrowth }}%</span>
                        </div>
                    </div>
                    <div class="metric-content">
                        <h3 class="metric-title">Total Users</h3>
                        <div class="metric-value">{{ number_format($totalUsers) }}</div>
                        <p class="metric-subtitle">Active platform members</p>
                    </div>
                    <div class="metric-chart">
                        <canvas id="usersChart" width="100" height="40"></canvas>
                    </div>
                </div>

                <div class="metric-card courses-card">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="metric-trend {{ $coursesGrowth >= 0 ? 'positive' : 'negative' }}">
                            <i class="fas fa-arrow-{{ $coursesGrowth >= 0 ? 'up' : 'down' }}"></i>
                            <span>{{ $coursesGrowth >= 0 ? '+' : '' }}{{ $coursesGrowth }}%</span>
                        </div>
                    </div>
                    <div class="metric-content">
                        <h3 class="metric-title">Total Courses</h3>
                        <div class="metric-value">{{ number_format($totalCourses) }}</div>
                        <p class="metric-subtitle">Learning modules available</p>
                    </div>
                    <div class="metric-chart">
                        <canvas id="coursesChart" width="100" height="40"></canvas>
                    </div>
                </div>

                <div class="metric-card jobs-card">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="metric-trend {{ $jobsGrowth >= 0 ? 'positive' : 'negative' }}">
                            <i class="fas fa-arrow-{{ $jobsGrowth >= 0 ? 'up' : 'down' }}"></i>
                            <span>{{ $jobsGrowth >= 0 ? '+' : '' }}{{ $jobsGrowth }}%</span>
                        </div>
                    </div>
                    <div class="metric-content">
                        <h3 class="metric-title">Job Listings</h3>
                        <div class="metric-value">{{ number_format($totalJobs) }}</div>
                        <p class="metric-subtitle">Career opportunities</p>
                    </div>
                    <div class="metric-chart">
                        <canvas id="jobsChart" width="100" height="40"></canvas>
                    </div>
                </div>

                <div class="metric-card advice-card">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <div class="metric-trend {{ $adviceGrowth >= 0 ? 'positive' : 'negative' }}">
                            <i class="fas fa-arrow-{{ $adviceGrowth >= 0 ? 'up' : 'down' }}"></i>
                            <span>{{ $adviceGrowth >= 0 ? '+' : '' }}{{ $adviceGrowth }}%</span>
                        </div>
                    </div>
                    <div class="metric-content">
                        <h3 class="metric-title">Career Advice</h3>
                        <div class="metric-value">{{ number_format($totalCareerAdvices) }}</div>
                        <p class="metric-subtitle">Guidance articles</p>
                    </div>
                    <div class="metric-chart">
                        <canvas id="adviceChart" width="100" height="40"></canvas>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-section">
                <div class="chart-card main-chart">
                    <div class="chart-header">
                        <div class="chart-title-section">
                            <h3 class="chart-title">Platform Growth Overview</h3>
                            <p class="chart-subtitle">Monthly trends and analytics</p>
                        </div>
                        <div class="chart-controls">
                            <select id="chartPeriod" class="chart-select">
                                <option value="6">Last 6 months</option>
                                <option value="12" selected>Last 12 months</option>
                                <option value="24">Last 24 months</option>
                            </select>
                        </div>
                    </div>
                    <div class="chart-content">
                        <canvas id="mainChart" width="800" height="400"></canvas>
                    </div>
                </div>

                <div class="chart-card pie-chart">
                    <div class="chart-header">
                        <div class="chart-title-section">
                            <h3 class="chart-title">Platform Distribution</h3>
                            <p class="chart-subtitle">Complete platform breakdown</p>
                        </div>
                    </div>
                    <div class="chart-content">
                        <canvas id="distributionChart" width="300" height="300"></canvas>
                    </div>
                    <div class="chart-legend">
                        <div class="legend-item">
                            <div class="legend-color" style="background: #2563eb;"></div>
                            <span>Users ({{ $totalUsers }})</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: #10b981;"></div>
                            <span>Courses ({{ $totalCourses }})</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: #f59e0b;"></div>
                            <span>Job Listings ({{ $totalJobs }})</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-color" style="background: #8b5cf6;"></div>
                            <span>Career Advice ({{ $totalCareerAdvices }})</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Management Actions Grid -->
            <div class="actions-grid">
                <h2 class="section-title">
                    <i class="fas fa-cogs"></i>
                    Management Center
                </h2>
                
                <div class="management-cards">
                    <a href="{{ route('admin.users') }}" class="management-card users-mgmt">
                        <div class="card-icon">
                            <i class="fas fa-users-cog"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">User Management</h4>
                            <p class="card-description">Manage user accounts, roles, and permissions</p>
                            <div class="card-stats">
                                <span class="stat-item">
                                    <i class="fas fa-user-plus"></i>
                                    {{ $totalUsers }} users
                                </span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('admin.courses') }}" class="management-card courses-mgmt">
                        <div class="card-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Course Management</h4>
                            <p class="card-description">Create, edit, and organize learning content</p>
                            <div class="card-stats">
                                <span class="stat-item">
                                    <i class="fas fa-book-open"></i>
                                    {{ $totalCourses }} courses
                                </span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('admin.jobs') }}" class="management-card jobs-mgmt">
                        <div class="card-icon">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Job Listings</h4>
                            <p class="card-description">Manage career opportunities and postings</p>
                            <div class="card-stats">
                                <span class="stat-item">
                                    <i class="fas fa-building"></i>
                                    {{ $totalJobs }} listings
                                </span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </a>

                    <a href="{{ route('admin.career-advice') }}" class="management-card advice-mgmt">
                        <div class="card-icon">
                            <i class="fas fa-compass"></i>
                        </div>
                        <div class="card-content">
                            <h4 class="card-title">Career Guidance</h4>
                            <p class="card-description">Curate professional development content</p>
                            <div class="card-stats">
                                <span class="stat-item">
                                    <i class="fas fa-lightbulb"></i>
                                    {{ $totalCareerAdvices }} articles
                                </span>
                            </div>
                        </div>
                        <div class="card-arrow">
                            <i class="fas fa-chevron-right"></i>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Activity Section with Dynamic Data -->
            <div class="activity-section">
                <div class="activity-header">
                    <h3 class="activity-title">
                        <i class="fas fa-history"></i>
                        Recent Platform Activity
                    </h3>
                    <a href="#" class="view-all-link">
                        View All
                        <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>
                <div class="activity-timeline">
                    @forelse($recentActivities as $activity)
                        <div class="timeline-item">
                            <div class="timeline-icon {{ $activity['class'] }}">
                                <i class="{{ $activity['icon'] }}"></i>
                            </div>
                            <div class="timeline-content">
                                <h5 class="timeline-title">{{ $activity['title'] }}</h5>
                                <p class="timeline-description">{{ $activity['description'] }}</p>
                                <span class="timeline-time">{{ $activity['time']->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="timeline-item">
                            <div class="timeline-icon user-activity">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="timeline-content">
                                <h5 class="timeline-title">No Recent Activity</h5>
                                <p class="timeline-description">Platform activity will appear here</p>
                                <span class="timeline-time">-</span>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Professional Admin Dashboard System Styles */
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

/* Professional Page Layout */
.dashboard-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
    overflow-x: hidden;
}

.dashboard-page::before {
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
.dashboard-header-section {
    position: relative;
    z-index: 2;
    padding: 4rem 0 2rem;
    color: white;
}

.dashboard-header-container {
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
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.header-meta {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 2rem;
    margin-top: 1.5rem;
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

/* Content Wrapper */
.dashboard-content-wrapper {
    position: relative;
    z-index: 2;
    background: var(--surface-light);
    border-radius: 40px 40px 0 0;
    margin-top: -1rem;
    padding: 3rem 0 2rem;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
}

.dashboard-content-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
}

/* Metrics Grid */
.metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.metric-card {
    background: var(--surface-white);
    border-radius: var(--border-radius);
    padding: 2rem;
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    transition: all var(--animation-speed) var(--animation-curve);
    position: relative;
    overflow: hidden;
}

.metric-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--primary-gradient);
}

.metric-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-large);
}

.users-card::before { background: linear-gradient(135deg, #2563eb, #3b82f6); }
.courses-card::before { background: linear-gradient(135deg, #10b981, #059669); }
.jobs-card::before { background: linear-gradient(135deg, #f59e0b, #d97706); }
.advice-card::before { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }

.metric-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
}

.metric-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.users-card .metric-icon { background: linear-gradient(135deg, #2563eb, #3b82f6); }
.courses-card .metric-icon { background: linear-gradient(135deg, #10b981, #059669); }
.jobs-card .metric-icon { background: linear-gradient(135deg, #f59e0b, #d97706); }
.advice-card .metric-icon { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }

.metric-trend {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.metric-trend.positive {
    background: #dcfce7;
    color: #166534;
}

.metric-trend.negative {
    background: #fef2f2;
    color: #dc2626;
}

.metric-content {
    margin-bottom: 1.5rem;
}

.metric-title {
    font-size: 0.875rem;
    color: var(--text-light);
    margin: 0 0 0.5rem 0;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    font-weight: 600;
}

.metric-value {
    font-size: 2rem;
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
    line-height: 1;
}

.metric-subtitle {
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin: 0;
}

.metric-chart {
    height: 40px;
    margin-top: 1rem;
}

/* Charts Section */
.charts-section {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    margin-bottom: 3rem;
}

.chart-card {
    background: var(--surface-white);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    overflow: hidden;
}

.chart-header {
    padding: 2rem 2rem 1rem;
    border-bottom: 1px solid var(--border-light);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.chart-title-section {
    flex: 1;
}

.chart-title {
    margin: 0 0 0.5rem 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
}

.chart-subtitle {
    margin: 0;
    font-size: 0.875rem;
    color: var(--text-light);
}

.chart-controls {
    display: flex;
    gap: 1rem;
}

.chart-select {
    padding: 0.5rem 1rem;
    border: 1px solid var(--border-light);
    border-radius: 8px;
    background: var(--surface-white);
    color: var(--text-primary);
    font-size: 0.875rem;
    cursor: pointer;
}

.chart-content {
    padding: 2rem;
    position: relative;
}

.chart-legend {
    padding: 1rem 2rem 2rem;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.legend-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.legend-color {
    width: 12px;
    height: 12px;
    border-radius: 2px;
}

/* Management Actions */
.actions-grid {
    margin-bottom: 3rem;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.section-title i {
    color: var(--primary-color);
}

.management-cards {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
}

.management-card {
    background: var(--surface-white);
    border-radius: var(--border-radius);
    padding: 2rem;
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    text-decoration: none;
    color: inherit;
    transition: all var(--animation-speed) var(--animation-curve);
    display: flex;
    align-items: center;
    gap: 1.5rem;
    position: relative;
    overflow: hidden;
}

.management-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
}

.users-mgmt::before { background: linear-gradient(135deg, #2563eb, #3b82f6); }
.courses-mgmt::before { background: linear-gradient(135deg, #10b981, #059669); }
.jobs-mgmt::before { background: linear-gradient(135deg, #f59e0b, #d97706); }
.advice-mgmt::before { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }

.management-card:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-large);
}

.card-icon {
    width: 64px;
    height: 64px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.users-mgmt .card-icon { background: linear-gradient(135deg, #2563eb, #3b82f6); }
.courses-mgmt .card-icon { background: linear-gradient(135deg, #10b981, #059669); }
.jobs-mgmt .card-icon { background: linear-gradient(135deg, #f59e0b, #d97706); }
.advice-mgmt .card-icon { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }

.card-content {
    flex: 1;
}

.card-title {
    margin: 0 0 0.5rem 0;
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--text-primary);
}

.card-description {
    margin: 0 0 1rem 0;
    color: var(--text-secondary);
    line-height: 1.5;
}

.card-stats {
    display: flex;
    gap: 1rem;
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.875rem;
    color: var(--text-light);
    font-weight: 500;
}

.card-arrow {
    color: var(--text-light);
    font-size: 1.25rem;
    transition: all var(--animation-speed) var(--animation-curve);
}

.management-card:hover .card-arrow {
    color: var(--primary-color);
    transform: translateX(5px);
}

/* Activity Section */
.activity-section {
    background: var(--surface-white);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    overflow: hidden;
    position: relative;
}

.activity-header {
    padding: 2rem 2rem 1rem;
    border-bottom: 1px solid var(--border-light);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.activity-title {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.view-all-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all var(--animation-speed) var(--animation-curve);
}

.view-all-link:hover {
    color: var(--primary-dark);
}

/* Activity Timeline with Scrollbar */
.activity-timeline {
    padding: 2rem;
    max-height: 400px;
    overflow-y: auto;
    scroll-behavior: smooth;
    scrollbar-width: thin;
    scrollbar-color: rgba(37, 99, 235, 0.3) transparent;
}

/* Webkit scrollbar styling - Note: These selectors work in CSS but may show PHP syntax warnings */
.activity-timeline\::-webkit-scrollbar {
    width: 8px;
}

.activity-timeline\::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0.02);
    border-radius: 10px;
    margin: 10px 0;
}

.activity-timeline\::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.3), rgba(16, 185, 129, 0.3));
    border-radius: 10px;
    transition: all 0.3s ease;
}

.activity-timeline\::-webkit-scrollbar-thumb\:hover {
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.5), rgba(16, 185, 129, 0.5));
}

.activity-timeline\::-webkit-scrollbar-thumb\:active {
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.7), rgba(16, 185, 129, 0.7));
}

/* Add fade effect at the bottom to indicate more content */
.activity-section::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 20px;
    background: linear-gradient(transparent, rgba(255, 255, 255, 0.9));
    pointer-events: none;
    border-radius: 0 0 var(--border-radius) var(--border-radius);
}

.timeline-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid var(--border-light);
}

.timeline-item:last-child {
    border-bottom: none;
}

.timeline-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
    flex-shrink: 0;
}

.user-activity { background: linear-gradient(135deg, #2563eb, #3b82f6); }
.course-activity { background: linear-gradient(135deg, #10b981, #059669); }
.job-activity { background: linear-gradient(135deg, #f59e0b, #d97706); }

.timeline-content {
    flex: 1;
}

.timeline-title {
    margin: 0 0 0.25rem 0;
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
}

.timeline-description {
    margin: 0 0 0.5rem 0;
    color: var(--text-secondary);
    line-height: 1.5;
}

.timeline-time {
    font-size: 0.875rem;
    color: var(--text-light);
    font-weight: 500;
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

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.metric-card {
    animation: fadeInUp 0.6s ease forwards;
}

.metric-card:nth-child(1) { animation-delay: 0.1s; }
.metric-card:nth-child(2) { animation-delay: 0.2s; }
.metric-card:nth-child(3) { animation-delay: 0.3s; }
.metric-card:nth-child(4) { animation-delay: 0.4s; }

.management-card {
    animation: fadeInUp 0.6s ease forwards;
}

.management-card:nth-child(1) { animation-delay: 0.5s; }
.management-card:nth-child(2) { animation-delay: 0.6s; }
.management-card:nth-child(3) { animation-delay: 0.7s; }
.management-card:nth-child(4) { animation-delay: 0.8s; }

.timeline-item {
    animation: slideIn 0.5s ease forwards;
}

.timeline-item:nth-child(1) { animation-delay: 0.9s; }
.timeline-item:nth-child(2) { animation-delay: 1.0s; }
.timeline-item:nth-child(3) { animation-delay: 1.1s; }

/* Responsive Design */
@media (max-width: 1200px) {
    .charts-section {
        grid-template-columns: 1fr;
    }
    
    .metrics-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .dashboard-content-wrapper {
        border-radius: 20px 20px 0 0;
        padding: 2rem 0 1rem;
    }

    .dashboard-content-container {
        padding: 0 1rem;
    }

    .metrics-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }

    .management-cards {
        grid-template-columns: 1fr;
    }

    .management-card {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }

    .card-arrow {
        transform: rotate(90deg);
    }

    .management-card:hover .card-arrow {
        transform: rotate(90deg) translateY(-5px);
    }

    .header-meta {
        flex-direction: column;
        gap: 1rem;
    }

    .activity-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .chart-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    /* Mobile scrollbar adjustments */
    .activity-timeline {
        max-height: 300px;
        padding: 1rem;
    }
    
    .activity-timeline::-webkit-scrollbar {
        width: 6px;
    }
}

@media (max-width: 480px) {
    .dashboard-header-section {
        padding: 2rem 0 1rem;
    }

    .dashboard-header-container {
        padding: 0 1rem;
    }

    .header-title {
        font-size: 2rem;
    }

    .metric-card {
        padding: 1.5rem;
    }

    .management-card {
        padding: 1.5rem;
    }

    .chart-content {
        padding: 1rem;
    }

    .activity-timeline {
        max-height: 250px;
        padding: 1rem;
    }
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

/* Focus States for Accessibility */
.management-card:focus,
.view-all-link:focus,
.chart-select:focus {
    outline: 3px solid rgba(37, 99, 235, 0.5);
    outline-offset: 2px;
}

/* High Contrast Mode Support */
@media (prefers-contrast: high) {
    .metric-card,
    .chart-card,
    .management-card,
    .activity-section {
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
    
    .activity-timeline {
        scroll-behavior: auto;
    }
}

.advice-activity { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update current time
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'});
        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            timeElement.textContent = timeString;
        }
    }
    
    updateTime();
    setInterval(updateTime, 60000); // Update every minute

    // Real data from controller
    const monthlyData = @json($monthlyData);
    const miniChartData = @json($miniChartData);

    // Mini charts with real data
    function createMiniChart(canvasId, data, color) {
        const canvas = document.getElementById(canvasId);
        if (!canvas) return;
        
        const ctx = canvas.getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: monthlyData.map(item => item.month),
                datasets: [{
                    data: data,
                    borderColor: color,
                    backgroundColor: color + '20',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 0,
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: { display: false },
                    y: { display: false }
                },
                elements: {
                    point: { radius: 0 }
                }
            }
        });
    }

    // Create mini charts with real data
    createMiniChart('usersChart', miniChartData.users, '#2563eb');
    createMiniChart('coursesChart', miniChartData.courses, '#10b981');
    createMiniChart('jobsChart', miniChartData.jobs, '#f59e0b');
    createMiniChart('adviceChart', miniChartData.advice, '#8b5cf6');

    // Main chart with real data
    const mainCtx = document.getElementById('mainChart');
    if (mainCtx) {
        new Chart(mainCtx, {
            type: 'line',
            data: {
                labels: monthlyData.map(item => item.month),
                datasets: [
                    {
                        label: 'Users',
                        data: monthlyData.map(item => item.users),
                        borderColor: '#2563eb',
                        backgroundColor: '#2563eb20',
                        fill: false,
                        tension: 0.4
                    },
                    {
                        label: 'Courses',
                        data: monthlyData.map(item => item.courses),
                        borderColor: '#10b981',
                        backgroundColor: '#10b98120',
                        fill: false,
                        tension: 0.4
                    },
                    {
                        label: 'Job Listings',
                        data: monthlyData.map(item => item.jobs),
                        borderColor: '#f59e0b',
                        backgroundColor: '#f59e0b20',
                        fill: false,
                        tension: 0.4
                    },
                    {
                        label: 'Career Advice',
                        data: monthlyData.map(item => item.advice),
                        borderColor: '#8b5cf6',
                        backgroundColor: '#8b5cf620',
                        fill: false,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f5f9'
                        }
                    },
                    x: {
                        grid: {
                            color: '#f1f5f9'
                        }
                    }
                }
            }
        });
    }

    // Distribution pie chart with real data
    const distributionCtx = document.getElementById('distributionChart');
    if (distributionCtx) {
        new Chart(distributionCtx, {
            type: 'doughnut',
            data: {
                labels: ['Users', 'Courses', 'Job Listings', 'Career Advice'],
                datasets: [{
                    data: [{{ $totalUsers }}, {{ $totalCourses }}, {{ $totalJobs }}, {{ $totalCareerAdvices }}],
                    backgroundColor: ['#2563eb', '#10b981', '#f59e0b', '#8b5cf6'],
                    borderWidth: 0,
                    cutout: '60%'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }

    // Enhanced card interactions
    document.querySelectorAll('.metric-card, .management-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });

    // Counter animation for metric values
    function animateCounter(element, target) {
        let current = 0;
        const increment = target / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current).toLocaleString();
        }, 30);
    }

    // Animate counters when cards come into view
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const valueElement = entry.target.querySelector('.metric-value');
                if (valueElement && !valueElement.dataset.animated) {
                    const target = parseInt(valueElement.textContent.replace(/,/g, ''));
                    valueElement.dataset.animated = 'true';
                    animateCounter(valueElement, target);
                }
            }
        });
    });

    document.querySelectorAll('.metric-card').forEach(card => {
        observer.observe(card);
    });

    // Add webkit scrollbar styles via JavaScript to avoid PHP syntax conflicts
    const styleSheet = document.createElement('style');
    styleSheet.textContent = `
        .activity-timeline::-webkit-scrollbar {
            width: 8px;
        }
        
        .activity-timeline::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.02);
            border-radius: 10px;
            margin: 10px 0;
        }
        
        .activity-timeline::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.3), rgba(16, 185, 129, 0.3));
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .activity-timeline::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.5), rgba(16, 185, 129, 0.5));
        }
        
        .activity-timeline::-webkit-scrollbar-thumb:active {
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.7), rgba(16, 185, 129, 0.7));
        }
    `;
    document.head.appendChild(styleSheet);

    console.log('🚀 Professional Admin Dashboard with Scrollable Activity Section loaded successfully!');
});
</script>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection