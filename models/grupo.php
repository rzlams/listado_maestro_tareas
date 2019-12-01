<?php

class Grupo{

	private $id;
	private $nombre;
	private $db;

	public function __construct(){
		$this->db = Database::connect();
	}

	public function save(){
		$nombre = strtoupper($this->getNombre());
		$sql = "INSERT INTO grupos ";
		$sql .= "VALUES(null, '$nombre');";

		$save = $this->db->query($sql);

		if($save){
			$result = true;
			$_SESSION['success_message'] = 'El grupo fue creado exitosamente';
		} else {
			$result = false;
			$_SESSION['error_message'] = 'Error!!! No se admiten grupos con el mismo nombre';
		}

		return $result;
	}

	public function delete(){
		$id = $this->getId();
		$sql = "DELETE FROM grupos WHERE id = $id;";

		$delete = $this->db->query($sql);

		if($delete){
			$result = true;
			$_SESSION['success_message'] = 'El grupo fue eliminado exitosamente';
		} else {
			$result = false;
			$_SESSION['error_message'] = 'Fallo la conexion con la base de datos';
		}
		return $result;
	}

	public function getAll($id = null, $orden = null){
		$result = false;
		$sql = "SELECT * FROM grupos ";

		if(isset($id)){
			$sql .= "WHERE id = $id;";
		}

		if(isset($orden)){
			$sql .= "ORDER BY nombre;";
		}

		$grupos = $this->db->query($sql);

		if($grupos->num_rows > 0){
			$result = $grupos;
		}

		return $result;
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $this->db->real_escape_string($id);
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $this->db->real_escape_string($nombre);
	}
}

?>