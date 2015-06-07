<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8"/>
		<title>Mueblería Ureña</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="description" content="Tienda en línea de Mueblería Ureña, Mueblería Ureña Para toda la vida">
    	<meta name="author" content="SharkSoft - Mueblería Ureña">
		<link rel="icon" href="/img/favicon/favicon.ico">
		{{HTML::style('css/bootstrap.min.css')}}
		{{HTML::style('css/font-awesome.min.css')}}
		{{HTML::style('css/animate.min.css')}}
		{{HTML::style('css/bootstrap-slider.css')}}
		{{HTML::style('css/normalize.css')}}
		{{HTML::style('css/urena-tienda.css')}}
	</head>
	<body>
		<nav class="visible-xs">
			<div class="navbar navbar-fixed-top navbar-default">
				<div class="container">
					<div class="navbar-header">
						<button data-toggle="collapse-side" data-target=".side-collapse" data-target-=".side-collapse-container" type="button" class="navbar-toggle pull-left">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<div class="navbar-default side-collapse in">
						<div role="navigation" class="navbar-collapse">
							<ul class="nav navbar-nav">
								<li><a href="/">Inicio</a></li>
								<li><a href="/productos">Productos</a></li>
								<li><a href="/contacto">Contacto</a></li>
								<li><a href="/tienda">Tienda en Línea</a></li>
								@if(Auth::user())

									@if(Auth::user()->roles_id == 1)
										
										<li><a href="/cliente/perfil">Perfil</a></li>

									@endif
								@else 
									<li><a href="/cuenta">Iniciar Sesion / Registrate</a></li>
								@endif
								<li><a href="/carrito">Ver carrito</a></li>
								<li><a href="/salir">Salir</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>
		<div class="side-collapse-container">
			<header>
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="text-center">
								<img src="/img/logos/logo-header.png" class="logo-urena">
							</div>
							<div class="hidden-xs">

								@if(Auth::user()) 

									@if(Auth::user()->roles_id == 1)
									
											<button id="opciones_tienda_2" type="button" class="btn btn-default btn-lg pull-right dropdown-toggle" data-toggle="dropdown">{{ Session::get('cliente')->nombre." ".Session::get('cliente')->apellido_p }} <i class="fa fa-caret-down"></i></button>

											<ul class="dropdown-menu pull-right opciones-user" role="menu">
												<li><a href="/cliente/perfil"><i class="fa fa-user"></i> Perfil</a></li>
												<li><a href=""><i class="fa fa-money"></i> Mis compras</a></li>
												<li><a href="/salir"><i class="fa fa-sign-out"></i>Salir</a></li>
											</ul>

											<a href="/carrito" id="carrito_compra" type="button" class="btn btn-default btn-lg pull-right" title="Mi carrito"><i class="fa fa-shopping-cart"></i></a>

									@else

										<a href="/cuenta" id="opciones_tienda_1" type="button" class="btn btn-default btn-lg pull-right opciones_cliente" title="Iniciar Sesión / Registrarse"><i class="fa fa-user"></i></a>

									@endif

								@else

									<a href="/cuenta" id="opciones_tienda_1" type="button" class="btn btn-default btn-lg pull-right opciones_cliente" title="Iniciar Sesión / Registrarse"><i class="fa fa-user"></i></a>

								@endif
								
							</div>
						</div>
					</div>
				</div>
			</header>
			<nav class="hidden-xs">
					<div class="container">
						<div class="navbar navbar-default">
							<div class="container-fluid">
								<ul class="nav nav-justified">
									<?php
										$path  = Request::path();
										$route = Route::getCurrentRoute()->getPath();
									?>

									<li class="@if( $path =='/' || $path == 'cuenta'){{'activo'}} @endif">
										<a href="/" class="btn_nav">Inicio</a>
									</li>
									<li class="@if($path =='productos' || $path == 'productos/filter' || $route == 'productos/categoria/{name}' || $route == 'producto/nuevo/{name}' || $route == 'productos/{name}'){{'activo'}} @endif">
										<a href="/productos" class="btn_nav">Productos</a>
									</li>
									<li class="@if($path =='contacto'){{'activo'}} @endif">
										<a href="/contacto" class="btn_nav">Contacto</a>
									</li>
									<li class="@if($path =='tienda'){{'activo'}} @endif">
										<a href="/tienda" class="btn_nav">Tienda en Línea</a>
									</li>
								</ul>
				          	</div>
						</div> 
					</div>
				</nav>
				{{HTML::script('js/jquery.min.js')}}
				{{HTML::script('js/bootstrap.min.js')}}
				{{HTML::script('js/bootstrap-slider.js')}}

				@yield('contenido')
				
				<footer>
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-8 col-lg-8 separador">
								<label class="txt1-footer">Somos distribuidores de las mejores marcas</label>
								<div class="row">
									<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
										<div class="img-logo">
											<img class="img-responsive-height" src="/img/logos/boal.png"/>
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
										<div class="img-logo">
											<img class="img-responsive-height" src="/img/logos/lizmueble.png"/>
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
										<div class="img-logo">
											<img class="img-responsive-height" src="/img/logos/lomalta.png"/>
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
										<div class="img-logo">
											<img class="img-responsive-height" src="/img/logos/selther.png"/>
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
										<div class="img-logo">
											<img class="img-responsive-height" src="/img/logos/spring.png"/>
										</div>
									</div>
									<div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
										<div class="img-logo">
											<img class="img-responsive-height" src="/img/logos/sealy.png"/>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
								<div class="text-center">
									<img src="/img/logos/urena.png" class="hidden-xs logo-urena">
									<br>
									<label>Derechos reservados ©2015 Mueblería Ureña</label>
									<br>
									<label>Desarrollado por: <a href="http://sharksoft.com.mx" target="_blank">Shark Soft</a></label>
								</div>
							</div>
						</div>
					</div>
				</footer>
			</div>

		{{HTML::script('js/validate.js')}}
		{{HTML::script('js/messages_es.js')}}
		<script>
			$(document).ready(function(){
				$( ".btn_nav" ).hover(
					function() {
						$( this ).addClass( "animated pulse" );
					}, function() {
						$( this ).removeClass( "animated pulse" );
					}
				);
				var sideslider = $('[data-toggle=collapse-side]');
				var sel = sideslider.attr('data-target');
				var sel2 = sideslider.attr('data-target-2');
				sideslider.click(function(event){
					$(sel).toggleClass('in');
					$(sel2).toggleClass('out');
				});

				$('.opciones_cliente').tooltip();
				
				$('.dropdown-toggle').dropdown();

				$('#carrito_compra').tooltip();

				$("body").on("contextmenu",function(){
			       	return false;
			    });
			});
		</script>
	</body>
</html>