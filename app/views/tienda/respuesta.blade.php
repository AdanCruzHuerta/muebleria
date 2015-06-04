@extends('templates.layout_tienda')

@section('contenido')
	
	<div class="container">

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

				<div class="panel panel-default">
				
					@if($mensaje == 'paid')
						
						<div class="alert alert-success">
							<center>
								<h3>
									<i class="fa fa-check-circle"></i>
									TU PEDIDO HA SIDO PAGADO CORRECTAMENTE, UNO DE NUESTROS ENCARGADOS TE CONTACTARÁ PRÓXIMAMENTE	
								</h3>
								<br>
								<a href="/productos" class="btn btn-default btn-lg"><i class="fa fa-home"></i> Regresar a tienda</a>
							</center>
						</div>
					
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

@stop