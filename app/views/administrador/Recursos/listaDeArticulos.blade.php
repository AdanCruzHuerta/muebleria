<meta name="_token" content="{{ csrf_token() }}"/>

<style>.article{width: 245px !important;height: 180px !important;}.contenido{color: #A24B2D !important;text-align: justify;font-size: 14px;}.atributos{color: #333333;}.paginacion{background-color: #fff;border: 1px solid #ddd;border-radius: 15px;display: inline-block;padding: 5px 14px;}.thumbnail > .caption{padding: 3px !important;}.thumbnail > .caption > h4{margin: 0px;}</style>

@if($new)
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="alerta" class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <center><i class="fa fa-check-square"></i><b> El articulo fue creado correctamente</b></center>
            </div>
        </div>
    </div>
@endif

@if($errors->any())
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div id="alerta" class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <center><i class="fa fa-times"></i><b> La imagen supera el limite de 2.5 Mb, intenta con otra imagen</b></center>
            </div>
        </div>
    </div>
@endif

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        @foreach($articulos as $articulo)
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="thumbnail">
                    <img class="article" src="{{ $articulo->ruta_corta }}" alt="Muebles de Mueblería Ureña"/><br>
                    <div class="caption">
                        <h5><b>{{ $articulo->nombre." - $".$articulo->precio.".00"}}</b></h5>
                        <center>
                            <a class="btn btn-primary editArticle" data-article="{{ $articulo->id }}">
                                <i class="fa fa-book"></i> Ver detalles
                            </a>
                            <a class="btn btn-danger deleteArticle" data-article="{{ $articulo->id }}" data-nombre="{{ $articulo->nombre }}">
                                <i class="fa fa-trash-o"></i> Borrar
                            </a>
                        </center>
                    </div><!-- end caption-->
                </div>
            </div>
        @endforeach
    </div>   
</div>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="pull-right">
            {{ $articulos->links() }}
        </div>
    </div>
</div>

@include('administrador.Modales.editarArticulo')

@include('administrador.Modales.eliminarArticulo')

{{ HTML::script('js/validate.js') }}
{{ HTML::script('js/messages_es.js') }}
{{ HTML::script('js/summernote.min.js') }}

<script type="text/javascript">
    $(function(){

        $('#descripcion2').summernote({
            height: 200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
            ]
        });

        $("#imagen").fileinput({
            browseClass: 'btn btn-primary btn-block',
            browseLabel: ' Seleccionar Imagen',
            browseIcon: '<i class="fa fa-picture-o"></i>',
            initialPreview: '<img src="/img/producto.png" class="file-preview-image">',
            allowedFileExtensions: ["jpg", "png"],
            allowedFileTypes: ["image"],
            showCaption: false,
            showRemove: false,
            showUpload: false
        });

        $('#addArticulo').click(function(){
            $('#modal-articulo').modal('show');
        });

    });
</script>