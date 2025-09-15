@extends('layouts.app')

@section('content')
<div class="edit-user-page">
    <!-- Professional Header Section -->
    <section class="edit-header-section">
        <div class="edit-header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-user-edit"></i>
                    <span>User Management</span>
                </div>
                <h1 class="header-title">Edit User</h1>
                <p class="header-description">Update user account information and permissions</p>
                <div class="header-breadcrumb">
                    <a href="{{ route('admin.users') }}" class="breadcrumb-link">
                        <i class="fas fa-users"></i>
                        <span>User Management</span>
                    </a>
                    <i class="fas fa-chevron-right"></i>
                    <span class="breadcrumb-current">Edit User</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Wrapper -->
    <div class="edit-content-wrapper">
        <div class="edit-content-container">
            
            <!-- Success Alert -->
            @if (session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- User Information Card -->
            <div class="user-info-card">
                <div class="user-header">
                    <div class="user-avatar-large">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div class="user-details">
                        <h3 class="username">{{ $user->name }}</h3>
                        <p class="user-email">{{ $user->email }}</p>
                        <span class="current-role-badge role-{{ strtolower($user->role) }}">
                            <i class="fas fa-user-tag"></i>
                            Current Role: {{ ucfirst($user->role) }}
                        </span>
                        @if($user->role === 'careerM' && $user->company_name)
                            <div class="company-info">
                                <i class="fas fa-building"></i>
                                <span>Company: {{ $user->company_name }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Edit Form Card -->
            <div class="form-card">
                <div class="form-header">
                    <h3 class="form-title">
                        <i class="fas fa-edit"></i>
                        Update User Information
                    </h3>
                    <p class="form-subtitle">Modify account details and role permissions</p>
                </div>

                <div class="form-container">
                    <form method="POST" action="{{ route('admin.updateUser', $user->id) }}" class="edit-user-form">
                        @csrf
                        @method('PATCH')

                        <div class="form-grid">
                            <div class="form-group">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user"></i>
                                    Full Name<span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="text" id="name" name="name" 
                                           value="{{ old('name', $user->name) }}" 
                                           class="form-control @error('name') is-invalid @enderror" 
                                           required placeholder="Enter full name">
                                    @error('name') 
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i>
                                    Email Address<span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="email" id="email" name="email" 
                                           value="{{ old('email', $user->email) }}" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           required placeholder="Enter email address">
                                    @error('email') 
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group form-group-full">
                                <label for="role" class="form-label">
                                    <i class="fas fa-user-shield"></i>
                                    User Role<span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <select id="role" name="role" class="form-control @error('role') is-invalid @enderror" required>
                                        <option value="">Select a role</option>
                                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                                            👤 User - Standard platform access
                                        </option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                            🛡️ Admin - Full system administration
                                        </option>
                                        <option value="instructor" {{ $user->role === 'instructor' ? 'selected' : '' }}>
                                            👨‍🏫 Instructor - Course management
                                        </option>
                                        <option value="careerM" {{ $user->role === 'careerM' ? 'selected' : '' }}>
                                            👔 Career Manager - Career guidance
                                        </option>
                                    </select>
                                    @error('role') 
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="role-help-text">
                                    <i class="fas fa-info-circle"></i>
                                    Choose the appropriate role based on the user's responsibilities and required access level.
                                </div>
                            </div>

                            <!-- Company Name Field - Shown only for Career Manager -->
                            <div class="form-group form-group-full company-field" id="company-field" 
                                 style="display: {{ $user->role === 'careerM' ? 'block' : 'none' }};">
                                <label for="company_name" class="form-label">
                                    <i class="fas fa-building"></i>
                                    Company Name<span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <input type="text" id="company_name" name="company_name" 
                                           value="{{ old('company_name', $user->company_name) }}" 
                                           class="form-control @error('company_name') is-invalid @enderror" 
                                           placeholder="Enter company name"
                                           {{ $user->role === 'careerM' ? 'required' : '' }}>
                                    @error('company_name') 
                                        <div class="error-message">
                                            <i class="fas fa-exclamation-circle"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="company-help-text">
                                    <i class="fas fa-info-circle"></i>
                                    Specify the company this career manager will be associated with.
                                </div>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                <span>Update User</span>
                            </button>
                            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('admin.users') }}'">
                                <i class="fas fa-times"></i>
                                <span>Cancel</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Action History Card (Optional) -->
            <div class="info-card">
                <div class="info-header">
                    <h3 class="info-title">
                        <i class="fas fa-info-circle"></i>
                        Account Information
                    </h3>
                </div>
                <div class="info-content">
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">User ID</span>
                            <span class="info-value">#{{ $user->id }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Account Created</span>
                            <span class="info-value">{{ $user->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Last Updated</span>
                            <span class="info-value">{{ $user->updated_at->format('M d, Y') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Account Status</span>
                            <span class="info-value status-active">
                                <i class="fas fa-check-circle"></i>
                                Active
                            </span>
                        </div>
                        @if($user->role === 'careerM' && $user->company_name)
                        <div class="info-item">
                            <span class="info-label">Associated Company</span>
                            <span class="info-value">{{ $user->company_name }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Professional Edit User System Styles */
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
.edit-user-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
    overflow-x: hidden;
}

.edit-user-page::before {
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
.edit-header-section {
    position: relative;
    z-index: 2;
    padding: 4rem 0 2rem;
    color: white;
}

.edit-header-container {
    max-width: 1200px;
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
    line-height: 1.6;
}

.header-breadcrumb {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    margin-top: 1.5rem;
    font-size: 0.95rem;
    opacity: 0.9;
}

.breadcrumb-link {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: white;
    text-decoration: none;
    transition: all var(--animation-speed) var(--animation-curve);
}

.breadcrumb-link:hover {
    color: #fbbf24;
    transform: translateY(-1px);
}

.breadcrumb-current {
    font-weight: 600;
}

/* Content Wrapper */
.edit-content-wrapper {
    position: relative;
    z-index: 2;
    background: var(--surface-light);
    border-radius: 40px 40px 0 0;
    margin-top: -1rem;
    padding: 3rem 0 2rem;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
}

.edit-content-container {
    max-width: 800px;
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

/* User Information Card */
.user-info-card {
    background: var(--surface-white);
    border-radius: var(--border-radius);
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    position: relative;
    overflow: hidden;
}

.user-info-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--primary-gradient);
}

.user-header {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.user-avatar-large {
    width: 80px;
    height: 80px;
    background: var(--primary-gradient);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    font-weight: 700;
    flex-shrink: 0;
}

.user-details {
    flex: 1;
}

.username {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 0.5rem 0;
}

.user-email {
    font-size: 1rem;
    color: var(--text-secondary);
    margin: 0 0 1rem 0;
}

.current-role-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: capitalize;
    margin-bottom: 0.5rem;
}

.company-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-top: 0.5rem;
}

.company-info i {
    color: var(--accent-color);
}

.role-admin { background: linear-gradient(135deg, #2563eb, #1d4ed8); color: white; }
.role-instructor { background: linear-gradient(135deg, #10b981, #059669); color: white; }
.role-careerm { background: linear-gradient(135deg, #f59e0b, #d97706); color: white; }
.role-hr { background: linear-gradient(135deg, #8b5cf6, #7c3aed); color: white; }
.role-user { background: linear-gradient(135deg, #6b7280, #4b5563); color: white; }

/* Form Card */
.form-card {
    background: var(--surface-white);
    border-radius: var(--border-radius-large);
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    overflow: hidden;
    margin-bottom: 2rem;
}

.form-header {
    background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
    padding: 2rem 2.5rem;
    border-bottom: 1px solid var(--border-light);
}

.form-title {
    margin: 0 0 0.5rem 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.form-title i {
    color: var(--primary-color);
}

.form-subtitle {
    margin: 0;
    font-size: 0.875rem;
    color: var(--text-light);
}

/* Form Styles */
.form-container {
    padding: 2.5rem;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group-full {
    grid-column: 1 / -1;
}

/* Company Field Specific Styles */
.company-field {
    opacity: 1;
    transform: translateY(0);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    margin-top: 1.5rem;
}

.company-field.hide {
    opacity: 0;
    transform: translateY(-20px);
    margin-top: 0;
}

.company-help-text {
    margin-top: 0.75rem;
    font-size: 0.875rem;
    color: var(--text-light);
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    line-height: 1.5;
}

.company-help-text i {
    margin-top: 0.125rem;
    flex-shrink: 0;
    color: var(--accent-color);
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: var(--text-primary);
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
}

.form-label i {
    color: var(--text-light);
    width: 16px;
}

.required {
    color: #ef4444;
    margin-left: 3px;
}

.input-wrapper {
    position: relative;
}

.form-control {
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

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    transform: translateY(-1px);
}

.form-control::placeholder {
    color: var(--text-light);
}

.is-invalid {
    border-color: #ef4444 !important;
    background-color: #fef2f2;
}

.error-message {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
}

.role-help-text {
    margin-top: 0.75rem;
    font-size: 0.875rem;
    color: var(--text-light);
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    line-height: 1.5;
}

.role-help-text i {
    margin-top: 0.125rem;
    flex-shrink: 0;
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    padding-top: 2rem;
    border-top: 1px solid var(--border-light);
}

.btn {
    padding: 1rem 2rem;
    border: none;
    border-radius: 12px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    text-decoration: none;
    min-width: 140px;
    justify-content: center;
}

.btn-primary {
    background: var(--primary-gradient);
    color: white;
    box-shadow: var(--shadow-medium);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-large);
}

.btn-secondary {
    background: var(--surface-gray);
    color: var(--text-secondary);
    border: 2px solid var(--border-light);
}

.btn-secondary:hover {
    background: var(--text-secondary);
    color: white;
    transform: translateY(-2px);
}

/* Info Card */
.info-card {
    background: var(--surface-white);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    overflow: hidden;
}

.info-header {
    background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
    padding: 1.5rem 2rem;
    border-bottom: 1px solid var(--border-light);
}

.info-title {
    margin: 0;
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.info-content {
    padding: 2rem;
}

.info-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.info-item {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.info-label {
    font-size: 0.875rem;
    color: var(--text-light);
    font-weight: 500;
}

.info-value {
    font-size: 1rem;
    color: var(--text-primary);
    font-weight: 600;
}

.status-active {
    color: var(--success-color) !important;
    display: flex;
    align-items: center;
    gap: 0.5rem;
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

.user-info-card,
.form-card,
.info-card {
    animation: fadeInUp 0.6s ease forwards;
}

.user-info-card { animation-delay: 0.1s; }
.form-card { animation-delay: 0.2s; }
.info-card { animation-delay: 0.3s; }

/* Responsive Design */
@media (max-width: 768px) {
    .edit-content-wrapper {
        border-radius: 20px 20px 0 0;
        padding: 2rem 0 1rem;
    }

    .edit-content-container {
        padding: 0 1rem;
    }

    .user-header {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }

    .form-container {
        padding: 2rem;
    }

    .form-actions {
        flex-direction: column;
    }

    .btn {
        width: 100%;
    }

    .info-grid {
        grid-template-columns: 1fr;
    }

    .header-breadcrumb {
        flex-direction: column;
        gap: 0.5rem;
    }
}

@media (max-width: 480px) {
    .edit-header-section {
        padding: 2rem 0 1rem;
    }

    .edit-header-container {
        padding: 0 1rem;
    }

    .header-title {
        font-size: 2rem;
    }

    .user-info-card,
    .form-card,
    .info-card {
        padding: 1.5rem;
    }

    .form-container {
        padding: 1.5rem;
    }
}

/* Focus States for Accessibility */
.form-control:focus,
.btn:focus,
.breadcrumb-link:focus {
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
    .user-info-card,
    .form-card,
    .info-card {
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Enhanced JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced form interactions
    const formInputs = document.querySelectorAll('.form-control');
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.closest('.form-group').style.transform = 'scale(1.02)';
        });
        
        input.addEventListener('blur', function() {
            this.closest('.form-group').style.transform = '';
        });

        // Real-time validation feedback
        input.addEventListener('input', function() {
            if (this.hasAttribute('required') && this.value.trim() === '') {
                this.classList.add('is-invalid');
            } else {
                this.classList.remove('is-invalid');
            }
        });
    });

    // Enhanced button interactions
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px) scale(1.02)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });

    // Company field toggle functionality
    const roleSelect = document.getElementById('role');
    const companyField = document.getElementById('company-field');
    const companyInput = document.getElementById('company_name');

    function toggleCompanyField() {
        if (roleSelect.value === 'careerM') {
            companyField.style.display = 'block';
            setTimeout(() => {
                companyField.classList.remove('hide');
            }, 10);
            companyInput.setAttribute('required', 'required');
        } else {
            companyField.classList.add('hide');
            companyInput.removeAttribute('required');
            companyInput.value = ''; // Clear the field
            setTimeout(() => {
                if (companyField.classList.contains('hide')) {
                    companyField.style.display = 'none';
                }
            }, 400);
        }
    }

    // Initialize company field visibility on page load
    if (roleSelect) {
        roleSelect.addEventListener('change', toggleCompanyField);
    }

    // Form submission with loading state
    const form = document.querySelector('.edit-user-form');
    if (form) {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('.btn-primary');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <span>Updating...</span>';
            submitBtn.disabled = true;
        });
    }

    // Role change preview
    const currentRoleBadge = document.querySelector('.current-role-badge');
    
    if (roleSelect && currentRoleBadge) {
        roleSelect.addEventListener('change', function() {
            const selectedRole = this.value;
            const roleText = this.options[this.selectedIndex].text;
            
            if (selectedRole) {
                // Update badge preview
                currentRoleBadge.className = `current-role-badge role-${selectedRole.toLowerCase()}`;
                currentRoleBadge.innerHTML = `<i class="fas fa-user-tag"></i> New Role: ${roleText.split(' - ')[0].replace(/^\S+\s/, '')}`;
            }
        });
    }

    // Breadcrumb interactions
    const breadcrumbLinks = document.querySelectorAll('.breadcrumb-link');
    breadcrumbLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        link.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });

    // Success flash animation
    const alert = document.querySelector('.alert-success');
    if (alert) {
        alert.style.animation = 'fadeInUp 0.6s ease forwards';
        
        // Auto-hide after 5 seconds
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-20px)';
            setTimeout(() => {
                alert.remove();
            }, 300);
        }, 5000);
    }

    // User avatar interaction
    const userAvatar = document.querySelector('.user-avatar-large');
    if (userAvatar) {
        userAvatar.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1) rotate(5deg)';
        });
        
        userAvatar.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    }

    // Form validation
    function validateForm() {
        let isValid = true;
        const requiredFields = document.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
            }
        });
        
        // Email validation
        const emailField = document.getElementById('email');
        if (emailField && emailField.value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(emailField.value)) {
                emailField.classList.add('is-invalid');
                isValid = false;
            }
        }
        
        return isValid;
    }

    // Real-time form validation
    formInputs.forEach(input => {
        input.addEventListener('blur', validateForm);
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Save with Ctrl+S
        if (e.ctrlKey && e.key === 's') {
            e.preventDefault();
            if (validateForm()) {
                form.submit();
            }
        }
        
        // Cancel with Escape
        if (e.key === 'Escape') {
            const cancelBtn = document.querySelector('.btn-secondary');
            if (cancelBtn) {
                cancelBtn.click();
            }
        }
    });

    // Info card animations
    const infoItems = document.querySelectorAll('.info-item');
    infoItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            item.style.transition = 'all 0.4s ease';
            item.style.opacity = '1';
            item.style.transform = 'translateY(0)';
        }, 500 + (index * 100));
    });

    // Role badge hover effects
    const roleBadge = document.querySelector('.current-role-badge');
    if (roleBadge) {
        roleBadge.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.boxShadow = '0 4px 15px rgba(0, 0, 0, 0.2)';
        });
        
        roleBadge.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    }

    console.log('🚀 Professional Edit User page loaded successfully!');
});
</script>

@endsection