<h1 class="title">Agregar Empleado</h1>

<?php
	if(isset($_SESSION['error_message'])){
		echo '<br/><div class="message error">' . $_SESSION['error_message'] . '</div><br/>';
		unset($_SESSION['error_message']);
	}
?>

<main class="container center">

<form action="index.php?controller=personal&action=save" method="POST">

	<div class="form-group">
		<label class="label" for="nombres">Nombres:</label>
		<input class="input" type="text" name="nombres" id="nombres" required />
	</div>
		
	<div class="form-group">
		<label class="label" for="apellidos">Apellidos:</label>
		<input class="input" type="text" name="apellidos" id="apellidos" required />
	</div>

	<hr class="division">

	<div class="form-group">
		<label class="label" for="grupo_id">Grupo:</label>

		<select class="input" name="grupo_id" id="grupo_id">
	<?php $grupos = Utils::getGrupo(); ?>
	<?php if($grupos): ?>
			<option value=""><--Seleccione uno--></option>
		<?php while($grupo = $grupos->fetch_object()): ?>
			<option value="<?= $grupo->id ?>"><?= 'GRUPO ' . $grupo->nombre ?></option>
		<?php endwhile; ?>
	<?php endif; ?>
		</select>
	</div>

	<div class="radio-form-group">
		<span class="label">Supervisor:</span>
		<label class="radio-label" for="si">SI
		<input type="radio" name="es_jefe" id="si" value="1" />
		</label>
		<label class="radio-label" for="no">NO
		<input type="radio" name="es_jefe" id="no" value="0" />
		</label>
	</div>

	<input type="submit" class="button guardar" value="Guardar" />
</form>
</main>