<?php
/**
 * Created by PhpStorm.
 * User: hieu
 * Date: 03/08/2018
 * Time: 11:27
 */
$name = isset($_POST["name"]) ? $_POST["name"] : '';
$description = $_POST["description"];

if (empty($name) || empty($description) ) {
    echo "Vui lòng nhập đầy đủ thông tin. <a href='javascript: history.go(-1)'>Trở lại</a>";
    exit;
} else {
    require_once('../controllers/PostController.php');

    $target_dir = "logo/";  // thư mục chứa file upload

    $target_file = $target_dir . basename($_FILES["logo"]["name"]); // link sẽ upload file lên

    if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) { // nếu upload file không có lỗi
        echo "The file " . basename($_FILES["logo"]["name"]) . " has been uploaded.";
    } else { // Upload file có lỗi
        echo "Sorry, there was an error uploading your file.";
    }
    $postController = new PostController();
    $postController->addTeam();
    header("Location: {$_SERVER['HTTP_REFERER']}");

}
