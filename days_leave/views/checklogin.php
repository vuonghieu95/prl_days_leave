<?php
/**
 *
 */
session_start();
require_once('../model/PostModel.php');
if (isset($_POST['btn_submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $connect = new PostModel();
    $conn = $connect->connect();
    $sql = "Select email,password from users where email = '".$email."' and password = '".$password."' and users.del_flag=0 ";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if ($result) {
            $_SESSION['login'] = $email;
            return header('location:admin.php');
        } else {
            header('location:../index.php');
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
    header('location:../index.php');


}
