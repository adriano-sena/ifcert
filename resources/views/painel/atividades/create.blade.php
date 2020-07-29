@extends('layouts.dashboard-layout')


@section('conteudo')
    <div class="container-fluid">
        <div class="row  justify-content-center">
            <div class="col-md-10 col-sm-12">
                <div class="card w-75 ">
                    <div class="card-header p-4">
                        <h2 class="title-1"> <strong>Atividades</strong> </h2>
                    </div>
                    <div class="card-body card-block">
                        <div class="card-title">
                            <h3 class="text-center title-2">Crie as atividades do Evento</h3>
                        </div>

                        <form method="POST" action="{{route('admin.eventos.atividades.store', session()->get('evento'))}}">
                            @csrf
                            <div class="form-group">
                                <label for="titulo" class="control-label mb-1">Titulo</label>
                                <input type="text"  class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo"  value="{{old('titulo')}}" required>
                                @error('titulo')
                                    <span class="invalid-feedback">
                                    {{$message}}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="descricao" class="control-label mb-1">Descricao</label>
                            <input type="text"  class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" value="{{old('descricao')}}" required>
                                @error('descricao')
                                    <span class="invalid-feedback">
                                    {{$message}}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="mediador" class="control-label mb-1">Mediador</label>
                            <input type="text"  class="form-control @error('mediador') is-invalid @enderror" id="mediador" name="mediador" value="{{old('mediador')}}"required>
                                @error('mediador')
                                    <span class="invalid-feedback">
                                    {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="cargaHoraria" class="control-label mb-1">Carga Horária</label>
                            <input type="number"  class="form-control @error('cargaHoraria') is-invalid @enderror" id="cargaHoraria" name="cargaHoraria"value="{{old('cargaHoraria')}}" required>
                                @error('cargaHoraria')
                                    <span class="invalid-feedback">
                                    {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="vagas" class="control-label mb-1">Quantidade de vagas</label>
                            <input type="number"  class="form-control @error('vagas') is-invalid @enderror" id="vagas" name="vagas" value="{{old('vagas')}}" required>
                                @error('vagas')
                                    <span class="invalid-feedback">
                                    {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="local" class="control-label mb-1">Local</label>
                            <input type="text"  class="form-control @error('local') is-invalid @enderror" id="local" name="local"  value="{{old('local')}}" required>
                                @error('local')
                                    <span class="invalid-feedback">
                                    {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="titulo" class="control-label mb-1">Data</label>
                            <input type="date"  class="form-control @error('data') is-invalid @enderror" id="data" name="data" value="{{old('data')}}" required>
                                @error('data')
                                    <span class="invalid-feedback">
                                    {{$message}}
                                    </span>
                                @enderror
                            </div>


                            <div>
                                <button class="btn btn-lg btn-info btn-block">Criar Atividade</button>
                            </div>
                        </form>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
