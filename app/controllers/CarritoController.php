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
		$articulos = Repositoriocarrito::getArticulosCliente(Session::get('cliente'));

		return View::make('tienda.carrito', compact('articulos'));
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

	public function destroy()
	{
		$articulo = Carrito::find(Input::get('id_carrito'));

		$articulo->delete();

		return Redirect::to('/carrito');
	}


}
