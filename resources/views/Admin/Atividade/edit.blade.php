@extends('layouts/layout')

@section('titulo')
    <h1>Cadastro de Atividades</h1>
@endsection


@section('conteudo')
<section class="container">
<form action="/admin/atividades/edit{{$atividade->id}}" method="POST">
  @csrf
    <div class="form-row">
      <div class="form-group col">
        <label for="titulo">Título</label>
      <input type="text" class="form-control" id="titulo" name="titulo" value="{{$atividade->titulo}}" placeholder="Titulo do atividade">
      </div>
    </div>
    <div class="form row">
      <div class="form-group col">
        <label for="subTitulo">Subtitulo</label>
        <input type="text" class="form-control" id="subTitulo" name="subTitulo" value="{{$atividade->subTitulo}}" placeholder="Subtitulo da Atividade">
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="descricao">Descricao</label>
        <input type="textarea" cols="30" rols="10" class="form-control" id="descricao" name="descricao" value="{{$atividade->descricao}}" placeholder="Breve descrição sobre a atividade">
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="mediador">Mediador</label>
        <input type="text" class="form-control" id="mediador" name="mediador" value="{{$atividade->mediador}}" placeholder="Mediador da Atividade">
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="cargaHoraria">Carga Horaria</label>
        <input type="number" class="form-control" id="cargaHoraria" name="cargaHoraria" value="{{$atividade->cargaHoraria}}"placeholder="Carga Horária da atividade">
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="local">Local</label>
        <input type="text" class="form-control" id="local" name="local" value="{{$atividade->local}}" placeholder="Local do Atividade">
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="data">Data</label>
        <input type="date" class="form-control" id="data" name="data" value="{{$atividade->data}}" placeholder="Data do evento">
      </div>
    </div>
    
    <button type="submit" class="btn btn-success btn-lg">Editar Atividade</button>
  </form>
</section>
@endsection

@section('rodape')
    <h2>Rodapé aqui</h2>
@endsection