<?php

class Personal{

	private $id;
	private $grupo_id;
	private $es_jefe;
	private $nombres;
	private $apellidos;
	private $db;

	public function __construct(){
		$this->db = Database::connect();
	}

	public function set_jefe(){
		$id = $this->getId();

		$sql = "UPDATE personal SET ";
		$sql .= "es_jefe = 0 ";
		$sql .= "WHERE grupo_id = {$this->getGrupo_id()};";
// echo $sql; die();
		$unset_jefe = $this->db->query($sql);
		$set_jefe = true;

		if($unset_jefe && $id){
			$sql = "UPDATE personal SET ";
			$sql .= "es_jefe = 1 ";
			$sql .= "WHERE id = $id;";
			$set_jefe = $this->db->query($sql);
		}

		if($set_jefe){
			$result = true;
			$_SESSION['success_message'] = 'Supervisor asignado exitosamente';
		} else {
			$result = false;
			$_SESSION['error_message'] = 'Fallo la conexion con la base de datos';
		}

		return $result;
	}

	public function delete(){
		$id = $this->getId();
		$sql = "DELETE FROM personal WHERE id = $id;";

		$delete = $this->db->query($sql);

		if($delete){
			$result = true;
			$_SESSION['success_message'] = 'El empleado fue eliminado exitosamente';
		} else {
			$result = false;
			$_SESSION['error_message'] = 'Fallo la conexion con la base de datos';
		}
		return $result;
	}

	public function update(){
		$grupo_id = $this->getGrupo_id();
		$es_jefe = $this->getEs_jefe();

		$sql = "UPDATE personal SET ";
		$sql .= "nombres =  '{$this->getNombres()}', ";
		$sql .= "apellidos =  '{$this->getApellidos()}'";

		if(isset($grupo_id)){
			$sql .= ", grupo_id =  $grupo_id ";
		}

		if(isset($es_jefe)){
			$sql .= ", es_jefe =  1 ";
			$this->set_jefe();			
		} else {
			$sql .= ", es_jefe =  0 ";
		}

		$sql .= "WHERE id = {$this->getId()};";

		$update = $this->db->query($sql);

		if($update){
			$result = true;
			$_SESSION['success_message'] = 'Datos actualizado exitosamente';
		} else {
			$result = false;
			$_SESSION['error_message'] = 'Fallo la comunicacion con la base de datos';
		}

		return $result;
	}

	public function save(){
		if(empty($_POST['es_jefe'])){
			$es_jefe = 0;
		} else {
			$es_jefe = 1;
		}

		if(empty($_POST['grupo_id'])){
			$grupo_id = 'null';
			$es_jefe = 0;
		} else {
			$grupo_id = $_POST['grupo_id'];
		}

		if(!empty($grupo_id) && $es_jefe == 1){
			$this->set_jefe();
		}

		$sql = "INSERT INTO personal VALUES(null, ";
		$sql .= "$grupo_id, '{$this->getNombres()}', ";
		$sql .= "'{$this->getApellidos()}', $es_jefe);";

		$insert = $this->db->query($sql);

		if($insert){
			$result = true;
			$_SESSION['success_message'] = 'Empleado agregado exitosamente';
		} else {
			$result = false;
			$_SESSION['error_message'] = 'Fallo la comunicacion con la base de datos';
		}

		return $result;
	}

	public function getAll($id = null, $grupo_id = null, $order = null){
		
		$sql = "SELECT * FROM personal ";

		if(isset($id)){
			$sql .= "WHERE id = $id ";
		}

		if(isset($grupo_id)){
			$sql .= "WHERE grupo_id = $grupo_id ";
		}

		if(isset($order) && $order == 'nombres'){
			$sql .= "ORDER BY nombres;";
		}

		if(isset($order) && $order == 'apellidos'){
			$sql .= "ORDER BY apellidos;";
		}
		
		$personal = $this->db->query($sql);

		if($personal->num_rows > 0){
			$result = $personal;
		} else { 
			$result = false;
		}

		return $result;
	}

	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $this->db->real_escape_string($id);
	}

	public function getGrupo_Id(){
		return $this->grupo_id;
	}

	public function setGrupo_Id($grupo_id){
		$this->grupo_id = $this->db->real_escape_string($grupo_id);
	}

	public function getNombres(){
		return $this->nombres;
	}

	public function setNombres($nombres){
		$this->nombres = $this->db->real_escape_string($nombres);
	}

	public function getApellidos(){
		return $this->apellidos;
	}

	public function setApellidos($apellidos){
		$this->apellidos = $this->db->real_escape_string($apellidos);
	}

	public function getEs_jefe(){
		return $this->es_jefe;
	}

	public function setEs_jefe($es_jefe){
		$this->es_jefe = $this->db->real_escape_string($es_jefe);
	}
}

?>