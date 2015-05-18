@extends('templates.layout_administrador')

@section('contenido')
	
	{{ HTML::style('css/dataTables.bootstrap.css') }}
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h2><i class="fa fa-shopping-cart"></i> Proveedores</h2>
			<ol class="breadcrumb breadcrumb-arrow">
				<li><a href="/administrador">Home</a></li>
				<li  class="active"><span>Proveedores</span></li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table class="table table-hover">
						<thead>
							<tr>
								<th><center>Nombre</center></th>
								<th><center>Email</center></th>
								<th><center>Telefono</center></th>
								<th><center>Opciones</center></th>
							</tr>
						</thead>
						<tbody>
							@foreach($proveedores as $proveedor)
							<tr>
								<td>{{ $proveedor->nombre }}</td>
								<td>{{ $proveedor->email }}</td>
								<td>{{ $proveedor->telefono }}</td>
								<td>
									<center>
										<a href="/administrador/proveedores/editar/{{$proveedor->id}}" title="Editar" class="opciones-fletera"><i class="fa fa-pencil"></i></a>

										<a href="javascript:;" title="Borrar" class="opciones-fletera delete-proveedor" data-id="{{ $proveedor->id }}" data-nombre="{{ $proveedor->nombre }}" data-action="eliminar" ><i class="fa fa-trash-o"></i></a>
									</center>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<a href="/administrador/proveedores/add-proveedor" class="btn btn-primary pull-right"><i class="fa fa-plus-circle"></i> Agregar Proveedor</a><br><br><br>
		</div>

		<div class="modal fade" id="modal-delete-proveedor">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close btn-remove" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Borrar proveedor</h4>
					</div>
					<form id="form-categoria" method="post">
						<div class="modal-body">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<center id="mensaje-modal">¿Realmente desea eliminar a: <b><span class="nombre-proveedor"></span></b>?</center>
									<input id="value-proveedor" type="hidden"/>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger btn-remove" data-dismiss="modal">Cancelar</button>
							<button id="click-delete-proveedor" type="button" class="btn btn-primary btn-remove">Borrar</button>
							<a href="/administrador/proveedores" class="btn btn-primary btn-confirmar"><i class="fa fa-check-circle"></i> Cerrar</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	

	</div>

	{{ HTML::script('js/dataTables.min.js') }}
	{{ HTML::script('js/dataTables.bootstrap.js') }}

	<script>
		$(document).ready(function(){
			$('.table').dataTable();

			$('table').delegate('.delete-proveedor','click', function(){
				var accion = $(this).attr('data-action');
				var id = $(this).attr('data-id');
				var nombre = $(this).attr('data-nombre');

				$('.nombre-proveedor').html(nombre);
				$('#value-proveedor').val(id);

				$('#modal-delete-proveedor').modal({
					backdrop: 'static',
				  	keyboard: false,
				});
			});

			$('#click-delete-proveedor').click(function(){
				var id = $('#value-proveedor').val();
			
				$.ajax({
					type: "POST",
					url: "/administrador/proveedores/delete",
					data:{id:id},
					success: function(res){
						if(res.resp){
							$('#mensaje-modal').html("<b><i class='fa fa-exclamation-circle'></i> El proveedor ha sido borrado</b>");
							$('.btn-remove').hide();
							$('.btn-confirmar').show();
							return false;
						}
					}
				});
			});
		});
	</script>

@stop