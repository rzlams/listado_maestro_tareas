<?php

require_once 'models/task.php';

class taskController{

	public function index(){
		require_once 'views/task/lista.php';
	}

	public function create(){
		require_once 'views/task/crear.php';
	}

	public function save(){
		if(isset($_POST)){
			$task = new Task();
			$task->setActividad_id($_POST['actividad_id']);
			$task->setGrupo_id($_POST['grupo_id']);
			$task->setPrioridad($_POST['prioridad']);
			$task->save();
		}
		
		header('Location: index.php');
	}

	public function update(){
		if(isset($_POST)){
			$task = new Task();
			$task->setId($_POST['id']);
			$task->setActividad_id($_POST['actividad_id']);			
			$task->setGrupo_id($_POST['grupo_id']);
			$task->setStatus($_POST['status']);
			$task->setPrioridad($_POST['prioridad']);
			$task->setFecha_inicio($_POST['fecha_inicio']);
			$task->setHora_inicio($_POST['hora_inicio']);
			$task->setFecha_culminacion($_POST['fecha_culminacion']);
			$task->setHora_culminacion($_POST['hora_culminacion']);
			$task->setObservaciones($_POST['observaciones']);
			$task->update();
		}

		header('Location: index.php');
	}

}

?>