@extends('layouts/layout')

@section('titulo')
    <h1>Cadastro de Eventos</h1>
@endsection


@section('conteudo')
<section class="container">
<form action="{{route('eventos.store')}}" method="POST">
  @csrf
    <div class="form-row">
      <div class="form-group col">
        <label for="titulo">Título</label>
      <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" placeholder="Titulo do Evento"  value="{{old('titulo')}}">
        @error('titulo')
          <span class="invalid-feedback">
              {{$message}}
          </span>
        @enderror
      </div>
    </div>
    <div class="form row">
      <div class="form-group col">
        <label for="subTitulo">Subtitulo</label>
        <input type="text" class="form-control @error('subTitulo') is-invalid @enderror" id="subTitulo" name="subTitulo" placeholder="Subtitulo do evento" value="{{old('subTitulo')}}">
        @error('subTitulo')
        <span class="invalid-feedback">
            {{$message}}
        </span>
        @enderror
      </div>
    </div>
    <div class="form row">
      <div class="form-group col">
        <label for="descricao">Descricao</label>
        <input type="textarea" class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" placeholder="Breve descrição sobre o evento" value="{{old('descricao')}}">
        @error('descricao')
        <span class="invalid-feedback">
            {{$message}}
        </span>
        @enderror
      </div>
    </div>
    <div class="form row">
      <div class="form-group col">
        <label for="local">Local</label>
        <input type="text" class="form-control @error('local') is-invalid @enderror" id="local" name="local" placeholder="Local do evento" value="{{old('local')}}">
        @error('local')
        <span class="invalid-feedback">
            {{$message}}
        </span>
      @enderror
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="data">Data</label>
        <input type="date" class="form-control @error('data') is-invalid @enderror" id="data" name="data" placeholder="Data do evento" value="{{old('data')}}">
        @error('data')
        <span class="invalid-feedback">
            {{$message}}
        </span>
        @enderror
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="organizador">Organizador</label>
        <input type="text" class="form-control @error('organizador') is-invalid @enderror" id="organizador" name="organizador" placeholder="Organizador do evento" value="{{old('organizador')}}">
        @error('organizador')
        <span class="invalid-feedback">
            {{$message}}
        </span>
        @enderror
      </div>
    </div>
    
    <button type="submit" class="btn btn-success btn-lg">Criar Evento</button>
  </form>
</section>
@endsection

@section('rodape')
    <h2>Rodapé aqui</h2>
@endsection