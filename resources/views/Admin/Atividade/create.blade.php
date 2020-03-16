@extends('layouts/layout')

@section('titulo')
    <h1>Cadastro de Atividades</h1>
@endsection


@section('conteudo')
<section class="container">
<form action="/admin/atividades/{{$evento->id}}/create" method="POST">
  @csrf
    <div class="form-row">
      <div class="form-group col">
        <label for="titulo">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo do atividade">
      </div>
    </div>
    <div class="form row">
      <div class="form-group col">
        <label for="subTitulo">Subtitulo</label>
        <input type="text" class="form-control" id="subTitulo" name="subTitulo" placeholder="Subtitulo da Atividade">
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="descricao">Descricao</label>
        <input type="textarea" cols="30" rols="10" class="form-control" id="descricao" name="descricao" placeholder="Breve descrição sobre a atividade">
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="mediador">Mediador</label>
        <input type="text" class="form-control" id="mediador" name="mediador" placeholder="Mediador da Atividade">
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="cargaHoraria">Carga Horaria</label>
        <input type="number" class="form-control" id="cargaHoraria" name="cargaHoraria" placeholder="Carga Horária da atividade">
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="local">Local</label>
        <input type="text" class="form-control" id="local" name="local" placeholder="Local do Atividade">
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="data">Data</label>
        <input type="date" class="form-control" id="data" name="data" placeholder="Data do evento">
      </div>
    </div>
    
    <button type="submit" class="btn btn-success btn-lg">Criar Atividade</button>
  </form>
</section>
@endsection

@section('rodape')
    <h2>Rodapé aqui</h2>
@endsection