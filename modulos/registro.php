<?php
if(isset($_SESSION['id_cliente'])){
	redir("./");
}


    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<?php


if(isset($enviar)){

	$nombre = clear($nombre);
	$apellido = clear($apellido);
	$email = clear($email);
	$password = clear($password);
	$cpassword = clear($cpassword);
	$sexo = clear($sexo);
	$fechaNac= date("Y-m-d", strtotime(clear($fechaNac)));

	$q = $mysqli->query("SELECT * FROM clientes WHERE email = '$email'");

	if(mysqli_num_rows($q)>0){
		alert("El usuario ya está en uso",0,'registro');
		die();
	}

	if($password != $cpassword){
		alert("Las contraseñas no coinciden",0,'registro');
		die();
	}



	$mysqli->query("INSERT INTO clientes (id,nombres,apellidos,email,password,nacimiento,sexo,direccion,inscripcion)

		 VALUES 
		(null, '$nombre','$apellido' ,'$email','$password','$fechaNac','$sexo','en tuc erro', '1999-09-09')");

	$q2 = $mysqli->query("SELECT * FROM clientes WHERE email = '$email'");

	$r = mysqli_fetch_array($q2);

	$_SESSION['id_cliente'] = $r['id'];

	alert("Te has registrado satisfactoriamente",1,'principal');
	redir("./?p=login");
	die();
	//redir("./");

}
	?>

<div class="container">
		<div class="row">
			<div class="col-3"></div>
			<div class="col-7">
		<CENTER><h1 style="color:#0d47a1">REGISTRO</h1> </CENTER>
				<p></br></p>
				<center>
					<form method="post">
    <div class="form-row">
   <div class="col">
   	<label style="font-size: 18px;" for="exampleInputEmail1">Ingrese su Nombre*</label>
    <input type="text" style="font-size: 18px;" class="form-control" name="nombre" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nombre" required>

   </div>
   <div class="col">
   	<label style="font-size: 18px;" for="exampleInputEmail1">Ingrese su Apellido*</label>
    <input type="text" style="font-size: 18px;" class="form-control" name="apellido" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Apellido" required>
   </div>
    
 
  </div>

   


  <div class="form-group">
    <label style="font-size: 18px;" for="exampleInputEmail1">Ingrese su correo electrónico*</label>
    <input type="email" style="font-size: 18px;" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Correo" required>

  </div>


  <div class="form-row">
	<div class="col"> 
		 <label style="font-size: 18px;" for="exampleInputPassword1">Ingrese su contraseña*</label>
    	<input type="password" style="font-size: 18px;" class="form-control" name="password" placeholder="Contraseña" required>
	</div>
	<div class="col">
		 <label style="font-size: 18px;" for="exampleInputPassword1">Repita su contraseña*</label>
   		 <input type="password" style="font-size: 18px;" class="form-control" name="cpassword" placeholder="Contraseña" required>
	</div>  
  </div>

<p></br></p>
<div class="form-row">
	<div class="col">
		<h2 style="font-weight: bold;">Seleccione su sexo</h2>

		<div class="form-check form-check-inline">
 		 <input class="form-check-input" type="radio" name="sexo" id="inlineRadio1" value="option1">
 		 <label class="form-check-label"  style="font-size: 18px; font-weight: lighter;" for="inlineRadio1">Masculino</label>
		</div>

		<div class="form-check form-check-inline">
  			<input class="form-check-input" type="radio" name="sexo" id="inlineRadio2" value="option2">
  			<label class="form-check-label" for="inlineRadio2" style="font-size: 18px;  font-weight: lighter;">Femenino</label>
		</div>
	</div>
	<div class="col">
		 <label style="font-size: 18px;" for="exampleInputPassword1">Fecha de nacimiento</label>
   		 <input type="date" style="font-size: 18px;" class="form-control" name="fechaNac" placeholder="Contraseña">
	</div>
</div>




<p></br></p>

<div>
	
</div>


	<div class="form-group">
					<button class="btn btn-primary" style="font-size: 20px;" name="enviar" type="submit"><i class="fa fa-sign-in"></i> Registrarse</button>
	</div>
					</form>

			</center>
			</div>
			<div class="col-2"> </div>


		</div>
	
	</div>
