@extends('templates.layout_tienda')

@section('contenido')
	<section>
		{{HTML::style('css/thumbnail-gallery.css')}}
        <style>.article{width: 245px !important;height: 180px !important;}.contenido{color: #A24B2D !important; text-align: justify; font-size: 14px;}.atributos{color: #333333;}.paginacion{background-color: #fff;border: 1px solid #ddd;border-radius: 15px;display: inline-block;padding: 5px 14px;}</style>

		<div class="container">
			<br>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Buscar articulo">
                		<span class="input-group-btn">
                			<button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
              			</span>
					</div><br/>
                    <div class="breadcrumb">

                            <b>NUESTRAS CATEGORÍAS</b>
                            <hr style="border: 1px solid #777777;"/>

                        <ul class="nav" id="side-menu">
                            @foreach($categorias as $categoria)
                                <li>
                                    <a href="/productos/categoria/{{$categoria->slug}}">
                                        <i class="fa fa-angle-right"></i>&nbsp;&nbsp;&nbsp;{{ ucwords(strtolower($categoria->nombre)) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
				</div>
				
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

		            @foreach($articulos as $articulo)
		                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
								<div class="thumbnail">
									<img class="article" src="{{ $articulo->ruta_corta }}" alt="Muebles de Mueblería Ureña"><br>
									<div class="label label-info"><i class="fa fa-tag"></i> Nuevo!</div>
									<div class="caption">
										<h5><b>{{ $articulo->nombre }}</b></h5>
										<p><a href="/productos/{{$articulo->slug}}" class="btn btn-primary btn-block articulo" data-id="{{ $articulo->id }}">Ver detalles</a></p>
									</div><!-- end caption-->
								</div>
						</div><!-- end col-3-->
		            @endforeach

	                <div class="row">
	                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	                        <div class="pull-right">
	                            {{ $articulos->links() }}
	                        </div>
	                    </div>
	                </div>
        		</div>

			</div>
		</div>
	</section>
	<script>
	$(document).ready(function(){
		!function(a,b,c){function d(b,c){this.element=b,this.settings=a.extend({},f,c),this._defaults=f,this._name=e,this.init()}var e="metisMenu",f={toggle:!0};d.prototype={init:function(){var b=a(this.element),c=this.settings.toggle;this.isIE()<=9?(b.find("li.active").has("ul").children("ul").collapse("show"),b.find("li").not(".active").has("ul").children("ul").collapse("hide")):(b.find("li.active").has("ul").children("ul").addClass("collapse in"),b.find("li").not(".active").has("ul").children("ul").addClass("collapse")),b.find("li").has("ul").children("a").on("click",function(b){b.preventDefault(),a(this).parent("li").toggleClass("active").children("ul").collapse("toggle"),c&&a(this).parent("li").siblings().removeClass("active").children("ul.in").collapse("hide")})},isIE:function(){for(var a,b=3,d=c.createElement("div"),e=d.getElementsByTagName("i");d.innerHTML="<!--[if gt IE "+ ++b+"]><i></i><![endif]-->",e[0];)return b>4?b:a}},a.fn[e]=function(b){return this.each(function(){a.data(this,"plugin_"+e)||a.data(this,"plugin_"+e,new d(this,b))})}}(jQuery,window,document);
	});
</script>
@stop