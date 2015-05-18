<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-striped table-condensed">
                <thead>
                <th> # </th>
                <th>Nombre</th>
                <th>Fecha de creación</th>
                <th>Opciones</th>
                </thead>
                <tbody>
                @foreach($categorias as $categoria)
                    <tr>
                        <td><a href="/administrador/productos/categorias/{{ $categoria->slug }}"><img src="/img/folder.png" /></a></td>
                        <td><a href="/administrador/productos/categorias/{{$categoria->slug}}">{{ $categoria->nombre }}</a></td>

                        <td>{{ $categoria->created_at }}</td>
                        <td>
                            <a data-nombre="{{ $categoria->nombre }}" data-id="{{$categoria->id}}" title="Cambiar nombre" class="opciones-table editar_categoria"><i class="fa fa-pencil-square-o"></i></a>

                            <a data-nombre="{{ $categoria->nombre }}" data-id="{{ $categoria->id }}" title="borrar" class="opciones-table borrar_categoria"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{ HTML::script('js/dataTables.min.js') }}
{{ HTML::script('js/dataTables.bootstrap.js') }}
{{ HTML::script('js/validate.js')}}
{{ HTML::script('js/messages_es.js')}}

<script type="text/javascript">

    $(function(){

        $('.table').dataTable();

        $("#addCategoria").click(function(){
            $("#modal-categoria").modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        var nuevaCategoria = $('#form-categoria').validate({
            errorElement: "span",
            errorClass: "help-block",
            rules: {
                nombre: {required: true, minlength: 3}
            },
            highlight: function(element, error) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function(element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            submitHandler: function() {
                $.ajax({
                    type: "POST",
                    url: "/administrador/productos/categorias/nuevacategoria",
                    data:{
                        nombre: $("#categoria").val(),
                        categoria_id_padre: $('#categoria_id_padre').val(),
                        nivel_actual: $('#nivel_actual').val()
                    },
                    success: function(response){
                        if(response){
                            $('.close').hide();
                            $('#container-categoria').html('');
                            $('#calncelar-categoria').hide();
                            $('#click-categoria').hide();
                            $('#container-categoria').html("<center><b>Categoria agregada correctamente</b></center>");
                            $('#response-categoria').show();
                            return false;
                        }else{
                            $('.close').hide();
                            $('#container-categoria').html('');
                            $('#calncelar-categoria').hide();
                            $('#click-categoria').hide();
                            $('#container-categoria').html("<center><b><i class='fa fa-times-circle'></i> Error al crear categoria o la categoría ya existe</b></center>");
                            $('#response-categoria').show();
                            return false;
                        }
                    }
                });
            }
        });

        $('.editar_categoria').click(function(){

            var id = $(this).attr('data-id');
            var nombre = $(this).attr('data-nombre');

            $('#nombre_categoria').val(nombre);
            $('#id_categoria').val(id);

            $('#modal-editar-categoria').modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        var renombrarCategoria = $('#form-categoria_renombrar').validate({
            errorElement: "span",
            errorClass: "help-block",
            rules: {
                nombre_categoria: {required: true, minlength: 3}
            },
            highlight: function (element, error) {
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function (element) {
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            submitHandler: function () {
                $.ajax({
                    type: "POST",
                    url: "/administrador/productos/categorias/update",
                    data: {
                        nombre: $("#nombre_categoria").val(),
                        id: $("#id_categoria").val()
                    },
                    success: function (response) {
                        if(response){
                            $('.response-server').html("");
                            $('.remove').hide();
                            $('.response-server').html("<center><b>La categoría fue renombrada correctamente</b></center>");
                            $('.aceptar').show();
                        }else{
                            $('.response-server').html("");
                            $('.remove').hide();
                            $('.response-server').html("<center><b>Error al renombrar categoría</b></center>");
                            $('.aceptar').show();
                        }
                    }
                });
            }
        });

        $('.borrar_categoria').click(function(){

            var id = $(this).attr('data-id');
            var nombre = $(this).attr('data-nombre');

            $("#id_categoria_borrar").val(id);
            $("#nombre_categoria_borrar").html(nombre);

            $("#modal-borrar-categoria").modal({
                backdrop: 'static',
                keyboard: false
            });
        });

        $("#borrar-categoria-confirm").click(function(){

            var id_padre = $('#categoria_id_padre').val();
            var id_hijo = $("#id_categoria_borrar").val();

            $.ajax({
                method: "POST",
                url: "/administrador/productos/categorias/delete",
                data: { id_padre: id_padre,id_hijo: id_hijo }
            }).done(function(response) {
                if(response){
                    $('.response-server').html("");
                    $('.remove').hide();
                    $('.response-server').html("<center><b>La categoría fue borrada correctamente</b></center>");
                    $('.aceptar').show();
                }else{
                    $('.response-server').html("");
                    $('.remove').hide();
                    $('.response-server').html("<center><b>Error al borrar la categoría</b></center>");
                    $('.aceptar').show();
                }
            });
        });
    });

</script>