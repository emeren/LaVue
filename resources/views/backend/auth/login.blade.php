@extends('backend.layouts.app')

@section('content')

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <i class="fa fa-heart"></i>
            <a href="../../index2.html"><b>LaVue</b></a>




        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in</p>
                <p class="login-box-msg text-green">
                    @if(Session::has('status'))
                    {{ Session::get('status')}}
                    @endif
                </p>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3 input-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3 input-group">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="current-password" placeholder="Hasło">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="ml-3 icheck-primary">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                           Remember me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary btn-block">Log in</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-5 mb-1">
                    <a href="/panel/password/reset" class="forgetPassword">Forgot password</a>
                </p>
                <p class="mb-0">
                    <a href="/panel/register" class="text-center">Sign up!</a>
                </p>
            </div>
        </div>
</body>

@endsection