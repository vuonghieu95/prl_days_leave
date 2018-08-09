<?php
/**
 * Created by PhpStorm.
 * User: hieu
 * Date: 03/08/2018
 * Time: 11:27
 */
$name = isset($_POST["name"]) ? $_POST["name"] : '';
$password = $_POST["password"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$roletype = $_POST['roletype'];
$team = $_POST['team'];
$position = $_POST['position'];


if (empty($name) || empty($password) || empty($email) || empty($phone) || empty($position)) {
    echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
} else {
    require_once('../controllers/PostController.php');

    $target_dir = "img/";  // thư mục chứa file upload

    $target_file = $target_dir . basename($_FILES["avatar"]["name"]); // link sẽ upload file lên

    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) { // nếu upload file không có lỗi
        echo "The file " . basename($_FILES["avatar"]["name"]) . " has been uploaded.";
    } else { // Upload file có lỗi
        echo "Sorry, there was an error uploading your file.";
    }

    $postController = new PostController();
    $postController->addUser();
    header('Location:admin.php');
}
