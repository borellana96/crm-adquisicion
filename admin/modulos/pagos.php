<?php
check_admin();

if(isset($aceptar)){
	$mysqli->query("UPDATE ventas SET estado = 1 WHERE id = '$aceptar'");
	$id_compra = clear($id_compra);
	$mysqli->query("UPDATE ventas SET estado = 1 WHERE id = '$id_compra'");
	alert("Pago verificado.");
	redir("?p=ver_compra&id=".$id_compra);
}

?>

<h1>Pagos</h1>

<table class="table table-striped">
	<tr>
		<th>Cliente</th>
		<th>Factura</th>
		<th>Acciones</th>
	</tr>
	<?php
	$s = $mysqli->query("SELECT p.id as id_pedido,p.id_cliente as id_cliente,f.id as id_factura FROM pedidos p INNER JOIN facturas f WHERE p.id=f.id_pedido");
	while($r=mysqli_fetch_array($s)){
	?>
		<tr>
			<td><?=nombre_cliente($r['id_cliente'])?></td>
			<td><?=$r['id_factura']?></td>
			<td>
				<a style="color:#333" target="_blank" href="?p=ver_factura&id=<?=$r['id_factura']?>">Ver Factura <i class="fa fa-eye"></i></a>
				&nbsp;<a style="color:#333" target="_blank" href="?p=ver_compra&id=<?=$r['id_pedido']?>">Detalles<i class="fa fa-eye" title="Ver Compra"></i></a>
			</td>
		</tr>
		<?php
	}
	?>
</table>