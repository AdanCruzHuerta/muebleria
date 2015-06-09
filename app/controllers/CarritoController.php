<?php

class CarritoController extends \BaseController {

	public function __construct()
	{
		$this->beforeFilter('csrf', ['on' => 'post']);
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if (Session::has('cliente'))
		{
	    	$countCarrito = Repositoriocarrito::countCarrito();

		}else {

			$countCarrito = 0;
		}

		$articulos = Repositoriocarrito::getArticulosCliente(Session::get('cliente'));

		return View::make('tienda.carrito', compact('articulos','countCarrito'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$carrito = new Carrito;

		$carrito->personas_id = Input::get('user_id');

		$carrito->articulos_id = Input::get('articulo_id');

		$carrito->importe = Input::get('importe');

		if($carrito->save())
		{
			return Redirect::to('/carrito');
		}

		return Redirect::back()->with('error', true);
	}

	public function update()
	{
		if(Request::ajax())
		{
			$articulo = Carrito::find(Input::get('id'));

			$articulo->cantidad = Input::get('cantidad');

			$articulo->importe = Input::get('importe');

			$articulo->save();

			$countCarrito = Repositoriocarrito::countCarrito();

			return Response::json(compact('countCarrito'));
		}
	}

	public function statusUser()
	{
		if(Request::ajax())
		{
			$cliente = Persona::find(Input::get('id'));

			return $cliente->status;
		}
	}

	public function destroy()
	{
		$articulo = Carrito::find(Input::get('id_carrito'));

		$articulo->delete();

		return Redirect::to('/carrito');
	}


}
