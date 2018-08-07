<?php
/**
 * Created by PhpStorm.
 * User: hieu
 * Date: 07/08/2018
 * Time: 16:30
 */
require_once('../controllers/PostController.php');
$postController = new PostController();
$postController->editController();
header('Location:admin.php');