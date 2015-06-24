<?php

class PaginaController extends \BaseController {

	public function __construct()
	{	
		$this->beforeFilter('@getAdmin', ['only' => ['slider','getSlider','ventas','videos']]);

		$this->beforeFilter('@getMessages', ['only' => ['slider','ventas','videos']]);
	}

	public function getAdmin()
	{
		$this->administrador = Config::get('constants.DATA_ADMIN');
	}

	public function getMessages()
	{
		$this->messages = Config::get('constants.DATA_MESSAGES');
	}

	/*
	 * Cambia el status de todas los mensajes
	 */
	public function changeMessages()
	{
		$mensajes = Mensaje::where('status', '=', '0')->get();

		foreach($mensajes as $mensaje)
		{
			$mensaje->status = 1;
   	 		
   	 		$mensaje->save();
		}

		return Response::json(true);		
	}

	/*
	|--------------------------------------------------------------------------
	| 		Módulo Pagina 
	|--------------------------------------------------------------------------
	*/

	/**
	 * Funcion que muestra las imagenes del slider principal.
	 */
	public function slider()
	{
		$sliders = Slider::all();

		$administrador = $this->administrador;

		$mensajes = $this->messages;

		if(Session::get('error')):

			$error 	= true;

			return View::make('administrador.slider', compact('sliders','administrador','error','mensajes'));

		endif;

		$error 	= false;

		return View::make('administrador.slider', compact('sliders','administrador','error','mensajes'));
	}

	/**
	 * Funcion que sube la imagen al servidor
	 */
	public function subirSlider()
	{
		if(count(Slider::all()) == 5):

			return false;

		endif;

		$file = Input::file('file');
		
		$name = $file->getClientOriginalName();	//	---> nombre de imagen
		
		$dir = public_path().'/img/slider/';	//  ---> ruta relativa dir
		
		$slider = new Slider;

		$slider->nombre = $name;

		$slider->status_slider = 1; 			//  ---> activo

		$slider->ruta_corta = '/img/slider/'.$name;

		$slider->ruta_absoluta = $dir.$name;

		if( $file->move($dir, $name) ):			//  ---> Sube en Servidor

			// Redimencionamos imagen
			
			$img = Image::make( $dir.$name )->resize(2048, 762)->save($dir.'/'.$name);
			
			if($slider->save()):				//  ---> Sube en BD

				return Response::json(true);

			else:

				return Response::json(false);

			endif;

		else:

			return Response::json(false);

		endif;
	}

	/**
	 * Funcion que actualiza el status de las imagenes del slider
	 */
	public function updateSlider()
	{
		 if(Request::ajax()):

		 	$slider = count(Slider::where('status_slider', '=', 1)->get());

		 	$item = Slider::find(Input::get('id'));

		 	if($slider > 1 || Input::get('status') == 0):

		 		$status = $item->status_slider;

		 		if($status == 1):

		 			$item->status_slider = 0;

		 			if($item->save()):

		 				return Response::json(array("resp" => true, "mensaje" => "El cambio fue realizado"));

		 			else:

		 				return Response::json(array("resp" => false, "mensaje" => "No se pudo deshabilitar slider"));

		 			endif;

		 		else:

		 			$item->status_slider = 1;

		 			if($item->save()):

		 				return Response::json(array("resp" => true, "mensaje" => "El cambio fue realizado"));

		 			else:

		 				return Response::json(array("resp" => false, "mensaje" => "No se pudo deshabilitar slider"));

		 			endif;

		 		endif;

		 	else:

		 		return Response::json(array("resp" => false , "mensaje" => "Debe haber por lo menos 1 imagen visible"));

		 	endif;

		 endif;
	}

	/**
	 * Funcion que elimina un elemento del slider
	  * @param  int  $id
	 */
	public function deleteSlider()
	{
		$slider = Slider::find(Input::get('id'));

		if(unlink(public_path().$slider->ruta_corta)): 	//borra en el servidor

			$slider->delete();				//borra en BD

			return Response::json(true);

		endif;

		return Response::json(false);
	}

	/**
	 * Funcion que obtiene todos los municipios
	 */
	public function municipios()
	{
		$estado_id = Input::get('estado');

		$municipios = DB::table('municipios')->where('estado_id', $estado_id)->get();

		return $municipios;	
	}

	/*
	 *	Funcion que muestra los videos actuales del sistema
	 */
	public function videos()
	{
		$videos = Video::all();

		$administrador = $this->administrador;

		$mensajes = $this->messages;

		return View::make('administrador.videos', compact('videos','administrador','mensajes'));
	}

	public function videoStore()
	{
		if (Request::ajax())
		{
			$videos = Video::all();

			foreach($videos as $video)
			{
				$video->status = 0;

				$video->save();
			}

			$video = new Video;

			$video->nombre = Input::get('nombre');

			$video->frame = Input::get('frame');

			if($video->save())
			{
				return Response::json(true);
			}

			return Response::json(false);

		}
	}

	public function changeVideo($id)
	{
		$videos = Video::all();
		
		foreach($videos as $v)
		{
			$v->status = 0;

			$v->save();
		}

		$video = Video::find($id);

		$video->status = 1;

		$video->save();

		return Redirect::to('/administrador/pagina/videos');
	}

	public function deleteVideo()
	{
		$video = Video::find(Input::get('id'));

		if($video->delete())
		{
			return Response::json(true);
		}

		return Response::json(false);
	}

	/*
	|--------------------------------------------------------------------------
	| 		Módulo Ventas
	|--------------------------------------------------------------------------
	*/

	public function ventas()
	{
		$administrador = $this->administrador;

		$mensajes = $this->messages;

		return View::make('administrador.ventas', compact('administrador','mensajes'));
	}
}
