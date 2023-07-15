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
                            <h5 class="text-primary">E-Art </h5>
                            <p>Reset Password!</p>
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
                    <form method="POST" action="{{ route('reset-password') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group">
                            <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address.">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="New Password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password-confirm" type="password" class="form-control form-control-user" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        </div>

                        <button class="btn btn-primary btn-user btn-block" type="submit">
                            {{ __('Reset Password') }}
                        </button>
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