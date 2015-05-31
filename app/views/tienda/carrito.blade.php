@extends('templates.layout_tienda')

@section('contenido')
<style>
	.envio{color: red}
	.total{font-weight: bold; font-size: 18px;}
</style>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
				    	<h3 class="panel-title">ARTICULOS AGREGADOS AL CARRITO</h3>
				  	</div>
				  	<div class="panel-body">
				  		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
				  			<table class="table table-hover">
  								<thead>
  									<tr>
  										<th>Nombre de artículo</th>
  										<th>Precio unitario</th>
  										<th>Cantidad</th>
  										<th>Total</th>
  									</tr>
  								</thead>
  								<tbody>
  									<tr>
  										<td>Litera de pino</td>
  										<td>$4500.00</td>
  										<td>1</td>
  										<td>$4500.00</td>
  									</tr>
  								</tbody>
							</table>
							<section class="col-xs-12 col-sm-12 col-md-4 col-lg-4 pull-right">	
									<table class="table">
										<tr>
											<td>Subtotal</td>
											<td id="subtotal"> $0.00</td>
										</tr>
										
										<tr>
											<td class="envio">Envío gratuito</td>
											<td class="envio">$0.00</td>
										</tr>
										<tr>
											<td class="total">Total</td>
											<td id="total" class="total">$0.00</td>
										</tr>
									</table>
									<center>
										Precio con IVA incluido
									</center>
							</section>	
				  		</div>
				  	</div>
				</div>
			</div>
		</div>
	</div>

@stop