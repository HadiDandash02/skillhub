@extends('layouts.app')

@section('content')
<div class="job-details-page">
    <!-- Header Section -->
    <section class="job-header-section">
        <div class="job-header-container">
            <div class="breadcrumb">
                <a href="{{ route('careerservices') }}" class="breadcrumb-link">
                    <i class="fas fa-arrow-left"></i>
                    Back to Career Services
                </a>
            </div>
            
            <div class="job-header-content">
                <div class="company-info">
                    @if($job->company_logo)
                        <img src="{{ asset('storage/' . $job->company_logo) }}" alt="{{ $job->company }}" class="company-logo">
                    @else
                        <div class="company-logo-placeholder">
                            <i class="fas fa-building"></i>
                        </div>
                    @endif
                    <div class="company-details">
                        <h1 class="job-title">{{ $job->title }}</h1>
                        <div class="company-name">
                            <i class="fas fa-building"></i>
                            <span>{{ $job->company }}</span>
                        </div>
                        <div class="job-meta">
                            <div class="meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $job->location }}</span>
                                @if($job->remote_option)
                                    <span class="remote-badge">Remote Available</span>
                                @endif
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-clock"></i>
                                <span>{{ $job->employment_type ?? 'Full-time' }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-dollar-sign"></i>
                                <span>{{ $job->formatted_salary }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-calendar"></i>
                                <span>Posted {{ $job->posted_date ? $job->posted_date->diffForHumans() : $job->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                @if($job->deadline && now()->startOfDay()->lte($job->deadline->endOfDay()))
                    <div class="deadline-info">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Application deadline: {{ $job->deadline->format('M d, Y') }}</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <div class="job-content-wrapper">
        <div class="job-content-container">
            
            <!-- Feedback Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <div class="job-details-grid">
                <!-- Left Column - Job Details -->
                <div class="job-details-main">
                    
                    <!-- Job Description -->
                    <div class="detail-section">
                        <h3 class="section-title">
                            <i class="fas fa-file-text"></i>
                            Job Description
                        </h3>
                        <div class="section-content">
                            <p>{{ $job->description }}</p>
                        </div>
                    </div>

                    @if($job->responsibilities)
                    <!-- Responsibilities -->
                    <div class="detail-section">
                        <h3 class="section-title">
                            <i class="fas fa-tasks"></i>
                            Key Responsibilities
                        </h3>
                        <div class="section-content">
                            <div class="responsibilities-list">
                                @foreach(explode("\n", $job->responsibilities) as $responsibility)
                                    @if(trim($responsibility))
                                        <div class="responsibility-item">
                                            <i class="fas fa-check"></i>
                                            <span>{{ trim($responsibility) }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($job->requirements)
                    <!-- Requirements -->
                    <div class="detail-section">
                        <h3 class="section-title">
                            <i class="fas fa-clipboard-check"></i>
                            Requirements
                        </h3>
                        <div class="section-content">
                            <div class="requirements-list">
                                @foreach(explode("\n", $job->requirements) as $requirement)
                                    @if(trim($requirement))
                                        <div class="requirement-item">
                                            <i class="fas fa-star"></i>
                                            <span>{{ trim($requirement) }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($job->skills_required && is_array($job->skills_required))
                    <!-- Skills -->
                    <div class="detail-section">
                        <h3 class="section-title">
                            <i class="fas fa-code"></i>
                            Required Skills
                        </h3>
                        <div class="section-content">
                            <div class="skills-tags">
                                @foreach($job->skills_required as $skill)
                                    <span class="skill-tag">{{ $skill }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($job->benefits)
                    <!-- Benefits -->
                    <div class="detail-section">
                        <h3 class="section-title">
                            <i class="fas fa-gift"></i>
                            Benefits & Perks
                        </h3>
                        <div class="section-content">
                            <div class="benefits-list">
                                @foreach(explode("\n", $job->benefits) as $benefit)
                                    @if(trim($benefit))
                                        <div class="benefit-item">
                                            <i class="fas fa-plus"></i>
                                            <span>{{ trim($benefit) }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($job->company_description)
                    <!-- About Company -->
                    <div class="detail-section">
                        <h3 class="section-title">
                            <i class="fas fa-building"></i>
                            About {{ $job->company }}
                        </h3>
                        <div class="section-content">
                            <p>{{ $job->company_description }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right Column - Application Section -->
                <div class="job-application-sidebar">
                    <div class="application-card">
                        @auth
                            @if($hasApplied)
                                <!-- Already Applied -->
                                <div class="applied-status">
                                    <div class="applied-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <h4 class="applied-title">Application Submitted</h4>
                                    <p class="applied-text">You have already applied for this position. We'll be in touch soon!</p>
                                    <a href="{{ route('careerservices') }}" class="btn-secondary">
                                        <i class="fas fa-search"></i>
                                        Browse More Jobs
                                    </a>
                                </div>
                            @else
                                <!-- Application Form -->
                                <div class="application-header">
                                    <h4 class="application-title">Apply for this Position</h4>
                                    <p class="application-subtitle">Fill out the form below to submit your application</p>
                                </div>

                                <form action="{{ route('applyJob', $job->id) }}" method="POST" enctype="multipart/form-data" class="application-form">
                                    @csrf
                                    
                                    <!-- Cover Letter -->
                                    <div class="form-group">
                                        <label for="cover_letter" class="form-label">
                                            <i class="fas fa-edit"></i>
                                            Cover Letter <span class="required">*</span>
                                        </label>
                                        <textarea 
                                            id="cover_letter" 
                                            name="cover_letter" 
                                            class="form-control" 
                                            rows="4" 
                                            required
                                            placeholder="Tell us why you're interested in this position and what makes you a great fit..."
                                        >{{ old('cover_letter') }}</textarea>
                                        @error('cover_letter')
                                            <span class="error-text">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- CV Upload -->
                                    <div class="form-group">
                                        <label for="cv_file" class="form-label">
                                            <i class="fas fa-file-upload"></i>
                                            Upload CV/Resume <span class="required">*</span>
                                        </label>
                                        <div class="file-upload-container">
                                            <input 
                                                type="file" 
                                                id="cv_file" 
                                                name="cv_file" 
                                                class="file-input" 
                                                accept=".pdf,.doc,.docx"
                                                required
                                            >
                                            <label for="cv_file" class="file-upload-label">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                                <span class="file-upload-text">Choose CV file</span>
                                                <span class="file-upload-info">PDF, DOC, DOCX (Max 5MB)</span>
                                            </label>
                                        </div>
                                        @error('cv_file')
                                            <span class="error-text">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Phone -->
                                    <div class="form-group">
                                        <label for="phone" class="form-label">
                                            <i class="fas fa-phone"></i>
                                            Phone Number <span class="required">*</span>
                                        </label>
                                        <input 
                                            type="tel" 
                                            id="phone" 
                                            name="phone" 
                                            class="form-control" 
                                            required
                                            placeholder="+1 (555) 123-4567"
                                            value="{{ old('phone') }}"
                                        >
                                        @error('phone')
                                            <span class="error-text">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- LinkedIn -->
                                    <div class="form-group">
                                        <label for="linkedin_url" class="form-label">
                                            <i class="fab fa-linkedin"></i>
                                            LinkedIn Profile
                                        </label>
                                        <input 
                                            type="url" 
                                            id="linkedin_url" 
                                            name="linkedin_url" 
                                            class="form-control" 
                                            placeholder="https://linkedin.com/in/yourprofile"
                                            value="{{ old('linkedin_url') }}"
                                        >
                                        @error('linkedin_url')
                                            <span class="error-text">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Portfolio -->
                                    <div class="form-group">
                                        <label for="portfolio_url" class="form-label">
                                            <i class="fas fa-globe"></i>
                                            Portfolio Website
                                        </label>
                                        <input 
                                            type="url" 
                                            id="portfolio_url" 
                                            name="portfolio_url" 
                                            class="form-control" 
                                            placeholder="https://yourportfolio.com"
                                            value="{{ old('portfolio_url') }}"
                                        >
                                        @error('portfolio_url')
                                            <span class="error-text">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Availability -->
                                    <div class="form-group">
                                        <label for="availability" class="form-label">
                                            <i class="fas fa-calendar-check"></i>
                                            Availability <span class="required">*</span>
                                        </label>
                                        <select id="availability" name="availability" class="form-control" required>
                                            <option value="">Select availability</option>
                                            <option value="Immediately" {{ old('availability') == 'Immediately' ? 'selected' : '' }}>Immediately</option>
                                            <option value="2 weeks notice" {{ old('availability') == '2 weeks notice' ? 'selected' : '' }}>2 weeks notice</option>
                                            <option value="1 month notice" {{ old('availability') == '1 month notice' ? 'selected' : '' }}>1 month notice</option>
                                            <option value="2-3 months" {{ old('availability') == '2-3 months' ? 'selected' : '' }}>2-3 months</option>
                                            <option value="Other" {{ old('availability') == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('availability')
                                            <span class="error-text">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Salary Expectation -->
                                    <div class="form-group">
                                        <label for="salary_expectation" class="form-label">
                                            <i class="fas fa-dollar-sign"></i>
                                            Salary Expectation
                                        </label>
                                        <input 
                                            type="text" 
                                            id="salary_expectation" 
                                            name="salary_expectation" 
                                            class="form-control" 
                                            placeholder="e.g., $50,000 - $60,000 or Negotiable"
                                            value="{{ old('salary_expectation') }}"
                                        >
                                        @error('salary_expectation')
                                            <span class="error-text">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" class="btn-apply-now">
                                        <i class="fas fa-paper-plane"></i>
                                        <span>Submit Application</span>
                                    </button>
                                </form>
                            @endif
                        @else
                            <!-- Login Required -->
                            <div class="login-required">
                                <div class="login-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <h4 class="login-title">Login Required</h4>
                                <p class="login-text">Please log in to apply for this position</p>
                                <div class="login-actions">
                                    <a href="{{ route('login') }}" class="btn-login">
                                        <i class="fas fa-sign-in-alt"></i>
                                        Login
                                    </a>
                                    <a href="{{ route('register') }}" class="btn-register">
                                        <i class="fas fa-user-plus"></i>
                                        Register
                                    </a>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Professional Job Details Page Styles */
:root {
    --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
    --primary-color: #2563eb;
    --primary-dark: #1d4ed8;
    --accent-color: #10b981;
    --accent-dark: #059669;
    
    --glass-bg: rgba(255, 255, 255, 0.1);
    --glass-border: rgba(255, 255, 255, 0.2);
    
    --text-primary: #1a202c;
    --text-secondary: #4a5568;
    --text-light: #718096;
    
    --surface-white: #ffffff;
    --surface-light: #f7fafc;
    --surface-gray: #edf2f7;
    --border-light: rgba(0, 0, 0, 0.06);
    
    --shadow-subtle: 0 1px 3px rgba(0, 0, 0, 0.05);
    --shadow-medium: 0 4px 12px rgba(0, 0, 0, 0.15);
    --shadow-large: 0 8px 25px rgba(0, 0, 0, 0.2);
    
    --border-radius: 20px;
    --border-radius-large: 24px;
    
    --animation-speed: 0.4s;
    --animation-curve: cubic-bezier(0.4, 0, 0.2, 1);
}

.job-details-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
}

.job-details-page::before {
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

/* Header Section */
.job-header-section {
    position: relative;
    z-index: 2;
    padding: 2rem 0;
    color: white;
}

.job-header-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
}

.breadcrumb {
    margin-bottom: 2rem;
}

.breadcrumb-link {
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    backdrop-filter: blur(20px);
    transition: all var(--animation-speed) var(--animation-curve);
}

.breadcrumb-link:hover {
    color: white;
    background: rgba(255, 255, 255, 0.2);
}

.job-header-content {
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    backdrop-filter: blur(20px);
    border-radius: var(--border-radius-large);
    padding: 2.5rem;
}

.company-info {
    display: flex;
    align-items: flex-start;
    gap: 2rem;
    margin-bottom: 1.5rem;
}

.company-logo {
    width: 80px;
    height: 80px;
    border-radius: 16px;
    object-fit: cover;
    background: var(--surface-white);
    padding: 0.5rem;
}

.company-logo-placeholder {
    width: 80px;
    height: 80px;
    border-radius: 16px;
    background: var(--surface-white);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-light);
    font-size: 2rem;
}

.company-details {
    flex: 1;
}

.job-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin: 0 0 1rem 0;
    line-height: 1.2;
}

.company-name {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    opacity: 0.9;
}

.job-meta {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
    opacity: 0.9;
}

.remote-badge {
    background: var(--accent-color);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-left: 0.5rem;
}

.deadline-info {
    background: rgba(245, 158, 11, 0.2);
    border: 1px solid rgba(245, 158, 11, 0.3);
    color: #fbbf24;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 600;
}

/* Content Section */
.job-content-wrapper {
    position: relative;
    z-index: 2;
    background: var(--surface-light);
    border-radius: 40px 40px 0 0;
    margin-top: -1rem;
    padding: 3rem 0 2rem;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
}

.job-content-container {
    max-width: 1200px;
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

.alert-error {
    background: #fef2f2;
    color: #dc2626;
    border: 1px solid #fecaca;
}

/* Main Grid Layout */
.job-details-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 3rem;
}

/* Job Details Main Content */
.job-details-main {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.detail-section {
    background: var(--surface-white);
    border-radius: var(--border-radius);
    padding: 2rem;
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
}

.section-title {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 1.5rem 0;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--surface-light);
}

.section-title i {
    color: var(--primary-color);
    font-size: 1.1rem;
}

.section-content {
    color: var(--text-secondary);
    line-height: 1.7;
}

.section-content p {
    margin: 0;
}

/* Lists Styling */
.responsibilities-list,
.requirements-list,
.benefits-list {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.responsibility-item,
.requirement-item,
.benefit-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 0.5rem 0;
}

.responsibility-item i {
    color: var(--accent-color);
    margin-top: 0.25rem;
    flex-shrink: 0;
}

.requirement-item i {
    color: var(--primary-color);
    margin-top: 0.25rem;
    flex-shrink: 0;
}

.benefit-item i {
    color: var(--accent-color);
    margin-top: 0.25rem;
    flex-shrink: 0;
}

/* Skills Tags */
.skills-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.skill-tag {
    background: var(--primary-gradient);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
    display: inline-block;
}

/* Application Sidebar */
.job-application-sidebar {
    position: sticky;
    top: 2rem;
    height: fit-content;
}

.application-card {
    background: var(--surface-white);
    border-radius: var(--border-radius-large);
    padding: 2.5rem;
    box-shadow: var(--shadow-large);
    border: 1px solid var(--border-light);
}

/* Already Applied Status */
.applied-status {
    text-align: center;
    padding: 1rem 0;
}

.applied-icon {
    width: 64px;
    height: 64px;
    background: var(--accent-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 1.5rem;
}

.applied-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 1rem 0;
}

.applied-text {
    color: var(--text-secondary);
    margin: 0 0 2rem 0;
    line-height: 1.6;
}

/* Application Form */
.application-header {
    text-align: center;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--border-light);
}

.application-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 0.5rem 0;
}

.application-subtitle {
    color: var(--text-secondary);
    margin: 0;
    line-height: 1.5;
}

.application-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.form-label i {
    color: var(--primary-color);
    font-size: 0.9rem;
}

.required {
    color: #dc2626;
}

.form-control {
    padding: 1rem;
    border: 2px solid var(--border-light);
    border-radius: 12px;
    font-size: 1rem;
    transition: all var(--animation-speed) var(--animation-curve);
    background: var(--surface-white);
    color: var(--text-primary);
    font-family: inherit;
    resize: vertical;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    transform: translateY(-1px);
}

/* File Upload Styling */
.file-upload-container {
    position: relative;
}

.file-input {
    position: absolute;
    opacity: 0;
    pointer-events: none;
}

.file-upload-label {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    border: 2px dashed var(--border-light);
    border-radius: 12px;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    background: var(--surface-light);
    text-align: center;
}

.file-upload-label:hover {
    border-color: var(--primary-color);
    background: rgba(37, 99, 235, 0.02);
}

.file-upload-label i {
    font-size: 2rem;
    color: var(--primary-color);
    margin-bottom: 0.75rem;
}

.file-upload-text {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
}

.file-upload-info {
    font-size: 0.875rem;
    color: var(--text-light);
}

.error-text {
    color: #dc2626;
    font-size: 0.875rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.error-text::before {
    content: '⚠';
    font-size: 0.8rem;
}

/* Buttons */
.btn-apply-now {
    background: var(--primary-gradient);
    color: white;
    padding: 1.25rem 2rem;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    margin-top: 1rem;
    position: relative;
    overflow: hidden;
}

.btn-apply-now::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.btn-apply-now:hover::before {
    left: 100%;
}

.btn-apply-now:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-large);
}

.btn-secondary {
    background: var(--surface-white);
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
    padding: 1rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
}

.btn-secondary:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

/* Login Required Section */
.login-required {
    text-align: center;
    padding: 2rem 0;
}

.login-icon {
    width: 64px;
    height: 64px;
    background: var(--text-light);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 1.5rem;
}

.login-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 1rem 0;
}

.login-text {
    color: var(--text-secondary);
    margin: 0 0 2rem 0;
    line-height: 1.6;
}

.login-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-login,
.btn-register {
    padding: 1rem 2rem;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: all var(--animation-speed) var(--animation-curve);
    min-width: 120px;
    justify-content: center;
}

.btn-login {
    background: var(--primary-gradient);
    color: white;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
    color: white;
}

.btn-register {
    background: var(--surface-white);
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
}

.btn-register:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
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

.detail-section {
    animation: fadeInUp 0.6s ease forwards;
}

.detail-section:nth-child(1) { animation-delay: 0.1s; }
.detail-section:nth-child(2) { animation-delay: 0.2s; }
.detail-section:nth-child(3) { animation-delay: 0.3s; }
.detail-section:nth-child(4) { animation-delay: 0.4s; }
.detail-section:nth-child(5) { animation-delay: 0.5s; }

/* Responsive Design */
@media (max-width: 1024px) {
    .job-details-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .job-application-sidebar {
        position: static;
        order: -1;
    }
    
    .company-info {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }
    
    .job-meta {
        grid-template-columns: 1fr;
        gap: 0.75rem;
    }
}

@media (max-width: 768px) {
    .job-content-wrapper {
        border-radius: 20px 20px 0 0;
        padding: 2rem 0 1rem;
    }

    .job-content-container {
        padding: 0 1rem;
    }

    .job-header-container {
        padding: 0 1rem;
    }

    .job-header-content {
        padding: 2rem;
    }

    .job-title {
        font-size: 2rem;
    }

    .detail-section {
        padding: 1.5rem;
    }

    .application-card {
        padding: 2rem;
    }

    .company-logo,
    .company-logo-placeholder {
        width: 60px;
        height: 60px;
    }

    .login-actions {
        flex-direction: column;
        align-items: center;
    }

    .btn-login,
    .btn-register {
        width: 100%;
        max-width: 250px;
    }
}

@media (max-width: 480px) {
    .job-header-section {
        padding: 1rem 0;
    }

    .job-title {
        font-size: 1.75rem;
    }

    .job-header-content {
        padding: 1.5rem;
    }

    .detail-section {
        padding: 1.25rem;
    }

    .application-card {
        padding: 1.5rem;
    }

    .skills-tags {
        gap: 0.5rem;
    }

    .skill-tag {
        font-size: 0.8rem;
        padding: 0.375rem 0.75rem;
    }
}

/* Focus States for Accessibility */
.form-control:focus,
.btn-apply-now:focus,
.btn-secondary:focus,
.btn-login:focus,
.btn-register:focus,
.file-upload-label:focus-within {
    outline: 3px solid rgba(37, 99, 235, 0.5);
    outline-offset: 2px;
}

/* Loading States */
.btn-apply-now.loading {
    pointer-events: none;
    opacity: 0.8;
}

.btn-apply-now.loading i {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Form Enhancement */
.form-control:valid {
    border-color: var(--accent-color);
}

.form-control:invalid:not(:focus):not(:placeholder-shown) {
    border-color: #dc2626;
}

/* File Upload Enhancement */
.file-input:focus + .file-upload-label {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.file-upload-label.file-selected {
    border-color: var(--accent-color);
    background: rgba(16, 185, 129, 0.05);
}

.file-upload-label.file-selected .file-upload-text {
    color: var(--accent-color);
}
</style>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // File Upload Enhancement
    const fileInput = document.getElementById('cv_file');
    const fileLabel = document.querySelector('.file-upload-label');
    const fileText = document.querySelector('.file-upload-text');
    
    if (fileInput && fileLabel) {
        fileInput.addEventListener('change', function() {
            if (this.files.length > 0) {
                const fileName = this.files[0].name;
                fileText.textContent = fileName;
                fileLabel.classList.add('file-selected');
            } else {
                fileText.textContent = 'Choose CV file';
                fileLabel.classList.remove('file-selected');
            }
        });
    }

    // Form Enhancement
    const form = document.querySelector('.application-form');
    const submitBtn = document.querySelector('.btn-apply-now');
    
    if (form && submitBtn) {
        form.addEventListener('submit', function() {
            submitBtn.classList.add('loading');
            submitBtn.innerHTML = '<i class="fas fa-spinner"></i><span>Submitting...</span>';
        });
    }

    // Auto-resize textareas
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
        
        // Initial resize
        textarea.style.height = textarea.scrollHeight + 'px';
    });

    // Enhanced form interactions
    const formControls = document.querySelectorAll('.form-control');
    formControls.forEach(control => {
        control.addEventListener('focus', function() {
            this.closest('.form-group').style.transform = 'translateX(5px)';
        });
        
        control.addEventListener('blur', function() {
            this.closest('.form-group').style.transform = '';
        });
    });

    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Stagger animation for detail sections
    const detailSections = document.querySelectorAll('.detail-section');
    detailSections.forEach((section, index) => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(30px)';
        section.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        
        setTimeout(() => {
            section.style.opacity = '1';
            section.style.transform = 'translateY(0)';
        }, index * 150);
    });

    // Phone number formatting
    const phoneInput = document.getElementById('phone');
    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            if (value.length >= 6) {
                value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
            } else if (value.length >= 3) {
                value = value.replace(/(\d{3})(\d{3})/, '($1) $2');
            }
            this.value = value;
        });
    }

    // Form validation enhancement
    const requiredFields = document.querySelectorAll('[required]');
    requiredFields.forEach(field => {
        field.addEventListener('blur', function() {
            if (!this.value.trim()) {
                this.style.borderColor = '#dc2626';
            } else {
                this.style.borderColor = '#10b981';
            }
        });
        
        field.addEventListener('input', function() {
            if (this.value.trim()) {
                this.style.borderColor = '#10b981';
            }
        });
    });

    console.log('🚀 Professional Job Details Page loaded successfully!');
});
</script>
@endsection