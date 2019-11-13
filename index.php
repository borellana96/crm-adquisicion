<?php
include "configs/config.php";
include "configs/funciones.php";
	
if(!isset($p)){
	$p = "principal";
}else{
	$p = $p;
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="css/estilo.css"/>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
	<link rel="stylesheet" href="fontawesome/css/all.css"/>
	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="fontawesome/js/all.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/app.js"></script>
	<script type="text/javascript" src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
	<title>Tienda Online</title>
</head>
<body>
	<div  class="header" style="background-color:#004c8c; font-size: 25px; padding:10px;" >
		Sistema de ventas Online BuyFISI
		<span align="right" style="font-size: 15px; float: right;"> <a href="admin/">Panel Admin</a> </span>
	</div>
	<div class="menu" style="background-color: #0277bd; padding-left: 30px; border-right: 0 !important; margin-right: 0 !important;padding-right: 0 !important;">
	<div class="container" style="background-color: #0277bd; padding-left: 30px;border-right: 0 !important; margin-right: 0 !important;padding-right: 0 !important;">
		<div class="row" >
			<div class="col-7">
				<ul class="list-inline">
					<li class="list-inline-item">
						<button type="submit" class="btn btn-outline-light" style="font-size: 15px; background-color: #0277bd; padding-right:10px; " onclick="window.location.href='?p=principal'"> PRINCIPAL</button>
					</li>
					<li class="list-inline-item">
						<button type="submit" class="btn btn-success list-inline-item"style=" font-size: 15px; background-color: #0277bd; padding-right:10px;" onclick="window.location.href='?p=productos'">ENCUENTRA TU PRODUCTO!</button>
					</li>
					<li class="list-inline-item">
						<button type="submit" class="btn btn-outline-light list-inline-item"style=" font-size: 15px; padding-right:10px;background-color: #0277bd;" onclick="window.location.href='?p=ofertas'"> OFERTAS</button>
					</li>
					<li class="list-inline-item">
						<button type="submit" class="btn btn-outline-light list-inline-item"style=" font-size: 15px; background-color: #0277bd;" onclick="window.location.href='?p=nosotros'"> NOSOTROS</button>
						
					</li>

				</ul>
				
		
			
				
			</div>
		
			<div class="col-5" style="margin-right: 10;
			padding-right: 	10;">
				<?php 
				if(!isset($_SESSION['id_cliente'])){
				?>
				<ul class="list-inline">
					<li class="list-inline-item">
						<button type="submit"  class="btn btn-outline-light"style=" font-size: 15px; padding-left:10px;background-color: #0277bd;" onclick="window.location.href='?p=login'"> LOGIN</button>

					</li>
					<li class="list-inline-item">
						<button type="submit"  class="btn btn-outline-light"style=" font-size: 15px; padding-left:10px;background-color: #0277bd;" onclick="window.location.href='?p=registro'"> REGISTRARSE</button>

					</li>
					
				
				</ul>
				<?php
					}else{

						?>
				<ul class="list-inline">
					<li class="list-inline-item">
						<button type="submit"  class="btn btn-info"style=" font-size: 15px; padding-left:10px;background-color: #;" onclick="window.location.href='?p=carrito'"> Mi Carrito</button>

					</li>
					<li class="list-inline-item">
						<button type="submit"  class="btn btn-info"style=" font-size: 15px; padding-left:10px;background-color:;" onclick="window.location.href='?p=miscompras'"> Mis Pedidos</button>

					</li>
						<li class="list-inline-item" style="float: right;"> 
							<button type="submit"  class="btn btn-dark" style=" font-size: 15px; padding-left:10px;background-color: #;" onclick="window.location.href='?p=salir'"> Cerrar sesión</button>
						
					</li>	
				
					
				</ul>						
					<?php
						} 
					?>		
			
				


			</div>

			
		</div>
		
		

	</div>
	
	
	</div> <!-- FIN MENU-->

	<div class="cuerpo">
		<?php
			if(file_exists("modulos/".$p.".php")){
				include "modulos/".$p.".php";
			}else{
				echo "<i>No se ha encontrado el modulo <b>".$p."</b> <a href='./'>Regresar</a></i>";
			}
		?>
	</div>

<?php 
	if(isset($_SESSION['id_cliente'])){
		?>
	<div style="background-color: #01579b !important" class="carritot" onclick="minimizer()">
	<p style="font-size: 13px;" > Carrito de compra </p>	
		<input type="hidden" id="minimized" value="0"/>
	</div>

	<?php
			}

	?>

	<div class="carritob" style="font-size: 13px;">

		<table class="table table-striped">
	<tr>
		<th>Nombre del producto</th>
		<th>Cantidad</th>
		<th>Precio </th>
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
			<td><?=$nombre_producto?></td>
			<td><?=$cantidad?></td>
			<td><?=$precio_unidad?> <?=$divisa?></td>
		</tr>
	<?php
}
?>
</table>
<br>
<span>Monto Total: <b class="text-green"><?=$monto_total?> <?=$divisa?></b></span>

<br><br>
<!--
<form method="post" action="?p=carrito">
	<input type="hidden" name="monto_total" value="<?=$monto_total?>"/>
	<button class="btn btn-primary" type="submit" name="finalizar"><i class="fa fa-check"></i> Finalizar Compra</button>
</form>
-->
	</div>



</body>
</html>

<script type="text/javascript">
	
	function minimizer(){

		var minimized = $("#minimized").val();

		if(minimized == 0){
			//mostrar
			$(".carritot").css("bottom","350px");
			$(".carritob").css("bottom","0px");
			$("#minimized").val('1');
		}else{
			//minimizar

			$(".carritot").css("bottom","0px");
			$(".carritob").css("bottom","-350px");
			$("#minimized").val('0');
		}
	}
</script>