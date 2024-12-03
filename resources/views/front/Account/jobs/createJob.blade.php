@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
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
                    <div class="card border-0 shadow mb-4 ">
                        <form method="post" name="jobForm" id="jobForm">
                            @csrf

                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">Job Details</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="title" class="mb-2">Title<span class="req">*</span></label>
                                        <input type="text" placeholder="Job Title" id="title" name="title"
                                            class="form-control" value="{{ old('title') }}">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="category" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select a Category</option>
                                            @foreach ($categorys as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category') == $category->id ? 'selected' : '' }}>
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
                                            @foreach ($jobtype as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ old('jobtype') == $type->id ? 'selected' : '' }}>
                                                    {{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="vacancy" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input type="number" min="1" placeholder="Vacancy" id="vacancy"
                                            name="vacancy" class="form-control" value="{{ old('vacancy') }}">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="salary" class="mb-2">Salary</label>
                                        <input type="text" placeholder="Salary" id="salary" name="salary"
                                            class="form-control" value="{{ old('salary') }}">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="location" class="mb-2">Location<span class="req">*</span></label>
                                        <input type="text" placeholder="Location" id="location" name="location"
                                            class="form-control" value="{{ old('location') }}">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label for="experience" class="mb-2">Experience</label>
                                    <select id="experience" name="experience" class="form-control">
                                        <option value="">Select Experience</option>
                                        <option value="1" {{ old('experience') == '1' ? 'selected' : '' }}>1 year
                                        </option>
                                        <option value="2" {{ old('experience') == '2' ? 'selected' : '' }}>2 years
                                        </option>
                                        <option value="3" {{ old('experience') == '3' ? 'selected' : '' }}>3 years
                                        </option>
                                        <option value="4" {{ old('experience') == '4' ? 'selected' : '' }}>4 years
                                        </option>
                                        <option value="5" {{ old('experience') == '5' ? 'selected' : '' }}>5 years
                                        </option>
                                        <option value="6" {{ old('experience') == '6' ? 'selected' : '' }}>6 years
                                        </option>
                                        <option value="7" {{ old('experience') == '7' ? 'selected' : '' }}>7 years
                                        </option>
                                        <option value="8" {{ old('experience') == '8' ? 'selected' : '' }}>8 years
                                        </option>
                                        <option value="9" {{ old('experience') == '9' ? 'selected' : '' }}>9 years
                                        </option>
                                        <option value="10" {{ old('experience') == '10' ? 'selected' : '' }}>10 years
                                        </option>
                                        <option value="10+" {{ old('experience') == '10+' ? 'selected' : '' }}>10+ years
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="description" class="mb-2">Description<span
                                            class="req">*</span></label>
                                    <textarea class="form-control" name="description" id="description" cols="5" rows="5"
                                        placeholder="Description">{{ old('description') }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="benefits" class="mb-2">Benefits</label>
                                    <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5"
                                        placeholder="Benefits">{{ old('benefits') }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="responsibility" class="mb-2">Responsibility</label>
                                    <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5"
                                        placeholder="Responsibility">{{ old('responsibility') }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="qualifications" class="mb-2">Qualifications</label>
                                    <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5"
                                        placeholder="Qualifications">{{ old('qualifications') }}</textarea>
                                </div>

                                <div class="mb-4">
                                    <label for="keywords" class="mb-2">Keywords<span class="req">*</span></label>
                                    <input type="text" placeholder="Keywords" id="keywords" name="keywords"
                                        class="form-control" value="{{ old('keywords') }}">
                                </div>

                                <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="company_name" class="mb-2">Company Name<span
                                                class="req">*</span></label>
                                        <input type="text" placeholder="Company Name" id="company_name"
                                            name="company_name" class="form-control" value="{{ old('company_name') }}">
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <label for="company_location" class="mb-2">Company Location</label>
                                        <input type="text" placeholder="Company Location" id="company_location"
                                            name="company_location" class="form-control"
                                            value="{{ old('company_location') }}">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label for="website" class="mb-2">Website</label>
                                    <input type="text" placeholder="Website" id="website" name="website"
                                        class="form-control" value="{{ old('website') }}">
                                </div>

                                <div class="card-footer p-4">
                                    <button type="button" class="btn btn-primary" id="saveJob">Save Job</button>
                                </div>
                            </div>
                        </form>
                    </div>



                    <div class="card border-0 shadow mb-4">
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">Change Password</h3>
                            <div class="mb-4">
                                <label for="" class="mb-2">Old Password*</label>
                                <input type="password" placeholder="Old Password" class="form-control">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">New Password*</label>
                                <input type="password" placeholder="New Password" class="form-control">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="" class="mb-2">Confirm Password*</label>
                                <input type="password" placeholder="Confirm Password" class="form-control">
                            </div>
                        </div>
                        <div class="card-footer  p-4">
                            <button type="button" class="btn btn-primary">Update</button>
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
