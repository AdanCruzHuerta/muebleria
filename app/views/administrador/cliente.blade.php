@extends('templates.layout_administrador')

@section('contenido')

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h2><i class="fa fa-users"></i> Clientes</h2>
			<ol class="breadcrumb breadcrumb-arrow">
				<li><a href="/administrador">Home</a></li>
				<li><a href="/administrador/clientes">Clientes</a></li>
				<li  class="active"><span>Detalle de cliente</span></li>
			</ol>
		</div>
	</div>
	
	<div class="row">

		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
    				<center>
    					<h3 class="panel-title">
    						Datos del Cliente
    					</h3>
    				</center>
  				</div>
			  	<div class="panel-body">
			  		<table class="table table-bordered">
						<tr>
							<td> <center>{{ $cliente->nombre." ".$cliente->apellido_p." ".$cliente->apellido_m }}</center></td>
							<td><center> {{ $cliente->email }} </center></td>
						</tr>
						<tr>
							<td><center>Sin estado</center></td>
							<td><center>Sin municipio</center></td>
							<td><center> @if( !$cliente->ciudad ) Sin ciudad @else {{ $cliente->ciudad }} @endif </center></td>
						</tr>
						<tr>
							<td><center>@if( !$cliente->codigo_postal ) Sin código postal @else {{ $cliente->codigo_postal }} @endif</center></td>
							<td><center>@if( !$cliente->calle ) Sin calle @else {{ $cliente->calle }} @endif</center></td>
							<td><center></center></td>
						</tr>
					</table>
			  	</div>
			</div>
		</div>
			
	</div>	

@stop