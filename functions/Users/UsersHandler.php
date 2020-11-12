<?php 
include $_SERVER['DOCUMENT_ROOT'].'/prueba/functions/Users/Users.php';



if(isset( $_POST['function'] )) {
	$obj = new Users();
	switch ($_POST['function']) {
	    case "save":
	        $result = $obj->save();
	        break;
	    case "delete":
	        $result = $obj->delete();
	        break;
	}

    echo $result;
}