<?php
require $_SERVER['DOCUMENT_ROOT'].'/prueba/conection/conection.php';
class Users extends Conection{

	public $mysqli;

	function __construct(){
		$this->mysqli = $this->connectFT();
	}

	Function Get_Users(){
		$sql = "SELECT u.*,t.description as type FROM users u INNER JOIN type_users t ON u.type_user = t.id_type";
		$result = $this->mysqli->query($sql);
		return $result;
	}

	function Get_Type_Users(){
		$sql = "SELECT * FROM type_users";
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

	function save_user(){
		$name = $_POST['name'];
		$pass = password_hash(md5('07'.$_POST['pass']), PASSWORD_ARGON2ID);
		$type = $_POST['type'];
		if (!$this->mysqli->query("INSERT INTO users(name,password,type_user,last_edit) VALUES ('".$name."','".$pass."','".$type."', '".$_POST['user_log']."')")) {
		    echo json_encode("Falló la consulta: (" . $this->mysqli->errno . ") " . $this->mysqli->error);
		}else{
			echo json_encode("true");
		}
	}

	function Get_User_ID(){
		$id_users = $_POST['id_user'];
		$sql = "SELECT * FROM users WHERE id_user = $id_users";
		$result = $this->mysqli->query($sql);
		return json_encode($result->fetch_assoc());
	}

	function update_user(){
		$id_user = $_POST['id_user'];
		$name = $_POST['name'];
		$type = $_POST['type'];
		$user_log = $_POST['user_log'];
		if (!$this->mysqli->query("UPDATE users SET name = '".$name."', type_user = '".$type."', last_edit = '".$user_log."' WHERE id_user = '".$id_user."'")) {
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