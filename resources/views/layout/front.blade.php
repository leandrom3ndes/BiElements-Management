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
  </head>
  <body>
<header>
        <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light shadow-lg">
            <div class="container">
                <a class="navbar-brand" href="#"><b class="btn btn-danger"><i class="fa fa-bielement"></i> bielement</b> <small class="text-secondary">Coleção de elementos BI</small></a>
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
                            <a class="nav-link" href="#!/home">BiElements</a>
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
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
</header>
      
      <main role="main" style="margin-top:64px;">
        <section class="jumbotron text-center" style="background:url('{{ asset('imgs/1.jpg') }}') center; border-radius:0px;">
          <div class="container">
            <h1 class="jumbotron-heading text-white">Bem vindo ao gestor de elementos BI</h1>
            <p class="lead text-white">Esta aplicação permite gerir os seus elementos de Business Intelligence e encontra-se integrada com o Knowage.</p>
            <p>
              <a href="#bielements" class="btn btn-primary btn-lg my-2"><i class="fa fa-eye"></i> BI Elements</a>
            </p>
          </div>
        </section>
      
        <div class="album py-5 bg-light">
          <div class="container">
            @yield('content')
          </div>
        </div>
      </main>
      
      <footer class="text-muted">
        <div class="container">
          <p class="float-right">
            <a href="#">Back to top</a>
          </p>
          <p><a href="#!/home">BI Element</a> permite gerir os seus elementos de Business Intelligence e encontra-se integrada com o Knowage.</p>
          <p>Explore todos os <a href="#!/engines">engines integrados.</a></p>
        </div>
      </footer>
</body>
</html>