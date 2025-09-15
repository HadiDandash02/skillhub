@extends('layouts.app')

@section('content')
<div class="course-page">
    <!-- Professional Header Section -->
    <section class="header-section">
        <div class="header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-plus-circle"></i>
                    <span>New Course</span>
                </div>
                <h1 class="header-title">Create New Course</h1>
                <p class="header-description">Design comprehensive learning experiences for your students</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('instructor.courses') }}" class="btn-secondary-header">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Courses</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-container">
            <form method="POST" action="{{ route('instructor.courses.store') }}" class="edit-course-form" enctype="multipart/form-data">
                @csrf

                <!-- Basic Information Card -->
                <div class="card form-card">
                    <div class="card-header">
                        <div class="section-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h2 class="card-title">Course Details</h2>
                    </div>
                    <div class="card-body">
                        <!-- Title -->
                        <div class="form-group">
                            <label for="title" class="form-label">
                                <i class="fas fa-heading"></i>
                                Title<span class="required">*</span>
                            </label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" 
                                   class="form-control @error('title') is-invalid @enderror" required placeholder="Enter course title">
                            @error('title')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left"></i>
                                Description<span class="required">*</span>
                            </label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" 
                                      rows="5" required placeholder="Provide a detailed course description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Instructor (Read-only) -->
                        <div class="form-group">
                            <label for="instructor_display" class="form-label">
                                <i class="fas fa-user-tie"></i>
                                Instructor<span class="required">*</span>
                            </label>
                            <div class="instructor-info-container">
                                <input type="text" id="instructor_display" 
                                       value="{{ auth()->user()->name }}" 
                                       class="form-control instructor-readonly" 
                                       readonly placeholder="Course instructor name">
                                <div class="instructor-badge">
                                    <i class="fas fa-check-circle"></i>
                                    <span>You are the instructor</span>
                                </div>
                            </div>
                            <!-- Hidden field to send the instructor name -->
                            <input type="hidden" name="instructor" value="{{ auth()->user()->name }}">
                            @error('instructor')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">

                            <!-- Difficulty -->
                        <div class="form-group">
                            <label for="difficulty" class="form-label">
                                <i class="fas fa-chart-line"></i>
                                Difficulty Level<span class="required">*</span>
                            </label>
                            <select name="difficulty" id="difficulty" class="form-control @error('difficulty') is-invalid @enderror" required>
                                <option value="" disabled selected>Select difficulty level</option>
                                <option value="Beginner" {{ old('difficulty') === 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="Intermediate" {{ old('difficulty') === 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="Advanced" {{ old('difficulty') === 'Advanced' ? 'selected' : '' }}>Advanced</option>
                            </select>
                            @error('difficulty')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                            <!-- Category -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category" class="form-label">
                                        <i class="fas fa-tags"></i>
                                        Category<span class="required">*</span>
                                    </label>
                                    <select name="category" id="category" class="form-control category-dropdown @error('category') is-invalid @enderror" required>
                                        <option value="" disabled selected>Select course category</option>
                                        
                                        <!-- Web Development -->
                                        <optgroup label="🌐 Web Development">
                                            <option value="Frontend Development" {{ old('category') === 'Frontend Development' ? 'selected' : '' }}>Frontend Development</option>
                                            <option value="Backend Development" {{ old('category') === 'Backend Development' ? 'selected' : '' }}>Backend Development</option>
                                            <option value="Full Stack Development" {{ old('category') === 'Full Stack Development' ? 'selected' : '' }}>Full Stack Development</option>
                                            <option value="JavaScript Frameworks" {{ old('category') === 'JavaScript Frameworks' ? 'selected' : '' }}>JavaScript Frameworks</option>
                                            <option value="TypeScript" {{ old('category') === 'TypeScript' ? 'selected' : '' }}>TypeScript</option>
                                            <option value="PHP Development" {{ old('category') === 'PHP Development' ? 'selected' : '' }}>PHP Development</option>
                                        </optgroup>
                                        
                                        <!-- Programming Languages -->
                                        <optgroup label="💻 Programming Languages">
                                            <option value="Python Programming" {{ old('category') === 'Python Programming' ? 'selected' : '' }}>Python Programming</option>
                                            <option value="Java Programming" {{ old('category') === 'Java Programming' ? 'selected' : '' }}>Java Programming</option>
                                            <option value="C/C++ Programming" {{ old('category') === 'C/C++ Programming' ? 'selected' : '' }}>C/C++ Programming</option>
                                            <option value="C# Programming" {{ old('category') === 'C# Programming' ? 'selected' : '' }}>C# Programming</option>
                                            <option value="JavaScript Programming" {{ old('category') === 'JavaScript Programming' ? 'selected' : '' }}>JavaScript Programming</option>
                                            <option value="Go Programming" {{ old('category') === 'Go Programming' ? 'selected' : '' }}>Go Programming</option>
                                            <option value="Rust Programming" {{ old('category') === 'Rust Programming' ? 'selected' : '' }}>Rust Programming</option>
                                            <option value="Swift Programming" {{ old('category') === 'Swift Programming' ? 'selected' : '' }}>Swift Programming</option>
                                            <option value="Kotlin Programming" {{ old('category') === 'Kotlin Programming' ? 'selected' : '' }}>Kotlin Programming</option>
                                            <option value="Scala Programming" {{ old('category') === 'Scala Programming' ? 'selected' : '' }}>Scala Programming</option>
                                        </optgroup>
                                        
                                        <!-- Data Science & Analytics -->
                                        <optgroup label="📊 Data Science & Analytics">
                                            <option value="Data Science" {{ old('category') === 'Data Science' ? 'selected' : '' }}>Data Science</option>
                                            <option value="Machine Learning" {{ old('category') === 'Machine Learning' ? 'selected' : '' }}>Machine Learning</option>
                                            <option value="Statistical Computing" {{ old('category') === 'Statistical Computing' ? 'selected' : '' }}>Statistical Computing (R)</option>
                                            <option value="Scientific Computing" {{ old('category') === 'Scientific Computing' ? 'selected' : '' }}>Scientific Computing (Octave/MATLAB)</option>
                                            <option value="Data Analysis" {{ old('category') === 'Data Analysis' ? 'selected' : '' }}>Data Analysis</option>
                                        </optgroup>
                                        
                                        <!-- Mobile Development -->
                                        <optgroup label="📱 Mobile Development">
                                            <option value="iOS Development" {{ old('category') === 'iOS Development' ? 'selected' : '' }}>iOS Development (Swift)</option>
                                            <option value="Android Development" {{ old('category') === 'Android Development' ? 'selected' : '' }}>Android Development (Java/Kotlin)</option>
                                            <option value="Cross-Platform Mobile" {{ old('category') === 'Cross-Platform Mobile' ? 'selected' : '' }}>Cross-Platform Mobile</option>
                                        </optgroup>
                                        
                                        <!-- Functional Programming -->
                                        <optgroup label="🔧 Functional Programming">
                                            <option value="Functional Programming" {{ old('category') === 'Functional Programming' ? 'selected' : '' }}>Functional Programming</option>
                                            <option value="Haskell Programming" {{ old('category') === 'Haskell Programming' ? 'selected' : '' }}>Haskell Programming</option>
                                            <option value="F# Programming" {{ old('category') === 'F# Programming' ? 'selected' : '' }}>F# Programming</option>
                                            <option value="Clojure Programming" {{ old('category') === 'Clojure Programming' ? 'selected' : '' }}>Clojure Programming</option>
                                            <option value="Erlang/Elixir" {{ old('category') === 'Erlang/Elixir' ? 'selected' : '' }}>Erlang/Elixir</option>
                                            <option value="OCaml Programming" {{ old('category') === 'OCaml Programming' ? 'selected' : '' }}>OCaml Programming</option>
                                            <option value="Common Lisp" {{ old('category') === 'Common Lisp' ? 'selected' : '' }}>Common Lisp</option>
                                        </optgroup>
                                        
                                        <!-- System Programming -->
                                        <optgroup label="⚙️ System Programming">
                                            <option value="System Programming" {{ old('category') === 'System Programming' ? 'selected' : '' }}>System Programming</option>
                                            <option value="Assembly Language" {{ old('category') === 'Assembly Language' ? 'selected' : '' }}>Assembly Language</option>
                                            <option value="Operating Systems" {{ old('category') === 'Operating Systems' ? 'selected' : '' }}>Operating Systems</option>
                                            <option value="Embedded Systems" {{ old('category') === 'Embedded Systems' ? 'selected' : '' }}>Embedded Systems</option>
                                            <option value="Low-Level Programming" {{ old('category') === 'Low-Level Programming' ? 'selected' : '' }}>Low-Level Programming</option>
                                        </optgroup>
                                        
                                        <!-- Scripting & Automation -->
                                        <optgroup label="🔄 Scripting & Automation">
                                            <option value="Shell Scripting" {{ old('category') === 'Shell Scripting' ? 'selected' : '' }}>Shell Scripting (Bash)</option>
                                            <option value="Python Scripting" {{ old('category') === 'Python Scripting' ? 'selected' : '' }}>Python Scripting</option>
                                            <option value="Ruby Scripting" {{ old('category') === 'Ruby Scripting' ? 'selected' : '' }}>Ruby Scripting</option>
                                            <option value="Perl Scripting" {{ old('category') === 'Perl Scripting' ? 'selected' : '' }}>Perl Scripting</option>
                                            <option value="Automation" {{ old('category') === 'Automation' ? 'selected' : '' }}>Automation</option>
                                        </optgroup>
                                        
                                        <!-- Database & Query Languages -->
                                        <optgroup label="🗄️ Database & Query Languages">
                                            <option value="SQL Programming" {{ old('category') === 'SQL Programming' ? 'selected' : '' }}>SQL Programming</option>
                                            <option value="Database Design" {{ old('category') === 'Database Design' ? 'selected' : '' }}>Database Design</option>
                                            <option value="Database Management" {{ old('category') === 'Database Management' ? 'selected' : '' }}>Database Management</option>
                                            <option value="Prolog Logic Programming" {{ old('category') === 'Prolog Logic Programming' ? 'selected' : '' }}>Prolog Logic Programming</option>
                                        </optgroup>
                                        
                                        <!-- Legacy & Enterprise -->
                                        <optgroup label="🏢 Legacy & Enterprise">
                                            <option value="Legacy Programming" {{ old('category') === 'Legacy Programming' ? 'selected' : '' }}>Legacy Programming</option>
                                            <option value="COBOL Programming" {{ old('category') === 'COBOL Programming' ? 'selected' : '' }}>COBOL Programming</option>
                                            <option value="Fortran Programming" {{ old('category') === 'Fortran Programming' ? 'selected' : '' }}>Fortran Programming</option>
                                            <option value="Pascal Programming" {{ old('category') === 'Pascal Programming' ? 'selected' : '' }}>Pascal Programming</option>
                                            <option value="Visual Basic .NET" {{ old('category') === 'Visual Basic .NET' ? 'selected' : '' }}>Visual Basic .NET</option>
                                            <option value="Basic Programming" {{ old('category') === 'Basic Programming' ? 'selected' : '' }}>Basic Programming</option>
                                        </optgroup>
                                        
                                        <!-- Specialized Languages -->
                                        <optgroup label="🎯 Specialized Languages">
                                            <option value="Game Development" {{ old('category') === 'Game Development' ? 'selected' : '' }}>Game Development</option>
                                            <option value="Lua Programming" {{ old('category') === 'Lua Programming' ? 'selected' : '' }}>Lua Programming</option>
                                            <option value="Groovy Programming" {{ old('category') === 'Groovy Programming' ? 'selected' : '' }}>Groovy Programming</option>
                                            <option value="D Programming" {{ old('category') === 'D Programming' ? 'selected' : '' }}>D Programming</option>
                                        </optgroup>
                                        
                                        <!-- Fundamentals & Concepts -->
                                        <optgroup label="📚 Fundamentals & Concepts">
                                            <option value="Programming Fundamentals" {{ old('category') === 'Programming Fundamentals' ? 'selected' : '' }}>Programming Fundamentals</option>
                                            <option value="Computer Science Basics" {{ old('category') === 'Computer Science Basics' ? 'selected' : '' }}>Computer Science Basics</option>
                                            <option value="Data Structures & Algorithms" {{ old('category') === 'Data Structures & Algorithms' ? 'selected' : '' }}>Data Structures & Algorithms</option>
                                            <option value="Object-Oriented Programming" {{ old('category') === 'Object-Oriented Programming' ? 'selected' : '' }}>Object-Oriented Programming</option>
                                            <option value="Software Engineering" {{ old('category') === 'Software Engineering' ? 'selected' : '' }}>Software Engineering</option>
                                            <option value="Code Quality & Testing" {{ old('category') === 'Code Quality & Testing' ? 'selected' : '' }}>Code Quality & Testing</option>
                                        </optgroup>
                                        
                                        <!-- Other -->
                                        <optgroup label="🔧 Other">
                                            <option value="Mixed Languages" {{ old('category') === 'Mixed Languages' ? 'selected' : '' }}>Mixed Languages</option>
                                            <option value="Custom Category" {{ old('category') === 'Custom Category' ? 'selected' : '' }}>Custom Category</option>
                                        </optgroup>
                                    </select>
                                    @error('category')
                                        <span class="form-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        

                        
                    </div>

                    <!-- Submit Button -->
                    <div class="submit-group">
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save"></i> Create Course
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let chapterIndex = 1;
    let pdfIndex = 1;
    let tutorialIndex = 1;

    function addChapter() {
        const chaptersContainer = document.getElementById('chapters-container');
        const newChapter = document.createElement('div');
        newChapter.classList.add('chapter-group', 'mb-4');
        newChapter.setAttribute('data-index', chapterIndex);

        newChapter.innerHTML = `
            <div class="form-group">
                <label class="form-label">Chapter Title<span class="required">*</span></label>
                <input type="text" name="chapters[${chapterIndex}][title]" class="form-control mb-2" placeholder="Chapter title" required>
            </div>

            <div class="form-group">
                <label class="form-label">Chapter Description</label>
                <textarea name="chapters[${chapterIndex}][description]" class="form-control" rows="3" placeholder="Chapter description"></textarea>
            </div>

            <div class="form-group">
                <label class="form-label">PDF Resources</label>
                <div class="pdfs-container">
                    <div class="pdf-group mb-2">
                        <label>PDF Title</label>
                        <input type="text" name="chapters[${chapterIndex}][pdfs][0][title]" class="form-control" placeholder="PDF title" required>
                        
                        <label>PDF File</label>
                        <input type="file" name="chapters[${chapterIndex}][pdfs][0][pdf_file]" class="form-control" accept=".pdf" required>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary btn-sm mt-1" onclick="addPdf(this)">+ Add PDF</button>
            </div>
        `;

        chaptersContainer.appendChild(newChapter);
        chapterIndex++;
    }

    function addPdf(button) {
        const chapterGroup = button.closest('.chapter-group');
        const chapterIndex = chapterGroup.getAttribute('data-index');
        const pdfsContainer = chapterGroup.querySelector('.pdfs-container');

        const pdfGroup = document.createElement('div');
        pdfGroup.classList.add('pdf-group', 'mb-2');
        pdfGroup.innerHTML = `
            <label>PDF Title</label>
            <input type="text" name="chapters[${chapterIndex}][pdfs][${pdfIndex}][title]" class="form-control" placeholder="PDF title" required>
            
            <label>PDF File</label>
            <input type="file" name="chapters[${chapterIndex}][pdfs][${pdfIndex}][pdf_file]" class="form-control" accept=".pdf" required>
        `;

        pdfsContainer.appendChild(pdfGroup);
        pdfIndex++;
    }

    function addTutorial() {
        const container = document.getElementById('tutorials-container');
        const newTutorial = document.createElement('div');
        newTutorial.classList.add('form-group');
        newTutorial.innerHTML = `
            <label class="form-label">Tutorial Link</label>
            <input type="url" name="tutorials[${tutorialIndex}][link]" class="form-control" placeholder="https://www.youtube.com/watch?v=...">
        `;
        container.appendChild(newTutorial);
        tutorialIndex++;
    }

    // Enhanced form interactions
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.form-control').forEach(element => {
            element.addEventListener('focus', function() {
                this.closest('.form-group').style.transform = 'scale(1.02)';
            });
            
            element.addEventListener('blur', function() {
                this.closest('.form-group').style.transform = '';
            });
        });

        // Auto-resize textareas
        document.querySelectorAll('textarea').forEach(textarea => {
            textarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = this.scrollHeight + 'px';
            });
        });

        console.log('🎨 Professional Course Create Form loaded!');
    });
</script>

<style>
/* Professional Course Management System Styles */
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
.course-page {
    min-height: 100vh;
    background: var(--primary-gradient);
    position: relative;
    overflow-x: hidden;
}

.course-page::before {
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

.header-actions .btn-secondary-header {
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

.btn-secondary-header:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
    color: white;
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
}

/* Course Edit Container Override */
.course-edit-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    color: var(--text-primary);
    background: transparent;
}

/* Form Sections */
.form-card {
    background: var(--surface-white);
    border-radius: var(--border-radius-large);
    margin-bottom: 2rem;
    box-shadow: var(--shadow-medium);
    border: 1px solid var(--border-light);
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, var(--surface-white) 0%, var(--surface-light) 100%);
    padding: 2rem 2.5rem;
    border-bottom: 1px solid var(--border-light);
    display: flex;
    align-items: center;
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

/* Form Groups */
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
    color: #ef4444;
    margin-left: 3px;
}

/* Form Controls */
.form-control,
input[type="text"],
input[type="url"],
select,
textarea {
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

.form-control:focus,
input[type="text"]:focus,
input[type="url"]:focus,
select:focus,
textarea:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    transform: translateY(-1px);
}

/* Enhanced Category Dropdown Styling */
.category-dropdown {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%232563eb' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 16px;
    padding-right: 3rem;
    cursor: pointer;
    position: relative;
}

.category-dropdown:hover {
    background-color: var(--surface-light);
    border-color: var(--primary-color);
}

.category-dropdown:focus {
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2310b981' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
}

/* Custom Dropdown Options Styling */
.category-dropdown option {
    padding: 0.75rem 1rem;
    background: var(--surface-white);
    color: var(--text-primary);
    border: none;
    font-size: 0.95rem;
    line-height: 1.4;
}

.category-dropdown option:hover {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    color: white;
}

.category-dropdown option:checked {
    background: var(--primary-gradient);
    color: white;
    font-weight: 600;
}

/* OptGroup Styling */
.category-dropdown optgroup {
    background: var(--surface-light);
    color: var(--text-primary);
    font-weight: 700;
    font-size: 0.875rem;
    padding: 0.5rem 1rem;
    margin: 0.25rem 0;
    border: none;
    font-style: normal;
}

.category-dropdown optgroup option {
    padding-left: 1.5rem;
    background: var(--surface-white);
    color: var(--text-secondary);
    font-weight: 500;
    border-left: 3px solid var(--primary-color);
    margin-left: 0.5rem;
}

/* Force dropdown to open downward */
.category-dropdown {
    position: relative;
    z-index: 1;
}

/* Ensure the dropdown container has enough space below */
.form-group:has(.category-dropdown) {
    position: relative;
    margin-bottom: 3rem;
}

/* Custom scrollbar for long dropdown lists */
.category-dropdown::-webkit-scrollbar {
    width: 8px;
}

.category-dropdown::-webkit-scrollbar-track {
    background: var(--surface-light);
    border-radius: 4px;
}

.category-dropdown::-webkit-scrollbar-thumb {
    background: var(--primary-gradient);
    border-radius: 4px;
}

.category-dropdown::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, var(--primary-dark), var(--accent-color));
}

/* Animation for dropdown opening */
.category-dropdown option,
.category-dropdown optgroup {
    animation: fadeInOption 0.2s ease-in-out;
}

@keyframes fadeInOption {
    from {
        opacity: 0;
        transform: translateY(-5px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* NEW: Instructor field styling */
.instructor-info-container {
    position: relative;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.instructor-readonly {
    background: linear-gradient(135deg, var(--surface-light) 0%, #f0f8ff 100%) !important;
    border-color: var(--accent-color) !important;
    color: var(--text-primary) !important;
    font-weight: 600;
    cursor: not-allowed;
}

.instructor-readonly:focus {
    border-color: var(--accent-color) !important;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
    transform: none !important;
}

.instructor-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: var(--accent-color);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    white-space: nowrap;
    box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
}

.instructor-badge i {
    font-size: 0.75rem;
}

textarea {
    resize: vertical;
    min-height: 120px;
    line-height: 1.6;
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

/* Row Layout */
.row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 2rem;
}

.col-md-6 {
    display: flex;
    flex-direction: column;
}

/* Submit Group */
.submit-group {
    text-align: center;
    margin-top: 3rem;
    padding: 2rem 2.5rem;
    background: var(--surface-light);
    border-top: 1px solid var(--border-light);
}

.btn-submit {
    background: var(--primary-gradient);
    color: white;
    font-weight: 700;
    padding: 1.25rem 2.5rem;
    font-size: 1.15rem;
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

/* Responsive Design */
@media (max-width: 1024px) {
    .row {
        grid-template-columns: 1fr;
    }
    
    .header-container {
        flex-direction: column;
        text-align: center;
    }
    
    .instructor-info-container {
        flex-direction: column;
        align-items: stretch;
        gap: 0.75rem;
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

    .submit-group {
        padding: 1.5rem;
    }
    
    .instructor-info-container {
        flex-direction: column;
        align-items: stretch;
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

    .form-control,
    input[type="text"],
    input[type="url"],
    select,
    textarea {
        padding: 0.875rem 1rem;
    }
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

.form-card {
    animation: fadeInUp 0.6s ease forwards;
}

/* Focus States for Accessibility */
.btn-submit:focus,
.form-control:focus,
input:focus,
select:focus,
textarea:focus {
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