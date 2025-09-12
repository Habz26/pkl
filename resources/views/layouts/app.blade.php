<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'dashboard')</title>

    {{-- AdminLTE + FA --}}
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/fontawesome/css/all.min.css') }}">
    {{-- Custom kecil (tanpa margin-left override) --}}
    <link rel="stylesheet" href="{{ asset('css/adminlte-custom.css') }}">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <style>
        .content-header {
            padding-bottom: 0 !important;
            margin-bottom: 0 !important;
        }

        .filter-row {
            margin-top: -10px;
            /* rapetin */
        }

        .small-box {
            transition: 0.3s ease-in-out;
        }

        .small-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        /* Preloader */
        #preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity .5s ease;
        }

        #preloader .spinner {
            width: 50px;
            height: 50px;
            border: 6px solid #ddd;
            border-top: 6px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            100% {
                transform: rotate(360deg);
            }
        }
        
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">

    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>

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

            // kalau submenu ditutup, cek lagi sidebar
            $(sidebar).on('collapsed.lte.treeview', function() {
                if (window.innerWidth >= 992) {
                    body.classList.add('sidebar-collapse');
                }
            });
        });

        // Preloader
        window.addEventListener("load", function() {
            const preloader = document.getElementById('preloader');
            preloader.style.opacity = '0';
            setTimeout(() => preloader.style.display = 'none', 500);
        });
    </script>

    <script src="https://kit.fontawesome.com/374fec5aca.js" crossorigin="anonymous"></script>

    {{-- tempat script per-halaman --}}
    @yield('scripts')

    {{-- contoh: Chart.js per halaman (opsional) --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>
