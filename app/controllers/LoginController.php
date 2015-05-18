<?php

class LoginController extends \BaseController {

	/**
     * Crear una nueva instancia de LoginController.
     */
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
    }


	/**
	 * Muestra el formulario de login de administrador.
	 *
	 * @return Response
	 */
	public function Administrador()
	{
		if(Auth::check()): // verifica que exista la sesion

			return Redirect::to('administrador/panel');

		endif;

		return View::make('administrador.login')->with('error', false);
	}


	/**
	 * Verifica la validacion.
	 *
	 * @return Response
	 */
	public function store()
	{ 

		if(Auth::attempt(Input::only('email','password'))):

		 	if( Auth::user()->roles_id == 1 ) 		// CLIENTE
		 	 		
		 		return Redirect::to('/');
			
		 	else if( Auth::user()->roles_id == 2 ) // EMPLEADO
		 	 
		 		return Redirect::to('/empleado');
			
		 	else									// GERENTE
		 		
		 		return Redirect::to('administrador/panel');

		 endif;

		return Redirect::back()->with('error', true);

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		Auth::logout();		// cierra la sesion

		return Redirect::to('/administrador');
	}


}
