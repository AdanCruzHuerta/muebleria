@extends('templates.layout_administrador')

@section('contenido')

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h2><i class="fa fa-book"></i> Productos</h2>
			<ol class="breadcrumb breadcrumb-arrow">
				<li><a href="/admin">Home</a></li>
				<li class="active"><span>Productos</span></li>
				<li class="active"><span>Artículos</span></li>
			</ol>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 hidden-sm hidden-xs">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Buscar articulo">
        		<span class="input-group-btn">
        			<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
      			</span>
			</div>
			<p class="info_seccion">Lista de articulos registrados en Mueblería Ureña</p>
		</div>
	</div>


	{{ HTML::script('js/validate.js')}}
	{{ HTML::script('js/messages_es.js')}}
	{{ HTML::script('js/fileinput.min.js')}}

	<script type="text/javascript">
	$(function(){

	});
	</script>
@stop