<!DOCTYPE html>
<html lang="es">
<head>
	<base href="http://localhost/www/php_projects/Listado_Tareas/">
	<link rel="icon" type="image/png" href="assets/img/favicon.png">
	<link rel="stylesheet" type="text/css" href="assets/css/header.css">
	<link rel="stylesheet" type="text/css" href="assets/css/task.css">
	<link rel="stylesheet" type="text/css" href="assets/css/actividad.css">
	<link rel="stylesheet" type="text/css" href="assets/css/grupo.css">
	<link rel="stylesheet" type="text/css" href="assets/fontawesome/css/all.css">

	<title>Listado Maestro de Tareas</title>
</head>
<body>

<div class="app">
	<header class="header">
		<a href="index.php" class="logo"></a>
		<div class="app-title">Listado Maestro de Tareas</div>
	</header>

	<nav class="side-menu">
		<a class="menu-link" href="index.php?controller=task&action=create">
			CREAR TAREA
		</a>
		<a class="menu-link" href="index.php?controller=actividad&action=gestion">
			ACTIVIDADES
		</a>
		<a class="menu-link" href="index.php?controller=grupo&action=index">GRUPOS</a>
	</nav>
<!--
	<nav class="workgroups">
		<a class="menu-link" href="index.php?controller=grupo&action=index">Editar Grupos</a>
		<span>
			Muestra las tabla de los grupos actuales.
			No permite editar, solo ver
		</span>
	</nav>
-->