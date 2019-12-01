<?php // require_once 'views/task/navbar.php'; ?>

<?php
	if(isset($_SESSION['success_message'])){
		echo '<br/><div class="message success">' . $_SESSION['success_message'] . '</div><br/>';
		unset($_SESSION['success_message']);
	}

	if(isset($_SESSION['error_message'])){
		echo '<br/><div class="message error">' .
			$_SESSION['error_message'] . '</div><br/>';
		unset($_SESSION['error_message']);
	}
?>

<main class="task-scroll-container">
<main class="tasks-container">

	<section>
		<div class="container-title">Pendientes</div>
	<?php $tareas = Utils::getTask(); ?>
	<?php while($task = $tareas->fetch_object()): ?>
		<?php if($task->status == "pendiente"): ?>

			<?php require 'views/task/task.php'; ?>

		<?php endif; ?>
	<?php endwhile; ?>
	</section>


	<section>
		<div class="container-title">En Proceso</div>
	<?php $tareas = Utils::getTask(); ?>
	<?php while($task = $tareas->fetch_object()): ?>
		<?php if($task->status == "en proceso"): ?>

			<?php require 'views/task/task.php'; ?>

		<?php endif; ?>
	<?php endwhile; ?>
	</section>	


	<section>
		<div class="container-title">Finalizadas</div>
	<?php $tareas = Utils::getTask(); ?>
	<?php while($task = $tareas->fetch_object()): ?>
		<?php if($task->status == "finalizado"): ?>

			<?php require 'views/task/task.php'; ?>

		<?php endif; ?>
	<?php endwhile; ?>
	</section>

</main>
</main>
<?php // require_once 'views/layout/footer.php'; ?>