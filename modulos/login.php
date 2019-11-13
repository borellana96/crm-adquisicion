<?php
if(isset($_SESSION['id_cliente'])){
	redir("./");
}
	
if(isset($enviar)){
	$email = clear($email);
	$password = clear($password);

	$q = $mysqli->query("SELECT * FROM clientes WHERE email = '$email' AND password = '$password'");

	if(mysqli_num_rows($q)>0){
		$r = mysqli_fetch_array($q);
		$_SESSION['id_cliente'] = $r['id'];
		if(isset($return)){
			redir("?p=".$return);
		}else{
			redir("./");
		}
	}else{
		alert("Los datos no son validos",0,'login');
		//redir("?p=login");
	}


}
	?>

	<div class="container">
		<div class="row">
			<div class="col-3"></div>
			<div class="col-7">
				<p></br></p>
				<p></br></p>
				<p></br></p>
				<center>
					<form method="post">
  <div class="form-group">
    <label style="font-size: 22px;color: #0d47a1" for="exampleInputEmail1">Ingrese su correo electrónico</label>
    <input type="email" style="font-size: 20px;" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese su correo" required> 
    <small id="emailHelp" class="form-text text-muted">No compartiremos su correo con nadie más.</small>
  </div>
  <div class="form-group">
    <label style="font-size: 22px;color: #0d47a1" for="exampleInputPassword1">Ingrese su contraseña</label>
    <input type="password" style="font-size: 20px;" class="form-control" name="password" placeholder="Contraseña" required>
  </div>
	<div class="form-group">
					<button class="btn btn-primary" style="font-size: 20px;" name="enviar" type="submit"><i class="fa fa-sign-in"></i> Ingresar</button>
					<p><a href="recuperarContra.php">¿Se olvidó la contraseña?</a> </p>
	</div>
					</form>

			</center>
			</div>
			<div class="col-2"> </div>


		</div>
	
	</div>



	