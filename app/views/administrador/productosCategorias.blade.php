@extends('templates.layout_administrador')

@section('contenido')

	{{ HTML::style('css/dataTables.bootstrap.css') }}

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h2><i class="fa fa-book"></i> Productos</h2>
            <ol class="breadcrumb breadcrumb-arrow">
                @if($categoriaActual->id == 1)
    			
                	<li><a href="/admininistrador">Home</a></li>
    				<li class="active"><span>Productos</span></li>
                    <li class="active"><span>Categorías</span></li>
                
                @else
                
                    <li><a href="/administrador">Home</a></li>
                    <li class="active"><span>Productos</span></li>
                    <li><a href="/administrador/productos/categorias">Categorías</a></li>
                    <li class="active"><span>{{ ucwords(strtolower($categoriaActual->nombre)) }}</span></li>
                
                @endif
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                @if( $categoriaActual->id == 1 )

                    @include('administrador.Recursos.tablaCategorias')

                @else

                    @include('administrador.Recursos.listaDeArticulos')

                 @endif
		</div>

		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
            
            @if( $categoriaActual->id == 1 )
                
                <a id="addCategoria" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-primary">
                    <i class="fa fa-tag"></i> Crear categoría
                </a>
                <br/>

            @else
                
                <a id="addArticulo" class="col-xs-12 col-sm-12 col-md-12 col-lg-12 btn btn-primary">
                    <i class="fa fa-tag"></i> Crear artículo
                </a>
                <br/>

            @endif
			<p class="info_seccion">En esta seccion puede consultar las diferentes categorías de productos.</p>
		</div>
        	
	</div>

    <!-- Cargamos modales  -->
    @if( $categoriaActual->nivel_actual < 1 )

        @include('administrador.Modales.crearCategoria')

        @include('administrador.Modales.renombrarCategoria')

        @include('administrador.Modales.borrarCategoria')

    @else

        @include('administrador.Modales.crearArticulo')

    @endif

@stop