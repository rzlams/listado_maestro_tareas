<h1 class="title">Crear Tarea</h1>

<?php
	if(isset($_SESSION['error_message'])){
		echo '<br/><div class="message error">' . $_SESSION['error_message'] . '</div><br/>';
		unset($_SESSION['error_message']);
	}
?>

<main class="container center">

<form action="index.php?controller=task&action=save" method="POST">

	<div class="form-group">
		<label class="label" for="actividad_id">Actividad:</label>

		<select class="input" name="actividad_id" id="actividad_id" required >
			<option value=""><--Seleccione una--></option>
	<?php $actividades = Utils::getActividad(null, 'nombre'); ?>
	<?php while($act = $actividades->fetch_object()): ?>
			<option value="<?= $act->id ?>">
				<?= $act->nombre ?>	
			</option>
	<?php endwhile; ?>
		</select>
	</div>
		
	<div class="radio-form-group">
		<span class="label">Prioridad:</span>
		<label class="radio-label" for="normal">Normal
		<input type="radio" name="prioridad" id="normal" value="normal" required />
		</label>
		<label class="radio-label" for="emergencia">Emergencia
		<input type="radio" name="prioridad" id="emergencia" value="emergencia" required />
		</label>
	</div>
 
	<div class="form-group">
		<label class="label" for="grupo_id">Grupo:</label>

		<select class="input" name="grupo_id" id="grupo_id" />
			<option value=""><--Seleccione uno--></option>
	<?php $grupos = Utils::getGrupo(); ?>
	<?php if($grupos): ?>
	<?php while($grupo = $grupos->fetch_object()): ?>
			<option value="<?= $grupo->id ?>">
				<?= 'Grupo ' . $grupo->nombre ?>	
			</option>
	<?php endwhile; ?>
	<?php endif; ?>
		</select>
	</div>

	<input type="submit" class="button guardar" value="Guardar" />
</form>
</main>