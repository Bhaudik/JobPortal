@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                            <li class="breadcrumb-item active">Application</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('admin.sidebar')
                </div>
                <div class="col-lg-9">
                    @include('front.message')
                    <div class="card border-0 shadow mb-4 p-3">
                        <div class="card-body card-form">
                            <h3 class="fs-4 mb-1">users</h3>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>User</th>
                                            <th>Employer</th>
                                            <th>Application Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($applications as $application)
                                            <tr>
                                                <td> {{ $application->job->title }} </td>
                                                <td>{{ $application->user->name }}</td>
                                                <td>{{ $application->employer->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($application->created_at)->format('d M, Y') }}
                                                </td>
                                                <td>
                                                    <div class="action-dots float-end">
                                                        <a href="#" class="" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        </a>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li><a class="dropdown-item delete-application" href="#"
                                                                    data-id="{{ $application->id }}"><i class="fa fa-trash"
                                                                        aria-hidden="true"></i>
                                                                    Remove</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No users found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-2 custom-pagination">
                                {{ $applications->links('pagination::bootstrap-5') }}
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
        $(document).on('click', '.delete-application', function(e) {
            e.preventDefault();
            alert(0);

            var applicationId = $(this).data('id');

            if (confirm('Are you sure you want to delete this job application?')) {
                $.ajax({
                    url: '{{ route('admin.application.destroy', ':id') }}'.replace(':id', applicationId),
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == true) {
                            // window.location.reload();
                            window.location.href = response.redirect_url;
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
