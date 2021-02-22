<?php
require $_SERVER['DOCUMENT_ROOT'].'/prueba/conection/conection.php';
class PQR extends Conection{

	public $mysqli;

	function __construct(){
		$this->mysqli = $this->connectFT();
	}

	Function Get_PQR(){
		$sql = "SELECT * FROM users_pqr p INNER JOIN users u ON u.id_user = p.id_user INNER JOIN type_pqr t ON t.id_type = p.type_pqr";
		$result = $this->mysqli->query($sql);
		return $result;
	}

	function Get_type_PQR(){
		$sql = "SELECT * FROM type_pqr";
		$result = $this->mysqli->query($sql);
		return $result;
	}

	Function Get_Users(){
		$sql = "SELECT * FROM users";
		$result = $this->mysqli->query($sql);
		return $result;
	}

	function save(){
		$type_pqr = $_POST['type_pqr'];
		$subject = $_POST['subject'];
		$user = $_POST['user'];

		$date = date("Y-m-d");
		switch ($_POST['type_pqr']) {
		    case "1":
		        $date_limit = date("Y-m-d",strtotime($date."+ 7 days"));
		        break;
		    case "2":
		        $date_limit = date("Y-m-d",strtotime($date."+ 3 days"));
		        break;
		    case "3":
		        $date_limit = date("Y-m-d",strtotime($date."+ 2 days"));
		        break;
		}

		if (!$this->mysqli->query("INSERT INTO users_pqr(type_pqr,subject,id_user,date_create,date_limit,last_edit) VALUES ('".$type_pqr."','".$subject."','".$user."','".date("Y-m-d")."','".$date_limit."','".$_POST['user_log']."')")) {
		    echo json_encode("Falló la consulta: (" . $this->mysqli->errno . ") " . $this->mysqli->error);
		}else{
			echo json_encode("true");
		}
	}

	function get_subject(){
		$sql = "SELECT * FROM users_pqr p INNER JOIN users u ON u.id_user = p.id_user WHERE p.id_pqr = ".$_POST['id_pqr'];
		$result = $this->mysqli->query($sql);
		return json_encode($result->fetch_assoc());
	}

	function get_data_update(){
		$sql = "SELECT * FROM users_pqr WHERE id_pqr = ".$_POST['id_pqr'];
		$result = $this->mysqli->query($sql);
		return json_encode($result->fetch_assoc());
	}

	function update(){
		$date = $_POST['date_create'];
		switch ($_POST['type_pqr']) {
		    case "1":
		        $date_limit = date("Y-m-d",strtotime($date."+ 7 days"));
		        break;
		    case "2":
		        $date_limit = date("Y-m-d",strtotime($date."+ 3 days"));
		        break;
		    case "3":
		        $date_limit = date("Y-m-d",strtotime($date."+ 2 days"));
		        break;
		}

		if (!$this->mysqli->query("UPDATE users_pqr SET type_pqr = '".$_POST['type_pqr']."', subject = '".$_POST['subject']."', id_user = '".$_POST['user']."', date_limit = '".$date_limit."', last_edit = '".$_POST['user_log']."' WHERE id_pqr = ".$_POST['id_pqr'])) {
		    echo json_encode("Falló la consulta: (" . $this->mysqli->errno . ") " . $this->mysqli->error);
		}else{
			echo json_encode("true");
		}
	}

	function delete(){
		if (!$this->mysqli->query("UPDATE users_pqr SET last_edit = '".$_POST['user_log']."' WHERE id_pqr = ".$_POST['id_pqr'])) {
		   	echo json_encode("Falló la consulta: (" . $this->mysqli->errno . ") " . $this->mysqli->error);
		}else{
			if (!$this->mysqli->query("DELETE FROM users_pqr WHERE id_pqr = ".$_POST['id_pqr'])) {
			    echo json_encode("Falló la consulta: (" . $this->mysqli->errno . ") " . $this->mysqli->error);
			}else{
				echo json_encode("true");
			}
		}
		
	}

	function update_state(){
		if (!$this->mysqli->query("UPDATE users_pqr SET state = '".$_POST['msm']."' WHERE id_pqr = ".$_POST['id_pqr'])) {
		    echo json_encode("Falló la consulta: (" . $this->mysqli->errno . ") " . $this->mysqli->error);
		}else{
			echo json_encode("true");
		}
	}
	
}