<?php

class ProcessController extends \BaseController {

	public function __construct()
	{	
		$this->beforeFilter('csrf', array('on' => 'post'));
	}

	
	public function payment()
	{
		Conekta::setApiKey("key_iUTmeiqNoshTBUGSMnri2Q");

		try 
		{

            $charge = Conekta_Charge::create([
            
            "amount" => 400000,
            
            "currency" => "MXN",
            
            "description" => "Primer cobro conekta",
            
            "reference_id"=> "orden_de_id_interno",
            
            "card" => $_POST['conektaTokenId']
            
            ]);
        
        } catch (Conekta_Error $e) 
        {
        	//return ['message'=>$e->getMessage()];
           
            return View::make('tienda.respuesta',['message'=>$e->getMessage()]);
        }
        
        //return ['message' => $$charge->status];
        
        return View::make('tienda.respuesta', ['message'=>$charge->status]);
	}


}
