<?php

/*
|--------------------------------------------------------------------------
| 		Application Routes Muebleria Ureña
| 		Desarrollado por SharkSoft 2015.
|--------------------------------------------------------------------------
|
*/

Route::get('/', function(){

	$sliders = Helper::SlidersInicio();

    $articulos = Helper::ArticulosInicio();

    $video = Video::where('status','=',1)->first();

	return View::make('tienda.inicio', compact('sliders','articulos','video'));
});

Route::get('/productos', function(){

    $categorias = Helper::getCategoriasRaiz();

    $articulos = Helper::ArticulosProductos();

	return View::make('tienda.productos', compact('categorias','articulos'));

});

Route::get('/contacto', function(){

	return View::make('tienda.contacto');

});

Route::get('/tienda', function(){

	return View::make('tienda.tienda');

});



Route::get('/productos/{name}', 'ArticuloController@show');

Route::get('/productos/categoria/{name}', function($name){

    $categorias = Helper::getCategoriasRaiz();

    $articulos = Helper::ArticulosProductos();
    //$articulos = Helper::getArticulosForName($name);

    return View::make('tienda.productos', compact('categorias','articulos'));

});

Route::get('/producto/nuevo/{name}','ArticuloController@show');

Route::post('/save-message', 'messageController@store');

Route::get('/cuenta', function(){
	
	return View::make('tienda.cuenta');

});

Route::get('/carrito', function(){
	
	return View::make('tienda.carrito');

});

Route::post('/registrar-usuario', 'userController@store');

Route::get('/administrador', 'LoginController@Administrador');

Route::post('/login','LoginController@store');

/*
|--------------------------------------------------------------------------
| 		Rutas privadas de la aplicación
|--------------------------------------------------------------------------
*/

Route::group(['before'=>'auth'], function(){

	/*
	|--------------------------------------------------------------------------
	| 		Rutas de Administrador
	|--------------------------------------------------------------------------
	*/

    Route::get('/administrador/empleados','EmpleadosController@index');

	Route::get('/administrador/panel','AdminController@index');

	Route::post('/administrador/panel/change-messages', 'PaginaController@changeMessages');

	Route::get('/administrador/perfil','AdminController@edit');

	Route::post('/administrador/perfil/update','AdminController@update');

	/*
		Rutas del módulo de "USUARIOS DEL SISTEMA"
	 */

	Route::get('/administrador/pagina/empleados', 'EmpleadoController@index');
	
	/*
	 *	Rutas de módulo de la "PÁGINA"
	 */ 
	Route::get('/administrador/pagina/slider','PaginaController@slider');

	Route::post('/administrador/pagina/delete-slider','PaginaController@deleteSlider');

	Route::post('/administrador/pagina/subir-slider','PaginaController@subirSlider');

	Route::post('/administrador/pagina/update-slider','PaginaController@updateSlider');

	Route::post('/administrador/pagina/municipios', 'PaginaController@municipios');

	Route::get('/administrador/pagina/videos', 'PaginaController@videos');

	Route::post('/administrador/pagina/videos/add', 'PaginaController@videoStore');

	Route::get('/administrador/pagina/videos/change/{id}', 'PaginaController@changeVideo');

	Route::post('/administrador/pagina/videos/delete', 'PaginaController@deleteVideo');

	/*
	 *	Rutas de módulo del "CLIENTES"
	 */ 

	 Route::get('/administrador/clientes','ClienteController@index');

	 Route::get('/administrador/clientes/show/{id}','ClienteController@show');

	/*
	 *	Rutas de módulo de "FLETERAS"
	 */ 

	Route::get('/administrador/fleteras','FleteraController@index');

	Route::get('/administrador/fleteras/add-fletera','FleteraController@create');

	Route::post('/administrador/fleteras/guardar-fletera', 'FleteraController@store');

	Route::get('/administrador/fleteras/editar/{id}', 'FleteraController@edit');

	Route::post('/administrador/fleteras/update', 'FleteraController@update');

	Route::post('/administrador/fleteras/delete', 'FleteraController@destroy');

	/*
	 *	Rutas de módulo de "PROVEEDORES"
	 */ 

	Route::get('/administrador/proveedores','ProveedorController@index');

	Route::get('/administrador/proveedores/add-proveedor','ProveedorController@create');

	Route::post('/administrador/proveedores/guardar-proveedor','ProveedorController@store');

	Route::get('/administrador/proveedores/editar/{id}','ProveedorController@edit');

	Route::post('/administrador/proveedores/update', 'ProveedorController@update');

	Route::post('/administrador/proveedores/delete', 'ProveedorController@destroy');

	/*
	 *	Rutas de módulo de "VENTAS"
	 */ 

	Route::get('/administrador/ventas','PaginaController@ventas');

	/*
	 *	Rutas de módulo de "PEDIDOS"
	 */

	//Route::get('/administrador/pedidos','PaginaController@pedidos');

	/*
	 *	Rutas de módulo de "PRODUCTOS"
	 */ 

	Route::get('/administrador/productos/categorias','CategoriaController@index');

	Route::post('/administrador/productos/categorias/nuevacategoria','CategoriaController@store');

    Route::post('/administrador/productos/categorias/update', 'CategoriaController@update');

    Route::post('/administrador/productos/categorias/delete', 'CategoriaController@destroy');

    Route::get('/administrador/productos/categorias/{name}', 'CategoriaController@getCategorias');

	Route::get('/administrador/productos/articulos','ArticuloController@index');

    Route::post('/administrador/productos/articulos/create','ArticuloController@store');

	/*
	 *  Ruta de Logout
	 */
	
	Route::get('/administrador/logout','LoginController@destroy');


	/*
	|--------------------------------------------------------------------------
	| 		Rutas de Cliente
	|--------------------------------------------------------------------------
	*/


	/*
	|--------------------------------------------------------------------------
	| 		Rutas de Empleado
	|--------------------------------------------------------------------------
	*/
	

});

/*
|--------------------------------------------------------------------------
| 		Rutas de prueba y clouseres
|--------------------------------------------------------------------------
*/


/**
 * Agregar nuevo administrador.
 */
Route::get('/add-admin',function(){

	$usuario = new User;

	$usuario->email = "adancruzhuerta@gmail.com";

	$usuario->password = Hash::make('12345');

	$usuario->photo_user = "/img/users/perfil_default.png";

	$usuario->roles_id = 3; // 3 = GERENTE

	$usuario->save();

	$persona = new Persona;

	$persona->nombre = "ADÁN";

	$persona->apellido_p = "CRUZ";

	$persona->apellido_m = "HUERTA";

	$persona->users_id = $usuario->id;

	$persona->municipio_id = 37; // colima

	$persona->save();

	return Redirect::to('/administrador');
	
});

/**
 * Agregar nueva imagen de slider.
 */

Route::get('/add-slider', function(){

	$slider = new Slider;

	$slider->nombre = "slider1.jpg";

	$slider->status_slider = "1";

	$slider->ruta_slider = "/img/slider/slider1.jpg";

	$slider->save();

	return "Imagen de slider agregada";

});

/*
 *	Agregar categoria raiz
 */
Route::get('/add-category', function(){

	$categoria = new Categoria;

	$categoria->nombre = "raiz";

	$categoria->save();

	return Redirect::to('/administrador/productos/categorias');

});

/*
 *	Jugando con cadenas
 */

Route::get('cadena', function(){
    
    $cadena1 = "Cocina Integral";

    $cadena2 = strtolower(str_replace(" ","-",$cadena1));

    return $cadena2;

});

Route::get('/prueba-ruta', function(){

    return Request::url();

});

Route::get('/resize', function(){

	$articulos = Articulo::all();

	foreach($articulos as $articulo){
			
		$img = Image::make( $articulo->ruta_absoluta )->resize(500, 430)->save($articulo->ruta_absoluta);
	
	}	

	return "Imagenes redimencionadas";

});

Route::get('/slug-articulo', function(){

	$articulos = Articulo::all();

	foreach($articulos as $articulo){
		
		echo $articulo->slug."</br>";	
	
	}

});

Route::get('make-slug', function(){

	$slug = "Hola Mundo en un slug";
	
	$slug = Str::slug($slug);

	return $slug;

});