@if(Session::has('adminLogged'))
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--  Font Awesome 4.7  --}}
    <link rel="stylesheet" href="{{ asset('font-awesome-4/css/font-awesome.min.css') }}">
    {{--  Bootstrap4  --}}
    <link href="{{ asset('bootstrap-4/bootstrap.min.css') }}" rel="stylesheet" />
    {{-- Jquery  --}}
    <script src="{{ asset('angularjs/jquery-3.3.1.min.js') }}"></script>
    {{-- Bootstrap 4.3.1 JS --}}
    <script src="{{ asset('angularjs/bootstrap.min.js') }}"></script>
    <title>@yield('pageTitle')</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm">
            <div class="container">
        <a class="navbar-brand" href="{{ url('admin/dashboard') }}">bielement Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" target="_blank" href="{{ url('/') }}">Front View</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                BiElements
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ url('admin/bielements') }}">All BiElements</a>
                    <a class="dropdown-item" href="{{ url('admin/book/add') }}">Add Bielement</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Engines
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{ url('admin/engines') }}">All Engines</a>
                    <a class="dropdown-item" href="{{ url('admin/engine/add') }}">Add Engine</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/logout') }}">Logout</a>
            </li>
            </ul>
        </div>
            </div>
        </nav>
    </header>
    {{--  Body Content Start  --}}
    <section class="container mt-3">
        <div class="row">
            @yield('content')
        </div>
    </section>
</body>
</html>
@else
<script>
    window.location = "{{ url('admin/login') }}";
</script>
@endif