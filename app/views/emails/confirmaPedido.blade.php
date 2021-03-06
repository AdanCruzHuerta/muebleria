<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Alerts e.g. approaching your limit</title>
{{ HTML::style('css/mail.css') }}
</head>

<body itemscope itemtype="http://schema.org/EmailMessage">

<table class="body-wrap">
	<tr>
		<td></td>
		<td class="container" width="600">
			<div class="content">
				<table class="main" width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td class="alert alert-warning">
							Mensaje de Mueblería Ureña - Confirmación de pedido
						</td>
					</tr>
					<tr>
						<td class="content-wrap">
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td class="content-block">
										Apreciable cliente: <b>{{ " ".$nombre." " }}</b> Gracias por realizar su compra con Mueblería Ureña.
									</td>
								</tr>
								<tr>
									<td class="content-block">
										Número de Pedido: <b>{{ " ".$pedido." " }}</b>
									</td>
								</tr>
								<tr>
									<td class="content-block">
										En un lapso de siete a diez días estaremos haciendo entrega de tu artículo. En caso de alguna duda puedes contactarnos al teléfono: (312) 312 5453 o escribirnos en la sección de contacto del sitio.
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<div class="footer">
					<table width="100%">
						<tr>
							<td class="aligncenter content-block"><a href="http://www.sharksoft.com.mx">Desarrollado por SharkSoft</a></td>
						</tr>
					</table>
				</div></div>
		</td>
		<td></td>
	</tr>
</table>

</body>
</html>