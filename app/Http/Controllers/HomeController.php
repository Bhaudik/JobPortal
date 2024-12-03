<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        // Fetch the latest jobs, you can modify the query as per your requirements
        $latestJobs = Job::latest()->take(6)->get(); // This fetches the latest 6 jobs

        // Pass the jobs to the view
        return view('front.home', compact('latestJobs'));
    }

}
