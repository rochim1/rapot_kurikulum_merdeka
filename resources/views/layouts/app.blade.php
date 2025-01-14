<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- <title>{{ $title }} - {{ config('app.name', 'Laravel') }}</title> --}}

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Boostrap -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- template -->
    <link rel="stylesheet" href="{{ asset('css/template-admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/template-admin-theme-default.css') }}">

    <!-- scrollbar -->
    <link rel="stylesheet" href="{{ asset('css/scrollbar.css') }}">
    <script src="{{ asset('js/scrollbar.js') }}"></script>

    {{-- search select option --}}
    <link rel="stylesheet" href="{{ asset('search_optionselect/select2.min.css') }}">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">


</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="row justify-content-center py-4">
                    <a class="sidebar-brand d-flex align-items-center justify-content-center text-center my-n1 text-decoration-none text-muted"
                        href="{{ url('admin/dashboard') }}">
                        <img src="{{ asset('media/logo pendidikan.png') }}" alt
                            class="w-px-50 h-auto rounded-circle me-3">
                        <div class="text-dark fw-bolder">RAPOR KM <br> {{ session('data_sekolah')->nama_sekolah }}</div>
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
                    <div class="container flex-grow-1 container-p-y">

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
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>

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

    {{-- notif --}}
    <script>
        // confirmasi delete
        $(document).on('click', '#btn_delete', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Data akan terhapus secara permanen',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent().submit();
                }
            })
        });

        // confirmasi logout
        $(document).on('click', '#btn_logout', function(e) {
            e.preventDefault(); // Mencegah form untuk submit secara default

            Swal.fire({
                title: 'Yakin anda yakin?',
                text: 'Anda akan keluar dari sistem ini',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Keluar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika dikonfirmasi, submit form
                    $('#btn_logout_form').submit();
                }
            });
        });
    </script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    {{-- script js --}}
    @stack('script')
</body>

</html>
