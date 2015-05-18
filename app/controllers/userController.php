<?php

class userController extends \BaseController {

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
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Request::ajax())
		{
			try
			{
				DB::beginTransaction();

				$usuario = new User;

			    $usuario->email = Input::get('email');

			    $usuario->password = Hash::make(Input::get('password'));

			    $usuario->roles_id = 1;

			    $usuario->save();

			    $persona = new Persona;

			    $persona->nombre = Input::get('nombre');

			    $persona->apellido_p = Input::get('ap_paterno');

			    $persona->apellido_m = Input::get('ap_materno');

			    $persona->users_id = $usuario->id;

			    $persona->save();

			    DB::commit();

			    return Response::json(true);
			}
			catch(Exception $ex)
			{
				DB::rollback();

				return Response::json(false);
			}
		}
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
