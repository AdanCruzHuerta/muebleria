    <style></style>
    <!-- Crear Categoria -->
    <div class="modal fade" id="modal-password">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Recuperar contraseña</h4>
                </div>

                <div id="" class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <center><i class="fa fa-exclamation-circle"></i> El Email ingresado no existe.</center>
                </div> 
                
                <form id="form-password">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div id="container-categoria" class="form-group">
                                    <label for="email" class="control-label">Email</label>
                                    <input type="text" id="email-user" name="email" class="form-control" placeholder="Ingresa tu email"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="calncelar-categoria" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button id="click-categoria" type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{ HTML::script('js/validate.js') }}
{{ HTML::script('js/messages_es.js') }}
<script type="text/javascript">

$(function(){

    var mensajeTrue = '<div class="alert alert-success"><center>Hemos mandado una clave a su email, favor de revisar</center></div>';

    var validacion = $('#form-password').validate({
            errorElement: "span",
            errorClass: "help-block",
            rules: {
                email:{required:true, email:true}
            },
            highlight: function(element, error) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            submitHandler: function() {
                $.ajax({
                    method: "post",
                    url: '/cuenta/changePassword',
                    data: {
                        email: $('#email-user').val()
                    },
                    success: function(response){
                        if(response)
                        {
                            $('#alerta-password').html(mensajeTrue);
                            $('#email-user').val('');
                        }
                        else
                        {
                            $('#alerta-password').html(mensajeFalse);
                            $('#email-user').val('');
                        }
                    }
                }); 
            }
        });
});    
    
</script>
