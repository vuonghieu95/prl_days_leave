<?php
session_start();
$controllerName = $_GET['controller'];
$actionName = $_GET['action'];

include_once 'controllers/'. ucfirst($controllerName.'Controller.php');

$controller = new IndexController();
$controller->$actionName();

