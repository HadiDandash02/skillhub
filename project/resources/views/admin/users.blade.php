@extends('layouts.app')

@section('content')
<div class="users-management-page">
    <!-- Professional Header Section -->
    <section class="users-header-section">
        <div class="users-header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-users-cog"></i>
                    <span>User Management</span>
                </div>
                <h1 class="header-title">Manage Users</h1>
                <p class="header-description">Oversee user accounts, roles, and permissions across the platform</p>
                <!-- Navigation -->
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
    <div class="users-content-wrapper">
        <div class="users-content-container">
            
            <!-- Search and Filter Section -->
            <div class="management-controls">
                <div class="search-section">
                    <div class="search-container">
                        <div class="search-input-wrapper">
                            <i class="fas fa-search search-icon"></i>
                            <input type="text" id="searchInput" class="search-input" placeholder="Search users by name or email...">
                        </div>
                    </div>
                </div>

                <div class="filter-section">
                    <form method="GET" action="{{ route('admin.users') }}" class="role-filter-form">
                        <div class="role-filter-container">
                            <div class="filter-input-wrapper">
                                <i class="fas fa-filter filter-icon"></i>
                                <select name="role" class="role-select">
                                    <option value="all">All Roles</option>
                                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="instructor" {{ request('role') == 'instructor' ? 'selected' : '' }}>Instructor</option>
                                    <option value="careerM" {{ request('role') == 'careerM' ? 'selected' : '' }}>Career Manager</option>
                                    <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
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

            <!-- Users Table Card -->
            <div class="table-card">
                <div class="table-header">
                    <div class="table-title-section">
                        <h3 class="table-title">
                            <i class="fas fa-users"></i>
                            Platform Users
                        </h3>
                        <p class="table-subtitle">Manage user accounts and permissions</p>
                    </div>
                    <div class="table-actions">
                        <button type="button" class="btn btn-create" onclick="window.location.href='{{ route('admin.createUser') }}'">
                            <i class="fas fa-plus"></i>
                            <span>Create User</span>
                        </button>
                        <span class="user-count">
                            <i class="fas fa-info-circle"></i>
                            Total: {{ $users->count() }} users

                        </span>
                    </div>
                </div>

                <div class="table-container">
                    <div class="users-scrollable-container" id="usersScrollContainer">
                        <div class="table-responsive">
                            <table class="users-table">
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
                                                <i class="fas fa-user"></i>
                                                <span>Name</span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="th-content">
                                                <i class="fas fa-envelope"></i>
                                                <span>Email</span>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="th-content">
                                                <i class="fas fa-user-tag"></i>
                                                <span>Role</span>
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
                                <tbody id="userTableBody">
                                    @foreach($users as $user)
                                    <tr class="user-row">
                                        <td class="id-cell">
                                            <span class="user-id">#{{ $user->id }}</span>
                                        </td>
                                        <td class="name-cell">
                                            <div class="user-info">
                                                <div class="user-avatar">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                <span class="user-name">{{ $user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="email-cell">
                                            <span class="user-email">{{ $user->email }}</span>
                                        </td>
                                        <td class="role-cell">
                                            @if($user->role === 'admin')
                                                <span class="role-badge admin">
                                                    <i class="fas fa-user-shield"></i>
                                                    <span>Admin</span>
                                                </span>
                                            @elseif($user->role === 'instructor')
                                                <span class="role-badge instructor">
                                                    <i class="fas fa-chalkboard-teacher"></i>
                                                    <span>Instructor</span>
                                                </span>
                                            @elseif($user->role === 'careerM')
                                                <span class="role-badge career-manager">
                                                    <i class="fas fa-user-tie"></i>
                                                    <span>Career Manager</span>
                                                </span>
                                            @elseif($user->role === 'hr')
                                                <span class="role-badge hr">
                                                    <i class="fas fa-users"></i>
                                                    <span>HR</span>
                                                </span>
                                            @else
                                                <span class="role-badge user">
                                                    <i class="fas fa-user"></i>
                                                    <span>User</span>
                                                </span>
                                            @endif
                                        </td>
                                        <td class="actions-cell">
                                            <div class="action-buttons">
                                                <button type="button" class="btn btn-edit" onclick="window.location.href='{{ route('admin.editUser', $user->id) }}'">
                                                    <i class="fas fa-edit"></i>
                                                    <span>Edit</span>
                                                </button>
                                                <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this user?')">
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
/* Professional User Management System Styles */
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

/* Create User Button Styles */
.btn-create {
    background: var(--primary-gradient);
    color: white;
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 12px;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    box-shadow: var(--shadow-medium);
    margin-right: 1rem;
}

.btn-create:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-large);
    color: white;
}

.btn-create:focus {
    outline: 3px solid rgba(37, 99, 235, 0.5);
    outline-offset: 2px;
}

.btn-create i {
    font-size: 0.875rem;
}

/* Update table actions layout */
.table-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

/* Responsive adjustments for create button */
@media (max-width: 768px) {
    .table-actions {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
        width: 100%;
    }
    
    .btn-create {
        width: auto;
        margin-right: 0;
    }
}

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
.users-management-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
    overflow-x: hidden;
}

.users-management-page::before {
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
.users-header-section {
    position: relative;
    z-index: 2;
    padding: 4rem 0 2rem;
    color: white;
}

.users-header-container {
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

/* Content Wrapper */
.users-content-wrapper {
    position: relative;
    z-index: 2;
    background: var(--surface-light);
    border-radius: 40px 40px 0 0;
    margin-top: -1rem;
    padding: 3rem 0 2rem;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
}

.users-content-container {
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
    box-shadow: var(--shadow-medium);
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

.role-filter-form {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.role-filter-container {
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

.role-select {
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

.role-select:focus {
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
    box-shadow: var(--shadow-medium);
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

.user-count {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 500;
    background: var(--surface-light);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    border: 1px solid var(--border-light);
}

/* Table Styles with Scrollable Container */
.table-container {
    padding: 2.5rem;
}

.users-scrollable-container {
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

.users-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: var(--surface-white);
    min-width: 800px;
}

.users-table thead {
    background: var(--primary-gradient);
    color: white;
    position: sticky;
    top: 0;
    z-index: 10;
}

.users-table th {
    padding: 1.5rem 1.25rem;
    text-align: left;
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border: none;
    position: relative;
}

.users-table th:first-child {
    border-radius: 16px 0 0 0;
}

.users-table th:last-child {
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

.users-table td {
    padding: 1.25rem;
    border-bottom: 1px solid var(--border-light);
    vertical-align: middle;
    font-size: 0.95rem;
}

.user-row {
    transition: all var(--animation-speed) var(--animation-curve);
}

.user-row:hover {
    background: linear-gradient(135deg, var(--surface-light) 0%, rgba(37, 99, 235, 0.02) 100%);
}

.user-row:last-child td {
    border-bottom: none;
}

/* Cell Styles */
.id-cell {
    width: 80px;
}

.user-id {
    font-weight: 600;
    color: var(--text-light);
    font-size: 0.875rem;
}

.name-cell {
    min-width: 200px;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.user-avatar {
    width: 40px;
    height: 40px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 0.875rem;
}

.user-name {
    font-weight: 600;
    color: var(--text-primary);
}

.email-cell {
    min-width: 250px;
}

.user-email {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.role-cell {
    min-width: 150px;
    text-align: center;
}

/* Role Badges */
.role-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: capitalize;
    min-width: 120px;
    justify-content: center;
    box-shadow: var(--shadow-subtle);
}

.role-badge.admin {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
}

.role-badge.instructor {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.role-badge.career-manager {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
}

.role-badge.hr {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
    color: white;
}

.role-badge.user {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    color: white;
}

.actions-cell {
    min-width: 200px;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 0.75rem;
    align-items: center;
}

.delete-form {
    margin: 0;
    display: inline-block;
}

.btn {
    padding: 0.75rem 1rem;
    border: none;
    cursor: pointer;
    border-radius: 8px;
    text-decoration: none;
    color: white;
    font-size: 0.875rem;
    font-weight: 600;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    min-width: 80px;
    justify-content: center;
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
    font-size: 0.875rem;
}

/* Custom Scrollbar Styling for Users Table */
.users-scrollable-container::-webkit-scrollbar {
    width: 8px;
}

.users-scrollable-container::-webkit-scrollbar-track {
    background: var(--surface-light);
    border-radius: 4px;
}

.users-scrollable-container::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    border-radius: 4px;
}

.users-scrollable-container::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, var(--primary-dark), var(--accent-dark));
}

/* Firefox Scrollbar Styling */
.users-scrollable-container {
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

.user-row {
    animation: fadeInUp 0.4s ease forwards;
}

.user-row:nth-child(1) { animation-delay: 0.1s; }
.user-row:nth-child(2) { animation-delay: 0.15s; }
.user-row:nth-child(3) { animation-delay: 0.2s; }
.user-row:nth-child(4) { animation-delay: 0.25s; }
.user-row:nth-child(5) { animation-delay: 0.3s; }

/* Responsive Design */
@media (max-width: 1200px) {
    .management-controls {
        grid-template-columns: 1fr;
    }
    
    .users-scrollable-container {
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
    
    .users-content-wrapper {
        border-radius: 20px 20px 0 0;
        padding: 2rem 0 1rem;
    }

    .users-content-container {
        padding: 0 1rem;
    }

    .table-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
        padding: 1.5rem;
    }

    .table-container {
        padding: 1.5rem;
    }

    .action-buttons {
        flex-direction: column;
        gap: 0.5rem;
    }

    .btn {
        width: 100%;
        padding: 0.5rem 0.75rem;
        font-size: 0.8rem;
    }

    .users-table {
        min-width: 800px;
    }

    .users-table th,
    .users-table td {
        padding: 1rem 0.75rem;
    }
    
    .role-badge {
        min-width: 100px;
        font-size: 0.75rem;
        padding: 0.375rem 0.75rem;
    }

    .user-avatar {
        width: 35px;
        height: 35px;
        font-size: 0.8rem;
    }
    
    .users-scrollable-container {
        max-height: 400px;
    }
}

@media (max-width: 480px) {
    .back-button {
        width: 100%;
        justify-content: center;
        max-width: 200px;
    }
    
    .users-header-section {
        padding: 2rem 0 1rem;
    }

    .users-header-container {
        padding: 0 1rem;
    }

    .header-title {
        font-size: 2rem;
    }

    .search-section,
    .filter-section {
        padding: 1.5rem;
    }

    .users-table {
        min-width: 700px;
    }

    .users-table th,
    .users-table td {
        padding: 0.75rem 0.5rem;
    }
    
    .users-scrollable-container {
        max-height: 350px;
        padding: 0.75rem;
    }
}

/* Focus States for Accessibility */
.search-input:focus,
.role-select:focus,
.filter-btn:focus,
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

<!-- FontAwesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Enhanced Search Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced search functionality
    const searchInput = document.getElementById("searchInput");
    const userRows = document.querySelectorAll("#userTableBody .user-row");
    
    if (searchInput) {
        searchInput.addEventListener("keyup", function() {
            const searchText = this.value.toLowerCase().trim();
            let visibleCount = 0;
            
            userRows.forEach(row => {
                const nameCell = row.querySelector('.user-name');
                const emailCell = row.querySelector('.user-email');
                
                if (nameCell && emailCell) {
                    const name = nameCell.textContent.toLowerCase();
                    const email = emailCell.textContent.toLowerCase();
                    
                    if (name.includes(searchText) || email.includes(searchText)) {
                        row.style.display = "";
                        visibleCount++;
                        // Add search highlight animation
                        row.style.animation = 'fadeInUp 0.3s ease forwards';
                    } else {
                        row.style.display = "none";
                    }
                }
            });
            
            // Update user count if element exists
            const userCountElement = document.querySelector('.user-count');
            if (userCountElement) {
                const totalText = userCountElement.textContent;
                const newText = searchText ? 
                    `Found: ${visibleCount} users` : 
                    totalText;
                userCountElement.innerHTML = `<i class="fas fa-info-circle"></i> ${newText}`;
            }
        });
    }

    // Enhanced button interactions
    const buttons = document.querySelectorAll('.btn, .filter-btn');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px) scale(1.02)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });

    // Enhanced table row interactions
    const tableRows = document.querySelectorAll('.user-row');
    tableRows.forEach((row, index) => {
        // Stagger animation on load
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            row.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, index * 50);

        // Enhanced hover effect
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 4px 12px rgba(0, 0, 0, 0.1)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    });

    // Enhanced form interactions
    const formInputs = document.querySelectorAll('.search-input, .role-select');
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.closest('.search-input-wrapper, .filter-input-wrapper').style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.closest('.search-input-wrapper, .filter-input-wrapper').style.transform = '';
        });
    });

    // Role badge interactions
    const roleBadges = document.querySelectorAll('.role-badge');
    roleBadges.forEach(badge => {
        badge.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.2)';
        });
        
        badge.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = 'var(--shadow-subtle)';
        });
    });

    // Delete confirmation enhancement
    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const userName = this.closest('.user-row').querySelector('.user-name').textContent;
            const confirmation = confirm(`Are you sure you want to delete user "${userName}"? This action cannot be undone.`);
            
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
        const tableCard = document.querySelector('.table-card');
        if (tableCard) {
            tableCard.style.animation = 'successPulse 0.6s ease';
        }
    }

    // Initialize tooltips for action buttons
    const actionButtons = document.querySelectorAll('.btn');
    actionButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            const btnText = this.querySelector('span').textContent;
            this.title = `${btnText} this user`;
        });
    });

    // Smooth scrolling for scrollable container
    const scrollableContainer = document.getElementById('usersScrollContainer');
    if (scrollableContainer) {
        scrollableContainer.style.scrollBehavior = 'smooth';
    }

    console.log('🚀 Professional User Management with Scrollable Table loaded successfully!');
});

// Add CSS for success pulse animation
const styleSheet = document.createElement('style');
styleSheet.textContent = `
    @keyframes successPulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.02); }
        100% { transform: scale(1); }
    }
    
    .success-flash {
        animation: successPulse 0.6s ease;
    }
`;
document.head.appendChild(styleSheet);
</script>

@endsection