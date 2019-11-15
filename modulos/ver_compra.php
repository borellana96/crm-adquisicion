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

<span style="font-size: 16px;"> Fecha: &nbsp;</span> 
<label for="fecha"  style="font-size: 16px;" class="label label-primary"><?=fecha($r['fecha'])?>
</label>
 <br><br>
 <span style="font-size: 16px;">Monto:&nbsp;
</span>
<label for="monto" style="font-size: 16px;" class="label label-primary"> <?=$divisa?> <?=number_format($r['monto'])?></label> 
<br><br>
 <span style="font-size: 16px;">Estado:
</span>
<label for="estado" style="font-size: 16px;" class="label label-primary"><?=estado($r['estado'])?> </label> 
<br>
<br>
<table class="table table-bordered">
	<tr class="thead-dark" style="font-size: 14px;" >
		<th>Nombre del producto</th>
		<th>Cantidad</th>
		<th>Precio</th>
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
				<tr style="font-size: 14px;">
					<td><?=$nombre_producto?></td>
					<td><?=$rp['cantidad']?></td>
					<td><?=$rp['monto']?></td>
					<td><?=$montototal?></td>
					<td>
						<?php if($r['estado']==0) {?>
									<button href="#" class="btn btn-lg btn-success">Pagar</button>
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