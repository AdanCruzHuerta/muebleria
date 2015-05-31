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

	public function index()
	{
        $administrador = $this->administrador;

        $mensajes = $this->messages;    

        $categoriaActual = Categoria::find(1); // obtenemos la categoria raiz

        $categorias = Helper::categorias($categoriaActual); //categorias cuyo padre es raiz

		return View::make('administrador.productosCategorias', compact('administrador','categoriaActual','categorias','mensajes'));

	}

    public function getCategorias($nombre)
    {
        $administrador = $this->administrador;

        $mensajes = $this->messages;

        $categoriaActual = DB::table('categorias')->where('slug', '=', $nombre)->first();

        $articulos = Helper::getArticulos($categoriaActual->id);

        $proveedores = Proveedor::all();

        $new = false;

        if(Session::get('message')):

            $new = true;

        endif;

        return View::make('administrador.productosCategorias', compact('administrador','categoriaActual','articulos','new','mensajes','proveedores'));
    }

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
