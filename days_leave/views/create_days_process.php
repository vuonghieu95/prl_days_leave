<?php
/**
 * Created by PhpStorm.
 * User: hieu
 * Date: 09/08/2018
 * Time: 17:06
 */
$name = $_SESSION['login']->name;
$date_leave = $_POST['work_start_date'];
$note = $_POST['description'];

if (empty($name)|| empty($date_leave) || empty($note)){
    echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
}else {
    require_once ('../controllers/PostController.php');
    $postController = new PostController();
    $postController ->addDays_leave();
header('Location:admin.php');
}