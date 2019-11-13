<?php
check_admin();

$id = clear($id);

$q = $mysqli->query("SELECT * FROM productos WHERE id = '$id'");
$rq = mysqli_fetch_array($q);

if(isset($enviar)){
	$idpro = clear($idpro);
	$name = clear($name);
	$price = clear($price);
	$categoria = clear($categoria);
	$oferta = clear($oferta);
	$stock = clear($stock);
	$descripcion = clear($descripcion);

	$mysqli->query("UPDATE productos SET name = '$name',price = '$price',id_categoria = '$categoria', oferta = '$oferta', stock = '$stock', descripcion = '$descripcion' WHERE id = '$idpro'");
	redir("?p=agregar_producto");

}

?>
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<input type="text" class="form-control" name="name" value=<?=$rq['name']?>>
	</div>
	<div class="form-group">
		<input type="text" class="form-control" name="price" value=<?=$rq['price']?>>
	</div>
	<label>Imagen del producto</label>
	<div class="form-group">
		<input type="text" class="form-control" name="imagen" title="Imagen del producto" value=<?=$rq['imagen']?>>
	</div>
	<div class="form-group">
		<?php $q = $mysqli->query("SELECT * FROM categorias ORDER BY nombre ASC");?>
		<select name="categoria" required class="form-control">
			<option value="">Seleccione una categoria</option>
			<?php
				while($r=mysqli_fetch_array($q)){
					?>
						<option value="<?=$r['id']?>"><?=$r['nombre']?></option>
					<?php
				}
			?>
		</select>

	</div>

	<div class="form-group">
		<select name="oferta" class="form-control" value=<?=$rq['oferta']?>>
			<option value="0">0% de Descuento</option>
			<option value="5">5% de Descuento</option>
			<option value="10">10% de Descuento</option>
			<option value="15">15% de Descuento</option>
			<option value="20">20% de Descuento</option>
			<option value="25">25% de Descuento</option>
			<option value="30">30% de Descuento</option>
			<option value="35">35% de Descuento</option>
			<option value="40">40% de Descuento</option>
			<option value="45">45% de Descuento</option>
			<option value="50">50% de Descuento</option>
			<option value="55">55% de Descuento</option>
			<option value="60">60% de Descuento</option>
			<option value="65">65% de Descuento</option>
			<option value="70">70% de Descuento</option>
			<option value="75">75% de Descuento</option>
			<option value="80">80% de Descuento</option>
			<option value="85">85% de Descuento</option>
			<option value="90">90% de Descuento</option>
			<option value="95">95% de Descuento</option>
			<option value="99">99% de Descuento</option>
		</select>
	</div>

	<div class="form-group">
		<label>Stock</label>
		<input class="form-control" type="text" name="stock" value=<?=$rq['stock']?>>
	</div>

	<div class="form-group">
		<label>Descripción</label>
		<input class="form-control" type="text" name="descripcion" value=<?=$rq['descripcion']?>>
	</div>


	<div class="form-group">
		<button type="submit" class="btn btn-success" name="enviar"><i class="fa fa-check"></i> Modificar Producto</button>
	</div>

</form>