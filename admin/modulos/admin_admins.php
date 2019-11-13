<?php
check_admin();

if(isset($eliminar)){
	$mysqli->query("DELETE FROM admins WHERE id = '$eliminar'");
	redir("?p=admin_administradores");
}

?>

<h1>Admins</h1><br><br>

<table class="table table-striped">
	<tr>
		<th>Nombres</th>
		<th>Apellidos</th>
		<th>Email</th>
		<th>Ultimo Login</th>
        <th>Acciones</th>
	</tr>

	<?php
		$clie = $mysqli->query("SELECT * FROM admins");
		while($rp=mysqli_fetch_array($clie)){
			?>
				<tr>
					<td><?=$Nombres=$rp['nombres']?></td>
					<td><?=$Apellidos=$rp['apellidos']?></td>
					<td><?=$Sexo=
				//$rp['sexo']
				"M"?></td>
					<td><?=$Ultimo=$rp['ultimo']?></td>
					<td>
						<a style="color:#08f" href="?p=admin_admins&eliminar=<?=$rp['id']?>"><i class="fa fa-times"></i></a>
					</td>			
				</tr>	
			<?php
		}
	?>

</table>