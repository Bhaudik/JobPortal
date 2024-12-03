<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;

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
            $query->where('experience', $request->experience);
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
}
