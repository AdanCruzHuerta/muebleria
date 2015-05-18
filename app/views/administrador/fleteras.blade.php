@extends('templates.layout_administrador')

@section('contenido')

	{{ HTML::style('css/dataTables.bootstrap.css') }}

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<h2><i class="fa fa-truck"></i> Fleteras</h2>
			<ol class="breadcrumb breadcrumb-arrow">
				<li><a href="/administrador">Home</a></li>
				<li class="active"><span>Fleteras</span></li>
			</ol>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table class='table table-hover'>
						<thead>
							<tr>
								<th><center>Nombre</center></th>
								<th><center>Email</center></th>
								<th><center>Teléfono</center></th>
								<th><center>Opciones</center></th>
							</tr>
						</thead>
						<tbody id="lista-fleteras">
							@foreach($fleteras as $fletera)
							<tr>
								<td> {{$fletera->nombre}} </td>
								<td> {{$fletera->email}} </td>
								<td> {{$fletera->telefono}} </td>
								<td>
									<center>
										
										<a href="/administrador/fleteras/editar/{{$fletera->id}}" title="Editar" class="opciones-fletera"><i class="fa fa-pencil"></i></a>

										<a href="javascript:;" title="Borrar" class="opciones-fletera delete-fletera" data-id="{{ $fletera->id }}" data-nombre="{{ $fletera->nombre }}"><i class="fa fa-trash-o"></i></a>
										
									</center>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<a href="/administrador/fleteras/add-fletera" class="btn btn-primary pull-right"><i class="fa fa-plus-circle"></i> Agregar Fletera</a><br><br><br>
		</div>

		<div class="modal fade" id="modal-delete-fletera">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close btn-remove" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Borrar fletera</h4>
					</div>
					<form>
						<div class="modal-body">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<center id="mensaje-modal">¿Realmente desea eliminar a: <b><span class="nombre-fletera"></span></b>?</center>
									<input id="value-fletera" type="hidden"/>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger btn-remove" data-dismiss="modal">Cancelar</button>
							<button id="fletera-delete" type="button" class="btn btn-primary cancelar btn-remove">Borrar</button>
							<a href="/administrador/fleteras" id="delete_ok" type"button" class="btn btn-primary btn-confirmar"><i class="fa fa-check-circle"></i> Cerrar</a>
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

			$('table').delegate('.delete-fletera','click',function(){
				
				var id 		=	$(this).attr('data-id');
				var nombre 	= 	$(this).attr('data-nombre');

				$('.nombre-fletera').html(nombre);
				$('#value-fletera').val(id);

				$('#modal-delete-fletera').modal({
					backdrop: 'static',
				  	keyboard: false,
				});
			});

			$('#fletera-delete').click(function(){
				
				var id = $('#value-fletera').val();
				$.ajax({
					type:'POST',
					url:'/administrador/fleteras/delete',
					data:{id:id},
					success: function(response){
						if(response)
						{
							$("#mensaje-modal").html("<b><i class='fa fa-exclamation-circle'></i> La fletera ha sido borrada</b>");
							$(".btn-remove").hide();
							$("#delete_ok").show();
							return false;
						}
					}
				});
			});
		});
	</script>

@stop