<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    @include('includes.styles')
</head>

<body class="authentication-bg">
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <a href="index.html" class="mb-5 d-block auth-logo">
                            <img src="{{ asset('/' . $logo->main_logo) }}" alt="" height="30"
                                class="logo logo-dark">
                            <img src="{{ asset('/' . $logo->main_logo) }}" alt="" height="30"
                                class="logo logo-light">
                        </a>
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">{{ __('auth.Welcome Back') }}</h5>
                                {{--  <p class="text-muted">Sign in to continue to Minible.</p>  --}}
                            </div>

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="p-2 mt-4">
                                <form action="{{ Route('login.post') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label" for="email">{{ __('auth.email') }}</label>
                                        <input name="email" type="text" class="form-control" id="email"
                                            placeholder="{{ __('auth.Enter email') }}...">
                                    </div>

                                    <div class="mb-3">
                                        {{--  <div class="float-end">
                                            <a href="auth-recoverpw.html" class="text-muted">Forgot password?</a>
                                        </div>  --}}
                                        <label class="form-label" for="userpassword">{{ __('auth.password') }}</label>
                                        <input name="password" type="password" class="form-control" id="userpassword"
                                            placeholder="{{ __('auth.Enter password') }}...">
                                    </div>

                                    <div class="mt-3 text-end">
                                        <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">{{ __('auth.login') }}</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="mb-0">{{ __('auth.Dont have an account') }}? <a href="{{ Route('register') }}"
                                                class="fw-medium text-primary"> {{ __('auth.Signup now') }} </a> </p>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                    <div class="mt-5 text-center">
                        <p>©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            {{ __('auth.Crafted with ❤️ by Ozodbek') }}
                            {{--  Minible. Crafted with <i class="mdi mdi-heart text-danger"></i> by
                            Ozodbek  --}}
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('includes.scripts')
</body>

</html>
