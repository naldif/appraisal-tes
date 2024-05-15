@extends('layouts.auth.master',['title' => 'Forgot Password' ])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mt-4">
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
                        <h4 class="font-size-18 text-muted mt-2 text-center mb-4">Reset Password</h4>

                        @if (session('status'))
                        <div class="alert alert-info" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <form class="form-horizontal" action="{{ route('password.email') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="useremail">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="useremail" placeholder="Enter email">
                            </div>
                            @error('email')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                            <div class="mb-3 row mt-4">
                                <div class="col-12 text-end">
                                    <button type="submit"
                                        class="btn btn-primary w-100 waves-effect waves-light">Sent Reset
                                        Password</button>
                                </div>
                            </div>
                            <!-- end row -->


                        </form>

                    </div>

                </div>
            </div>
            <div class="mt-5 text-center">
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