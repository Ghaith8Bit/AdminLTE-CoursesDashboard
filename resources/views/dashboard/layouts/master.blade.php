<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    @include('dashboard.includes.styles')

</head>

<body class="dark-mode layout-fixed layout-navbar-fixed sidebar-collapse">
    <div class="wrapper">

        <!-- Preloader -->
        @include('dashboard.includes.loader')

        <!-- Navbar -->
        @include('dashboard.includes.navbar')


        <!-- Content -->
        @yield('content')

    </div>

    <!-- REQUIRED SCRIPTS -->
    @include('dashboard.includes.scripts')

</body>

</html>
