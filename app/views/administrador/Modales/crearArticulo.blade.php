<style>.file-preview-frame{width: 90% !important;}.file-preview-image{width: 100% !important;height: 100% !important;}.file-caption-name{display: none !important;}</style>

{{ HTML::style('css/summernote.css') }} 
<!-- Crear un articulo -->

<div class="modal fade" id="modal-articulo">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Agregar nuevo articulo</h4>
            </div>
            {{ Form::open(['id'=>'form-articulo','url'=>'/administrador/productos/articulos/create', 'files'=> true]) }}
                
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-4">
                            <input type="file" id="imagen" name="imagen">
                        </div>

                        <div class="col-md-8">
                            <div class="form-horizontal">

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Nombre</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nombre" name="nombre">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="col-sm-2 control-label">Descripcion</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="descripcion" name="descripcion" rows="5"></textarea>
                                    </div>
                                    <input type="hidden" name="id_categoria" value="{{ $categoriaActual->id}}">
                                    <input type="hidden" name="nombre_categoria" value="{{ $categoriaActual->nombre}}">
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Proveedor</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="proveedor" name="proveedor">
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
                                            <input class="form-control" id="precio" name="precio" type="text" placeholder="Ej. 1000">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button id="guardar" type="submit" class="btn btn-primary">Guardar</button>
                </div>

            {{ Form::close() }}
        </div>
    </div>
</div>

{{ HTML::script('js/validate.js') }}
{{ HTML::script('js/messages_es.js') }}
{{ HTML::script('js/summernote.min.js') }}

<script type="text/javascript">
    
    $(function(){
        
        $('#descripcion').summernote({
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
        
        var validacion = $('#form-articulo').validate({
            errorElement: "span",
            errorClass: "help-block",
            rules: {
                nombre: {required: true},
                descripcion: {required: true},
                proveedor: {required: true}
            },
            highlight: function(element, error) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            submitHandler: function() {
               $('#guardar').text('Espera...');
               submit();
            }
        });

        $("#imagen").fileinput({
            allowedFileExtensions : ['jpg', 'png','gif'],
            overwriteInitial: false,
            maxFileSize: 2500,
            maxFilesNum: 1
        });
    });
</script>