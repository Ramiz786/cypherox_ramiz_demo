@extends('auth.layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="row justify-content-center">

    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card overflow-hidden">
            <div class="bg-primary bg-soft">
                <div class="row">
                    <div class="col-7">
                        <div class="text-primary p-4">
                            <h5 class="text-primary">Reset Password! to E-Art.</h5>
                            <!-- <p>Reset Password! to E-Art.</p> -->
                            @if (session('error'))
                            <span class="text-danger"> {{ session('error') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-5 align-self-end">
                        <!-- <img src="{{asset('admin/images/profile-img.png')}}" alt="" class="img-fluid"> -->
                    </div>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="auth-logo">
                    <a href="{{route('home')}}" class="auth-logo-light">
                        <div class="avatar-md profile-user-wid mb-4">
                            <span class="avatar-title rounded-circle bg-light">
                                <img src="{{asset('admin/assets/logo-light.svg')}}" alt="" class="rounded-circle" height="34">
                            </span>
                        </div>
                    </a>

                    <a href="{{route('home')}}" class="auth-logo-dark">
                        <div class="avatar-md profile-user-wid mb-4">
                            <span class="avatar-title rounded-circle bg-light">
                                <img src="{{asset('admin/images/logo.png')}}" alt="" class="" height="34">
                            </span>
                        </div>
                    </a>
                </div>
                <div class="p-2">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="mb-3">
                            <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address.">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <!-- <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-check">
                            <label class="form-check-label" for="remember-check">
                                Remember me
                            </label>
                        </div> -->

                        <div class="mt-3 d-grid">
                            <button class="btn btn-primary btn-user btn-block">
                                {{ __('Send Password Reset Link') }}
                            </button>
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

                        <div class="text-center">
                            <a class="small" href="{{route('login')}}">Already know your passwrd? Login Here</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <div class="mt-5 text-center">

            <div>
                <!-- <p>Don't have an account ? <a href="auth-register.html" class="fw-medium text-primary"> Signup now </a> </p> -->
                <p>© <script>
                        document.write(new Date().getFullYear())
                    </script> E-Art Gallery. <i class="mdi mdi-message-draw text-danger"></i> </p>
            </div>
        </div>

    </div>

    <div class="text-center mt-5">
        <h6 class="text-white">Developed By : <a class="text-white" href="https://techtoolindia.com">TechTool India</a></h6>
    </div>

</div>
@endsection