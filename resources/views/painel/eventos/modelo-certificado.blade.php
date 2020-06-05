@extends('layouts.dashboard-layout')

@section('conteudo')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col">
           <div class="card">
                <div class="card-header ">
                    <h2 class="title-1">Certificados</h2>
                </div>
                <div class="card-body card-block">
                    <div class="card-title">
                        <h3 class="text-center title-2">Crie aqui o modelo do certificado a ser utilizado no</h3>
                        <div class="row">
                            <div class="col">
                            <form class="form-inline mt-4" autocomplete="off" name="formTag"  id="form" data-action="{{route('tags.store')}}">
                                @csrf
                                    <div class="form-group">
                                        <label for="tag" class="mr-2">Tag</label>
                                        <input type="hidden" value="{{$evento->id}}" id="evento">
                                        <input type="text" class="form-control mr-2" name="tag" id="tag" placeholder="#nome">
                                        <button type="submit" class="btn btn-primary">Adicionar Tag</button>
                                    </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>
                </div>
           </div> 
        </div>
    </div>
</div>

@endsection