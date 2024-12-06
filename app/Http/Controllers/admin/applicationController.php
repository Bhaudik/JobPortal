<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\job_application;
use Illuminate\Http\Request;

class applicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = job_application::orderBy('created_at', 'DESC')
            ->with('job', 'employer', 'user')
            ->paginate(10);

        return view('admin.Application.ApplicationList', compact('applications'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $application = job_application::findOrFail($id);

        $application->delete();

        session()->flash('success', 'Job Application Deleted Succesfully');

        return response()->json([
            'status' => true,
            'message' => 'Job application Deletesuccesfully',
            'redirect_url' => route('admin.application.index'),
        ]);
    }
}
