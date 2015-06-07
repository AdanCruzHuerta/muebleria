@extends('templates.layout_tienda')

@section('contenido')
	<style>.screen{margin-top: 20px !important;margin-bottom: 50px !important;}</style>
	<section>
		<div class="container screen">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xs-offset-0 col-sm-offset-0 col-md-offset-2 col-lg-offset-2"><br>				
					<img class="img-thumbnail" src="/img/imagen1.png">
				</div>	
			</div>
		</div>	
	</section>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					@include('tienda.resources.politica')
				</div>
			</div>
		</div>
	</section>
@stop