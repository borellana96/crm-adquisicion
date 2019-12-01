<?php 
$ID = $_GET['id'];
$Nombre= $_GET['nombre'];
$cumple= $_GET['cumpleaños'];
?>
<h1>Compras de <?php echo $Nombre ?></h1>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Producto</th>
      <th scope="col">Categoría</th>
      <th scope="col">Precio</th>
      <th scope="col">Cantidad</th>
      <th scope="col">Precio Total</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $clie = $mysqli->query("select p.name,p.descripcion,p.price,cd.cantidad from productos as p inner join compra_detalle as cd on p.id=cd.id_producto inner join pedidos as pe on pe.id_cliente=".$ID." and cd.id_pedido=pe.id");
        $total=0;
        while($rp=mysqli_fetch_array($clie)){ 

            $nombre=$rp['name'];
            $descripcion=$rp['descripcion'];
            $precio=$rp['price'];
            $cantidad=$rp['cantidad'];

            ?>
                <tr>
                    <th><?= $nombre ?></td>
                    <td><?=$descripcion?></td>
                    <td><?=$precio?></td>
                    <td><?=$cantidad?></td>		
                    <td><?=$precio*$cantidad?></td>
                </tr>	
            <?php
            $total=$total+$precio*$cantidad;
        }
    ?>

    
  </tbody>
</table>
<div class="derecha"><h2>Valor Total de su compra: <?= $total ?> soles</h2></div>
<div style="clear:both"></div>
<br>
<?php  if($cumple){ ?>
    <div class="container">
        <div><?= $Nombre ?> esta de cumpleaños <i class='fas fa-birthday-cake'></i> </div>
        <br>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent turpis leo, faucibus nec molestie nec, pretium id nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla tincidunt luctus mollis. Nulla bibendum sollicitudin commodo. Cras a varius est, tempus laoreet ligula. In condimentum tellus id erat vehicula placerat in at dolor. Integer ultricies consequat arcu id scelerisque. Etiam metus justo, sagittis id urna a, faucibus congue dui. Duis ultricies, dui a posuere placerat, lectus dui iaculis tortor, et hendrerit sem velit at metus. Suspendisse sit amet est vel leo placerat ornare a in metus. Aenean laoreet iaculis risus a iaculis. Ut in pulvinar dolor, in elementum tellus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce sed egestas ipsum. Nulla quis erat metus.</p>
        <div class="izquierda">
            <div> Descuento (%): <input type="number" min=0 max=100> </div>
            <div>*Seleccionar productos donde se aplicaran los descuentos</div>
        </div>
        <div class="derecha">
        <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
        Enviar tarjeta de cumpleaños
        </button>
        </div>
    </div>
    <br>
    <br>
    <br>
<?php } ?>
    <div class="container">
        <div class="izquierda">
            <div> Descuento (%): <input type="number" min=0 max=100> </div>
            <div>*Seleccionar productos donde se aplicaran los descuentos</div>
        </div>
        <div style="clear:both"></div>
        <br>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent turpis leo, faucibus nec molestie nec, pretium id nibh. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla tincidunt luctus mollis. Nulla bibendum sollicitudin commodo. Cras a varius est, tempus laoreet ligula. In condimentum tellus id erat vehicula placerat in at dolor. Integer ultricies consequat arcu id scelerisque. Etiam metus justo, sagittis id urna a, faucibus congue dui. Duis ultricies, dui a posuere placerat, lectus dui iaculis tortor, et hendrerit sem velit at metus. Suspendisse sit amet est vel leo placerat ornare a in metus. Aenean laoreet iaculis risus a iaculis. Ut in pulvinar dolor, in elementum tellus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce sed egestas ipsum. Nulla quis erat metus.</p>
        <div class="derecha">
        <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off">
        Enviar correo
        </button>
        </div>
    </div>

    
