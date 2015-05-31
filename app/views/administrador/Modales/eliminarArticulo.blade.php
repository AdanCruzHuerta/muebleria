<!-- Borrar categoria -->
<div class="modal fade" id="modal-borrar-articulo">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="mensaje"></div>
            <div id="contenido-modal">
                 <div class="modal-header">
                    <button type="button" class="close remove" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Borrar articulo</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group response-server">
                                <center>Realmente desea borrar el articulo: <b><span id="nombre_articulo_borrar"></span></center></b>
                                <input type="hidden" id="id_articulo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger remove" data-dismiss="modal">Cancelar</button>
                <button id="borrar-articulo-confirm" type="button" class="btn btn-primary remove">Borrar</button>
                <a class="btn btn-primary aceptar" href="{{ Request::url() }}">
                    <i class="fa fa-check-square"></i> Aceptar
                </a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(function(){

var mensajeTrue = '<div class="alert alert-success"><b>Exito !!</b> El articulo ha sido dado de baja del sistema</div>';

var mensajeFalse = '<div class="alert alert-danger"><b>Error !!</b> No se ha podido eliminar el articulo, contacte al administrador del sistema.</div>';

         $('.deleteArticle').click(function(){
             var id = $(this).attr('data-article');
             var nombre = $(this).attr('data-nombre');
             $('#nombre_articulo_borrar').html(nombre);
             $('#id_articulo').val(id);

             $('#modal-borrar-articulo').modal('show');
        });


        $('#borrar-articulo-confirm').click(function(){
            var id = $('#id_articulo').val();

            $.ajax({
                method: 'post',
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                url: '/administrador/productos/delete',
                data: { id:id },
                success: function(response) {

                    if(response) {
                        $('#contenido-modal').hide();
                        $('.remove').hide();
                        $('.mensaje').html(mensajeTrue);
                        $('.aceptar').show();
                    }else {
                        $('#contenido-modal').hide();
                        $('.remove').hide();
                        $('.mensaje').html(mensajeFalse);
                        $('.aceptar').show();
                    }

                }
            });
        });
    }); 
</script>