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

       static function countCarrito()
       {

              if (Session::has('cliente'))
              {
              
                     $id_persona = Session::get('cliente')->persona_id;

                     $count = DB::table('personas as p')

                            ->join('personas_has_articulos as p_a', 'p.id', '=', 'p_a.personas_id')

                            ->join('articulos as a', 'p_a.articulos_id', '=', 'a.id')

                            ->where('p.id', '=', $id_persona)

                            ->where('p_a.status', '=', 0)

                            ->select('p_a.id')

                            ->get();

                     $count = count($count);

              }else {

                     $count = 0;
              }

              return $count; 
              
       }

       static function getArticuloExiste($articulo_id)
       {

              $id_persona = Session::get('cliente')->persona_id;

              $existe = DB::table('personas as p')

                            ->join('personas_has_articulos as p_a', 'p.id', '=', 'p_a.personas_id')

                            ->join('articulos as a', 'p_a.articulos_id', '=', 'a.id')

                            ->where('p.id', '=', $id_persona)

                            ->where('a.id', '=', $articulo_id)

                            ->select('p_a.id')

                            ->get();

              if( count($existe) > 0)
              {
                     return true;
              }

              return false;
       }
}