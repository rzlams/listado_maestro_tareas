<?php

class Actividad{

	private $id;
	private $nombre;
	private $descripcion;
	private $db;

	public function __construct(){
		$this->db = Database::connect();
	}

	public function save(){
		$id = $this->getId();
		$nombre = $this->getNombre();
		$descripcion = $this->getDescripcion();

		if(!empty($nombre) && !empty($descripcion)){
			if(!empty($id)){
				$sql = "UPDATE actividades SET ";
				$sql .= "nombre = '$nombre', ";
				$sql .= "descripcion = '$descripcion' ";
				$sql .= "WHERE id = $id;";
			} else {
				$sql = "INSERT INTO actividades VALUES(null, ";
				$sql .= "'$nombre', '$descripcion');";
			}
		
			$actividades = $this->db->query($sql);

			if($actividades){
				Utils::getLastId();
			} else {
				exit('Problema al conectar con la Base de datos. No puede crear dos actividades con el mismo nombre');
			}
		} else {
			exit('No puedes crear actividades con el nombre o la descripcion vacios');
		}
	}

	public function getAll($id = null, $order = null){
		$result = false;
		$sql = "SELECT * FROM actividades ";

		if(isset($id)){
			$sql .= "WHERE id = $id ";
		}

		if(isset($order) && $order == 'nombre'){
			$sql .= "ORDER BY nombre;";
		}

		if(isset($order) && $order == 'id'){
			$sql .= "ORDER BY id DESC;";
		}

		$actividades = $this->db->query($sql);

		if($actividades->num_rows > 0){
			$result = $actividades;
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

	public function getDescripcion(){
		return $this->descripcion;
	}

	public function setDescripcion($descripcion){
		$this->descripcion = $this->db->real_escape_string($descripcion);
	}
}

?>
