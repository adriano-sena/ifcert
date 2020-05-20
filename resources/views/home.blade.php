@extends('layouts.home-layout')


@section('conteudo')

     {{-- Banner Sobre o IfCert --}}
     <section id="title">

        <!-- Adiciona um padding padrão em todo o conteudo -->
        <div class="container-fluid">
          <!-- Nav Bar -->
          <nav class="navbar navbar-expand-lg navbar-dark ">
    
            <a class="navbar-brand brand-title" href="#">
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
    
          <!-- Title -->
    
          <div class="row">
            <div class="col-lg-6">
              <h1 class="titulo-principal">A sua Ferramenta de apoio para gerenciamento de Eventos</h1>
            </div>
    
            <div class="col-lg-6">
              <img class="title-image" src="{{asset('img/estudantes-pequena.jpg')}}" alt="iphone-mockup">
            </div>
          </div>
        </div>
      </section>
    
     {{-- Seção sobre o ifcert uma imagem e 3 colunas  --}}
      <section id="sobre">
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <i class="blue-color fas fa-check-circle fa-4x"></i>
                <h3>Gerenciamento completo</h3>
                <p>Gerencie a criação de eventos, atividades e emissão de certificados.</p>
            </div>
            
            <div class="col-lg-4 col-md-12">
                <i class="blue-color fas fa-bullseye fa-4x"></i>
                <h3>Sistema em fase Beta</h3>
                <p>Sistema em fase de desenvolvimento, as features serão lançadas em etapas.</p>
            </div>

            <div class="col-lg-4 col-md-12">
                <i class="blue-color fas fa-heart fa-4x"></i>
                <h3>Desenvolvido com carinho</h3>
                <p>Sistema desenvolvido por Adriano Sena, graduando do curso de ADS, como um projeto de TCC.</p>
            </div>
        </div>

      </section>
     {{-- Seção cards com eventos --}}
      <section id="eventos" class="container-fluid">
		  
		  <div class=" header card w-50 p-3 text-center card--bgOrange shadow-lg rounded">
			  <h2 class="header__title--bgWhite">Eventos</h2>
		  </div>

          {{-- <div class="container-interno container-interno--bgWhite"> --}}

			<div class="row">
			
			@foreach ($eventos as $evento)
			<div class="col-lg-4">
				<div class="card card--white m-4 shadow-lg bg-white rounded" >
					{{-- <img src="..." class="card-img-top" alt="..."> --}}
					<div class="card-body">
					<h5 class="card-title">{{$evento->titulo}}</h5>
					<p class="card-text">{{$evento->descricao}}</p>
					  <hr>
					  <a href="#" class="btn btn-terciary">Acessar</a>
					</div>
				</div>
			</div>
			@endforeach
			
		</div>
      </section>
	 
	  <footer class="footer">
		  <h3>Dúvidas?! Entre em Contato via nossas redes sociais.</h3>
		  <ul class="icones">
			  <li class="icones__item">Facebook</li>
			  <li class="icones__item">Whats</li>
			  <li class="icones__item">Linkedin</li>
		  </ul>
		  <p class="footer__text">&copy Nostromus Enterprise 2020</p>
	  </footer>

  @endsection