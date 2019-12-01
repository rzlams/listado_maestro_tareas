<h1 class="title">Crear Actividad</h1>

<main class="container center">
<form action="index.php?controller=actividad&action=save" method="POST" enctype="multipart/form-data">

	<div class="form-group">
		<label class="label" for="nombre">Nombre:</label>
		<input class="input" type="text" name="nombre" id="nombre" required />
	</div>

	<div class="form-group">
		<label class="label" for="descripcion">Descripcion:</label>
		<textarea class="input" name="descripcion" id="descripcion" rows="5" required></textarea>
	</div>

	<button class="button guardar">Guardar</button>
</form>
</main>