<?php
check_admin();

?>

	<h1>Modulo CRM CLientes</h1><br><br>
	<h2>Aquí estará una lista con los clientes que más han gastado en la empresa.</h2> 	
	<h2>Lista de los que gastaron menos.</h2>
	<h2>Cada cliente tendrá su Detalle
	información básica, productos preferidos en torta y últimas compras</h2>

<br/>
<table class="table table-hover">
	<tr>
		<th>Nombres</th>
		<th>Apellidos</th>
		<th>Fecha de Nacimiento</th>
		<th>Email</th>
		<th>Sexo</th>
    <th>Direccion</th>
    <th>Fecha de Inscripción</th>
	</tr>

	<?php
		$clie = $mysqli->query("SELECT * FROM clientes");
		while($rp=mysqli_fetch_array($clie)){
			?>
				<tr>
					<td><?=$Nombres=$rp['nombres']?></td>
					<td><?=$Apellidos=$rp['apellidos']?></td>
					<td><?=$Nacimiento=$rp['nacimiento']?></td>
					<td><?=$Nacimiento=$rp['email']?></td>
					<td><?=$Sexo=$rp['sexo']?></td>
					<td><?=$Dirección=$rp['direccion']?></td>
					<td><?=$Inscripción=$rp['inscripcion']?></td>			
				</tr>	
			<?php
		}
	?>

</table>