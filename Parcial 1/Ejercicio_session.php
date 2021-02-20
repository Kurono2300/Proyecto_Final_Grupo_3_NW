<?php
	session_start();
	if(isset($_POST["submit"]) && !empty($_POST["submit"])) {
		$correo = $_POST["correo"];
		$_SESSION['correo'] = isset($_POST['correo']) ? $_POST['correo'] : null;
	}
?>
<html>
	<head>
	</head>
	<body>
		<form method="POST">
			<input type="text" name="correo">
			<br>
			<input type="submit" name="submit" value="Enviar Correo">
		</form>


		<?php
		if(isset($_SESSION['correo'])){
			echo "<b>".$_SESSION['correo']."</b>";
		}
		?>
	</body>
</html>