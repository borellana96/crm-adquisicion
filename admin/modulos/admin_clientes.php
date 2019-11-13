<?php
check_admin();

?>

<h1>Clientes</h1><br><br>

<table class="table table-striped">
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