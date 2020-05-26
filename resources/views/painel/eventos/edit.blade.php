@extends('layouts.dashboard-layout')


@section('conteudo')
    <div class="container-fluid">
        <div class="row  justify-content-center">
            <div class="col-md-10 col-sm-12">
                <div class="card w-75 ">
                    <div class="card-header p-4">
                        <h2 class="title-1"> <strong>Eventos</strong> </h2>
                    </div>
                    <div class="card-body card-block">
                        <div class="card-title">
                            <h3 class="text-center title-2">Crie seus eventos</h3>
                        </div>

                        <form method="POST" action="{{route('eventos.update', $evento->id)}}">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <label for="titulo" class="control-label mb-1">Titulo</label>
                            <input type="text"  class="form-control @error('titulo') is-invalid @enderror" id="titulo" name="titulo" value="{{$evento->titulo}}" required>
                                @error('titulo')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="subTitulo" class="control-label mb-1">Sub Titulo</label>
                                <input type="text"  class="form-control @error('subTitulo') is-invalid @enderror" id="subTitulo" name="subTitulo" value="{{$evento->subTitulo}}" required>
                                @error('subTitulo')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="descricao" class="control-label mb-1">Descricao</label>
                                <input type="text"  class="form-control @error('descricao') is-invalid @enderror" id="descricao" name="descricao" value="{{$evento->descricao}}"required>
                                @error('descricao')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="local" class="control-label mb-1">Local </label>
                                <input type="text"  class="form-control @error('local') is-invalid @enderror"  id="local" name="local" value="{{$evento->local}}" required>
                                @error('local')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="data_inicio" class="control-label mb-1">Data de Inicio</label>
                                <input type="date"  class="form-control @error('data_inicio') is-invalid @enderror"  id="data_inicio" name="data_inicio" value="{{$evento->data_incio}}" required>
                                @error('data_inicio')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="data_inicio" class="control-label mb-1">Data Fim </label>
                                <input type="date"  class="form-control @error('data_fim') is-invalid @enderror"  id="data_fim" name="data_fim"  value="{{$evento->data_fim}}"required>
                                @error('data_fim')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="organizador" class="control-label mb-1">Organizador</label>
                                <input type="text"  class="form-control @error('organizador') is-invalid @enderror"  id="organizador" name="organizador" value="{{$evento->organizador}}"required>
                                @error('organizador')
                                    <span class="invalid-feedback">
                                        {{$message}}
                                    </span>
                                @enderror
                            </div>

                            {{-- <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" name="imagem" id="imagem" aria-describedby="inputGroupFileAddon01">
                                  <label class="custom-file-label" for="imagem">Escolha a imagem</label>
                                </div>
                              </div> --}}

                              <div>
                                <button type="submit" class="btn btn-lg btn-info btn-block">Atualizar Evento</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection