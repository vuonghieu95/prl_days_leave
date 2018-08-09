<?php
/**
 * Created by PhpStorm.
 * User: hieu
 * Date: 08/08/2018
 * Time: 16:52
 */
include_once ('../controllers/PostController.php');
$postController = new PostController();
$postController->getUserID();
header('Location:admin.php');