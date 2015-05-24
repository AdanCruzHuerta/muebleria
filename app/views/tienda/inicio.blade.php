@extends('templates.layout_tienda')

@section('contenido')
<style>.article{width: 245px !important;height: 178px !important;}</style>
	<section>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<div id="myCarousel" class="carousel slide">
								<div class="carousel-inner">
									<?php $activo = 0; ?>
									@foreach($sliders as $row)
										<div class="item @if($activo == 0) {{ 'active' }} @endif">
											<img src="{{ $row->ruta_corta }}" class="img-responsive">
										</div>
									<?php $activo = 1; ?> 
									@endforeach
								</div>
								<a class="left carousel-control" href="#myCarousel" data-slide="prev">
									<span class="fa fa-chevron-left"></span>
								</a>
								<a class="right carousel-control" href="#myCarousel" data-slide="next">
									<span class="fa fa-chevron-right"></span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section>
			<div class="container">
				<br>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="cabecera"><div class="text-cabecera">Mueblería Ureña</div></div>
						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mitad">
									<div class="hidden-xs col-sm-1 col-md-2 col-lg-2">
										<center>
											<i class="fa fa-check check"></i>
										</center>
									</div>
									<div class="col-xs-12 col-sm-11 col-md-10 col-lg-10 datos">
										<h4>Misión</h4>
										<p>Nuestra misión es brindar a los clientes, un servicio de calidad, con productos de vanguardia,clase y estilo.</p>
									</div>
									<div class="hidden-xs col-sm-1 col-md-2 col-lg-2">
										<center>
											<i class="fa fa-check check"></i>
										</center>
									</div>
									<div class="col-xs-12 col-sm-11 col-md-10 col-lg-10 datos">
										<h4>Visión</h4>
										<p>Nuestra visión es ser una empresa líder en el sector mueblero con una amplia gama de productos.</p>
									</div>
									<div class="hidden-xs col-sm-1 col-md-2 col-lg-2">
										<center>
											<i class="fa fa-check check"></i>
										</center>
									</div>
									<div class="col-xs-12 col-sm-11 col-md-10 col-lg-10 datos">
										<h4>Objetivo</h4>
										<p>La satisfacción de nuestros clientes, desde la primera compra.</p>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<div align="center" class="embed-responsive embed-responsive-16by9">
									{{ $video->frame }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
	
	<section>
			<div class="container">
				<br>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<div class="cabecera">
							<div class="text-cabecera">Nuevos productos</div>
						</div>
					</div>
				</div><br>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="row">
							@foreach($articulos as $articulo)
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
									<div class="thumbnail">
										<img class="article" src="{{ $articulo->ruta_corta }}" alt="Muebles de Mueblería Ureña"><br>
										<div class="label label-info"><i class="fa fa-tag"></i> Nuevo!</div>

										<div class="caption">
											<h5><b>{{ $articulo->nombre.' - $'.$articulo->precio.'.00' }}</b></h5>
											<p><a href="/producto/nuevo/{{$articulo->slug}}" class="btn btn-primary btn-block articulo"><i class="fa fa-book"></i> Ver detalles</a></p>
										</div><!-- end caption-->
									</div>
								</div><!-- end col-3-->
							@endforeach
							</div><!-- end row-->
					</div><!--end col-12-->
				</div>
			</div>
	</section>
@stop