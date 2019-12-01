<?php

require_once 'models/documento.php';

class documentoController{

	public function upload(){
		$object = new Documento();
		$object->setActividad_id($_POST['actividad_id']);
		$object->upload();

		$actividad = Utils::getActividad($_POST['actividad_id']);

		require_once 'views/actividad/editar.php';

	}

	public function delete(){
		$object = new Documento();
		$object->setActividad_id($_GET['id']);
		$object->setNombre($_GET['nombre']);
		$object->delete();

		$actividad = Utils::getActividad($_GET['id']);

		require_once 'views/actividad/editar.php';
	}

	public function download(){
		$object = new Documento();
		$object->setNombre($_GET['nombre']);
		$object->download();

		$actividad = Utils::getActividad($_GET['id']);
	}

	
}

?>
