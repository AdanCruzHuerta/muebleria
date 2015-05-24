<style>.article{width: 245px !important;height: 180px !important;}.contenido{color: #A24B2D !important;text-align: justify;font-size: 14px;}
.atributos{color: #333333;}.paginacion{background-color: #fff;border: 1px solid #ddd;border-radius: 15px;display: inline-block;padding: 5px 14px;}
.thumbnail > .caption{padding: 3px !important;}
.thumbnail > .caption > h4{margin: 0px;}</style>

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
                    <div class="label label-info"><i class="fa fa-tag"></i> Nuevo!</div>
                    <div class="caption">
                        <h5><b>{{ $articulo->nombre }}</b></h5>
                        <a href="" class="btn btn-primary btn-block">Ver detalles</a>
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

        {{-- <div class="modal fade" id="modal-producto">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="verNombre"></h4>
                            </div>
                            <form id="form-verArticulo" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <img src="" class="img-responsive img-thumbnail" id="imagen">
                                        </div>
                                        <div class="col-md-6">
                                            <table class="table table-user-information">
                                                <tbody>
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                                            <div class="alert alert-warning">
                                                                <center><b><i class="fa fa-file-text-o"></i> Información del Artículo</b></center>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <tr>
                                                        <td><b>Descripcion:</b></td>
                                                        <td id="verDescripcion" class="contenido"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Alto:</b></td>
                                                        <td id="verAlto" class="contenido"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Largo:</b></td>
                                                        <td id="verLargo" class="contenido"></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Ancho:</b></td>
                                                        <td id="verAncho" class="contenido"></td>
                                                    </tr>
                                                    <!--<tr>
                                                        <td>Precio:</td>
                                                        <td id="verPrecio"></td>
                                                    </tr>-->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger btn-remove" data-dismiss="modal">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
        </div> --}}
    



<script type="text/javascript">
    $(function(){
        $("input[type=file]").fileinput({
            browseClass: 'btn btn-primary btn-block',
            browseLabel: ' Seleccionar Imagen',
            browseIcon: '<i class="fa fa-picture-o"></i>',
            initialPreview: '<img src="/img/articulos/producto1.jpg" class="file-preview-image">',
            allowedFileExtensions: ["jpg", "png"],
            allowedFileTypes: ["image"],
            showCaption: false,
            showRemove: false,
            showUpload: false
        });

        $('#addArticulo').click(function(){
            $('#modal-articulo').modal('show');
        });

        $(".articulo").click(function(){
            var id = $(this).attr('data-id');

                $.ajax({
                    type: "POST",
                    url: "/productos/getDataArticle",
                    data:{id:id},
                    success: function(result){

                        $('#imagen').attr('src',''+result.ruta_corta);
                        $('#verNombre').html(result.nombre);
                        $('#verDescripcion').html(result.descripcion);
                        $('#verAlto').html(result.alto);
                        $('#verLargo').html(result.largo);
                        $('#verAncho').html(result.ancho);
                        $('#verPrecio').html(result.precio);
                        $('#modal-producto').modal('show');

                    }
                });

            });
    });
</script>