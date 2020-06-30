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
                        <h3 class="text-center title-2">Crie aqui o modelo do certificado a ser utilizado no evento</h3>
                        <div class="row">
                            <div class="col-md-6">
                            <form class="form-inline mt-4" autocomplete="off" name="formTag"  id="form" data-action="{{route('tags.store')}}">
                                @csrf
                                    <div class="form-group">
                                        <label for="tag" class="mr-2">Tag</label>
                                        <input type="hidden" value="{{$evento->id}}" name="evento">
                                        <input type="text" class="form-control mr-2" name="tag" id="tag" placeholder="#nome">
                                        <button type="submit" class="btn btn-primary">Adicionar Tag</button>
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-6 mt-4">
								<p><strong>Lista de Tags</strong></p>
                                <ul id="lista">
                                </ul>
                            </div>
                        </div>

						<div class="row mt-5">
							<div class="col">
								<form action="{{route('modelo.certificado.store', ['evento' => $evento->id])}}" method="post">
									@csrf
									<label for=""></label>
									<textarea name="content" id="conteudo">Certificamos que #nome participou do evento #evento na data #data com carga horária de #carga</textarea>
									{{--Acicionar área de upload--}}
									<button type="submit" class="btn btn-primary mt-3 mr-2">Visualizar modelo</button>
									<button type="submit" class="btn btn-secondary mt-3">Salvar modelo</button>
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
