<?php

require_once 'models/actividad.php';

class actividadController{

	public function index(){
		$actividad = new Actividad();
		$actividades = $actividad->getAll();
	}

	public function save(){

		$object = new Actividad();
		$object->setNombre($_POST['nombre']);
		$object->setDescripcion($_POST['descripcion']);

		if(isset($_POST['id'])){
			$object->setId($_POST['id']);
		} else {
			$object->setId(null);
		}

		$object->save();

		if(isset($_POST['id'])){
			$_SESSION['success-message'] = 'Actividad actualizada exitosamente';
			header('Location: index.php');
		} else {
			$actividad = $object->getAll($_POST['last_id']);
			$_SESSION['success-message'] = 'Actividad creada exitosamente';
			require_once 'views/actividad/editar.php';
		}
	}

	public function editar(){
		if(isset($_POST['id'])){
			$object = new Actividad();
			$actividad = $object->getAll($_POST['id']);
		}
		
		require_once 'views/actividad/editar.php';
	}

	public function gestion(){
		$actividad = new Actividad();
		$actividades = $actividad->getAll(null, 'nombre');

		require_once 'views/actividad/gestion.php';
	}

	public function crear(){
		require_once 'views/actividad/crear.php';
	}
	
}

?>