@extends('templates.layout_tienda')

@section('contenido')

<style>
	.cuerpo{margin-top: 20px;,margin-bottom: 30px;}
	.regresar{margin-top: 30px; margin-bottom: 20px;}
</style>
	<?php 
		$mensaje = 'paid';
		$countCarrito = 0;
	?>
	
	<div class="container">

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

				<div class="panel panel-default">

					<div class="panel-body cuerpo">
				
					@if($mensaje == 'paid')
						<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">
							<div class="alert alert-success">
								<center>
									<b>
										<i class="fa fa-check-circle"></i>
										Tu pedido ha sido pagado correctamente, uno de nuestros encargados te contactará para confirmar la compra.	
									</b>
									<br>
								</center>
							</div>
						</div>
						
						<center>
							<a href="/productos" class="btn btn-default btn-lg regresar"><i class="fa fa-home"></i> Regresar a tienda</a>
						</center>
					
					@else

						<div class="alert alert-danger">
							
							<center>
								<h3>
									<i class="fa fa-times-circle"></i>
									NO ES POSIBLE HACER EL CARGO. INTENTA NUEVAMENTE MAS TARDE. 	
								</h3>
								<br>
								<a href="/productos" class="btn btn-default btn-block"><i class="fa fa-home"></i> Regresar a tienda</a>
							</center>

						</div>

					@endif

					</div>

				</div>
			
			</div>
		</div>

	</div>

@stop