@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">My Jobs</li>
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
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fs-4 mb-1">My Jobs</h3>
                                </div>
                                <div style="margin-top: -10px;">
                                    <a href="{{ route('create.job') }}" class="btn btn-primary">Post a Job</a>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">Title</th>
                                            <th scope="col">Job Created</th>
                                            <th scope="col">Applicants</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="border-0">
                                        @forelse ($jobs as $job)
                                            <tr>
                                                <td>
                                                    <div class="job-name fw-500">{{ $job->title }}</div>
                                                    <div class="info1">{{ $job->job_type }} . {{ $job->location }}</div>
                                                </td>
                                                <td>{{ $job->created_at->format('d, M, Y') }}</td>
                                                <td>{{ $job->applicants_count }} Applicants</td>
                                                <td>
                                                    <div class="job-status text-capitalize">
                                                        {{ $job->status == 1 ? 'Active' : 'Deactive' }}
                                                    </div>
                                                </td>
                                                {{-- <td>
                                                    <div class="d-flex">
                                                        <!-- View Button -->
                                                        <a href="{{ route('job.detail', $job->id) }}"
                                                            class="btn btn-primary btn-sm me-2">
                                                            <i class="fa fa-eye"></i> View
                                                        </a>

                                                        <!-- Edit Button -->
                                                        <a href="{{ route('edit.job', $job->id) }}"
                                                            class="btn btn-warning btn-sm me-2">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>

                                                        <!-- Delete Button -->
                                                        <form action="{{ route('delete.job', $job->id) }}" method="POST"
                                                            onsubmit="return confirm('Are you sure?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fa fa-trash"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td> --}}
                                                <td>
                                                    <div class="action-dots float-end">
                                                        <a href="#" class="" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('job.detail', $job->id) }}">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i> View
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('edit.job', $job->id) }}">
                                                                    <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('delete.job', $job->id) }}"
                                                                    onclick="return confirm('Are you sure?')">
                                                                    <i class="fa fa-trash" aria-hidden="true"></i> Remove
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No jobs found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3 custom-pagination">
                                {{ $jobs->links('pagination::bootstrap-5') }}
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
        $(document).ready(function() {
            $('#saveJob').click(function(e) {
                e.preventDefault();

                // Clear previous error messages
                $(".error").remove();

                // Collect form data
                let formData = $('#jobForm').serialize();

                // Submit form via AJAX
                $.ajax({
                    url: '/store-job',
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.status) {
                            alert('Job created successfully!');
                            $('#jobForm')[0].reset(); // Reset the form
                        } else {
                            // Display validation errors
                            $.each(response.errors, function(key, value) {
                                $('#' + key).after('<span class="error text-danger">' +
                                    value[0] + '</span>');
                            });
                        }
                    },
                    error: function() {
                        alert('An error occurred while saving the job.');
                    }
                });
            });
        });
    </script>
@endsection
