@extends('tienda.perfilCliente')

@section('contenido_perfil')

<div id="alerta"></div>

{{ Form::open(['url'=>'/cliente/perfil/save-direccion','id'=>'form-user-direccion']) }}

	<div class="row">

		<div class="form-group">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	    		<label>Teléfono</label>
	    		<input type="text" class="form-control" id="telefono" name="telefono" value="{{{ $dataPersona->telefono or '' }}}" placeholder="Ingresa número de teléfono">
	  		</div>

			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	    		<label>Código Postal</label>
	    		<input type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="{{{ $dataPersona->codigo_postal or '' }}}" placeholder="Ingresa código postal">
	  		</div>

	  		<br><br><br>
	  	</div>

	  	<div class="form-group">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	    		<label>Estado</label>
	    		<select name="estado" id="estado" class="form-control">
	    			<option value="">Selecciona un estado</option>
	    		@foreach($estados as $estado)
					<option @if($dataPersona->estado_id == $estado->id ) {{ "selected = 'selected'" }} @endif value="{{ $estado->id }}">{{ $estado->nombre }}</option>
	    		@endforeach
	    		</select>
	  		</div>

			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	    		<label>Municipio</label>
	    		<select name="municipio" id="municipio" class="form-control" class="form-control">
	    			<option value="">Selecciona un municipio</option>
	    			@foreach($municipios as $municipio)
					<option value="{{ $municipio->id }}">{{ $municipio->nombre }}</option>
	    			@endforeach
	    		</select>
	  		</div>

	  		<br><br><br>
	  	</div>

		<div class="form-group">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	    		<label>Ciudad</label>
	    		<input type="text" class="form-control" id="ciudad" name="ciudad" value="{{{ $dataPersona->ciudad or '' }}}" placeholder="Ingresa ciudad">
	  		</div>

			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	    		<label>Calle</label> 
	    		<input type="text" class="form-control" id="calle" name="calle" value="{{{ $dataPersona->calle or '' }}}" placeholder="Ingresa calle">
	  		</div>

	  		<br><br><br>
	  	</div>

	  	<div class="form-group">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	    		<label>Número int.</label>
	    		<input type="text" class="form-control" id="numero_int" name="numero_int" value="{{{ $dataPersona->numero_int or '' }}}" placeholder="(opcional)">
	  		</div>

			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
	    		<label>Número ext.</label>
	    		<input type="text" class="form-control" id="numero_ext" name="numero_ext" value="{{{ $dataPersona->numero_ext or '' }}}" placeholder="Ingresa número exterior">
	  		</div>
	  		<br><br><br>
	  	</div>
	  	<div class="form-group">
			<label class="col-xs-12 col-sm-12 col-md-6 col-lg-6 control-label">
				Seleccione el horario preferente de entrega:
			</label>
		    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
		    	<select name="horario" id="horario" class="form-control">
		    		<option value="">Selecciona Horario</option>
		    		<option @if($dataPersona->horario_entrega == 1) {{ "selected = 'selected'" }} @endif value="1" >De 8 am a 12 pm</option>
		    		<option @if($dataPersona->horario_entrega == 2) {{ "selected = 'selected'" }} @endif value="2" >De 12 pm a 3 pm</option>
		    		<option @if($dataPersona->horario_entrega == 3) {{ "selected = 'selected'" }} @endif value="3" >De 3 pm a 5 pm</option>
		    		<option @if($dataPersona->horario_entrega == 4) {{ "selected = 'selected'" }} @endif value="4" >De 5 pm a 8 pm</option>
		    	</select>
		    </div>
		 </div>
	</div>
	<br><br>
	
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<input type="hidden" name="id_usuario" value="{{ $dataCliente->id }}">
			<button class="btn btn-primary pull-right" type="submit"><i class="fa fa-floppy-o"></i> Guardar</button>
		</div>
	</div>

{{ Form::close() }}

<script type="text/javascript">
		
	$(function(){

		var estado = $('#estado').val();

		$.ajax({
			type: "POST",
			url: "/administrador/pagina/municipios",
			data:{estado:estado},
			success: function(res){
				var cadena = '';
				for(var i = 0; i<res.length;i++){
					cadena += '<option value="'+res[i].id+'" >'+res[i].nombre+'</option>';
				}
				$('#municipio').html(cadena);
				$('#municipio option[value="{{ $dataPersona->municipio_id }}"]').attr("selected",true);
			}
		});

		$('#estado').change(function(){
			var estado = $(this).val();
			$.ajax({
				type: "POST",
				url: "/administrador/pagina/municipios",
				data:{estado:estado},
				success: function(response){
					var cadena = '<option value="">Selecciona Municipio</option>';
					for(var i = 0; i < response.length; i++){
						cadena += '<option value="'+response[i].id+'">'+response[i].nombre+'</option>';
					}
					$('#municipio').html(cadena);
				}
			});
		});

		var validacion = $('#form-user-direccion').validate({
			errorElement: "span",
			errorClass: "help-block",
			rules: {
				ciudad: 		{ required: true, minlength: 3 },
				calle: 			{ required: true, minlength: 3 },
				numero_ext: 	{ required: true },
				telefono: 		{ required: true, minlength: 3 },
				codigo_postal: 	{ required: true, minlength: 5, maxlength: 5 },
				estado: 		{ required: true },
				municipio: 		{ required: true }
			},
			highlight: function(element, error) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			success: function(element) {
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			},
			submitHandler: function() {
				$('#form-user-direccion').submit();
			}
		});
	});

</script>

@stop