<?php $fecha = date("Y/m/d"); ?>

<nav class="nav-bar">
	<div class="date-range">
		<label for="init-date">Mostrar tareas desde:</label>
		<input type="date" name="init-date" value="<?= $fecha ?>" />
		<label for="finish-date">hasta</label>
		<input type="date" name="finish-date" />
	</div>
<!--
	<form class="search-form" action="" method="POST">
			<input type="submit" value="Buscar" />
			<input type="search" name="search" placeholder="Introduce un criterio" />
	</form>
-->
</nav>