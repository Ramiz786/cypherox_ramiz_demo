@extends('auth.layouts.app')

@section('title', 'Login')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card overflow-hidden">
            <div class="bg-primary bg-soft">
                <div class="row">
                    <div class="col-8">
                        <div class="text-primary p-4">
                            <h5 class="text-primary">Welcome Back !</h5>
                            <p>Sign in to continue to Tangent App.</p>
                            @if (session('error'))
                            <span class="text-danger"> {{ session('error') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <!-- <img src="{{asset('images/profile-img.png')}}" alt="" class="img-fluid"> -->
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="auth-logo">
                    <a href="{{route('home')}}" class="auth-logo-light">
                        <div class="avatar-md profile-user-wid mb-4">
                            <span class="avatar-title rounded-circle bg-light">
                                <img src="{{asset('assets/logo-light.svg')}}" alt="" class="rounded-circle" height="10" style="height: 10px !important;">
                            </span>
                        </div>
                    </a>

                    <a href="{{route('home')}}" class="auth-logo-dark">
                        <div class="avatar-md profile-user-wid mb-4">
                            <span class="avatar-title rounded-circle bg-light">
                                <img src="{{asset('images/logo.jpeg')}}" alt="" class="" height="10">
                            </span>
                        </div>
                    </a>
                </div>
                <div class="p-2">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="username" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control  @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no') }}" required autocomplete="mobile_no" autofocus placeholder="Enter Mobile Number." id="username" placeholder="Enter Mobile No">
                            @error('mobile_no')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group auth-pass-inputgroup">
                                <input type="password" class="form-control  @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
                            </div>
                        </div>

                        {{-- <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-check">
                            <label class="form-check-label" for="remember-check">
                                Remember me
                            </label>
                        </div> --}}

                        <div class="mt-3 d-grid">
                            <button class="btn btn-primary waves-effect waves-light btn-user" type="submit">Log In</button>
                        </div>

                        <!-- <div class="mt-4 text-center">
                            <h5 class="font-size-14 mb-3">Sign in with</h5>

                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="javascript::void()" class="social-list-item bg-primary text-white border-primary">
                                        <i class="mdi mdi-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript::void()" class="social-list-item bg-info text-white border-info">
                                        <i class="mdi mdi-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript::void()" class="social-list-item bg-danger text-white border-danger">
                                        <i class="mdi mdi-google"></i>
                                    </a>
                                </li>
                            </ul>
                        </div> -->

                        {{-- <div class="mt-4 text-center">
                            <a href="" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                        </div> --}}
                    </form>
                </div>

            </div>
        </div>
        <div class="mt-5 text-center">

            <div>
                <!-- <p>Don't have an account ? <a href="auth-register.html" class="fw-medium text-primary"> Signup now </a> </p> -->
                <p>© <script>
                        document.write(new Date().getFullYear())
                    </script> {{config('app.name', 'Laravel')}}. <i class="mdi mdi-message-draw text-danger"></i> </p>
            </div>
        </div>

    </div>
</div>
@endsection