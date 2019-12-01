<h1 class="title">Crear Grupo</h1>

<?php
	if(isset($_SESSION['error_message'])){
		echo '<br/><div class="message error">' .
			$_SESSION['error_message'] . '</div><br/>';
		unset($_SESSION['error_message']);
	}
?>

<main class="container center">

<form action="index.php?controller=grupo&action=save" method="POST">

	<div class="form-group">
		<label class="label" for="nombre">Nombre:</label>
		<input class="input" type="text" name="nombre" id="nombre" required />
	</div>
	
	<input type="submit" class="button guardar" value="Guardar" />
</form>
</main>