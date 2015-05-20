<!-- Borrar video -->
<div class="modal fade" id="modal-borrar-video">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close remove" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Borrar Video</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group response-server">
                            <center>Realmente desea borrar el video: <b><span id="nombre_video"></span></center></b>
                            <input type="hidden" id="id_video" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger remove" data-dismiss="modal">Cancelar</button>
                <button id="borrar-video-confirm" type="button" class="btn btn-primary remove">Borrar</button>
                <a class="btn btn-primary aceptar" href="{{ Request::url() }}">
                    <i class="fa fa-check-square"></i> Aceptar
                </a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

$(function(){

    var responseTrue = '<div class="alert alert-success"><i class="fa fa-check-circle"></i> El video ha sido borrado </div>';
    var responseFalse = '<div class="alert alert-danger"><i class="fa fa-times-circle"></i> No se pudo borrar el video, intentalo nuevamente</div>'

    $('#borrar-video-confirm').click(function(){

        $.ajax({
            method: "post",
            url:    "/administrador/pagina/videos/delete",
            data:{ id: $('#id_video').val() },
            success: function(response){
                if(response)
                {
                    $('.remove').hide();
                    $('.response-server').html('');
                    $('.response-server').html(responseTrue);
                    $('.aceptar').show();
                }else{
                    $('.remove').hide();
                    $('.response-server').html('');
                    $('.response-server').html(responseFalse);
                    $('.aceptar').show();
                }
            }
        });
    });

});

</script>