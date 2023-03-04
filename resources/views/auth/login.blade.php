<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>KEMENKUMHAM | Pengajuan Praktek | Login</title>
    <link rel="stylesheet" href="https://zuramai.github.io/mazer/demo/assets/css/main/app.css" />
    <link rel="stylesheet" href="https://zuramai.github.io/mazer/demo/assets/css/main/app-dark.css" />
    <link rel="stylesheet" href="{{asset('assets/styles/css/login/auth.css')}}" />
    <link rel="shortcut icon" href="{{asset('assets/images/logo.png')}}"
        type="image/x-icon" />
    <link rel="shortcut icon" href="{{asset('assets/images/logo.png')}}"
        type="image/png" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

<body>
    <script src="https://zuramai.github.io/mazer/demo/assets/js/initTheme.js"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="row">
                        <div class="col-2">
                            <a href="{{route('login')}}"><img src="{{asset('assets/images/logo.png')}}"
                                    alt="Logo" width="100px" height="100px"/></a>
                        </div>
                        <div class="col-8 mt-3" style="margin-left: 10px">
                            <h4>KEMENKUMHAM | Pengajuan Kerja Praktek</h4>
                        </div>
                    </div>
                    <h1 class="auth-title mt-3">Log in.</h1>
                    <p class="auth-subtitle mb-3">
                        Log in dengan identitas anda
                    </p>

                    <form role="form" action="{{route('login')}}" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl form-control @error('username') is-invalid @enderror" placeholder="Username" name="username" value="{{ old('username') }}" />
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <a href="{{route('signup.index')}}"><p class="text-end mt-1">Belum punya akun? Daftar</p></a>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-1" type="submit">
                            Log in
                        </button>
                    </form>
                    
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        $(document).ready(function () {
            @if (session('error'))
                toastr.options =
                    {
                        "closeButton" : true,
                        "progressBar" : true
                    }
                toastr.error("{{ session('error') }}");
            @endif
        });
    </script>
</body>

</html>
