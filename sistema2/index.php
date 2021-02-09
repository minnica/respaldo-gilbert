<?php	
	require "conexion.php";	
	session_start();	
	if($_POST){		
		$usuario = $_POST['usuario'];
		$password = $_POST['password'];		
		$sql = "SELECT id, password, nombres, tipo FROM usuarios WHERE usuario='$usuario'";
		$resultado = $mysqli->query($sql);
		$num = $resultado->num_rows;		
		if($num>0){
			$row = $resultado->fetch_assoc();
			$password_bd = $row['password'];
			if($password_bd == $password){				
				$_SESSION['id'] = $row['id'];
				$_SESSION['nombres'] = $row['nombres'];
				$_SESSION['tipo'] = $row['tipo'];				
				header("Location: areas.php");				
			} else {			
				echo '<div style="width:100%; height:30px; margin:0 auto; text-align:center; 
				background-color:#e74f4f; border:0px solid #063;"><div style="color:white; 
				margin-top:-8px; font-size:20px; font-family:Century Gothic;">La contraseña no coincide</div></div>';			
			}
			
			} else {
				echo '<div style="width:100%; height:30px; margin:0 auto; text-align:center;
				background-color:#e74f4f; border:0px solid #063;"><div style="color:white; 
				margin-top:-8px; font-size:20px; font-family:Century Gothic;">El usuario es incorrecto</div></div>';
		}			
	}	
?>

<!DOCTYPE html>
<html lang="es">
<head><meta charset="euc-jp">
    
	<link href="main_app/Admin/assets/img/ico.png" rel="icon">
	<title>Iniciar sesion</title>
	<link rel="shortcut icon" href="./assets/logo.ico"> 
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="loginbox">
		<img src="avatar.png" class="avatar">
		<h1>Iniciar sesion</h1>
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<label class="small mb-1" for="inputEmailAddress">Usuario</label>
			<input class="form-control py-4" id="inputEmailAddress" name="usuario" type="text" placeholder="Ingresa tu usuario" required/>
			<label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Ingresa contraseña" required/>

			<div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
				<input type="submit" class="botonlg"  value="Iniciar" >
			</div>
		</form>
	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
	<script src="js/scripts.js"></script>
</body>
</html>
