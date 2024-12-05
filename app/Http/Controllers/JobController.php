<?php

namespace App\Http\Controllers;

use App\Mail\JobNotificationEmail;
use App\Models\Category;
use App\Models\Job;
use App\Models\job_application;
use App\Models\JobType;
use App\Models\saved_jobs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class JobController extends Controller
{
    public function index(Request $request)
    {
        // Get all categories and job types for the filter
        $categories = Category::all();
        $jobTypes = JobType::all();

        // Apply filters if provided
        $query = Job::query();

        // Filter by keywords
        if ($request->has('keywords') && $request->keywords) {
            $query->orWhere('keywords', 'like', '%' . $request->keywords . '%');
        }

        // Filter by location
        if ($request->has('location') && $request->location) {
            $query->orWhere('location', 'like', '%' . $request->location . '%');
        }

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->orWhere('category_id', $request->category);
        }

        // Filter by job type
        if ($request->has('job_type') && count($request->job_type) > 0) {
            $query->whereIn('job_type_id', $request->job_type);
        }

        // Filter by experience
        if ($request->has('experience') && $request->experience) {
            $query->orWhere('experience', $request->experience);
        }




        // Get the jobs, you can paginate if needed
        $jobs = $query->get();


        // Return the view with the job listings and filters
        return view('front.Account.jobs', compact('jobs', 'categories', 'jobTypes'));
    }

    public function filterJobs(Request $request)
    {
        // Get filter parameters
        $keywords = $request->keywords;
        $location = $request->location;
        $category = $request->category;
        $jobType = $request->job_type;
        $experience = $request->experience;

        // Query jobs with filters
        $jobs = Job::query();

        if ($keywords) {
            $jobs = $jobs->where('keywords', 'LIKE', "%$keywords%");
        }
        if ($location) {
            $jobs = $jobs->where('location', 'LIKE', "%$location%");
        }
        if ($category) {
            $jobs = $jobs->where('category_id', $category);
        }
        if ($jobType) {
            $jobs = $jobs->where('job_type_id', $jobType);
        }
        if ($experience) {
            $jobs = $jobs->where('experience', '>=', $experience);
        }

        $jobs = $jobs->get();

        return response()->json([
            'jobs' => $jobs
        ]);
    }

    public function ApplyJob(Request $request)
    {
        // Retrieve job ID from request
        $id = $request->id;

        // Fetch the job details
        $job = Job::find($id);

        // Check if the job exists
        if ($job == null) {
            session()->flash('error', 'Job does not exist');
            return response([
                'status' => false,
                'message' => 'Job does not exist'
            ]);
        }

        // Prevent user from applying to their own job
        $empid = $job->user_id;
        if ($empid == Auth::id()) {
            session()->flash('error', 'You cannot apply to your own job');
            return response([
                'status' => false,
                'message' => 'You cannot apply to your own job'
            ]);
        }

        // Check if the user has already applied for this job
        $existingApplication = job_application::where('job_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingApplication) {
            session()->flash('error', 'You have already applied for this job');
            return response([
                'status' => false,
                'message' => 'You have already applied for this job'
            ]);
        }

        // Create a new job application
        $jobApplication = new job_application();
        $jobApplication->user_id = Auth::id(); // Applicant's ID
        $jobApplication->job_id = $id;        // Job ID
        $jobApplication->employer_id = $empid; // Employer's ID
        $jobApplication->applied_date = now(); // Set the current timestamp

        // Save the record to the database
        if ($jobApplication->save()) {

            $employer = User::where('id', $empid)->first();
            $mailData = [
                'employer' => $employer,
                'user' => Auth::user(),
                'job' => $job
            ];

            // Get the user's email from Auth::user()
            $userEmail = Auth::user()->email;

            // Send the email to the user's email address
            Mail::to($userEmail)->send(new JobNotificationEmail($mailData));

            session()->flash('success', 'Application submitted successfully');
            return response([
                'status' => true,
                'message' => 'Application submitted successfully'
            ]);
        }

        // Handle any errors during saving
        session()->flash('error', 'Failed to apply for the job');
        return response([
            'status' => false,
            'message' => 'Failed to apply for the job'
        ]);
    }


    // job applied

    public function myAppliedJob()
    {
        // Fetch jobs the user has applied for
        $jobs = job_application::with('job')
            ->where('user_id', Auth::id()) // Get only the jobs applied by the authenticated user
            ->paginate(10);

        return view('front.Account.jobs.appliedJob', compact('jobs'));
    }

    public function myAppliedDestroyJob($id)
    {
        // Find the application by ID
        $application = job_application::find($id);

        if ($application && $application->user_id == Auth::id()) {
            // Delete the application
            $application->delete();


            session()->flash('success', 'Job application removed successfully.');
            return response()->json([
                'status' => true,
                'message' => 'Job application removed successfully.',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Job application not found or unauthorized.',
        ]);
    }
    public function mySavedDestroyJob($id)
    {
        // Find the saved by ID
        $saved = saved_jobs::find($id);

        if ($saved && $saved->user_id == Auth::id()) {
            // Delete the saved
            $saved->delete();


            session()->flash('success', 'Job saved removed successfully.');
            return response()->json([
                'status' => true,
                'message' => 'Job saved removed successfully.',
                // 'redirect_url' => route('saved.job'),
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Job saved not found or unauthorized.',
        ]);
    }

    // save jobs

    public function SaveJob(Request $request)
    {
        // Retrieve job ID from request
        $id = $request->id;

        // Fetch the job details
        $job = Job::find($id);

        // Check if the job exists
        if ($job == null) {
            session()->flash('error', 'Job does not exist');
            return response([
                'status' => false,
                'message' => 'Job does not exist'
            ]);
        }

        // Prevent user from applying to their own job
        // $empid = $job->user_id;
        // if ($empid == Auth::id()) {
        //     session()->flash('error', 'You cannot Save to your own job');
        //     return response([
        //         'status' => false,
        //         'message' => 'You cannot save to your own job'
        //     ]);
        // }

        // Check if the user has already applied for this job
        $existingSave = saved_jobs::where('job_id', $id)
            ->where('user_id', Auth::id())
            ->count();

        if ($existingSave) {
            session()->flash('error', 'You have already saved for this job');
            return response([
                'status' => false,
                'message' => 'You have already saved for this job'
            ]);
        }

        // Create a new job application
        $jobApplication = new saved_jobs();
        $jobApplication->user_id = Auth::id(); // Applicant's ID
        $jobApplication->job_id = $id;        // Job ID

        // Save the record to the database
        if ($jobApplication->save()) {

            // $employer = User::where('id', $empid)->first();
            // $mailData = [
            //     'user' => Auth::user(),
            //     'job' => $job
            // ];

            // Get the user's email from Auth::user()
            // $userEmail = Auth::user()->email;

            // Send the email to the user's email address
            // Mail::to($userEmail)->send(new JobNotificationEmail($mailData));

            session()->flash('success', 'You have savec job successfully');
            return response([
                'status' => true,
                'message' => 'You have savec job successfully'
            ]);
        }

        // Handle any errors during saving
        session()->flash('error', 'Failed to save for the job');
        return response([
            'status' => false,
            'message' => 'Failed to save for the job'
        ]);
    }

    public function mySavedJob()
    {
        // Fetch jobs the user has applied for
        $savedJobs = saved_jobs::with('job')
            ->where('user_id', Auth::id()) // Get only the jobs applied by the authenticated user
            ->paginate(10);

        return view('front.Account.jobs.savedJob', compact('savedJobs'));
    }
}
