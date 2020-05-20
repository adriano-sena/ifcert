@extends('layouts/layout')

@section('titulo')
    <h1>Cadastro de Atividades</h1>
@endsection


{{route('eventos.atividades.store', session()->get('evento'))}}


@section('conteudo')
<section class="container">
  
{{session()->get('evento')}}


<form action="{{route('eventos.atividades.store', session()->get('evento'))}}" method="post">
  @csrf
    <div class="form-row">
      <div class="form-group col">
        <label for="titulo">Título</label>
      <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" placeholder="Titulo do atividade" value="{{old('titulo')}}">
        @error('titulo')
          <span class="invalid-feedback">
            {{$message}}
          </span>
        @enderror
      </div>
    </div>
    
    <div class="form row">
      <div class="form-group col">
        <label for="descricao">Descricao</label>
        <textarea cols="30" rols="10" class="form-control  @error('descricao') is-invalid @enderror"  id="descricao" name="descricao" placeholder="Breve descrição sobre a atividade" value="{{old('descricao')}}"></textarea>
          @error('descricao')
          <span class="invalid-feedback">
            {{$message}}
          </span>
        @enderror
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="mediador">Mediador</label>
        <input type="text" class="form-control  @error('mediador') is-invalid @enderror" id="mediador" name="mediador" placeholder="Mediador da Atividade" value="{{old('mediador')}}">
        @error('mediador')
        <span class="invalid-feedback">
          {{$message}}
        </span>
      @enderror
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="cargaHoraria">Carga Horaria</label>
        <input type="number" class="form-control  @error('cargaHoraria') is-invalid @enderror" id="cargaHoraria" name="cargaHoraria" placeholder="Carga Horária da atividade" value="{{old('cargaHoraria')}}">
        @error('cargaHoraria')
        <span class="invalid-feedback">
          {{$message}}
        </span>
      @enderror
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="qtd_vagas">Quantidade de vagas</label>
        <input type="number" class="form-control  @error('qtd_vagas') is-invalid @enderror" id="qtd_vagas" name="qtd_vagas" placeholder="Quantidade de vagas" value="{{old('qtd_vagas')}}">
        @error('qtd_vagas')
        <span class="invalid-feedback">
          {{$message}}
        </span>
        @enderror
      </div>
    </div>

    <div class="form row">
      <div class="form-group col">
        <label for="local">Local</label>
        <input type="text" class="form-control  @error('local') is-invalid @enderror" id="local" name="local" placeholder="Local do Atividade" value="{{old('local')}}">
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
        <input type="date" class="form-control  @error('data') is-invalid @enderror" id="data" name="data" placeholder="Data do evento" 
        value="{{old('data')}}">
        @error('data')
        <span class="invalid-feedback">
          {{$message}}
        </span>
        @enderror
      </div>
    </div>
    
    <button type="submit" class="btn btn-success btn-lg">Criar Atividade</button>
  </form>
</section>
@endsection

@section('rodape')
    <h2>Rodapé aqui</h2>
@endsection