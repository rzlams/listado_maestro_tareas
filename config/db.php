<?php

class Database{

	public static function connect(){
		$db = new mysqli('localhost', 'root', '', 'Listado_Tareas');
		return $db;
	}
}

?>