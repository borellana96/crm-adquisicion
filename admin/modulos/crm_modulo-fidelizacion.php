<?php
check_admin();
?>

<h1>MODULO DE FIDELIZACIÓN AL CLIENTE</h1>

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">DNI</th>
      <th scope="col">Nombre</th>
      <th scope="col">Correo</th>
      <th scope="col">Fecha de Nacimiento</th>
      <th></th>
      <th scope="col">Detalles</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $clie = $mysqli->query("SELECT * FROM clientes");

        $hoy = getdate();

        while($rp=mysqli_fetch_array($clie)){

            $Id=$rp['id'];
            $Nombres=$rp['nombres'];
            $Apellidos=$rp['apellidos'];
            $email=$rp['email'];
            $Nacimiento=$rp['nacimiento'];
            $partes = explode("-", $Nacimiento);
            $mes=$partes[1];
            $dia=$partes[2];

            ?>
                <tr>
                    <th scope="row"><?= $Id ?></td>
                    <td><?=$Nombres." ".$Apellidos ?></td>
                    <td><?=$Nacimiento?></td>
                    <td><?=$email?></td>		
                    <td>
                        <?php
                        if($hoy["mday"]==$dia && $hoy["mon"]==$mes){
                            echo "<i class='fas fa-birthday-cake'></i>";
                            $cumple=1;
                        }
                        else 
                            $cumple=0;
                        ?>
                    </td>
                    <td><a href="./?p=crm_modulo-fidelizacion-datos&id=<?= $Id ?>&nombre=<?= $Nombres ?>&cumpleaños=<?= $cumple ?>" class="detalles">Detalles</a></td>
                </tr>	
            <?php
        }
    ?>

    
  </tbody>
</table>

