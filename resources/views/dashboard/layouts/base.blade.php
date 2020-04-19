<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    @include('dashboard.partials.css')
    @yield('css')
</head>

<body>
    @yield('modal')
    <div class="bmd-layout-container bmd-drawer-f-l">
        <header class="bmd-layout-header">
            <div class="navbar navbar-danger bg-danger bg-faded">
                <button class="navbar-toggler" type="button" data-toggle="drawer" data-target="#dw-s1">
                    <span class="sr-only">Toggle drawer</span>
                    <i class="material-icons">menu</i>
                </button>
                {{-- <ul class="nav navbar-nav">
                    <li class="nav-item">Title</li>
                </ul> --}}
            </div>
        </header>
        <div id="dw-s1" class="bmd-layout-drawer bg-danger  bg-faded">
            <header>
                <a class="navbar-brand text-black font-weight-bold">Subba Blood Bank</a>
            </header>
            <ul class="list-group">
                <a href="/dashboard" class="list-group-item text-white">Dashboard</a>
                <a href="/events" class="list-group-item text-white">Events</a>
                <a href="/blood-requests" class="list-group-item text-white">Blood Requests</a>
                <a href="/recipients" class="list-group-item text-white">Recipients</a>
                <a href="/users" class="list-group-item text-white">Users</a>
                <a href="/donors" class="list-group-item text-white">Donors</a>
                <a href="/profile" class="list-group-item text-white">Profile</a>
                <a href="/logout" class="list-group-item text-white">Logout</a>
            </ul>
        </div>
        <main class="bmd-layout-content">
            <div class="container-fluid mt-2">
                @yield('content')
            </div>
        </main>
    </div>

    @include('dashboard.partials.js')
</body>

</html>
