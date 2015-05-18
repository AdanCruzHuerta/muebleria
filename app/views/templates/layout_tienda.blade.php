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
		{{HTML::style('css/normalize.css')}}
		{{HTML::style('css/urena-tienda.css')}}
		{{HTML::script('js/jquery.min.js')}}
		{{HTML::script('js/bootstrap.min.js')}}
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
								<li><a href="/tienda">Tienda en Linea</a></li>
								<li><a href="/cuenta">Iniciar Sesion / Registrate</a></li>
								<li><a href="/carrito">Ver carrito</a></li>
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

									<a href="/cuenta" id="opciones_tienda_2" type="button" class="btn btn-default btn-lg pull-right" title="Iniciar Sesión / Registrarse"><i class="fa fa-user"></i></a>
								
									<a href="/carrito" id="carrito_compra" type="button" class="btn btn-default btn-lg pull-right opciones_cliente" title="Ver carrito"><i class="fa fa-shopping-cart"></i></a>

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
									<li class="@if($path =='productos' || $route == 'productos/categoria/{name}' || $route == 'producto/nuevo/{name}' || $route == 'productos/{name}'){{'activo'}} @endif">
										<a href="/productos" class="btn_nav">Productos</a>
									</li>
									<li class="@if($path =='contacto'){{'activo'}} @endif">
										<a href="/contacto" class="btn_nav">Contacto</a>
									</li>
									<li class="@if($path =='tienda'){{'activo'}} @endif">
										<a href="/tienda" class="btn_nav">Tienda en Linea</a>
									</li>
								</ul>
				          	</div>
						</div> 
					</div>
				</nav>

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
									<label>Derechos reservados ©2015 Muebleria Ureña</label>
									<br>
									<label>Desarrollado por: <a href="http://sharksoft.com.mx" target="_blank">Shark Soft</a></label>
								</div>
							</div>
						</div>
					</div>
				</footer>
			</div>
		
		
		{{-- <div class="modal fade" id="modal-carrito" tabindex="-1" role="dialog" aria-labelleby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title"><i class="fa fa-shopping-cart"></i>&nbsp;Carrito de compras</h4>
					</div>
					<form action="#" method="post">
					<div class="modal-body">
						<table class="table table-hover">
							<thead>
								<tr>
									<th width="120px">Imagen</th>
									<th>Producto</th>
									<th>Cantidad</th>
									<th>Precio</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								<tr >
									<td >
										<img class="img-responsive" src="http://placehold.it/620x296/cccccc/ffffff">
									</td>
									<td>Nombre</td>
									<td><input type="number" class="form-control cantidad" value="1" min="1" max="5"></td>
									<td>$500.00</td>
									<td>
										<button type="button" class="btn btn-link">
											<i class="fa fa-trash fa-lg"></i>
										</button>
									</td>
								</tr>
								<tr>
									<td>
										<img class="img-responsive" src="http://placehold.it/620x296/cccccc/ffffff">
									</td>
									<td>Nombre</td>
									<td><input type="number" class="form-control cantidad" value="1" min="1" max="5"></td>
									<td>$500.00</td>
									<td>
										<button type="button" class="btn btn-link">
											<i class="fa fa-trash fa-lg"></i>
										</button>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Iniciar">
					</div>
					</form>
				</div>
			</div>

		</div> --}}

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
				
			});
		</script>
	</body>
</html>