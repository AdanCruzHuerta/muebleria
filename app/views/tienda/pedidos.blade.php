@extends('templates.layout_tienda')

@section('contenido')
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">MIS COMPRAS</h4>
					</div>
  					<div class="panel-body">

						<table class="table table-striped">
						  	<thead>
						  		<tr>
						  			<th>#</th>
						  			<th>Número de pedido</th>
						  			<th>Estatus</th>
						  			<th>Fecha</th>
						  			<th>Importe</th>
						  		</tr>
						  	</thead>
						  	<tbody>
						  		@foreach($pedidos as $pedido)
								
								<tr>
									<td><i class="fa fa-chevron-right"></i></td>
									<td>{{ $pedido->id }} </td>
									<td>@if($pedido->status == 1){{ 'Pagado, pendiente de entrega' }} @endif</td>
									<td>{{ $pedido->created_at }} </td>
									<td>{{ "$ ".number_format($pedido->importe_total)."00"}}</td>
								</tr>
								
						  		@endforeach
						  	</tbody>
						</table>
				  	</div>
				</div>
			</div>
		</div>
	</div>
	
@stop