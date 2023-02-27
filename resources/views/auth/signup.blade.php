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
            <div class="col-lg-6 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
            <div class="col-lg-6 col-12">
                <div id="auth-left">
                    <div class="row">
                        <div class="col-2">
                            <a href="{{route('login')}}"><img src="{{asset('assets/images/logo.png')}}"
                                    alt="Logo" width="100px" height="100px"/></a>
                        </div>
                        <div class="col-8 mt-1" style="margin-left: 10px">
                            <h4>KEMENKUMHAM | Pengajuan Kerja Praktek</h4>
                        </div>
                    </div>
                    <h3 class="auth-title mt-2">Pendaftaran</h3>
                    {{-- <p class="auth-subtitle">
                        Log in dengan identitas anda
                    </p> --}}

                    <form role="form" action="{{route('signup.process')}}" method="POST" enctype="multipart/form-data" id="formRegister">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Nama</label>
                                    <input type="text" class="form-control" name="nama" id="nama" placeholder="nama"> 
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir" id="tempatLahir" placeholder="tempat lahir"> 
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tanggal_lahir" id="tanggalLahir" placeholder="tanggal lahir"> 
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" id="jenisKelamin" class="form-control">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" class="form-control" name="alamat" id="alamat" placeholder="alamat"> 
                                </div>
                                <div class="form-group">
                                    <label class="form-label">No. HP</label>
                                    <input type="text" class="form-control" name="telp" id="telp" placeholder="no. hp"> 
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Asal Sekolah</label>
                                    <input type="text" class="form-control" name="asal_sekolah" id="asalSekolah" placeholder="asal sekolah"> 
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Foto</label>
                                    <input type="file" class="form-control" name="foto" id="foto" placeholder="foto"> 
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="username"> 
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="password"> 
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Re-Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="passwordConfirmation" placeholder="konfirmasi password"> 
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Dokumen</label>
                                    <input type="file" class="form-control" name="dokumen" id="dokumen" placeholder="dokumen"> 
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tanggal Awal</label>
                                    <input type="date" class="form-control" name="tanggal_awal" id="tanggalAwal" placeholder="tanggal awal magang"> 
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tanggal Akhir</label>
                                        <input type="date" class="form-control" name="tanggal_akhir" id="tanggalAkhir" placeholder="tanggal akhir magang"> 
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <a href="{{route('login')}}"><p class="text-end mt-1">Sudah punya akun? Login</p></a>
                                <button class="btn btn-primary btn-block btn-lg shadow-lg mt-1" type="submit">
                                    Daftar
                                </button>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.1/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\SignupRequest', '#formRegister'); !!}

    <script>
        $(document).ready(function () {
            @if (session('status') == 'success')
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.success("{{ session('message') }}");
            @elseif (session('status') == 'error')
            // console.log("{{session('message')}}")
                toastr.options =
                {
                    "closeButton" : true,
                    "progressBar" : true
                }
                toastr.error("{{ session('message') }}");
            @endif
        });
    </script>
</body>

</html>
