<?php
check_admin();
?>
<h3>Aquí se tendrá una lista de los productos más comprados y los menos comprados así como
las categorías más compradas y las menos compradas</h3>
<table class="table table-bordered">
	<tr class="thead-dark">
		<th>Nombre</th>
		<th>Precio</th>
		<th>Descuento</th>
		<th>Precio Total</th>
		<th>Imagen</th>
		<th>Categoria</th>
		<th>Stock</th>
		<th>Acciones</th>
	</tr>

	<?php
		$prod = $mysqli->query("SELECT * FROM productos ORDER BY id DESC");
		while($rp=mysqli_fetch_array($prod)){
			$preciototal = 0;

			$cat = $mysqli->query("SELECT * FROM categorias WHERE id = '".$rp['id_categoria']."'");

			if(mysqli_num_rows($cat)>0){
				$rcat = mysqli_fetch_array($cat);
				$categoria = $rcat['nombre'];
			}else{
				$categoria = "--";
			}

			if($rp['oferta']>0){
				if(strlen($rp['oferta'])==1){
					$desc = "0.0".$rp['oferta'];
				}else{
					$desc = "0.".$rp['oferta'];
				}

				$preciototal = $rp['price'] -($rp['price'] * $desc);
			}else{
				$preciototal = $rp['price'];
			}



			?>
				<tr>
					<td><?=$rp['name']?></td>
					<td><?=$rp['price']?></td>
					<td>
						<?php
							if($rp['oferta']>0){
								echo $rp['oferta']."% de Descuento";
							}else{
								echo "Sin descuento";
							}
						?>
					</td>

					<td><?=$preciototal?></td>

					<td><img src="<?=$rp['imagen']?>" class="imagen_carro"/></td>
					<td><?=$categoria?></td>
					<td><?=$rp['stock']?></td>
					<td>
						
						<a style="color:#08f" href="?p=modificar_producto&id=<?=$rp['id']?>"><i class="fa fa-edit"></i></a>
						&nbsp;
						<a style="color:#08f" href="?p=agregar_producto&eliminar=<?=$rp['id']?>"><i class="fa fa-times"></i></a>

					</td>
				</tr>
			<?php
		}
	?>

</table>