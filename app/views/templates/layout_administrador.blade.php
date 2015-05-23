<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Mueblería Ureña</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="Pagina de administrador de Mueblería Ureña">
    <meta name="author" content="SharkSoft - Mueblería Ureña">
	<link rel="icon" href="/img/favicon/favicon.ico">
	{{ HTML::style('css/bootstrap.min.css') }}
	{{ HTML::style('css/font-awesome.min.css') }}
	{{ HTML::style('css/normalize.css') }}
	{{ HTML::style('css/animate.min.css') }}
	{{ HTML::style('css/urena-admin.css') }}
	{{ HTML::style('css/fileinput.css') }}
</head>
<body>
	<div id="wrapper">
		<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/administrador">Mueblería Ureña</a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
	                <li class="dropdown">
	                    <a class="dropdown-toggle ver-messages" data-toggle="dropdown" href="#">
	                        @if(count($mensajes) > 0 )
	                        	<span id="notificacion-messages" class="notificacion-message">{{ count($mensajes) }}</span>
	                        @endif
	                        <i class="fa fa-envelope fa-fw"></i><i class="fa fa-caret-down"></i>
	                    </a>
	                    <ul class="dropdown-menu dropdown-messages">
	                    	@foreach($mensajes as $mensaje)
								<li>
		                            <a href="/administrador/panel/mensaje/{{ $mensaje->id }}">
		                                <div>
		                                    <strong>{{ $mensaje->nombre }}</strong>
		                                    <span class="pull-right text-muted">
		                                        <em></em>
		                                    </span>
		                                </div>
		                                <div class="message">{{ substr($mensaje->mensaje, 0, 100)."..." }}</div>
		                            </a>
		                        </li>
	                    	@endforeach
	                        <li class="divider"></li>
	                        <li>
	                            <a class="text-center" href="/administrador/panel/mensajes">
	                                <strong>Ver todos los mensajes</strong>
	                                <i class="fa fa-angle-right"></i>
	                            </a>
	                        </li>
	                    </ul>
	                </li>
	                <li class="dropdown">
	                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	                        <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
	                    </a>
	                    <ul class="dropdown-menu dropdown-alerts">
	                        <li class="divider"></li>
	                        <li>
	                            <a href="#">
	                                <div>
	                                    <i class="fa fa-tasks fa-fw"></i> New Task
	                                    <span class="pull-right text-muted small">4 minutes ago</span>
	                                </div>
	                            </a>
	                        </li>
	                        <li class="divider"></li>
	                        <li>
	                            <a href="#">
	                                <div>
	                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
	                                    <span class="pull-right text-muted small">4 minutes ago</span>
	                                </div>
	                            </a>
	                        </li>
	                        <li class="divider"></li>
	                        <li>
	                            <a class="text-center" href="#">
	                                <strong>See All Alerts</strong>
	                                <i class="fa fa-angle-right"></i>
	                            </a>
	                        </li>
	                    </ul>
	                </li>
	                <li class="dropdown">
	                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
	                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
	                    </a>
	                    <ul class="dropdown-menu dropdown-user">
	                        <li>
	                        	<a href="/administrador/perfil"><i class="fa fa-user fa-fw"></i> Perfil de Usuario</a>
	                        </li>
	                        <li>
	                        	<a href="/administrador/logout"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
	                        </li>
	                    </ul>
	                </li>
	            </ul>
	            <?php
	            	$path  = Request::path();
	            	$route = Route::getCurrentRoute()->getPath();
	            ?>
	            <div class="navbar-default sidebar" role="navigation">
	            	<div class="sidebar-nav navbar-collapse">
	            		<ul class="nav" id="side-menu">
	            			<li class="nav-perfil @if($path == 'administrador/perfil') {{ 'selected-perfil' }} @endif ">
	                            <div class="img-perfil">
	                                <a href="/administrador/perfil">
	                                    <img src="{{ $administrador->photo_user }}" class="img-responsive">
	                                </a>
	                            </div>
	                            <div class="info-perfil">
	                                <h4>{{ $administrador->nombre." ".$administrador->apellido_p }}</h4>
	                                <small>{{ $administrador->tipo }}</small>
	                            </div>
	                        </li>
	                        <li>
	                            <a href="/administrador/panel" class="@if($path =='administrador/panel') {{ 'active' }} @endif" ><i class="fa fa-bar-chart-o fa-fw"></i> Estadisticas</a>
	                        </li>
                            <li>
                                <a href="/administrador/empleados" class="@if($path =='administrador/empleados') {{'active'}} @endif"><i class="fa fa-user"></i> Empleados</a>
                            </li>
	                        <li>
	                            <a href="#" class="@if($path == 'administrador/pagina' || $path == 'administrador/pagina/slider' ) {{ 'active' }} @endif" ><i class="fa fa-desktop fa-fw"></i> Pagina<span class="fa arrow"></span></a>
	                            <ul class="nav nav-second-level">
	                            	<li href="#">
	                            		<a href="/administrador/pagina/slider" class="@if($path =='administrador/pagina/slider') {{'active'}} @endif">Slider</a>
	                            	</li>
	                            	<li>
		                                <a href="/" target="_blank">Ver tienda</a>
		                            </li>
		                            <li>
		                                <a href="/administrador/pagina/videos">Video</a> 
		                            </li>
	                            </ul>
	                        </li>
	                        <li>
	                            <a href="/administrador/clientes" class="@if($route == 'administrador/clientes' || $route == 'administrador/clientes/show/{id}') {{ 'active' }} @endif" ><i class="fa fa-users fa-fw"></i> Clientes</a>
	                        </li> 
	                        <li>
	                            <a href="/administrador/fleteras" class="@if($route == 'administrador/fleteras' || $route == 'administrador/fleteras/add-fletera' || $route == 'administrador/fleteras/editar/{id}') {{ 'active'}} @endif"><i class="fa fa-truck fa-fw"></i> Fleteras</a>
	                        </li>
	                        <li>
	                            <a href="#"><i class="fa fa-edit fa-fw"></i> Pedidos</a>
	                        </li>
	                        <li>
	                            <a href="#" class="@if($path == 'administrador/productos/categorias' || $path == 'administrador/productos/articulos' || $route == 'administrador/productos/categorias/{name}' ) {{ 'active'}} @endif" ><i class="fa fa-book fa-fw"></i> Productos<span class="fa arrow"></span></a>
	                            <ul class="nav nav-second-level">
		                            <li>
		                                <a href="/administrador/productos/categorias">Categorias</a>
		                            </li>
		                            <li>
		                                <a href="/administrador/productos/articulos">Artículos</a>
		                            </li>
	                            </ul>
	                        </li>
	                        <li>
	                            <a href="/administrador/proveedores" class="@if($route == 'administrador/proveedores' || $route == 'administrador/proveedores/add-proveedor' || $route == 'administrador/proveedores/editar/{id}' ) {{ 'active'}} @endif"><i class="fa fa-shopping-cart fa-fw"></i> Proveedores</a>
	                        </li>
	                        <li>
	                            <a href="/administrador/ventas" class="@if($route == 'administrador/ventas') {{ 'active'}} @endif"><i class="fa fa-line-chart fa-fw"></i> Ventas</a>
	                        </li>
	            		</ul>
	            	</div>
	            </div>
		</nav>

		{{ HTML::script('js/jquery.min.js') }}
		{{ HTML::script('js/bootstrap.min.js') }}
		{{ HTML::script('js/fileinput.js') }}
		{{ HTML::script('js/admin.js') }}
		<div id="page-wrapper">
			@yield('contenido')
		</div>
	</div>
	<script type="text/javascript">

	$('.ver-messages').click(function(){

		$.ajax({
			type: "post",
			url : "/administrador/panel/change-messages",
			success: function(response){
				$('.notificacion-message').html('');
				$('#notificacion-messages').removeClass('notificacion-message');
			}
		});
	});	

	</script>
</body>
</html>