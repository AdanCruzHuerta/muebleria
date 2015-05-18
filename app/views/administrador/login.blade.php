<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Mueblería Ureña</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Pagina de administrador de Mueblería Ureña">
    <meta name="author" content="SharkSoft - Mueblería Ureña">
	<link rel="icon" href="/img/favicon/favicon.ico">
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/login.css') }}
	{{ HTML::script('js/jquery.min.js') }}
	{{ HTML::script('js/bootstrap.min.js') }}
</head>
<body>
	<header>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<h3>ACCESO A ADMINISTRADOR</h3>
				</div>
			</div>
		</div>
	</header>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<center>
						<img src="/img/logos/urena.png" class="logo-urena">
					</center>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-xs-offset-0 col-sm-offset-3 col-md-offset-4 col-lg-offset-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Iniciar Sesión</h3>
						</div>
						<div class="panel-body">
							@if(Session::get('error'))
								<div class="row">
									<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1  alert alert-danger">
										<button type="button" class="close" data-dismiss="alert">&times;</button>
										<center>Usuario y Password incorrectos!!</center>
									</div>
								</div>
							@endif
							{{ Form::open(array('url' => '/login')) }}

								<div class="form-group">
									{{ Form::email('email','',array('class'=>'form-control', 'placeholder' => 'Email','required')) }}
								</div>

								<div class="form-group">
									{{ Form::password('password', array('class'=>'form-control','placeholder'=>'Password','required')) }}
								</div>
									{{ Form::submit('Entrar', array('class'=>'btn btn-primary btn-block'))}}
							    
							{{ Form::close() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<footer>
		<center>
			<p>Derechos reservados ©2015 Mueblería Ureña. Desarrollado por: <a href="http://sharksoft.com.mx" target="_blank">SharkSoft</a></p>
		</center>
	</footer>
</body>
</html>