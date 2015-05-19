<?php

class AdminController extends \BaseController {

	public function __construct()
	{	
		/*
			Aplicando DRY llamanos al metodo "getAdmin" que obtiene los datos de 
			administrador y los aplica a los metodos mencionados "only"	
		 */
		$this->beforeFilter('@getAdmin', ['only' => ['index','edit'] ]);

		$this->beforeFilter('@getMessages', ['only' => ['index','edit'] ]);
	}

	public function getAdmin()
	{
		$this->administrador = Config::get('constants.DATA_ADMIN');
	}

	public function getMessages()
	{
		$this->messages = Config::get('constants.DATA_MESSAGES');
	}

	/**
	 * Muestra los datos del administrador
	 *
	 * @return Response
	 */
	public function index()
	{
		$administrador = $this->administrador;

		$mensajes = $this->messages;

		return View::make('administrador.inicio', compact('administrador','mensajes'));
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
		//
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
	 * @return Response
	 */
	public function edit()
	{

		$administrador = $this->administrador;

		$mensajes = $this->messages;

		return View::make('administrador.perfilAdmin', compact('administrador','mensajes'));

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update()
	{
		return Input::all();
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
