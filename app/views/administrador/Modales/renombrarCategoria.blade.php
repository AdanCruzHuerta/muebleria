<!-- Renombrar categoria -->
<div class="modal fade" id="modal-editar-categoria"> 
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close remove" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Renombrar categoría</h4>
            </div>
            <form id="form-categoria_renombrar">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group response-server">
                                <label for="categoria" class="control-label">Nombre de categoría</label>
                                <input type="text" id="nombre_categoria" class="form-control"/>
                                <input type="hidden" id="id_categoria" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger remove" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary remove">Renombrar</button>
                    <a class="btn btn-primary aceptar" href="{{ Request::url() }}">
                        <i class="fa fa-check-square"></i> Aceptar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>