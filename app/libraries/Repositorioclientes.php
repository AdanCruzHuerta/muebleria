<?php

class Repositorioclientes
{
	static function getClientes()
	{
		$clientes = DB::table('personas')

			->join('users', 'personas.users_id', '=', 'users.id')

       		->where('users.roles_id', '=', 1 ) // 1 = cliente

       		->select('users.id','personas.nombre', 'personas.apellido_p', 'personas.apellido_m', 'users.email', 'personas.telefono')

       		->get();

       	return $clientes;
	}

	static function getCliente($id)
	{
		$cliente = DB::table('users')
        
			->join('personas', function($join) use($id){
	        
	            $join->on('personas.users_id', '=', 'users.id')
	        
	                 ->where('users.id', '=', $id);
	        
	        })

	        ->select('users.email','users.photo_user','personas.nombre','personas.apellido_p',

	        		 'personas.apellido_m','personas.ciudad','personas.calle','personas.codigo_postal',

	        		 'personas.numero_ext','personas.numero_int','personas.telefono')
	      
	        ->first();

	  	return $cliente;
	}
}