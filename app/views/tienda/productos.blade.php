@extends('templates.layout_tienda')

@section('contenido')
	<?php
		if($slug)
		{
			$categoriaActual = $slug;	
		}else {
			$categoriaActual = explode('/', Request::path());
			$categoriaActual = end($categoriaActual);
		}

		$precios = explode(',', $rango);
	?>
	<section>
        <style>.show-article:hover{box-shadow: 0px 0px 20px #666666;}.article{width: 245px !important;height: 180px !important;}.contenido{color: #A24B2D !important; text-align: justify; font-size: 14px;}.atributos{color: #333333;}.paginacion{background-color: #fff;border: 1px solid #ddd;border-radius: 15px;display: inline-block;padding: 5px 14px;}</style>

		<div class="container">
			<br>
			<div class="row">
				
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="breadcrumb">
						<center>
                        	<b>NUESTRAS CATEGORÍAS</b>
                        </center>
                        <hr style="border: 1px solid #777777;"/>

                        <ul class="nav" id="side-menu">
                        		<li>
									<a>
										<i class="fa fa-angle-right"></i>&nbsp;&nbsp;&nbsp;Comedores
									</a>
								</li>
								<li>
									<a>
										<i class="fa fa-angle-right"></i>&nbsp;&nbsp;&nbsp;Mesas de centro
									</a>
								</li>
								<li>
									<a>
										<i class="fa fa-angle-right"></i>&nbsp;&nbsp;&nbsp;Salas 3-2-1
									</a>
								</li>
								<li>
									<a>
										<i class="fa fa-angle-right"></i>&nbsp;&nbsp;&nbsp;Salas esquineras
									</a>
								</li>
                            @foreach($categorias as $categoria)
                                <li>
                                    <a href="/productos/categoria/{{$categoria->slug}}" class="@if( ucwords($categoriaActual) == ucwords(strtolower($categoria->nombre))) {{'menu-active'}} @endif)">
                                        <i class="fa fa-angle-right"></i>&nbsp;&nbsp;&nbsp;{{ ucwords(strtolower($categoria->nombre)) }}
                                    </a>
                                </li>
                            @endforeach
								<li>
									<a>
										<i class="fa fa-angle-right"></i>&nbsp;&nbsp;&nbsp;Sillones
									</a>
								</li>
								<li>
									<a>
										<i class="fa fa-angle-right"></i>&nbsp;&nbsp;&nbsp;Sofás
									</a>
								</li>
								<li>
									<a>
										<i class="fa fa-angle-right"></i>&nbsp;&nbsp;&nbsp;Sofás
									</a>
								</li>
                        </ul>
                    </div>

                    <div class="breadcrumb">
                    	<center>
                    		<b>FILTRAR ARTÍCULOS POR PRECIO</b>
                    	</center>
                    	<hr style="border: 1px solid #777777;" />
						
						@if($categoriaActual == 'productos' || $categoriaActual == 'filter')
						{{ Form::open(['url' => '/productos/filter','method'=>'get']) }}
						@else
							<?php $name = $categoriaActual.'/'; ?>
						{{ Form::open(['url' => '/productos/categoria/'.$name.'filter','method'=>'get']) }}
						@endif				
							<div>
								<b class="pull-left">$ 0</b>
	                    		<b class="pull-right">$ 10000</b> 
	                    		<input id="ex2" type="text" class="span2" value="" name="rango-precios" data-slider-min="0" data-slider-max="10000" data-slider-step="100" data-slider-value='@if(!$rango) {{ "[1000,9000]" }} @else {{ "[$precios[0],$precios[1]]" }} @endif'/>	                    		
							</div><br>
                    		<button class="btn btn-default btn-block" type="submit" id="find-article"><i class="fa fa-search"></i> Buscar</button>
                    	{{ Form::close() }}
                    </div>
				</div>
				
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

		            @foreach($articulos as $articulo)
		                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
								<div class="thumbnail show-article">
									<a href="/productos/{{$articulo->slug}}"><img class="article" src="{{ $articulo->ruta_corta }}" alt="Muebles de Mueblería Ureña"/></a><br>
									<div class="label label-info"><i class="fa fa-tag"></i> {{{ isset($articulo->nombre_categoria) ? $articulo->nombre_categoria : 'Nuevo' }}} </div>
									<div class="caption">
										<h5>{{ $articulo->nombre." - $ ".number_format($articulo->precio).".00" }}</h5>
										<p><a href="/productos/{{$articulo->slug}}" class="btn btn-primary btn-block articulo" data-id="{{ $articulo->id }}"><i class="fa fa-book"></i> Ver detalles</a></p>
									</div><!-- end caption-->
								</div>
						</div><!-- end col-3-->
		            @endforeach

	                <div class="row">
	                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	                        <div class="pull-right">
	                            {{ $articulos->appends(['rango-precios' => $rango])->links() }}
	                        </div>
	                    </div>
	                </div>
        		</div>

			</div>
		</div>
	</section>
	<script>
	$(document).ready(function(){
		
		$("#ex2").slider({}); 
	});
</script>
@stop