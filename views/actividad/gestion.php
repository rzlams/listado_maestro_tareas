<h1 class="title">Actividades</h1>

<form class="gestion-form" action="index.php?controller=actividad&action=editar" method="POST" enctype="multipart/form-data">
	<?php if($actividades): ?>
		<label class="label" for="id" >Seleccione una:</label>
		<select class="input" name="id" id="id">
		<?php while($act = $actividades->fetch_object()): ?>
			<option value="<?= $act->id ?>">
				<?= $act->nombre ?>
			</option>
		<?php endwhile; ?>
		</select>
		
		<button class="button edit" title="Editar" ><i class="fas fa-edit"></i></button>

	<?php endif; ?>

		<a class="add" href="index.php?controller=actividad&action=crear" title="Agregar Actividad">
			<i class="fas fa-plus"></i>
		</a>
</form>