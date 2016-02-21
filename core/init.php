<?php
session_start();

//Include config
require_once('config/config.php');

//Helper files
require_once('helpers/system_helper.php');
require_once('helpers/format_helper.php');
require_once('helpers/db_helper.php');


//Autoload classes

 spl_autoload_register(function($class) {
 	if(!file_exists($class)){
	require_once'./classes/'.$class.'.php';
	}
});