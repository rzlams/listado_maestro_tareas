<?php

class Documento{

	private $actividad_id;
	private $nombre;
	private $db;

	public function __construct(){
		$this->db = Database::connect();
	}

	public function delete(){
		$target_dir = 'assets/documents/';
		$file_name = $this->getNombre();
		$target_file = $target_dir . $file_name;

		if(file_exists($target_file)){
			unlink($target_file);

			$sql = "DELETE FROM documentos ";
			$sql .= "WHERE actividad_id = {$this->getActividad_id()} ";
			$sql .= "AND nombre = '{$this->getNombre()}';";

			$this->db->query($sql);
		} else {
			$_SESSION['delete_error'] = 'El fichero que desea eliminar no existe';
		}
	}

	public function download(){

// FORZAR DESCARGA
		$target_dir = BASE_URL . '/assets/documents/';
		$file_name = $this->getNombre();
		$target_file = $target_dir . $file_name;

		if (file_exists($target_file)){
		    header('Content-Description: File Transfer');
		    // header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename="'.basename($target_file).'"');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    // header('Content-Length: ' . filesize($target_file));
		    $document = readfile($target_file);
		    exit;
		}		

		$result = false;
		if($document){
			$result = $document;
		}
		return $result;
	}

	public function upload(){

		function filterEmpty($value){
			if(!empty($value)){
				return $value;
			}
		}
		$files = array_filter($_FILES['documento']['name'], "filterEmpty");
		$total = count($_FILES['documento']['name']);

		for( $i=0; $i < $total; $i++){
		$target_dir = BASE_URL . '/assets/documents/';
		$file_name = str_pad($this->getActividad_id(),5,"0",STR_PAD_LEFT) .
		'.' . Utils::escape_unescape(basename($files[$i]));
		$target_file = $target_dir . $file_name;
		$uploadOk = 1;
		$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
/*var_dump($_FILES["documento"]["tmp_name"][$i]);
var_dump($target_file);
die();*/
// Check if file already exists
		/*if (file_exists($target_file)) {
		    $_SESSION['upload_error'] = "El archivo ya existe.";
		    $uploadOk = 0;
		}*/
// Check file size
		if($_FILES['documento']['size'][$i] > 5000000) {
		    $_SESSION['upload_error'] = "El archivo no puede pesar mas de 5MB.";
		    $uploadOk = 0;
		}
// Allow certain file formats
		if($fileType != "pdf") {
		    $_SESSION['upload_error'] = "Solo se permiten archivos PDF.";
		    $uploadOk = 0;
		}
// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    $_SESSION['upload'] = "Lo sentimos, su archivo no se pudo cargar.";
// if everything is ok, try to upload file
		} else {
			if(move_uploaded_file($_FILES["documento"]["tmp_name"][$i], $target_file)) {
		    	$i == 0 ?
		        $archivos = '<br/>' . basename($files[$i]) :
		        $archivos .= '<br/>' . basename($files[$i]);

		        $_SESSION['upload'] = "Cargado exitosamente: " . $archivos;

		        $sql = "INSERT INTO documentos VALUES({$this->getActividad_id()}, '$file_name');";
				$upload = $this->db->query($sql);

				if($upload  == false){ 
					$sql = "UPDATE documentos ";
					$sql .= "SET nombre = '$file_name' ";
					$sql .= "WHERE actividad_id = {$this->getActividad_id()} ";
					$sql .= "AND nombre = '$file_name';";
					$upload = $this->db->query($sql);
				}
		        
		    } else {
		        $_SESSION['upload'] = "Lo sentimos, ocurrio un error al cargar su archivo.";
		    }
		}
		}
	}

	public function getAll($actividad_id = null){
		$result = false;
		$sql = "SELECT * FROM documentos ";

		if(isset($actividad_id)){
			$sql .= "WHERE actividad_id = $actividad_id ";
		}

		$sql .= "ORDER BY nombre;";

		$documentos = $this->db->query($sql);

		if($documentos->num_rows > 0){
			$result = $documentos;
		}

		return $result;
	}

	public function getActividad_id(){
		return $this->actividad_id;
	}

	public function setActividad_id($actividad_id){
		$this->actividad_id = $this->db->real_escape_string($actividad_id);
	}

	public function getNombre(){
		return $this->nombre;
	}

	public function setNombre($nombre){
		$this->nombre = $this->db->real_escape_string($nombre);
	}
}

?>