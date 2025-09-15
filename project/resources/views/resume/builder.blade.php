@extends('layouts.app')

@section('content')
<!-- Pass user data to JavaScript -->
@auth
<script>
    window.LaravelUser = {
        id: {{ auth()->user()->id }},
        name: "{{ auth()->user()->name }}",
        email: "{{ auth()->user()->email }}"
    };
</script>
@else
<script>
    window.LaravelUser = null;
</script>
@endauth

<div class="resume-builder-page">
    <!-- Professional Header Section -->
    <section class="builder-header-section">
        <div class="builder-header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-file-alt"></i>
                    <span>Resume Builder</span>
                </div>
                <h1 class="header-title">Professional Resume Builder</h1>
                <p class="header-description">
                    Create a professional, ATS-friendly resume with our interactive builder. Edit directly on the preview and download instantly.
                </p>
                <div class="header-actions">
                    <a href="{{ route('careerservices') }}" class="btn-back">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Career Services</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Wrapper -->
    <div class="builder-content-wrapper no-print">
        <div class="builder-content-container">
            
            <!-- Control Panel -->
            <div class="control-panel no-print">
                <div class="panel-header">
                    <h3>
                        <i class="fas fa-tools"></i>
                        Resume Controls
                    </h3>
                </div>
                <div class="panel-content">
                    <div class="control-group">
                        <button class="control-btn btn-save" onclick="saveResume()">
                            <i class="fas fa-save"></i>
                            <span>Save Resume</span>
                        </button>
                        <button class="control-btn btn-download" onclick="downloadPDF()">
                            <i class="fas fa-download"></i>
                            <span>Download PDF</span>
                        </button>
                        <button class="control-btn btn-reset" onclick="resetResume()">
                            <i class="fas fa-refresh"></i>
                            <span>Reset All</span>
                        </button>
                    </div>
                    <div class="edit-indicator">
                        <i class="fas fa-edit"></i>
                        <span>Click anywhere on the resume to edit</span>
                    </div>
                </div>
            </div>

            <!-- Resume Preview Container -->
            <div class="resume-preview-container">
                <div class="resume-preview" id="resumePreview">
                    <!-- Sidebar -->
                    <div class="sidebar">
                        <!-- Profile Section -->
                        <div class="profile-section">
                            <div class="profile-image-container">
                                <div class="profile-image" id="profileInitials">
                                    <span class="initials-text">YN</span>
                                </div>
                                <input type="file" id="profileImageInput" accept="image/*" style="display: none;" onchange="handleImageUpload(event)">
                                <div class="photo-buttons">
                                    <button class="upload-photo-btn no-print" onclick="document.getElementById('profileImageInput').click()">
                                        <i class="fas fa-camera"></i>
                                    </button>
                                    <button class="remove-photo-btn no-print" onclick="removePhoto()" style="display: none;">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <input type="text" class="editable name" value="" placeholder="Your Full Name">
                            <input type="text" class="editable job-title" value="" placeholder="Job Title">
                        </div>

                        <!-- Contact Information -->
                        <div class="contact-info">
                            <div class="contact-item">
                                <div class="contact-icon">📧</div>
                                <input type="email" class="editable contact-text" value="" placeholder="your.email@example.com">
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">📱</div>
                                <input type="tel" class="editable contact-text" value="" placeholder="+1 (555) 123-4567">
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">📍</div>
                                <input type="text" class="editable contact-text" value="" placeholder="City, State, Country">
                            </div>
                            <div class="contact-item">
                                <div class="contact-icon">💼</div>
                                <input type="text" class="editable contact-text" value="" placeholder="linkedin.com/in/yourprofile">
                            </div>
                        </div>

                        <!-- Skills Section -->
                        <div class="sidebar-section">
                            <h3>SKILLS</h3>
                            <div id="skillsList">
                                <!-- Skills will be added dynamically -->
                            </div>
                            <button class="add-item-btn no-print" onclick="addSkill()">
                                <i class="fas fa-plus"></i>
                                Add Skill
                            </button>
                        </div>

                        <!-- Languages Section -->
                        <div class="sidebar-section">
                            <h3>LANGUAGES</h3>
                            <div id="languagesList">
                                <!-- Languages will be added dynamically -->
                            </div>
                            <button class="add-item-btn no-print" onclick="addLanguage()">
                                <i class="fas fa-plus"></i>
                                Add Language
                            </button>
                        </div>

                        <!-- Interests Section -->
                        <div class="sidebar-section">
                            <h3>INTERESTS</h3>
                            <div id="interestsList">
                                <!-- Interests will be added dynamically -->
                            </div>
                            <button class="add-item-btn no-print" onclick="addInterest()">
                                <i class="fas fa-plus"></i>
                                Add Interest
                            </button>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="main-content">
                        <!-- Professional Summary -->
                        <div class="summary-section">
                            <h2 class="section-title">PROFESSIONAL SUMMARY</h2>
                            <div class="summary-text" contenteditable="true" placeholder="Write a brief professional summary highlighting your key skills, experience, and career objectives. Keep it concise and impactful - 2-3 sentences that showcase what makes you unique as a candidate."></div>
                        </div>

                        <!-- Work Experience -->
                        <div class="main-section">
                            <h2 class="section-title">WORK EXPERIENCE</h2>
                            <div id="experienceList">
                                <!-- Experience items will be added dynamically -->
                            </div>
                            <button class="add-section-btn no-print" onclick="addExperience()">
                                <i class="fas fa-plus"></i>
                                Add Experience
                            </button>
                        </div>

                        <!-- Education -->
                        <div class="main-section">
                            <h2 class="section-title">EDUCATION</h2>
                            <div id="educationList">
                                <!-- Education items will be added dynamically -->
                            </div>
                            <button class="add-section-btn no-print" onclick="addEducation()">
                                <i class="fas fa-plus"></i>
                                Add Education
                            </button>
                        </div>

                        <!-- Projects -->
                        <div class="main-section">
                            <h2 class="section-title">PERSONAL PROJECTS</h2>
                            <div id="projectsList">
                                <!-- Project items will be added dynamically -->
                            </div>
                            <button class="add-section-btn no-print" onclick="addProject()">
                                <i class="fas fa-plus"></i>
                                Add Project
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Professional Resume Builder Styles */
:root {
    /* Primary Color Scheme */
    --primary-gradient: linear-gradient(135deg, #2563eb, #10b981);
    --primary-color: #2563eb;
    --primary-dark: #1d4ed8;
    --accent-color: #10b981;
    --accent-dark: #059669;
    
    /* Resume specific colors */
    --sidebar-bg: #2c3e50;
    --sidebar-accent: #3498db;
    --sidebar-accent-alt: #2980b9;
    
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
.resume-builder-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
    overflow-x: hidden;
}

.resume-builder-page::before {
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
.builder-header-section {
    position: relative;
    z-index: 2;
    padding: 4rem 0 2rem;
    color: white;
    text-align: center;
}

.builder-header-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
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
    max-width: 700px;
    margin: 0 auto 2rem;
    line-height: 1.6;
}

.header-actions {
    margin-top: 2rem;
}

.btn-back {
    background: var(--glass-bg);
    border: 2px solid var(--glass-border);
    backdrop-filter: blur(20px);
    color: white;
    padding: 1rem 2rem;
    border-radius: 16px;
    text-decoration: none;
    font-weight: 700;
    font-size: 1rem;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
}

.btn-back:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: white;
    transform: translateY(-2px);
    color: white;
}

/* Content Wrapper */
.builder-content-wrapper {
    position: relative;
    z-index: 2;
    background: var(--surface-light);
    border-radius: 40px 40px 0 0;
    margin-top: -1rem;
    padding: 3rem 0 2rem;
    box-shadow: 0 -10px 40px rgba(0, 0, 0, 0.1);
}

.builder-content-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 2rem;
    display: flex;
    gap: 2rem;
    align-items: flex-start;
}

/* Control Panel */
.control-panel {
    background: var(--surface-white);
    border-radius: var(--border-radius-large);
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    overflow: hidden;
    width: 350px;
    flex-shrink: 0;
    position: sticky;
    top: 2rem;
    height: fit-content;
}

.panel-header {
    background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
    padding: 2rem;
    border-bottom: 1px solid var(--border-light);
}

.panel-header h3 {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.panel-header i {
    color: var(--primary-color);
}

.panel-content {
    padding: 2rem;
}

.control-group {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 2rem;
}

.control-btn {
    background: var(--primary-gradient);
    color: white;
    border: none;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: flex;
    align-items: center;
    gap: 0.75rem;
    justify-content: center;
}

.control-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-large);
}

.btn-save {
    background: linear-gradient(135deg, var(--accent-color), var(--accent-dark));
}

.btn-download {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
}

.btn-reset {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

.edit-indicator {
    background: var(--surface-light);
    padding: 1rem;
    border-radius: 12px;
    border: 2px dashed var(--border-light);
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    color: var(--text-secondary);
    font-size: 0.875rem;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

/* Resume Preview Container */
.resume-preview-container {
    flex: 1;
    display: flex;
    justify-content: center;
    background: var(--surface-white);
    border-radius: var(--border-radius-large);
    padding: 2rem;
    box-shadow: var(--shadow-premium);
    border: 1px solid var(--border-light);
}

/* FIXED RESUME STYLES FOR SINGLE PAGE */
.resume-preview {
    background: white;
    width: 8.5in;
    height: 11in;
    box-shadow: var(--shadow-large);
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    transform: scale(0.75);
    transform-origin: top center;
    font-family: Arial, sans-serif;
    font-size: 11px;
    line-height: 1.3;
}

/* FIXED SIDEBAR - PROPER COLORS AND SIZING */
.sidebar {
    width: 35%;
    background: var(--sidebar-bg);
    color: white;
    padding: 25px 20px;
    position: relative;
    display: flex;
    flex-direction: column;
}

.sidebar::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 15px;
    height: 100%;
    background: var(--sidebar-accent);
}

.profile-section {
    text-align: center;
    margin-bottom: 25px;
}

.profile-image-container {
    position: relative;
    display: inline-block;
}

.profile-image {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: var(--sidebar-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 12px;
    font-size: 28px;
    font-weight: bold;
    color: white;
    border: 3px solid rgba(255, 255, 255, 0.2);
}

/* STYLED PHOTO BUTTONS */
.photo-buttons {
    position: absolute;
    bottom: -5px;
    right: -5px;
    display: flex;
    gap: 4px;
}

.upload-photo-btn, .remove-photo-btn {
    background: linear-gradient(135deg, var(--sidebar-accent), var(--sidebar-accent-alt));
    color: white;
    border: none;
    border-radius: 50%;
    width: 28px;
    height: 28px;
    cursor: pointer;
    font-size: 12px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    border: 2px solid white;
}

.upload-photo-btn:hover, .remove-photo-btn:hover {
    background: linear-gradient(135deg, var(--sidebar-accent-alt), #1f5f99);
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.remove-photo-btn {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

.remove-photo-btn:hover {
    background: linear-gradient(135deg, #dc2626, #b91c1c);
}

.editable {
    border: none;
    background: transparent;
    color: inherit;
    font-family: inherit;
    font-size: inherit;
    font-weight: inherit;
    text-align: inherit;
    width: 100%;
    outline: none;
    border-radius: 4px;
    padding: 2px 4px;
    cursor: text;
    transition: all 0.3s ease;
}

.editable:hover {
    background: rgba(255, 255, 255, 0.1);
}

.editable:focus {
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.5);
}

.name {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 3px;
    margin-top: 10px;
    color: white;
}

.job-title {
    font-size: 11px;
    color: #bdc3c7;
    margin-bottom: 15px;
}

.contact-info {
    margin-bottom: 20px;
}

.contact-item {
    display: flex;
    align-items: center;
    margin-bottom: 8px;
    font-size: 9px;
}

.contact-icon {
    width: 14px;
    margin-right: 8px;
    text-align: center;
    color: var(--sidebar-accent);
}

.contact-text {
    font-size: 9px !important;
    word-break: break-all;
}

.sidebar-section {
    margin-bottom: 20px;
}

.sidebar-section h3 {
    font-size: 12px;
    font-weight: bold;
    margin-bottom: 10px;
    color: var(--sidebar-accent);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1px solid var(--sidebar-accent);
    padding-bottom: 3px;
}

.skill-item, .language-item, .interest-item {
    margin-bottom: 5px;
    font-size: 9px;
    color: #bdc3c7;
    line-height: 1.2;
    position: relative;
    cursor: pointer;
    transition: all 0.3s ease;
}

.skill-item:hover, .language-item:hover, .interest-item:hover {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 4px;
    padding: 2px 4px;
}

.language-item {
    margin-bottom: 8px;
}

.language-item strong {
    color: white;
    font-size: 9px;
}

.proficiency {
    font-size: 8px;
    color: #95a5a6;
    font-style: italic;
}

/* FIXED MAIN CONTENT - PROPER SIZING */
.main-content {
    width: 65%;
    padding: 25px 20px;
    background: white;
    display: flex;
    flex-direction: column;
}

.summary-section {
    margin-bottom: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-left: 3px solid var(--sidebar-accent);
    border-radius: 0 6px 6px 0;
}

.summary-text {
    font-size: 10px;
    line-height: 1.4;
    color: var(--text-primary);
    text-align: justify;
    min-height: 40px;
    cursor: text;
}

.summary-text:empty:before {
    content: attr(placeholder);
    color: #999;
    font-style: italic;
}

.main-section {
    margin-bottom: 18px;
}

.section-title {
    font-size: 13px;
    font-weight: bold;
    color: var(--text-primary);
    margin-bottom: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border-bottom: 1px solid var(--sidebar-accent);
    padding-bottom: 4px;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    width: 30px;
    height: 1px;
    background: #e74c3c;
}

.experience-item,
.education-item {
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid #ecf0f1;
    position: relative;
}

.experience-item:last-child,
.education-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.item-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 5px;
    position: relative;
}

.job-info {
    flex: 1;
}

.job-title {
    font-size: 11px;
    font-weight: bold;
    color: var(--text-primary);
    margin-bottom: 2px;
}

.company-name {
    font-size: 10px;
    color: #7f8c8d;
    font-style: italic;
}

/* DATE CONTAINER WITH DELETE BUTTON */
.date-container {
    display: flex;
    align-items: center;
    gap: 4px;
    min-width: 100px;
}

.job-date {
    font-size: 9px;
    color: #95a5a6;
    font-weight: bold;
    text-align: right;
    min-width: 80px;
    background: #f8f9fa;
    padding: 2px 6px;
    border-radius: 3px;
    flex: 1;
}

/* DELETE BUTTON BESIDE DATE (RIGHT SIDE) */
.date-delete-btn {
    position: static;
    width: 14px;
    height: 14px;
    font-size: 8px;
    border-radius: 4px;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    border: none;
    cursor: pointer;
    opacity: 0;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    line-height: 1;
    box-shadow: 0 1px 4px rgba(239, 68, 68, 0.3);
}

.job-description {
    font-size: 9px;
    line-height: 1.3;
    color: #555;
    text-align: justify;
    min-height: 20px;
    cursor: text;
}

.project-item {
    margin-bottom: 12px;
    padding-bottom: 8px;
    border-bottom: 1px solid #ecf0f1;
    position: relative;
}

.project-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.project-title {
    font-size: 11px;
    font-weight: bold;
    color: var(--text-primary);
    margin-bottom: 2px;
}

.project-tech {
    font-size: 9px;
    color: var(--sidebar-accent);
    font-weight: bold;
    margin-bottom: 3px;
}

.project-description {
    font-size: 9px;
    line-height: 1.3;
    color: #555;
    text-align: justify;
    min-height: 20px;
    cursor: text;
}

/* Add/Delete Buttons */
.add-section-btn, .add-item-btn {
    background: var(--accent-color);
    color: white;
    border: none;
    padding: 0.5rem 0.75rem;
    border-radius: 6px;
    cursor: pointer;
    font-size: 8px;
    margin-top: 8px;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
}

.add-section-btn:hover, .add-item-btn:hover {
    background: var(--accent-dark);
    transform: translateY(-1px);
}

/* PROFESSIONAL DELETE BUTTONS - RESPONSIVE SIZING */
.delete-btn {
    position: absolute;
    top: 1px;
    right: 1px;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    border: none;
    border-radius: 4px;
    width: 14px;
    height: 14px;
    cursor: pointer;
    font-size: 8px;
    opacity: 0;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    font-weight: 600;
    line-height: 1;
    box-shadow: 0 1px 4px rgba(239, 68, 68, 0.3);
}

/* LARGER DELETE BUTTONS FOR MAIN CONTENT */
.experience-item .delete-btn,
.education-item .delete-btn,
.project-item .delete-btn {
    width: 18px;
    height: 18px;
    top: 2px;
    right: 2px;
    font-size: 10px;
    border-radius: 6px;
}

.delete-btn:hover {
    background: linear-gradient(135deg, #dc2626, #b91c1c);
    transform: scale(1.1);
    box-shadow: 0 2px 8px rgba(239, 68, 68, 0.4);
}

.delete-btn:active {
    transform: scale(0.9);
}

.experience-item:hover .delete-btn,
.education-item:hover .delete-btn,
.project-item:hover .delete-btn,
.skill-item:hover .delete-btn,
.language-item:hover .delete-btn,
.interest-item:hover .delete-btn {
    opacity: 1;
}

/* SHOW DATE DELETE BUTTONS ON HOVER */
.experience-item:hover .date-delete-btn,
.education-item:hover .date-delete-btn {
    opacity: 1;
}

/* CRITICAL PRINT STYLES - FIXES THE BROKEN PDF */
@media print {
    * {
        -webkit-print-color-adjust: exact !important;
        color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
    
    body {
        margin: 0 !important;
        padding: 0 !important;
        background: white !important;
    }
    
    .no-print, .delete-btn, .upload-photo-btn, .remove-photo-btn, .add-item-btn, .add-section-btn {
        display: none !important;
        visibility: hidden !important;
    }
    
    .resume-preview {
        transform: scale(1) !important;
        width: 100% !important;
        height: 100vh !important;
        max-width: 100% !important;
        box-shadow: none !important;
        border-radius: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
        page-break-after: avoid !important;
        page-break-inside: avoid !important;
    }
    
    .sidebar {
        background: #2c3e50 !important;
        color: white !important;
    }
    
    .sidebar::before {
        background: #3498db !important;
    }
    
    .profile-image {
        background: #3498db !important;
        color: white !important;
    }
    
    .sidebar-section h3 {
        color: #3498db !important;
        border-bottom-color: #3498db !important;
    }
    
    .contact-icon {
        color: #3498db !important;
    }
    
    /* REMOVE WHITE BACKGROUNDS FROM ALL EDITABLE FIELDS */
    .editable {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
    }
    
    .sidebar .editable {
        background: transparent !important;
        color: inherit !important;
        border: none !important;
        box-shadow: none !important;
    }
    
    .sidebar .name {
        background: transparent !important;
        color: white !important;
    }
    
    .sidebar .job-title {
        background: transparent !important;
        color: #bdc3c7 !important;
    }
    
    .sidebar .contact-text {
        background: transparent !important;
        color: white !important;
    }
    
    .summary-section {
        background: #f8f9fa !important;
        border-left-color: #3498db !important;
    }
    
    .section-title {
        border-bottom-color: #3498db !important;
    }
    
    .section-title::after {
        background: #e74c3c !important;
    }
    
    .job-date {
        background: #f8f9fa !important;
    }
    
    .project-tech {
        color: #3498db !important;
    }
    
    @page {
        size: A4;
        margin: 0.5in;
    }
}

/* Responsive Design */
@media (max-width: 1400px) {
    .builder-content-container {
        flex-direction: column;
        align-items: center;
    }
    
    .control-panel {
        width: 100%;
        max-width: 500px;
        position: static;
        margin-bottom: 2rem;
    }
    
    .control-group {
        flex-direction: row;
        flex-wrap: wrap;
    }
    
    .resume-preview {
        transform: scale(0.6);
    }
}

@media (max-width: 1000px) {
    .resume-preview {
        transform: scale(0.5);
    }
    
    .builder-content-container {
        padding: 0 1rem;
    }
}

@media (max-width: 768px) {
    .resume-preview {
        transform: scale(0.4);
        margin: -50px 0;
    }
    
    .builder-header-section {
        padding: 3rem 0 2rem;
    }
    
    .builder-header-container {
        padding: 0 1rem;
    }
    
    .control-group {
        flex-direction: column;
    }
}

@media (max-width: 600px) {
    .resume-preview {
        transform: scale(0.35);
        margin: -80px 0;
    }
    
    .header-title {
        font-size: 2rem;
    }
}

/* Success States */
.success-state {
    background: var(--accent-color);
    color: white;
    animation: successPulse 0.6s ease;
}

@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
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

/* Placeholder styles for contenteditable */
[contenteditable]:empty:before {
    content: attr(data-placeholder);
    color: #999;
    font-style: italic;
    opacity: 0.7;
}

[contenteditable]:focus:before {
    content: '';
}

input:placeholder-shown {
    color: #999;
    font-style: italic;
}

.summary-text:empty:before {
    content: 'Write a brief professional summary highlighting your key skills, experience, and career objectives. Keep it concise and impactful - 2-3 sentences that showcase what makes you unique as a candidate.';
    color: #999;
    font-style: italic;
    opacity: 0.7;
}
</style>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle image upload
    function handleImageUpload(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const profileImage = document.getElementById('profileInitials');
                profileImage.innerHTML = `<img src="${e.target.result}" alt="Profile Photo" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`;
                
                // Show remove button, hide upload button
                document.querySelector('.upload-photo-btn').style.display = 'none';
                document.querySelector('.remove-photo-btn').style.display = 'inline-flex';
                
                // Save image to user-specific localStorage
                localStorage.setItem(getUserImageKey(), e.target.result);
            };
            reader.readAsDataURL(file);
        }
    }

    // Remove photo function
    function removePhoto() {
        const profileImage = document.getElementById('profileInitials');
        const img = profileImage.querySelector('img');
        if (img) {
            img.remove();
        }
        
        // Restore initials
        if (!profileImage.querySelector('.initials-text')) {
            profileImage.innerHTML = '<span class="initials-text">YN</span>';
        }
        updateInitials();
        
        // Show upload button, hide remove button
        document.querySelector('.upload-photo-btn').style.display = 'inline-flex';
        document.querySelector('.remove-photo-btn').style.display = 'none';
        
        // Remove from user-specific localStorage
        localStorage.removeItem(getUserImageKey());
    }
    // Get user-specific storage key
    function getUserStorageKey() {
        // Try to get user ID from various sources
        const userId = getUserId();
        return userId ? `resumeData_${userId}` : 'resumeData_guest';
    }

    function getUserImageKey() {
        const userId = getUserId();
        return userId ? `profileImage_${userId}` : 'profileImage_guest';
    }

    function getUserId() {
        // Method 1: Check if Laravel user is available from the script we injected
        if (window.LaravelUser && window.LaravelUser.id) {
            return window.LaravelUser.id;
        }
        
        // Method 2: Check for meta tag with user ID (fallback)
        const userMeta = document.querySelector('meta[name="user-id"]');
        if (userMeta && userMeta.getAttribute('content')) {
            return userMeta.getAttribute('content');
        }
        
        // Method 3: Check for other global user variables (fallback)
        if (window.user && window.user.id) {
            return window.user.id;
        }
        
        // Method 4: For guest users - create a browser-specific unique ID
        let guestId = localStorage.getItem('guest_user_id');
        if (!guestId) {
            guestId = 'guest_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
            localStorage.setItem('guest_user_id', guestId);
        }
        return guestId;
    }

    function updateInitials() {
        const nameInput = document.querySelector('.name');
        const name = nameInput.value || 'YN';
        const initials = name.split(' ').map(word => word.charAt(0)).join('').toUpperCase().substring(0, 2) || 'YN';
        
        // Only update if there's no image
        const profileImage = document.getElementById('profileInitials');
        if (!profileImage.querySelector('img')) {
            const initialsSpan = profileImage.querySelector('.initials-text');
            if (initialsSpan) {
                initialsSpan.textContent = initials;
            } else {
                profileImage.innerHTML = `<span class="initials-text">${initials}</span>`;
            }
        }
    }

    // Add skill function
    function addSkill() {
        const skillsList = document.getElementById('skillsList');
        const newSkill = document.createElement('div');
        newSkill.className = 'skill-item';
        newSkill.innerHTML = `
            <span contenteditable="true" onclick="this.focus()" placeholder="e.g., JavaScript, Project Management, Adobe Photoshop">• Click to add skill</span>
            <button class="delete-btn no-print" onclick="deleteItem(this)">×</button>
        `;
        skillsList.appendChild(newSkill);
    }

    // Add language function
    function addLanguage() {
        const languagesList = document.getElementById('languagesList');
        const newLanguage = document.createElement('div');
        newLanguage.className = 'language-item';
        newLanguage.innerHTML = `
            <div>
                <strong contenteditable="true" onclick="this.focus()" placeholder="e.g., English, Spanish">Language Name</strong><br>
                <span class="proficiency" contenteditable="true" onclick="this.focus()" placeholder="e.g., Native, Fluent, Intermediate">Proficiency Level</span>
            </div>
            <button class="delete-btn no-print" onclick="deleteItem(this)">×</button>
        `;
        languagesList.appendChild(newLanguage);
    }

    // Add interest function
    function addInterest() {
        const interestsList = document.getElementById('interestsList');
        const newInterest = document.createElement('div');
        newInterest.className = 'interest-item';
        newInterest.innerHTML = `
            <span contenteditable="true" onclick="this.focus()" placeholder="e.g., Photography, Travel, Coding">• Click to add interest</span>
            <button class="delete-btn no-print" onclick="deleteItem(this)">×</button>
        `;
        interestsList.appendChild(newInterest);
    }

    // Add experience function
    function addExperience() {
        const experienceList = document.getElementById('experienceList');
        const newExperience = document.createElement('div');
        newExperience.className = 'experience-item';
        newExperience.innerHTML = `
            <div class="item-header">
                <div class="job-info">
                    <h3 class="job-title" contenteditable="true" onclick="this.focus()" placeholder="e.g., Software Engineer, Marketing Manager">Job Title</h3>
                    <div class="company-name" contenteditable="true" onclick="this.focus()" placeholder="e.g., Google, Microsoft, ABC Corporation">Company Name</div>
                </div>
                <div class="date-container">
                    <div class="job-date" contenteditable="true" onclick="this.focus()" placeholder="e.g., Jan 2020 - Present">MM/YYYY - MM/YYYY</div>
                    <button class="date-delete-btn no-print" onclick="deleteItem(this)">×</button>
                </div>
            </div>
            <div class="job-description" contenteditable="true" onclick="this.focus()" placeholder="Describe your key responsibilities, achievements, and impact in this role. Use bullet points for better readability. Quantify results when possible (e.g., increased sales by 25%, managed team of 10 people).">
                Click to describe your responsibilities and achievements...
            </div>
        `;
        experienceList.appendChild(newExperience);
    }

    // Add education function
    function addEducation() {
        const educationList = document.getElementById('educationList');
        const newEducation = document.createElement('div');
        newEducation.className = 'education-item';
        newEducation.innerHTML = `
            <div class="item-header">
                <div class="job-info">
                    <h3 class="job-title" contenteditable="true" onclick="this.focus()" placeholder="e.g., Bachelor of Computer Science, MBA">Degree/Certificate</h3>
                    <div class="company-name" contenteditable="true" onclick="this.focus()" placeholder="e.g., Harvard University, ABC College">Institution Name</div>
                </div>
                <div class="date-container">
                    <div class="job-date" contenteditable="true" onclick="this.focus()" placeholder="e.g., 2018 - 2022">YYYY - YYYY</div>
                    <button class="date-delete-btn no-print" onclick="deleteItem(this)">×</button>
                </div>
            </div>
            <div class="job-description" contenteditable="true" onclick="this.focus()" placeholder="Include relevant coursework, academic achievements, GPA (if impressive), honors, or notable projects.">
                Click to add relevant coursework, achievements, GPA...
            </div>
        `;
        educationList.appendChild(newEducation);
    }

    // Add project function
    function addProject() {
        const projectsList = document.getElementById('projectsList');
        const newProject = document.createElement('div');
        newProject.className = 'project-item';
        newProject.innerHTML = `
            <button class="delete-btn no-print" onclick="deleteItem(this)">×</button>
            <h3 class="project-title" contenteditable="true" onclick="this.focus()" placeholder="e.g., E-commerce Website, Mobile App">Project Name</h3>
            <div class="project-tech" contenteditable="true" onclick="this.focus()" placeholder="e.g., React, Node.js, MongoDB">Technologies: List technologies used</div>
            <div class="project-description" contenteditable="true" onclick="this.focus()" placeholder="Describe the project scope, your role, key features implemented, and impact/results achieved.">
                Click to describe the project and your role...
            </div>
        `;
        projectsList.appendChild(newProject);
    }

    // Delete item function
    function deleteItem(button) {
        if (confirm('Are you sure you want to delete this item?')) {
            button.parentElement.remove();
        }
    }

    // Save resume function
    function saveResume() {
        const resumeData = {
            name: document.querySelector('.name').value,
            jobTitle: document.querySelector('.job-title').value,
            email: document.querySelector('input[type="email"]').value,
            phone: document.querySelector('input[type="tel"]').value,
            location: document.querySelectorAll('.contact-text')[2].value,
            linkedin: document.querySelectorAll('.contact-text')[3].value,
            summary: document.querySelector('.summary-text').textContent,
            skills: Array.from(document.querySelectorAll('#skillsList .skill-item span[contenteditable]')).map(el => el.textContent),
            languages: Array.from(document.querySelectorAll('#languagesList .language-item')).map(item => ({
                name: item.querySelector('strong').textContent,
                level: item.querySelector('.proficiency').textContent
            })),
            interests: Array.from(document.querySelectorAll('#interestsList .interest-item span[contenteditable]')).map(el => el.textContent),
            experience: Array.from(document.querySelectorAll('#experienceList .experience-item')).map(item => ({
                title: item.querySelector('.job-title').textContent,
                company: item.querySelector('.company-name').textContent,
                date: item.querySelector('.job-date').textContent,
                description: item.querySelector('.job-description').textContent
            })),
            education: Array.from(document.querySelectorAll('#educationList .education-item')).map(item => ({
                title: item.querySelector('.job-title').textContent,
                institution: item.querySelector('.company-name').textContent,
                date: item.querySelector('.job-date').textContent,
                description: item.querySelector('.job-description').textContent
            })),
            projects: Array.from(document.querySelectorAll('#projectsList .project-item')).map(item => ({
                title: item.querySelector('.project-title').textContent,
                tech: item.querySelector('.project-tech').textContent,
                description: item.querySelector('.project-description').textContent
            }))
        };
        
        localStorage.setItem(getUserStorageKey(), JSON.stringify(resumeData));
        
        // Show success message
        const saveBtn = document.querySelector('.btn-save');
        const originalContent = saveBtn.innerHTML;
        saveBtn.innerHTML = '<i class="fas fa-check"></i> Saved!';
        saveBtn.classList.add('success-state');
        
        setTimeout(() => {
            saveBtn.innerHTML = originalContent;
            saveBtn.classList.remove('success-state');
        }, 2000);
    }

    // Download PDF function - FIXED FOR COLORS
    function downloadPDF() {
        // Create a new window for printing
        const printWindow = window.open('', '_blank');
        
        // Get the resume content
        const resumeContent = document.querySelector('.resume-preview').outerHTML;
        
        // Create the print document with proper styles
        const printDocument = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Professional Resume</title>
            <style>
                * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box;
                    -webkit-print-color-adjust: exact !important;
                    color-adjust: exact !important;
                    print-color-adjust: exact !important;
                }
                
                body {
                    font-family: Arial, sans-serif;
                    background: white;
                    margin: 0;
                    padding: 0;
                }
                
                .resume-preview {
                    width: 100%;
                    height: 100vh;
                    display: flex;
                    font-size: 11px;
                    line-height: 1.3;
                    background: white;
                }
                
                .sidebar {
                    width: 35%;
                    background: #2c3e50 !important;
                    color: white !important;
                    padding: 25px 20px;
                    position: relative;
                }
                
                .sidebar::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    right: 0;
                    width: 15px;
                    height: 100%;
                    background: #3498db !important;
                }
                
                .profile-image {
                    width: 100px;
                    height: 100px;
                    border-radius: 50%;
                    background: #3498db !important;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    margin: 0 auto 12px;
                    font-size: 28px;
                    font-weight: bold;
                    color: white !important;
                    border: 3px solid rgba(255, 255, 255, 0.2);
                }
                
                .name {
                    font-size: 16px;
                    font-weight: bold;
                    margin-bottom: 3px;
                    color: white !important;
                    text-align: center;
                    background: transparent !important;
                    border: none !important;
                }
                
                .job-title {
                    font-size: 11px;
                    color: #bdc3c7 !important;
                    margin-bottom: 15px;
                    text-align: center;
                    background: transparent !important;
                    border: none !important;
                }
                
                .contact-item {
                    display: flex;
                    align-items: center;
                    margin-bottom: 8px;
                    font-size: 9px;
                }
                
                .contact-icon {
                    width: 14px;
                    margin-right: 8px;
                    text-align: center;
                    color: #3498db !important;
                }
                
                .contact-text {
                    font-size: 9px !important;
                    word-break: break-all;
                    color: white !important;
                    background: transparent !important;
                    border: none !important;
                }
                
                .sidebar-section h3 {
                    font-size: 12px;
                    font-weight: bold;
                    margin-bottom: 10px;
                    color: #3498db !important;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    border-bottom: 1px solid #3498db !important;
                    padding-bottom: 3px;
                }
                
                .skill-item, .language-item, .interest-item {
                    margin-bottom: 5px;
                    font-size: 9px;
                    color: #bdc3c7 !important;
                    line-height: 1.2;
                }
                
                .language-item strong {
                    color: white !important;
                    font-size: 9px;
                    background: transparent !important;
                }
                
                .proficiency {
                    font-size: 8px;
                    color: #95a5a6 !important;
                    font-style: italic;
                    background: transparent !important;
                }
                
                .main-content {
                    width: 65%;
                    padding: 25px 20px;
                    background: white;
                }
                
                .summary-section {
                    margin-bottom: 20px;
                    padding: 15px;
                    background: #f8f9fa !important;
                    border-left: 3px solid #3498db !important;
                    border-radius: 0 6px 6px 0;
                }
                
                .summary-text {
                    font-size: 10px;
                    line-height: 1.4;
                    color: #1a202c !important;
                    text-align: justify;
                    background: transparent !important;
                }
                
                .section-title {
                    font-size: 13px;
                    font-weight: bold;
                    color: #1a202c !important;
                    margin-bottom: 12px;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    border-bottom: 1px solid #3498db !important;
                    padding-bottom: 4px;
                    position: relative;
                }
                
                .section-title::after {
                    content: '';
                    position: absolute;
                    bottom: -1px;
                    left: 0;
                    width: 30px;
                    height: 1px;
                    background: #e74c3c !important;
                }
                
                .experience-item, .education-item {
                    margin-bottom: 15px;
                    padding-bottom: 10px;
                    border-bottom: 1px solid #ecf0f1;
                }
                
                .item-header {
                    display: flex;
                    justify-content: space-between;
                    align-items: flex-start;
                    margin-bottom: 5px;
                }
                
                .job-info .job-title {
                    font-size: 11px;
                    font-weight: bold;
                    color: #1a202c !important;
                    margin-bottom: 2px;
                    text-align: left;
                    background: transparent !important;
                }
                
                .company-name {
                    font-size: 10px;
                    color: #7f8c8d !important;
                    font-style: italic;
                    background: transparent !important;
                }
                
                .job-date {
                    font-size: 9px;
                    color: #95a5a6 !important;
                    font-weight: bold;
                    text-align: right;
                    min-width: 80px;
                    background: #f8f9fa !important;
                    padding: 2px 6px;
                    border-radius: 3px;
                }
                
                .job-description {
                    font-size: 9px;
                    line-height: 1.3;
                    color: #555 !important;
                    text-align: justify;
                    background: transparent !important;
                }
                
                .project-item {
                    margin-bottom: 12px;
                    padding-bottom: 8px;
                    border-bottom: 1px solid #ecf0f1;
                }
                
                .project-title {
                    font-size: 11px;
                    font-weight: bold;
                    color: #1a202c !important;
                    margin-bottom: 2px;
                    background: transparent !important;
                }
                
                .project-tech {
                    font-size: 9px;
                    color: #3498db !important;
                    font-weight: bold;
                    margin-bottom: 3px;
                    background: transparent !important;
                }
                
                .project-description {
                    font-size: 9px;
                    line-height: 1.3;
                    color: #555 !important;
                    text-align: justify;
                    background: transparent !important;
                }
                
                .no-print, .delete-btn, .upload-photo-btn, .remove-photo-btn, .add-item-btn, .add-section-btn {
                    display: none !important;
                }
                
                /* ALL EDITABLE FIELDS TRANSPARENT */
                .editable {
                    background: transparent !important;
                    border: none !important;
                    box-shadow: none !important;
                }
                
                @page {
                    size: A4;
                    margin: 0.5in;
                }
            </style>
        </head>
        <body>
            ${resumeContent}
        </body>
        </html>
        `;
        
        printWindow.document.write(printDocument);
        printWindow.document.close();
        
        // Wait for content to load then print
        printWindow.onload = function() {
            printWindow.print();
            printWindow.close();
        };
    }

    // Reset resume function
    function resetResume() {
        if (confirm('Are you sure you want to reset all data? This action cannot be undone.')) {
            localStorage.removeItem(getUserStorageKey());
            localStorage.removeItem(getUserImageKey());
            // Clear all fields
            document.querySelector('.name').value = '';
            document.querySelector('.job-title').value = '';
            document.querySelector('input[type="email"]').value = '';
            document.querySelector('input[type="tel"]').value = '';
            document.querySelectorAll('.contact-text')[2].value = '';
            document.querySelectorAll('.contact-text')[3].value = '';
            document.querySelector('.summary-text').textContent = '';
            
            // Clear dynamic sections
            document.getElementById('skillsList').innerHTML = '';
            document.getElementById('languagesList').innerHTML = '';
            document.getElementById('interestsList').innerHTML = '';
            document.getElementById('experienceList').innerHTML = '';
            document.getElementById('educationList').innerHTML = '';
            document.getElementById('projectsList').innerHTML = '';
            
            updateInitials();
        }
    }

    // Make functions globally available
    window.addSkill = addSkill;
    window.addLanguage = addLanguage;
    window.addInterest = addInterest;
    window.addExperience = addExperience;
    window.addEducation = addEducation;
    window.addProject = addProject;
    window.deleteItem = deleteItem;
    window.saveResume = saveResume;
    window.downloadPDF = downloadPDF;
    window.resetResume = resetResume;
    window.handleImageUpload = handleImageUpload;
    window.removePhoto = removePhoto;

    // Add event listener to name field
    document.querySelector('.name').addEventListener('input', updateInitials);

    // Auto-select text on click for editable fields
    document.querySelectorAll('.editable').forEach(input => {
        input.addEventListener('click', function() {
            this.select();
        });
        
        input.addEventListener('input', function() {
            if (this.classList.contains('name')) {
                updateInitials();
            }
        });
    });

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl+S to save
        if (e.ctrlKey && e.key === 's') {
            e.preventDefault();
            saveResume();
        }
        
        // Ctrl+P to print
        if (e.ctrlKey && e.key === 'p') {
            e.preventDefault();
            downloadPDF();
        }
    });

    // Auto-save every 30 seconds
    setInterval(saveResume, 30000);

    // Load saved data on page load
    window.addEventListener('load', function() {
        const savedData = localStorage.getItem(getUserStorageKey());
        const savedImage = localStorage.getItem(getUserImageKey());
        
        if (savedImage) {
            const profileImage = document.getElementById('profileInitials');
            profileImage.innerHTML = `<img src="${savedImage}" alt="Profile Photo" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">`;
            document.querySelector('.upload-photo-btn').style.display = 'none';
            document.querySelector('.remove-photo-btn').style.display = 'inline-flex';
        }
        
        if (savedData) {
            try {
                const data = JSON.parse(savedData);
                
                if (data.name) document.querySelector('.name').value = data.name;
                if (data.jobTitle) document.querySelector('.job-title').value = data.jobTitle;
                if (data.email) document.querySelector('input[type="email"]').value = data.email;
                if (data.phone) document.querySelector('input[type="tel"]').value = data.phone;
                if (data.location) document.querySelectorAll('.contact-text')[2].value = data.location;
                if (data.linkedin) document.querySelectorAll('.contact-text')[3].value = data.linkedin;
                if (data.summary) document.querySelector('.summary-text').textContent = data.summary;
                
                // Load skills
                if (data.skills) {
                    data.skills.forEach(skill => {
                        if (skill.trim()) {
                            addSkill();
                            const lastSkill = document.querySelector('#skillsList .skill-item:last-child span[contenteditable]');
                            if (lastSkill) lastSkill.textContent = skill;
                        }
                    });
                }
                
                // Load languages
                if (data.languages) {
                    data.languages.forEach(lang => {
                        if (lang.name && lang.name.trim()) {
                            addLanguage();
                            const lastLanguage = document.querySelector('#languagesList .language-item:last-child');
                            if (lastLanguage) {
                                lastLanguage.querySelector('strong').textContent = lang.name;
                                lastLanguage.querySelector('.proficiency').textContent = lang.level;
                            }
                        }
                    });
                }
                
                // Load interests
                if (data.interests) {
                    data.interests.forEach(interest => {
                        if (interest.trim()) {
                            addInterest();
                            const lastInterest = document.querySelector('#interestsList .interest-item:last-child span[contenteditable]');
                            if (lastInterest) lastInterest.textContent = interest;
                        }
                    });
                }
                
                updateInitials();
            } catch (e) {
                console.log('Error loading saved data');
            }
        }
    });

    // Enhanced button interactions
    document.querySelectorAll('.control-btn').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px) scale(1.02)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });

    // Initialize
    updateInitials();
    
    console.log('🎯 Professional Resume Builder loaded successfully!');
    console.log('✅ User-specific data storage implemented');
    console.log('✅ Empty resume template for all users');
    console.log('✅ Fully editable content');
    console.log('✅ Add/delete buttons for all sections');
    console.log('✅ Color-preserved PDF download');
    console.log('✅ Single-page optimized layout');
    console.log(`📁 Storage key: ${getUserStorageKey()}`);
    console.log(`👤 User ID: ${getUserId()}`);
    if (window.LaravelUser) {
        console.log(`✅ Authenticated user: ${window.LaravelUser.name} (${window.LaravelUser.email})`);
    } else {
        console.log('👻 Guest user - data will be saved locally');
    }
});
</script>
@endsection