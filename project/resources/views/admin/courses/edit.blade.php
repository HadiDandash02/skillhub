@extends('layouts.app')

@section('content')
<div class="course-page">
    <!-- Professional Header Section -->
    <section class="header-section">
        <div class="header-container">
            <div class="header-content">
                <div class="header-badge">
                    <i class="fas fa-edit"></i>
                    <span>Edit Course</span>
                </div>
                <h1 class="header-title">Edit Course</h1>
                <p class="header-description">Modify and enhance your educational content</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.courses') }}" class="btn-secondary-header">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Course</span>
                </a>
            </div>
        </div>
    </section>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <div class="content-container">
            <form method="POST" action="{{ route('admin.courses.update', $course->id) }}" class="edit-course-form">
                @csrf
                @method('PATCH')

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
                            <input type="text" name="title" id="title" value="{{ old('title', $course->title) }}" 
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
                                      rows="5" required placeholder="Provide a detailed course description">{{ old('description', $course->description) }}</textarea>
                            @error('description')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Instructor Dropdown -->
                        <div class="form-group">
                            <label for="instructor_id" class="form-label">
                                <i class="fas fa-user-tie"></i>
                                Instructor<span class="required">*</span>
                            </label>
                            <select name="instructor_id" id="instructor_id" class="form-control instructor-dropdown @error('instructor_id') is-invalid @enderror" required>
                                <option value="" disabled>Select course instructor</option>
                                @foreach($instructors as $instructor)
                                    <option value="{{ $instructor->id }}" {{ old('instructor_id', $course->instructor_id) == $instructor->id ? 'selected' : '' }}>
                                        {{ $instructor->name }} ({{ $instructor->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('instructor_id')
                                <span class="form-error">{{ $message }}</span>
                            @enderror
                            <div class="instructor-info">
                                <i class="fas fa-info-circle"></i>
                                <span>Select the instructor who will manage this course</span>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Difficulty -->
                            <div class="form-group">
                                <label for="difficulty" class="form-label">
                                    <i class="fas fa-chart-line"></i>
                                    Difficulty Level<span class="required">*</span>
                                </label>
                                <select name="difficulty" id="difficulty" class="form-control @error('difficulty') is-invalid @enderror" required>
                                    <option value="" disabled>Select difficulty level</option>
                                    <option value="Beginner" {{ old('difficulty', $course->difficulty) === 'Beginner' ? 'selected' : '' }}>Beginner</option>
                                    <option value="Intermediate" {{ old('difficulty', $course->difficulty) === 'Intermediate' ? 'selected' : '' }}>Intermediate</option>
                                    <option value="Advanced" {{ old('difficulty', $course->difficulty) === 'Advanced' ? 'selected' : '' }}>Advanced</option>
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
                                        <option value="" disabled>Select course category</option>
                                        
                                        <!-- Web Development -->
                                        <optgroup label="🌐 Web Development">
                                            <option value="Frontend Development" {{ old('category', $course->category) === 'Frontend Development' ? 'selected' : '' }}>Frontend Development</option>
                                            <option value="Backend Development" {{ old('category', $course->category) === 'Backend Development' ? 'selected' : '' }}>Backend Development</option>
                                            <option value="Full Stack Development" {{ old('category', $course->category) === 'Full Stack Development' ? 'selected' : '' }}>Full Stack Development</option>
                                            <option value="JavaScript Frameworks" {{ old('category', $course->category) === 'JavaScript Frameworks' ? 'selected' : '' }}>JavaScript Frameworks</option>
                                            <option value="TypeScript" {{ old('category', $course->category) === 'TypeScript' ? 'selected' : '' }}>TypeScript</option>
                                            <option value="PHP Development" {{ old('category', $course->category) === 'PHP Development' ? 'selected' : '' }}>PHP Development</option>
                                        </optgroup>
                                        
                                        <!-- Programming Languages -->
                                        <optgroup label="💻 Programming Languages">
                                            <option value="Python Programming" {{ old('category', $course->category) === 'Python Programming' ? 'selected' : '' }}>Python Programming</option>
                                            <option value="Java Programming" {{ old('category', $course->category) === 'Java Programming' ? 'selected' : '' }}>Java Programming</option>
                                            <option value="C/C++ Programming" {{ old('category', $course->category) === 'C/C++ Programming' ? 'selected' : '' }}>C/C++ Programming</option>
                                            <option value="C# Programming" {{ old('category', $course->category) === 'C# Programming' ? 'selected' : '' }}>C# Programming</option>
                                            <option value="JavaScript Programming" {{ old('category', $course->category) === 'JavaScript Programming' ? 'selected' : '' }}>JavaScript Programming</option>
                                            <option value="Go Programming" {{ old('category', $course->category) === 'Go Programming' ? 'selected' : '' }}>Go Programming</option>
                                            <option value="Rust Programming" {{ old('category', $course->category) === 'Rust Programming' ? 'selected' : '' }}>Rust Programming</option>
                                            <option value="Swift Programming" {{ old('category', $course->category) === 'Swift Programming' ? 'selected' : '' }}>Swift Programming</option>
                                            <option value="Kotlin Programming" {{ old('category', $course->category) === 'Kotlin Programming' ? 'selected' : '' }}>Kotlin Programming</option>
                                            <option value="Scala Programming" {{ old('category', $course->category) === 'Scala Programming' ? 'selected' : '' }}>Scala Programming</option>
                                        </optgroup>
                                        
                                        <!-- Data Science & Analytics -->
                                        <optgroup label="📊 Data Science & Analytics">
                                            <option value="Data Science" {{ old('category', $course->category) === 'Data Science' ? 'selected' : '' }}>Data Science</option>
                                            <option value="Machine Learning" {{ old('category', $course->category) === 'Machine Learning' ? 'selected' : '' }}>Machine Learning</option>
                                            <option value="Statistical Computing" {{ old('category', $course->category) === 'Statistical Computing' ? 'selected' : '' }}>Statistical Computing (R)</option>
                                            <option value="Scientific Computing" {{ old('category', $course->category) === 'Scientific Computing' ? 'selected' : '' }}>Scientific Computing (Octave/MATLAB)</option>
                                            <option value="Data Analysis" {{ old('category', $course->category) === 'Data Analysis' ? 'selected' : '' }}>Data Analysis</option>
                                        </optgroup>
                                        
                                        <!-- Mobile Development -->
                                        <optgroup label="📱 Mobile Development">
                                            <option value="iOS Development" {{ old('category', $course->category) === 'iOS Development' ? 'selected' : '' }}>iOS Development (Swift)</option>
                                            <option value="Android Development" {{ old('category', $course->category) === 'Android Development' ? 'selected' : '' }}>Android Development (Java/Kotlin)</option>
                                            <option value="Cross-Platform Mobile" {{ old('category', $course->category) === 'Cross-Platform Mobile' ? 'selected' : '' }}>Cross-Platform Mobile</option>
                                        </optgroup>
                                        
                                        <!-- Functional Programming -->
                                        <optgroup label="🔧 Functional Programming">
                                            <option value="Functional Programming" {{ old('category', $course->category) === 'Functional Programming' ? 'selected' : '' }}>Functional Programming</option>
                                            <option value="Haskell Programming" {{ old('category', $course->category) === 'Haskell Programming' ? 'selected' : '' }}>Haskell Programming</option>
                                            <option value="F# Programming" {{ old('category', $course->category) === 'F# Programming' ? 'selected' : '' }}>F# Programming</option>
                                            <option value="Clojure Programming" {{ old('category', $course->category) === 'Clojure Programming' ? 'selected' : '' }}>Clojure Programming</option>
                                            <option value="Erlang/Elixir" {{ old('category', $course->category) === 'Erlang/Elixir' ? 'selected' : '' }}>Erlang/Elixir</option>
                                            <option value="OCaml Programming" {{ old('category', $course->category) === 'OCaml Programming' ? 'selected' : '' }}>OCaml Programming</option>
                                            <option value="Common Lisp" {{ old('category', $course->category) === 'Common Lisp' ? 'selected' : '' }}>Common Lisp</option>
                                        </optgroup>
                                        
                                        <!-- System Programming -->
                                        <optgroup label="⚙️ System Programming">
                                            <option value="System Programming" {{ old('category', $course->category) === 'System Programming' ? 'selected' : '' }}>System Programming</option>
                                            <option value="Assembly Language" {{ old('category', $course->category) === 'Assembly Language' ? 'selected' : '' }}>Assembly Language</option>
                                            <option value="Operating Systems" {{ old('category', $course->category) === 'Operating Systems' ? 'selected' : '' }}>Operating Systems</option>
                                            <option value="Embedded Systems" {{ old('category', $course->category) === 'Embedded Systems' ? 'selected' : '' }}>Embedded Systems</option>
                                            <option value="Low-Level Programming" {{ old('category', $course->category) === 'Low-Level Programming' ? 'selected' : '' }}>Low-Level Programming</option>
                                        </optgroup>
                                        
                                        <!-- Scripting & Automation -->
                                        <optgroup label="🔄 Scripting & Automation">
                                            <option value="Shell Scripting" {{ old('category', $course->category) === 'Shell Scripting' ? 'selected' : '' }}>Shell Scripting (Bash)</option>
                                            <option value="Python Scripting" {{ old('category', $course->category) === 'Python Scripting' ? 'selected' : '' }}>Python Scripting</option>
                                            <option value="Ruby Scripting" {{ old('category', $course->category) === 'Ruby Scripting' ? 'selected' : '' }}>Ruby Scripting</option>
                                            <option value="Perl Scripting" {{ old('category', $course->category) === 'Perl Scripting' ? 'selected' : '' }}>Perl Scripting</option>
                                            <option value="Automation" {{ old('category', $course->category) === 'Automation' ? 'selected' : '' }}>Automation</option>
                                        </optgroup>
                                        
                                        <!-- Database & Query Languages -->
                                        <optgroup label="🗄️ Database & Query Languages">
                                            <option value="SQL Programming" {{ old('category', $course->category) === 'SQL Programming' ? 'selected' : '' }}>SQL Programming</option>
                                            <option value="Database Design" {{ old('category', $course->category) === 'Database Design' ? 'selected' : '' }}>Database Design</option>
                                            <option value="Database Management" {{ old('category', $course->category) === 'Database Management' ? 'selected' : '' }}>Database Management</option>
                                            <option value="Prolog Logic Programming" {{ old('category', $course->category) === 'Prolog Logic Programming' ? 'selected' : '' }}>Prolog Logic Programming</option>
                                        </optgroup>
                                        
                                        <!-- Legacy & Enterprise -->
                                        <optgroup label="🏢 Legacy & Enterprise">
                                            <option value="Legacy Programming" {{ old('category', $course->category) === 'Legacy Programming' ? 'selected' : '' }}>Legacy Programming</option>
                                            <option value="COBOL Programming" {{ old('category', $course->category) === 'COBOL Programming' ? 'selected' : '' }}>COBOL Programming</option>
                                            <option value="Fortran Programming" {{ old('category', $course->category) === 'Fortran Programming' ? 'selected' : '' }}>Fortran Programming</option>
                                            <option value="Pascal Programming" {{ old('category', $course->category) === 'Pascal Programming' ? 'selected' : '' }}>Pascal Programming</option>
                                            <option value="Visual Basic .NET" {{ old('category', $course->category) === 'Visual Basic .NET' ? 'selected' : '' }}>Visual Basic .NET</option>
                                            <option value="Basic Programming" {{ old('category', $course->category) === 'Basic Programming' ? 'selected' : '' }}>Basic Programming</option>
                                        </optgroup>
                                        
                                        <!-- Specialized Languages -->
                                        <optgroup label="🎯 Specialized Languages">
                                            <option value="Game Development" {{ old('category', $course->category) === 'Game Development' ? 'selected' : '' }}>Game Development</option>
                                            <option value="Lua Programming" {{ old('category', $course->category) === 'Lua Programming' ? 'selected' : '' }}>Lua Programming</option>
                                            <option value="Groovy Programming" {{ old('category', $course->category) === 'Groovy Programming' ? 'selected' : '' }}>Groovy Programming</option>
                                            <option value="D Programming" {{ old('category', $course->category) === 'D Programming' ? 'selected' : '' }}>D Programming</option>
                                        </optgroup>
                                        
                                        <!-- Fundamentals & Concepts -->
                                        <optgroup label="📚 Fundamentals & Concepts">
                                            <option value="Programming Fundamentals" {{ old('category', $course->category) === 'Programming Fundamentals' ? 'selected' : '' }}>Programming Fundamentals</option>
                                            <option value="Computer Science Basics" {{ old('category', $course->category) === 'Computer Science Basics' ? 'selected' : '' }}>Computer Science Basics</option>
                                            <option value="Data Structures & Algorithms" {{ old('category', $course->category) === 'Data Structures & Algorithms' ? 'selected' : '' }}>Data Structures & Algorithms</option>
                                            <option value="Object-Oriented Programming" {{ old('category', $course->category) === 'Object-Oriented Programming' ? 'selected' : '' }}>Object-Oriented Programming</option>
                                            <option value="Software Engineering" {{ old('category', $course->category) === 'Software Engineering' ? 'selected' : '' }}>Software Engineering</option>
                                            <option value="Code Quality & Testing" {{ old('category', $course->category) === 'Code Quality & Testing' ? 'selected' : '' }}>Code Quality & Testing</option>
                                        </optgroup>
                                        
                                        <!-- Other -->
                                        <optgroup label="🔧 Other">
                                            <option value="Mixed Languages" {{ old('category', $course->category) === 'Mixed Languages' ? 'selected' : '' }}>Mixed Languages</option>
                                            <option value="Custom Category" {{ old('category', $course->category) === 'Custom Category' ? 'selected' : '' }}>Custom Category</option>
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
                            <i class="fas fa-save"></i> Update Course
                        </button>
                    </div>
                </div>
            </form>

            <!-- Course Chapters & Materials Section -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="section-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <h2 class="card-title">Course Chapters & Materials</h2>
                </div>
                <div class="card-body">
                    {{-- If no chapters --}}
                    @if($course->chapters->isEmpty())
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <h3 class="empty-state-title">No Chapters Yet</h3>
                            <p class="empty-state-description">Start building your course by adding chapters and learning materials</p>
                        </div>
                    @else
                        <div class="chapters-list">
                            @foreach($course->chapters as $chapter)
                                <div class="chapter-item">
                                    <div class="chapter-header" onclick="toggleChapterDetails({{ $chapter->id }})">
                                        <div class="chapter-info">
                                            <div class="chapter-number">{{ $loop->iteration }}</div>
                                            <div class="chapter-title-wrapper">
                                                <h4 class="chapter-title">{{ $chapter->title }}</h4>
                                                <p class="chapter-subtitle">{{ $chapter->pdfs->count() }} materials</p>
                                            </div>
                                        </div>
                                        <div class="chapter-actions">
                                            <button type="button" class="btn-icon btn-edit-chapter">
                                                <i class="fas fa-chevron-down" id="chevron-{{ $chapter->id }}"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Chapter Details -->
                                    <div id="chapter-details-{{ $chapter->id }}" class="chapter-details" style="display:none;">
                                        <form method="POST" action="{{ route('admin.chapters.update', $chapter->id) }}" class="chapter-form">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group">
                                                <label for="chapter_title_{{ $chapter->id }}" class="form-label">
                                                    <i class="fas fa-heading"></i>
                                                    Chapter Title
                                                </label>
                                                <input type="text" name="title" id="chapter_title_{{ $chapter->id }}"
                                                       class="form-control" value="{{ old("chapters.$chapter->id.title", $chapter->title) }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="chapter_description_{{ $chapter->id }}" class="form-label">
                                                    <i class="fas fa-align-left"></i>
                                                    Description
                                                </label>
                                                <textarea name="description" id="chapter_description_{{ $chapter->id }}" 
                                                          class="form-control" rows="3" required>{{ old("chapters.$chapter->id.description", $chapter->description) }}</textarea>
                                            </div>
                                            <div class="form-actions">
                                                <button type="submit" class="btn-action btn-save">
                                                    <i class="fas fa-save"></i> Save Changes
                                                </button>
                                                <form action="{{ route('admin.chapters.destroy', $chapter->id) }}" method="POST" class="inline-form" onsubmit="return confirm('Are you sure you want to delete this chapter?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn-action btn-delete">
                                                        <i class="fas fa-trash"></i> Delete Chapter
                                                    </button>
                                                </form>
                                            </div>
                                        </form>

                                        <!-- PDFs Section -->
                                        <div class="materials-section">
                                            <h5 class="section-subtitle">
                                                <i class="fas fa-file-pdf"></i>
                                                Learning Materials
                                            </h5>
                                            @if($chapter->pdfs->count())
                                                <div class="materials-grid">
                                                    @foreach($chapter->pdfs as $pdf)
                                                        <div class="material-item">
                                                            <div class="material-icon">
                                                                <i class="fas fa-file-pdf"></i>
                                                            </div>
                                                            <div class="material-info">
                                                                <h6 class="material-title">{{ $pdf->title }}</h6>
                                                                <p class="material-type">PDF Document</p>
                                                            </div>
                                                            <div class="material-actions">
                                                                <a href="{{ asset('storage/pdfs/'.$pdf->pdf_path) }}" target="_blank" class="btn-icon btn-view">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                <form action="{{ route('admin.pdfs.destroy', $pdf->id) }}" method="POST" class="inline-form">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn-icon btn-delete-material" onclick="return confirm('Delete this material?')">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="empty-materials">
                                                    <i class="fas fa-inbox"></i>
                                                    <p>No learning materials available</p>
                                                </div>
                                            @endif

                                            <!-- Add PDF Form -->
                                            <div class="add-material-form">
                                                <button type="button" class="btn-add-material" onclick="toggleAddPdfForm({{ $chapter->id }})">
                                                    <i class="fas fa-plus"></i> Add Material
                                                </button>
                                                <form id="pdf-form-{{ $chapter->id }}" action="{{ route('admin.pdfs.store') }}" method="POST" enctype="multipart/form-data" class="material-form" style="display: none;">
                                                    @csrf
                                                    <input type="hidden" name="chapter_id" value="{{ $chapter->id }}">
                                                    <div class="form-group">
                                                        <input type="text" name="title" placeholder="Material title" class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="file-input-wrapper">
                                                            <input type="file" name="pdf_file" id="pdf_file_{{ $chapter->id }}" class="file-input-hidden" accept=".pdf" required>
                                                            <label for="pdf_file_{{ $chapter->id }}" class="file-input-button">
                                                                <i class="fas fa-upload"></i>
                                                                <span class="file-text">Choose PDF File</span>
                                                            </label>
                                                            <span class="file-name" id="file_name_{{ $chapter->id }}">No file selected</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <button type="submit" class="btn-action btn-save">
                                                            <i class="fas fa-upload"></i> Upload
                                                        </button>
                                                        <button type="button" class="btn-action btn-cancel" onclick="toggleAddPdfForm({{ $chapter->id }})">
                                                            Cancel
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Add Chapter Button -->
                    <div class="add-chapter-section">
                        <button class="btn-add-chapter" onclick="toggleAddChapterForm()">
                            <i class="fas fa-plus"></i> Add Chapter
                        </button>
                    </div>

                    <!-- Add Chapter Form -->
                    <div id="add-chapter-form" class="add-chapter-form" style="display: none;">
                        <form method="POST" action="{{ route('admin.chapters.store') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="course_id" value="{{ $course->id }}">
                            <div class="form-group">
                                <label for="new_chapter_title" class="form-label">
                                    <i class="fas fa-heading"></i>
                                    Chapter Title
                                </label>
                                <input type="text" name="title" id="new_chapter_title" class="form-control" required placeholder="Enter chapter title">
                            </div>
                            <div class="form-group">
                                <label for="new_chapter_description" class="form-label">
                                    <i class="fas fa-align-left"></i>
                                    Description
                                </label>
                                <textarea name="description" id="new_chapter_description" class="form-control" rows="3" required placeholder="Enter chapter description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="new_chapter_pdf" class="form-label">
                                    <i class="fas fa-file-pdf"></i>
                                    Optional PDF Material
                                </label>
                                <div class="file-input-wrapper">
                                    <input type="file" name="pdf_file" id="new_chapter_pdf" class="file-input-hidden" accept=".pdf">
                                    <label for="new_chapter_pdf" class="file-input-button">
                                        <i class="fas fa-upload"></i>
                                        <span class="file-text">Choose PDF File</span>
                                    </label>
                                    <span class="file-name" id="new_chapter_file_name">No file selected</span>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn-action btn-save">
                                    <i class="fas fa-save"></i> Save Chapter
                                </button>
                                <button type="button" class="btn-action btn-cancel" onclick="toggleAddChapterForm()">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Related Content Section -->
            <div class="card form-card">
                <div class="card-header">
                    <div class="section-icon">
                        <i class="fas fa-puzzle-piece"></i>
                    </div>
                    <h2 class="card-title">Related Content</h2>
                </div>
                <div class="card-body">
                    <!-- Related Quizzes -->
                    <div class="content-section">
                        <h3 class="content-section-title">
                            <i class="fas fa-brain"></i>
                            Quizzes
                        </h3>
                        @if ($course->quizzes->count())
                            <div class="related-items-grid">
                                @foreach ($course->quizzes as $quiz)
                                    <div class="related-item">
                                        <div class="related-item-icon">
                                            <i class="fas fa-question-circle"></i>
                                        </div>
                                        <div class="related-item-content">
                                            <h4 class="related-item-title">{{ $quiz->title }}</h4>
                                            <p class="related-item-meta">Quiz</p>
                                        </div>
                                        <div class="related-item-actions">
                                            <a href="{{ route('admin.quizzes.edit', $quiz->id) }}" class="btn-icon btn-edit-related">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.quizzes.destroy', $quiz->id) }}" method="POST" class="inline-form" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-icon btn-delete-related">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-content">
                                <i class="fas fa-brain"></i>
                                <p>No quizzes associated with this course yet</p>
                            </div>
                        @endif
                        <a href="{{ route('admin.quizzes.create', ['course_id' => $course->id]) }}" class="btn-create-content">
                            <i class="fas fa-plus"></i> Create Quiz
                        </a>
                    </div>

                    <!-- Related Challenges -->
                    <div class="content-section">
                        <h3 class="content-section-title">
                            <i class="fas fa-trophy"></i>
                            Challenges
                        </h3>
                        @if ($course->challenges->count())
                            <div class="related-items-grid">
                                @foreach ($course->challenges as $challenge)
                                    <div class="related-item">
                                        <div class="related-item-icon">
                                            <i class="fas fa-trophy"></i>
                                        </div>
                                        <div class="related-item-content">
                                            <h4 class="related-item-title">{{ $challenge->title }}</h4>
                                            <p class="related-item-meta">Challenge</p>
                                        </div>
                                        <div class="related-item-actions">
                                            <a href="{{ route('admin.challenges.edit', $challenge->id) }}" class="btn-icon btn-edit-related">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.challenges.destroy', $challenge->id) }}" method="POST" class="inline-form" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-icon btn-delete-related">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-content">
                                <i class="fas fa-trophy"></i>
                                <p>No challenges associated with this course yet</p>
                            </div>
                        @endif
                        <a href="{{ route('admin.challenges.create', ['course_id' => $course->id]) }}" class="btn-create-content">
                            <i class="fas fa-plus"></i> Create Challenge
                        </a>
                    </div>

                    <!-- Video Tutorials Section -->
                    <div class="content-section">
                        <h3 class="content-section-title">
                            <i class="fas fa-play-circle"></i>
                            Video Tutorials
                        </h3>
                        @if ($course->tutorials->count())
                            <div class="tutorials-list">
                                @foreach ($course->tutorials as $tutorial)
                                    <div class="tutorial-item">
                                        <div class="tutorial-icon">
                                            <i class="fas fa-external-link-alt"></i>
                                        </div>
                                        <div class="tutorial-content">
                                            <a href="{{ $tutorial->link }}" target="_blank" class="tutorial-link">{{ $tutorial->link }}</a>
                                        </div>
                                        <div class="tutorial-actions">
                                            <form action="{{ route('admin.courses.tutorials.destroy', ['id' => $tutorial->id]) }}" 
                                                method="POST" class="inline-form" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-icon btn-delete-related">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-content">
                                <i class="fas fa-play-circle"></i>
                                <p>No tutorials associated with this course yet</p>
                            </div>
                        @endif

                        <!-- Add Tutorial Form -->
                        <button class="btn-create-content" id="showTutorialFormBtn">
                            <i class="fas fa-plus"></i> Add Tutorial
                        </button>
                        <form action="{{ route('admin.courses.tutorial.add', ['id' => $course->id]) }}"
                            method="POST" id="tutorialForm" class="tutorial-form" style="display: none;">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="tutorial_link" class="form-control" 
                                    placeholder="Enter tutorial link..." required>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn-action btn-save">
                                    <i class="fas fa-plus"></i> Add Tutorial
                                </button>
                                <button type="button" class="btn-action btn-cancel" onclick="hideTutorialForm()">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleChapterDetails(id) {
    const details = document.getElementById('chapter-details-' + id);
    const chevron = document.getElementById('chevron-' + id);
    
    if (details.style.display === 'none' || details.style.display === '') {
        details.style.display = 'block';
        chevron.style.transform = 'rotate(180deg)';
        details.style.animation = 'slideDown 0.3s ease forwards';
    } else {
        details.style.animation = 'slideUp 0.3s ease forwards';
        setTimeout(() => {
            details.style.display = 'none';
            chevron.style.transform = 'rotate(0deg)';
        }, 300);
    }
}

function toggleAddChapterForm() {
    const form = document.getElementById('add-chapter-form');
    if (form.style.display === 'none' || form.style.display === '') {
        form.style.display = 'block';
        form.style.animation = 'slideDown 0.3s ease forwards';
    } else {
        form.style.animation = 'slideUp 0.3s ease forwards';
        setTimeout(() => {
            form.style.display = 'none';
        }, 300);
    }
}

function toggleAddPdfForm(chapterId) {
    const form = document.getElementById('pdf-form-' + chapterId);
    if (form.style.display === 'none' || form.style.display === '') {
        form.style.display = 'block';
        form.style.animation = 'slideDown 0.3s ease forwards';
    } else {
        form.style.animation = 'slideUp 0.3s ease forwards';
        setTimeout(() => {
            form.style.display = 'none';
        }, 300);
    }
}

function hideTutorialForm() {
    const form = document.getElementById('tutorialForm');
    form.style.animation = 'slideUp 0.3s ease forwards';
    setTimeout(() => {
        form.style.display = 'none';
    }, 300);
}

document.getElementById('showTutorialFormBtn').addEventListener('click', function () {
    const form = document.getElementById('tutorialForm');
    form.style.display = 'block';
    form.style.animation = 'slideDown 0.3s ease forwards';
});

// File input handling
function setupFileInput(inputId, fileNameId) {
    const input = document.getElementById(inputId);
    const fileName = document.getElementById(fileNameId);
    
    if (input && fileName) {
        input.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                fileName.textContent = e.target.files[0].name;
                fileName.style.color = 'var(--primary-color)';
            } else {
                fileName.textContent = 'No file selected';
                fileName.style.color = 'var(--text-light)';
            }
        });
    }
}

// Enhanced form interactions
document.addEventListener('DOMContentLoaded', function() {
    // Setup file inputs
    setupFileInput('new_chapter_pdf', 'new_chapter_file_name');
    
    // Setup file inputs for existing chapters
    document.querySelectorAll('[id^="pdf_file_"]').forEach(input => {
        const chapterId = input.id.replace('pdf_file_', '');
        setupFileInput('pdf_file_' + chapterId, 'file_name_' + chapterId);
    });

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

    console.log('🎨 Professional Course Edit Form loaded!');
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
    transition: transform var(--animation-speed) var(--animation-curve);
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

/* Enhanced Instructor Dropdown Styling */
.instructor-dropdown {
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

.instructor-dropdown:hover {
    background-color: var(--surface-light);
    border-color: var(--primary-color);
}

.instructor-dropdown:focus {
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2310b981' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
}

/* Instructor Info Styling */
.instructor-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 0.5rem;
    padding: 0.5rem 0.75rem;
    background: var(--surface-light);
    border-radius: 8px;
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.instructor-info i {
    color: var(--primary-color);
    font-size: 0.8rem;
}

/* Custom Dropdown Options Styling */
.category-dropdown option,
.instructor-dropdown option {
    padding: 0.75rem 1rem;
    background: var(--surface-white);
    color: var(--text-primary);
    border: none;
    font-size: 0.95rem;
    line-height: 1.4;
}

.category-dropdown option:hover,
.instructor-dropdown option:hover {
    background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
    color: white;
}

.category-dropdown option:checked,
.instructor-dropdown option:checked {
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

/* File Input Styling */
.file-input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.file-input-hidden {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}

.file-input-button {
    background: var(--primary-gradient);
    color: white;
    padding: 1rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    border: none;
    position: relative;
    overflow: hidden;
    text-decoration: none;
    box-shadow: var(--shadow-subtle);
}

.file-input-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.file-input-button:hover::before {
    left: 100%;
}

.file-input-button:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

.file-input-button:focus {
    outline: 3px solid rgba(37, 99, 235, 0.5);
    outline-offset: 2px;
}

.file-name {
    font-size: 0.875rem;
    color: var(--text-light);
    font-style: italic;
    flex: 1;
    min-width: 150px;
    padding: 0.5rem 0;
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
    box-shadow: var(--shadow-medium);
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

/* Empty State */
.empty-state {
    text-align: center;
    padding: 3rem 2rem;
    color: var(--text-light);
}

.empty-state-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    color: var(--text-light);
}

.empty-state-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: var(--text-secondary);
}

.empty-state-description {
    font-size: 1rem;
    margin: 0;
}

/* Chapters List */
.chapters-list {
    margin-bottom: 2rem;
}

.chapter-item {
    background: var(--surface-light);
    border: 1px solid var(--border-light);
    border-radius: 16px;
    margin-bottom: 1rem;
    overflow: hidden;
    transition: all var(--animation-speed) var(--animation-curve);
}

.chapter-item:hover {
    box-shadow: var(--shadow-medium);
    transform: translateY(-2px);
}

.chapter-header {
    padding: 1.5rem 2rem;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: var(--surface-white);
    border-bottom: 1px solid var(--border-light);
}

.chapter-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.chapter-number {
    width: 40px;
    height: 40px;
    background: var(--primary-gradient);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1rem;
}

.chapter-title-wrapper {
    flex: 1;
}

.chapter-title {
    margin: 0 0 0.25rem 0;
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
}

.chapter-subtitle {
    margin: 0;
    font-size: 0.875rem;
    color: var(--text-light);
}

.chapter-actions {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-icon {
    width: 40px;
    height: 40px;
    border: none;
    border-radius: 50%;
    background: var(--surface-light);
    color: var(--text-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
}

.btn-icon:hover {
    background: var(--primary-color);
    color: white;
    transform: scale(1.1);
}

.btn-edit-chapter i {
    transition: transform var(--animation-speed) var(--animation-curve);
}

/* Chapter Details */
.chapter-details {
    padding: 2rem;
    background: var(--surface-white);
}

.chapter-form {
    margin-bottom: 2rem;
}

.form-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
    flex-wrap: wrap;
}

.btn-action {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    text-decoration: none;
    box-shadow: var(--shadow-subtle);
    position: relative;
    overflow: hidden;
}

.btn-action::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.btn-action:hover::before {
    left: 100%;
}

.btn-save {
    background: var(--accent-color);
    color: white;
}

.btn-save:hover {
    background: #059669;
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

.btn-delete {
    background: #ef4444;
    color: white;
}

.btn-delete:hover {
    background: #dc2626;
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

.btn-cancel {
    background: var(--surface-gray);
    color: var(--text-secondary);
}

.btn-cancel:hover {
    background: #e2e8f0;
    transform: translateY(-2px);
    box-shadow: var(--shadow-subtle);
}

.inline-form {
    display: inline-block;
    margin: 0;
}

/* Materials Section */
.materials-section {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border-light);
}

.section-subtitle {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.materials-grid {
    display: grid;
    gap: 1rem;
    margin-bottom: 1rem;
}

.material-item {
    background: var(--surface-light);
    border: 1px solid var(--border-light);
    border-radius: 12px;
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: all var(--animation-speed) var(--animation-curve);
}

.material-item:hover {
    box-shadow: var(--shadow-subtle);
    transform: translateY(-1px);
}

.material-icon {
    width: 40px;
    height: 40px;
    background: #dc2626;
    color: white;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.125rem;
}

.material-info {
    flex: 1;
}

.material-title {
    margin: 0 0 0.25rem 0;
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
}

.material-type {
    margin: 0;
    font-size: 0.875rem;
    color: var(--text-light);
}

.material-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-view {
    background: var(--primary-color);
    color: white;
}

.btn-view:hover {
    background: var(--primary-dark);
}

.btn-delete-material {
    background: #ef4444;
    color: white;
}

.btn-delete-material:hover {
    background: #dc2626;
}

.empty-materials {
    text-align: center;
    padding: 2rem;
    color: var(--text-light);
}

.empty-materials i {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    display: block;
}

/* Add Material Form */
.add-material-form {
    margin-top: 1rem;
}

.btn-add-material {
    background: var(--accent-color);
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
    box-shadow: var(--shadow-subtle);
    position: relative;
    overflow: hidden;
}

.btn-add-material::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.btn-add-material:hover::before {
    left: 100%;
}

.btn-add-material:hover {
    background: #059669;
    transform: translateY(-2px);
    box-shadow: var(--shadow-medium);
}

.material-form {
    margin-top: 1rem;
    padding: 1.5rem;
    background: var(--surface-light);
    border-radius: 12px;
}

/* Add Chapter Section */
.add-chapter-section {
    text-align: center;
    margin: 2rem 0;
}

.btn-add-chapter {
    background: var(--primary-gradient);
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1rem;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    box-shadow: var(--shadow-medium);
    position: relative;
    overflow: hidden;
}

.btn-add-chapter::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.btn-add-chapter:hover::before {
    left: 100%;
}

.btn-add-chapter:hover {
    transform: translateY(-3px);
    box-shadow: var(--shadow-large);
}

.add-chapter-form {
    background: var(--surface-white);
    border: 1px solid var(--border-light);
    border-radius: 16px;
    padding: 2rem;
    margin-top: 1rem;
}

/* Content Sections */
.content-section {
    margin-bottom: 3rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid var(--border-light);
}

.content-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.content-section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.related-items-grid {
    display: grid;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.related-item {
    background: var(--surface-light);
    border: 1px solid var(--border-light);
    border-radius: 12px;
    padding: 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: all var(--animation-speed) var(--animation-curve);
}

.related-item:hover {
    box-shadow: var(--shadow-subtle);
    transform: translateY(-1px);
}

.related-item-icon {
    width: 48px;
    height: 48px;
    background: var(--primary-gradient);
    color: white;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.related-item-content {
    flex: 1;
}

.related-item-title {
    margin: 0 0 0.25rem 0;
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--text-primary);
}

.related-item-meta {
    margin: 0;
    font-size: 0.875rem;
    color: var(--text-light);
}

.related-item-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-edit-related {
    background: #f59e0b;
    color: white;
}

.btn-edit-related:hover {
    background: #d97706;
}

.btn-delete-related {
    background: #ef4444;
    color: white;
}

.btn-delete-related:hover {
    background: #dc2626;
}

.empty-content {
    text-align: center;
    padding: 2rem;
    color: var(--text-light);
}

.empty-content i {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    display: block;
}

.btn-create-content {
    background: var(--primary-gradient);
    color: white;
    padding: 1rem 2rem;
    border: none;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1rem;
    text-decoration: none;
    cursor: pointer;
    transition: all var(--animation-speed) var(--animation-curve);
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    box-shadow: var(--shadow-medium);
    position: relative;
    overflow: hidden;
}

.btn-create-content::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.btn-create-content:hover::before {
    left: 100%;
}

.btn-create-content:hover {
    transform: translateY(-2px);
    color: white;
    box-shadow: var(--shadow-large);
}

/* Tutorials */
.tutorials-list {
    margin-bottom: 1.5rem;
}

.tutorial-item {
    background: var(--surface-light);
    border: 1px solid var(--border-light);
    border-radius: 12px;
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 0.5rem;
    transition: all var(--animation-speed) var(--animation-curve);
}

.tutorial-item:hover {
    box-shadow: var(--shadow-subtle);
    transform: translateY(-1px);
}

.tutorial-icon {
    width: 40px;
    height: 40px;
    background: var(--primary-color);
    color: white;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.tutorial-content {
    flex: 1;
}

.tutorial-link {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    word-break: break-all;
}

.tutorial-link:hover {
    text-decoration: underline;
}

.tutorial-actions {
    display: flex;
    gap: 0.5rem;
}

.tutorial-form {
    background: var(--surface-light);
    border-radius: 12px;
    padding: 1.5rem;
    margin-top: 1rem;
}

/* Animations */
@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideUp {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(-20px);
    }
}

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

/* Responsive Design */
@media (max-width: 1024px) {
    .row {
        grid-template-columns: 1fr;
    }
    
    .header-container {
        flex-direction: column;
        text-align: center;
    }
    
    .file-input-wrapper {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .file-input-button {
        width: 100%;
        justify-content: center;
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

    .chapter-header {
        padding: 1rem;
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .chapter-info {
        width: 100%;
    }

    .form-actions {
        flex-direction: column;
        align-items: flex-start;
    }

    .btn-action {
        width: 100%;
        justify-content: center;
    }

    .related-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }

    .related-item-actions {
        width: 100%;
        justify-content: center;
    }
    
    .file-input-wrapper {
        flex-direction: column;
        align-items: stretch;
    }
    
    .file-input-button {
        width: 100%;
        justify-content: center;
    }
    
    .file-name {
        text-align: center;
        min-width: auto;
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

    .chapter-details {
        padding: 1rem;
    }

    .materials-section {
        padding-top: 1rem;
    }
    
    .file-input-button {
        padding: 0.875rem 1.25rem;
        font-size: 0.8rem;
    }
}

/* Focus States for Accessibility */
.btn-submit:focus,
.form-control:focus,
input:focus,
select:focus,
textarea:focus,
.btn-action:focus,
.btn-icon:focus,
.file-input-button:focus {
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

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: var(--surface-light);
}

::-webkit-scrollbar-thumb {
    background: var(--primary-color);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--primary-dark);
}

/* Print Styles */
@media print {
    .course-page {
        background: white;
    }
    
    .header-section,
    .btn-submit,
    .btn-action,
    .btn-icon,
    .file-input-button {
        display: none;
    }
    
    .content-wrapper {
        box-shadow: none;
        border-radius: 0;
    }
    
    .form-card {
        box-shadow: none;
        border: 1px solid #ccc;
        break-inside: avoid;
    }
}

/* High Contrast Mode Support */
@media (prefers-contrast: high) {
    :root {
        --border-light: rgba(0, 0, 0, 0.3);
        --text-light: #000;
        --text-secondary: #333;
    }
    
    .form-control,
    input[type="text"],
    input[type="url"],
    select,
    textarea {
        border-width: 2px;
        border-color: #000;
    }
    
    .btn-submit,
    .btn-action,
    .file-input-button {
        border: 2px solid #000;
    }
}

/* Reduced Motion Support */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
        scroll-behavior: auto !important;
    }
    
    .form-card {
        animation: none;
    }
}
</style>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection