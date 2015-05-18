@extends('templates.layout_tienda')

@section('contenido')
	
	<div class="container">
		<div class="row">	
			<div class="navbar navbar-default hidden-lg hidden-md hidden-sm">
				<div class="container-fluid">
					<center>
						<h4>Iniciar Sesión | Registrarse</h4>
					</center>
				</div>
			</div>

			<div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
				<center>
					<h4>Iniciar Sesión | Registrarse</h4>
				</center>
			</div>
		</div>
	

		<div class="row">
		
			<div class="container">

				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h5><b>Inicia Sesión</b></h5>	
						</div>
						<div class="panel-body">
							{{ Form::open(['url' => '/login']) }}
								<div class="modal-body">									
									
									@if(Session::get('error'))
										<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert">&times;</button>
										  	<strong><i class="fa fa-ban"></i></strong> Los datos de acceso son incorrectos !!
										</div>
									@endif

									<div class="form-group">
										<label for="">Email</label>
										<input type="email" class="form-control" name="email" placeholder="Ingresa tu email" required>
									</div>
									<div class="form-group">
										<label for="">Contraseña</label>
										<input type="password" class="form-control" name="password" placeholder="Ingresa tu contraseña" required>
									</div>
									<div class="form-group">
										<a href="">¿Olvidaste tu contraseña?</a>
									</div>
								</div>
								<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-sign-in"></i> Iniciar</button>
							{{ Form::close() }}
						</div>
					</div>
				</div>
			
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h5><b>Registro</b></h5>	
						</div>
						<div class="panel-body">
							
							{{ Form::open(['id'=>'agregarCliente']) }}
								<div class="modal-body">
										<div class="row">
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
												<div id="alerta2"></div>
												<div class="form-group">
													<label for="email" class="control-label">*Email</label>
													<input type="email" id="email" name="email" class="form-control">
												</div>
											</div>
											<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
												<div class="form-group">
													<label for="nombre" class="control-label">*Nombre</label>
													<input type="text" id="nombre" name="nombre" class="form-control">
												</div>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
												<div class="form-group">
													<label for="ap_paterno" class="control-label">*Apellido Paterno</label>
													<input type="text" id="ap_paterno" name="ap_paterno" class="form-control">
												</div>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
												<div class="form-group">
													<label for="ap_materno" class="control-label">Apellido Materno</label>
													<input type="text" id="ap_materno" name="ap_materno" class="form-control">
												</div>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
												<div class="form-group">
													<label for="password" class="control-label">*Contraseña</label>
													<input type="password" id="password" name="password" class="form-control">
												</div>
											</div>
											<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
												<div class="form-group">
													<label for="c_password" class="control-label">*Confirma Contraseña</label>
													<input type="password" id="c_password" name="c_password" class="form-control">
												</div>
											</div>
											<div class="form-group check-modal">
												<label for="">
													<input type="checkbox" id="check_ok" name="check_ok">&nbsp;He leido y acepto los términos de aviso de privacidad.
													<a href="#">Leer</a>
												</label>
											</div>
											<div class="form-group">
												
											</div>
										</div>
										<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-pencil-square-o"></i> Registrar</button>
								</div>
							{{ Form::close() }}

						</div>
					</div>
				</div>
			
			</div>
	
		</div> 
	</div>

<script type="text/javascript">

	$(function(){

		var mensajeTrue = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><i class="fa fa-check-circle"></i></strong> Tu cuenta ha sido creada correctamente, ahora inicia sesion en Muebleria Ureña.</div>';

		var mensajeFalse = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><i class="fa fa-times"></i></strong> Algo ha salido mal, intentalo nuevamente.</div>';
		
		var registro = $('#agregarCliente').validate({
			errorElement: "span",
			errorClass: "help-block",
			rules: {
				email: 		{ required: true, email: true },
				nombre: 	{ required: true, minlength: 3 },
				ap_paterno: { required: true, minlength: 3 },
				password: 	{ required: true },
				c_password: { required: true, equalTo: "#password"},
				check_ok: 	{ required: true }
			},
			highlight: function(element, error) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			success: function(element) {
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			},
			submitHandler: function() {
				var data = $('#agregarCliente').serialize();
				
				$.ajax({
					type: 	"post",
					url	: 	"/registrar-usuario",
					data: 	data,
					success: function(response){
						if(response){

							$("#alerta2").html(mensajeTrue);
							$('#agregarCliente')[0].reset();
						}else{
							$("#alerta2").html(mensajeFalse);
						}
					}
				});
			}
		});

	});
</script>

@stop