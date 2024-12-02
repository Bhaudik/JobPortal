@extends('front.layouts.app')

@section('main')
    <section class="section-4 bg-2">
        <div class="container pt-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="{{ route('show.job') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                                    &nbsp;Back to Jobs</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container job_details_area">
            <div class="row pb-5">
                <div class="col-md-8">
                    @include('front.message')
                    <div class="card shadow border-0">
                        <div class="job_details_header">
                            <div class="single_jobs white-bg d-flex justify-content-between">
                                <div class="jobs_left d-flex align-items-center">
                                    <div class="jobs_conetent">
                                        @if (!empty($job->title))
                                            <a href="#">
                                                <h4>{{ $job->title }}</h4>
                                            </a>
                                        @endif
                                        <div class="links_locat d-flex align-items-center">
                                            @if (!empty($job->location))
                                                <div class="location">
                                                    <p><i class="fa fa-map-marker"></i> {{ $job->location }}</p>
                                                </div>
                                            @endif
                                            @if (!empty($job->jobType->name))
                                                <div class="location">
                                                    <p><i class="fa fa-clock-o"></i> {{ $job->jobType->name }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="jobs_right">
                                    <div class="apply_now">
                                        <a class="heart_mark" href="#"><i class="fa fa-heart-o"
                                                aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="descript_wrap white-bg">
                            @if (!empty($job->description))
                                <div class="single_wrap">
                                    <h4>Job description</h4>
                                    <p>{{ $job->description }}</p>
                                </div>
                            @endif
                            @if (!empty($job->responsibility))
                                <div class="single_wrap">
                                    <h4>Responsibility</h4>
                                    <ul>
                                        <li>{{ $job->responsibility }}</li>
                                    </ul>
                                </div>
                            @endif
                            @if (!empty($job->qualifications))
                                <div class="single_wrap">
                                    <h4>Qualifications</h4>
                                    <ul>
                                        <li>{{ $job->qualifications }}</li>
                                    </ul>
                                </div>
                            @endif
                            @if (!empty($job->benefits))
                                <div class="single_wrap">
                                    <h4>Benefits</h4>
                                    <p>{{ $job->benefits }}</p>
                                </div>
                            @endif
                            <div class="border-bottom"></div>
                            <div class="pt-3 text-end">
                                <a href="#" class="btn btn-secondary">Save</a>
                                @if (Auth::check())
                                    <button onclick="ApplyJob({{ $job->id }})" class="btn btn-primary">Apply</button>
                                @else
                                    <a href="javascript:void()" class="btn btn-primary disabled">Login to Apply</a>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow border-0">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Job Summary</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    @if (!empty($job->created_at))
                                        <li>Published on: <span>{{ $job->created_at->format('d M, Y') }}</span></li>
                                    @endif
                                    @if (!empty($job->vacancy))
                                        <li>Vacancy: <span>{{ $job->vacancy }} Position</span></li>
                                    @endif
                                    @if (!empty($job->salary))
                                        <li>Salary: <span>{{ $job->salary }}</span></li>
                                    @endif
                                    @if (!empty($job->location))
                                        <li>Location: <span>{{ $job->location }}</span></li>
                                    @endif
                                    @if (!empty($job->jobType->name))
                                        <li>Job Nature: <span>{{ $job->jobType->name }}</span></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow border-0 my-4">
                        <div class="job_sumary">
                            <div class="summery_header pb-1 pt-4">
                                <h3>Company Details</h3>
                            </div>
                            <div class="job_content pt-3">
                                <ul>
                                    @if (!empty($job->company_name))
                                        <li>Name: <span>{{ $job->company_name }}</span></li>
                                    @endif
                                    @if (!empty($job->company_location))
                                        <li>Location: <span>{{ $job->company_location }}</span></li>
                                    @endif
                                    @if (!empty($job->company_website))
                                        <li>Website: <span><a
                                                    href="{{ $job->company_website }}">{{ $job->company_website }}</a></span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customjs')
    <script type="text/javascript">
        function ApplyJob(id) {
            if (confirm('Are you sute you wan to apply on this job')) {
                $.ajax({
                    type: "post",
                    url: "{{ route('job.apply') }}",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        }
    </script>
@endsection
