<!-- Borrar categoria -->
<div class="modal fade" id="modal-borrar-categoria">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close remove" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Borrar categoría</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group response-server">
                            <center>Realmente desea borrar la categoría: <b><span id="nombre_categoria_borrar"></span></center></b>
                            <input type="hidden" id="categoria_id_padre" value="{{ $categoriaActual->id }}"/>
                            <input type="hidden" id="id_categoria_borrar"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger remove" data-dismiss="modal">Cancelar</button>
                <button id="borrar-categoria-confirm" type="button" class="btn btn-primary remove">Borrar</button>
                <a class="btn btn-primary aceptar" href="{{ Request::url() }}">
                    <i class="fa fa-check-square"></i> Aceptar
                </a>
            </div>
        </div>
    </div>
</div>