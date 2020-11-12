<?php 
include $_SERVER['DOCUMENT_ROOT'].'/prueba/functions/PQR/PQR.php';



if(isset( $_POST['function'] )) {
	$obj = new PQR();
	switch ($_POST['function']) {
	    case "save":
	        $result = $obj->save();
	        break;
	    case "delete":
	        $result = $obj->delete();
	        break;
	    case "get_subject":
	    	$result = $obj->get_subject();
	    	break;
	    case "get_data_update":
	    	$result = $obj->get_data_update();
	    	break;
	    case "update":
	    	$result = $obj->update();
	    	break;
	    case "update_state":
	    	$result = $obj->update_state();
	    	break;
	}

    echo $result;
}