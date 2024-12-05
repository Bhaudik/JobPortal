<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class jobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobs = Job::orderBy('created_at', 'DESC')
            ->with('user', 'applicants')
            ->paginate(5);

        return view('admin.jobs.jobList', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Retrieve the job by ID
        $job = Job::findOrFail($id);

        if ($job == null) {
            abort(404);
        }

        $categories = Category::all();
        $jobTypes = JobType::all();
        return view('admin.jobs.editJob', compact('job', 'categories', 'jobTypes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $job = Job::findOrFail($id);

        // Check if the job belongs to the authenticated use       

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'category' => 'required|integer',
            'jobtype' => 'required|integer',
            'vacancy' => 'required|integer|min:1',
            'description' => 'required',
            'location' => 'required|string|max:255',
            'keywords' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'company_location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'salary' => 'nullable|string|max:255',
            'benefits' => 'nullable|string',
            'responsibility' => 'nullable|string',
            'qualifications' => 'nullable|string',
            'experience' => 'required|integer|min:0',
        ]);

        // If validation fails, return errors
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        // Find the job by ID for updating
        try {
            // Fetch the job from the database
            $job = Job::findOrFail($id);

            // Update the job data
            $job->title = $request->title;
            $job->category_id = $request->category;
            $job->job_type_id = $request->jobtype;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->benefits = $request->benefits;
            $job->responsibility = $request->responsibility;
            $job->qualifications = $request->qualifications;
            $job->keywords = $request->keywords;
            $job->experience = $request->experience;
            $job->company_name = $request->company_name;
            $job->company_location = $request->company_location;
            $job->company_website = $request->website;
            $job->isFeatured = $request->isFeatured;
            $job->status = $request->status;

            $job->save();

            // Flash success message
            session()->flash('success', 'Job updated successfully!');
            return response()->json([
                'status' => true,
                'message' => 'Job updated successfully!',
                'redirect_url' => route('admin.jobs.index'),  // URL to redirect to
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while updating the job.',
                'error' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $job = Job::findOrFail($id);

        if ($job->user_id !== Auth::id()) {
            return redirect()->route('show.job')->with('error', 'You are not authorized to delete this job.');
        }
        $job->delete();
        return redirect()->route('show.job')->with('success', 'Job deleted successfully!');
  
    }
}
