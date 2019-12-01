<?php
check_admin();

$id = clear($id);

$s = $mysqli->query("SELECT * FROM pedidos WHERE id = '$id'");
$r = mysqli_fetch_array($s);

?>
<h1>Detalles Cliente X</h1><br>


