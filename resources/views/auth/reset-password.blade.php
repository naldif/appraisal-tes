@extends('layouts.auth.master',['title' => 'Update Password' ])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mt-2">
                        <div class="mb-3">
                            <a href="index.html" class="">
                                <img src="{{asset('/be/assets/images/logo-dark.png')}}" alt="" height="22"
                                    class="auth-logo logo-dark mx-auto">
                                <img src="{{asset('/be/assets/images/logo-light.png')}}" alt="" height="22"
                                    class="auth-logo logo-light mx-auto">
                            </a>
                        </div>
                    </div>
                    <div class="p-3">
                        <h4 class="font-size-18 text-muted mt-2 text-center">Reset Password</h4>
                        <!-- <div class="alert alert-info" role="alert">
                            Enter your Email and instructions will be sent to you!
                        </div> -->

                        <form class="form-horizontal" action="{{ route('password.update') }}" method="POST">

                            <div class="mb-2">
                                <label for="useremail">Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    value="{{ $request->email ?? old('email') }}" id="useremail" placeholder="Email">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="useremail">Password</label>
                                <input type="password" name="password"
                                    class="form-control  @error('password') is-invalid @enderror" id="useremail"
                                    placeholder="New password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-2">
                                <label for="useremail">Password Confirmation</label>
                                <input type="password" name="password_confirmation"
                                    class="form-control @error('password') is-invalid @enderror" id="useremail"
                                    placeholder="Confirm password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 text-end">
                                    <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Save
                                        Password</button>
                                </div>
                            </div>
                            <!-- end row -->


                        </form>

                    </div>

                </div>
            </div>
            <div class="mt-2 text-center">
                <p>Remember It ? <a href="{{ route('login') }}" class="fw-bold text-primary"> Sign In Here </a> </p>
                <p>©
                    <script>
                        document.write(new Date().getFullYear())
                    </script> Upbond. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                </p>
            </div>

        </div>
    </div>
</div>
@endsection