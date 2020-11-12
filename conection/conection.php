<?php 

class Conection {
	
	public $connect;

	function __construct(){
	}

	function connectFT(){
		$this->connect = mysqli_connect("localhost", "root", "", "prueba");

		if (!$this->connect) {
		    return "error".PHP_EOL;
		}
		return $this->connect;
	}
}