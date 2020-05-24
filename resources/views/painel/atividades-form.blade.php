@extends('layout')


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

                        <form action="POST">

                            <div class="form-group">
                                <label for="titulo" class="control-label mb-1">Titulo</label>
                                <input type="text"  class="form-control" id="titulo" name="titulo" required>
                            </div>
                            <div class="form-group">
                                <label for="titulo" class="control-label mb-1">Titulo</label>
                                <input type="text"  class="form-control" id="titulo" name="titulo" required>
                            </div>
                            <div class="form-group">
                                <label for="titulo" class="control-label mb-1">Titulo</label>
                                <input type="text"  class="form-control" id="titulo" name="titulo" required>
                            </div>
                            <div class="form-group">
                                <label for="titulo" class="control-label mb-1">Titulo</label>
                                <input type="text"  class="form-control" id="titulo" name="titulo" required>
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