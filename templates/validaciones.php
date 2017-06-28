<?php 
##########################################

function check_email_address($email) {
    // First, we check that there's one @ symbol, and that the lengths are right
    if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
        // Email invalid because wrong number of characters in one section, or wrong number of @ symbols.
        return false;
    }
    // Split it into sections to make life easier
    $email_array = explode("@", $email);
    $local_array = explode(".", $email_array[0]);
    for ($i = 0; $i < sizeof($local_array); $i++) {
         if (!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
            return false;
        }
    }    
    if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) { // Check if domain is IP. If not, it should be valid domain name
        $domain_array = explode(".", $email_array[1]);
        if (sizeof($domain_array) < 2) {
                return false; // Not enough parts to domain
        }
        for ($i = 0; $i < sizeof($domain_array); $i++) {
            if (!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$", $domain_array[$i])) {
                return false;
            }
        }
    }
    return true;
}

function trim_data($formdata) {
	// Trim any leading or trailing spaces
	// $formdata = Form Data Array
	foreach($formdata as $key => $value)
	{
		$key = trim($key);
		$value = trim($value);
	}
	return $formdata;
}

function check_form($formdata){
	// Check all fields are filled in
	// $formdata = Form Data Array
	foreach ($formdata as $key => $value) 
	{
		if (!isset($key) || $value == "" )
			return false;
	}
	return true;
}

function check_password_length($formdata, $password, $minlen) {
	// Check that password is required length
	// $formdata = Form Data Array
	// $password = Name of password field
	// $minlen = Minimum number of password characters
	if (strlen($formdata[$password]) < $minlen)
		return false;
	else
		return true;
}


function check_length($formdata, $word, $minlen) {
	// Check that password is required length
	// $formdata = Form Data Array
	// $password = Name of password field
	// $minlen = Minimum number of password characters
	if (strlen($formdata[$word]) < $minlen || strlen($formdata[$word]) > $minlen )
		return false;
	else
		return true;
}

function confirm_password($formdata, $password1, $password2) {
	// Check that two passwords given match
	// $formdata = Form Data Array
	// $password1 = Name of first password field
	// $password2 = Name of second password field
	
	if ($formdata[$password1] === $formdata[$password2]) 
		return true; 
	else 
		return false; 
}

function check_unique($formvalue, $db, $dbhost, $dbuser, $dbpassword, $table, $field) {
	// Checks a table in a database, so see if passed value already exists
	// $formvalue = Value you are checking to see if it is unique or not
	// $db = mySQL Database Name
	// $dbhost = mySQL Server address eg localhost
	// $dbuser = mySQL user name
	// $dbpassword = mySQL password
	// $table = mySQL Table to search
	// $field = mySQL Field to search
	
	$error = "";
	// Connect to the mySQL Server
	$mysql = mysql_connect($dbhost, $dbuser, $dbpassword);  
	if(!$mysql) 
	{
		$error = "No hay conexion con el servidor de base de datos";
		return($error);
	}
	// Open the mySQL Database
	$mysqldb = mysql_select_db($db);
		if(!$mysqldb) 
	{
		$error = "No se abrio la base de datos";
		return($error);
	}
	// Query Table to see if $formvalue is unique
	$myquery = "SELECT * FROM $table WHERE $field = '$formvalue'";
	$result = mysql_query($myquery);
	if (!$result)
		{
		$error = "No se ejecuto el query";
		return($error);
	}
	// Get number of Records found, should be 0 if $formvalue is unique
	$unique = mysql_num_rows($result);
	return($unique);
}

function check_unique_rfc($formvalue, $db, $dbhost, $dbuser, $dbpassword, $table, $field) {
	// Checks a table in a database, so see if passed value already exists
	// $formvalue = Value you are checking to see if it is unique or not
	// $db = mySQL Database Name
	// $dbhost = mySQL Server address eg localhost
	// $dbuser = mySQL user name
	// $dbpassword = mySQL password
	// $table = mySQL Table to search
	// $field = mySQL Field to search
	
	$error = "";
	// Connect to the mySQL Server
	$mysql = mysql_connect($dbhost, $dbuser, $dbpassword);  
	if(!$mysql) 
	{
		$error = "No hay conexion con el servidor de base de datos";
		return($error);
	}
	// Open the mySQL Database
	$mysqldb = mysql_select_db($db);
		if(!$mysqldb) 
	{
		$error = "No se abrio la base de datos";
		return($error);
	}
	// Query Table to see if $formvalue is unique
	$myquery = "SELECT * FROM $table WHERE $field = '$formvalue'";
	$result = mysql_query($myquery);
	if (!$result)
		{
		$error = "No se ejecuto el query";
		return($error);
	}
	// Get number of Records found, should be 0 if $formvalue is unique
	$unique = mysql_num_rows($result);
	
	if ($unique > 0)
	{
		$error = "El RFC \"". $formvalue. "\" esta en uso";
		return($error);
	}
	// Return true if $formvalue is unique
	return("true");
}

function ejecutar_query($query) {
	// Delete Data from table
	// $query = query a ejecutar
	
	// setup database connection variables, insert as correct for your server
	include("include/conexion.php");
		
	// connect to mySQL server	
	$mysql = mysql_connect($dbhost, $dbuser, $dbpassword);
	if (!$mysql) {
		$error = "No hay conexión con el servidor de Base de Datos";
		return($error);
		}
	// Connect to Database	
	$mysqldb = mysql_select_db($db, $mysql);
	if (!$mysqldb) {
		$error = "No se abrio la Base de Datos";
		return($error);
		}
	// Insert Data	
	$myquery = $query;
	$result = mysql_query($myquery, $mysql);
	
	if (!$result) {
		$error = "No se ejecuto el query ". $myquery;
		return $error;
		}
	// Return True if record written successfully	
	return("true");	
}

function ejecutar_query_id($query) {
	// Delete Data from table
	// $query = query a ejecutar
	
	// setup database connection variables, insert as correct for your server
	include("include/conexion.php");
		
	// connect to mySQL server	
	$mysql = mysql_connect($dbhost, $dbuser, $dbpassword);
	if (!$mysql) {
		$error = "No hay conexión con el servidor de Base de Datos";
		return($error);
		}
	// Connect to Database	
	$mysqldb = mysql_select_db($db, $mysql);
	if (!$mysqldb) {
		$error = "No se abrio la Base de Datos";
		return($error);
		}
	// Insert Data	
	$myquery = $query;
	$result = mysql_query($myquery, $mysql);
	
	if (!$result) {
		$error = "No se ejecuto el query ". $myquery;
		return $error;
		}
		
	// Return ID	
	return (mysql_insert_id());
}



function ejecutar_query_no_filas($query) {
	// Delete Data from table
	// $query = query a ejecutar
	
	// setup database connection variables, insert as correct for your server
	include("include/conexion.php");
		
	// connect to mySQL server	
	$mysql = mysql_connect($dbhost, $dbuser, $dbpassword);
	if (!$mysql) {
		$error = "No hay conexión con el servidor de Base de Datos";
		return($error);
		}
	// Connect to Database	
	$mysqldb = mysql_select_db($db, $mysql);
	if (!$mysqldb) {
		$error = "No se abrio la Base de Datos";
		return($error);
		}
	// Insert Data	
	$myquery = $query;
	$result = mysql_query($myquery, $mysql);
	
	if (!$result) {
		$error = "No se ejecuto el query ". $myquery;
		return $error;
		}
	// Return True if record written successfully	
	return(mysql_num_rows($result));	
}
?>
