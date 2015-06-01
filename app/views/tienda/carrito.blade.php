@extends('templates.layout_tienda')

@section('contenido')
<style>.envio{color: red}.total{font-weight: bold; font-size: 18px;} .cantidad{width: 120px}</style>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
				    	<h3 class="panel-title">ARTICULOS AGREGADOS AL CARRITO</h3>
				  	</div>
				  	<div class="panel-body">
				  		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
				  			
				  			@if( count($articulos) == 0 )

				  				<div class="alert alert-info">
				  					<center>	
				  						<b>No hay artículos en tu carrito</b>
				  					</center>
				  				</div>
				  				<center>
				  					<a href="/productos" class="btn btn-default btn-lg"><i class="fa fa-shopping-cart"></i> Realiza una compra</a>
				  				</center>

							@else	

								<table class="table table-hover table-condensed">
  								<thead>
  									<tr>
  										<th>Nombre de artículo</th>
  										<th>Precio unitario</th>
  										<th>Cantidad</th>
  										<th>Total</th>
  										<th></th>
  									</tr>
  								</thead>
  								<tbody>
  									@foreach($articulos as $articulo)
  									<tr>
  										<td>{{ $articulo->nombre }}</td>
  										<td>{{ "$".$articulo->importe.".00" }}</td>
  										<td>
  											<div class="cantidad">
  												<input type="text" class="form-control input-cantidad" type="number" min="1" max="5" data-id="{{ $articulo->id }}" data-precio="{{ $articulo->importe }}"  value="{{ $articulo->cantidad }}" readonly>
  											</div>
  										</td>
  										<td> <span>$</span><span>{{ $articulo->importe }}</span><span>.00</span></td>
  										<td>
  											{{ Form::open(['url'=>'/cliente/RemoveItemCart']) }}
												<input type="hidden" name="id_carrito" value="{{ $articulo->id }}">
												<button type="submit" class="btn btn-default" title="Remover articulo">
													<i class="fa fa-trash-o"></i>
												</button>
  											{{ Form::close() }}
  										</td>
  									</tr>
  									@endforeach
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
										<a href="" class="btn btn-success">Realizar Compra</a>
									</center>
							</section>

				  			@endif


				  		</div>
				  	</div>
				</div>
			</div>
		</div>
	</div>

	{{ HTML::script('js/bootstrap-number-input.js') }}

	<script type="text/javascript">

	$(function(){

		$('.input-cantidad').bootstrapNumber();

		$('table').delegate('span','click', function(){
			var padre = $(this).parent();
			var valor = padre.find('input').val();
			var id = padre.find('input').attr('data-id');
			var precio = padre.find('input').attr('data-precio');

			var importe = parseInt(valor) * parseInt(precio);

			padre.parents('tr').find('td:nth-child(4n)>span:nth-child(2n)').text(importe);
			
			$.ajax({
				method: "post",
				url: '',
				data:{ 
					id: id,
					cantidad: valor,

				}
			});

		});

	});

	</script>

@stop