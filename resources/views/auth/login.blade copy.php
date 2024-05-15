@extends('layouts.auth.master',['title' => 'Login' ])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card">
            <div class="card-body">
                <div class="px-2 py-3">
                    <div class="text-center">
                        <a href="index.html">
                            <img src="{{ asset('/be/assets/images/logo-dark.png') }}" height="22" alt="logo">
                        </a>
                        <h5 class="mt-4">Login</h5>
                    </div>


                    <form class="form-horizontal pt-2" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="userpassword">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="userpassword" placeholder="Enter password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="customControlInline">
                                <label class="form-label" for="customControlInline">Remember me</label>
                            </div>
                        </div>

                        <div>
                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log In</button>
                        </div>

                        <div class="mt-4 text-center">
                            <a href="/forgot-password" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot
                                your password?</a>
                        </div>

                    </form>


                </div>
            </div>
        </div>

        <div class="mt-5 text-center text-white">
            <p>Don't have an account ?<a href="auth-register.html" class="fw-bold text-white"> Register</a> </p>
        </div>
    </div>
</div>
@endsection