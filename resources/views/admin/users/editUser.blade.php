@extends('front.layouts.app')

@section('main')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                       <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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
                    <div class="card border-0 shadow mb-4">
                        <form action="" id="userForm" name="userFrom">

                            <div class="card-body  p-4">
                                <h3 class="fs-4 mb-1">User / Edit</h3>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Name*</label>
                                    <input type="text" placeholder="Enter Name" name="name" id="name"
                                        class="form-control" value="{{ $user->name }}">
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Email*</label>
                                    <input type="email" name="email" id="email" placeholder="Enter Email"
                                        class="form-control" value="{{ $user->email }}">
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Designation</label>
                                    <input type="text" name="designation" id="designation" placeholder="Designation"
                                        class="form-control" value="{{ $user->designation }}">
                                </div>
                                <div class="mb-4">
                                    <label for="" class="mb-2">Mobile</label>
                                    <input type="number" name="mobile" id="mobile" placeholder="Mobile"
                                        class="form-control" value="{{ $user->mobile }}">
                                </div>
                            </div>
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Update</button>
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
        $('#userForm').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: 'put',
                url: "{{ route('users.update', $user->id) }}",
                data: $('#userForm').serializeArray(),
                dataType: 'json',
                success: function(response) {
                    if (response.status == true) {
                        $('#name').remove('is-invalid')
                            .siblings('p')
                            .remove('invalid-feedback')
                            .html('')

                        $('#email').remove('is-invalid')
                            .siblings('p')
                            .remove('invalid-feedback')
                            .html('')
                        window.location.href = "{{ route('users.index') }}";

                    } else {
                        var errors = response.errors;
                        alert("ok");
                        if (errors.name) {
                            $('#name').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html('errors.name')
                        } else {
                            $('#name').remove('is-invalid')
                                .siblings('p')
                                .remove('invalid-feedback')
                                .html('')
                        }

                        if (errors.email) {
                            $('#email').addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback')
                                .html(errors.email)
                        } else {
                            $('#email').remove('is-invalid')
                                .siblings('p')
                                .remove('invalid-feedback')
                                .html('')
                        }

                    }
                }
            });
        });
    </script>
@endsection