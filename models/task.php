<?php

class Task{

	private $id;
	private $actividad_id;
	private $grupo_id;
	private $status;
	private $prioridad;
	private $fecha_inicio;
	private $hora_inicio;
	private $fecha_culminacion;
	private $hora_culminacion;
	private $observaciones;
	private $db;

	public function __construct(){
		$this->db = Database::connect();
	}

	public function save(){
		$grupo_id = $this->getGrupo_id();

		$sql = "INSERT INTO tareas VALUES(null, ";
		$sql .= "{$this->getActividad_id()}, ";

		if(!empty($grupo_id)){
			$sql .= "$grupo_id, ";
		} else {
			$sql .= "null, ";
		}

		$sql .= "'pendiente', ";
		$sql .= "'{$this->getPrioridad()}', ";
		$sql .= "null, null, null, null, null);";
// echo $sql; die();
		$save = $this->db->query($sql);

		if($save){
			$_SESSION['success_message'] = 'Tarea creada exitosamente';
		} else {
			$_SESSION['error_message'] = 'Fallo la conexion con la base de datos';
		}
	}

	public function getAll(){
		$sql = "SELECT * FROM tareas ORDER BY id DESC LIMIT 100;";
		$tareas = $this->db->query($sql);

		return $tareas;
	}

	public function update(){
		$grupo_id = $this->getGrupo_id();

		if(empty($grupo_id)){
			$grupo_id = 'null';
		}

		date_default_timezone_set("America/New_York");
		$fecha_actual = date("Y/m/d");
		$hora_actual = date("H:i:s");
		$sql = "UPDATE tareas SET ";
		$sql .= "actividad_id = {$this->getActividad_id()}, ";
		$sql .= "grupo_id = $grupo_id, ";
		$sql .= "status = '{$this->getStatus()}', ";
		$sql .= "prioridad = '{$this->getPrioridad()}', ";

		if($this->getStatus() == "en proceso"){
			$sql .= "fecha_inicio = '$fecha_actual', ";
			$sql .= "hora_inicio = '$hora_actual', ";
		} elseif($this->getStatus() == "finalizado"){
			$sql .= "fecha_culminacion = '$fecha_actual', ";
			$sql .= "hora_culminacion = '$hora_actual', ";
		}

		$sql .= "observaciones = TRIM('{$this->getObservaciones()}') ";
		$sql .= "WHERE id = {$this->getId()};";

		$update = $this->db->query($sql);

		if($update){
			$result = true;
			$_SESSION['success_message'] = 'Tarea actualizada exitosamente';
		} else {
			$result = false;
			$_SESSION['error_message'] = 'Fallo la comunicacion con la base de datos';
		}

		return $result;
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $this->db->real_escape_string($id);
	}

	public function getActividad_id(){
		return $this->actividad_id;
	}

	public function setActividad_id($actividad_id){
		$this->actividad_id = $this->db->real_escape_string($actividad_id);
	}

	public function getGrupo_id(){
		return $this->grupo_id;
	}

	public function setGrupo_id($grupo_id){
		$this->grupo_id = $this->db->real_escape_string($grupo_id);
	}

	public function getStatus(){
		return $this->status;
	}

	public function setStatus($status){
		$this->status = $this->db->real_escape_string($status);
	}

	public function getPrioridad(){
		return $this->prioridad;
	}

	public function setPrioridad($prioridad){
		$this->prioridad = $this->db->real_escape_string($prioridad);
	}

	public function getFecha_inicio(){
		return $this->fecha_inicio;
	}

	public function setFecha_inicio($fecha_inicio){
		$this->fecha_inicio = $this->db->real_escape_string($fecha_inicio);
	}

	public function getHora_inicio(){
		return $this->hora_inicio;
	}

	public function setHora_inicio($hora_inicio){
		$this->hora_inicio = $this->db->real_escape_string($hora_inicio);
	}

	public function getFecha_culminacion(){
		return $this->fecha_culminacion;
	}

	public function setFecha_culminacion($fecha_culminacion){
		$this->fecha_culminacion = $this->db->real_escape_string($fecha_culminacion);
	}

	public function getHora_culminacion(){
		return $this->hora_culminacion;
	}

	public function setHora_culminacion($hora_culminacion){
		$this->hora_culminacion = $this->db->real_escape_string($hora_culminacion);
	}

	public function getObservaciones(){
		return $this->observaciones;
	}

	public function setObservaciones($observaciones){
		$this->observaciones = $this->db->real_escape_string($observaciones);
	}
}

?>