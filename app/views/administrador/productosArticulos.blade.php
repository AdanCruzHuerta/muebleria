@extends('templates.layout_administrador')

@section('contenido')
<style>.article{width: 245px !important;height: 180px !important;}.contenido{color: #A24B2D !important;text-align: justify;font-size: 14px;}.atributos{color: #333333;}.paginacion{background-color: #fff;border: 1px solid #ddd;border-radius: 15px;display: inline-block;padding: 5px 14px;}.thumbnail > .caption{padding: 3px !important;}.thumbnail > .caption > h4{margin: 0px;}</style>

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
		<div class="col-lg-10 col-md-10 col-sm-12 col-xs-12">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					@foreach($articulos as $articulo)
			            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
			                <div class="thumbnail">
			                    <img class="article" src="{{ $articulo->ruta_corta }}" alt="Muebles de Mueblería Ureña"/><br>
			                    <div class="caption">
			                        <h5><b>{{ $articulo->nombre." - $".$articulo->precio.".00"}}</b></h5>
			                        <center>
			                            <a class="btn btn-primary editArticle" data-article="{{ $articulo->id }}">
			                                <i class="fa fa-book"></i> Ver detalles
			                            </a>
			                            <a class="btn btn-danger deleteArticle" data-article="{{ $articulo->id }}">
			                                <i class="fa fa-trash-o"></i> Borrar
			                            </a>
			                        </center>
			                    </div><!-- end caption-->
			                </div>
			            </div>
			        @endforeach
				</div>
			</div>
			<div class="row">
			    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			        <div class="pull-right">
			            {{ $articulos->links() }}
			        </div>
			    </div>
			</div>
		</div>
		<div class="col-lg-2 col-md-2 hidden-sm hidden-xs">
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