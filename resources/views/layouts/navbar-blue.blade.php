<!-- Nav Bar -->
<nav class="navbar navbar-container navbar-expand-lg navbar-dark ">
    
    <a class="navbar-brand brand-title" href="{{route('home')}}">
        <i class="fas fa-bug"></i> IF Cert
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-toggler"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar-toggler">
      <ul class="navbar-nav ml-auto lista-itens">
            <li class="nav-item">
                <a class="nav-link" href="#sobre">Sobre</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#eventos">Eventos</a>
            </li>
            @guest
                @if(Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                @endif
                @if(Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Registrar</a>
                    </li>
                @endif
            @else
                @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        Sair
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                @endauth
            @endguest
      </ul>
    </div>
  </nav>