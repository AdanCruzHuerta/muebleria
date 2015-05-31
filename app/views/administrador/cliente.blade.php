@extends('templates.layout_administrador')

@section('contenido')

<style>
	.completo{
		background: #46A546;
		padding: 3px;
		border-radius: 3px;
		color:#fff;
		font-weight: bold;
	}
	.incompleto{
		background: #C43C35;
		padding: 3px;
		border-radius: 3px;
		color:#fff;
		font-weight: bold;
	}
</style>

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
			  		<table class="table table-striped">
						<tr>
							<td>
								<center>
									<label>Foto</label><br>
									<img src="{{ $cliente->photo_user }}" class="img-thumbnail">
								</center>
							</td>
							<td>
								<center>
									<label>Nombre</label><br>
									{{ $cliente->nombre." ".$cliente->apellido_p." ".$cliente->apellido_m }}
								</center>
							</td>
							<td>
								<center>
									<label>Estatus</label><br>
										<span @if($cliente->status == 0) {{ 'class="incompleto"' }} @else {{ 'class="completo"' }} @endif>
											@if($cliente->status == 0){{ 'Incompleto' }} @else  {{ 'Completo' }}  @endif	
										</span>
								</center>
							</td>
						</tr>
						<tr>
							<td>
								<center>
									<label>Teléfono</label><br>
									@if(!$cliente->telefono) {{ '-' }}@else{{ $cliente->telefono }} @endif
								</center>
							</td>
							<td>
								<center>
									<label>Correo eléctronico</label><br>
									{{ $cliente->email }}
								</center>
							</td>
							<td>
								<center>
									<label>Estado</label><br>
									{{{ $cliente->estado or '-' }}}
								</center>
							</td>
						</tr>
						<tr>
							<td>
								<center>
									<label>Municipio</label><br>
									{{{ $cliente->municipio or '-' }}}
								</center>
							</td>
							<td>
								<center>
									<label>Ciudad</label><br>
									@if(!$cliente->ciudad) {{ '-' }} @else {{ $cliente->ciudad }} @endif
								</center>
							</td>
							<td>
								<center>
									<label>Código Postal</label><br>
									@if(!$cliente->codigo_postal) {{ '-' }} @else {{ $cliente->codigo_postal }} @endif
								</center>
							</td>
						</tr>
						<tr>
							
							<td>
								<center>
									<label>Calle</label><br>
									@if(!$cliente->calle) {{ '-' }} @else {{ $cliente->calle }} @endif
								</center>
							</td>
							<td>
								<center>
									<label>Numero ext</label><br>
									@if(!$cliente->numero_ext) {{ '-' }} @else {{ $cliente->numero_ext }} @endif
								</center>
							</td>
							<td>
								<center>
									<label>Número int</label><br>
									@if(!$cliente->numero_int) {{ '-' }} @else {{ $cliente->numero_int }} @endif
								</center>
							</td>
						</tr>
					</table>
			  	</div>
			</div>
		</div>
			
	</div>	

@stop