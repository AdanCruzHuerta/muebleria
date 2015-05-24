<?php

class Helper {

    /*
     *  Metodo que obtiene todas las categorias
     *  de una determinada categoria.
     */
    static function categorias($categoriaActual)
    {
        $categorias = DB::table('categorias as c')

            ->join('categorias_has_categorias as c_c', function($join) use($categoriaActual){

                $join->on('c.id', '=' ,'c_c.categorias_id_padre')

                    ->where('c_c.categorias_id_padre', '=', $categoriaActual->id)

                    ->where('c_c.estatus', '=', 1);

            })->join('categorias as c2', function($join){

                $join->on('c_c.categorias_id_hijo','=','c2.id');

                })->select('c2.id', 'c2.nombre', 'c2.nivel_actual', 'c2.slug', 'c2.created_at','c.slug as slug_padre')

                ->get();

        return $categorias;
    }

    static function getCategoriasRaiz()
    {
        $categorias = DB::table('categorias as c')

            ->join('categorias_has_categorias as c_c', function($join) {

                $join->on('c.id','=','c_c.categorias_id_padre')

                    ->where('c_c.categorias_id_padre', '=', 1);

            })->join('categorias as c2', function($join){

                $join->on('c_c.categorias_id_hijo', '=', 'c2.id');

            })->get();

        return $categorias;
    }

    /*
     * Metodo que valida el estatus de una categoria,
     * contenida en otra categoria "Salas/finas".
     */
    static function validaCategoria($id, $nombre)
    {
        $response = DB::table('categorias as c')

            ->join('categorias_has_categorias as c_c', function($join) use($id){

                $join->on('c.id', '=', 'c_c.categorias_id_padre')

                    ->where('c_c.categorias_id_padre', '=', $id);

            })->join('categorias as c2', function($join) use($nombre){

                $join->on('c_c.categorias_id_hijo', '=','c2.id')

                    ->where('c2.nombre', '=', $nombre);

            })->select('c_c.estatus')

            ->first();

        return $response;
    }

    /*
     * Metodo que habilita el estatus de una categoria
     * en una categoria determinada.
     */
    static function habilitaCategoria($id, $nombre)
    {
        $row = DB::table('categorias as c')

            ->join('categorias_has_categorias as c_c', function($join) use($id){

                $join->on('c.id', '=', 'c_c.categorias_id_padre')

                    ->where('c_c.categorias_id_padre', '=', $id);

            })->join('categorias as c2', function($join) use($nombre){

                $join->on('c_c.categorias_id_hijo', '=','c2.id')

                    ->where('c2.nombre', '=', $nombre);

            })

            ->select('c_c.id')

            ->first();

        $response = DB::table('categorias_has_categorias')

                        ->where('id', $row->id)

                        ->update(['estatus' => 1]);

        return $response;
    }

    static function getArticulos($id)
    {
        $articulos = DB::table('categorias as c')

            ->join('categorias_has_articulos as c_a', function($join) use($id){

                $join->on('c.id','=','c_a.categorias_id')

                    ->where('c.id','=', $id);

            })->join('articulos as a', function($join){

                $join->on('c_a.articulos_id','=','a.id');

            })->select('a.id','a.nombre','a.ruta_corta')

            ->paginate(6);

        return $articulos;
    }

    static function getArticulosForName($name)
    {
        $name = strtoupper($name);

        $articulos = DB::table('categorias as c')

            ->join('categorias_has_articulos as c_a', function($join) use($name){

                $join->on('c.id','=','c_a.categorias_id')

                    ->where('c.nombre','=', $name);

            })->join('articulos as a', function($join){

                $join->on('c_a.articulos_id','=','a.id');

            })->select('a.id','a.nombre','a.ruta_corta','a.slug')

            ->paginate(6);

        return $articulos;
    }

    static function getArticulo($name)
    {
        $articulo = Articulo::where('slug','=', $name)->first();

        return $articulo;
    }

    static function SlidersInicio()
    {
        $slider = Slider::where('status_slider', '=', 1)->get(); // status_slider "1" = visibles

        return $slider;
    }

    static function ArticulosInicio()
    {
        return Articulo::orderBy('id', 'DESC')->take(4)->get();
    }

    static function ArticulosProductos()
    {
        return Articulo::orderBy('id','DESC')->paginate(6);
    }
}