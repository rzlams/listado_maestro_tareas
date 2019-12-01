<?php

function controllers_autoload($classname){
	require_once __DIR__ . '/controllers/' . $classname . '.php';
}

spl_autoload_register('controllers_autoload');

?>