@extends('tienda.perfilCliente')

@section('contenido_perfil')
	
	<div class="form-group">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    		<label>Nombre</label>
    		<input type="text" class="form-control" readonly value="{{ $dataCliente->nombre }}">
  		</div><br><br><br>
  	</div>

	<div class="form-group">
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<label>Apellido Paterno</label>
	    	<input type="text" class="form-control" readonly value="{{ $dataCliente->apellido_p }}">	
		</div>
    	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
			<label>Apellido Materno</label>
	    	<input type="text" class="form-control" readonly value="{{ $dataCliente->apellido_m }}">	
		</div><br><br><br>
  	</div>

  	<div class="form-group">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    		<label>Email</label>
    		<input type="email" class="form-control" readonly value="{{ $dataCliente->email }}">
  		</div><br><br><br>
  	</div>
@stop