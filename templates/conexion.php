<?php
//conexion con mysql, solo si esta lleno el formulario.
if (isset($_POST["area"]) && isset($_POST["ticket"])){
	$conexion = mysqli_connect("localhost", "root", "", "SCAWEB");
		if (mysqli_connect_errno($conexion)) {
			echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
		}
		// En caso que la conexion sea exitosa, se mete al programa
		else{
			$ticket = mysqli_real_escape_string ($conexion, $_POST["ticket"]);
			$fecha = mysqli_real_escape_string ($conexion, $_POST["fecha"]); 
			$area = mysqli_real_escape_string ($conexion, $_POST["area"]);
			$actividad = mysqli_real_escape_string ($conexion, $_POST["actividad"]);
			$descripcion = mysqli_real_escape_string ($conexion, $_POST["descripcion"]);
		    $existe = mysqli_query($conexion,"SELECT * FROM usuarios WHERE ticket ='".$ticket."'");
				 if( mysqli_num_rows($existe) == 0){
							$registro = mysqli_query($conexion, "INSERT INTO usuarios(ticket,fecba,area,asunto,actividad) VALUES('".$ticket."','".$fecha."','".$area."','".$actividad."','".$descripcion."');");
							}		
				else{
							echo "<script>";
							echo "alert('El numero de ticket ha sido registrado anteriormente');";  
							echo "window.location = 'main.html';";
							echo "</script>";
							}
		}	
	mysqli_close($conexion);
	echo "<script>";
	echo "alert('El numero de ticket ha sido registrado con exito');";  
	echo "window.location = 'main.html';";
	echo "</script>";
}
//print_r($_POST["fecha"]);		
?>
 
