@extends('layouts.app')

@section('content')
<div class="register-page">
    <!-- Professional Header Section -->
    <section class="header-section">
        <div class="header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-user-plus"></i>
                    <span>Join SkillHub</span>
                </div>
                <h1 class="header-title">Create Your Account</h1>
                <p class="header-description">Start your learning journey with thousands of courses and resources</p>
            </div>
            <div class="floating-elements">
                <div class="floating-icon">
                    <i class="fas fa-rocket"></i>
                </div>
                <div class="floating-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="floating-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-container">
            <!-- Registration Form Card -->
            <div class="card register-card">
                <div class="card-header">
                    <div class="section-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h2 class="card-title">Create New Account</h2>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" class="register-form">
                        @csrf

                        <!-- Name -->
                        <div class="form-group">
                            <label for="name" class="form-label">
                                <i class="fas fa-user"></i>
                                Full Name<span class="required">*</span>
                            </label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   required autofocus autocomplete="name" placeholder="Enter your full name">
                            @error('name')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email Address -->
                        <div class="form-group">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope"></i>
                                Email Address<span class="required">*</span>
                            </label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   required autocomplete="username" placeholder="Enter your email address">
                            @error('email')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i>
                                Password<span class="required">*</span>
                            </label>
                            <div class="password-input-wrapper">
                                <input id="password" type="password" name="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       required autocomplete="new-password" placeholder="Create a secure password">
                                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye" id="password-icon"></i>
                                </button>
                            </div>
                            <div class="password-strength" id="password-strength">
                                <div class="strength-bar">
                                    <div class="strength-fill" id="strength-fill"></div>
                                </div>
                                <span class="strength-text" id="strength-text">Password strength</span>
                            </div>
                            @error('password')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">
                                <i class="fas fa-lock"></i>
                                Confirm Password<span class="required">*</span>
                            </label>
                            <div class="password-input-wrapper">
                                <input id="password_confirmation" type="password" name="password_confirmation" 
                                       class="form-control @error('password_confirmation') is-invalid @enderror" 
                                       required autocomplete="new-password" placeholder="Confirm your password">
                                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye" id="password_confirmation-icon"></i>
                                </button>
                            </div>
                            <div class="password-match" id="password-match" style="display: none;">
                                <i class="fas fa-check-circle"></i>
                                <span>Passwords match</span>
                            </div>
                            @error('password_confirmation')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Terms Agreement -->
                        <div class="form-group">
                            <label for="terms" class="checkbox-label">
                                <input id="terms" type="checkbox" name="terms" class="checkbox-input" required>
                                <span class="checkbox-custom"></span>
                                <span class="checkbox-text">
                                    I agree to the <a href="#" class="terms-link">Terms of Service</a> 
                                    and <a href="#" class="terms-link">Privacy Policy</a>
                                </span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-user-plus"></i>
                            Create Account
                        </button>

                        <!-- Login Link -->
                        <div class="login-link">
                            <span>Already have an account?</span>
                            <a href="{{ route('login') }}" class="login-now-link">
                                Sign In
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Benefits Card -->
            <div class="card benefits-card">
                <div class="card-header benefits-header">
                    <div class="section-icon benefits-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <h2 class="card-title">Why Join SkillHub?</h2>
                </div>
                <div class="card-body">
                    <div class="benefits-list">
                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="benefit-content">
                                <h4 class="benefit-title">Expert-Led Courses</h4>
                                <p class="benefit-description">Learn from industry professionals with years of experience</p>
                            </div>
                        </div>

                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div class="benefit-content">
                                <h4 class="benefit-title">Career Services</h4>
                                <p class="benefit-description">Get expert career advice and job placement assistance</p>
                            </div>
                        </div>

                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="benefit-content">
                                <h4 class="benefit-title">Job Opportunities</h4>
                                <p class="benefit-description">Access exclusive job listings and career opportunities</p>
                            </div>
                        </div>

                        <div class="benefit-item">
                            <div class="benefit-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <div class="benefit-content">
                                <h4 class="benefit-title">Learn Anywhere</h4>
                                <p class="benefit-description">Access courses on any device, anytime</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(fieldId) {
        const passwordInput = document.getElementById(fieldId);
        const passwordIcon = document.getElementById(fieldId + '-icon');
        
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            passwordIcon.className = 'fas fa-eye-slash';
        } else {
            passwordInput.type = 'password';
            passwordIcon.className = 'fas fa-eye';
        }
    }

    function checkPasswordStrength(password) {
        let strength = 0;
        const checks = {
            length: password.length >= 8,
            lowercase: /[a-z]/.test(password),
            uppercase: /[A-Z]/.test(password),
            numbers: /\d/.test(password),
            special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
        };

        strength = Object.values(checks).filter(Boolean).length;

        const strengthFill = document.getElementById('strength-fill');
        const strengthText = document.getElementById('strength-text');

        const levels = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
        const colors = ['#ef4444', '#f97316', '#eab308', '#22c55e', '#16a34a'];

        if (password.length === 0) {
            strengthFill.style.width = '0%';
            strengthFill.style.backgroundColor = '#e5e7eb';
            strengthText.textContent = 'Password strength';
            strengthText.style.color = '#6b7280';
            return;
        }

        const percentage = (strength / 5) * 100;
        strengthFill.style.width = percentage + '%';
        strengthFill.style.backgroundColor = colors[strength - 1] || colors[0];
        strengthText.textContent = levels[strength - 1] || levels[0];
        strengthText.style.color = colors[strength - 1] || colors[0];
    }

    function checkPasswordMatch() {
        const password = document.getElementById('password').value;
        const confirmation = document.getElementById('password_confirmation').value;
        const matchIndicator = document.getElementById('password-match');

        if (confirmation.length > 0) {
            if (password === confirmation) {
                matchIndicator.style.display = 'flex';
                matchIndicator.style.color = '#16a34a';
                matchIndicator.innerHTML = '<i class="fas fa-check-circle"></i><span>Password match</span>';
            } else {
                matchIndicator.style.display = 'flex';
                matchIndicator.style.color = '#ef4444';
                matchIndicator.innerHTML = '<i class="fas fa-times-circle"></i><span>Password do not match</span>';
            }
        } else {
            matchIndicator.style.display = 'none';
        }
    }

    // Enhanced form interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Form field animations
        document.querySelectorAll('.form-control').forEach(element => {
            element.addEventListener('focus', function() {
                this.closest('.form-group').classList.add('focused');
            });
            
            element.addEventListener('blur', function() {
                this.closest('.form-group').classList.remove('focused');
            });
        });

        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            checkPasswordStrength(this.value);
        });

        // Password match checker
        document.getElementById('password_confirmation').addEventListener('input', checkPasswordMatch);
        document.getElementById('password').addEventListener('input', checkPasswordMatch);

        // Floating animation for header icons
        const floatingIcons = document.querySelectorAll('.floating-icon');
        floatingIcons.forEach((icon, index) => {
            icon.style.animationDelay = `${index * 0.5}s`;
        });

        console.log('🎨 Professional Registration Form loaded!');
    });
</script>

<style>
/* Professional Registration System Styles */
:root {
    /* Primary Color Scheme - Matching LMS and Challenge pages */
    --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
    --primary-color: #2563eb;
    --primary-dark: #1d4ed8;
    --accent-color: #10b981;
    
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
.register-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
    overflow-x: hidden;
}

.register-page::before {
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

/* Floating Elements */
.floating-elements {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    position: relative;
}

.floating-icon {
    width: 60px;
    height: 60px;
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    backdrop-filter: blur(20px);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    animation: float 3s ease-in-out infinite;
}

.floating-icon:nth-child(2) {
    animation-delay: 1s;
    margin-left: 2rem;
}

.floating-icon:nth-child(3) {
    animation-delay: 2s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
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
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: start;
}

/* Card Styles */
.card {
    background: var(--surface-white);
    border-radius: var(--border-radius-large);
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    overflow: hidden;
}

.register-card {
    animation: slideInLeft 0.8s ease forwards;
}

.benefits-card {
    animation: slideInRight 0.8s ease forwards;
}

.card-header {
    background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
    padding: 2rem 2.5rem;
    border-bottom: 1px solid var(--border-light);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.benefits-header {
    background: linear-gradient(135deg, #fef7e6 0%, #fff3cd 100%);
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

.benefits-icon {
    background: linear-gradient(135deg, #f59e0b, #f97316);
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

/* Form Styles */
.form-group {
    margin-bottom: 2rem;
    transition: transform var(--animation-speed) var(--animation-curve);
}

.form-group.focused {
    transform: scale(1.02);
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

/* Form Controls */
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

/* Password Input */
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
    border-radius: 50%;
    transition: all var(--animation-speed) var(--animation-curve);
}

.password-toggle:hover {
    background: var(--surface-light);
    color: var(--text-primary);
}

/* Password Strength */
.password-strength {
    margin-top: 0.5rem;
}

.strength-bar {
    width: 100%;
    height: 4px;
    background: #e5e7eb;
    border-radius: 2px;
    overflow: hidden;
    margin-bottom: 0.25rem;
}

.strength-fill {
    height: 100%;
    width: 0%;
    background: #e5e7eb;
    border-radius: 2px;
    transition: all var(--animation-speed) var(--animation-curve);
}

.strength-text {
    font-size: 0.75rem;
    color: #6b7280;
    font-weight: 500;
}

/* Password Match */
.password-match {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 0.5rem;
    font-size: 0.875rem;
    font-weight: 500;
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

/* Custom Checkbox */
.checkbox-label {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    cursor: pointer;
    font-size: 0.875rem;
    color: var(--text-secondary);
    line-height: 1.5;
}

.checkbox-input {
    display: none;
}

.checkbox-custom {
    width: 20px;
    height: 20px;
    border: 2px solid var(--border-light);
    border-radius: 4px;
    background: var(--surface-white);
    transition: all var(--animation-speed) var(--animation-curve);
    position: relative;
    flex-shrink: 0;
    margin-top: 2px;
}

.checkbox-input:checked + .checkbox-custom {
    background: var(--primary-color);
    border-color: var(--primary-color);
}

.checkbox-input:checked + .checkbox-custom::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 12px;
    font-weight: bold;
}

.terms-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
}

.terms-link:hover {
    text-decoration: underline;
}

/* Submit Button */
.btn-submit {
    width: 100%;
    background: var(--primary-gradient);
    color: white;
    font-weight: 700;
    padding: 1.25rem 2rem;
    font-size: 1.15rem;
    border-radius: 12px;
    border: none;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    position: relative;
    overflow: hidden;
    margin-bottom: 1.5rem;
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

/* Login Link */
.login-link {
    text-align: center;
    color: var(--text-secondary);
    font-size: 0.875rem;
}

.login-now-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 600;
    margin-left: 0.5rem;
}

.login-now-link:hover {
    text-decoration: underline;
}

/* Benefits List */
.benefits-list {
    display: grid;
    gap: 2rem;
}

.benefit-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.benefit-icon {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #f59e0b, #f97316);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.benefit-content {
    flex: 1;
}

.benefit-title {
    margin: 0 0 0.5rem 0;
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
}

.benefit-description {
    margin: 0;
    color: var(--text-secondary);
    line-height: 1.5;
}

/* Animations */
@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

/* Responsive Design */
@media (max-width: 1024px) {
    .content-container {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .header-container {
        flex-direction: column;
        text-align: center;
    }
    
    .floating-elements {
        flex-direction: row;
        justify-content: center;
        gap: 1rem;
    }
    
    .floating-icon:nth-child(2) {
        margin-left: 0;
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

    .form-control {
        padding: 0.875rem 1rem;
    }
    
    .floating-elements {
        display: none;
    }
    
    .benefits-list {
        gap: 1.5rem;
    }
    
    .benefit-item {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
}

/* Focus States for Accessibility */
.btn-submit:focus,
.form-control:focus,
.checkbox-label:focus,
.terms-link:focus,
.login-now-link:focus {
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
</style>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection