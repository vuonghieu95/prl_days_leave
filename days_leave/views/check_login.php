<?php
/**
 *
 */
session_start();
require_once('../helper/Helper.php');
require_once('../model/PostModel.php');
if (isset($_POST['btn_submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $connect = new PostModel();
    $conn = $connect->connect();
    try {
        $sql = "Select * from users where email = :email and password = :password  and users.del_flag=0 ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->bindParam(':password',$password,PDO::PARAM_STR);
        $stmt->execute(array(':email'=> $_REQUEST['email'], ':password'=> $_REQUEST['password']));
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if ($result) {
            if ($_SESSION['login'] = $result) {
                header('location:admin.php');
            }
        } else {
            header('location:../index.php');
        }
    } catch (PDOException $e) {
        $e->getMessage();
    }
    header('location:../index.php');


}
