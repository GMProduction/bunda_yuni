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
    <script src="{{ asset('js/swal.js') }}"></script>

    <style>
        body {
            font-family: 'Nunito';
        }

    </style>
</head>

<body class="bg-accent-color">
@if ($errors->any())
    {{-- <h4>{{$errors}}</h4> --}}
    {{-- <h4>{{$errors->first()}}</h4> --}}
    {{-- <h4>{{$errors->first() == 'The password field is required.' ? 'swal' : 'input'}}</h4> --}}
    @if ($errors->first())
        <script>
            swal('{{ $errors->first() }}', {
                icon: 'warning',
                buttons: false,
                timer: 2000
            })
        </script>
    @endif
@endif
    <div style="height: 100vh">
        <div class="login">
            <div class="panel-login pinggiran-bunder-10 bayangan-accent ">
                <p class="text-center mt-3 h2 fw-bold">Login</p>
                <form class="p-3"  method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control login" id="username" name="username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control login" id="password" name="password">
                    </div>

                        <button type="submit" class="btn-utama ms-auto   mt-4 d-block mb-3 w-full" >LOGIN</button>

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
