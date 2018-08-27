<?php
session_start();
include_once('helper/Helper.php');
$controllerName = !empty($_GET['controller']) ? $_GET['controller'] : 'login';
$actionName = !empty($_GET['action']) ? $_GET['action'] : 'index';
$controllerName = ucfirst($controllerName);
$controllerName .= 'Controller';

include_once 'controllers/'. $controllerName .'.php';
$controller = new $controllerName();
if (!method_exists($controller, $actionName)) {
    redirect('notFound', 'index');
} else {
    // Show view from controller
   $controller->$actionName();
}

