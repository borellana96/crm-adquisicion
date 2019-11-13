<?php
check_admin();

$id = clear($id);

$q = $mysqli->query("SELECT * FROM categorias WHERE id = '$id'");
$rq = mysqli_fetch_array($q);

if(isset($enviar)){
	$nombre = clear($nombre);	
	$mysqli->query("UPDATE categorias SET nombre = '$nombre' WHERE id = '$id'");
	redir("?p=agregar_categoria");

}

?>
<form method="post" action="" enctype="multipart/form-data">
	<div class="form-group">
		<input type="text" class="form-control" name="nombre" value="<?=$rq['nombre']?>" placeholder="Nombre de la Categoria"/>
	</div>

	<div class="form-group">
		<button type="submit" class="btn btn-success" name="enviar"><i class="fa fa-check"></i> Modificar Categoria</button>
	</div>


<input type="hidden" name="idpro" value="<?=$id?>"/>

</form>