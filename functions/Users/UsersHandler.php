<?php 
include $_SERVER['DOCUMENT_ROOT'].'/prueba/functions/Users/Users.php';



if(isset( $_POST['function'] )) {
	$obj = new Users();
	switch ($_POST['function']) {
	    case "save":
	        $result = $obj->save();
	        break;
	    case "save_user":
	    	$result = $obj->save_user();
	    	break;
	    case 'Get_User_ID':
	    	$result = $obj->Get_User_ID();
	    	break;
	    case 'update_user':
	    	$result = $obj->update_user();
	    	break;
	    case "delete":
	        $result = $obj->delete();
	        break;
	}

    echo $result;
}