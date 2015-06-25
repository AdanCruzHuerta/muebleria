@extends('templates.layout_administrador')

@section('contenido')

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h2><i class="fa fa-bar-chart-o"></i> Estadisticas</h2>
			<ol class="breadcrumb breadcrumb-arrow">
				<li><a href="/administrador">Home</a></li>
				<li class="active"><span>Estadisticas</span></li>
			</ol>
		</div>
	</div>
	
	<div class="row">	

			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="panel panel-default opc-estadisticas">
				 	<div class="panel-body">
				    	<center>
				    		<i class="fa fa-bar-chart estadisticas"></i>
				    		<h4>Estadisticas de Página</h4>
				    	</center>
				  	</div>
				</div>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<div class="panel panel-default opc-estadisticas">
				 	<div class="panel-body">
						<center>
							<i class="fa fa-line-chart estadisticas"></i>
				    		<h4>Estadisticas de Ventas</h4>
						</center>
				  	</div>
				</div>
			</div>

	</div>
	
@stop