@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Account Settings</li>
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
                    <div class="card border-0 shadow mb-4">
                        <form method="POST" name="jobForm" id="jobForm" action="{{ route('update.job', $job->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">Job Details</h3>
                                <!-- Job Details Fields -->


                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="title" class="mb-2">Title<span class="req">*</span></label>
                                        <input type="text" placeholder="Job Title" id="title" name="title"
                                            class="form-control" value="{{ $job->title }}">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="category" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select a Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $job->category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="jobtype" class="mb-2">Job Nature<span class="req">*</span></label>
                                        <select name="jobtype" id="jobtype" class="form-control">
                                            <option value="">Select a Job Type</option>
                                            @foreach ($jobTypes as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ $job->job_type_id == $type->id ? 'selected' : '' }}>
                                                    {{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="vacancy" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input type="number" min="1" placeholder="Vacancy" id="vacancy"
                                            name="vacancy" class="form-control" value="{{ $job->vacancy }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="salary" class="mb-2">Salary</label>
                                        <input type="text" placeholder="Salary" id="salary" name="salary"
                                            class="form-control" value="{{ $job->salary }}">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="location" class="mb-2">Location<span class="req">*</span></label>
                                        <input type="text" placeholder="Location" id="location" name="location"
                                            class="form-control" value="{{ $job->location }}">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="experience" class="mb-2">Experience</label>
                                    <select id="experience" name="experience" class="form-control">
                                        <option value="">Select Experience</option>
                                        <option value="1" {{ $job->experience == 1 ? 'selected' : '' }}>1 year
                                        </option>
                                        <option value="2" {{ $job->experience == 2 ? 'selected' : '' }}>2 years
                                        </option>
                                        <option value="3" {{ $job->experience == 3 ? 'selected' : '' }}>3 years
                                        </option>
                                        <option value="4" {{ $job->experience == 4 ? 'selected' : '' }}>4 years
                                        </option>
                                        <option value="5" {{ $job->experience == 5 ? 'selected' : '' }}>5 years
                                        </option>
                                        <option value="6" {{ $job->experience == 6 ? 'selected' : '' }}>6 years
                                        </option>
                                        <option value="7" {{ $job->experience == 7 ? 'selected' : '' }}>7 years
                                        </option>
                                        <option value="8" {{ $job->experience == 8 ? 'selected' : '' }}>8 years
                                        </option>
                                        <option value="9" {{ $job->experience == 9 ? 'selected' : '' }}>9 years
                                        </option>
                                        <option value="10" {{ $job->experience == 10 ? 'selected' : '' }}>10 years
                                        </option>
                                        <option value="10+" {{ $job->experience == '10+' ? 'selected' : '' }}>10+ years
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="description" class="mb-2">Description<span
                                            class="req">*</span></label>
                                    <textarea class="textarea" name="description" id="description" cols="5" rows="5"
                                        placeholder="Description">{{ $job->description }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="benefits" class="mb-2">Benefits</label>
                                    <textarea class="textarea" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{{ $job->benefits }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="responsibility" class="mb-2">Responsibility</label>
                                    <textarea class="textarea" name="responsibility" id="responsibility" cols="5" rows="5"
                                        placeholder="Responsibilities">{{ $job->responsibility }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="qualifications" class="mb-2">Qualifications</label>
                                    <textarea class="textarea" name="qualifications" id="qualifications" cols="5" rows="5"
                                        placeholder="Qualifications">{{ $job->qualifications }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="keywords" class="mb-2">Keywords<span class="req">*</span></label>
                                    <input type="text" placeholder="Keywords" id="keywords" name="keywords"
                                        class="form-control" value="{{ $job->keywords }}">
                                </div>

                                <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="company_name" class="mb-2">Company Name<span
                                                class="req">*</span></label>
                                        <input type="text" placeholder="Company Name" id="company_name"
                                            name="company_name" class="form-control" value="{{ $job->company_name }}">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="company_location" class="mb-2">Company Location</label>
                                        <input type="text" placeholder="Company Location" id="company_location"
                                            name="company_location" class="form-control"
                                            value="{{ $job->company_location }}">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="website" class="mb-2">Website</label>
                                    <input type="text" placeholder="Website" id="website" name="website"
                                        class="form-control" value="{{ $job->company_website }}">
                                </div>

                                <div class="mb-4">
                                    <label for="status" class="mb-2">Status</label>
                                    <select id="status" name="status" class="form-control">
                                        <option value="1" {{ $job->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $job->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="isFeatured" class="mb-2">Is Featured</label>
                                    <select id="isFeatured" name="isFeatured" class="form-control">
                                        <option value="1" {{ $job->isFeatured == 1 ? 'selected' : '' }}>Is Featured
                                        </option>
                                        <option value="0" {{ $job->isFeatured == 0 ? 'selected' : '' }}>Is Not
                                            Featured</option>
                                    </select>
                                </div>


                                <div class="card-footer p-4">
                                    <button type="submit" class="btn btn-primary" id="submitJobForm">Save
                                        Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customjs')
    <script type="text/javascript">
        $(document).ready(function() {
            // Handle form submission with AJAX
            $('#submitJobForm').click(function(e) {
                e.preventDefault(); // Prevent regular form submission

                // Clear previous error messages
                $(".error").remove();

                // Get form data
                var formData = $('#jobForm').serialize();

                // Send AJAX request
                $.ajax({
                    url: $('#jobForm').attr('action'), // URL from the form action
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.status) {
                            // Success - redirect or show success message
                            window.location.href = response.redirect_url;
                        } else {
                            // Show validation errors
                            $.each(response.errors, function(key, value) {
                                $('#' + key).after('<div class="error text-danger">' +
                                    value + '</div>');
                            });
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        alert('Something went wrong, please try again.');
                    }
                });
            });
        });
    </script>
@endsection
