<?php

class ArticuloController extends \BaseController {

	public function __construct()
	{
		$this->beforeFilter('@getAdmin', ['only' => ['index']]);

		$this->beforeFilter('@getMessages', ['only' => ['index']]);
	}

	public function getAdmin()
	{
		$this->administrador = Config::get('constants.DATA_ADMIN');
	}

	public function getMessages()
	{
		$this->messages = COnfig::get('constants.DATA_MESSAGES');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$administrador = $this->administrador;

		$mensajes = $this->messages;

		$articulos = DB::table('articulos')->paginate(9);

		return View::make('administrador.productosArticulos', compact('administrador','articulos','mensajes'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        // almacenamos imagen en el servidor

        $file = Input::file('imagen');

        $name = $file->getClientOriginalName();	//	---> nombre de imagen

        $dir = public_path().'/img/articulos/'.Input::get('nombre_categoria');	//  ---> ruta relativa dir

        $articulo = new Articulo();

        $articulo->nombre           = trim(ucwords(Input::get('nombre')));

        $articulo->descripcion      = Input::get('descripcion');

        $articulo->ruta_corta       = '/img/articulos/'.Input::get('nombre_categoria').'/'.$name;

        $articulo->ruta_absoluta    = $dir.'/'.$name;

        $articulo->slug 			= trim(Str::slug(Input::get('nombre')));			  

        if( $file->move($dir, $name) ):			//  ---> Sube en Servidor

            if($articulo->save()):

            	Image::make( $articulo->ruta_absoluta )->resize(800, 400)->save($articulo->ruta_absoluta);

                $categoria_articulo =  DB::table('categorias_has_articulos')->insert([

                                            'categorias_id'   => Input::get('id_categoria'),

                                            'articulos_id'  => $articulo->id
                                        ]);

                if($categoria_articulo):

                    return Redirect::action('CategoriaController@getCategorias', ['nombre'=>Input::get('nombre_categoria')])->with('message', true);

                else:

                    return false;

                endif;

            else:

                return false;

            endif;

        else:

        endif;
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  string  $name
	 * @return Response
	 */
	public function show($name)
	{
        $articulo = Helper::getArticulo($name);

        return View::make('tienda.producto', compact('articulo'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
