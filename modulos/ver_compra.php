<?php
check_user('ver_compra');
$id = clear($id);

$s = $mysqli->query("SELECT * FROM pedidos WHERE id = '$id' AND id_cliente = '".$_SESSION['id_cliente']."'");

if(mysqli_num_rows($s)>0){

$s = $mysqli->query("SELECT * FROM pedidos WHERE id = '$id'");
$r = mysqli_fetch_array($s);

$sc = $mysqli->query("SELECT * FROM clientes WHERE id = '".$r['id_cliente']."'");
$rc = mysqli_fetch_array($sc);

$nombre = $rc['nombres'];

?>
<h1>Viendo compra #<span style="color:#08f"><?=$r['id']?></span></h1><br>

Fecha: <?=fecha($r['fecha'])?><br>
Monto: <?=$divisa?> <?=number_format($r['monto'])?><br>
Estado: <?=estado($r['estado'])?><br>
<br>
<table class="table table-striped">
	<tr>
		<th>Nombre del producto</th>
		<th>Cantidad</th>
		<th>Monto</th>
		<th>Monto Total</th>
		<th>Acciones</th>
	</tr>
	<?php
		$sp = $mysqli->query("SELECT * FROM compra_detalle WHERE id_pedido = '$id'");
		while($rp=mysqli_fetch_array($sp)){

			$spro = $mysqli->query("SELECT * FROM productos WHERE id = '".$rp['id_producto']."'");
			$rpro = mysqli_fetch_array($spro);

			$nombre_producto = $rpro['name'];

			$montototal = $rp['monto'] * $rp['cantidad'];
			?>
				<tr>
					<td><?=$nombre_producto?></td>
					<td><?=$rp['cantidad']?></td>
					<td><?=$rp['monto']?></td>
					<td><?=$montototal?></td>
					<td>
						<?php if($r['estado']==0) {?>
									<button href="#" class="btn btn-success">Pagar</button>
							<?php 
								}else {

								echo "--";

								}	?>	
							


					</td>
				</tr>
			<?php
		}
	?>
</table>
<br>
<br>
<?php
if(estado($r['estado']) == "Iniciando"){
	?>
	<a class="btn btn-primary" href="?p=pagar_compra&id=<?=$r['id']?>">
		Pagar
	</a>
	<?php
}
?>

<?php

}else{
	alert("Ha ocurrido un error",0,'?p=miscompras');
	redir("?p=miscompras");
}