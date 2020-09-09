@extends('layouts.dashboard-layout')


@section('conteudo')

	<div class="row">
		<div class="col-lg-10">
			<div class="user-data m-b-30">
				<h3 class="title-3 m-b-30">
					<i class="zmdi zmdi-account-calendar"></i>Lista de Participantes</h3>
				<div class="filters m-b-45">
				</div>
				<div class="table-responsive table-data">
					<form method="post" action="{{route('admin.atividades.certificados.emite', ['atividade' => $atividade])}}">
						@csrf
					<table class="table">
						<thead>
						<tr>
							<td>id</td>
							<td>nome</td>
							<td>participou?</td>
						</tr>
						</thead>
						<tbody>
						@foreach($participantes as $participante)
						<tr>
							<td>
								<div class="table-data__info">
									<span>
										{{$participante->id}}
									</span>
								</div>
							</td>
							<td>
								<div class="table-data__info">
									<h6>{{$participante->name}}</h6>
									<span>
										{{$participante->email}}
									</span>
								</div>
							</td>
							<td class="text-align">
								@if(!$participante->pivot->participou)
									<label class="au-checkbox">
										<input type="checkbox" name="participantes[]" value="{{$inscrito->id}}"
											{{$participante->pivot->participou ? "checked" : " "}}>
										<span class="au-checkmark"></span>
									</label>
								@endif
								@if($participante->pivot->participou)
								<a href="{{route('admin.atividades.inscritos.remove', ['inscrito' => $participante->id , 'atividade' => $atividade])}}" class="btn btn-danger">
									Remover
								</a>
								@endif
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>
					<div class="user-data__footer">
						<button class="btn btn-success" type="submit">
							<i class="far fa-save"></i>
							Emitir Certificados
						</button>
					</div>
					</form>
				</div>

			</div>
		</div>
	</div>
@endsection

@section('scripts')


@endsection
