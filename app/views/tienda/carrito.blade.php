@extends('templates.layout_tienda')

@section('contenido')
<meta name="_token" content="{{ csrf_token() }}"/>
<style>.envio{color: red}.total{font-weight: bold; font-size: 18px;} .cantidad{width: 120px}#completa-perfil{display: none;}</style>

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
  										<td>{{ "$".$articulo->precio.".00" }}</td>
  										<td>
  											<div class="cantidad">
  												<input type="text" class="form-control input-cantidad" type="number" min="1" max="5" data-id="{{ $articulo->id }}" data-precio="{{ $articulo->precio }}"  value="{{ $articulo->cantidad }}" readonly>
  											</div>
  										</td>
  										<td> 
  											<b><span>$</span><span class="import">{{ $articulo->importe }}</span><span>.00</span></b>
  										</td>
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
											<td><span>$</span><span id="subtotal">0</span><span>.00</span></td>
										</tr>
										
										<tr>
											<td class="envio">Envío gratuito</td>
											<td class="envio">$0.00</td>
										</tr>
										<tr>
											<td class="total">Total</td>
											<td class="total"><span>$</span><span id="total">0</span><span>.00</span></td>
										</tr>
									</table>
									<center>
										{{ Form::open(['url'=>'/carrito/createPedido','id'=>'form-crearPedido']) }}
											<button id="crear-pedido" class="btn btn-success" type="button">Realizar Compra</button>
											<input type="hidden" id="importe-total" name="importe-total">
										{{ Form::close() }}
										
									</center><br>
								<div id="completa-perfil" class="alert alert-danger">
									<center><p>Para poder realizar una compra es necesario completar tu informacion personal.</p>
									<a href="/cliente/perfil/editar-direccion/" class="btn btn-default btn-block"><i class="fa fa-user"></i> Ir a perfil</a>
									</center>
								</div>
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

		$('#subtotal').html(subtotal());
		$('#total').html(subtotal());
		$('#importe-total').val(subtotal());

		$('table').delegate('.span','click', function(){
			var padre = $(this).parent();
			var valor = padre.find('input').val();
			var id = padre.find('input').attr('data-id');
			var precio = padre.find('input').attr('data-precio');

			var importe = parseInt(valor) * parseInt(precio);

			padre.parents('tr').find('td:nth-child(4n) > b > span:nth-child(2n)').text(importe);

			$('#subtotal').html(subtotal());
			$('#total').html(subtotal());
			$('#importe-total').val(subtotal());
			
			$.ajax({
				method: "post",
				headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
				url: '/carrito/changeQuantity',
				data:{ 
					id: id,
					cantidad: valor,
					importe: importe
				},
				success: function(response) {
					console.log(response);
				}
			});
		});

		$('#crear-pedido').click(function(){
			$.ajax({
				method: "post",
				headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
				url: "/carrito/get-status-user",
				data: { id: {{Session::get('cliente')->persona_id}} },
				success: function(response){
					if(response == 0) {
						$('#completa-perfil').show();
						return false;
					}else {
						$('#form-crearPedido').submit();
					}
				} 	
			});
		});
	});

	function subtotal() {
		
		var subtotal = 0;
		$( ".import" ).each(function( index ) {
		  	subtotal = parseInt($( this ).text()) + subtotal;
		});

		return subtotal;
	}

	</script>

@stop