@extends('layouts.app')

@section('content')
<div class="profile-page">
    <!-- Professional Header Section -->
    <section class="profile-header-section">
        <div class="profile-header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-user-cog"></i>
                    <span>Account Settings</span>
                </div>
                <h1 class="header-title">Profile Management</h1>
                <p class="header-description">Manage your account information, security settings, and preferences</p>
            </div>
        </div>
    </section>

    <!-- Content Wrapper -->
    <div class="profile-content-wrapper">
        <div class="profile-content-container">
            
            <!-- Profile Information Section -->
            <div class="profile-card">
                <div class="card-header">
                    <div class="section-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <h2 class="card-title">Profile Information</h2>
                    <p class="card-subtitle">Update your account's profile information and email address</p>
                </div>
                <div class="card-body">
                    <!-- Email Verification Form (Hidden) -->
                    <form id="send-verification" method="post" action="{{ route('verification.send') }}" style="display: none;">
                        @csrf
                    </form>

                    <!-- Profile Update Form -->
                    <form method="post" action="{{ route('profile.update') }}" class="profile-form">
                        @csrf
                        @method('patch')

                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="fas fa-user"></i>
                                Full Name<span class="required">*</span>
                            </label>
                            <input type="text" id="name" name="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', $user->name) }}" 
                                   required autofocus autocomplete="name" 
                                   placeholder="Enter your full name">
                            @error('name')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i>
                                Email Address<span class="required">*</span>
                            </label>
                            <input type="email" id="email" name="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email', $user->email) }}" 
                                   required autocomplete="username" 
                                   placeholder="Enter your email address">
                            @error('email')
                                <span class="form-error">{{ $message }}</span>
                            @enderror

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="verification-notice">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <div class="verification-content">
                                        <p class="verification-text">Your email address is unverified.</p>
                                        <button form="send-verification" class="btn-verify">
                                            <i class="fas fa-paper-plane"></i>
                                            Click here to re-send the verification email
                                        </button>
                                    </div>
                                </div>
                                @if (session('status') === 'verification-link-sent')
                                    <div class="verification-sent">
                                        <i class="fas fa-check-circle"></i>
                                        A new verification link has been sent to your email address.
                                    </div>
                                @endif
                            @endif
                        </div>

                        <!-- Company Name Field - Only for Career Managers -->
                        @if($user->role === 'careerM')
                            <div class="form-group">
                                <label for="company_name" class="form-label">
                                    <i class="fas fa-building"></i>
                                    Company Name
                                </label>
                                <div class="company-field-wrapper">
                                    <input type="text" id="company_name" name="company_name" 
                                           class="form-control company-readonly" 
                                           value="{{ $user->company_name ?? 'Not Assigned' }}" 
                                           readonly disabled>
                                    <div class="readonly-overlay">
                                        <i class="fas fa-lock"></i>
                                        <span>Read Only</span>
                                    </div>
                                </div>
                                <div class="company-help-text">
                                    <i class="fas fa-info-circle"></i>
                                    Your company assignment is managed by administrators and cannot be changed here.
                                </div>
                            </div>
                        @endif

                        <div class="form-submit">
                            <button type="submit" class="btn-save">
                                <i class="fas fa-save"></i>
                                <span>Save Changes</span>
                            </button>
                            @if (session('status') === 'profile-updated')
                                <div class="success-message" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)">
                                    <i class="fas fa-check-circle"></i>
                                    Profile updated successfully!
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Password Update Section -->
            <div class="profile-card">
                <div class="card-header">
                    <div class="section-icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h2 class="card-title">Update Password</h2>
                    <p class="card-subtitle">Ensure your account is using a long, random password to stay secure</p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('password.update') }}" class="password-form">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="current_password" class="form-label">
                                <i class="fas fa-key"></i>
                                Current Password<span class="required">*</span>
                            </label>
                            <div class="password-input-wrapper">
                                <input type="password" id="current_password" name="current_password" 
                                       class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" 
                                       autocomplete="current-password" 
                                       placeholder="Enter your current password">
                                <button type="button" class="password-toggle" onclick="togglePassword('current_password')">
                                    <i class="fas fa-eye" id="current_password_icon"></i>
                                </button>
                            </div>
                            @error('current_password', 'updatePassword')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i>
                                New Password<span class="required">*</span>
                            </label>
                            <div class="password-input-wrapper">
                                <input type="password" id="password" name="password" 
                                       class="form-control @error('password', 'updatePassword') is-invalid @enderror" 
                                       autocomplete="new-password" 
                                       placeholder="Enter your new password">
                                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye" id="password_icon"></i>
                                </button>
                            </div>
                            @error('password', 'updatePassword')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                            <div class="password-strength" id="password-strength">
                                <div class="strength-meter">
                                    <div class="strength-fill" id="strength-fill"></div>
                                </div>
                                <span class="strength-text" id="strength-text">Password strength</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">
                                <i class="fas fa-check-double"></i>
                                Confirm New Password<span class="required">*</span>
                            </label>
                            <div class="password-input-wrapper">
                                <input type="password" id="password_confirmation" name="password_confirmation" 
                                       class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" 
                                       autocomplete="new-password" 
                                       placeholder="Confirm your new password">
                                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye" id="password_confirmation_icon"></i>
                                </button>
                            </div>
                            @error('password_confirmation', 'updatePassword')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-submit">
                            <button type="submit" class="btn-save">
                                <i class="fas fa-shield-alt"></i>
                                <span>Update Password</span>
                            </button>
                            @if (session('status') === 'password-updated')
                                <div class="success-message" x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)">
                                    <i class="fas fa-check-circle"></i>
                                    Password updated successfully!
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Account Section -->
            <div class="profile-card danger-card">
                <div class="card-header">
                    <div class="section-icon danger-icon">
                        <i class="fas fa-trash-alt"></i>
                    </div>
                    <h2 class="card-title">Delete Account</h2>
                    <p class="card-subtitle">Once your account is deleted, all resources and data will be permanently deleted</p>
                </div>
                <div class="card-body">
                    <div class="danger-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div class="warning-content">
                            <h4 class="warning-title">This action cannot be undone</h4>
                            <p class="warning-text">Before deleting your account, please download any data or information that you wish to retain.</p>
                        </div>
                    </div>
                    
                    <div class="form-submit">
                        <button type="button" class="btn-delete" onclick="openDeleteModal()">
                            <i class="fas fa-trash-alt"></i>
                            <span>Delete Account</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal-overlay" style="display: none;">
        <div class="modal-container">
            <div class="modal-header">
                <h3 class="modal-title">Confirm Account Deletion</h3>
                <button type="button" class="modal-close" onclick="closeDeleteModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <p class="modal-text">Are you sure you want to delete your account? This action cannot be undone and all your data will be permanently lost.</p>
                
                <form method="post" action="{{ route('profile.destroy') }}" class="delete-form">
                    @csrf
                    @method('delete')

                    <div class="form-group">
                        <label for="delete_password" class="form-label">
                            <i class="fas fa-key"></i>
                            Enter your password to confirm<span class="required">*</span>
                        </label>
                        <input type="password" id="delete_password" name="password" 
                               class="form-control @error('password', 'userDeletion') is-invalid @enderror" 
                               placeholder="Enter your password" required>
                        @error('password', 'userDeletion')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn-cancel" onclick="closeDeleteModal()">
                            <i class="fas fa-times"></i>
                            <span>Cancel</span>
                        </button>
                        <button type="submit" class="btn-confirm-delete">
                            <i class="fas fa-trash-alt"></i>
                            <span>Delete Account</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Professional Profile Management System Styles */
:root {
    /* Primary Color Scheme - Matching other blades */
    --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
    --primary-color: #2563eb;
    --primary-dark: #1d4ed8;
    --accent-color: #10b981;
    --accent-dark: #059669;
    
    /* Danger colors */
    --danger-color: #ef4444;
    --danger-dark: #dc2626;
    --danger-light: #fef2f2;
    
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
.profile-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
    overflow-x: hidden;
}

.profile-page::before {
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
.profile-header-section {
    position: relative;
    z-index: 2;
    padding: 4rem 0 2rem;
    color: white;
}

.profile-header-container {
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
.profile-content-wrapper {
    position: relative;
    z-index: 2;
    background: var(--surface-light);
    border-radius: 40px 40px 0 0;
    margin-top: -1rem;
    padding: 3rem 0 2rem;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
}

.profile-content-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 2rem;
}

/* Profile Cards */
.profile-card {
    background: var(--surface-white);
    border-radius: var(--border-radius-large);
    margin-bottom: 2rem;
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    overflow: hidden;
    transition: all var(--animation-speed) var(--animation-curve);
}

.profile-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-large);
}

.danger-card {
    border-color: var(--danger-color);
    border-width: 2px;
}

.card-header {
    background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
    padding: 2rem 2.5rem;
    border-bottom: 1px solid var(--border-light);
    display: flex;
    align-items: flex-start;
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
    flex-shrink: 0;
}

.danger-icon {
    background: linear-gradient(135deg, var(--danger-color), var(--danger-dark));
}

.card-title {
    margin: 0 0 0.5rem 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
}

.card-subtitle {
    margin: 0;
    font-size: 0.95rem;
    color: var(--text-light);
    line-height: 1.5;
}

.card-body {
    padding: 2.5rem;
}

/* Form Styling */
.profile-form,
.password-form,
.delete-form {
    margin: 0;
}

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
}

.form-label i {
    color: var(--text-light);
    width: 16px;
}

.required {
    color: var(--danger-color);
    margin-left: 3px;
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

.is-invalid {
    border-color: var(--danger-color) !important;
    background-color: var(--danger-light);
}

.form-error {
    color: var(--danger-color);
    font-size: 0.875rem;
    margin-top: 0.5rem;
    display: block;
    font-weight: 500;
}

/* Company Field Specific Styles */
.company-field-wrapper {
    position: relative;
}

.company-readonly {
    background: var(--surface-light) !important;
    color: var(--text-secondary) !important;
    cursor: not-allowed !important;
    font-weight: 600;
    padding-right: 4rem !important;
}

.readonly-overlay {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.75rem;
    color: var(--text-light);
    background: var(--surface-white);
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    border: 1px solid var(--border-light);
    font-weight: 500;
    pointer-events: none;
}

.readonly-overlay i {
    font-size: 0.6rem;
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

/* Password Input Wrapper */
.password-input-wrapper {
    position: relative;
}

.password-toggle {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--text-light);
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 4px;
    transition: all var(--animation-speed) var(--animation-curve);
}

.password-toggle:hover {
    color: var(--primary-color);
    background: var(--surface-light);
}

/* Password Strength Meter */
.password-strength {
    margin-top: 0.75rem;
}

.strength-meter {
    width: 100%;
    height: 4px;
    background: var(--surface-gray);
    border-radius: 2px;
    overflow: hidden;
    margin-bottom: 0.5rem;
}

.strength-fill {
    height: 100%;
    width: 0%;
    transition: all var(--animation-speed) var(--animation-curve);
    border-radius: 2px;
}

.strength-weak { background: var(--danger-color); }
.strength-fair { background: #f59e0b; }
.strength-good { background: var(--accent-color); }
.strength-strong { background: var(--primary-color); }

.strength-text {
    font-size: 0.75rem;
    color: var(--text-light);
    font-weight: 500;
}

/* Verification Notice */
.verification-notice {
    margin-top: 1rem;
    padding: 1rem;
    background: #fef3cd;
    border: 1px solid #fde047;
    border-radius: 8px;
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
}

.verification-notice i {
    color: #d97706;
    margin-top: 0.125rem;
    flex-shrink: 0;
}

.verification-content {
    flex: 1;
}

.verification-text {
    margin: 0 0 0.5rem 0;
    color: #92400e;
    font-weight: 500;
}

.btn-verify {
    background: none;
    border: none;
    color: #d97706;
    text-decoration: underline;
    cursor: pointer;
    font-size: 0.875rem;
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
}

.btn-verify:hover {
    color: #92400e;
}

.verification-sent {
    margin-top: 0.75rem;
    padding: 0.75rem;
    background: #dcfce7;
    border: 1px solid #bbf7d0;
    border-radius: 8px;
    color: #166534;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Danger Warning */
.danger-warning {
    background: var(--danger-light);
    border: 1px solid #fecaca;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.danger-warning i {
    color: var(--danger-color);
    font-size: 1.25rem;
    margin-top: 0.125rem;
    flex-shrink: 0;
}

.warning-content {
    flex: 1;
}

.warning-title {
    margin: 0 0 0.5rem 0;
    font-size: 1rem;
    font-weight: 700;
    color: var(--danger-dark);
}

.warning-text {
    margin: 0;
    color: #991b1b;
    line-height: 1.5;
}

/* Form Submit */
.form-submit {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.btn-save {
    background: var(--primary-gradient);
    color: white;
    font-weight: 700;
    padding: 1rem 2rem;
    font-size: 1rem;
    border-radius: 12px;
    border: none;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    position: relative;
    overflow: hidden;
}

.btn-save::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.btn-save:hover::before {
    left: 100%;
}

.btn-save:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-large);
}

.btn-delete {
    background: linear-gradient(135deg, var(--danger-color), var(--danger-dark));
    color: white;
    font-weight: 700;
    padding: 1rem 2rem;
    font-size: 1rem;
    border-radius: 12px;
    border: none;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
}

.btn-delete:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
}

.success-message {
    background: #dcfce7;
    border: 1px solid #bbf7d0;
    color: #166534;
    padding: 0.75rem 1rem;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Modal Styles */
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
}

.modal-container {
    background: var(--surface-white);
    border-radius: var(--border-radius);
    box-shadow: var(--shadow-premium);
    max-width: 500px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
}

.modal-header {
    padding: 2rem 2rem 1rem;
    border-bottom: 1px solid var(--border-light);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-title {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
}

.modal-close {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 4px;
    transition: all var(--animation-speed) var(--animation-curve);
}

.modal-close:hover {
    color: var(--text-primary);
    background: var(--surface-light);
}

.modal-body {
    padding: 2rem;
}

.modal-icon {
    text-align: center;
    margin-bottom: 1.5rem;
}

.modal-icon i {
    font-size: 3rem;
    color: var(--danger-color);
}

.modal-text {
    text-align: center;
    color: var(--text-secondary);
    margin-bottom: 2rem;
    line-height: 1.6;
}

.modal-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
}

.btn-cancel {
    background: var(--surface-gray);
    color: var(--text-secondary);
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

.btn-cancel:hover {
    background: #e2e8f0;
    color: var(--text-primary);
}

.btn-confirm-delete {
    background: linear-gradient(135deg, var(--danger-color), var(--danger-dark));
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

.btn-confirm-delete:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
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

.profile-card {
    animation: fadeInUp 0.6s ease forwards;
}

.profile-card:nth-child(1) { animation-delay: 0.1s; }
.profile-card:nth-child(2) { animation-delay: 0.2s; }
.profile-card:nth-child(3) { animation-delay: 0.3s; }

@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: scale(0.9);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.modal-container {
    animation: modalFadeIn 0.3s ease forwards;
}

/* Company Field Animation */
@keyframes companyFieldGlow {
    0%, 100% {
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }
    50% {
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
    }
}

.company-readonly:focus {
    animation: companyFieldGlow 2s ease-in-out infinite;
    border-color: var(--accent-color) !important;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .profile-header-container {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 768px) {
    .profile-content-wrapper {
        border-radius: 20px 20px 0 0;
        padding: 2rem 0 1rem;
    }

    .profile-content-container {
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

    .form-submit {
        flex-direction: column;
        align-items: flex-start;
    }

    .btn-save,
    .btn-delete {
        width: 100%;
        justify-content: center;
    }

    .modal-overlay {
        padding: 1rem;
    }

    .modal-actions {
        flex-direction: column;
    }

    .btn-cancel,
    .btn-confirm-delete {
        width: 100%;
        justify-content: center;
    }

    .readonly-overlay {
        position: static;
        transform: none;
        margin-top: 0.5rem;
        justify-content: flex-start;
        width: fit-content;
    }

    .company-readonly {
        padding-right: 1.25rem !important;
    }
}

@media (max-width: 480px) {
    .profile-header-section {
        padding: 2rem 0 1rem;
    }

    .profile-header-container {
        padding: 0 1rem;
    }

    .header-title {
        font-size: 2rem;
    }

    .form-control {
        padding: 0.875rem 1rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    .modal-body {
        padding: 1.5rem;
    }

    .modal-header {
        padding: 1.5rem 1.5rem 1rem;
    }
}

/* Focus States for Accessibility */
.btn-save:focus,
.btn-delete:focus,
.btn-cancel:focus,
.btn-confirm-delete:focus,
.form-control:focus,
.password-toggle:focus {
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

/* High Contrast Mode Support */
@media (prefers-contrast: high) {
    .profile-card {
        border-width: 2px;
    }
    
    .form-control {
        border-width: 2px;
    }
    
    .readonly-overlay {
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

<script>
// Password visibility toggle
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '_icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Password strength checker
function checkPasswordStrength(password) {
    let score = 0;
    let feedback = 'Password strength';
    
    if (password.length >= 8) score++;
    if (password.match(/[a-z]/)) score++;
    if (password.match(/[A-Z]/)) score++;
    if (password.match(/[0-9]/)) score++;
    if (password.match(/[^a-zA-Z0-9]/)) score++;
    
    const strengthFill = document.getElementById('strength-fill');
    const strengthText = document.getElementById('strength-text');
    
    if (!strengthFill || !strengthText) return;
    
    switch(score) {
        case 0:
        case 1:
            strengthFill.style.width = '20%';
            strengthFill.className = 'strength-fill strength-weak';
            feedback = 'Very weak password';
            break;
        case 2:
            strengthFill.style.width = '40%';
            strengthFill.className = 'strength-fill strength-weak';
            feedback = 'Weak password';
            break;
        case 3:
            strengthFill.style.width = '60%';
            strengthFill.className = 'strength-fill strength-fair';
            feedback = 'Fair password';
            break;
        case 4:
            strengthFill.style.width = '80%';
            strengthFill.className = 'strength-fill strength-good';
            feedback = 'Good password';
            break;
        case 5:
            strengthFill.style.width = '100%';
            strengthFill.className = 'strength-fill strength-strong';
            feedback = 'Strong password';
            break;
    }
    
    strengthText.textContent = feedback;
}

// Delete modal functions
function openDeleteModal() {
    document.getElementById('deleteModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeDeleteModal() {
    document.getElementById('deleteModal').style.display = 'none';
    document.body.style.overflow = 'auto';
    // Clear the password field
    document.getElementById('delete_password').value = '';
}

// Enhanced form interactions
document.addEventListener('DOMContentLoaded', function() {
    // Form field focus effects
    document.querySelectorAll('.form-control').forEach(element => {
        element.addEventListener('focus', function() {
            this.closest('.form-group').style.transform = 'scale(1.02)';
        });
        
        element.addEventListener('blur', function() {
            this.closest('.form-group').style.transform = '';
        });
    });

    // Password strength monitoring
    const passwordField = document.getElementById('password');
    if (passwordField) {
        passwordField.addEventListener('input', function() {
            checkPasswordStrength(this.value);
        });
    }

    // Enhanced button interactions
    document.querySelectorAll('.btn-save, .btn-delete, .btn-cancel, .btn-confirm-delete').forEach(button => {
        button.addEventListener('mouseenter', function() {
            if (!this.classList.contains('btn-delete') && !this.classList.contains('btn-confirm-delete')) {
                this.style.transform = 'translateY(-2px) scale(1.02)';
            }
        });
        
        button.addEventListener('mouseleave', function() {
            if (!this.classList.contains('btn-delete') && !this.classList.contains('btn-confirm-delete')) {
                this.style.transform = '';
            }
        });
    });

    // Company field interaction (readonly field click feedback)
    const companyField = document.getElementById('company_name');
    if (companyField) {
        companyField.addEventListener('click', function() {
            // Add a subtle shake animation to indicate it's read-only
            this.style.animation = 'none';
            setTimeout(() => {
                this.style.animation = 'shake 0.5s ease-in-out';
            }, 10);
        });
        
        // Add tooltip on hover
        companyField.addEventListener('mouseenter', function() {
            this.title = 'This field is managed by administrators and cannot be changed';
        });
    }

    // Modal click outside to close
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });

    // Escape key to close modal
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });

    // Show delete modal if there are user deletion errors
    @if($errors->userDeletion->isNotEmpty())
        openDeleteModal();
    @endif

    // Auto-hide success messages
    setTimeout(() => {
        document.querySelectorAll('.success-message').forEach(msg => {
            if (msg.style.display !== 'none') {
                msg.style.opacity = '0';
                msg.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    msg.style.display = 'none';
                }, 300);
            }
        });
    }, 5000);

    console.log('🎨 Professional Profile Management loaded with company field!');
});

// Add shake animation keyframes
const shakeStyle = document.createElement('style');
shakeStyle.textContent = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
`;
document.head.appendChild(shakeStyle);
</script>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<!-- Alpine.js for reactive components -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection