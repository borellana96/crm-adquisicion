<?php
check_admin();

// 0 Ordenado
// 1 Preparando
// 2 Transito
// 3 Despachado
// 4 Aduanas

$s = $mysqli->query("SELECT * FROM pedidos WHERE estado != 3");

if(isset($eliminar)){
	$eliminar = clear($eliminar);

	$mysqli->query("DELETE FROM productos_compra WHERE id_compra = '$eliminar'");

	$mysqli->query("DELETE FROM pedido WHERE id = '$eliminar'");
	redir("?p=admin_pedidos");

}


?>

<h1>Pedidos</h1><br><br>

<table class="table table-striped">
	<tr>
		<th>Cliente</th>
		<th>Fecha</th>
		<th>Monto</th>
		<th>Status</th>
		<th>Acciones</th>
	</tr>
<?php
		
	while($r=mysqli_fetch_array($s)){
		//cleinte
		$sc = $mysqli->query("SELECT * FROM clientes WHERE id = '".$r['id_cliente']."'");

		$rc = mysqli_fetch_array($sc);
		$cliente = $rc['nombres'];

		if($r['estado'] == 0){
			$status = "Ordenado";
		}elseif($r['estado']==1){
			$status = "Preparando";
		}elseif($r['estado'] == 2){
			$status = "Transito";
		}elseif($r['estado'] == 3){
			$status = "Despachado";
		}elseif($r['estado'] == 4){
			$status = "Retenido";
		}else{
			$status = "Indefinido";
		}

		$fecha = fecha($r['fecha']);


		?>
		<tr>
			<td><?=$cliente?></td>
			<td><?=$fecha?></td>
			<td> <?=$divisa?><?=$r['monto']?></td>
			<td><?=$status?></td>
			<td>
				<a  style="color:#08f" href="?p=admin_pedidos&eliminar=<?=$r['id']?>">
					<i class="fa fa-times"></i>
				</a>
				&nbsp; &nbsp;
				<a  style="color:#08f" href="?p=cambiar_estado&id=<?=$r['id']?>">
					<i class="fa fa-edit"></i>
				</a>
				&nbsp; &nbsp;
				<a  style="color:#08f" href="?p=ver_compra&id=<?=$r['id']?>">
					<i class="fa fa-eye"></i>
				</a>
			</td>
		</tr>
		<?php
	}
?>
</table>