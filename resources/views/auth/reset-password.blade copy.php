@extends('layouts.auth.master',['title' => 'Update Password' ])

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

                        <h5 class="text-primary mb-2 mt-4">Upadate Password</h5>
                    </div>

                    @if (session('status'))
                    <div class="alert alert-success text-center mb-4 mt-4 pt-2" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    
                    <form class="form-horizontal mt-4 pt-2" action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ $request->email ?? old('email') }}" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter email">
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
                            <label for="userpassword">Confirmation Password</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" id="userpassword" placeholder="Enter Confirm password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div>
                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Update Password</button>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection