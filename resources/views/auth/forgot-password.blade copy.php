@extends('layouts.auth.master',['title' => 'Forgot Password' ])

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

                        <h5 class="text-primary mb-2 mt-4">Reset Password</h5>
                    </div>
                    @if (session('status'))
                    <div class="alert alert-success text-center mb-4 mt-4 pt-2" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form class="form-horizontal" action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="useremail">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="useremail" placeholder="Enter email">
                            @error('email')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <div class="row mb-0">
                            <div class="col-12 text-end">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="mt-5 text-center text-white">
            <p>Remember It ? <a href="{{ route('login') }}" class="fw-bold text-white"> Sign In here</a> </p>
            <p>© <script>document.write(new Date().getFullYear())</script> Morvin. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign</p>
        </div>
    </div>
</div>
@endsection