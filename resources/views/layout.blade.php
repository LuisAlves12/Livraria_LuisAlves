<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>@yield('titulo-pagina')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/all.min.css')}}">
    <link href="{{asset('css/flag.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/vegas.css')}}">
    <link rel="stylesheet" href="{{asset('css/slick-theme.css')}}">

    <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/all.min.js')}}"></script>
    <script src="{{asset('js/slick.js')}}"></script>
    <script src="{{asset('js/vegas.js')}}"></script>
    <style>
      body{
        background-color: #252429;
        color: #ffffff;
      }
      a{
        color:#ffffff;
      }
      table,tr,td,th{
        color:#ffffff;
      }
    </style>  
</head>
<body>
    <h1 style="text-align:center; color: #ffffff;">@yield('Titulo')</h1>
    @yield('conteudo')
    @if(session()->has('msg'))
    <h3><div class="alert alert-danger" role="alert">{{session('msg')}}</div></h3>
    @endif
    <nav class="navbar navbar-expand-lg navbar bg-dark">
    <div class="navbar-nav">
      <a class="nav-item nav-link" href="{{route('index.index')}}">Pagina Inicial</a>
      <a class="nav-item nav-link" href="{{route('pesquisa.index')}}">Procura</a>
      <a class="nav-item nav-link" href="{{route('livros.index')}}">Livros</a>
      <a class="nav-item nav-link" href="{{route('generos.index')}}">Generos</a>
      <a class="nav-item nav-link" href="{{route('editoras.index')}}">Editoras</a>
      <a class="nav-item nav-link" href="{{route('autores.index')}}">Autores</a>
      <a class="nav-item nav-link" href="{{route('home')}}">Home</a>
      @guest
      @if (Route::has('login'))
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
      @endif
      @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        </li>
      @endif
      @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
            </div>
          </li>
      @endguest
    </div>
</nav>
</body>
</html>