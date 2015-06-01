<?php

class Repositoriocarrito {

	static function getArticulosCliente($id_persona)
	{
		$articulos = DB::table('personas_has_articulos as p_a')

			->join('articulos as a', 'p_a.articulos_id', '=', 'a.id')

       		->where('p_a.status', '=', 0 ) // 0 = pendientes

       		->select('a.nombre','p_a.id','p_a.importe','p_a.cantidad')

       		->get();

       	return $articulos;
	}

}