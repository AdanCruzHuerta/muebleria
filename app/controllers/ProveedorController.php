<?php

class ProveedorController extends \BaseController {

	public function __construct()
	{
		$this->beforeFilter('@getAdmin', ['only' => ['index','create','edit']]);

		$this->beforeFilter('@getMessages', ['only' => ['index','create','edit']]);
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
		$proveedores = Proveedor::all();

		$administrador = $this->administrador;

		$mensajes = $this->messages;

		return View::make('administrador.proveedores', compact('proveedores','administrador','mensajes'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$estados = Estado::all();

		$administrador = $this->administrador;

		$mensajes = $this->messages;

		return View::make('administrador.addProveedor', compact('estados','administrador','mensajes'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$proveedor = new Proveedor;

		$proveedor->nombre =  strtoupper(Input::get('nombre'));

		$proveedor->domicilio = strtoupper(Input::get('domicilio'));

		$proveedor->responsable = strtoupper(Input::get('responsable'));

		$proveedor->municipios_id = Input::get('municipio');

		$proveedor->ciudad = strtoupper(Input::get('ciudad'));

		$proveedor->telefono = Input::get('telefono');

		$proveedor->email = Input::get('email');

		if($proveedor->save()):

			return array('resp'=>true, 'mensaje'=>'El proveedor ha sido agregado!');

		else:

			return array('resp'=>false, 'mensaje'=>'Error al guardar al proveedor');

		endif;
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$proveedor = DB::table('proveedores')
        
			->join('municipios', function($join) use($id){
	        
	            $join->on('proveedores.municipios_id', '=', 'municipios.id')
	        
	                 ->where('proveedores.id', '=', $id);
	        
	        })

	        ->join('estados',function($join){

	        	$join->on('municipios.estado_id', '=', 'estados.id');
	        	
	        })

	        ->select('proveedores.id','proveedores.nombre','proveedores.domicilio','proveedores.email','proveedores.responsable'

	        		,'proveedores.telefono' ,'proveedores.ciudad','proveedores.municipios_id','estados.id as estado_id')
	      
	        ->first();

		$estados = Estado::all();

		$administrador = $this->administrador;

		$mensajes = $this->messages;

		return View::make('administrador.updateProveedor', compact('proveedor','estados','administrador','mensajes'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update()
	{
		$proveedor = Proveedor::find(Input::get('id-proveedor'));

		$proveedor->nombre =  strtoupper(Input::get('nombre'));

		$proveedor->domicilio = strtoupper(Input::get('domicilio'));

		$proveedor->responsable = strtoupper(Input::get('responsable'));

		$proveedor->municipios_id = Input::get('municipio');

		$proveedor->ciudad = strtoupper(Input::get('ciudad'));

		$proveedor->telefono = Input::get('telefono');

		$proveedor->email = Input::get('email');

		if($proveedor->save()):

			return array('resp'=> true, 'mensaje'=>'El proveedor ha sido actualizado!');
		
		else:

			return array('resp'=> false, 'mensaje'=>'Error al almacenar proveedor');

		endif;	
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy()
	{
		$id = Input::get('id');

		$proveedor = Proveedor::find($id);

		if($proveedor->delete()):

			return array('resp'=>true);
		
		else: 

			return array('resp'=>false);

		endif;	
		
	}

}