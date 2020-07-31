@extends('layouts.dashboard-layout')


@section('conteudo')

	<div class="row">
		<div class="col-lg-10">
			<div class="user-data m-b-30">
				<h3 class="title-3 m-b-30">
					<i class="zmdi zmdi-account-calendar"></i>user data</h3>
				<div class="filters m-b-45">
					<div class="rs-select2--dark rs-select2--md m-r-10 rs-select2--border">
						<select class="js-select2" name="property">
							<option selected="selected">Inscritos</option>
							<option value="">Participantes</option>
						</select>
						<div class="dropDownSelect2"></div>
					</div>
				</div>
				<div class="table-responsive table-data">
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
						@foreach($inscritos as $inscrito)
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
							<td>
								<label class="au-checkbox">
									<input type="checkbox">
									<span class="au-checkmark"></span>
								</label>
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>
				</div>
				<div class="user-data__footer">
					<button class="au-btn au-btn-load">Gerar PDF - Lista de inscritos</button>
				</div>
			</div>
		</div>
	</div>
@endsection
