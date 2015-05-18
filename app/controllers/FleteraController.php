<?php

class FleteraController extends \BaseController {

	public function __construct()
	{
		$this->beforeFilter('@getAdmin', ['only' => ['index','create','edit']]);

		$this->beforeFilter('@getMessages', ['only'=>['index','create','edit']]);
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

		$fleteras = Fletera::all();

		$administrador = $this->administrador;

		$mensajes = $this->messages;

		return View::make('administrador.fleteras', compact('fleteras','administrador','mensajes'));
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

		return View::make('administrador.addFletera', compact('estados','administrador','mensajes'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$fletera = new Fletera;

		$fletera->nombre = strtoupper(Input::get('nombre'));

		$fletera->municipios_id = Input::get('municipio');

		$fletera->ciudad = strtoupper(Input::get('ciudad'));

		$fletera->domicilio = strtoupper(Input::get('domicilio'));

		$fletera->responsable = strtoupper(Input::get('responsable'));

		$fletera->telefono = Input::get('telefono');

		$fletera->email = Input::get('email');

		if($fletera->save()):

			return array('response'=>true,'mensaje'=>'La fletera hs sido agregada.');

		else: 

			return array('response'=>false,'mensaje'=>'Error al guardar la fletera.');

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

		$fletera = DB::table('fleteras')
        
			->join('municipios', function($join) use($id){
	        
	            $join->on('fleteras.municipios_id', '=', 'municipios.id')
	        
	                 ->where('fleteras.id', '=', $id);
	        
	        })

	        ->join('estados',function($join){

	        	$join->on('municipios.estado_id', '=', 'estados.id');
	        	
	        })

	        ->select('fleteras.id','fleteras.nombre','fleteras.domicilio','fleteras.email','fleteras.responsable'

	        		,'fleteras.telefono' ,'fleteras.ciudad','fleteras.municipios_id','estados.id as estado_id')
	      
	        ->first();

		$estados = Estado::all();

		$administrador = $this->administrador;

		$mensajes = $this->messages;

		return View::make('administrador.updateFletera', compact('id','fletera','estados','administrador','mensajes'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @return Response
	 */
	public function update()
	{
		$fletera = Fletera::find(Input::get('id-fletera'));

		$fletera->nombre = strtoupper(Input::get('nombre'));

		$fletera->municipios_id = Input::get('municipio');

		$fletera->ciudad = strtoupper(Input::get('ciudad'));

		$fletera->domicilio = strtoupper(Input::get('domicilio'));

		$fletera->telefono = Input::get('telefono');

		$fletera->email = Input::get('email');

		$fletera->responsable = strtoupper(Input::get('responsable'));

		if($fletera->save()):

			return array('resp'=>true,'mensaje'=>'Fletera actualizada!');

		else:

			return array('resp'=>false,'mensaje'=>'Error al actualizar la fletera');

		endif;
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{

		$fletera = Fletera::find(Input::get('id'));

		if($fletera->delete()):

			return Response::json(array('response' => true));

		else:

			return Response::json(array('response' => false));

		endif;
	}
}