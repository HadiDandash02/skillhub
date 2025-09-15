<?php

use App\Http\Controllers\CareerManagerController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\JobApplicationController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\JobListingController;
use App\Http\Controllers\LmsController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\CareerAdviceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\GeminiController;
// General routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/api/chatbot', [GeminiController::class, 'chat']);
// Authentication routes
Auth::routes();
Route::post('/logout', function () {
    Auth::logout();
    Session::flush();
    return redirect('/'); // Redirect after logout
})->name('logout');

// Guest-accessible routes
Route::get('/career-advice/{id}', [CareerAdviceController::class, 'show'])->name('careerAdvice.show');
Route::get('/lms', [LmsController::class, 'index'])->name('lms');
Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/careerservices', [JobListingController::class, 'index'])->name('careerservices');
Route::post('/lms/handle', [LmsController::class, 'handleLearningPath'])->name('lms.handle');
// ADD THIS ROUTE TO YOUR WEB.PHP FILE
// Add this line in the guest-accessible routes section (around line 24)

Route::get('/jobs/{id}', [JobListingController::class, 'show'])->name('jobs.show');
// Authenticated users-only routes
Route::middleware(['auth'])->group(function () {
    Route::post('/challenge/{id}/submit', [ChallengeController::class, 'submit'])->name('challenge.submit');
    Route::post('/lms/{course}/rate', [RatingController::class, 'store'])->name('ratings.store');
    Route::get('/lms/{course}/rating-info', [RatingController::class, 'getRatingInfo'])->name('ratings.info');
    Route::post('/generate-resume', [ResumeController::class, 'generate'])->name('generateResume');
    Route::get('/resume-builder', function () {return view('resume.builder');})->name('resume.builder');
    Route::post('/quiz/{id}/submit', [QuizController::class, 'submit'])->name('quiz.submit');
    Route::get('/quiz/{id}', [QuizController::class, 'show'])->name('quiz.show');
    Route::get('/challenge/{id}', [ChallengeController::class, 'show'])->name('challenge.show');
    // Add this line in your authenticated routes section
Route::post('/challenge/{id}/submit', [ChallengeController::class, 'submit'])->name('challenge.submit');
    Route::post('/apply-job/{jobId}', [JobListingController::class, 'apply'])->name('applyJob');

    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Missing routes (now included)
    Route::middleware('auth')->get('/careerservices/login', [JobListingController::class, 'careerlogin'])->name('careerservicesauth');
    Route::post('/lms', [LmsController::class, 'handleLearningPaths'])->name('lms.handle');
    Route::middleware('auth')->get('/lms/login', [LmsController::class, 'lmslogin'])->name('lmsauth');


     Route::post('/get-recommendations', [ChatbotController::class, 'getRecommendations'])
        ->name('chatbot.recommendations');
        
    Route::get('/chatbot-options', [ChatbotController::class, 'getOptions'])
        ->name('chatbot.options');
        
    Route::post('/validate-interests', [ChatbotController::class, 'validateInterests'])
        ->name('chatbot.validate.interests');
        
    Route::post('/validate-skill-level', [ChatbotController::class, 'validateSkillLevel'])
        ->name('chatbot.validate.skill');
        
    Route::get('/popular-courses', [ChatbotController::class, 'getPopularCourses'])
        ->name('chatbot.popular');
        
    Route::get('/course-stats', [ChatbotController::class, 'getCourseStats'])
        ->name('chatbot.stats');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Manage Users
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.createUser');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.storeUser');
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.editUser');
    Route::patch('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
    Route::delete('/admin/users/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');

    // Manage Courses
    Route::get('/admin/courses', [AdminController::class, 'manageCourses'])->name('admin.courses');
    Route::get('/admin/courses/create', [AdminController::class, 'createCourse'])->name('admin.courses.create');
    Route::post('/admin/courses', [AdminController::class, 'storeCourse'])->name('admin.courses.store');
    Route::get('/admin/courses/{id}/edit', [AdminController::class, 'editCourse'])->name('admin.courses.edit');
    Route::patch('/admin/courses/{id}', [AdminController::class, 'updateCourse'])->name('admin.courses.update');
    Route::delete('/admin/courses/{id}', [AdminController::class, 'deleteCourse'])->name('admin.courses.delete');

    //Manage Job listings
    Route::get('/admin/job-listings', [AdminController::class, 'manageJobs'])->name('admin.jobs');
    Route::get('/admin/job-listings/create', [AdminController::class, 'createJob'])->name('admin.jobs.create'); // Add Job Form
    Route::post('/admin/job-listings', [AdminController::class, 'storeJob'])->name('admin.jobs.store'); // Store Job
    Route::get('/admin/job-listings/{id}/edit', [AdminController::class, 'editJob'])->name('admin.jobs.edit');
    Route::patch('/admin/job-listings/{id}', [AdminController::class, 'updateJob'])->name('admin.jobs.update');
    Route::delete('/admin/job-listings/{id}', [AdminController::class, 'deleteJob'])->name('admin.jobs.delete');

    // Manage Challenges
    Route::get('/admin/challenges', [AdminController::class, 'manageChallenges'])->name('admin.challenges');
    Route::get('/admin/challenges/create', [AdminController::class, 'createChallenge'])->name('admin.challenges.create');
    Route::post('/admin/challenges', [AdminController::class, 'storeChallenge'])->name('admin.challenges.store');
    Route::get('/admin/challenges/{id}/edit', [AdminController::class, 'editChallenge'])->name('admin.challenges.edit');
    Route::patch('/admin/challenges/{id}', [AdminController::class, 'updateChallenge'])->name('admin.challenges.update');
    Route::delete('/admin/challenges/{id}', [AdminController::class, 'deleteChallenge'])->name('admin.challenges.destroy');

    // Manage Quizzes
    Route::get('/admin/quizzes', [AdminController::class, 'manageQuizzes'])->name('admin.quizzes');
    Route::get('/admin/quizzes/create', [AdminController::class, 'createQuiz'])->name('admin.quizzes.create');
    Route::post('/admin/quizzes', [AdminController::class, 'storeQuiz'])->name('admin.quizzes.store');
    Route::get('/admin/quizzes/{id}/edit', [AdminController::class, 'editQuiz'])->name('admin.quizzes.edit');
    Route::patch('/admin/quizzes/{id}', [AdminController::class, 'updateQuiz'])->name('admin.quizzes.update');
    Route::delete('/admin/quizzes/{id}', [AdminController::class, 'deleteQuiz'])->name('admin.quizzes.destroy');

    // Manage Career Advice
    Route::get('/admin/career-advice', [AdminController::class, 'manageCareerAdvice'])->name('admin.career-advice');
    Route::get('/admin/career-advice/create', [AdminController::class, 'createCareerAdvice'])->name('admin.career-advice.create');
    Route::post('/admin/career-advice', [AdminController::class, 'storeCareerAdvice'])->name('admin.career-advice.store');
    Route::get('/admin/career-advice/{id}/edit', [AdminController::class, 'editCareerAdvice'])->name('admin.career-advice.edit');
    Route::patch('/admin/career-advice/{id}', [AdminController::class, 'updateCareerAdvice'])->name('admin.career-advice.update');
    Route::delete('/admin/career-advice/{id}', [AdminController::class, 'deleteCareerAdvice'])->name('admin.career-advice.destroy');

    Route::get('/admin/applications', [AdminController::class, 'jobApplications'])->name('admin.applications');
    Route::patch('/admin/applications/{application}', [AdminController::class, 'updateStatus'])->name('admin.applications.update');
    
    Route::post('/admin/courses/{id}/tutorial/add', [AdminController::class, 'addTutorial'])->name('admin.courses.tutorial.add');
    Route::delete('/admin/courses/tutorials/{id}', [AdminController::class, 'deleteTutorial'])->name('admin.courses.tutorials.destroy');


    // Chapters routes
    Route::prefix('admin/chapters')->group(function () {
        Route::post('/', [AdminController::class, 'storeChapter'])->name('admin.chapters.store');
        Route::patch('/{chapter}', [AdminController::class, 'updateChapter'])->name('admin.chapters.update');
        Route::delete('/{chapter}', [AdminController::class, 'destroyChapter'])->name('admin.chapters.destroy');
    });

    // PDFs routes
    Route::prefix('admin/pdfs')->group(function () {
        Route::post('/', [AdminController::class, 'storePdf'])->name('admin.pdfs.store');
        Route::delete('/{pdf}', [AdminController::class, 'destroyPdf'])->name('admin.pdfs.destroy');
    });
});


// Change from auth:sanctum to regular auth
Route::post('/get-recommendations', [ChatbotController::class, 'getRecommendations'])
    ->middleware('auth');
Route::get('/chatbot-options', [ChatbotController::class, 'getOptions'])->middleware('auth');
Route::post('/validate-interests', [ChatbotController::class, 'validateInterests'])
    ->middleware('auth');

Route::post('/validate-skill-level', [ChatbotController::class, 'validateSkillLevel'])
    ->middleware('auth');

    

Route::middleware(['auth', 'role:instructor'])->group(function () {
    Route::get('/instructor/dashboard', [InstructorController::class, 'manageCourses'])->name('instructor.dashboard');

    // Courses
    Route::get('/instructor/courses', [InstructorController::class, 'manageCourses'])->name('instructor.courses');
    Route::get('/instructor/courses/create', [InstructorController::class, 'createCourse'])->name('instructor.courses.create');
    Route::post('/instructor/courses', [InstructorController::class, 'storeCourse'])->name('instructor.courses.store');
    Route::get('/instructor/courses/{id}/edit', [InstructorController::class, 'editCourse'])->name('instructor.courses.edit');
    Route::patch('/instructor/courses/{id}', [InstructorController::class, 'updateCourse'])->name('instructor.courses.update');
    Route::delete('/instructor/courses/{id}', [InstructorController::class, 'deleteCourse'])->name('instructor.courses.delete');

    // Tutorials
    Route::post('/instructor/courses/{id}/tutorial/add', [InstructorController::class, 'addTutorial'])->name('instructor.courses.tutorial.add');
    Route::delete('/instructor/courses/tutorials/{id}', [InstructorController::class, 'deleteTutorial'])->name('instructor.courses.tutorials.destroy');

    // Chapters
    Route::prefix('instructor/chapters')->group(function () {
        Route::post('/', [InstructorController::class, 'storeChapter'])->name('instructor.chapters.store');
        Route::patch('/{chapter}', [InstructorController::class, 'updateChapter'])->name('instructor.chapters.update');
        Route::delete('/{chapter}', [InstructorController::class, 'destroyChapter'])->name('instructor.chapters.destroy');
    });

    // PDFs
    Route::prefix('instructor/pdfs')->group(function () {
        Route::post('/', [InstructorController::class, 'storePdf'])->name('instructor.pdfs.store');
        Route::delete('/{pdf}', [InstructorController::class, 'destroyPdf'])->name('instructor.pdfs.destroy');
    });

    // Challenges
    Route::get('/instructor/challenges/create', [InstructorController::class, 'createChallenge'])->name('instructor.challenges.create');
    Route::post('/instructor/challenges', [InstructorController::class, 'storeChallenge'])->name('instructor.challenges.store');
    Route::get('/instructor/challenges/{id}/edit', [InstructorController::class, 'editChallenge'])->name('instructor.challenges.edit');
    Route::patch('/instructor/challenges/{id}', [InstructorController::class, 'updateChallenge'])->name('instructor.challenges.update');
    Route::delete('/instructor/challenges/{id}', [InstructorController::class, 'deleteChallenge'])->name('instructor.challenges.destroy');
    Route::post('/instructor/challenges/{challenge}/preview', [InstructorController::class, 'previewTestCase'])
    ->name('instructor.challenges.preview');
    // Quizzes
    Route::get('/instructor/quizzes/create', [InstructorController::class, 'createQuiz'])->name('instructor.quizzes.create');
    Route::post('/instructor/quizzes', [InstructorController::class, 'storeQuiz'])->name('instructor.quizzes.store');
    Route::get('/instructor/quizzes/{id}/edit', [InstructorController::class, 'editQuiz'])->name('instructor.quizzes.edit');
    Route::patch('/instructor/quizzes/{id}', [InstructorController::class, 'updateQuiz'])->name('instructor.quizzes.update');
    Route::delete('/instructor/quizzes/{id}', [InstructorController::class, 'deleteQuiz'])->name('instructor.quizzes.destroy');
});

Route::middleware(['auth', 'role:careerM'])->group(function () {

    //Manage Job listings
    Route::get('/careerM/job-listings', [CareerManagerController::class, 'manageJobs'])->name('careerM.jobs');
    Route::get('/careerM/job-listings/create', [CareerManagerController::class, 'createJob'])->name('careerM.jobs.create'); // Add Job Form
    Route::post('/careerM/job-listings', [CareerManagerController::class, 'storeJob'])->name('careerM.jobs.store'); // Store Job
    Route::get('/careerM/job-listings/{id}/edit', [CareerManagerController::class, 'editJob'])->name('careerM.jobs.edit');
    Route::patch('/careerM/job-listings/{id}', [CareerManagerController::class, 'updateJob'])->name('careerM.jobs.update');
    Route::delete('/careerM/job-listings/{id}', [CareerManagerController::class, 'deleteJob'])->name('careerM.jobs.delete');

// Manage Career Advice
    Route::get('/careerM/career-advice', [CareerManagerController::class, 'manageCareerAdvice'])->name('careerM.career-advice');
    Route::get('/careerM/career-advice/create', [CareerManagerController::class, 'createCareerAdvice'])->name('careerM.career-advice.create');
    Route::post('/careerM/career-advice', [CareerManagerController::class, 'storeCareerAdvice'])->name('careerM.career-advice.store');
    Route::get('/careerM/career-advice/{id}/edit', [CareerManagerController::class, 'editCareerAdvice'])->name('careerM.career-advice.edit');
    Route::patch('/careerM/career-advice/{id}', [CareerManagerController::class, 'updateCareerAdvice'])->name('careerM.career-advice.update');
    Route::delete('/careerM/career-advice/{id}', [CareerManagerController::class, 'deleteCareerAdvice'])->name('careerM.career-advice.destroy');

    Route::get('/careerManager/applications', [JobApplicationController::class, 'index'])->name('careerM.applications');
    Route::patch('/careerManager/applications/{application}', [JobApplicationController::class, 'updateStatus'])->name('careerM.applications.update');
    
    // NEW: API route for detailed application view
    Route::get('/api/applications/{application}/details', [JobApplicationController::class, 'getApplicationDetails'])->name('careerM.applications.details');

});

Route::get('/chatbot', function () {
    return view('chatbot');
});


require __DIR__.'/auth.php';
