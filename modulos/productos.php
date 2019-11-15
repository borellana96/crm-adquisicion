<?php
check_user("productos");



if(isset($cat)){
	$sc = $mysqli->query("SELECT * FROM categorias WHERE id = '$cat'");
	$rc = mysqli_fetch_array($sc);
	?>
	<h1>Categoria Filtrada por: <?=$rc['nombre']?></h1>
	<?php
}

if(isset($busq) AND $busq !== ""){
	?>
	<h1>Producto buscado por: '<?=$busq?>'</h1>
	<?php
}

if(isset($agregar) && isset($cant)){

	$idp = clear($agregar);
	$cant = clear($cant);
	$id_cliente = clear($_SESSION['id_cliente']);

	$v = $mysqli->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");

	if(mysqli_num_rows($v)>0){

		$q = $mysqli->query("UPDATE carro SET cant = cant + $cant WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");
	
	}else{
		$q = $mysqli->query("INSERT INTO carro (id_cliente,id_producto,cant) VALUES ($id_cliente,$idp,$cant)");
	}
	alert("Se ha agregado al carro de compras",1,'productos');
	//redir("?p=productos");
}

if(isset($busq) && $busq !== "" && isset($cat) && $cat!=="") {
	$q = $mysqli->query("SELECT * FROM productos WHERE name like '%$busq%' AND id_categoria = '$cat'");

}elseif(isset($cat) && $cat!=="" && $busq==""){
	$q = $mysqli->query("SELECT * FROM productos WHERE id_categoria = '$cat' ORDER BY id DESC");
}elseif(isset($busq) && $busq!=="" && $cat == ""){
	$q = $mysqli->query("SELECT * FROM productos WHERE name like '%$busq%' ORDER BY id DESC");
}elseif(!isset($busq)  && !isset($cat)){
	$q = $mysqli->query("SELECT * FROM productos ORDER BY id DESC");	
}else{
	$q = $mysqli->query("SELECT * FROM productos ORDER BY id DESC");
}
?>
	
	<form method="post" action="">
		<div class="row">
			<div class="col-md-5">
				<div class="form-group">
					<input type="text" style="font-size: 18px;" class="form-control" name="busq" placeholder="Coloca el nombre del producto"/>
				</div>
			</div>

			<div class="col-md-5">
				<select id="categoria" style="font-size: 18px;" name="cat" class="form-control">
					<option value="" style="font-size: 18px;">Seleccione una categoria para filtrar</option>
					<?php
					$cats = $mysqli->query("SELECT * FROM categorias ORDER BY nombre ASC");
					while($rcat = mysqli_fetch_array($cats)){
						?>
						<option style="font-size: 18px;" value="<?=$rcat['id']?>"><?=$rcat['nombre']?></option>
						<?php
					}
					?>
				</select>
			</div>

			<div class="col-md-2">
				<button style="font-size: 18px;" type="submit" class="btn btn-primary" name="buscar"><i class="fa fa-search"></i> Buscar</button>
			</div>
		</div>
	</form>
<?php
while($r=mysqli_fetch_array($q)){
	$preciototal = 0;
			if($r['oferta']>0){
				if(strlen($r['oferta'])==1){
					$desc = "0.0".$r['oferta'];
				}else{
					$desc = "0.".$r['oferta'];
				}

				$preciototal = $r['price'] -($r['price'] * $desc);
			}else{
				$preciototal = $r['price'];
			}
	?>
			<div class="producto">
			<div class="name_producto" style="background-color: #42a5f5"><?=$r['name']?>
				<span align="right">
					<a type="" class="ver_product" product="<?php echo $r['name']; ?>" style=" text-decoration: none; float:right;" href="#">
					 <img src="https://image.flaticon.com/icons/png/512/15/15638.png" width="30px"> </a>
				</span>
			</div>
			<div>
				<a href="#"><img class="img_producto ver_product"  product="<?php echo $r['name']; ?>"href="#" src="<?=$r['imagen']?>" style="width: 100%;"/></a>

			</div>
			<?php
			if($r['oferta']>0){
				?>
				<del style="font-size: 18px;"> <?=$divisa?> <?=$r['price']?> 
				</del> 
				<span class="precio" style="font-size: 18px;"> <?=$divisa?> <?=$preciototal?>  </span>
				<?php
			}else{
				?>
				<span class="precio" style="font-size: 18px;"><br><?=$divisa?>  <?=$r['price']?> </span>
				<?php
			}
			?>
			
			<button class="btn pull-right" onclick="agregar_carro('<?=$r['id']?>');" style=" background-color:#00838f;border-radius:0px 4px 4px 0px; font-size: 18px !important;" width="150px"><i class="fa fa-shopping-cart"></i></button>
			&nbsp; &nbsp;
			<input style="width: 40px !important; height: 36px !important;" type="number" id="cant<?=$r['id']?>" name="cant" style="font-size: 15px;" class="cant pull-right" value="1"/>
		</div>
	<?php
}
?>

<script type="text/javascript">
	
	function agregar_carro(idp){
		var cant = prompt("¿Que cantidad desea agregar?",1);

		if(cant.length>0){
			window.location="?p=productos&agregar="+idp+"&cant="+cant;
		}
	}

</script>