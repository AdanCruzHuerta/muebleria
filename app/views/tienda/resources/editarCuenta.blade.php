@extends('tienda.perfilCliente')

@section('contenido_perfil')

<style type="text/css">#cambiar-password{display: none;}</style>
<div id="alerta"></div>
{{ Form::open(['id'=>'form-user-perfil']) }}
	<div class="row">
		<div class="form-group">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    		<label>Nombre</label>
	    		<input type="text" class="form-control" id="nombre" name="nombre" value="{{ $dataCliente->nombre }}">
	  		</div><br><br><br>
	  	</div>

		<div class="form-group">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<label>Apellido Paterno</label>
		    	<input type="text" class="form-control" id="apellido_p" name="apellido_p" value="{{ $dataCliente->apellido_p }}">	
			</div>
	    	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<label>Apellido Materno</label>
		    	<input type="text" class="form-control" id="apellido_m" name="apellido_m" value="{{ $dataCliente->apellido_m }}">	
			</div><br><br><br>
	  	</div>

	  	<div class="form-group">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	    		<label>Email</label>
	    		<input type="email" class="form-control" id="email" name="email" value="{{ $dataCliente->email }}" readonly />
	  		</div><br><br><br>
	  	</div>

		<div class="form-group">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h4>	
				 	<input type="checkbox" id="cambiar_password" value="">
					Cambiar contraseña
				</h4><hr>
			</div>
			<div id="cambiar-password">
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<label>Nueva contraseña</label>
			    	<input type="password" id="password" name="password" class="form-control">	
				</div>
		    	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<label>Repetir contraseña</label>
			    	<input type="password" id="c_password" name="c_password" class="form-control">	
				</div>
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

		$('#cambiar_password').change(function() {
        	if($(this).is(":checked"))
        	{	
        		$('#cambiar-password').show();
        	}
        	else
        	{
        		$('#password').val('');
        		$('#c_password').val('');
        		$('#cambiar-password').hide();
        	}
        });

		var validacion = $('#form-user-perfil').validate({
			errorElement: "span",
			errorClass: "help-block",
			rules: {
				email: 		{ required: true, email: true },
				nombre: 	{ required: true, minlength: 3 },
				apellido_p: { required: true, minlength: 3 },
				password:   { required:true },
				c_password: { equalTo: "#password"}
			},
			highlight: function(element, error) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			success: function(element) {
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			},
			submitHandler: function() {
				$.ajax({
					method: 'post',
					url: "/cliente/perfil/save",
					data: $('#form-user-perfil').serialize(),
					success: function(response)
					{
						if(response)
						{
							$("#alerta").html('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>¡Exito!</strong> Los datos del usuario han sido guardados.</div>');
						}
					} 
				});
			}
		});
	});

</script>
@stop