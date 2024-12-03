<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\job;
use App\Models\jobs;
use App\Models\JobType;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
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
            $job->status = 1; // Default status, update as needed
            $job->save();

            return response()->json([
                'status' => true,
                'message' => 'Job created successfully!',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'An error occurred while saving the job.',
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function showMyJob(){
        
        
    }
}
