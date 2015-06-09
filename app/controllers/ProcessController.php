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

        	return ['message'=>$e->getMessage()];
           
        }
        
        // 1.- Creo el pedido

        $pedido = new Pedido;

        $pedido->importe_total = Input::get('importe');

        $pedido->status_pedidos_id = 1;

        $pedido->save();

        //$carritos = Repositoriocarrito::getArticulosClienteCarrito(Session::get('cliente'));

        DB::table('personas_has_articulos as p_a')

            ->where('p_a.personas_id', '=', Session::get('cliente')->id)

            ->where('p_a.status', '=', 0)
        
            ->update(array(

                'pedidos_id'=> $pedido->id,

                'status'    => 1
            ));
                
        $mensaje = $charge->status;

        $countCarrito = Repositoriocarrito::countCarrito();


        //  Mandamos email al cliente un correo de confirmacion de su compra con su número de pedido
        $nombreCliente = Session::get('cliente')->nombre." ".Session::get('cliente')->apellido_p." ".Session::get('cliente')->apellido_m; 

        $emailCliente = Session::get('cliente')->email;

        $id_pedido = $pedido->id;

        $data = ['nombre'=>$nombreCliente, 'pedido'=>$id_pedido];

        Mail::send('emails.confirmaPedido', $data, function ($message) use($emailCliente){

             //remitente
            $message->from('adancruzhuerta@gmail.com','Muebleria Ureña');

            //asunto
            $message->subject('Mueblería Ureña - Confirmación de pedido');
                
            //receptor
            $message->to($emailCliente);
            
        });
    
        return View::make('tienda.respuesta', compact('mensaje', 'countCarrito'));
	}


}
