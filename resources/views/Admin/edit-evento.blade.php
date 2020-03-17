@extends('layouts/layout')

@section('titulo')
    <h1>Cadastro de Eventos</h1>
@endsection


@section('conteudo')
<section class="container">
<form action="{{route('eventos.update' , $evento->id)}}" method="POST">
  @csrf
  @method('PUT')
    <div class="form-row">
      <div class="form-group col">
        <label for="titulo">Título</label>
      <input type="text" class="form-control" id="titulo" name="titulo" value="{{$evento->titulo}}" placeholder="Titulo do Evento">
      </div>
    </div>
    <div class="form row">
      <div class="form-group col">
        <label for="subTitulo">Subtitulo</label>
      <input type="text" class="form-control" id="subTitulo" name="subTitulo" value="{{$evento->subTitulo}}" placeholder="Subtitulo do evento">
      </div>
    </div>
    <div class="form row">
      <div class="form-group col">
        <label for="descricao">Descricao</label>
      <input type="textarea" class="form-control" id="descricao" name="descricao" value="{{$evento->descricao}}" placeholder="Breve descrição sobre o evento">
      </div>
    </div>
    <div class="form row">
      <div class="form-group col">
        <label for="local">Local</label>
      <input type="text" class="form-control" id="local" name="local" value="{{$evento->local}}" placeholder="Local do evento">
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="data">Data</label>
      <input type="date" class="form-control" id="data" name="data" value="{{$evento->data}}" placeholder="Data do evento">
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="organizador">Organizador</label>
      <input type="text" class="form-control" id="organizador" name="organizador" value="{{$evento->organizador}}" placeholder="Organizador do evento">
      </div>
    </div>
    
    <button type="submit" class="btn btn-success btn-lg">Atualizar</button>
  </form>
</section>
@endsection

@section('rodape')
    <h2>Rodapé aqui</h2>
@endsection