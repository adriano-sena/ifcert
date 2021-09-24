@extends('layouts.dashboard-layout')


@section('conteudo')

	<div class="row">
		<div class="col-lg-10">
			<div class="user-data m-b-30">
				<h3 class="title-3 m-b-30">
					<i class="zmdi zmdi-account-calendar"></i>Lista de usuários</h3>
				<div class="filters m-b-45">
				</div>
				<div class="table-responsive table-data">
					<form method="post" action="{{route('admin.usuarios.lista.moderadores')}}">
						@csrf
					<table class="table">
						<thead>
						<tr>
							<td>id</td>
							<td>nome</td>
							<td>cpf</td>
							<td>moderador</td>
						</tr>
						</thead>
						<tbody>
						@foreach($usuarios as $user)
						<tr>
							<td>
								<div class="table-data__info">
									<span>
										{{$user->id}}
									</span>
								</div>
							</td>
							<td>
								<div class="table-data__info">
									<h6>{{$user->name}}</h6>
									<span>
										{{$user->email}}
									</span>
								</div>
							</td>
							<td>
								<div class="table-data__info">
									<span>
										{{$user->cpf}}
									</span>
								</div>
							</td>
							<td class="text-align">
								@if(!$user->hasRole('moderador'))
									<label class="au-checkbox">
										<input type="checkbox" name="usuarios[]" value="{{$user->id}}"
											{{$user->hasRole('moderador') ? "checked" : " "}}>
										<span class="au-checkmark"></span>
									</label>
								@endif
								@if($user->hasRole('moderador'))
								<a href="{{route('admin.usuarios.moderador.delete', ['moderador' => $user->id])}}" class="btn btn-danger">
									Remover moderação
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
							Registrar Moderadores
						</button>
					</div>
					</form>
				</div>

			</div>
		</div>
	</div>
@endsection
