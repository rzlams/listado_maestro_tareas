<?php $per = $personal->fetch_object(); ?>

<a class="link-titulo" title="Borrar Empleado"
href="index.php?controller=personal&action=delete&id=<?= $per->id ?>">
<h1 class="title personal">Empleado</h1></a>

<main class="container center">

<form action="index.php?controller=personal&action=update" method="POST">
	<div class="form-group">
		<label class="label" for="grupo_id">Grupo:</label>

		<select class="input" name="grupo_id" id="grupo_id">
	
	<?php $grupos = Utils::getGrupo(); ?>
	<?php if($grupos): ?>
			<option value="<?= $per->grupo_id ?>">
				<?php
					if($per->grupo_id){
						$grupo = Utils::getGrupo($per->grupo_id);
						echo 'GRUPO ' . $grupo->fetch_object()->nombre;
					} else {
						echo '<--Seleccione uno-->';
					}
				?>
			</option>
		<?php while($grupo = $grupos->fetch_object()): ?>
			<option value="<?= $grupo->id ?>"><?= 'GRUPO ' . $grupo->nombre ?></option>
		<?php endwhile; ?>
	<?php endif; ?>
		</select>
	</div>

	<div class="radio-form-group">
		<span class="label">Supervisor:</span>
		<label class="radio-label" for="si">SI
		<input type="radio" name="es_jefe" id="si" value="1" 
		<?php
			if($per->es_jefe == 1){
				echo 'checked';
			}
		?> />
		</label>
		<label class="radio-label" for="no">NO
		<input type="radio" name="es_jefe" id="no" value="0" 
		<?php
			if($per->es_jefe == 0){
				echo 'checked';
			}
		?> />
		</label>
	</div>

	<hr class="division">

	<div class="form-group">
		<label class="label" for="nombres">Nombres:</label>
		<input class="input" type="text" name="nombres" id="nombres"
		value="<?= $per->nombres ?>" required />
	</div>
		
	<div class="form-group">
		<label class="label" for="apellidos">Apellidos:</label>
		<input class="input" type="text" name="apellidos" id="apellidos"
		value="<?= $per->apellidos ?>"required />
	</div>
	
	<input class="hidden" type="text" name="id" value="<?= $per->id ?>" />
	
	<input type="submit" class="button guardar" value="Guardar" />
</form>
</main>