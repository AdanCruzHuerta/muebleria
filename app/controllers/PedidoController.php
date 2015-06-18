<?php

class PedidoController extends \BaseController {

	public function __construct()
	{	
		$this->beforeFilter('csrf', array('on' => 'post'));
	}
	
	public function create()
	{
	    
	    $countCarrito = Repositoriocarrito::countCarrito();

		$importe = Input::get('importe-total');

		return View::make('tienda.pago', compact('importe', 'countCarrito'));

	}

	public function showComprasCliente()
	{
		$pedidos = DB::table('pedidos as p')

					->join('personas_has_articulos as p_a', 'p.id', '=', 'p_a.pedidos_id')

					->join('personas as per', 'p_a.personas_id', '=', 'per.id')

					->where('per.id', '=', Session::get('cliente')->id )

					->where('p.status_pedidos_id', '=', 1)

					->select('p.id','p.importe_total','p.status_pedidos_id as status','p.created_at')

					->get();

		$countCarrito = Repositoriocarrito::countCarrito();

		return View::make('tienda.pedidos', compact('pedidos', 'countCarrito'));
	}

}
