    <!-- Crear Categoria -->
    <div class="modal fade" id="modal-categoria">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Agregar nueva categoría</h4>
                </div>
                <form id="form-categoria">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div id="container-categoria" class="form-group">
                                    <label for="categoria" class="control-label">Nombre de categoría</label>
                                    <input type="text" id="categoria" name="nombre" class="form-control"/>
                                    <input type="hidden" id="categoria_id_padre" value="{{ $categoriaActual->id }}"/>
                                    <input type="hidden" id="nivel_actual" value="{{ $categoriaActual->nivel_actual }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="calncelar-categoria" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button id="click-categoria" type="submit" class="btn btn-primary">Guardar</button>
                        <a href="{{ Request::url() }}" id="response-categoria" type="button" class="btn btn-primary"><i class="fa fa-check-circle"></i> Aceptar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
