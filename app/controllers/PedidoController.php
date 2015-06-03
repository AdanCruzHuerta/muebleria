<?php

class PedidoController extends \BaseController {

	public function __construct()
	{	
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
            
            	->update(array('pedidos_id' => $pedido->id));
		}

		return View::make('tienda.pago');

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
