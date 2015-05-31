<style>.file-preview-frame{width: 90% !important;}.file-preview-image{width: 100% !important;height: 100% !important;}.file-caption-name{display: none !important;}</style>

{{ HTML::style('css/summernote.css') }}
<!-- Crear un articulo -->

<div class="modal fade" id="modal-editarArticulo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Editar articulo</h4>
            </div>
            <form id="form-edita-articulo" method="post" action="/administrador/productos/articulos/update" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-4">
                            <input type="file" id="imagen2" name="imagen">
                        </div>

                        <div class="col-md-8">

                            <div class="alert alert-info"><center><i class="fa fa-exclamation-circle"></i> Por el momento solo puede consultar la información del articulo, en caso de requerir cambio contacte al administrador del sistema.</center></div>
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Nombre</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nombre2" name="nombre">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Descripcion</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="descripcion2" name="descripcion" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Proveedor</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="proveedor2" name="proveedor">
                                                    <option value="">Selecciona un proveedor</option>
                                                    @foreach($proveedores as $proveedor)
                                                    <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group margin-bottom-sm">
                                            <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                                            <input class="form-control" id="precio2" name="precio" type="text" placeholder="Ej. 1000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button> --}}
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(function(){

    $("#imagen2").fileinput({
        browseClass: 'btn btn-primary btn-block',
        browseLabel: ' Cambiar Imagen',
        browseIcon: '<i class="fa fa-picture-o"></i>',
        initialPreview: '<img src="" class="file-preview-image">',
        allowedFileExtensions: ["jpg", "png"],
        allowedFileTypes: ["image"],
        showCaption: false,
        showRemove: false,
        showUpload: false
    });

    $('.editArticle').click(function(){

            var id = $(this).attr('data-article');
            var token = $(this).attr('data-token');
            $.ajax({
                    type: "POST",
                    url: "/administrador/productos/getDataArticle",
                    data:{id:id},
                    success: function(response){
                        $(".file-preview-image").attr('src',response.ruta_corta);
                        $('#nombre2').val(response.nombre);
                        $('#descripcion2').code(response.descripcion);
                        $('#precio2').val(response.precio);
                        $('#proveedor2').val(response.proveedor);                      

                        $('#modal-editarArticulo').modal('show');
                    }
                });
        });
});
</script>