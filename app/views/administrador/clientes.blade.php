@extends('templates.layout_administrador')

@section('contenido')
		
{{ HTML::style('css/dataTables.bootstrap.css') }}
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h2><i class="fa fa-users"></i> Clientes</h2>
			<ol class="breadcrumb breadcrumb-arrow">
				<li><a href="/administrador">Home</a></li>
				<li  class="active"><span>Clientes</span></li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th><center>Nombre</center></th>
								<th><center>Email</center></th>
								<th><center>Telefono</center></th>
								<th><center>Opciones</center></th>
							</tr>
						</thead>
						<tbody>
							@foreach($clientes as $cliente)
							<tr>
								<td>{{ $cliente->nombre." ".$cliente->apellido_p." ".$cliente->apellido_m }}</td>
								<td>{{ $cliente->email }}</td>
								<td>{{ $cliente->telefono }} </td>
								<td>
									<center>
										<a href="/administrador/clientes/show/{{$cliente->id}}" title="Ver detalles" class="opciones-fletera"><i class="fa fa-pencil-square-o"></i></a>
									</center>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	{{ HTML::script('js/dataTables.min.js') }}
	
	{{ HTML::script('js/dataTables.bootstrap.js') }}

	<script>
		$(document).ready(function(){
			$('.table').dataTable();
		});
	</script>

@stop