<!doctype html>
<html lang="en" ng-app="bielement">
<head>
<meta charset="utf-8">
<title>Bi Element Management</title>
{{--  Font Awesome 4.7  --}}
<link rel="stylesheet" href="{{ asset('font-awesome-4/css/font-awesome.min.css') }}">
{{-- Bootstra 4 CSS --}}
<link href="{{ asset('bootstrap-4/bootstrap.min.css') }}" rel="stylesheet" />
{{-- Custom CSS --}}
<link href="{{ asset('css/custom.css') }}" rel="stylesheet" />

{{-- AngulJs 1.7.7 --}}
<script src="{{ asset('angularjs/angular.min.js') }}"></script>
{{-- AngularJs  1.7.7 Route --}}
<script src="{{ asset('angularjs/angular-route.min.js') }}"></script>
{{-- AngularJs  1.7.7 Animate --}}
<script src="{{ asset('angularjs/angular-animate.min.js') }}"></script>
{{-- Jquery  --}}
<script src="{{ asset('angularjs/jquery-3.3.1.min.js') }}"></script>
{{-- Bootstrap 4.3.1 JS --}}
<script src="{{ asset('angularjs/bootstrap.min.js') }}"></script>
{{--  Custom Scripts  --}}
<script>
    var appUrl="{{ url('api') }}"
</script>
<script src="{{ asset('angularjs/app.js') }}"></script>
<script src="{{ asset('angularjs/memberController.js') }}"></script>
<script src="{{ asset('angularjs/sbisdk-all-production.js') }}"></script>
<script src="{{ asset('angularjs/knowageController.js') }}"></script>

  </head>
  <body>
<header>
        <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light shadow-lg">
            <div class="container">
                <a class="navbar-brand" href="#"><b class="btn btn-danger"><i class="fa fa-dashboard"></i> BI Elements</b> <small class="text-secondary">Sistema de Gestão de elementos <strong> Business Intelligence </strong></small></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#!/home">Início</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#!/engines">Engines</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#!/home">BI Elements</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#!/knowage">Knowage</a>
                        </li>
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="javascript:void(null);" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Minha conta
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if(Session::has('memberData'))
                            <a class="dropdown-item" href="#!/member/profile">Perfil</a>
                            <a class="dropdown-item" href="#!/member/logout">Sair</a>
                            @else
                            <a class="dropdown-item" href="#!/member/login">Login</a>
                            <a class="dropdown-item" href="#!/member/register">Registo</a>
                            @endif
                          </div>
                          <li class="nav-item">
                            <a class="nav-link" href="admin/dashboard">Admin</a>
                        </li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
</header>
      
      <main role="main" style="margin-top:64px;">
        <section class="jumbotron text-center">
        <object data="https://demo.knowage-suite.com/knowage/public/servlet/AdapterHTTP?ACTION_NAME=EXECUTE_DOCUMENT_ACTION&OBJECT_LABEL=Sales%20analysis&TOOLBAR_VISIBLE=false&ORGANIZATION=DEMO&NEW_SESSION=true&PARAMETERS=hidden%3D%26hidden_field_visible_description%3D" height="500px" width="100%" type="text/html"></object>
        </section>
      
        <div class="album py-5 bg-light">
          <div class="container">
            @yield('content')
          </div>
        </div>
      </main>
      
      <footer class="text-muted">
        <div class="container">
          <p><a href="#!/home">BI Element Management</a> permite gerir os seus elementos de Business Intelligence e encontra-se integrada com o <a href="#!/knowage"> Knowage</a>.</p>
          <p>Explore todos os outros<a href="#!/engines"> engines</a>.</p>
        </div>
      </footer>
</body>
</html>