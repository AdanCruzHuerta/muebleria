@extends('templates.layout_administrador')

@section('contenido')


	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h2><i class="fa fa-desktop"></i> Video</h2>
			<ol class="breadcrumb breadcrumb-arrow">
				<li><a href="/administrador">Home</a></li>
				<li class="active"><span>Página</span></li>
				<li class="active"><span>Video</span></li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			<div id="alerta"></div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">

			@foreach($videos as $video)
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<a class="btn btn-default pull-right" data-toggle="collapse" href="#collapseExample{{$video->id}}" aria-expanded="false" aria-controls="collapseExample">
				  				<i class="fa fa-bars"></i>
							</a>
							<h4> {{$video->nombre}} </h4>

							@if( $video->status == 1)
								<span class="status-slider-activo">
									Activo
								</span>
							@else
								<span class="status-slider-inactivo">
									Inactivo
								</span>
			 				@endif
						</div>
						<div class="collapse panel-body" id="collapseExample{{$video->id}}">
							<?php 

								$url = explode('?', $video->frame);

								$id = explode('embed/', $url[0]);

							 ?>
							<div class="row">
								<div class="col-xs-12 col-dm-12 col-md-12 col-lg-12">
									<center>
										<img src="http://img.youtube.com/vi/{{$id[1]}}/0.jpg" alt="Video de Mueblería Ureña" class="img-thumbnail img-video">
									</center>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="opcion-item-slider col-xs-12 col-sm-12 col-md-12 col-lg-12">
									@if($video->status == 0)
						 				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						 					<button class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-danger btn-accion delete-video" data-id="{{ $video->id }}" data-name="{{$video->nombre}}" title="Borrar"><i class="fa fa-trash-o"></i></button>
						 				</div>
					 					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
					 						<a href="/administrador/pagina/videos/change/{{$video->id}}" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-warning btn-accion" title="Habilitar video"><i class="fa fa-eye"></i></a>
					 					</div>
					 				@endif
					 			</div>
							</div>
						</div>
					</div>
				</div>
			@endforeach	
		</div>

		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<a id="add-video" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-video"><i class="fa fa-film"></i> Agregar Video</a>
				</div>
			</div>	
			<p class="info_seccion">
				Lista de videos en el sistema
			</p>
		</div>

	</div>

	<!-- Modal Agregar Video -->
	@include('administrador.Modales.crearVideo')

	<!-- Modal borrar video -->
	@include('administrador.Modales.borrarVideo')

<script type="text/javascript">

$(function(){
	
	$('.delete-video').click(function(){
		var id = $(this).attr('data-id');
		
		var name = $(this).attr('data-name');

		$('#nombre_video').text(name);

		$('#id_video').val(id);
		
		$('#modal-borrar-video').modal('show');
	});

});

</script>

@stop