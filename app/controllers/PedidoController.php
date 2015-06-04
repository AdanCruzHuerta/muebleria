<?php

class PedidoController extends \BaseController {

	public function __construct()
	{	
		$this->beforeFilter('csrf', array('on' => 'post'));
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$pedido = new Pedido;

		$pedido->importe_total = Input::get('importe-total');

		$pedido->status_pedidos_id = 5;

		$pedido->save();

		$carritos = Repositoriocarrito::getArticulosClienteCarrito(Session::get('cliente'));

		foreach($carritos as $carrito)
		{
			DB::table('personas_has_articulos')
            
            	->update(array(

            		'pedidos_id'=> $pedido->id
            	));
		}

		$pedido = $pedido->id;

		$importe = Input::get('importe-total');

		return View::make('tienda.pago', compact('pedido','importe'));

	}

}
