<?php

class ClienteController extends \BaseController {

	public function __construct()
	{	
		$this->beforeFilter('@getAdmin', ['only' => ['index','show'] ]);

		$this->beforeFilter('@getMessages', ['only' => ['index','show'] ]);
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
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$clientes = Repositorioclientes::getClientes();

       	$administrador = $this->administrador;

       	$mensajes = $this->messages;

		return View::make('administrador.clientes', compact('clientes','administrador','mensajes'));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

		$persona = Persona::find($id);

		if( $persona->status == 0 )
		{
			$cliente = Repositorioclientes::getClienteDefault($id);
		}
		else
		{
			$cliente = Repositorioclientes::getClienteComplete($id);
		}

		$administrador = $this->administrador;

       	$mensajes = $this->messages;

       	return View::make('administrador.cliente', compact('cliente','administrador','mensajes'));

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
