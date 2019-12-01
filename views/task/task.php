<label class="task <?= $task->status . ' ' . $task->prioridad ?>">
	<div class="task-header" title="<?php 
			$actividad = Utils::getActividad($task->actividad_id);
			echo $actividad->fetch_object()->nombre; ?>">	
	<?php 
		$actividad = Utils::getActividad($task->actividad_id);
		echo $actividad->fetch_object()->nombre;
	?>
	</div>

	<input class="task-toggle" type="checkbox" />

	<form action="index.php?controller=task&action=update" method="POST" class="task-body">

		<div class="form-group-task column">
			<label class="task-label">Supervisor:</label>
		<?php
			$nombres = Utils::getJefe(null, $task->grupo_id);
			$apellidos = Utils::getJefe(null, $task->grupo_id);
			if($nombres && $apellidos && !empty($task->grupo_id)){
				echo '<span class="content">' .
				$nombres->fetch_object()->nombres . ' ' .
				$apellidos->fetch_object()->apellidos . '</span>';
			}
		?>
		</div>

		<div class="form-group-task">
			<label class="task-label">Grupo:</label>
		<?php
			$grupo = Utils::getGrupo($task->grupo_id);
			if($grupo && !empty($task->grupo_id)){
				echo '<span class="content">' .
				$grupo->fetch_object()->nombre . '</span>';
			}
		?>
		</div>

		<div class="form-group-task column">
			<label class="task-label">Status:</label>
		<div>
			<label class="content">Pendiente
			<input type="radio" name="status" value="pendiente"
		<?php
			if($task->status == "pendiente"){
				echo " checked";
			}
		?> />
			</label>

			<label class="content">En proceso
			<input type="radio" name="status" value="en proceso"
		<?php
			if($task->status == "en proceso"){
				echo " checked";
			}
		?> />
			</label>

			<label class="content">Finalizado
			<input type="radio" name="status" value="finalizado"
		<?php
			if($task->status == "finalizado"){
				echo " checked";
			}
		?> />
			</label>
		</div>
		</div>

		<div class="form-group-task">
			<label class="task-label">Prioridad:</label>
			<label class="content">Normal
			<input type="radio" name="prioridad" value="normal"
		<?php
			if($task->prioridad == "normal"){
				echo " checked";
			}
		?> />
			</label>

			<label class="content">Emergencia
			<input type="radio" name="prioridad" value="emergencia"
		<?php
			if($task->prioridad == "emergencia"){
				echo " checked";
			}
		?> />
			</label>
		</div>

		<div class="form-group-task">
			<label class="task-label">Inicio:</label>
			<input class="result-input date" type="date" name="fecha_inicio" value="<?= $task->fecha_inicio ?>" />
			<input class="result-input time" type="time" name="hora_inicio" value="<?= $task->hora_inicio ?>" />
		</div>

		<div class="form-group-task">
			<label class="task-label">Culminacion:</label>
			<input class="result-input date" type="date" name="fecha_culminacion" value="<?= $task->fecha_culminacion ?>" />
			<input class="result-input time" type="time" name="hora_culminacion" value="<?= $task->hora_culminacion ?>" />
		</div>
	
		<div class="form-group-task documentos">
			<label class="task-label">Documentos Asociados:</label>
	<?php $documentos = Utils::getDocumentos($task->actividad_id); ?>
	<?php if($documentos): ?>
			<div class="form-group-task docs-links">
	<?php while($doc = $documentos->fetch_object()): ?>
			<a class="doc-link" href="index.php?controller=documento&action=download&nombre=<?= $doc->nombre ?>">
				<?php $filename = Utils::escape_unescape($doc->nombre); ?>
				<?= explode('.', $filename)[1] ?>
			</a>
	<?php endwhile; ?>
			</div>
	<?php else: ?>
		<?= '<span class="content documentos">No existen documentos actualmente</span>' ?>
	<?php endif; ?>

		</div>

		<div class="form-group-task observacion">
			<div class="form-group-task">
				<label class="task-label">Observaciones:</label>
				<input class="hidden" type="text" name="id" value="<?= $task->id ?>" />
				<input class="hidden" type="text" name="actividad_id" value="<?= $task->actividad_id ?>" />
				<input class="hidden" type="text" name="grupo_id" value="<?= $task->grupo_id ?>" />
			</div>
			<textarea class="observaciones" name="observaciones" rows="5"><?= $task->observaciones ?></textarea>
		</div>

		<input class="button button-task" type="submit" value="Actualizar" />

	</form>
</label>