@extends('templates.layout_administrador')

@section('contenido')
	
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h2><i class="fa fa-shopping-cart"></i> Proveedores</h2>
			<ol class="breadcrumb breadcrumb-arrow">
				<li><a href="/administrador">Home</a></li>
				<li><a href="/administrador/proveedores">Proveedores</a></li>
				<li class="active"><span>Nuevo</span></li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
			<div class="panel panel-default">
				<div class="panel-body">
				<div id="alerta"></div>
					<div class="row">
						<form id="form-proveedor">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="form-horizontal">
									<div class="form-group">
										<label for="nombre" class="control-label col-sm-4">Proveedor</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="nombre" id="nombre">
										</div>
									</div>
									<div class="form-group">
										<label for="estado" class="control-label col-sm-4">Estado</label>
										<div class="col-sm-8">
											<select name="estado" id="estado" class="form-control">
												<option value="">Selecciona Estado</option>
												@foreach($estados as $estado)
													<option value="{{ $estado->id }}">{{ $estado->nombre }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="municipio" class="control-label	col-sm-4">Municipio</label>
										<div class="col-sm-8">
											<select name="municipio" id="municipio" class="form-control">
												<option value="">Selecciona Municipio</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="ciudad" class="control-label	col-sm-4">Ciudad</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="ciudad" id="ciudad">
										</div>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="form-horizontal">
									<div class="form-group">
										<label for="domicilio" class="control-label	col-sm-4">Domicilio</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="domicilio" id="domicilio">
										</div>
									</div>
									<div class="form-group">
										<label for="telefono" class="control-label	col-sm-4">Telefono</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="telefono" id="telefono">
										</div>
									</div>
									<div class="form-group">
										<label for="email" class="control-label	col-sm-4">Email</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="email" id="email">
										</div>
									</div>
									<div class="form-group">
										<label for="responsable" class="control-label col-sm-4">Responsable</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="responsable" id="responsable">
										</div>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
								<button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i> Guardar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-hidden col-sm-hidden col-md-3 col-lg-3">
			<p class="info_seccion">Para dar de alta a un nuevo proveedor es necesario llenar los campos y dar clic en Guardar.</p>
		</div>
	</div>

	{{ HTML::script('js/validate.js') }}
	{{ HTML::script('js/messages_es.js') }}

	<script type="text/javascript">

		$(document).ready(function(){
			$('#estado').change(function(){
				var estado = $(this).val();
				$.ajax({
					type: "POST",
					url: "/administrador/pagina/municipios",
					data:{estado:estado},
					success: function(res){
						var cadena = '<option value="">Selecciona Municipio</option>';
						for(var i = 0; i<res.length; i++){
							cadena += '<option value="'+res[i].id+'">'+res[i].nombre+'</option>';
						}
						$('#municipio').html(cadena);
					}
				});
			});

			var validacion = $('#form-proveedor').validate({
				errorElement: "span",
				errorClass: "help-block",
				rules: {
					nombre: {required: true, minlength: 3},
					estado: {required: true},
					municipio: {required: true},
					ciudad: {required:true, minlength: 3},
					domicilio: {required: true, minlength: 3},
					telefono: {required: true, minlength: 10},
					email: {email: true},
					responsable: {required: true, minlength: 3}
				},
				highlight: function(element, error) {
					$(element).closest('.form-group').removeClass('has-success').addClass('has-error');
				},
				success: function(element) {
					$(element).closest('.form-group').removeClass('has-error').addClass('has-success');
				},
				submitHandler: function() {
					$.post("/administrador/proveedores/guardar-proveedor", $('form#form-proveedor').serialize(), function(result){
						$("html, body").animate({scrollTop:"0px"});
						if(result.resp){
							$('#alerta').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Exito!</strong>&nbsp;'+result.mensaje+'</div>');
							$('#form-proveedor').each(function(){
							this.reset();
							});
						} else{
							$('#alerta').html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Error!</strong>&nbsp;'+result.mensaje+'</div>');
						}
						$('#form-proveedor').each(function(){
						this.reset();
						});
					}, "json");
				}
			});
		});
	</script>

@stop