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
                <li class="nav-item">
                  <a class="nav-link" href="#login">Login</a>
                </li>
              </ul>
            </div>
          </nav>
    
    
          <!-- Title -->
    
          <div class="row">
            <div class="col-lg-6">
              <h1 class="titulo-principal">O novo sistema oficial para gerenciamento de eventos</h1>
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
      <section id="eventos">
          <h2>Eventos</h2>

          <div class="row">

          </div>
      </section>
     {{-- Rodapé contato e quem somos --}}
  @endsection