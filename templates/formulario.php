<?php 
include("include/conexion.php");
include("include/validaciones.php");
/***VARIABLES POR GET ***/
$numero = count($_GET);
$tags = array_keys($_GET);// obtiene los nombres de las varibles
$valores = array_values($_GET);// obtiene los valores de las varibles
// crea las variables y les asigna el valor
for($i=0;$i<$numero;$i++){
$$tags[$i]=$valores[$i];
}
/***VARIABLES POR POST ***/
$numero2 = count($_POST);
$tags2 = array_keys($_POST); // obtiene los nombres de las varibles
$valores2 = array_values($_POST);// obtiene los valores de las varibles
// crea las variables y les asigna el valor
for($i=0;$i<$numero2;$i++){ 
$arreglo=array("?",";","<",">","(",")","$","sql","\"","'","\\","[","]","{","}","phpinfo");
$valores2[$i]= str_replace($arreglo," ",$valores2[$i]); 
$$tags2[$i]=$valores2[$i];
}
if($accion == 'Enviar')
	{
	$error = '';	
	//INICIAMOS CON LA VALIDACIONES DE DATOS OBLIGATORIOS
	if($apaterno == '')
		$error = $error . '*El apellido paterno es un dato obligatorio.<br>';
	if($nombre == '')
		$error = $error . '*El nombre es un dato obligatorio.<br>';
	if($telefono == '')
		$error = $error . '*El Telefono es un dato obligatorio.<br>';
	if($correo == '')
		$error = $error . '*El correo es un dato obligatorio.<br>';	
	if($dependencia == '')
		$error = $error . '*La dependencia es un dato obligatorio.<br>';
	
	//VALIDAMOS DATOS CORRECTOS PARA INISERTAR REGISTRO
	if($error == '')
		{
		$insertar_registro = "INSERT INTO REGISTROS1 (APATERNO,AMATERNO,NOMBRE,TELEFONO,CELULAR,CORREO,DEPENDENCIA,CARGO) VALUES ('".$apaterno."','".$amaterno."','".$nombre."','".$telefono."','".$celular."','".$correo."','".$dependencia."','".$cargo."')";
		$registro = insertar_registro($insertar_registro);
		if( is_numeric($registro))
			{
			// Registro Exitoso
			$insertado = 'si';
			$mensaje = "
						<html>
						<head>
						  <title>Registro Satisfactorio</title>
						</head>
						<body>
						  <p>REGISTRO SE HA REALIZADO SATISFACTORIAMENTE ".$registro."</p>
						  <table>
						    <tr>
							  <td>Sus datos fueron registrados correctamente.</td>
							</tr>
						  </table>
						</body>
						</html>";
			}
		}
	}
	
if($accion == 'Borrar')
	{
	$apaterno = '';
	$amaterno = '';
	$nombre = '';
	$telefono = '';
	$celular = '';
	$correo = '';
	$dependencia = '';
	$cargo = '';
	}		
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Foro Conciliación de la vida familiar y laboral</title>
<script languaje="javascript"> 
    function todoMay(txt) { 
    var key = window.event.keyCode; 
    if (key == 225 || key == 233 || key == 237 || key == 241 || key == 243 || key == 250 || (key >= 65 && key <= 90)) { 
        eval(txt + ".value = " + txt + ".value.toUpperCase()"); 
    } 
} 
</script>

<!--<link href="css/styles_diputados.css" rel="stylesheet" type="text/css" />-->
<style type="text/css">
<link rel="stylesheet" type="text/css" href="css/estilos.css">
<!--
body {
	margin-top: 0px;
}
-->
</style></head>
<body>
<form name="registro" method="post">
  <table width="639" height="254" border="0" align="center" bgcolor="#eff0ee">
    <tr>
      <td colspan="2" class="TitulosVerde"><img src="images/header.png" width="640" height="106" /></td>
    </tr>
    <tr>
      <td  class="TitulosVerde" colspan="2"><?php echo $error;?>&nbsp;</td>
    </tr>
    <?php if($insertado != 'si') { ?>
    <tr>
      <td  class="TitulosVerde" colspan="2">SISTEMA DE CAPTURA DE ACTIVIDADES</td>
    </tr>
    <tr>
      <td  class="TitulosVerde" colspan="2"><p>Herramientas WEB</p></td>
    </tr>
    <tr>
      <td colspan="2"  class="smallNegra">Los campos con * son obligatorios</td>
    </tr>
    <tr>
      <td  class="TitulosVerde" colspan="2">Datos Personales</td>
    </tr>
    <tr>
      <td width="315"  class="smallNegra">Apellido Paterno(*):</td>
      <td width="337"  class="smallNegra">Apellido Materno:</td>
    </tr>
    <tr>
      <td  class="smallNegra"><input name="apaterno" type="text" class="smallNegra" onKeyUp="javascript:todoMay('registro.apaterno')" size="50" value="<?php echo $apaterno;?>"></td>
      <td  class="smallNegra"><input name="amaterno" type="text" class="smallNegra" onKeyUp="javascript:todoMay('registro.amaterno')" size="50" value="<?php echo $amaterno;?>"></td>
    </tr>
    <tr>
      <td colspan="2"  class="smallNegra">Nombre(*) :</td>
    </tr>
    <tr>
      <td colspan="2"  class="smallNegra"><input name="nombre" class="smallNegra" onKeyUp="javascript:todoMay('registro.nombre')" size="104" input="text" value="<?php echo $nombre;?>"></td>
    </tr>
    <tr>
      <td class="smallNegra">Telefono Particular u Oficina (*):</td>
	  <td class="smallNegra">Telefono Celular:</td>
    </tr>
	 <tr>
      <td class="smallNegra"><input name="telefono" type="text" class="smallNegra" id="telefono" size="50" value="<?php echo $telefono;?>"/></td>
	  <td class="smallNegra"><input name="celular" type="text" class="smallNegra" id="celular" size="50" value="<?php echo $celular;?>"/></td>
    </tr>
    <tr>
      <td colspan="2"  class="smallNegra">Correo Electr&oacute;nico(*):</td>
    </tr>
    <tr>
      <td colspan="2"  class="smallNegra"><input name="correo" type="text" class="smallNegra" id="correo" size="100" value="<?php echo $correo;?>"/></td>
    </tr>
    <tr>
      <td colspan="2"  class="smallNegra"><span class="TitulosVerde">Datos Laborales </span></td>
    </tr>
    <tr>
      <td colspan="2"  class="smallNegra">Organizaci&oacute;n o Dependencia(*):</td>
    </tr>
    <tr>
      <td colspan="2"  class="smallNegra"><input name="dependencia" type="text" class="smallNegra" onKeyUp="javascript:todoMay('registro.dependencia')" size="100" value="<?php echo $dependencia;?>"/></td>
    </tr>
    <tr>
      <td colspan="2"  class="smallNegra">Cargo:</td>
    </tr>
    <tr>
      <td colspan="2"  class="smallNegra"><input name="cargo" type="text" class="smallNegra" onKeyUp="javascript:todoMay('registro.cargo')" size="100" value="<?php echo $cargo;?>"/></td>
    </tr>
    <tr>
      <td height="20" colspan="2"  class="smallNegra">&nbsp;</td>
    </tr>
    <tr>
      <td class="smallNegra" ><input type="submit" name="enviar" id="Enviar" value="Enviar" /></td>
      <td  class="smallNegra"><input type="submit" name="borrar" id="Borrar" value="Borrar" /></td>
    </tr>
    <tr>
      <td  class="TitulosVerde" colspan="2">&nbsp;</td>
    </tr>
    <?php } else { ?>
    <tr>
      <td  class="TitulosVerde" colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td  class="TitulosVerde" colspan="2">FORO CONCILIACI&Oacute;N DE LA VIDA LABORAL Y FAMILIAR</td>
    </tr>
    <tr>
      <td colspan="2"  class="smallNegra">REGISTRO EXITOSO</td>
    </tr>
	<tr>
     <td colspan="2" class="TitulosVerde">Estos son los datos que fueron registrados Registrados</td>
	</tr>
	<tr>
	  <td colspan="2" class="textoVerdeBold">&nbsp;</td>
    </tr>
	<tr>
	  <td width="315" class="textoNegroBold">Numero de Registro</td>
	  <td width="337" class="textoNegroBold"><?php echo $registro;?></td>
	</tr>
	<tr>
	  <td class="textoNegroBold" width="315">Nombre</td>
	  <td width="337" class="textoNegroBold"><?php echo "".$nombre." ".$apaterno." ".$amaterno;?></td>
	</tr>
	<tr>
	  <td width="315" class="textoNegroBold">Organizaci&oacute;n o Dependencia</td>
	  <td width="337" class="textoNegroBold"><?php echo $dependencia;?></td>
	</tr>
	<tr>
	  <td class="textoNegroBold" width="315">Tel&eacute;fono</td>
	  <td width="337" class="textoNegroBold"><?php echo $telefono ?></td>
	</tr>
	<tr>
	  <td class="textoNegroBold" width="315">Correo Electr&oacute;nico</td>
	  <td width="337" class="textoNegroBold"><?php echo $correo ?></td>
      
	</tr>
	<tr>
	  <td colspan="2" class="textoVerdeBold"></td>
	</tr>
	
	<tr>
	  <td class="textoNegroBold" align="left"><input type="submit" name='boton' value='Imprimir' onclick='window.print();' class="smallNegra"></td>
	  <td class="textoNegroBold" align="left"><INPUT onclick=window.close(); type=button value="Cerrar Ventana" class="smallNegra"></td>
	</tr>
	
	<tr>
	  <td colspan="2" class="textoNegroBold">&nbsp;</td>
	</tr>
	<tr>
	  <td colspan="2" class="textoVerdeBold">&nbsp;</td>
    </tr>
	<tr>
	  <td colspan="2" class="TitulosVerde">Imprima su ficha, se le solicitar&aacute; para confirmar la asistencia al Foro</td>
	</tr>
	<tr>
	  <td colspan="2" class="textoVerdeBold">&nbsp;</td>
	</tr>
	<?php } ?>
    <tr>
      <td height="20" colspan="2" class="smallNegra" ><span class="TitulosVerde"><img src="images/footer.png" width="640" height="141" /></span></td>
    </tr>
  </table>
</form>
</body>
</html>

