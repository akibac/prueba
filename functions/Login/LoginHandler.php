<?php 
include $_SERVER['DOCUMENT_ROOT'].'/prueba/functions/Login/Login.php';



if(isset( $_POST['function'] )) {
	$obj = new Login();
	switch ($_POST['function']) {
	    case "login":
	        $result = $obj->login();
	        break;
	    case "delete":
	        $result = $obj->delete();
	        break;
	    case "login_close":
	    	$result = $obj->login_close();
	        break;
	    case "save_user":
	    	$result = $obj->save_user();
	    	break;
	}

    echo $result;
}