<?php

class Utils{

	public static function escape_unescape($string = null){
	/*
	El problema era que al intentar descargar un archivo con un caracter especial (ampersand)
	en el nombre me cortaba el nombre al llegar al ampersand porque es un caracter reservado de PHP

	La solucion es escapar el ampersand para que PHP lo ignore y me de el nombre completo
	o
	cambiar el ampersand por otro caracter al guardar el archivo y evitar que de el error

	Para hacer esto ultimo, inicialmente intente:
	- Cambia de UTF-8 (&) a ASCII (%26) al guardar en la base de datos, pero aun estando en otro formato PHP reconocia el ampersand y daba el error

	La solucion fue crear una nomenclatura (casi) imposible de fallar, se muestra a continuacion:
	*/

	// Si existe el caracter que se quiere escapar
		if(stripos($string, '&')){
	// Cambiar por las tres primeras letras del nombre del caracter entre semicolons
			$result = str_ireplace('&', ';amp;', $string);
		} else {
	// Revertir el cambio para mostrarlo en una vista
			$result = str_ireplace(';amp;', '&', $string);
		}

		return $result;
	}

	public static function deleteSession($name){
		if(isset($_SESSION[$name])){
			unset($_SESSION[$name]);
		}
	}

	public static function isAdmin(){
		if(!isset($_SESSION['admin'])){
			header('Location: index.php');
		} else { return true; }
	}

	public static function getTask(){
		require_once 'models/task.php';

		$task = new Task();
		$tareas = $task->getAll();

		return $tareas;
	}

	public static function getGrupo($id = null, $orden = null){
		require_once 'models/grupo.php';

		$object = new Grupo();
		$grupos = $object->getAll($id, $orden);

		return $grupos;
	}

	public static function getActividad($id = null, $order = null){
		require_once 'models/actividad.php';

		$object = new Actividad();
		$actividades = $object->getAll($id, $order);

		return $actividades;
	}

	public static function getJefe($id = null, $grupo_id = null, $order = null){
		require_once 'models/personal.php';

		$object = new Personal();
		$personal = $object->getAll($id, $grupo_id, $order);

		return $personal;
	}

	public static function setDocumentos($actividad_id = null, $nombre = null){
		require_once 'models/documento.php';

		$object = new Documento();
		$documento = $object->save($actividad_id, $nombre);

		return $documento;
	}

	public static function getDocumentos($actividad_id = null){
		require_once 'models/documento.php';

		$object = new Documento();
		$documento = $object->getAll($actividad_id);

		return $documento;
	}

	public static function getLastId(){
		$sql = "SELECT MAX(id) AS 'last_id' FROM actividades;";
		$query = Database::connect()->query($sql)->fetch_object();
		$_POST['last_id'] = $query->last_id;
	}

	public static function getPersonal($id = null, $grupo_id = null, $order = null){
		require_once 'models/personal.php';

		$object = new Personal();
		$personal = $object->getAll($id, $grupo_id, $order);

		return $personal;
	}
}
?>