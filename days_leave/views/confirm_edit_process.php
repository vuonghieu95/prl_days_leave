<?php
/**
 * Created by PhpStorm.
 * User: hieu
 * Date: 15/08/2018
 * Time: 17:15
 */
session_start();
include_once ('../controllers/PostController.php');
$postController = new PostController();
$postController ->edit($_SESSION['edit']['id']);
var_dump($_GET['key']);die();
header('location: ../index.php');