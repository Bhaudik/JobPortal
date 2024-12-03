@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Jobs Applied</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('front.Account.sidebar')
                </div>
                <div class="col-lg-9">
                    @include('front.message')
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="card-body card-form">
                            <h3 class="fs-4 mb-1">Jobs Applied</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Apply Date</th>
                                            <th scope="col">Applicants</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @foreach ($appliedJobs as $application)
                                            <tr id="job-{{ $application->id }}" class="{{ $application->job->status }}">
                                                <td>
                                                    <div class="job-name fw-500">{{ $application->job->title }}</div>
                                                    <div class="info1">{{ $application->job->jobType->name }} .
                                                        {{ $application->job->location }}</div>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($application->applied_date)->format('d M, Y') }}
                                                </td>
                                                <td>{{ $application->job->applicants_count }} Applications</td>
                                                <td>
                                                    <div class="job-status text-capitalize">
                                                        @if ($application->job->status == '1')
                                                            Active
                                                        @else
                                                            Inactive
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="action-dots float-end">
                                                        <a href="#" class="" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('job.detail', $application->job->id) }}"><i
                                                                        class="fa fa-eye" aria-hidden="true"></i> View</a>
                                                            </li>
                                                            <li><a class="dropdown-item delete-job" href="#"
                                                                    data-id="{{ $application->id }}"><i class="fa fa-trash"
                                                                        aria-hidden="true"></i> Remove</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customjs')
    <script>
        $(document).on('click', '.delete-job', function(e) {
            e.preventDefault();

            var jobId = $(this).data('id');

            if (confirm('Are you sure you want to delete this job application?')) {
                $.ajax({
                    url: '{{ route('applied.delete.job', ':id') }}'.replace(':id', jobId),
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == true) {
                            widows.location.reload();
                        } else {
                            alert('An error occurred. Please try again.');
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
            }
        });
    </script>
@endsection
