<?php
check_user('pagar_compra');

if(isset($id)){
	$q = $mysqli->query("SELECT * FROM pedidos WHERE id = '$id'");
	$pedido = mysqli_fetch_array($q);
}

if(isset($subir)){
	$numtarjeta = clear($numtarjeta);
// cambiar estado pedido de  0 a 1
// insertar factura
	$mysqli->query("INSERT INTO facturas (id_pedido,numtarjeta) VALUES ('$id','$numtarjeta')");
	$u1->query("UPDATE pedidos SET estado = 1 WHERE id='$id'");

	alert("Pagado",1,'miscompras');
	//redir("?p=miscompras");

}
?>
<div class="container"> 
	<div class="">
		<form method="post" action="" enctype="multipart/form-data">
			<div class="col-md-6">
				<h1>Cancelar pedido</h1>	
					<div class="form-group">
						<label  style="font-size: 16px;">Seleccione tipo de pago</label>
						<select name="tipo" id="" style="font-size: 16px;" class="form-control">
							<option default value="">Seleccione una opcion</option>
							<option  value=""> DINERS CLUB </option>
							<option  value="">VISA</option>
							<option  value="">MASTERCARD</option>
							<option value="">AMERICAN EXPRESS</option>
						</select>
					</div>
					<div class="form-group">
						<label for=""  style="font-size: 16px;">Número de tarjeta</label>
						<input type="number" class="form-control" style="font-size: 16px;" name="numtarjeta" title="Numero de tarjeta" required="" />
					</div>
					<div class="form-group">
						<label for=""  style="font-size: 16px;">Código de seguridad</label>
						<input type="number" class="form-control" style="font-size: 16px;"/>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for=""  style="font-size: 16px;">Vencimiento - Año</label>
								<input type="number" class="form-control" style="font-size: 16px;"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for=""  style="font-size: 16px;">Vencimiento - Mes</label>
								<input type="number" class="form-control" style="font-size: 16px;"/>
							</div>
						</div>						
					</div>					
					<div class="form-group">
						<label for=""  style="font-size: 16px;">Nombre Completo</label>
						<input type="text" class="form-control" style="font-size: 16px;" />
					</div>
					<div class="form-group">
					<input type="submit" style="font-size: 20px;" name="subir" class="btn btn-lg btn-primary pull-right" value="Pagar"/>
					</div>	
			</div>
			<div class="col-md-6">
				<br><br>
				<label for="" style="font-size: 16px; " >Monto total Pedido</label>
				<input type="text" readonly=""  style="font-size: 16px; color: red; font-weight: bold;"value="S/. <?=$pedido['monto']?>"
					class="form-control">
			</div>
		</form>
	</div>
</div>





