<?php

check_user('carrito');

if(isset($eliminar)){
	$eliminar = clear($eliminar);
	$mysqli->query("DELETE FROM carro WHERE id = '$eliminar'");
	redir("?p=carrito");
}

if(isset($id) && isset($modificar)){

	$id = clear($id);
	$modificar = clear($modificar);

	$mysqli->query("UPDATE carro SET cant = '$modificar' WHERE id = '$id'");
	alert("Cantidad modificada",1,'carrito');
	//redir("?p=carrito");


}

if(isset($finalizar)){
//obtengo el monto total del pedido
	$monto = clear($monto_total);

	$id_cliente = clear($_SESSION['id_cliente']);
	$q = $mysqli->query("INSERT INTO pedidos (id_cliente,fecha,monto,estado) VALUES ('$id_cliente',NOW(),'$monto',0)");

	$sc = $mysqli->query("SELECT * FROM pedidos WHERE id_cliente = '$id_cliente' ORDER BY id DESC LIMIT 1");
	$rc = mysqli_fetch_array($sc);
	//obtenemos la ultima compra(pedido)
	//ultima compra guarda el id del pedido!
	$ultima_compra = $rc['id'];


	$q2 = $mysqli->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente'");
	//obtenemos todos los productos del carrito q sea del cliente,
	while($r2=mysqli_fetch_array($q2)){

		$sp = $mysqli->query("SELECT * FROM productos WHERE id = '".$r2['id_producto']."'");
		$rp = mysqli_fetch_array($sp);
			//rp es un producto, del carrito
		$monto = $rp['price'];

		$mysqli->query("INSERT INTO compra_detalle (id_pedido,id_producto,cantidad,monto) VALUES ('$ultima_compra','".$r2['id_producto']."','".$r2['cant']."','$monto')");

	}
	//eliminamos el carro del cliente!
	$mysqli->query("DELETE FROM carro WHERE id_cliente = '$id_cliente'");

	$sc = $mysqli->query("SELECT * FROM pedidos WHERE id_cliente = '$id_cliente' ORDER BY id DESC LIMIT 1");
	$rc = mysqli_fetch_array($sc);
	//obtenemos elid de la compra
	$id_compra = $rc['id'];

	alert("Se ha finalizado la solicitud de compra, tiene 3 dias hábiles para realizar el pago correspondiente",1,'ver_compra&id='.$id_compra);
	//redir("?p=ver_compra&id=".$id_compra);

}
?>

<h1><i class="fa fa-shopping-cart"></i> Carro de Compras</h1>
<br><br>

<table class="table table-striped" style="font-size: 15px;">
	<tr>
		<th><i class="fa fa-image"></i></th>
		<th>Nombre del producto</th>
		<th>Cantidad</th>
		<th>Precio por unidad</th>
		<th>Oferta</th>
		<th>Precio Total</th>
		<th>Precio Neto</th>
		<th>Action</th>
	</tr>
<?php
$id_cliente = clear($_SESSION['id_cliente']);
$q = $mysqli->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente'");
$monto_total = 0;
while($r = mysqli_fetch_array($q)){
	$q2 = $mysqli->query("SELECT * FROM productos WHERE id = '".$r['id_producto']."'");
	$r2 = mysqli_fetch_array($q2);

	$preciototal = 0;
			if($r2['oferta']>0){
				if(strlen($r2['oferta'])==1){
					$desc = "0.0".$r2['oferta'];
				}else{
					$desc = "0.".$r2['oferta'];
				}

				$preciototal = $r2['price'] -($r2['price'] * $desc);
			}else{
				$preciototal = $r2['price'];
			}

	$nombre_producto = $r2['name'];

	$cantidad = $r['cant'];

	$precio_unidad = $r2['price'];
	$precio_total = $cantidad * $preciototal;
	$imagen_producto = $r2['imagen'];

	$monto_total = $monto_total + $precio_total;

	

	?>
		<tr>
			<td><img src="<?=$imagen_producto?>" class="imagen_carro"/></td>
			<td><?=$nombre_producto?></td>
			<td><?=$cantidad?></td>
			<td><?=$divisa?> <?= $precio_unidad?></td>
			<td>
				<?php
					if($r2['oferta']>0){
						echo $r2['oferta']."% de Descuento";
					}else{
						echo "Sin descuento";
					}
				?>
			</td>
			<td><?=$divisa?><?=$preciototal?></td>
			<td><?=$divisa?><?=$precio_total?> </td>
			<td>
				<a onclick="modificar('<?=$r['id']?>')" href="#"><i class="fa fa-edit" title="Modificar cantidad en carrito"></i></a>
				<a href="?p=carrito&eliminar=<?=$r['id']?>"><i class="fa fa-times" title="Eliminar"></i></a>
			</td>
		</tr>
	<?php
}
?>
</table>
<br>
<h2>Monto Total: <b class="text-green"><?=$monto_total?> <?=$divisa?></b></h2>

<br><br>
<?php  if(!$monto_total==0){
?>
<form method="post" action="">
		
	



   <div class="form-group">
  
 <label style="font-size: 18px;" for="exampleInputEmail1">Elija el departamento</label>
    <select class="form-control" style="font-size: 18px;" name="depa" id="exampleFormControlSelect1">
      <option>Lima</option>
      <option>Ica</option>
      <option>Junin</option>
      <option>Ancash</option>
      <option>Piura</option>
    </select>
  </div>

	<div class="form-group">
   	 <label style="font-size: 18px;" for="exampleInputEmail1">Ingrese la dirección de envio a domicilio</label>
    	<input type="text" style="font-size: 18px;" class="form-control" name="direc" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Dirección" required>

  	</div>

  	<p></br></p>


	<input type="hidden" name="monto_total" value="<?=$monto_total?>"/>


		<center>
				<button class="btn btn-success" type="submit" name="finalizar" style="font-size:25px;"><i class="fa fa-check"></i> Finalizar solicitud de  Compra</button>

		</center>
	


	
</form>
<?php } ?>
<script type="text/javascript">
		
	function modificar(idc){
		var new_cant = prompt("¿Cual es la nueva cantidad?");

		if(new_cant>0){

			window.location="?p=carrito&id="+idc+"&modificar="+new_cant;

		}

	}

</script>