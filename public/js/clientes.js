$(document).ready(function(){
	$('#consulta_clientes').click(function(){
		$.ajax({
			url:'http://urena.sharksoft.com.mx/admon/clientes',
			type:'post',
			timeout: 5000,
			data:{
				peticion:true
			}
		}).done(function(resp){
			var clientes = $.parseJSON(resp);
			var tabla = "";
			var title = "<center><h5>PANEL DE ADMINISTRACIÓN DE MUEBLERÍA UREÑA ONLINE<br>CLIENTES</h5></center>";
			tabla += "<table id='tabla_clientes' class='table table-hover'><thead><tr><th>NOMBRE</th><th>EMAIL</th><th>TELÉFONO</th><th>CIUDAD</th></tr></thead><tbody>";
			for(var i = 0; i<clientes.length; i++){
				tabla += "<tr onclick='index("+clientes[i].id+")' class='clientes_admon'><td>"+clientes[i].nombre+" "+clientes[i].apellido_p+" "+clientes[i].apellido_m+"</td><td>"+ clientes[i].email +"</td><td>"+ clientes[i].telefono +"</td><td>"+ clientes[i].ciudad +"</td></tr>";
			}
			tabla += "</tbody></table>";

			$('#title-panel').html(title);
			$("#clientes").html(tabla);
			$("#tabla_clientes").dataTable();

			function index(){
				alert();
			}
		}); 
	});
});