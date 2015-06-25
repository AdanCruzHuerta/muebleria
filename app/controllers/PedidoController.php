<?php

class PedidoController extends \BaseController {

	public function __construct()
	{	
		$this->beforeFilter('csrf', array('on' => 'post'));

		$this->beforeFilter('@getAdmin', ['only' => ['index'] ]);

		$this->beforeFilter('@getMessages', ['only' => ['index'] ]);
	}

	public function getAdmin()
	{
		$this->administrador = Config::get('constants.DATA_ADMIN');
	}

	public function getMessages()
	{
		$this->messages = Config::get('constants.DATA_MESSAGES');
	}

	public function index()
	{
		$pedidos = Pedido::all();

		$administrador = $this->administrador;

		$mensajes = $this->messages;

		return View::make('administrador.pedidos', compact('pedidos','administrador','mensajes'));
	}
	
	public function create()
	{
	    
	    $countCarrito = Repositoriocarrito::countCarrito();

		$importe = Input::get('importe-total');

		return View::make('tienda.pago', compact('importe', 'countCarrito'));

	}

	public function showComprasCliente()
	{
		$pedidos = Repositoriopedidos::getPedidosCliente();

		$countCarrito = Repositoriocarrito::countCarrito();

		return View::make('tienda.pedidos', compact('pedidos', 'countCarrito'));
	}

}
