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

		if (Session::has('cliente'))
		{
	    	$countCarrito = Repositoriocarrito::countCarrito();
		
		} else {
			
			$countCarrito = 0;			
		
		}

		return View::make('tienda.pedidos', compact('pedidos', 'countCarrito'));
	}

	/*
		select  p.id, p.importe_total
		from pedidos as p join personas_has_articulos as p_a on p.id = p_a.pedidos_id
						  join personas as per on p_a.personas_id = per.id
		where per.id = 7 and p.status_pedidos_id = 1;


		$count = DB::table('personas as p')

                     ->join('personas_has_articulos as p_a', 'p.id', '=', 'p_a.personas_id')

                     ->join('articulos as a', 'p_a.articulos_id', '=', 'a.id')

                     ->where('p.id', '=', $id_persona)

                     ->where('p_a.status', '=', 0)

                     ->select('p_a.id')

                     ->get();
	*/
}
