<?php
check_admin();

$id = clear($id);

$s = $mysqli->query("SELECT * FROM pedidos WHERE id = '$id'");
$r = mysqli_fetch_array($s);

?>
<h1>Detalles de la compra de <span style="color:#08f"><?=nombre_cliente($r['id_cliente'])?></span></h1><br>
<br>
<table class="table table-striped">
	<tr>
		<th>Nombre del producto</th>
		<th>Cantidad</th>
		<th>Monto</th>
	</tr>
	<?php
		$sp = $mysqli->query("SELECT pr.name as producto, c.cantidad, c.monto FROM pedidos p INNER JOIN compra_detalle c ON p.id=c.id_pedido INNER JOIN productos pr ON c.id_producto=pr.id WHERE p.id='$id'");
		while($rp=mysqli_fetch_array($sp)){
			?>
				<tr>
					<td><?=$rp['producto']?></td>
					<td><?=$rp['cantidad']?></td>
					<td><?=$rp['monto']?></td>
				</tr>
			<?php
		}
	?>
</table>