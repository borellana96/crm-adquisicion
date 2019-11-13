<?php

include "../configs/funciones.php";

	//print_r($_POST);
	if (!empty($_POST)) {
		$mysqli = connect();
		$nameProducto =	$_POST['producto'];
		$query = $mysqli->query("SELECT * FROM productos WHERE name = '$nameProducto'");
		
			if (mysqli_num_rows($query)>0) {
				$data = mysqli_fetch_assoc($query);
				echo json_encode($data,JSON_UNESCAPED_UNICODE);
				# code...
				exit;
			}
			echo "error";
			exit;
		}
	

	

	
	


 ?>