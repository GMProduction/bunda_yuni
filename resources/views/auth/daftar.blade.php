<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Skripsi || Login</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/appstyle/genosstyle.1.0.css') }}" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Styles -->

    <style>
        body {
            font-family: 'Nunito';
        }

    </style>
</head>

<body class="bg-accent-color">
    <div style="height: 100vh;">
        <div class="login">
            <div class="panel-login pinggiran-bunder-10 bayangan-accent ">
                <p class="text-center mt-3 h2 fw-bold">Daftar</p>
                <p class="text-center huruf-abu-5">Jika sudah mempunyai akun bisa login <a class="link"
                        href="/login">disini</a></p>

                <form class="p-3">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control login" id="nama">
                    </div>

                    <div class="mb-3">
                        <label for="nohp" class="form-label">No. Hp</label>
                        <input type="text" class="form-control login" id="nohp">
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control login" id="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control login" id="password">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control login" id="password_confirmation">
                    </div>

                    <a class="btn-utama ms-auto   mt-4 d-block mb-3">DAFTAR</a>
                    <div class="d-flex w-100 mt-3 ">
                        <hr class="garis-horizontal huruf-abu-3">
                        <p class="mb-0 me-2 ms-2 huruf-abu-5">atau</p>
                        <hr class="garis-horizontal huruf-abu-3">
                    </div>
                    <a class="btn-google ms-auto   mt-2 d-block mb-3"><img
                            src="{{ asset('images/local/logo-google.png') }} ">Login dengan google</a>
                </form>
            </div>
        </div>
        <div class="logo-login">
            <img src="{{ asset('images/local/logo-perusahaan.png') }}">
        </div>

    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script> --}}

</body>

</html>
