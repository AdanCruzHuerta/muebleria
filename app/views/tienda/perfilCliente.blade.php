@extends('templates.layout_tienda')

@section('contenido')

<style>.item-perfil{color:#000000;}.item-perfil:hover{color: #4B4B4B;cursor: pointer;}.incompleto{background: #C43C35;padding: 3px; border-radius: 4px; color: #fff;}.completo{background: #46A546;padding: 3px;border-radius: 4px; color: #fff;}
</style>

	<div class="container">
		<div class="row">
			<div class="navbar navbar-default hidden-lg hidden-md hidden-sm">
				<div class="container-fluid">
					<center>
						<h4>Mi cuenta | Mueblería Ureña</h4>
					</center>
				</div>
			</div>

			<div class="hidden-xs col-sm-12 col-md-12 col-lg-12">
				<center>
					<h4>Mi cuenta | Mueblería Ureña</h4>
				</center>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-default">
  					<div class="panel-body">
    					<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    		<div class="breadcrumb">
                    			<br>
								<ul class="list-group">
									<li class="list-group-item @if(Request::path()=='cliente/perfil/editar-cuenta') {{ 'active' }} @endif">
										<i class="fa fa-user"></i>
										<a href="/cliente/perfil/editar-cuenta/">
											<label class="item-perfil">Editar cuenta</label>
										</a>
									</li>
									<li class="list-group-item @if(Request::path()=='cliente/perfil/editar-direccion') {{ 'active' }} @endif">
										<i class="fa fa-map-marker"></i>
										<a href="/cliente/perfil/editar-direccion/">
											<label class="item-perfil">Editar dirección</label>
										</a> 
									</li>
									<li class="list-group-item">
										@if($dataCliente->status == 0)
											<i class="fa fa-star-half-o"></i>
											<label>Perfil: <span class="incompleto">Sin completar</span></label>
										@else
											<i class="fa fa-star"></i>
											<label>Perfil: <span class="completo">Completo</span></label>
										@endif 
									</li>
								</ul>
                    		</div>
                    	</div>
                    	<!-- Yield contenido de perfil-->
                    	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    		@yield('contenido_perfil')	
                    	</div>
  					</div>
				</div>
			</div>
		</div>
	</div>

@stop