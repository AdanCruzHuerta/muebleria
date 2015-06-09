<?php

class ClienteController extends \BaseController {

	/*
	|	Seccion para el ADMINISTRADOR
	*/

	public function __construct()
	{	
		$this->beforeFilter('csrf', array('on' => 'post'));

		$this->beforeFilter('@getAdmin', ['only' => ['index','show'] ]);

		$this->beforeFilter('@getMessages', ['only' => ['index','show'] ]);

		$this->beforeFilter('@getCliente', ['only' => ['showDataCliente','edit','editAdress'] ]);

		$this->beforeFilter('@getPersona', ['only' => ['editAdress'] ]);
	}

	public function getAdmin()
	{
		$this->administrador = Config::get('constants.DATA_ADMIN');
	}

	public function getMessages()
	{
		$this->messages = Config::get('constants.DATA_MESSAGES');
	}

	public function getCliente()
	{
		$this->cliente = Config::get('constants.DATA_CLIENTE');
	}

	public function getPersona()
	{
		$this->persona = Config::get('constants.DATA_PERSONA');
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

	public function showDataCliente()
	{
		if (Session::has('cliente'))
		{
	    	$countCarrito = Repositoriocarrito::countCarrito();
		
		}else {

			$countCarrito = 0;
		
		}

		$dataCliente = $this->cliente;

		return View::make('tienda.resources.cuentaCliente', compact('dataCliente','countCarrito'));
	}


	public function edit()
	{
		if (Session::has('cliente'))
		{

	    	$countCarrito = Repositoriocarrito::countCarrito();
		
		} else {

			$countCarrito = 0;

		}

		$dataCliente = $this->cliente;

		return View::make('tienda.resources.editarCuenta', compact('dataCliente','countCarrito'));


	}

	public function editAdress()
	{
		$dataCliente = $this->cliente;

		$estados = Estado::all();

		$municipios = Municipio::all();

		if (Session::has('cliente'))
		{
	    	$countCarrito = Repositoriocarrito::countCarrito();
		
		} else {

			$countCarrito = 0;
		
		}

		if($dataCliente->status == 0)
		{

			return View::make('tienda.resources.guardarDireccion', compact('dataCliente','estados','municipios','countCarrito'));
		
		}

		$dataPersona = $this->persona;

		return View::make('tienda.resources.editarDireccion', compact('dataCliente','estados','dataPersona','municipios','countCarrito'));
	}

	public function update()
	{
		if(Request::ajax())
		{

			$usuario = User::find(Input::get('id_usuario'));

			$persona = Persona::where('users_id','=', Input::get('id_usuario'))->first();

			$persona->nombre = Input::get('nombre');

			$persona->apellido_p = Input::get('apellido_p');

			$persona->apellido_m = Input::get('apellido_m');

			$persona->save();

			if (Input::has('password'))
			{
			    $usuario->password = Hash::make(Input::get('password'));

			    $usuario->save();
			}

			return Response::json(true);
		}
	}

	public function updateDireccion()
	{
		$persona = Persona::where('users_id','=', Input::get('id_usuario'))->first();

		$persona->ciudad = Input::get('ciudad');

		$persona->calle = Input::get('calle');

		$persona->numero_ext = Input::get('numero_ext');

		$persona->numero_int = Input::get('numero_int');

		$persona->telefono = Input::get('telefono');

		$persona->codigo_postal = Input::get('codigo_postal');

		$persona->municipio_id = Input::get('municipio');

		$persona->status = 1; // cambiamos el status a 1

		if($persona->save())
		{
			return Redirect::to('/cliente/perfil/editar-direccion');
		}
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
