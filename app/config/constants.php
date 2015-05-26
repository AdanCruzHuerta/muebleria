<?php

/**
 * Constantes de la aplicación 
 *
 */

    // Datos del administrador
	$administrador = DB::table('users')

		->join('roles', 'users.roles_id', '=', 'roles.id')

       	->join('personas', 'users.id', '=', 'personas.users_id')

       	->where('users.id', '=', Auth::user()->id )

       	->select('users.id','users.email','users.photo_user','personas.nombre', 'personas.apellido_p','personas.apellido_m','personas.telefono','roles.tipo')

       	->first();

  // Mensajes recibidos
  $messages = Mensaje::where('status', '=', 0)->get();

  // datos del cliente
  $cliente = DB::table('users')

    ->join('personas', 'users.id', '=', 'personas.users_id')

    ->where('users.id', '=', Auth::user()->id )

    ->select('users.id','users.email','users.photo_user','personas.nombre', 'personas.apellido_p','personas.apellido_m','personas.telefono')

    ->first();

return [
		'DATA_ADMIN' 	=> $administrador,

		'DATA_MESSAGES' => $messages,

    'DATA_CLIENTE' => $cliente
	];