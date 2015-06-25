@extends('templates.layout_tienda')

@section('contenido')

{{ HTML::script('https://conektaapi.s3.amazonaws.com/v0.3.0/js/conekta.js') }}

<style>#card-errors{display: none;}.forma-pago{font-size: 20px;}.cvc{font-size: 33px;}.opcion-pago{font-size: 80px; color: #555555;}.proximo{margin-top: 20px;}</style>

<script type="text/javascript">         
    Conekta.setPublishableKey('key_Ht2sG1rHwZeErnsV3oxzGzQ');
</script>

	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-default">
					
					<div class="panel-heading">
				    	<h3 class="panel-title">Formas de pago</h3>
				  	</div>
				  	
				  	<div class="panel-body">
				  		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1 col-lg-offset-1">

				  			<div class="row">
				  				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				  					<h4>Monto a pagar: ${{ number_format($importe) }}.00</h4>
				  				</div>
				  			</div>
							<br>
							<ul class="col-md-12 col-lg-12 nav nav-tabs">
					  			<li class="col-md-6 col-lg-6 active">
					  				<a href="#credit-card" data-toggle="tab"><i class="fa fa-credit-card forma-pago"></i> Tarjeta de Crédito</a>
					  			</li>
					  			<li class="col-md-6 col-lg-6">
					  				<a href="#oxxo" data-toggle="tab"><i class="fa fa-money forma-pago"></i> Pago en Oxxo</a>
					  			</li>
					  		</ul>

					  		<div class="tab-content">
					  				
									<div id="credit-card" class="tab-pane fade in active">

										<div class="col-xs-12 col-md-12 col-md-6 col-lg-6">
											<br>
											<div class="card-errors"></div>
					 
											{{ Form::open(['url'=>'/process/payment','id'=>'card-form','role'=>'form']) }}

					                        <div id="card-errors" class="alert alert-danger"></div>
					                        <br>
					                        <div class="form-group">
					                            <label for="nombretarjetahabiente">Nombre del tarjetahabiente</label>
					                            <input type="text" class="form-control" id="nombretarjetahabiente" placeholder="Ej. Oscar Robles Torres" size="20" data-conekta="card[name]" required/>
					                        </div>
					                        
					                        <div class="form-group">
					                            <label for="tarjeta">Número de la tarjeta de crédito</label>
					                            <input type="text" class="form-control" id="tarjeta" placeholder="Ej. 8712987394503245" size="20" data-conekta="card[number]" smk-type="number" required pattern="[0-9]{16}" title="Ingresa solo 16 dígitos" />
					                        </div>
					                        
					                        <div class="form-group">
					                        	<div class="row">
					                        		<div class="col-xs-12 col-sm-12 col-lg-6 col-lg-6">
														<label>CVC</label>
						                           <input type="text" size="4" class="form-control" data-conekta="card[cvc]" placeholder="* * *" required pattern="[0-9]{3}" title="Ingresa solo 3 dígitos"/>				                        		
						                        	</div>
						                        	<div class="col-xs-12 col-sm-12 col-lg-6 col-lg-6">
														<br>
														<label class="cvc"><i class="fa fa-credit-card"></i> </label> últimos 3 números		                        		
						                        	</div>
					                        	</div>
					                        </div>
					                        
					                        <div class="form-group">
					                            <label>
					                                <span>Fecha de expiración ( MM / AAAA )</span>
					                            </label>
					                            <div class="row">
					                            	<div class="col-xs-12 col-sm-12 col-lg-6 col-lg-6">
					                            		<input type="text" size="2" class="form-control" data-conekta="card[exp_month]" placeholder="MM" required pattern="[0-9]{2}" title="Ingresa solo 2 dígitos"/>
					                            	</div>
					                            	<div class="col-xs-12 col-sm-12 col-lg-6 col-lg-6">
					                            		<input type="text" size="4" class="form-control" data-conekta="card[exp_year]" placeholder="AAAA" required pattern="[0-9]{4}" title="Ingresa solo 4 dígitos"/>
					                            	</div>
					                            </div>
					                        </div>
					                        <input type="hidden" name="importe" value="{{ $importe }}">
					                        <button id="processPayment" class="btn btn-success btn-block" type="submit">Procesar pago</button>
											
											{{ Form::close() }}
										</div>

										<div class="col-xs-12 col-md-12 col-md-6 col-lg-6">
											<br>
											<div class="alert alert-success">
												<center>
													<b>Aceptamos todas las Tarjetas de Crédito.</b><br>
													*Tarjetas de Débito aceptadas <a href="javascript:;" class="bancos" title="HSBC, Banamex, Santander, Inbursa" data-placement="right">Ver</a>
												</center>
											</div>
											
											<div class="row">
												<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
													<center class="opcion-pago">
														<i class="fa fa-cc-mastercard"></i>
														<i class="fa fa-cc-visa"></i>
														<i class="fa fa-cc-amex"></i>	
													</center>
												</div>
											</div>

										</div>

					  				</div>

					  				<div id="oxxo" class="tab-pane fade">

					  					<div class="col-xs-12 col-md-12 col-md-12 col-lg-12">
					  					
											<div class="alert alert-info proximo">
												
												<center>
													<h3>Próximamente</h3>
													<b>Podrás realizar pagos en tus tiendas OXXO</b>
												</center>

											</div>

					  					</div>
						  			
						  			</div>

					  			</div>					  			

					  		</div>

				  		</div>
				  	</div>
				</div>
			</div>
		</div>

	<script type="text/javascript">
		
		jQuery(function($) {
	                
	                
	            var conektaSuccessResponseHandler;
	            conektaSuccessResponseHandler = function(token) {
	                var $form;
	                $form = $("#card-form");

	                /* Inserta el token_id en la forma para que se envíe al servidor */
	                $form.append($("<input type=\"hidden\" name=\"conektaTokenId\" />").val(token.id));

	                /* and submit */
	                $form.get(0).submit();
	            };
	            
	            conektaErrorResponseHandler = function(token) {

	            	var $form;
	                $form = $("#card-form");
	                
	                //console.log(token.message_to_purchaser);
	                var error = '<center><b>'+token.message_to_purchaser+'</b></center>';
	                
	                $("#card-errors").html(error);

	                $("#card-errors").show();
	  				
	  				$('#processPayment').html('Procesar pago');
	  				$form.find("button").prop("disabled", false);
	            };
	            
	            $("#card-form").submit(function(event) {
	                event.preventDefault();
	                var $form;
	                $form = $(this);

	                /* Previene hacer submit más de una vez */
	                $('#processPayment').html('Espere un momento...');
	                $form.find("button").prop("disabled", true);
	                Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
	                /* Previene que la información de la forma sea enviada al servidor */
	                return false;
	            });

	            $('.bancos').tooltip();

	        });
	</script>	
@stop