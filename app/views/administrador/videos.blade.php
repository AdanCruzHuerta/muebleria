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
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>Video 1 </h4>
					</div>
					<div class="panel-body">
						contenido
					</div>
				</div>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>Video 2 </h4>
					</div>
					<div class="panel-body">
						contenido
					</div>
				</div>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>Video 3 </h4>
					</div>
					<div class="panel-body">
						contenido
					</div>
				</div>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4>Video 4 </h4>
					</div>
					<div class="panel-body">
						contenido
					</div>
				</div>
			</div>	
		</div>

		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
			<div class="row">
				<a id="add-video" class="btn btn-primary btn-block" href="#" data-toggle="modal" data-target="#modal-video">
	  				<i class="fa fa-film"></i> Agregar Video
	  			</a>
			</div>	
			<p class="info_seccion">
				Lista de videos en el sistema
			</p>
		</div>

	</div>

	<!-- Modal Agregar Video-->
	@include('administrador.Modales.crearVideo')

@stop