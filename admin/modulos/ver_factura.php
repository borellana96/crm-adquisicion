<?php
$id = clear($id);

$s = $mysqli->query("SELECT p.direccion as direccion, p.fecha as fecha, p.monto as monto,p.id_cliente as id_cliente,f.numtarjeta as numtarjeta FROM pedidos p INNER JOIN facturas f ON p.id=f.id_pedido WHERE f.id='$id';");
while($r=mysqli_fetch_array($s)){
?>

<h1>Factura de <span style="color:#08f"><?=nombre_cliente($r['id_cliente'])?></span></h1><br>

Fecha: <?=$r['fecha']?><br>
Tarjeta: <?=$r['numtarjeta']?><br>
Monto: <?=$divisa?><?=$r['monto']?> <br>
Direccion: <?=$r['direccion']?><br>
<br>
<?php
}
?>