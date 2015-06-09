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

	public function changePassword()
	{
		if (Request::ajax())
		{
			$emailCliente = Input::get('email');

			$cliente = User::where('email','=',$emailCliente)->first();

			if(!$cliente)
			{
				return Response::json(false);
			}

			$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
			
			$cad = "";
			
			for($i=0;$i<12;$i++) {
			
				$cad .= substr($str,rand(0,62),1);
			
			}
          
          	$data = ['email'=>$cliente->email,'contrasena'=>$cad];

			$cliente->password = Hash::make($cad);

			if($cliente->save())
			{
				$mail = Mail::send('emails.template', $data, function ($message) use($emailCliente){

						 //remitente
           				$message->from('adancruzhuerta@gmail.com','Muebleria Ureña');

           				//asunto
	    				$message->subject('Mueblería Ureña - Restablecer Contraseña');
	    					
	    				//receptor
	    				$message->to($emailCliente);
			
					});

				return Response::json(true);
			}
			
			return Response::json(false);
		
		}
	}


}
