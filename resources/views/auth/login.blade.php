@extends('front.layouts.app')

@section('main')
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <section class="section-5">
        <div class="container my-5">
            <div class="py-lg-2">&nbsp;</div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow border-0 p-5">
                        <h1 class="h3">Login</h1>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="mb-2">Email*</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid
                                    
                                @enderror"
                                    placeholder="example@example.com">
                                <div style="color:red">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>


                            </div>
                            <div class="mb-3">
                                <label for="" class="mb-2">Password*</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid
                                    
                                @enderror"
                                    placeholder="Enter Password">
                                {{-- <div style="color:red"><x-input-error :messages="$errors->get('password')" class="mt-2" /></div> --}}
                                <div style="color:red">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>
                            </div>



                            <div class="justify-content-between d-flex">
                                <button class="btn btn-primary mt-2">Login</button>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="mt-3">Forgot Password?</a>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="mt-4 text-center">
                        <p>Do not have an account? <a href="{{ route('register') }}">Register</a></p>
                    </div>
                </div>
            </div>
            <div class="py-lg-5">&nbsp;</div>
        </div>
    </section>
@endsection
