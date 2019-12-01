<?php

if(!isset($_SESSION)){
	session_start();
}

require_once 'helpers/utils.php';
require_once 'config/db.php';
require_once 'autoload.php';
require_once 'parameters.php';
require_once 'views/layout/header.php';


if(isset($_GET['controller'])){
	$nombre_controlador = $_GET['controller'] . 'Controller';
} else {
	$nombre_controlador = CONTROLLER_DEFAULT;
}

if(class_exists($nombre_controlador)){
	$controlador = new $nombre_controlador;

	if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
		$action = $_GET['action'];
		$controlador->$action();
	} else {
		$action = ACTION_DEFAULT;
		$controlador->$action();
	}
} else {
	echo 'La pagina que buscas no existe';
}

?>