@extends('front.layouts.app')

@section('main')
    <section class="section-3 py-5 bg-2 ">
        <div class="container">
            <div class="row">
                <div class="col-6 col-md-10 ">
                    <h2>Find Jobs</h2>
                </div>
                <div class="col-6 col-md-2">
                    <div class="align-end">
                        <form method="GET" action="{{ route('jobs.index') }}">
                            <select name="sort" id="sort" class="form-control" onchange="this.form.submit()">
                                <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row pt-5">
                <div class="col-md-4 col-lg-3 sidebar mb-4">
                    <div class="card border-0 shadow p-4">
                        <form method="GET" action="{{ route('jobs.index') }}">

                            <!-- Keywords Filter -->
                            <div class="mb-4">
                                <h2>Keywords</h2>
                                <input type="text" name="keywords" value="{{ request('keywords') }}"
                                    placeholder="Keywords" class="form-control">
                            </div>

                            <!-- Location Filter -->
                            <div class="mb-4">
                                <h2>Location</h2>
                                <input type="text" name="location" value="{{ request('location') }}"
                                    placeholder="Location" class="form-control">
                            </div>

                            <!-- Category Filter -->
                            <div class="mb-4">
                                <h2>Category</h2>
                                <select name="category" id="category" class="form-control" onchange="this.form.submit()">
                                    <option value="">Select a Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Job Type Filter -->
                            <div class="mb-4">
                                <h2>Job Type</h2>
                                @foreach ($jobTypes as $jobType)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="job_type[]"
                                            value="{{ $jobType->id }}"
                                            {{ in_array($jobType->id, request('job_type', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $jobType->name }}</label>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Experience Filter -->
                            <div class="mb-4">
                                <h2>Experience</h2>
                                <select name="experience" id="experience" class="form-control"
                                    onchange="this.form.submit()">
                                    <option value="">Select Experience</option>
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }} Years"
                                            {{ request('experience') == "{$i} Years" ? 'selected' : '' }}>
                                            {{ $i }} Years</option>
                                    @endfor
                                    <option value="10+ Years" {{ request('experience') == '10+ Years' ? 'selected' : '' }}>
                                        10+ Years</option>
                                </select>
                            </div>

                            <!-- Submit Filter -->
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </form>
                    </div>
                </div>

                <div class="col-md-8 col-lg-9 ">
                    <div class="job_listing_area">
                        <div class="job_lists">
                            <div class="row">
                                @foreach ($jobs as $job)
                                    <div class="col-md-4">
                                        <div class="card border-0 p-3 shadow mb-4">
                                            <div class="card-body">
                                                <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->title }}</h3>
                                                <p>{{ $job->description }}</p>
                                                <div class="bg-light p-3 border">
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                        <span class="ps-1">{{ $job->location }}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                        <span class="ps-1">{{ $job->jobType->name }}</span>
                                                    </p>
                                                    <p class="mb-0">
                                                        <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                        <span class="ps-1">{{ $job->salary }}</span>
                                                    </p>

                                                    {{-- <p class="mb-1">
                                                        <span class="ps-1">Experience :{{ $job->experience }}</span>
                                                    </p>
                                                    <p class="mb-1">
                                                        <span class="ps-1">Category:{{ $job->category->name }}</span>
                                                    </p> --}}

                                                </div>

                                                <div class="d-grid mt-3">
                                                    <a href="{{ route('job.detail', $job->id) }}"
                                                        class="btn btn-primary btn-lg">Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@yield('fillter')
