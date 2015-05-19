<style>.botones-after{display: none;}</style>

<div class="modal fade" id="modal-video" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog">
    	<div class="modal-content">
      		<div class="modal-header">
        		<button id="close-add" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        		<h4 class="modal-title" id="myModalLabel">Nuevo Video</h4>
      		</div>
      		
          <form id="form-video">
	      		<div class="modal-body">
	      			<div id="alerta-video"></div>

              <div class="campos">
                  <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" id="nombre" name="nombre">
                  </div>  

                  <div class="form-group">
                      <label>Iframe</label>
                      <textarea id="frame" cols="30" rows="3" class="form-control" name="frame"></textarea>
                  </div>  
              </div>  		
            </div>
	      		
            <div id="add-buttons" class="modal-footer">
                <div class="botones-before">
                    <button id="btn-cancel-video" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Aceptar</button>  
                </div>
                <a href="/administrador/pagina/videos" class="btn btn-primary botones-after">Aceptar</a>
	      		</div>
      		</form>
    	</div>
  	</div>
</div>

{{ HTML::script('js/validate.js') }}

{{ HTML::script('js/messages_es.js') }}

<script type="text/javascript">

  $(function(){

    var mensajeTrue = '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><i class="fa fa-check-circle"></i></strong> El video ha sido agregado</div>';

    var mensajeFalse = '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><i class="fa fa-times-circle"></i></strong> Algo ha salido mal, intenta nuevamente </div>';
    
    $('#modal-video').modal({
        backdrop: 'static',
        keyboard:false,
        show:false
    });

    var validacion = $('#form-video').validate({
        errorElement: "span",
        errorClass: "help-block",
        rules: {
            nombre : { required:true, minlength: 3 },
            frame  : { required:true, minlength: 3}
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
                url: "/administrador/pagina/videos/add",
                data:{
                   nombre: $('#nombre').val(),
                   frame: $('#frame').val()
                },
                success: function(request){
                    if(request)
                    {
                        $('#close-add').hide();
                        $('.campos').hide();
                        $('.botones-before').hide();
                        $('.botones-after').show();

                        $('#alerta-video').html(mensajeTrue);


                    }else{
                        $('#close-add').hide();
                        $('.campos').hide();
                        $('.botones-before').hide();
                        $('.botones-after').show();

                        $('#alerta-video').html(mensajeFalse);
                    }
                }
            });
        }
    });

  });

</script>