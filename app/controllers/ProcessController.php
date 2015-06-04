<?php

class ProcessController extends \BaseController {

	public function __construct()
	{	
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	
	public function payment()
	{
		$importe = Input::get('importe') * 100;

		Conekta::setApiKey("key_iUTmeiqNoshTBUGSMnri2Q");

		try 
		{

            $charge = Conekta_Charge::create([
            
            "amount" => $importe,
            
            "currency" => "MXN",
            
            "description" => "Mueblería Ureña",
            
            "reference_id"=> "orden_de_id_interno",
            
            "card" => $_POST['conektaTokenId']
            
            ]);
        
        } catch (Conekta_Error $e) 
        {
        	//return ['message'=>$e->getMessage()];

        	$mensaje = $e->getMessage();
           
            return View::make('tienda.respuesta', compact('mensaje'));
        }
        
        //return ['message' => $$charge->status];

        $pedido = Pedido::find(Input::get('pedido'));

        $pedido->status_pedidos_id = 1;

        $pedido->save();

        $carritos = Repositoriocarrito::getArticulosClienteCarrito(Session::get('cliente'));

        foreach($carritos as $carrito)
        {
            DB::table('personas_has_articulos')
            
                ->update(array(

                    'status'=> 1
                ));
        }

        $mensaje = $charge->status;
        
        return View::make('tienda.respuesta', compact('mensaje'));
	}


}
