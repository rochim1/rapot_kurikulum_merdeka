<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth - E-Rapot Kurikulum Merdeka</title>
    <title>Auth - SDN 2 Air Deras</title>
    <link rel="icon" href="{{ asset('media-sistem/logoSMK.png') }}">

    {{-- Bootstrap 5 dan Bootstrap Icon --}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>

<body class="bg-primary">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height:100vh">
            <div class="col-md-6">
                <div class="card bg-white shadow-lg">
                    <div class="card-body px-5 pt-4">
                        <div class="text-center">
                            <div class="mb-3">
                                <img src="{{ asset('media/logo pendidikan.png') }}" alt="img-logo" style="width: auto; height: 100px;">
                            </div>
                            <h5 class="fw-bold mt-2 text-uppercase">E-Rapot Kurikulum Merdeka</h5>
                            <h5 class="fw-bold mt-2 text-uppercase">SDN 2 Air Deras</h5>
                        </div>
                        
                        {{-- content --}}
                        @yield('content')

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SweetAlert2 --}}
    @include('sweetalert::alert')

    <!-- eyes password -->
    <script>
        function pass_eyes() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>    
</body>

</html>
