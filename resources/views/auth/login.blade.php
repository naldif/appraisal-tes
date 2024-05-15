@extends('layouts.auth.master',['title' => 'Login' ])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mt-2">
                        <div class="mb-1">
                            <a href="index.html" class="">
                                <img src="{{asset('/be/assets/images/logo-dark.png')}}" alt="" height="22"
                                    class="auth-logo logo-dark mx-auto">
                                <img src="{{asset('/be/assets/images/logo-light.png')}}" alt="" height="22"
                                    class="auth-logo logo-light mx-auto">
                            </a>
                        </div>
                    </div>
                    <div class="p-3">
                        <h4 class="font-size-18 text-muted mt-2 text-center">Sign in</h4>
                        {{-- <p class="text-muted text-center">Sign in to continue to upbond.</p> --}}

                        <form class="form-horizontal" action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="email">E-mail Address</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    placeholder="Enter username">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="userpassword">Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" id="userpassword"
                                    placeholder="Enter password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3 row mt-4">
                                <div class="col-sm-6">
                                    <div class="form-checkbox">
                                        <input type="checkbox" class="form-check-input me-1" id="customControlInline">
                                        <label class="form-label" class="form-check-label"
                                            for="customControlInline">Remember me</label>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-sm-6 text-end">
                                    <a href="/forgot-password" class="text-muted"><i class="mdi mdi-lock"></i> Forgot
                                        your password?</a>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="row mb-2">
                                <div class="col-12 text-center">
                                    <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Log
                                        In</button>
                                </div>
                            </div>
                            <!-- end row -->

                            <div class="row">
                                <div class="col-12">
                                    <div class="text-center plan-line">
                                        or sign up with
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <a href="{{ route('oauth.google') }}" type="button" class="google-sign-in-button">
                                        Sign in with Google
                                    </a>
                                </div>
                            </div>
                            {{-- <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <a href="{{ route('oauth.google') }}"
                                        class="btn btn-danger w-100 waves-effect waves-light" type="submit">
                                        <i class="fab fa-google"></i> Login with Google
                                    </a>
                                </div>
                            </div> --}}
                        </form>
                        <!-- end form -->
                    </div>
                </div>
                <!-- end cardbody -->
            </div>
            <!-- end card -->
            <div class="text-center">
                <p>Don't have an account ?<a href="auth-register.html" class="fw-bold text-primary"> Signup
                        Now </a></p>
            </div>

        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
</div>
@endsection