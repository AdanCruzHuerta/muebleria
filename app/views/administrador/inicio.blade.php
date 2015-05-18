@extends('templates.layout_administrador')

@section('contenido')
	
	{{ HTML::script('js/Chart.js') }}

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
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
				<label>Visitas por semana</label>
				<div id="canvas-holder">
					<canvas id="chart-area" width="200" height="200"/>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
				<label>Producto mas vendido</label>
				<canvas id="chart-area-2" width="200" height="200"/>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
				<label>Visitas del Mes</label>
				<canvas id="chart-area-3" width="200" height="200"/>
			</div>
		</div>		
	</div>
	<script type="text/javascript">

		var pieData = [
				{
					value: 2,
					color:"#F7464A",
					highlight: "#FF5A5E",
					label: "Lunes"
				},
				{
					value: 3,
					color: "#46BFBD",
					highlight: "#5AD3D1",
					label: "Martes"
				},
				{
					value: 4,
					color: "#FDB45C",
					highlight: "#FFC870",
					label: "Miercoles"
				},
				{
					value: 1,
					color: "#949FB1",
					highlight: "#A8B3C5",
					label: "Jueves"
				},
				{
					value: 1,
					color: "orange",
					highlight: "#A8B3C5",
					label: "Viernes"	
				}
			];

		$(function(){
			var ctx  	= document.getElementById('chart-area').getContext("2d");
			var ctx_2 	= document.getElementById('chart-area-2').getContext("2d");
			var ctx_3 	= document.getElementById('chart-area-3').getContext("2d");

			window.myPie = new Chart(ctx).Pie(pieData);
			window.myPie = new Chart(ctx_2).Pie(pieData);
			window.myPie = new Chart(ctx_3).Pie(pieData);
		});

	</script>
@stop