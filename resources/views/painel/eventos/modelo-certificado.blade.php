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

					@include('flash::message')

					<div class="card-title">
                        <h3 class="text-center title-2">Crie aqui o modelo do certificado a ser utilizado no evento</h3>
                        <div class="row">
                            <div class="col-md-6">
                            <form class="form-inline mt-4" autocomplete="off" name="formTag"  id="form" data-action="{{route('admin.tags.store')}}">
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
								<form action="{{route('admin.modelo.certificado.store', ['evento' => $evento->id])}}" method="post" enctype="multipart/form-data">
									@csrf
									<label for=""></label>
									<textarea name="content" id="conteudo" rows="25">
										@if(isset($certificado)){{strip_tags($certificado->texto)}}
										@else
											Certificamos que #nome participou do evento #evento na data #data com carga horária de #carga
										@endif
									</textarea>
									{{--Acicionar área de upload--}}
									<div class="input-group mb-3 mt-3">
										<div class="input-group-prepend">
											<span class="input-group-text" id="inputGroupFileAddon01">Carregar Imagem</span>
										</div>
										<div class="custom-file">
											<input type="file" class="custom-file-input" name="imagem" id="imagem" aria-describedby="inputGroupFileAddon01">
											<label class="custom-file-label" for="imagem">Escolha a imagem</label>
										</div>
									</div>
									<button type="submit" class="btn btn-primary mt-3">Salvar modelo</button>
								</form>

								<form action="{{ route('admin.modelo.certificado.show' , ['evento' => $evento->id])}}" method="get">
									<button type="submit" class="btn btn-success mt-3">Visualizar modelo</button>
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
