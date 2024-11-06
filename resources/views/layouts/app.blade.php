<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Boostrap -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{-- bootstrap 4 --}}
    <link rel="stylesheet" href="{{ asset('bootstrap-4/dist/css/bootstrap.min.css') }}">

    <!-- template -->
    <link rel="stylesheet" href="{{ asset('css/template-admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template-admin-theme-default.css') }}">

    <!-- scrollbar -->
    <link rel="stylesheet" href="{{ asset('css/scrollbar.css') }}">
    <script src="{{ asset('js/scrollbar.js') }}"></script>

    {{-- search select option --}}
    <link rel="stylesheet" href="{{ asset('search_optionselect/select2.min.css') }}">

</head>
<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="row justify-content-center py-4">
                    <a class="sidebar-brand d-flex align-items-center justify-content-center text-center my-n1 text-decoration-none text-muted"
                    href="{{ url('admin/dashboard') }}">
                    <img src="https://rapormerdeka.com/assets/images/brand-logo-2.png" alt class="w-px-50    h-auto rounded-circle me-3" />
                    <div class="">Rapor KM <br> SD Negeri 2 Keling</div>
                </a>
                
                </div>
                <hr class="mt-n2">

                {{-- sidebar --}}
                @include('layouts.sidebar')

            </aside>

            <div class="layout-page">

                {{-- navbar --}}
                @include('layouts.navbar')

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y px-n3">

                        {{-- content --}}
                        @yield('content')

                    </div>

                    {{-- Footer --}}
                    @include('layouts.footer')

                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>

        <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    {{-- Jquery --}}
    <script src="{{ asset('jquery/jquery-3.6.0.min.js') }}"></script>
    {{-- sweetalert 2 --}}
    @include('sweetalert::alert')


    <!-- Core JS -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <!-- scrol bar -->
    <script src="{{ asset('js/perfect-scrollbar.js') }}"></script>

    <!-- sidebar -->
    <script src="{{ asset('js/sidebar.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('js/template-admin.js') }}"></script>

    {{-- search select option --}}
    <script src="{{ asset('search_optionselect/select2.min.js') }}"></script>
    <script>
        $(".searchSelect").select2();
    </script>
</body>
</html>
