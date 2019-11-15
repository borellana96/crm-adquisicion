<?php
check_user('miscompras');
$s = $mysqli->query("SELECT * FROM pedidos WHERE id_cliente = '".$_SESSION['id_cliente']."' ORDER BY fecha DESC");
if(mysqli_num_rows($s)>0){
	?>
	<h1 style="font-size: 18px;">Mis compras</h1>

	<table style="font-size: 16px;" class="table table-bordered">
		<tr class="thead-dark">
			<th>Fecha</th>
			<th>Monto</th>
			<td>Estado</td>
			<td>Acciones</td>
		</tr>

	<?php
	while($r=mysqli_fetch_array($s)){
		?>
		<tr>
			<td><?=fecha($r['fecha'])?></td>
			<td><?=$divisa?><?=number_format($r['monto'])?> </td>
			<td><?=estado($r['estado'])?></td>
			<td>
				<?php
					if($r['estado'] == 0){
				?>
				&nbsp; &nbsp; <a class="btn btn-success" title="Pagar" href="?p=pagar_compra&id=<?=$r['id']?>">Pagar</a>
				<?php
					} else{
				?>	
				<a  class="btn btn-info" href="?p=ver_compra&id=<?=$r['id']?>">
					<i class="fa fa-eye"></i>&nbsp;Ver Detalles
				</a>

				<?php
					}
				?>
			</td>
		</tr>
		<?php
	}
	?>
	</table>

	<?php
}else{
	?>
	<i style="font-size: 18px;">Usted aun no ha comprado</i>
	<?php
}