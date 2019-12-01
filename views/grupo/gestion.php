<a class="link-titulo" title="Crear Grupo" href="index.php?controller=grupo&action=crear"><h1 class="title grupo">Grupos</h1></a>

	<aside class="lista-personal">
		<a class="form-group add-personal"
		href="index.php?controller=personal&action=crear" title="Agregar Empleado">
		<div class="add no-margin">
			<i class="fas fa-plus"></i>
			<span class="add-caption">Agregar Empleado</span>
		</div>
		</a>

		<div class="links-container">
	<?php $personal = Utils::getPersonal(null, null, 'nombres'); ?>
	<?php if($personal): ?>
		<?php while($per = $personal->fetch_object()): ?>
		<a class="link-personal<?php if(!isset($per->grupo_id)){echo ' sin-grupo';} ?>"
		href="index.php?controller=personal&action=editar&id=<?= $per->id ?>"
		title="<?= $per->nombres . ' ' . $per->apellidos ?>">
			<?= $per->nombres . ' ' . $per->apellidos ?>
		</a>
		<article class="info-personal"></article>

		<?php endwhile; ?>
	<?php endif; ?>
			
		</div>
	</aside>

<div class="group-page">

<?php
	if(isset($_SESSION['success_message'])){
		echo '<br/><div class="message success" style="justify-content:flex-end;padding-right:25vw;">' .
			$_SESSION['success_message'] . '</div>';
		unset($_SESSION['success_message']);
	}

	if(isset($_SESSION['error_message'])){
		echo '<br/><div class="message error" style="justify-content:flex-end;padding-right:25vw;">' .
			$_SESSION['error_message'] . '</div>';
		unset($_SESSION['error_message']);
	}
?>

	<main class="groups-container">

<?php $grupos = Utils::getGrupo(null, true); ?>
<?php if($grupos): ?>
	<?php while($grupo = $grupos->fetch_object()): ?>

	<article class="group">
		<div class="group-header">
		<h3 class="group-title" >
			<?= 'GRUPO ' . $grupo->nombre ?>
		</h3>
		<a class="delete-group" title="Borrar Grupo" href="index.php?controller=grupo&action=delete&id=<?= $grupo->id ?>">
			<i class="far fa-times-circle"></i>
		</a>
		</div>
	<?php $personal = Utils::getPersonal(null, null, 'nombres'); ?>
	<?php if($personal): ?>
		<?php while($per = $personal->fetch_object()): ?>
		<?php
			if($per->grupo_id == $grupo->id && $per->es_jefe == 1):
		?>
		<div class="supervisor-grupo">
			<?= $per->nombres . ' ' . $per->apellidos ?>
		</div>
		<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?>

		<section class="group-body">
	<?php $personal = Utils::getPersonal(null, null, 'nombres'); ?>
	<?php if($personal): ?>
		<?php while($per = $personal->fetch_object()): ?>
		<?php
			if($per->grupo_id == $grupo->id && $per->es_jefe == 0):
		?>
			<div class="empleado-grupo">
				<span class="nombre-empleado">
					<?= $per->nombres . ' ' . $per->apellidos ?>
				</span>
				
				<a class="jefe-icon"
				title="Designar como supervisor"
				href="index.php?controller=personal&action=set_jefe&grupo_id=<?= $grupo->id ?>&id=<?= $per->id ?>">
					<i class="far fa-user-circle"></i>
				</a>
			</div>
		<?php endif; ?>
		<?php endwhile; ?>
	<?php endif; ?>

		</section>
	</article>

	<?php endwhile; ?>
<?php endif; ?>

	</main>

</div>