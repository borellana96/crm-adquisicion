<?php
check_admin();

if(isset($enviar)){
	$nombre = clear($nombre);

	$s = $mysqli->query("SELECT * FROM categorias WHERE nombre = '$nombre'");

	if(mysqli_num_rows($s)>0){
		alert("Ya esta categoria esta agregada a la base de datos",0,'agregar_categoria');
		redir("");
	}else{
		$mysqli->query("INSERT INTO categorias (nombre) VALUES ('$nombre')");
		alert("Categoria Agregada",1,'agregar_categoria');
		redir("");
	}

}

if(isset($eliminar)){
	$eliminar = clear($eliminar);
	$mysqli->query("DELETE FROM categorias WHERE id = '$eliminar'");
	alert("Categoria eliminada",2,'agregar_categoria');
}

?>

<h1>Agregar Categoria</h1><br><br>

<form method="post" action="">
	<div class="form-group">
		<input type="text" class="form-control" name="nombre" placeholder="Nombre"/>
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
					<a style="color:#08f" href="?p=modificar_categoria&id=<?=$r['id']?>"><i class="fa fa-edit"></i></a>
					&nbsp;
					<a  style="color:#08f" href="?p=agregar_categoria&eliminar=<?=$r['id']?>"><i class="fa fa-times"></i></a>
				</td>
			</tr>
		<?php
	}
	?>
</table>