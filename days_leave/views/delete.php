<?php
/**
 * Created by PhpStorm.
 * User: hieu
 * Date: 07/08/2018
 * Time: 16:46
 */

require_once('../controllers/PostController.php');
$postController = new PostController();
$postController->delete();
header('Location: admin.php'); ?>

