<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Subba Blood Bank</title>

    <!-- Material Design for Bootstrap fonts and icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">

    <!-- Material Design for Bootstrap CSS -->
    <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
        integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">


    @yield('css')

    <link rel="stylesheet" href="{{ asset('/css/site/v1_app.css') }}">



</head>

<body>
    @yield('modal')


    <div class="welcome-message-container  text-white  ">
        <span class="h5">
            Welcome To Subba Blood Bank
        </span>
        <div class="social-icons">
            <a href="" class="text-white">
                <span>
                    <i class="fab fa-facebook-f h5"></i>
                </span>
            </a>
            <a href="" class="text-white">
                <span>
                    <i class="fab fa-instagram h5"></i>
                </span>
            </a>
            <a href="" class="text-white">
                <span>
                    <i class="fab fa-youtube h5"></i>
                </span>
            </a>
        </div>
    </div>

    {{-- nav  --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Blood Bank</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/public-events">Events</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/request-for-blood">Request for blood</a>
                </li>

                @if (auth()->check() && Auth::user()->type != 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="/public-profile">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/logout">Logout</a>
                </li>
                @else
                <li class="nav-item ">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="/register">Register</a>
                </li>
                @endif
            </ul>
        </div>
    </nav>
    {{--!ENds. nav  --}}

    @yield('content')

    {{-- footer  --}}
    <div class="footer-container text-center mt-5">
        Copyright © 2020 Subba Blood Bank
    </div>
    {{--!ends footer  --}}


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
        integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js"
        integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() { $('body').bootstrapMaterialDesign(); });
    </script>

    @yield('js')
    <script src="{{ asset('/js/site/v1_app.js') }}"></script>

</body>

</html>
