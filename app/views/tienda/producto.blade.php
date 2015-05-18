@extends('templates.layout_tienda')

@section('contenido')
	<style>img:hover{cursor: pointer;}</style>
	<div class="container"> 
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<br>
				<div class="panel panel-default">
			  		<div class="panel-heading">
			    		<h3 class="panel-title"><i class="fa fa-book"></i> {{ $articulo->nombre }}</h3>
			  		</div>

			  		<div class="panel-body">
			    		
			    		<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<center>
									<img class="img-thumbnail" src="{{ $articulo->ruta_corta }}">
								</center>
							</div>
							
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<table class="table table-bordered table-striped">
									<tbody>
										<tr>
											<td><b>Nombre</b>&nbsp;&nbsp;</td>
											<td>{{ $articulo->nombre }}</td>
										</tr>
										<tr>
											<td><b>Especificaciones</b>&nbsp;&nbsp;</td>
											<td> {{ $articulo->descripcion }} </td>
										</tr>
									</tbody>
								</table>
							</div>

						</div>
			  		</div>

				</div>

			</div>
		</div>	
	</div>
	
	<!-- Modal Imagen de producto-->
	<div id="imagen-producto" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  		<div class="modal-dialog modal-lg">
    		<div class="modal-content">
      			<center>
      				<img id="img-producto" alt="Imagen de Producto - Mueblería Ureña" />
      			</center>
    		</div>
  		</div>
	</div>

<script type="text/javascript">
$(function(){
	$('img').click(function(){
		var imagen = $(this).attr('src');

		$('#img-producto').attr('src',imagen);

		$('#imagen-producto').modal('show');
	});
});
</script>
@stop