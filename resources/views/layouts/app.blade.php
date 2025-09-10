<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    {{-- AdminLTE + FA --}}
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/fontawesome/css/all.min.css') }}">
    {{-- Custom kecil (tanpa margin-left override) --}}
    <link rel="stylesheet" href="{{ asset('css/adminlte-custom.css') }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
    <div class="wrapper">

        {{-- Navbar --}}
        @include('layouts.partials.navbar')

        {{-- Sidebar --}}
        @include('layouts.partials.sidebar')

        {{-- Content --}}
        <div class="content-wrapper">
            <section class="content pt-3">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>

        {{-- Footer --}}
        @include('layouts.partials.footer')

    </div>

    {{-- JS core --}}
    <script src="{{ asset('adminlte/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

    {{-- Hover: auto expand/collapse --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const body = document.body;
            const sidebar = document.querySelector('.main-sidebar');
            if (!sidebar) return;

            // mulai collapsed
            body.classList.add('sidebar-collapse');

            // expand saat hover
            sidebar.addEventListener('mouseenter', () => {
                if (window.innerWidth >= 992) {
                    body.classList.remove('sidebar-collapse');
                }
            });

            // collapse saat mouse keluar, kalau tidak ada menu terbuka
            sidebar.addEventListener('mouseleave', () => {
                if (window.innerWidth >= 992) {
                    const hasOpenMenu = sidebar.querySelector('.menu-open');
                    if (!hasOpenMenu) {
                        body.classList.add('sidebar-collapse');
                    }
                }
            });

            // ====== Tambahan penting ======
            // kalau submenu ditutup, cek lagi sidebar
            $(sidebar).on('collapsed.lte.treeview', function() {
                if (window.innerWidth >= 992) {
                    body.classList.add('sidebar-collapse');
                }
            });
        });
    </script>
    <script src="https://kit.fontawesome.com/374fec5aca.js" crossorigin="anonymous"></script>



    {{-- tempat script per-halaman --}}
    @yield('scripts')

    {{-- contoh: Chart.js per halaman (opsional) --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>
