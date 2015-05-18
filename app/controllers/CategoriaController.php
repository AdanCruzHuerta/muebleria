<?php

class CategoriaController extends \BaseController {

	public function __construct()
	{
		$this->beforeFilter('@getAdmin', ['only' => ['index','getCategorias']]);

        $this->beforeFilter('@getMessages', ['only' => ['index','getCategorias']]);
	}

	public function getAdmin()
	{
		$this->administrador = Config::get('constants.DATA_ADMIN');
	}

    public function getMessages()
    {
        $this->messages = Config::get('constants.DATA_MESSAGES');
    }

	/**
	 * Mostrar categorias que pertenecen a la raiz
	 *
	 * @return Response
	 */
	public function index()
	{
        $administrador = $this->administrador;

        $mensajes = $this->messages;

        $categoriaActual = Categoria::find(1);

        $categorias = Helper::categorias($categoriaActual);

		return View::make('administrador.productosCategorias', compact('administrador','categoriaActual','categorias','mensajes'));

	}

    /**
     * Mostrar categorias que pertenecen a una categoria
     *
     * @return Response
     */
    public function getCategorias($nombre)
    {
        $administrador = $this->administrador;

        $mensajes = $this->messages;

        $categoriaActual = DB::table('categorias')->where('slug', '=', $nombre)->first();

        $categorias = Helper::categorias($categoriaActual);

        $articulos = Helper::getArticulos($categoriaActual);

        $new = false;

        if(Session::get('message')):

            $new = true;

        endif;

        return View::make('administrador.productosCategorias', compact('administrador','categoriaActual','categorias','articulos','new','mensajes'));
    }

	/**
	 * Guardar categorias del sistema
	 *
	 * @return Response
	 */
	public function store()
	{
        $id = Input::get('categoria_id_padre');

        $nombre = trim(strtoupper(Input::get('nombre')));

        $categoria_existe = DB::table('categorias')->where('nombre','=', $nombre)->get();

        if($categoria_existe):                                          //  Existe la categoria

            $validaCategoria = Helper::validaCategoria($id, $nombre);

            if($validaCategoria->estatus == 1):                         // Categoria habilitada

                return Response::json(false);

            else:                                                       // Categoria deshabilitada

                $habilitaCategoria = Helper::habilitaCategoria($id, $nombre);

                if($habilitaCategoria):

                    return Response::json(true);

                else:

                    return Response::json(false);

                endif;

            endif;

        else:

            $categoria = new Categoria;

            $categoria->nombre = trim(strtoupper(Input::get('nombre')));

            $categoria->nivel_actual = Input::get('nivel_actual') + 1;

            $categoria->slug = trim(Str::slug(Input::get('nombre')));

            if($categoria->save()):

                if(DB::table('categorias_has_categorias')->insert([

                    'categorias_id_padre'   => Input::get('categoria_id_padre'),

                    'categorias_id_hijo'  => $categoria->id
                ])):

                    //creamos carpeta de categorias en public/img/articulos

                    $path = public_path().'/img/articulos/'.$categoria->nombre;

                    File::makeDirectory($path, $mode = 0777, true, true);

                    return Response::json(true);

                else:

                    return Response::json(false);

                endif;

            else:

                return Response::json(false);

            endif;

        endif;
	}

	/**
	 *  Renombrar categorias
	 *
	 * @return Response
	 */
	public function update()
	{
		$categoria = Categoria::find(Input::get('id'));

        $categoria->nombre = trim(strtoupper(Input::get('nombre')));

        $categoria->slug = trim(Str::slug(Input::get('nombre')));

        if($categoria->save()):

           return Response::json(true);

        else:

            return Response::json(false);

        endif;
    }

	/**
	 * Da de baja una categoria de seccion
	 *
	 * @return Response
	 */
	public function destroy()
	{
        $delete = DB::table('categorias_has_categorias')

                    ->where('categorias_id_padre', Input::get('id_padre'))

                    ->where('categorias_id_hijo', Input::get('id_hijo'))

                    ->update(['estatus' => 0]);

        if($delete):

            return Response::json(true);

        else:

            return Response::json(false);

        endif;
	}
}
