@extends('front.layouts.app')

@section('main')
    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">Register</h1>
                        <form method="POST" action="{{ route('store.register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="mb-2">Name*</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid
                                    
                                @enderror"
                                    placeholder="Enter Name" value="{{ old('name') }}" autofocus autocomplete="name">
                                <div style="color:red">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Email*</label>
                                <input type="text" name="email" id="email"
                                    class="form-control @error('email') is-invalid
                                    
                                @enderror"
                                    placeholder="Enter Email" value="{{ old('email') }}" autocomplete="username">
                                <div style="color:red">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div>
                            {{-- <div class="mb-3">
                                <label for="" class="mb-2">Mobile*</label>
                                <input type="number" name="mobile" id="mobile" class="form-control"
                                    placeholder="Enter mobile" :value="old('mobile')" required autofocus
                                    autocomplete="mobile">
                                <div style="color:red">
                                    <x-input-error :messages="$errors->get('mobile')" class="mt-2" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Designation*</label>
                                <input type="text" name="designation" id="designation" class="form-control"
                                    placeholder="Enter designation" :value="old('designation')" required autofocus
                                    autocomplete="designation">
                                <div style="color:red">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>
                            </div> --}}
                            <div class="mb-3">
                                <label for="" class="mb-2">Password*</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid
                                    
                                @enderror"
                                    placeholder="Enter Password" value="{{ old('password') }}">
                                <div style="color:red">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Confirm Password*</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control @error('password_confirmation') is-invalid
                                    
                                @enderror"
                                    placeholder="Enter password confirmation">
                                <div style="color:red">
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                                </div>
                            </div>
                            <button class="btn btn-primary mt-2" type="submit">Register</button>
                        </form>
                    </div>
                    <div class="mt-4 text-center">
                        <p>Have an account? <a href="{{ route('login') }}">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
