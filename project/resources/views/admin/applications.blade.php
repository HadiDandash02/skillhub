@extends('layouts.app')

@section('content')
<div class="applications-page">
    <!-- Professional Header Section -->
    <section class="applications-header-section">
        <div class="applications-header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-briefcase"></i>
                    <span>Career Management</span>
                </div>
                <h1 class="header-title">Job Applications</h1>
                <p class="header-description">Manage and track all job applications with comprehensive status updates</p>
                
                <!-- Header Stats -->
                <div class="header-stats">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-number">{{ $applications->count() }}</span>
                            <span class="stat-label">Total Applications</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon accepted">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-number">{{ $applications->where('status', 'Accepted')->count() }}</span>
                            <span class="stat-label">Accepted</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon pending">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-number">{{ $applications->where('status', 'Pending')->count() }}</span>
                            <span class="stat-label">Pending Review</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon rejected">
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div class="stat-info">
                            <span class="stat-number">{{ $applications->where('status', 'Rejected')->count() }}</span>
                            <span class="stat-label">Rejected</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Wrapper -->
    <div class="applications-content-wrapper">
        <div class="applications-content-container">
            
            <!-- Success Alert -->
            @if(session('success'))
            <div class="alert-success">
                <div class="alert-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="alert-content">
                    <h4>Success!</h4>
                    <p>{{ session('success') }}</p>
                </div>
                <button class="alert-close" onclick="this.parentElement.style.display='none'">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @endif

            <!-- Applications Table Card -->
            <div class="table-card">
                <div class="table-header">
                    <h3 class="table-title">
                        <i class="fas fa-list"></i>
                        Applications Overview
                    </h3>
                    <div class="table-actions">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="searchInput" placeholder="Search applications..." onkeyup="filterApplications()">
                        </div>
                        <div class="filter-dropdown">
                            <select id="statusFilter" onchange="filterByStatus()">
                                <option value="">All Statuses</option>
                                <option value="applied">Applied</option>
                                <option value="pending">Pending</option>
                                <option value="accepted">Accepted</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="table-container">
                    <table class="applications-table" id="applicationsTable">
                        <thead>
                            <tr>
                                <th class="sortable" onclick="sortTable(0)">
                                    <div class="th-content">
                                        <i class="fas fa-user"></i>
                                        <span>Applicant</span>
                                        <i class="fas fa-sort sort-icon"></i>
                                    </div>
                                </th>
                                <th class="sortable" onclick="sortTable(1)">
                                    <div class="th-content">
                                        <i class="fas fa-briefcase"></i>
                                        <span>Job Details</span>
                                        <i class="fas fa-sort sort-icon"></i>
                                    </div>
                                </th>
                                <th class="sortable" onclick="sortTable(2)">
                                    <div class="th-content">
                                        <i class="fas fa-building"></i>
                                        <span>Company</span>
                                        <i class="fas fa-sort sort-icon"></i>
                                    </div>
                                </th>
                                <th class="sortable" onclick="sortTable(3)">
                                    <div class="th-content">
                                        <i class="fas fa-flag"></i>
                                        <span>Status</span>
                                        <i class="fas fa-sort sort-icon"></i>
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
                            @forelse($applications as $application)
                            <tr class="application-row" data-status="{{ strtolower($application->status) }}">
                                <td class="applicant-cell">
                                    <div class="applicant-info">
                                        <div class="applicant-avatar">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($application->user->name) }}&background=4f46e5&color=fff&size=48" 
                                                 alt="{{ $application->user->name }}" 
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                                            <div class="avatar-fallback">
                                                {{ strtoupper(substr($application->user->name, 0, 1)) }}
                                            </div>
                                        </div>
                                        <div class="applicant-details">
                                            <div class="applicant-name">{{ $application->user->name }}</div>
                                            <div class="applicant-email">
                                                <i class="fas fa-envelope"></i>
                                                {{ $application->user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="job-cell">
                                    <div class="job-info">
                                        <div class="job-title">{{ $application->jobListing->title }}</div>
                                        <div class="application-date">
                                            <i class="fas fa-calendar-alt"></i>
                                            Applied {{ $application->created_at->diffForHumans() }}
                                        </div>
                                        <div class="application-id">
                                            <i class="fas fa-hashtag"></i>
                                            ID: {{ $application->id }}
                                        </div>
                                    </div>
                                </td>
                                <td class="company-cell">
                                    <div class="company-info">
                                        <div class="company-name">
                                            <i class="fas fa-building"></i>
                                            {{ $application->jobListing->company }}
                                        </div>
                                    </div>
                                </td>
                                <td class="status-cell">
                                    @php
                                        $status = strtolower($application->status);
                                    @endphp
                                    @if($status === 'applied')
                                        <span class="status-badge status-applied">
                                            <i class="fas fa-paper-plane"></i>
                                            Applied
                                        </span>
                                    @elseif($status === 'pending')
                                        <span class="status-badge status-pending">
                                            <i class="fas fa-clock"></i>
                                            Pending
                                        </span>
                                    @elseif($status === 'accepted')
                                        <span class="status-badge status-accepted">
                                            <i class="fas fa-check-circle"></i>
                                            Accepted
                                        </span>
                                    @elseif($status === 'rejected')
                                        <span class="status-badge status-rejected">
                                            <i class="fas fa-times-circle"></i>
                                            Rejected
                                        </span>
                                    @else
                                        <span class="status-badge status-default">
                                            <i class="fas fa-question-circle"></i>
                                            {{ ucfirst($application->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="actions-cell">
                                    <form action="{{ route('admin.applications.update', $application->id) }}" method="POST" class="status-form">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                            <select name="status" class="status-select" onchange="this.form.submit()">
                                                <option value="Applied" {{ $application->status == 'Applied' ? 'selected' : '' }}>Applied</option>
                                                <option value="Pending" {{ $application->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Accepted" {{ $application->status == 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                                <option value="Rejected" {{ $application->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                            </select>
                                            <button type="submit" class="update-button">
                                                <i class="fas fa-save"></i>
                                                Update
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr class="no-applications-row">
                                <td colspan="5" class="no-applications">
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-inbox"></i>
                                        </div>
                                        <h3>No Applications Found</h3>
                                        <p>There are currently no job applications to display.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

             
                @if($applications->count() > 0)
                <div class="table-footer">
                    <div class="showing-info">
                        Showing {{ $applications->count() }} applications
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
/* Professional Job Applications System Styles */
:root {
    /* Primary Color Scheme - Matching other blades */
    --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
    --primary-color: #2563eb;
    --primary-dark: #1d4ed8;
    --accent-color: #10b981;
    --accent-dark: #059669;
    
    /* Status colors */
    --status-applied: #6366f1;
    --status-pending: #f59e0b;
    --status-accepted: #10b981;
    --status-rejected: #ef4444;
    
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

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

/* Professional Page Layout */
.applications-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
    overflow-x: hidden;
}

.applications-page::before {
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
.applications-header-section {
    position: relative;
    z-index: 2;
    padding: 4rem 0 2rem;
    color: white;
}

.applications-header-container {
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
    margin-bottom: 3rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

/* Header Stats */
.header-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1.5rem;
    max-width: 1000px;
    margin: 0 auto;
}

.stat-card {
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    backdrop-filter: blur(20px);
    border-radius: var(--border-radius);
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: all var(--animation-speed) var(--animation-curve);
}

.stat-card:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.15);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

.stat-icon.accepted {
    background: rgba(16, 185, 129, 0.8);
}

.stat-icon.pending {
    background: rgba(245, 158, 11, 0.8);
}

.stat-icon.rejected {
    background: rgba(239, 68, 68, 0.8);
}

.stat-info {
    flex: 1;
}

.stat-number {
    display: block;
    font-size: 1.75rem;
    font-weight: 700;
    line-height: 1;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.875rem;
    opacity: 0.9;
    font-weight: 500;
}

/* Content Wrapper */
.applications-content-wrapper {
    position: relative;
    z-index: 2;
    background: var(--surface-light);
    border-radius: 40px 40px 0 0;
    margin-top: -1rem;
    padding: 3rem 0 2rem;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
}

.applications-content-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
}

/* Success Alert */
.alert-success {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    border: 1px solid #6ee7b7;
    border-radius: var(--border-radius);
    padding: 1.5rem;
    margin-bottom: 2rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    box-shadow: var(--shadow-medium);
    animation: slideInDown 0.6s ease;
}

.alert-icon {
    width: 40px;
    height: 40px;
    background: var(--status-accepted);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.alert-content {
    flex: 1;
}

.alert-content h4 {
    margin: 0 0 0.25rem 0;
    font-weight: 700;
    color: #065f46;
    font-size: 1rem;
}

.alert-content p {
    margin: 0;
    color: #047857;
    font-size: 0.875rem;
}

.alert-close {
    background: none;
    border: none;
    color: #047857;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 50%;
    transition: all var(--animation-speed) var(--animation-curve);
}

.alert-close:hover {
    background: rgba(5, 150, 105, 0.1);
    color: #065f46;
}

/* Table Card */
.table-card {
    background: var(--surface-white);
    border-radius: var(--border-radius-large);
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    overflow: hidden;
    animation: fadeInUp 0.6s ease forwards;
    animation-delay: 0.2s;
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

.table-title {
    margin: 0;
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

.table-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
    flex-wrap: wrap;
}

.search-box {
    position: relative;
    display: flex;
    align-items: center;
}

.search-box i {
    position: absolute;
    left: 1rem;
    color: var(--text-light);
    font-size: 0.875rem;
}

.search-box input {
    padding: 0.75rem 1rem 0.75rem 2.5rem;
    border: 2px solid var(--border-light);
    border-radius: 12px;
    font-size: 0.875rem;
    min-width: 200px;
    transition: all var(--animation-speed) var(--animation-curve);
}

.search-box input:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.filter-dropdown select {
    padding: 0.75rem 1rem;
    border: 2px solid var(--border-light);
    border-radius: 12px;
    font-size: 0.875rem;
    background: var(--surface-white);
    color: var(--text-primary);
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
}

.filter-dropdown select:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.table-container {
    overflow-x: auto;
    max-height: 600px;
    overflow-y: auto;
    /* Add these new properties */
    border: 1px solid var(--border-light);
    border-radius: 16px;
    background: var(--surface-white);
    scroll-behavior: smooth;
}

/* ADD THESE NEW SCROLLBAR STYLES to your applications.blade.php */

/* Vertical Scrollbar for Table Container */
.table-container::-webkit-scrollbar {
    width: 8px;
}

.table-container::-webkit-scrollbar-track {
    background: var(--surface-light);
    border-radius: 4px;
}

.table-container::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    border-radius: 4px;
}

.table-container::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, var(--primary-dark), var(--accent-dark));
}

/* Horizontal Scrollbar for Table Container */
.table-container::-webkit-scrollbar:horizontal {
    height: 8px;
}

/* Firefox Scrollbar Support */
.table-container {
    scrollbar-width: thin;
    scrollbar-color: var(--primary-color) var(--surface-light);
}

.applications-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
    /* Add these to match the professional styling */
    border-collapse: separate;
    border-spacing: 0;
    background: var(--surface-white);
    min-width: 1000px;
}

.applications-table thead {
    background: var(--primary-gradient);
    color: white;
    position: sticky;
    top: 0;
    z-index: 10;
}
.applications-table th:first-child {
    border-radius: 16px 0 0 0;
}

.applications-table th:last-child {
    border-radius: 0 16px 0 0;
}

/* Vertical Scrollbar for Table Container */
.table-container::-webkit-scrollbar {
    width: 8px;
}

.table-container::-webkit-scrollbar-track {
    background: var(--surface-light);
    border-radius: 4px;
}

.table-container::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    border-radius: 4px;
}

.table-container::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, var(--primary-dark), var(--accent-dark));
}

/* Horizontal Scrollbar for Table Container */
.table-container::-webkit-scrollbar:horizontal {
    height: 8px;
}

/* Firefox Scrollbar Support */
.table-container {
    scrollbar-width: thin;
    scrollbar-color: var(--primary-color) var(--surface-light);
}

/* If you have a separate scrollable wrapper, apply the same styles */
.applications-scrollable-container {
    max-height: 600px;
    overflow-y: auto;
    border: 1px solid var(--border-light);
    border-radius: 16px;
    background: var(--surface-white);
    scroll-behavior: smooth;
}

.applications-scrollable-container::-webkit-scrollbar {
    width: 8px;
}

.applications-scrollable-container::-webkit-scrollbar-track {
    background: var(--surface-light);
    border-radius: 4px;
}

.applications-scrollable-container::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    border-radius: 4px;
}

.applications-scrollable-container::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, var(--primary-dark), var(--accent-dark));
}

.applications-scrollable-container::-webkit-scrollbar:horizontal {
    height: 8px;
}

.applications-scrollable-container {
    scrollbar-width: thin;
    scrollbar-color: var(--primary-color) var(--surface-light);
}

.applications-table th {
    background: var(--surface-light);
    position: sticky;
    top: 0;
    z-index: 10;
    padding: 1rem 1.5rem;
    text-align: left;
    border-bottom: 2px solid var(--border-light);
}

.th-content {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: var(--text-secondary);
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.sortable {
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
}

.sortable:hover {
    background: var(--surface-gray);
}

.sort-icon {
    opacity: 0.5;
    font-size: 0.7rem;
    transition: all var(--animation-speed) var(--animation-curve);
}

.sortable:hover .sort-icon {
    opacity: 1;
}

.applications-table td {
    padding: 1.5rem;
    border-bottom: 1px solid var(--border-light);
    vertical-align: top;
}

.application-row {
    transition: all var(--animation-speed) var(--animation-curve);
}

.application-row:hover {
    background: rgba(37, 99, 235, 0.02);
    transform: translateX(5px);
}

/* Applicant Cell */
.applicant-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.applicant-avatar {
    position: relative;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
}

.applicant-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-fallback {
    width: 100%;
    height: 100%;
    background: var(--primary-color);
    color: white;
    display: none;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.1rem;
}

.applicant-details {
    flex: 1;
    min-width: 0;
}

.applicant-name {
    font-weight: 600;
    color: var(--text-primary);
    font-size: 0.95rem;
    margin-bottom: 0.25rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.applicant-email {
    color: var(--text-light);
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Job Cell */
.job-info {
    min-width: 200px;
}

.job-title {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
    line-height: 1.3;
}

.application-date,
.application-id {
    color: var(--text-light);
    font-size: 0.8rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 0.25rem;
}

/* Company Cell */
.company-info {
    min-width: 150px;
}

.company-name {
    font-weight: 500;
    color: var(--text-primary);
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Status Badges */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    white-space: nowrap;
}

.status-applied {
    background: rgba(99, 102, 241, 0.1);
    color: var(--status-applied);
    border: 1px solid rgba(99, 102, 241, 0.2);
}

.status-pending {
    background: rgba(245, 158, 11, 0.1);
    color: var(--status-pending);
    border: 1px solid rgba(245, 158, 11, 0.2);
}

.status-accepted {
    background: rgba(16, 185, 129, 0.1);
    color: var(--status-accepted);
    border: 1px solid rgba(16, 185, 129, 0.2);
}

.status-rejected {
    background: rgba(239, 68, 68, 0.1);
    color: var(--status-rejected);
    border: 1px solid rgba(239, 68, 68, 0.2);
}

.status-default {
    background: rgba(107, 114, 128, 0.1);
    color: var(--text-secondary);
    border: 1px solid rgba(107, 114, 128, 0.2);
}

/* Actions Cell */
.status-form {
    min-width: 200px;
}

.form-group {
    display: flex;
    gap: 0.75rem;
    align-items: center;
    flex-wrap: wrap;
}

.status-select {
    padding: 0.75rem 1rem;
    border: 2px solid var(--border-light);
    border-radius: 8px;
    font-size: 0.8rem;
    background: var(--surface-white);
    color: var(--text-primary);
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    min-width: 120px;
}

.status-select:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.update-button {
    background: var(--primary-color);
    color: white;
    border: none;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    white-space: nowrap;
}

.update-button:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

/* Empty State */
.no-applications-row td {
    padding: 4rem 2rem;
}

.empty-state {
    text-align: center;
    color: var(--text-light);
}

.empty-icon {
    width: 80px;
    height: 80px;
    background: var(--surface-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
    color: var(--text-light);
    animation: pulse 2s infinite;
}

.empty-state h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-secondary);
    margin-bottom: 0.5rem;
}

.empty-state p {
    font-size: 1rem;
    margin: 0;
    max-width: 400px;
    margin: 0 auto;
    line-height: 1.6;
}

/* Table Footer */
.table-footer {
    padding: 1.5rem 2.5rem;
    background: var(--surface-light);
    border-top: 1px solid var(--border-light);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.showing-info {
    color: var(--text-light);
    font-size: 0.875rem;
    font-weight: 500;
}

/* Enhanced Responsive Design */
@media (max-width: 1200px) {
    .header-stats {
        grid-template-columns: repeat(2, 1fr);
        max-width: 600px;
    }
    
    .table-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1.5rem;
    }
    
    .table-actions {
        width: 100%;
        justify-content: space-between;
    }
}

@media (max-width: 768px) {
    .applications-content-wrapper {
        border-radius: 20px 20px 0 0;
        padding: 2rem 0 1rem;
    }

    .applications-content-container {
        padding: 0 1rem;
    }

    .header-stats {
        grid-template-columns: 1fr;
    }

    .stat-card {
        padding: 1rem;
    }

    .table-header {
        padding: 1.5rem;
    }

    .table-actions {
        flex-direction: column;
        align-items: stretch;
        width: 100%;
    }

    .search-box input {
        min-width: 100%;
    }

    .applications-table {
        font-size: 0.8rem;
    }

    .applications-table td {
        padding: 1rem;
    }

    .applicant-info {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .applicant-avatar {
        width: 40px;
        height: 40px;
    }

    .form-group {
        flex-direction: column;
        align-items: stretch;
    }

    .status-select,
    .update-button {
        width: 100%;
    }

    /* Stack table cells vertically on mobile */
    .applications-table,
    .applications-table thead,
    .applications-table tbody,
    .applications-table th,
    .applications-table td,
    .applications-table tr {
        display: block;
    }

    .applications-table thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
    }

    .applications-table tr {
        background: var(--surface-white);
        border: 1px solid var(--border-light);
        border-radius: 12px;
        margin-bottom: 1rem;
        padding: 1rem;
        box-shadow: var(--shadow-subtle);
    }

    .applications-table td {
        border: none;
        padding: 0.75rem 0;
        text-align: left;
        border-bottom: 1px solid var(--border-light);
    }

    .applications-table td:last-child {
        border-bottom: none;
    }

    .applications-table td:before {
        content: attr(data-label) ": ";
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.05em;
        display: block;
        margin-bottom: 0.5rem;
    }

    .applicant-cell:before { content: "Applicant"; }
    .job-cell:before { content: "Job Details"; }
    .company-cell:before { content: "Company"; }
    .status-cell:before { content: "Status"; }
    .actions-cell:before { content: "Actions"; }
}

@media (max-width: 480px) {
    .applications-header-section {
        padding: 2rem 0 1rem;
    }

    .applications-header-container {
        padding: 0 1rem;
    }

    .header-title {
        font-size: 2rem;
    }

    .table-card {
        margin-bottom: 1.5rem;
    }

    .stat-number {
        font-size: 1.5rem;
    }

    .stat-label {
        font-size: 0.8rem;
    }
}

/* Focus States for Accessibility */
.search-box input:focus,
.filter-dropdown select:focus,
.status-select:focus,
.update-button:focus,
.alert-close:focus {
    outline: 3px solid rgba(37, 99, 235, 0.5);
    outline-offset: 2px;
}

/* High Contrast Mode Support */
@media (prefers-contrast: high) {
    .table-card,
    .stat-card,
    .alert-success {
        border-width: 3px;
    }
    
    .status-badge {
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
    
    .empty-icon {
        animation: none !important;
    }
}

/* Loading States */
.loading {
    pointer-events: none;
    opacity: 0.8;
    position: relative;
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

/* Print Styles */
@media print {
    .table-actions,
    .actions-cell,
    .alert-close {
        display: none !important;
    }
    
    .applications-page {
        background: white !important;
    }
    
    .applications-content-wrapper {
        box-shadow: none !important;
        border-radius: 0 !important;
    }
    
    .table-card {
        box-shadow: none !important;
        border: 1px solid #000 !important;
    }
}
</style>

<script>
// Enhanced functionality for the applications table
document.addEventListener('DOMContentLoaded', function() {
    
    // Search functionality
    function filterApplications() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
        const rows = document.querySelectorAll('.application-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const applicantName = row.querySelector('.applicant-name').textContent.toLowerCase();
            const applicantEmail = row.querySelector('.applicant-email').textContent.toLowerCase();
            const jobTitle = row.querySelector('.job-title').textContent.toLowerCase();
            const company = row.querySelector('.company-name').textContent.toLowerCase();
            const status = row.getAttribute('data-status');

            const matchesSearch = applicantName.includes(searchTerm) || 
                                applicantEmail.includes(searchTerm) ||
                                jobTitle.includes(searchTerm) ||
                                company.includes(searchTerm);

            const matchesStatus = !statusFilter || status === statusFilter;

            if (matchesSearch && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        // Update showing info
        const showingInfo = document.querySelector('.showing-info');
        if (showingInfo) {
            showingInfo.textContent = `Showing ${visibleCount} applications`;
        }

        // Show/hide empty state
        const emptyRow = document.querySelector('.no-applications-row');
        if (emptyRow) {
            emptyRow.style.display = visibleCount === 0 ? '' : 'none';
        }
    }

    // Status filter functionality
    function filterByStatus() {
        filterApplications();
    }

    // Table sorting functionality
    let sortDirection = {};
    
    function sortTable(columnIndex) {
        const table = document.getElementById('applicationsTable');
        const tbody = table.querySelector('tbody');
        const rows = Array.from(tbody.querySelectorAll('.application-row'));
        
        // Determine sort direction
        const column = table.querySelectorAll('th')[columnIndex];
        const currentDirection = sortDirection[columnIndex] || 'asc';
        const newDirection = currentDirection === 'asc' ? 'desc' : 'asc';
        sortDirection[columnIndex] = newDirection;
        
        // Update sort icons
        table.querySelectorAll('.sort-icon').forEach(icon => {
            icon.className = 'fas fa-sort sort-icon';
        });
        
        const sortIcon = column.querySelector('.sort-icon');
        if (sortIcon) {
            sortIcon.className = `fas fa-sort-${newDirection === 'asc' ? 'up' : 'down'} sort-icon`;
        }
        
        // Sort rows
        rows.sort((a, b) => {
            let aValue, bValue;
            
            switch(columnIndex) {
                case 0: // Applicant name
                    aValue = a.querySelector('.applicant-name').textContent.trim();
                    bValue = b.querySelector('.applicant-name').textContent.trim();
                    break;
                case 1: // Job title
                    aValue = a.querySelector('.job-title').textContent.trim();
                    bValue = b.querySelector('.job-title').textContent.trim();
                    break;
                case 2: // Company
                    aValue = a.querySelector('.company-name').textContent.trim();
                    bValue = b.querySelector('.company-name').textContent.trim();
                    break;
                case 3: // Status
                    aValue = a.getAttribute('data-status');
                    bValue = b.getAttribute('data-status');
                    break;
                default:
                    return 0;
            }
            
            if (newDirection === 'asc') {
                return aValue.localeCompare(bValue);
            } else {
                return bValue.localeCompare(aValue);
            }
        });
        
        // Re-append sorted rows
        rows.forEach(row => tbody.appendChild(row));
    }

    // Auto-submit form on status change with loading state
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function() {
            const form = this.closest('form');
            const updateButton = form.querySelector('.update-button');
            
            // Show loading state
            updateButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Updating...';
            updateButton.disabled = true;
            
            // Submit form
            form.submit();
        });
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Focus search with Ctrl+F
        if (e.ctrlKey && e.key === 'f') {
            e.preventDefault();
            document.getElementById('searchInput').focus();
        }
        
        // Clear search with Escape
        if (e.key === 'Escape') {
            const searchInput = document.getElementById('searchInput');
            if (document.activeElement === searchInput) {
                searchInput.value = '';
                filterApplications();
                searchInput.blur();
            }
        }
    });

    // Auto-dismiss alerts
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert-success');
        alerts.forEach(alert => {
            if (alert.style.display !== 'none') {
                alert.style.animation = 'slideOutUp 0.4s ease forwards';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 400);
            }
        });
    }, 5000);

    // Smooth row animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.6s ease forwards';
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.application-row').forEach(row => {
        observer.observe(row);
    });

    // Make functions global for onclick handlers
    window.filterApplications = filterApplications;
    window.filterByStatus = filterByStatus;
    window.sortTable = sortTable;

    console.log('🚀 Professional Job Applications Dashboard loaded successfully!');
    console.log(`📊 Loaded ${document.querySelectorAll('.application-row').length} applications`);
});

// Additional slideOutUp animation
const additionalStyles = document.createElement('style');
additionalStyles.textContent = `
    @keyframes slideOutUp {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-20px);
        }
    }
`;
document.head.appendChild(additionalStyles);
</script>

<!-- FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection