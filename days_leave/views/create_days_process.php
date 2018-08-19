<?php
/**
 * Created by PhpStorm.
 * User: hieu
 * Date: 09/08/2018
 * Time: 17:06
 */
session_start();
$name = $_SESSION['login']->name;
$date_leave = $_POST['work_start_date'];
$to_date = $_POST['to_date'];
$note = $_POST['description'];
if (empty($name)|| empty($date_leave) || empty($note)){
    echo "Please fill full info in this form . <a href='javascript: history.go(-1)'>Back</a>";
    exit;
}else {
    require_once ('../controllers/PostController.php');
    $postController = new PostController();
    $postController ->addDaysleave();
    header("Location: days_leave.php");
}