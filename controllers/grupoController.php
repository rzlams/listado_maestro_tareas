<?php

require_once 'models/grupo.php';

class grupoController{

	public function save(){
		if(isset($_POST['nombre'])){
			$object = new Grupo();
			$object->setNombre($_POST['nombre']);
			$save = $object->save();
		}

		if($save){
			require_once 'views/grupo/gestion.php';
		} else {
			require_once 'views/grupo/crear.php';			
		}
	}

	public function crear(){
		require_once 'views/grupo/crear.php';
	}

	public function delete(){
		if(isset($_GET['id'])){

			require_once 'models/personal.php';
			$personal = new Personal();
			$personal->setGrupo_id($_GET['id']);
			// var_dump($_GET['id']); die();
			$personal->set_jefe();

			$grupo = new Grupo();
			$grupo->setId($_GET['id']);
			$delete = $grupo->delete();
		}

		require_once 'views/grupo/gestion.php';
	}

	public function index(){
		$grupo = new Grupo();
		$grupos = $grupo->getAll(null, 'nombre');

		require_once 'views/grupo/gestion.php';
	}
}

?>
