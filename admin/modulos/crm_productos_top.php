<?php
check_admin();
?>
<div class="container">
		<h3>TOP PRODUCTOS ELECTRO FISI</h3>
	<div class="row">
		<div class="col-lg-3">
			<nav class="nav"  style="background-color: #1FB3BF;">
			  <a class="nav-link "  href="./?p=crm_productos">Categorias</a>
			  <a class="nav-link " href="./?p=crm_productos_cat">Productos</a>
			  <a class="nav-link active" href="./?p=crm_productos_top">Top</a>
			</nav>	
		</div>		
	</div>
	<div class="row">		
		<div class="col-lg-5">	
			<h3>Top 10 - Productos más comprados </h3>
			<table class="table table-bordered table-primary table-hover ">
				<tr class="thead-dark">
					<th>Nombre</th>
					<th>Precio</th>
					<th>Imagen</th>
					<th>Categoria</th>
					<th>Sold</th>
				</tr>
				<?php
					$prod = $mysqli->query("SELECT productos.*, SUM(cantidad) as total FROM productos LEFT JOIN compra_detalle ON compra_detalle.id_producto = productos.id GROUP BY productos.id ORDER BY total DESC LIMIT 0 , 10");
					while($rp=mysqli_fetch_array($prod)){
						$preciototal = 0;
						$cat = $mysqli->query("SELECT * FROM categorias WHERE id = '".$rp['id_categoria']."'");
						if(mysqli_num_rows($cat)>0){
							$rcat = mysqli_fetch_array($cat);
							$categoria = $rcat['nombre'];
						}else{
							$categoria = "--";
						}
						?>
							<tr>
								<td><?=$rp['name']?></td>
								<td><?=$rp['price']?></td>
								<td><img src="<?=$rp['imagen']?>" class="imagen_carro"/></td>
								<td><?=$categoria?></td>
								<td><?=$rp['total']?></td>
							</tr>
						<?php
					}
				?>
			</table>
		</div>		
		
		<div class="col-lg-5">	
			<h3>Top 10 -Productos menos comprados </h3>
			<table class="table table-bordered table-hover table-danger">
				<tr class="thead-dark">
					<th scope="col">Nombre</th>
					<th scope="col">Precio</th>
					<th scope="col">Imagen</th>
					<th scope="col">Categoria</th>
					<th>Sold</th>
				</tr>
				<?php
					$prod = $mysqli->query("SELECT productos.*,  SUM(cantidad) as total 
					 from productos  LEFT JOIN compra_detalle
					 ON compra_detalle.id_producto = productos.id GROUP BY productos.id 
					 ORDER BY total ASC LIMIT 0 , 10;
					");
					while($rp=mysqli_fetch_array($prod)){
						$preciototal = 0;
						$cat = $mysqli->query("SELECT * FROM categorias WHERE id = '".$rp['id_categoria']."'");
						if(mysqli_num_rows($cat)>0){
							$rcat = mysqli_fetch_array($cat);
							$categoria = $rcat['nombre'];
						}else{
							$categoria = "--";
						}
						?>
							<tr>
								<td><?=$rp['name']?></td>
								<td><?=$rp['price']?></td>
								<td><img src="<?=$rp['imagen']?>" class="imagen_carro"/></td>
								<td><?=$categoria?></td>
								<td><?=$rp['total']?></td>
							</tr>
						<?php
					}
				?>
			</table>		
		</div>		
	</div>
	<div class="row">
		<div class="col-lg-5">	
			<h3>Top 5 - Categorias más comprados </h3>
			<table class="table table-bordered table-primary table-hover ">
				<tr class="thead-dark">
					<th>Nombre Categoria</th>
					<th>Total Vendido</th>
				</tr>
				<?php
					$prod = $mysqli->query("SELECT categorias.*,  SUM(cantidad) as total 
					 from productos
					 LEFT JOIN compra_detalle		 ON compra_detalle.id_producto = productos.id 
					 INNER JOIN categorias ON categorias.id=productos.id_categoria
					 GROUP BY categorias.id  ORDER BY total DESC LIMIT 0 , 5");
					while($rp=mysqli_fetch_array($prod)){
						?>
							<tr>
								<td><?=$rp['nombre']?></td>
								<td><?=$rp['total']?></td>
							</tr>
						<?php
					}
				?>

			</table>
		</div>		
		
		<div class="col-lg-5">	
			<h3>Top 5 - Categorias menos comprados </h3>
			<table class="table table-bordered table-hover table-danger">
				<tr class="thead-dark">
					<th scope="col">Nombre Categoría</th>
					<th scope="col">Total vendido</th>
				</tr>
				<?php
					$prod = $mysqli->query("SELECT categorias.*,  SUM(cantidad) as total 
					 from productos
					 LEFT JOIN compra_detalle		 ON compra_detalle.id_producto = productos.id 
					 INNER JOIN categorias ON categorias.id=productos.id_categoria
					 GROUP BY categorias.id 
					 ORDER BY total ASC LIMIT 0 , 5;
					");
					while($rp=mysqli_fetch_array($prod)){
						?>
							<tr>
								<td><?=$rp['nombre']?></td>
								<td><?=$rp['total']?></td>
							</tr>
						<?php
					}
				?>
			</table>		
		</div>		
	</div>	
</div>
