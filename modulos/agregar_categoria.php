<?php
check_admin();

if(isset($enviar)){
	$categoria = clear($categoria);

	$s = $mysqli->query("SELECT * FROM categorias WHERE nombre = '$categoria'");

	if(mysqli_num_rows($s)>0){
		alert("Ya esta categoria esta agregada a la base de datos",0,'agregar_categoria');
	}

}

if(isset($eliminar)){
	$eliminar = clear($eliminar);
	$mysqli->query("DELETE FROM categorias WHERE id = '$eliminar'");
	alert("Categoria eliminada");
	redir("?p=agregar_categoria");
}

?>

<h1>Agregar Categoria</h1>

<form method="post" action="">
	<div class="form-group">
		<input type="text" class="form-control" name="categoria" placeholder="Categoria"/>
	</div>

	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="enviar" value="Agregar categoria"/>
	</div>
</form><br>

<br>

<table class="table table-striped">
	<tr>
		<th>ID</th>
		<th>Categoria</th>
		<th>Acciones</th>
	</tr>

	<?php
	$q = $mysqli->query("SELECT * FROM categorias ORDER BY nombre ASC");
	while($r=mysqli_fetch_array($q)){
		?>
			<tr>
				<td><?=$r['id']?></td>
				<td><?=$r['nombre']?>
				<td>
					<a href="?p=agregar_categoria&eliminar=<?=$r['id']?>"><i class="fa fa-times"></i></a>
				</td>
			</tr>
		<?php
	}
	?>
</table>