@extends('layouts.dashboard-layout')


@section('conteudo')

	<div class="row">
		<div class="col-lg-10">
			<div class="user-data m-b-30">
				<h3 class="title-3 m-b-30">
					<i class="zmdi zmdi-account-calendar"></i>Lista de Inscritos</h3>
				<div class="filters m-b-45">
				</div>
				<div class="user-data__footer">
{{--					<button class="au-btn au-btn-load">Gerar PDF - Lista de inscritos</button>--}}
					<a href="{{route('admin.atividades.lista.pdf', $atividade->id)}}" class="btn btn-primary">
						Gerar PDF - Lista de Inscritos
					</a>
				</div>
				<div class="table-responsive table-data">
					<form method="post" action="{{route('admin.atividades.inscritos.registra', ['atividade' => $atividade])}}">
						@csrf
					<table class="table">
						<thead>
						<tr>
							<td>id</td>
							<td>nome</td>
							<td>cpf</td>
							<td>participou?</td>
						</tr>
						</thead>
						<tbody>
						@foreach($atividade->users as $inscrito)
						<tr>
							<td>
								<div class="table-data__info">
									<span>
										{{$inscrito->id}}
									</span>
								</div>
							</td>
							<td>
								<div class="table-data__info">
									<h6>{{$inscrito->name}}</h6>
									<span>
										{{$inscrito->email}}
									</span>
								</div>
							</td>
							<td>
								<div class="table-data__info">
									<span>
										{{$inscrito->cpf}}
									</span>
								</div>
							</td>
							<td class="text-align">
								@if(!$inscrito->pivot->participou)
									<label class="au-checkbox">
										<input type="checkbox" name="participantes[]" value="{{$inscrito->id}}"
											{{$inscrito->pivot->participou ? "checked" : " "}}>
										<span class="au-checkmark"></span>
									</label>
								@endif
								@if($inscrito->pivot->participou)
								<a href="{{route('admin.atividades.inscritos.remove', ['inscrito' => $inscrito->id , 'atividade' => $atividade])}}" class="btn btn-danger">
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
							Registrar participantes
						</button>
					</div>
					</form>
				</div>

			</div>
		</div>
	</div>
@endsection
