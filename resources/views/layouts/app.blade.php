<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    {{-- AdminLTE CSS --}}
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('adminlte/fontawesome/css/all.min.css') }}">
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    {{-- Custom CSS (opsional) --}}

    <link rel="stylesheet" href="{{ asset('uplot/dist/uPlot.min.css') }}">

    @vite([
    'resources/css/app.css',
    'resources/js/app.js',
    'node_modules/admin-lte/dist/css/adminlte.min.css',
    'node_modules/admin-lte/dist/js/adminlte.min.js'
])

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    {{-- Navbar --}}
    @include('layouts.partials.navbar')

    {{-- Sidebar --}}
    @include('layouts.partials.sidebar')

    {{-- Content Wrapper --}}
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

{{-- JS --}}
<script src="{{ asset('adminlte/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
<script src="{{ asset('uplot/dist/uPlot.iife.min.js') }}"></script>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Area Chart
    const ctxArea = document.createElement('canvas');
    document.getElementById('areaChart').appendChild(ctxArea);

    new Chart(ctxArea, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label: 'Area Dataset',
                data: [65, 59, 80, 81, 56, 55, 40],
                fill: true,
                borderColor: 'rgba(60,141,188,1)',
                backgroundColor: 'rgba(60,141,188,0.2)',
                tension: 0.4
            }]
        }
    });

    // Line Chart
    const ctxLine = document.createElement('canvas');
    document.getElementById('lineChart').appendChild(ctxLine);

    new Chart(ctxLine, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
            datasets: [{
                label: 'Line Dataset',
                data: [28, 48, 40, 19, 86, 27, 90],
                borderColor: 'rgba(210, 214, 222, 1)',
                backgroundColor: 'rgba(210, 214, 222, 0.5)',
                fill: false,
                tension: 0.4
            }]
        }
    });
});
</script>
@endsection

</body>
</html>
