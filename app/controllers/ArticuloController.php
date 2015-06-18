<?php

class ArticuloController extends \BaseController {

	public function __construct()
	{
		$this->beforeFilter('csrf', ['on' => 'post']);

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


	public function index()
	{
		$administrador = $this->administrador;

		$mensajes = $this->messages;

		$articulos = DB::table('articulos')->paginate(6);
		
		return View::make('administrador.productosArticulos', compact('administrador','articulos','mensajes'));
	}


	public function store()
	{

		try{
        // almacenamos imagen en el servidor

	        $file = Input::file('imagen');

	        $name = $file->getClientOriginalName();	//	---> nombre de imagen

	        $dir = public_path().'/img/articulos/'.Input::get('nombre_categoria');	//  ---> ruta relativa dir

	        $articulo = new Articulo();

	        $articulo->nombre           = trim(ucwords(Input::get('nombre')));

	        $articulo->precio 			= Input::get('precio');

	        $articulo->descripcion      = Input::get('descripcion');

	        $articulo->ruta_corta       = '/img/articulos/'.Input::get('nombre_categoria').'/'.$name;

	        $articulo->ruta_absoluta    = $dir.'/'.$name;

	        $articulo->slug 			= trim(Str::slug(Input::get('nombre')));

	        $articulo->provedores_id	= Input::get('proveedor');			  

	        if( $file->move($dir, $name) ):			//  ---> Sube en Servidor

	            if($articulo->save()):

	            	Image::make( $articulo->ruta_absoluta )->resize(700, 500)->save($articulo->ruta_absoluta);

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
		catch( Exception $e )
		{	
			return Redirect::back()->withErrors(['error', true]);
		}
	}

	public function show($name)
	{

		$countCarrito = Repositoriocarrito::countCarrito();

        $articulo = Helper::getArticulo($name);

        return View::make('tienda.producto', compact('articulo','countCarrito'));
	}

	public function update()
	{
		
	}

	public function destroy()
	{
		$articulo = Articulo::find(Input::get('id'));

		if($articulo->delete())
		{

			return Response::json(true);
			
		}

		return Response::json(false);

	}


}
