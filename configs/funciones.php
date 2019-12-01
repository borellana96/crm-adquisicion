<?php


$host_mysql = "localhost";
$user_mysql = "root";
$pass_mysql = "root";
$db_mysql = "bdihc";
$mysqli = mysqli_connect($host_mysql,$user_mysql,$pass_mysql,$db_mysql);
	

function clear($var){
	htmlspecialchars($var);

	return $var;
}

function check_admin(){
	if(!isset($_SESSION['id'])){
		redir("./");
	}
}

function redir($var){
	?>
	<script>
		window.location="<?=$var?>";
	</script>
	<?php
	die();
}

function alert($txt,$type,$url){

	//"error", "success" and "info".

	if($type==0){
		$t = "error";
	}elseif($type==1){
		$t = "success";
	}elseif($type==2){
		$t = "info";
	}else{
		$t = "info";
	}

	echo '<script>swal({ title: "Alerta", text: "'.$txt.'", icon: "'.$t.'"});';
	echo '$(".swal-button").click(function(){ window.location="?p='.$url.'"; });';
	echo '</script>';
}

function check_user($url){

	if(!isset($_SESSION['id_cliente'])){
		redir("?p=login&return=$url");
	}else{

	}

}

function nombre_cliente($id_cliente){
	$mysqli = connect();

	$q = $mysqli->query("SELECT * FROM clientes WHERE id = '$id_cliente'");
	$r = mysqli_fetch_array($q);
	$nom = $r['nombres'];
	$apel = $r['apellidos'];
	$name = $nom.' '.$apel;
	return $name;
}

function connect(){
	$host_mysql = "localhost";
	$user_mysql = "root";
	$pass_mysql = "root";
	$db_mysql = "bdihc";


 	$mysqli = mysqli_connect($host_mysql,$user_mysql,$pass_mysql,$db_mysql);

	return $mysqli;
}

function fecha($fecha){
	$e = explode("-",$fecha);

	$year = $e[0];
	$month = $e[1];
	$e2 = explode(" ",$e[2]);
	$day = $e2[0];



	return $day."/".$month."/".$year;

}
function fechahora($fecha){
	$e = explode("-",$fecha);

	$year = $e[0];
	$month = $e[1];
	$e2 = explode(" ",$e[2]);
	$day = $e2[0];
	$time = $e2[1];

	$e3 = explode(":",$time);
	$hour = $e3[0];
	$mins = $e3[1];

	return $day."/".$month."/".$year." ".$hour.":".$mins;

}

function estado($id_estado){
		if($id_estado == 0){
			$status = "Sin pagar";
		}elseif($id_estado==1){
			$status = "Preparando";
		}elseif($id_estado == 2){
			$status = "Transito";
		}elseif($id_estado == 3){
			$status = "Despachado";
		}elseif($id_estado == 4){
			$status = "Retenido";
		}else{
			$status = "Indefinido";
		}

		return $status;

}

function admin_name_connected(){
	include "config.php";
	$id = $_SESSION['id'];
	$mysqli = connect();

	$q = $mysqli->query("SELECT * FROM admins WHERE id = '$id'");
	$r = mysqli_fetch_array($q);
	$nom = $r['nombres'];
	$apel = $r['apellidos'];
	$name = $nom.' '.$apel;
	return $name;
}

function dinero_ventas(){
	include "config.php";
	$mysqli = connect();
	$x1 = $mysqli->query("SELECT SUM(monto) as total from pedidos");
	$w1 = mysqli_fetch_array($x1);
	$din = round($w1['total'],2);
	return $din;
}

function num_categorias(){
	include "config.php";
	$mysqli = connect();
	$x2 = $mysqli->query("SELECT COUNT(id) as total from categorias");
	$w2 = mysqli_fetch_array($x2);
	$numcat = $w2['total'];
	return $numcat;
}

function num_productos(){
	include "config.php";
	$mysqli = connect();
	$x3 = $mysqli->query("SELECT COUNT(id) as total from productos");
	$w3 = mysqli_fetch_array($x3);
	$numprod = $w3['total'];
	return $numprod;
}

function num_clientes(){
	include "config.php";
	$mysqli = connect();
	$x4 = $mysqli->query("SELECT COUNT(id) as total from clientes");
	$w4 = mysqli_fetch_array($x4);
	$numclie = $w4['total'];
	return $numclie;
}