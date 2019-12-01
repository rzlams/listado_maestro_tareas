<h1 class="title">Actividades</h1>

<?php
	if(isset($_SESSION['success_message'])){
		echo '<br/><div class="message success">' . $_SESSION['success_message'] . '</div><br/>';
		unset($_SESSION['success_message']);
	}
?>

<main class="container center">

<div class="actividad-scroll-container">

	<form action="index.php?controller=actividad&action=save" method="POST" enctype="multipart/form-data">

		<div class="form-group">
			<label class="label" for="nombre">Nombre:</label>
			<input class="input" type="text" name="nombre" id="nombre" required
		<?php $act = $actividad->fetch_object(); ?>
			value="<?= $act->nombre?>" />
		</div>

		<div class="form-group">
			<label class="label" for="descripcion">Descripcion:</label>
			<textarea class="input" name="descripcion" id="descripcion" rows="5" required><?= $act->descripcion ?></textarea>
		</div>

		<input class="hidden" type="text" name="id" value="<?= $act->id ?>" />
		<button class="button guardar">Guardar</button>
	</form>


		<label class="label">Documentos Asociados:</label>
	<?php $documentos = Utils::getDocumentos($act->id); ?>
	<?php if($documentos): ?>
	<?php while($doc = $documentos->fetch_object()): ?>
<div class="document-group">
	<div class="nombre">
		<?php $filename = Utils::escape_unescape($doc->nombre); ?>
		<?= explode('.', $filename)[1] ?>
	</div>
	<div class="icons">
		<a href="index.php?controller=documento&action=download&nombre=<?= $doc->nombre ?>"><i class="fas fa-file-download"></i></a>
		<a href="index.php?controller=documento&action=delete&id=<?= $doc->actividad_id ?>&nombre=<?= $doc->nombre ?>"><i class="far fa-trash-alt"></i></a>
	</div>
</div>
	<?php endwhile; ?>
	<?php endif; ?>

<?php
	if(isset($_SESSION['upload']) && isset($_SESSION['upload_error'])){
		echo '<br/><div class="message error">' . $_SESSION['upload'] . '</div><br/>';
		echo '<div class="message error">' . $_SESSION['upload_error'] . '</div>';
		unset($_SESSION['upload']);
		unset($_SESSION['upload_error']);
	} elseif(isset($_SESSION['upload'])){
		echo '<br/><div class="message success">' . $_SESSION['upload'] . '</div>';
		unset($_SESSION['upload']);
	}

	if(isset($_SESSION['delete_error'])){
		echo '<br/><div class="message error">' . $_SESSION['delete_error'] . '</div><br/>';
		unset($_SESSION['delete_error']);
	}
?>

	<form class="upload-form" action="index.php?controller=documento&action=upload" method="POST" enctype="multipart/form-data">
		<label class="add" for="documento" title="Agregar Documentos"><i class="fas fa-plus"></i></label>
		<input type="file" name="documento[]" id="documento" class="hidden"  multiple/>
	<!-- <input type="file" name="documento[]" multiple /> -->
		<input class="hidden" type="text" name="actividad_id" value="<?= $act->id ?>" />
		<button class="button upload" title="Subir Documentos" ><i class="fas fa-file-upload"></i></button>
	</form>

</div>
</main>