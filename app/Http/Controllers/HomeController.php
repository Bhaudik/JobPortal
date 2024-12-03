<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        // Fetch the latest 6 jobs
        $latestJobs = Job::latest()->take(6)->get();

        // Fetch featured jobs where isFeatured = 1, limit 8
        $featuredJobs = Job::where('isFeatured', 1)
            ->with('jobType')
            ->take(8)->get();
        // dd($featuredJobs);

        // Fetch all categories as they are
        $categories = Category::orderBy('name', 'desc')->take(8)->get();

        // Pass the data to the view
        return view('front.home', compact('latestJobs', 'featuredJobs', 'categories'));
    }
}
