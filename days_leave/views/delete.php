<?php
/**
 * Created by PhpStorm.
 * User: hieu
 * Date: 07/08/2018
 * Time: 16:46
 */

require_once('../controllers/PostController.php');
$postController = new PostController();
$data =$postController->getResults(isset($_GET['id'])?$_GET['id']:'');
if ($data['id']!= $_GET['id']){
    header('Location: error.php');
}
$postController->delete();
header("Location: {$_SERVER['HTTP_REFERER']}");
?>

