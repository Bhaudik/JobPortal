<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\job;
use App\Models\jobs;
use App\Models\JobType;
use App\Models\saved_jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function profile()
    {



        return view('front.Account.profile');
    }
    public function createJob()
    {
        $categorys = Category::where('status', 1)->get();
        $jobtype = JobType::where('status', 1)->get();

        return view('front.Account.jobs.createJob', compact('categorys', 'jobtype'));
    }


    public function storeJob(Request $request)
    {
        // Validation


        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'category' => 'required|integer', // Updated to use category_id for foreign key
            'jobtype' => 'required|integer', // Updated to use job_type_id for foreign key
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
            'experience' => 'nullable|integer|min:0',
        ]);

        // If validation fails, return errors
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

        // Save the job data
        try {
            $job = new job();
            $job->title = $request->title;
            $job->category_id = $request->category;
            $job->job_type_id = $request->jobtype;
            $job->user_id = Auth::id();
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
            $job->company_website = $request->website; // Fixed naming to match table
            $job->save();

            session()->flash('success', 'Job created successfully!');

            return response()->json([
                'status' => true,
                'message' => '',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while saving the job.',
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function showMyJob()
    {
        $jobs = Job::where('user_id', Auth::id())->get();
        return view('front.Account.jobs.showMyJob', compact('jobs'));
    }

    public function editJob($id)
    {
        // Retrieve the job by ID
        $job = Job::findOrFail($id);

        if ($job == null) {
            abort(404);
        }
        if ($job->user_id !== Auth::id()) {
            return redirect()->route('my-jobs')->with('error', 'You are not authorized to edit this job.');
        }
        $categories = Category::all();
        $jobTypes = JobType::all();
        return view('front.Account.jobs.editJob', compact('job', 'categories', 'jobTypes'));
    }

    public function updateJOb(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        // Check if the job belongs to the authenticated user
        if ($job->user_id !== Auth::id()) {
            return redirect()->route('show.job')->with('error', 'You are not authorized to update this job.');
        }

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
                'redirect_url' => route('show.job'),  // URL to redirect to
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while updating the job.',
                'error' => $e->getMessage(),
            ]);
        }
        // return redirect()->route('show.job')->with('success', 'Job updated successfully!');
    }



    public function destroyJob($id)
    {
        // Find the job by ID
        $job = Job::findOrFail($id);

        if ($job->user_id !== Auth::id()) {
            return redirect()->route('show.job')->with('error', 'You are not authorized to delete this job.');
        }
        $job->delete();
        return redirect()->route('show.job')->with('success', 'Job deleted successfully!');
    }

    public function showJob($id)
    {
        // Fetch the job by ID
        $job = Job::findOrFail($id);  // This will return the job or throw a 404 if not found

        $existingSave = saved_jobs::where('job_id', $id)
            ->where('user_id', Auth::id())
            ->count();

        // Pass the job data to the view
        return view('front.Account.jobs.JobDetialPage', compact('job', 'existingSave'));
    }
}
