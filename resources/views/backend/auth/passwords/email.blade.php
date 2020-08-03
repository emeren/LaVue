@extends('backend.layouts.app')

@section('content')

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b>RCPS</b> Admin</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Zresetuj swoje hasło</p>
                @if(Session::has('status'))
                <p class="login-box-msg text-green">{{ Session::get('status')}}</p>
                @endif
                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                            placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback  pt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror



                        <span class="succes-feedback text-green pt-2" role="success">
                            <strong>{{ $status ?? ''}}</strong>
                        </span>
                    </div>

                    <div class="row justify-content-end">
                        <!-- /.col -->
                        <div class="col-8">
                            <button type="submit" class="btn btn-primary btn-block">Resetuj hasło</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-1 mt-5">
                    <a href="/panel/login">Strona logowania</a>
                </p>
            </div>
        </div>
</body>

@endsection