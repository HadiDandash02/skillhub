<?php

namespace App\Http\Controllers;

use App\Models\CareerAdvice;
use App\Models\Challenge;
use App\Models\Chapter;
use App\Models\Course;
use App\Models\CourseTutorial;
use App\Models\JobApplication;
use App\Models\JobListing;
use App\Models\Pdf;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash; 

class AdminController extends Controller
{
    // Display Admin Dashboard with Dynamic Data
    public function index()
    {
        // Basic counts
        $totalUsers = User::count();
        $totalCourses = Course::count();
        $totalJobs = JobListing::count();
        $totalChallenges = Challenge::count();
        $totalQuizzes = Quiz::count();
        $totalCareerAdvices = CareerAdvice::count(); 

        // ==============================================================================
        // Growth percentages (comparing current month to previous month)
        // ==============================================================================
        $currentMonth = now()->startOfMonth();
        $previousMonth = now()->subMonth()->startOfMonth();
        $previousMonthEnd = now()->subMonth()->endOfMonth();

        // Users growth
        $currentMonthUsers = User::where('created_at', '>=', $currentMonth)->count();
        $previousMonthUsers = User::whereBetween('created_at', [$previousMonth, $previousMonthEnd])->count();
        $usersGrowth = $previousMonthUsers > 0 ? round((($currentMonthUsers - $previousMonthUsers) / $previousMonthUsers) * 100) : 0;

        // Courses growth
        $currentMonthCourses = Course::where('created_at', '>=', $currentMonth)->count();
        $previousMonthCourses = Course::whereBetween('created_at', [$previousMonth, $previousMonthEnd])->count();
        $coursesGrowth = $previousMonthCourses > 0 ? round((($currentMonthCourses - $previousMonthCourses) / $previousMonthCourses) * 100) : 0;

        // Jobs growth
        $currentMonthJobs = JobListing::where('created_at', '>=', $currentMonth)->count();
        $previousMonthJobs = JobListing::whereBetween('created_at', [$previousMonth, $previousMonthEnd])->count();
        $jobsGrowth = $previousMonthJobs > 0 ? round((($currentMonthJobs - $previousMonthJobs) / $previousMonthJobs) * 100) : 0;

        // Career advice growth
        $currentMonthAdvice = CareerAdvice::where('created_at', '>=', $currentMonth)->count();
        $previousMonthAdvice = CareerAdvice::whereBetween('created_at', [$previousMonth, $previousMonthEnd])->count();
        $adviceGrowth = $previousMonthAdvice > 0 ? round((($currentMonthAdvice - $previousMonthAdvice) / $previousMonthAdvice) * 100) : 0;

        // ==============================================================================
        // Monthly data for main chart (last 12 months)
        // ==============================================================================
        $monthlyData = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $monthStart = $month->startOfMonth()->copy();
            $monthEnd = $month->endOfMonth()->copy();
            
            $monthlyData[] = [
                'month' => $month->format('M'),
                'users' => User::whereBetween('created_at', [$monthStart, $monthEnd])->count(),
                'courses' => Course::whereBetween('created_at', [$monthStart, $monthEnd])->count(),
                'jobs' => JobListing::whereBetween('created_at', [$monthStart, $monthEnd])->count(),
                'advice' => CareerAdvice::whereBetween('created_at', [$monthStart, $monthEnd])->count(),
            ];
        }

        // ==============================================================================
        // Mini chart data (last 12 months aggregated for sparklines)
        // ==============================================================================
        $miniChartData = [
            'users' => array_column($monthlyData, 'users'),
            'courses' => array_column($monthlyData, 'courses'),
            'jobs' => array_column($monthlyData, 'jobs'),
            'advice' => array_column($monthlyData, 'advice'),
        ];

        // ==============================================================================
        // Recent activities (last 10 activities)
        // ==============================================================================
        $recentActivities = [];
        
        // Get recent users
        $recentUsers = User::latest()->take(3)->get(['created_at', 'name']);
        foreach ($recentUsers as $user) {
            $recentActivities[] = [
                'type' => 'user',
                'title' => 'New User Registration',
                'description' => "User '{$user->name}' joined the platform",
                'time' => $user->created_at,
                'icon' => 'fas fa-user-plus',
                'class' => 'user-activity'
            ];
        }

        // Get recent courses
        $recentCourses = Course::latest()->take(3)->get(['created_at', 'title']);
        foreach ($recentCourses as $course) {
            $recentActivities[] = [
                'type' => 'course',
                'title' => 'Course Published',
                'description' => "'{$course->title}' course went live",
                'time' => $course->created_at,
                'icon' => 'fas fa-book',
                'class' => 'course-activity'
            ];
        }

        // Get recent jobs
        $recentJobs = JobListing::latest()->take(3)->get(['created_at', 'title']);
        foreach ($recentJobs as $job) {
            $recentActivities[] = [
                'type' => 'job',
                'title' => 'Job Listing Added',
                'description' => "'{$job->title}' position posted",
                'time' => $job->created_at,
                'icon' => 'fas fa-briefcase',
                'class' => 'job-activity'
            ];

        }

        // Get recent career advice (ADD THIS SECTION)
            $recentCareerAdvice = CareerAdvice::latest()->take(3)->get(['created_at', 'title']);
            foreach ($recentCareerAdvice as $advice) {
                $recentActivities[] = [
                    'type' => 'advice',
                    'title' => 'Career Advice Published',
                    'description' => "'{$advice->title}' article was added",
                    'time' => $advice->created_at,
                    'icon' => 'fas fa-lightbulb',
                    'class' => 'advice-activity'
                ];
            }

        // Sort activities by time (most recent first) and take top 10
        $recentActivities = collect($recentActivities)
            ->sortByDesc('time')
            ->take(10)
            ->values()
            ->all();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalCourses', 
            'totalJobs',
            'totalChallenges',
            'totalQuizzes',
            'totalCareerAdvices',
            'usersGrowth',
            'coursesGrowth',
            'jobsGrowth',
            'adviceGrowth',
            'monthlyData',
            'miniChartData',
            'recentActivities'
        ));
    }

    // Display All Users
    public function manageUsers(Request $request)
    
    {
        $users = User::query(); // Get all users

      

    // Filter users by role
    if ($request->has('role') && $request->role != 'all') {
        $users->where('role', $request->role);
    }

    // Paginate results
    $users = $users->get();

        return view('admin.users', compact('users'));
    }

       public function createUser()
    {
        return view('admin.create-user');
    }

     public function storeUser(Request $request)
    {
         $validationRules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:user,admin,instructor,careerM',
    ];

        // Add company_name validation only if role is careerM
        if ($request->role === 'careerM') {
            $validationRules['company_name'] = 'required|string|max:255';
        }


        $request->validate($validationRules);

        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ];

        // Add company_name if role is careerM
        if ($request->role === 'careerM') {
            $userData['company_name'] = $request->company_name;
        }

        User::create($userData);

        return redirect()->route('admin.users')->with('success', 'User created successfully!');
    }

    // Show Edit User Form
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-users', compact('user'));
    }

    // Update User Information
    public function updateUser(Request $request, $id)
{
     $validationRules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $id,
        'role' => 'required|in:user,admin,hr,instructor,careerM',
    ];

    // Add company_name validation only if role is careerM
        if ($request->role === 'careerM') {
            $validationRules['company_name'] = 'required|string|max:255';
        }

    $request->validate($validationRules);

        $user = User::findOrFail($id);
        
        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        // Add or remove company_name based on role
        if ($request->role === 'careerM') {
            $updateData['company_name'] = $request->company_name;
        } else {
            // If role is not careerM, clear the company_name
            $updateData['company_name'] = null;
        }

        $user->update($updateData);

    return redirect()->route('admin.users')->with('success', 'User updated successfully.');
}

    // Delete User
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }


     // 📌 Manage Courses
     public function manageCourses()
{
    // Get all courses without pagination
    $courses = Course::get();
    return view('admin.courses.index', compact('courses'));
}
 
     // 📌 Create a Course
     public function createCourse()
    {
        // Fetch all instructors for the dropdown
        $instructors = User::where('role', 'instructor')
                          ->orderBy('name')
                          ->get(['id', 'name', 'email']);
        
        return view('admin.courses.create', compact('instructors'));
    }
 
    public function storeCourse(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'instructor_id' => 'required|exists:users,id',
            'category' => 'required|string',
            'difficulty' => 'required|string',
        ]);

        // Get the instructor's name for the instructor field
        $instructor = User::findOrFail($validated['instructor_id']);
        
        // Create the course with instructor_id and instructor name
        $courseData = $validated;
        $courseData['instructor'] = $instructor->name;
        
        $course = Course::create($courseData);

        // Save Chapters and PDFs
        if ($request->chapters) {
            foreach ($request->chapters as $chapterData) {
                $chapter = $course->chapters()->create([
                    'title' => $chapterData['title'],
                    'description' => $chapterData['description'] ?? null
                ]);

                if (isset($chapterData['pdfs'])) {
                    foreach ($chapterData['pdfs'] as $pdfData) {
                        if ($pdfData['pdf_file']) {
                            $path = $pdfData['pdf_file']->store('pdfs', 'public');
                            
                            $chapter->pdfs()->create([
                                'title' => $pdfData['title'],
                                'pdf_path' => $path
                            ]);
                        }
                    }
                }
            }
        }

        // Save Tutorials
        if ($request->tutorials) {
            foreach ($request->tutorials as $tutorialData) {
                if ($tutorialData['link']) {
                    $course->tutorials()->create([
                        'link' => $tutorialData['link']
                    ]);
                }
            }
        }

        return redirect()->route('admin.courses')->with('success', 'Course created successfully and assigned to ' . $instructor->name . '!');
    }
 
     // 📌 Edit a Course
     // 📌 Edit a Course
public function editCourse($id)
{
    $course = Course::findOrFail($id);
    
    // Fetch all instructors for the dropdown
    $instructors = User::where('role', 'instructor')
                      ->orderBy('name')
                      ->get(['id', 'name', 'email']);
    
    $playlistId = $this->extractPlaylistId($course->link);
    
    return view('admin.courses.edit', compact('course', 'instructors', 'playlistId'));
}
 
    private function extractPlaylistId($url)
{
    parse_str(parse_url($url, PHP_URL_QUERY), $query);
    return $query['list'] ?? '';
}
    
   public function updateCourse(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required',
        'instructor_id' => 'required|exists:users,id',
        'category' => 'required|string',
        'difficulty' => 'required|string',
    ]);
    
    $course = Course::findOrFail($id);
    
    // Get the instructor's name for the instructor field
    $instructor = User::findOrFail($request->instructor_id);
    
    // Update the course with instructor_id and instructor name
    $course->update([
        'title' => $request->title,
        'description' => $request->description,
        'instructor_id' => $request->instructor_id,
        'instructor' => $instructor->name,
        'category' => $request->category,
        'difficulty' => $request->difficulty,
    ]);

    return redirect()->back()->with('success', 'Course updated successfully and assigned to ' . $instructor->name . '!');
}
 
     // 📌 Delete a Course
     public function deleteCourse($id)
     {
         Course::findOrFail($id)->delete();
         return redirect()->route('admin.courses')->with('success', 'Course deleted successfully!');
     }

     // Display all job listings
    public function manageJobs()
    {
        $jobs = JobListing::all();
        return view('admin.jobs.index', compact('jobs'));
    }

    // Show Add Job Form
    public function createJob()
    {
        return view('admin.jobs.create-job');
    }

// Store New Job
public function storeJob(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'company' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'description' => 'required|string',
        'requirements' => 'nullable|string',
        'responsibilities' => 'nullable|string',
        'benefits' => 'nullable|string',
        'salary_range' => 'nullable|string|max:255',
        'employment_type' => 'required|string|max:255',
        'experience_level' => 'nullable|string|max:255',
        'skills_required' => 'nullable|string',
        'deadline' => 'nullable|date',
        'remote_option' => 'boolean',
        'company_description' => 'nullable|string',
    ]);

    // Process skills - convert from comma-separated string to array
    $skills = [];
    if ($request->skills_required) {
        $skills = array_map('trim', explode(',', $request->skills_required));
    }

    JobListing::create([
        'title' => $request->title,
        'company' => $request->company,
        'location' => $request->location,
        'description' => $request->description,
        'requirements' => $request->requirements,
        'responsibilities' => $request->responsibilities,
        'benefits' => $request->benefits,
        'salary_range' => $request->salary_range,
        'employment_type' => $request->employment_type,
        'experience_level' => $request->experience_level,
        'skills_required' => $skills,
        'posted_date' => now(),
        'deadline' => $request->deadline,
        'remote_option' => $request->has('remote_option'),
        'company_description' => $request->company_description,
    ]);

    return redirect()->route('admin.jobs')->with('success', 'New job listing created successfully!');
}


    // Show Edit Job Form
    public function editJob($id)
    {
        $job = JobListing::findOrFail($id);
        return view('admin.jobs.edit-job', compact('job'));
    }

    // Update Job Listing
    public function updateJob(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'company' => 'required|string|max:255',
        'location' => 'required|string|max:255',
        'description' => 'required|string',
        'requirements' => 'nullable|string',
        'responsibilities' => 'nullable|string',
        'benefits' => 'nullable|string',
        'salary_range' => 'nullable|string|max:255',
        'employment_type' => 'required|string|max:255',
        'experience_level' => 'nullable|string|max:255',
        'skills_required' => 'nullable|string',
        'deadline' => 'nullable|date',
        'remote_option' => 'boolean',
        'company_description' => 'nullable|string',
    ]);

    $job = JobListing::findOrFail($id);

    // Process skills - convert from comma-separated string to array
    $skills = [];
    if ($request->skills_required) {
        $skills = array_map('trim', explode(',', $request->skills_required));
    }

    $job->update([
        'title' => $request->title,
        'company' => $request->company,
        'location' => $request->location,
        'description' => $request->description,
        'requirements' => $request->requirements,
        'responsibilities' => $request->responsibilities,
        'benefits' => $request->benefits,
        'salary_range' => $request->salary_range,
        'employment_type' => $request->employment_type,
        'experience_level' => $request->experience_level,
        'skills_required' => $skills,
        'deadline' => $request->deadline,
        'remote_option' => $request->has('remote_option'),
        'company_description' => $request->company_description,
    ]);

    return redirect()->route('admin.jobs')->with('success', 'Job listing updated successfully!');
}

    // Delete Job Listing
    public function deleteJob($id)
    {
        $job = JobListing::findOrFail($id);
        $job->delete();

        return redirect()->route('admin.jobs')->with('success', 'Job listing deleted successfully!');
    }

    // Manage Challenges
    public function manageChallenges()
{
    // Get all challenges without pagination
    $challenges = Challenge::get();
    return view('admin.challenges.index', compact('challenges'));
}

    public function createChallenge(Request $request)
     {
        $courseId = $request->query('course_id'); 
        $course = null;
        if ($courseId) {
            $course = Course::findOrFail($courseId);
        }
         return view('admin.challenges.create',compact('course'));
     }

    public function storeChallenge(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'instructions' => 'nullable|string',
            'code_placeholder' => 'nullable|string',
            'expected_output' => 'nullable|string',
        ]);

        Challenge::create($request->all());

        return  redirect("/admin/courses/$request->course_id/edit")->with('success', 'Challenge created successfully!');
    }

    public function editChallenge($id)
    {
        $challenge = Challenge::findOrFail($id);
        return view('admin.challenges.edit', compact('challenge'));
    }

    public function updateChallenge(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'instructions' => 'required|string',
            'code_placeholder' => 'required|string',
            'expected_output' => 'required|string',
        ]);


        $challenge = Challenge::findOrFail($id);
        $challenge->update($request->all());

        return redirect("/admin/courses/$request->course_id/edit");
    }

    public function deleteChallenge($id)
    {
        $challenge = Challenge::findOrFail($id);
        $courseId = $challenge->course_id; 
        $challenge->delete();

        return redirect("/admin/courses/$courseId/edit");
    }

    // Manage Quizzes

    public function manageQuizzes()
    {
        $quizzes = Quiz::all();
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function createQuiz(Request $request)
    {
        $courseId = $request->query('course_id'); // retrieve it from the query string

        $course = null;
        if ($courseId) {
            $course = Course::findOrFail($courseId);
        }

        return view('admin.quizzes.create', compact('course'));
    }

    public function storeQuiz(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_button_text' => 'nullable|string|max:255',
            'questions' => 'required|json',
            'answers' => 'required|json',
        ]);
    
        Quiz::create($request->all());
   $redirectSource = $request->input('redirect_source', 'edit');
    $courseId = $request->input('course_id');

    if ($redirectSource === 'create') {
        return redirect()->route('admin.courses.create')->with('success', 'Quiz created successfully!');
    }

    if ($courseId) {
        return redirect("/admin/courses/{$courseId}/edit")->with('success', 'Quiz created successfully!');
    }

    return redirect()->route('admin.quizzes.index')->with('success', 'Quiz created successfully!');
    }

    public function editQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('admin.quizzes.edit', compact('quiz'));
    }

    public function updateQuiz(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_button_text' => 'nullable|string|max:255',
            'questions' => 'required|json',
            'answers' => 'required|json',
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->update($request->all());

        return redirect("/admin/courses/$request->course_id/edit");
    }

    public function deleteQuiz($id)
    {
        $quiz = Quiz::findOrFail($id);
        $courseId = $quiz->course_id; 
        $quiz->delete();

        return redirect("/admin/courses/$courseId/edit");
    }
// 📌 Manage Career Advice
public function manageCareerAdvice()
{
    // Get all career advice without pagination
    $advices = CareerAdvice::get();
    return view('admin.advices.index', compact('advices'));
}

// 📌 Show Create Career Advice Form
public function createCareerAdvice()
{
    return view('admin.advices.create');
}

// 📌 Store New Career Advice
public function storeCareerAdvice(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'author' => 'nullable|string|max:255',
    ]);

    CareerAdvice::create($request->all());

    return redirect()->route('admin.career-advice')->with('success', 'Career advice created successfully!');
}

// 📌 Show Edit Career Advice Form
public function editCareerAdvice($id)
{
    $advice = CareerAdvice::findOrFail($id);
    return view('admin.advices.edit', compact('advice'));
}

// 📌 Update Career Advice
public function updateCareerAdvice(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'author' => 'nullable|string|max:255',
    ]);

    $advice = CareerAdvice::findOrFail($id);
    $advice->update($request->all());

    return redirect()->route('admin.career-advice')->with('success', 'Career advice updated successfully!');
}

// 📌 Delete Career Advice
public function deleteCareerAdvice($id)
{
    $advice = CareerAdvice::findOrFail($id);
    $advice->delete();

    return redirect()->route('admin.career-advice')->with('success', 'Career advice deleted successfully!');
}


public function deleteTutorial($id)
{
    $tutorial = CourseTutorial::findOrFail($id);
    $tutorial->delete();

    return redirect()->back()->with('success', 'Tutorial removed successfully.');
}


public function addTutorial($courseId, Request $request)
{
    $request->validate([
        'tutorial_link' => 'required|url|max:255',
    ]);

    CourseTutorial::create([
    'course_id' => $courseId,
    'link' => $request->tutorial_link,
]);


    return redirect()->back()->with('success', 'Tutorial added.');
}


public function storeChapter(Request $request)
{
    $request->validate([
        'course_id' => 'required|exists:courses,id',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'pdf_file' => 'nullable|file|mimes:pdf|max:20480', // max 20MB
    ]);

    // Create the chapter first
    $chapter = Chapter::create([
        'course_id' => $request->course_id,
        'title' => $request->title,
        'description' => $request->description,
    ]);

    // Handle the PDF upload
    if ($request->hasFile('pdf_file')) {
        $file = $request->file('pdf_file');
        $filename = time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs('pdfs', $filename, 'public');

        // Save PDF record linked to chapter
        Pdf::create([
            'chapter_id' => $chapter->id,  // ✅ Correct ID from created chapter
            'title' => $request->title,
            'pdf_path' => $filename, // Just the filename
        ]);
    }

    return redirect()->back()->with('success', 'Chapter added successfully!');
}


    public function updateChapter(Request $request, Chapter $chapter)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $chapter->update($request->only(['title', 'description']));

        return redirect()->back()->with('success', 'Chapter updated successfully!');
    }

    public function destroyChapter(Chapter $chapter)
    {
        $chapter->delete();
        return redirect()->back()->with('success', 'Chapter deleted successfully!');
    }



    public function storePdf(Request $request)
    {
        $request->validate([
            'chapter_id' => 'required|exists:chapters,id',
            'title' => 'required|string|max:255',
            'pdf_file' => 'required|file|mimes:pdf|max:2048', // 2MB max
        ]);

        // Store in storage/app/public/pdfs
        $file = $request->file('pdf_file');
        $filename = time().'_'.$file->getClientOriginalName();
        $path = $file->storeAs('pdfs', $filename, 'public');

        Pdf::create([
            'chapter_id' => $request->chapter_id,
            'title' => $request->title,
            'pdf_path' => $filename, // Store just the filename
        ]);

        return back()->with('success', 'PDF uploaded successfully!');
    }

    public function destroyPdf(Pdf $pdf)
    {
         // Delete from storage/app/public/pdfs
        Storage::disk('public')->delete('pdfs/'.$pdf->pdf_path);
        $pdf->delete();
        
        return back()->with('success', 'PDF deleted successfully!');
    }

    public function showPdf(Pdf $pdf)
    {
        $path = storage_path('app/public/pdfs/'.$pdf->pdf_path);
        return response()->file($path);
    }

    public function createAll(Request $request){
        // 3 inserts
        // create course


        // create quiz
        // $course->id
    }

     public function jobApplications()
    {
        $applications = JobApplication::with(['jobListing', 'user'])->latest()->get();
        return view('admin.applications', compact('applications'));
    }

    // HR updates the status of a job application
    public function updateStatus(Request $request, JobApplication $application)
    {
        $request->validate([
            'status' => 'required|in:Applied,Pending,Accepted,Rejected',
        ]);

        $application->status = $request->status;
        $application->save();

        return redirect()->route('admin.applications')->with('success', 'Application status updated!');
    }

}