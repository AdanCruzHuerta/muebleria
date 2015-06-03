<?php

class Repositoriocarrito {

	static function getArticulosCliente($cliente)
	{

		$articulos = DB::table('personas_has_articulos as p_a')

			->join('articulos as a', 'p_a.articulos_id', '=', 'a.id')

       		->where('p_a.personas_id', '=', $cliente->id)

       		->where('p_a.status', '=', 0 ) // 0 = pendientes

       		->select('a.nombre','a.precio','p_a.id','p_a.importe','p_a.cantidad','p_a.pedidos_id')

       		->get();

       	return $articulos;
	}

	static function getArticulosClienteCarrito($id_persona)
	{
		$carrito = DB::table('personas_has_articulos as p_a')

       		->where('p_a.personas_id', '=', $id_persona->id)

       		->where('p_a.status', '=', 0 ) // 0 = pendientes

       		->select('p_a.*')

       		->get();

       	return $carrito;
	}

}