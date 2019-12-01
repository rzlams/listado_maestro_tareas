<?php

require_once 'models/personal.php';

class personalController{

	public function set_jefe(){
		if(isset($_GET['id']) && isset($_GET['grupo_id'])){
			$object = new Personal();
			$object->setId($_GET['id']);
			$object->setGrupo_id($_GET['grupo_id']);
			$set_jefe = $object->set_jefe();
		}

		require_once 'views/grupo/gestion.php';
	}

	public function delete(){
		if(isset($_GET['id'])){
			$object = new Personal();
			$object->setId($_GET['id']);
			$delete = $object->delete();
		}

		if($delete){
			require_once 'views/grupo/gestion.php';
		} else {
			require_once 'views/personal/editar.php';
		}
	}

	public function crear(){
		require_once 'views/personal/crear.php';
	}

	public function save(){
		if(isset($_POST)){
			$object = new Personal();
			$object->setNombres($_POST['nombres']);
			$object->setApellidos($_POST['apellidos']);

			if(!empty($_POST['grupo_id'])){
				$object->setGrupo_id($_POST['grupo_id']);
			}

			if(!empty($_POST['es_jefe'])){
				$object->setEs_jefe($_POST['es_jefe']);
			}
			
			$save = $object->save();
		}

		if($save){
			require_once 'views/grupo/gestion.php';
		} else {
			require_once 'views/personal/crear.php';
		}
	}

	public function editar(){

		if(isset($_GET)){
			$object = new Personal();
			$personal = $object->getAll($_GET['id']);

			require_once 'views/personal/editar.php';
		} else {
			$_SESSION['error_message'] = 'Fallo la comunicacion con la base de datos';
			header('Location: index');
		}
	}

	public function update(){
		if(isset($_POST)){
			$object = new Personal();
			$object->setId($_POST['id']);

			if(!empty($_POST['grupo_id'])){
				$object->setGrupo_Id($_POST['grupo_id']);
			}

			if(!empty($_POST['es_jefe'])){
				$object->setEs_jefe($_POST['es_jefe']);
			}
			
			$object->setNombres($_POST['nombres']);
			$object->setApellidos($_POST['apellidos']);
			
			$update = $object->update();
		}

		if($update){
			require_once 'views/grupo/gestion.php';
		} else {
			require_once 'views/personal/editar.php';
		}
	}
}

?>