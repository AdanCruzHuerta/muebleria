@extends('templates.layout_administrador')

@section('contenido')
	<style>
		.file-preview-frame{width: 95% !important;}
		.file-preview-image{width: 70% !important;height: 100% !important;}
	</style>	

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h2><i class="fa fa-desktop"></i> Slider</h2>
			<ol class="breadcrumb breadcrumb-arrow">
				<li><a href="/administrador">Home</a></li>
				<li class="active"><span>Página</span></li>
				<li class="active"><span>Slider</span></li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<div id="alerta"></div>
		</div>
	</div><br>

	<div class="row">
		<div class="col-md-10">
			<?php $item = 1; ?>
			@foreach($sliders as $slider)
				<div class="panel panel-default">
					<div class="panel-heading">
						<a class="btn btn-default pull-right" data-toggle="collapse" href="#collapseExample-{{$item}}" aria-expanded="false" aria-controls="collapseExample">
			  				<i class="fa fa-bars"></i>
						</a>
						<h4>Imagen {{ $item }}</h4>
					</div>
					<div class="collapse panel-body" id="collapseExample-{{$item}}">
					 	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					 		<img src="{{ $slider->ruta_corta }}" width="100%" height="180" class="img-rounded">
					 	</div>
					 	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					 		<div class="well">
					 			<center>
					 				<label>Nombre de imagen:</label>
					 				{{ $slider->nombre }} <br/>

					 				<label>Fecha de creación:</label>
					 				{{ $slider->created_at }} <br/>
									
										<label>Estado:</label>
						 				@if( $slider->status_slider == 1)
											<span class="status-slider-activo">
												Activo
											</span>
										@else
											<span class="status-slider-inactivo">
												Inactivo
											</span>
						 				@endif
					 			</center>	
					 		</div>
					 		<div class="opcion-item-slider col-xs-12 col-sm-12 col-md-12 col-lg-12">
					 				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					 					<button class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-danger btn-accion delete-slider" data-id="{{ $slider->id }}" data-nombre="{{ $item }}" title="Borrar"><i class="fa fa-trash-o"></i></button>
					 				</div>

					 				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					 					<button class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-warning btn-accion visibleSlider" data-id="{{$slider->id}}" title="@if($slider->status_slider == 1) {{ 'Deshabilitar' }} @else {{ 'Habilitar' }} @endif"><i class="fa @if($slider->status_slider == 1) {{ 'fa-eye' }} @else {{ 'fa-eye-slash' }} @endif"></i></button>
					 				</div>
					 		</div>
					 	</div>
					</div>
				</div>
			<?php $item++; ?>
			@endforeach

		</div>

		<div class="col-md-2">
			<div class="row">
				<a id="add-slider" class="btn btn-primary btn-block" href="#" data-toggle="modal" data-target="#modal-slider">
	  				<i class="fa fa-picture-o"></i> <span id="content-btn"></span>
	  			</a>
			</div>	
			<p class="info_seccion">
				Lista de imagenes actuales en el slider principal.
			</p>
		</div>
	</div>

<!-- Modal nueva imagen-->
@include('administrador.Modales.crearSlider')

<!-- Modal eliminar imagen slider-->
@include('administrador.Modales.eliminarSlider')

<script>
	$(document).ready(function(){ 

		var elementos = $('.visibleSlider').size();

		if(elementos == 5){

			$("#add-slider").attr('disabled','disabled');

			$("#content-btn").html("Lugares agotados!");
		}
		else{

			$("#add-slider").removeAttr('disabled');

			$("#content-btn").html("Agregar imagen");
		}

		$('button.visibleSlider').click(function(){

			var id = $(this).attr('data-id');
			
			var span_status_slider = $(this).parents('div.opcion-item-slider').siblings('div.well').find('span');

			if($(this).children('i').hasClass('fa-eye')){

				var status = 1;

			} else{

				var status = 0;

			}

			$.ajax({
				context: $(this),
				type: "POST",
				url: "/administrador/pagina/update-slider",
				data: {id:id,status:status},

				 beforeSend: function() {

                   $("#alerta").html('<center>Actualizando imagen...</center>');
                
                },

				success: function(result){

					if(result.resp){

						if($(this).children('i').hasClass('fa-eye-slash')){

							$(this).children('i').removeClass('fa-eye-slash').addClass('fa-eye');

							$(this).attr('title','Deshabilitar');

							span_status_slider.removeClass('status-slider-inactivo');

							span_status_slider.addClass('status-slider-activo');

							span_status_slider.html('Activo');

						}else{

							$(this).children('i').removeClass('fa-eye').addClass('fa-eye-slash');

							$(this).attr('title','Habilitar');

							span_status_slider.removeClass('status-slider-activo');

							span_status_slider.addClass('status-slider-inactivo');

							span_status_slider.html('Inactivo');
							
						}

						$('#alerta').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong><i class="fa fa-check"></i> Exito!</strong>&nbsp;'+result.mensaje+'</div>');

					}else{

						$('#alerta').html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong><i class="fa fa-exclamation-triangle"></i> Error!</strong>&nbsp;'+result.mensaje+'</div>');

					}

				}
			});

		});

		$('.delete-slider').click(function(){

				if(elementos == 1){
					$('#alerta').html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong><i class="fa fa-exclamation-triangle"></i> Error!</strong>&nbsp; No se pueden borrar todas las imagenes</div>');
				}else{
					var id 		=	$(this).attr('data-id');
					var nombre 	= 	$(this).attr('data-nombre');

					$('.nombre-slider').html('Slider '+nombre);
					$('#value-slider').val(id);

					$('#modal-delete-slider').modal({
						backdrop: 'static',
					  	keyboard: false,
					});
				}
		});

		$('#slider-delete').click(function(){
			var id = $('#value-slider').val();
			$.ajax({
				type: "POST",
				url: "/administrador/pagina/delete-slider",
				data: {id:id},
				success: function(response){
					if(response) {
						$('#mensaje-modal').html("<b><i class='fa fa-check-circle'></i> La imagen ha sido borrada</b>");
						$(".btn-remove").hide();
						$("#delete_ok").show();
						return false;
					}else{
						$('#mensaje-modal').html("<b><i class='fa fa-exclamation-circle'></i> No se pudo borrar la imagen, intentalo nuevamente</b>");
						$(".btn-remove").hide();
						$("#delete_ok").show();
						return false;
					}
				}
			});
		});

		$('#modal-slider').modal({
			backdrop: 'static',
			keyboard:false,
			show:false
		});

		$("#imagen").fileinput({
			uploadUrl: '/administrador/pagina/subir-slider',
			uploadAsync: true,
            allowedFileExtensions : ['jpg', 'png','gif'],
            overwriteInitial: false,
            maxFileSize: 5000,
            maxFilesNum: 1,
            allowedFileTypes: ['image']
		}); 

		$('#imagen').on('fileuploaded', function(event, data) {
        	if(data.response){
        		$("#alerta-slider").html("<div class='alert alert-success'><center><b><i class='fa fa-check-circle'></i> La imagen ha sido creada</b></center></div>");
        		$("#contenido-modal-slider").html('');
        		$("#btn-cancel-slider").hide();
        		$(".close").hide();
        		$("#btn-success-slider").show();
        	}else{
        		$("#alerta-slider").html("<div class='alert alert-danger'><center><b><i class='fa fa-times-circle'></i> La imagen no fue creada</b></center></div>");
        		$("#contenido-modal-slider").html('');
        		$(".close").hide();
        		$("#btn-cancel-slider").hide();
        		$("#btn-success-slider").show();
        	}

    	});

	});
</script>

@stop