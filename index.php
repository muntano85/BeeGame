<?php
include 'BeeModel.php';
include 'BeeView.php';
include 'BeeController.php';
 
session_start();
if(!isset($_SESSION['hive'])){
	$_SESSION['hive'] = BeeModel::createRandomHive();
}
$controller = new BeeController($_SESSION['hive']);
$view = new BeeView($controller, $_SESSION['hive']);

if(isset($_GET['action']) && !empty($_GET['action'])){
	$controller = $controller->$_GET['action']();
}
echo $view->output();