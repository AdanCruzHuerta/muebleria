<?php

class Repositorioclientes
{
	static function getClientes()
	{
		$clientes = DB::table('personas')

			->join('users', 'personas.users_id', '=', 'users.id')

       		->where('users.roles_id', '=', 1 ) // 1 = cliente

       		->select('personas.id','personas.nombre', 'personas.apellido_p', 'personas.apellido_m', 'users.email', 'personas.telefono')

       		->get();

       	return $clientes;
	}

	static function getClienteDefault($id)
	{

		$cliente = DB::table('personas')

			->join('users', function($join) use($id){

				$join->on('users.id', '=', 'personas.users_id')
				
					->where('personas.id', '=', $id);	

			})->select('users.email','users.photo_user','personas.nombre','personas.apellido_p',

	        		 'personas.apellido_m','personas.ciudad','personas.calle','personas.codigo_postal',

	        		 'personas.numero_ext','personas.numero_int','personas.telefono','personas.status')	        
	      
	        ->first();

	  	return $cliente;
	}

	static function getClienteComplete($id)
	{
		$cliente = DB::table('personas')

			->join('users', function($join) use($id){

				$join->on('users.id', '=', 'personas.users_id')
				
					->where('personas.id', '=', $id);	

			})->join('municipios', function($join){

	        	$join->on('municipios.id', '=', 'personas.municipio_id');
	        
	        })->join('estados', function($join){

	        	$join->on('estados.id', '=', 'municipios.estado_id');

	        })->select('users.email','users.photo_user','personas.nombre','personas.apellido_p',

	        		 'personas.apellido_m','personas.ciudad','personas.calle','personas.codigo_postal',

	        		 'personas.numero_ext','personas.numero_int','personas.telefono','personas.status',

	        		 'municipios.nombre as municipio','estados.nombre as estado')	        
	      
	        ->first();

	  	return $cliente;
	}
}