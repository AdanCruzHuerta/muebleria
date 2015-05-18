<div class="modal fade" id="modal-delete-slider">
			<div class="modal-dialog modal-sm">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close btn-remove" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title">Borrar imagen</h4>
					</div>
					<form>
						<div class="modal-body">
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
									<center id="mensaje-modal">¿Realmente desea eliminar a: <b><span class="nombre-slider"></span></b>?</center>
									<input id="value-slider" type="hidden"/>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger btn-remove" data-dismiss="modal">Cancelar</button>
							<button id="slider-delete" type="button" class="btn btn-primary cancelar btn-remove">Borrar</button>
							<a href="/administrador/pagina/slider" id="delete_ok" type"button" class="btn btn-primary btn-confirmar"><i class="fa fa-check-circle"></i> Aceptar</a>
						</div>
					</form>
				</div>
			</div>
</div>