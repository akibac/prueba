<?php
require $_SERVER['DOCUMENT_ROOT'].'/prueba/conection/conection.php';

class Login extends Conection{

	public $mysqli;

	function __construct(){
		$this->mysqli = $this->connectFT();
	}

	Function login(){
		$sql = "SELECT * FROM users WHERE name ='".$_POST['usr']."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows > 0) {
			while($value = $result->fetch_object()){
				if (password_verify(md5('07'.$_POST["psw"]), $value->password)) {
					session_start();
					$_SESSION['id_user'] = $value->id_user;
					$_SESSION['user'] = $value->name;
					$_SESSION['type_user'] = $value->type_user;
					return json_encode($value->type_user);
				}else{
					return json_encode("error");
				}
			}
		}else{
			return json_encode("error");
		}
	}

	function login_close(){
		session_start();
		session_destroy();
		session_unset();
		echo json_encode("ok");
	}

	function save_user(){
		$sql = "SELECT * FROM users WHERE name ='".$_POST['name']."'";
		$result = $this->mysqli->query($sql);
		if ($result->num_rows > 0) {
			echo json_encode("error");
		}else{
			$pass = password_hash(md5('07'.$_POST['pass']), PASSWORD_ARGON2ID);
			if (!$this->mysqli->query("INSERT INTO users(name,password,type_user) VALUES ('".$_POST['name']."','".$pass."','2')")) {
			    echo json_encode("Falló la consulta: (" . $this->mysqli->errno . ") " . $this->mysqli->error);
			}else{
				echo json_encode("true");
			}
		}
		
	}

	function delete(){
		if (!$this->mysqli->query("DELETE FROM users WHERE id_user = ".$_POST['id_user'])) {
		    echo json_encode("Falló la consulta: (" . $this->mysqli->errno . ") " . $this->mysqli->error);
		}else{
			echo json_encode("true");
		}
	}
}