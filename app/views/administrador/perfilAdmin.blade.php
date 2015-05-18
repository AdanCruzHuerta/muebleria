@extends('templates.layout_administrador')

@section('contenido')

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h2><i class="fa fa-user"></i> Administrador</h2>
			<ol class="breadcrumb breadcrumb-arrow">
				<li><a href="/administrador">Home</a></li>
				<li class="active"><span>Perfil</span></li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
			<form id="form-perfil" action="/admin/perfil/update" method="post" enctype="multipart/form-data">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xs-offset-4 col-sm-offset-5 col-md-offset-0">
							<div class="media-left thumbnail">
								<img src="{{ $administrador->photo_user }}" class="img-responsive refresh-img">
								<a href="#" id="file-select" class="btn btn-default">Elegir imagen</a>

								<input id="file" name="file" type="file"/>
							</div>
							<div class="alert alert-danger alert-dismissable error-img-perfil">
								No válido <i class="fa fa-times"></i>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<div class="form-horizontal">
									<div class="form-group">
										<label for="nombre" class="control-label col-sm-4">Nombre</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="nombre" id="nombre" value="{{ $administrador->nombre }}" />
										</div>
									</div>

									<div class="form-group">
										<label for="nombre" class="control-label col-sm-4">Apellido paterno</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="apellido_p" id="apellido_p" value="{{ $administrador->apellido_p }}" />
										</div>
									</div>

									<div class="form-group">
										<label for="nombre" class="control-label col-sm-4">Apellido materno</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="apellido_m" id="apellido_m" value="{{ $administrador->apellido_m }}" />
										</div>
									</div>

									<div class="form-group">
										<label for="nombre" class="control-label col-sm-4">Teléfono</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="telefono" id="telefono" value="{{ $administrador->telefono }}" />
										</div>
									</div>

									<div class="form-group">
										<label for="nombre" class="control-label col-sm-4">Email</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="email" id="email" value="{{ $administrador->email }}" disabled/>
										</div>
									</div>

									<div class="form-group">
										<label for="nombre" class="control-label col-sm-4">Tipo</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" name="tipo" id="tipo" value="{{ $administrador->tipo }}" disabled />
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<input type="submit" value="Guardar" class="btn btn-primary pull-right save-perfil">
						</div>
					</div>
				</div>
			</form>
		</div>

		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
			<p class="info_seccion">En esta sección podrá consultar y editar su información personal, tambien podrá cambiar su imagen de perfil</p>
		</div>	
	</div>

	{{ HTML::script('js/validate.js') }}
	{{ HTML::script('js/messages_es.js') }}

	<script type="text/javascript">
	$(document).ready(function(){

		$('.thumbnail').hover(function(){
	        $(this).find('a').fadeIn();
	    }, function(){
	        $(this).find('a').fadeOut();
	    });

	    $('#file-select').on('click', function(e) {
     		
     		e.preventDefault();
	    	
	    	$('#file').click();
		});

		$('input[type=file]').change(function(){

			var ext = $(this).val().substring($(this).val().lastIndexOf('.') + 1); //obtengo extencion

			if( ext == 'png' || ext == 'jpg' || ext == 'jpeg'){
				
				$('.error-img-perfil').fadeOut();
				var reader = new FileReader();

				console.log(reader);

				reader.onload = function (e) {
	         		$('.thumbnail img').attr('src', e.target.result);
	         		$('.thumbnail img').addClass("refresh-img");
		 		}
		 		reader.readAsDataURL(this.files[0]);

			}else{
				$('.error-img-perfil').fadeIn();
				return false;
			}

		});

		var validacion = $('#form-perfil').validate({
			errorElement: "span",
			errorClass: "help-block",
			rules:{
				nombre : {required:true, minlength:3},
				apellido_p:{required:true, minlength:3},
				apellido_m:{required:true, minlength:3},
				telefono: {required:true}
			},
			highlight: function(element, error) {
				$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
			},
			success: function(element) {
				$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			},
			submitHandler: function() {
				// PENDIENTE !!!! 
				return false;
			}
		});

	});
	</script>

@stop