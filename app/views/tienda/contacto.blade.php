@extends('templates.layout_tienda')

@section('contenido')
{{ HTML::style("css/switch.css") }}
{{ HTML::style("css/smoke.css") }}
{{ HTML::script("js/smoke.js") }}

<style>.screen{margin-top: 30px !important;}</style>
<section>
	<div class="container screen">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">Contacto Ureña</h4>
					</div>
					<div class="panel-body">
						<div id="response"></div>
						{{ Form::open(['id'=>'form-message', 'role'=>'form']) }}
							
							<div class="form-group">
								{{ Form::label('nombre', 'Nombre') }}
								{{ Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','required']) }}
							</div>

							<div class="form-group">
								{{ Form::label('email', 'Correo') }}
								{{ Form::email('email',null,['id'=>'email','class'=>'form-control', 'required']) }}
							</div>

							<div class="form-group">
								{{ Form::label('telefono', 'Teléfono') }}
								{{ Form::text('telefono',null,['id'=>'telefono','class'=>'form-control']) }}
							</div>

							<div class="form-group">
								{{ Form::label('mensaje', 'Mensaje') }}
								{{ Form::textarea('descripcion', null, ['class'=>'form-control','rows'=> 5, 'required']) }}
							</div>

							<div class="form-gorup">
								<button type="button" class="btn btn-primary pull-right"><i class="fa fa-envelope-o"></i> Enviar</button>
							</div>

						{{ Form::close() }}
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div class="row">
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<address>
							<strong>Sucursal Pino Suárez (Matriz)</strong><br>
							Ave. Pino Suárez #300, Muebles Ureña<br>
							<i class="fa fa-phone"></i> (123) 456-7890
						</address>
						<div class="thumbnail">
							<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3766.6710012689264!2d-103.73017200000001!3d19.253165000000006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8425454cbc43eb0b%3A0x983d0c0c851e9232!2zTXVlYmxlcsOtYSBVcmXDsWE!5e0!3m2!1ses!2smx!4v1417107519636" ></iframe><br /><small>Ver <a href="https://maps.google.com.mx/maps?f=q&amp;source=embed&amp;hl=es-419&amp;geocode=&amp;q=pedro+a+galvan+226&amp;aq=&amp;sll=19.234442,-103.720403&amp;sspn=0.001902,0.00327&amp;gl=mx&amp;ie=UTF8&amp;hq=&amp;hnear=Pedro+A+Galv%C3%A1n+226,+Colima&amp;t=m&amp;z=14&amp;ll=19.234632,-103.720239" style="color:#0000FF;text-align:left">El Clasico de Clasicos</a> en un mapa ampliado</small>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<address>
							<strong>Sucursal Calzada Pedro A. Galván</strong><br>
							Calzada Pedro A. Galván #226 Sur<br>
							<i class="fa fa-phone"></i> (123) 456-7890
						</address>
						<div class="thumbnail">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3767.0963459523487!2d-103.72023929999999!3d19.2346324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x84255007009d27c5%3A0xd51de61cf6f5c27a!2sPedro+A+Galv%C3%A1n+226%2C+Centro%2C+28000+Colima%2C+COL!5e0!3m2!1ses!2smx!4v1419348076833" width="100%" height="300" frameborder="0" style="border:0"></iframe><br /><small>Ver <a href="https://maps.google.com.mx/maps?f=q&amp;source=embed&amp;hl=es-419&amp;geocode=&amp;q=pedro+a+galvan+226&amp;aq=&amp;sll=19.234442,-103.720403&amp;sspn=0.001902,0.00327&amp;gl=mx&amp;ie=UTF8&amp;hq=&amp;hnear=Pedro+A+Galv%C3%A1n+226,+Colima&amp;t=m&amp;z=14&amp;ll=19.234632,-103.720239" style="color:#0000FF;text-align:left">El Clasico de Clasicos</a> en un mapa ampliado</small>
						</div>
					</div>
				</div>
				<div class="cabecera"><div class="text-cabecera">Síguenos en</div></div>
				<div class="btn-social">
					<center>
						<a href="https://www.facebook.com/urenamuebles?fref=ts" class="icon-button facebook sombra" target="_blank">
							<img src="/img/f.png" class="img-facebook">
							<span></span>
						</a>
						<a href="https://www.youtube.com/user/MUEBLERIAURENA" class="icon-button youtube sombra" target="_blank">
							<img src="/img/yt.png" class="img-facebook">
							<span></span>
						</a>
					</center>
				</div>
			</div>
		</div>
	</div>
</section>
<br>
<br>
<script type="text/javascript" src="js/switch.js"></script>
<script>

	var mensajeTrue  = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><i class="fa fa-check-circle"></i></strong> Tu mensaje ha sido recivido correctamente.</div>';

	var mensajeFalse = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><i class="fa fa-times"></i></strong> Algo ha salido mal, intentalo nuevamente.</div>';

	$("[name='my-checkbox']").bootstrapSwitch();

	$('button').click(function(){
		if($('#form-message').smkValidate()){
			
			var data = $('#form-message').serialize();

			$.ajax({
				type: "post",
				url : "/save-message",
				data: data,
				success: function(response){
					if(response){
						$('#response').html(mensajeTrue);
						$('#form-message')[0].reset();
					}else{
						$('#response').html(mensajeFalse);
					}
				} 
			});
		}
	});
</script>

@stop