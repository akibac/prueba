<?php
require $_SERVER['DOCUMENT_ROOT'].'/prueba/conection/conection.php';
class Users extends Conection{

	public $mysqli;

	function __construct(){
		$this->mysqli = $this->connectFT();
	}

	Function Get_Users(){
		$sql = "SELECT * FROM users";
		$result = $this->mysqli->query($sql);
		return $result;
	}

	function save(){
		$name = $_POST['name'];
		$pass = password_hash(md5('07'.$_POST['pass']), PASSWORD_ARGON2ID);
		if (!$this->mysqli->query("INSERT INTO users(name,password,type_user) VALUES ('".$name."','".$pass."','2')")) {
		    echo json_encode("Falló la consulta: (" . $this->mysqli->errno . ") " . $this->mysqli->error);
		}else{
			echo json_encode("true");
		}
	}

	function delete(){
		if (!$this->mysqli->query("DELETE FROM users WHERE id_user = ".$_POST['id_user'])) {
		    echo json_encode("Falló la consulta: (" . $this->mysqli->errno . ") " . $this->mysqli->error);
		}else{
			echo json_encode("true");
		}
	}

	function Get_PQR(){
		$sql = "SELECT * FROM users_pqr p INNER JOIN users u ON u.id_user = p.id_user INNER JOIN type_pqr t ON t.id_type = p.type_pqr WHERE p.id_user = ".$_SESSION['id_user'];
		$result = $this->mysqli->query($sql);
		//$array = array("count" => $result->num_rows, "data" => $result);
		return $result;
	}

	function Get_PQR2(){
		$sql = "SELECT * FROM users_pqr p INNER JOIN users u ON u.id_user = p.id_user INNER JOIN type_pqr t ON t.id_type = p.type_pqr WHERE p.id_user".$_SESSION['id_user'];
		$result = $this->mysqli->query($sql);
		//$array = array("count" => $result->num_rows, "data" => $result);
		return $result->num_rows;
	}
}