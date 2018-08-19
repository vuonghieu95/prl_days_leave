<?php
if (empty($_POST["name"])) {
    $nameErr = "Name is required";
} else {
    $name = $_POST["name"];
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $nameErr = "Only letters and white space allowed";
    }
}
if (empty($_POST['password'])) {
    $passErr = "Password is required";
} else {
    $password = md5($_POST['password']);
}
if (empty($_POST["email"])) {
    $emailErr = "Email is required";
} else {
    $email = $_POST["email"];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }
    $sql = "Select users.email from users where users.email = '" . $email . "'";
    $result = $conn->query($sql);
    $count_email = $result->rowCount();
    if ($count_email >= 1) {
        $emailErr = "Email exist";
    }
}
if (empty($_POST["phone"])) {
    $phoneErr = "Phone is required";
} else {
    $phone = $_POST["phone"];
    if (!preg_match('/^\+?([0-9]{1,4})\)?[-. ]?([0-9]{9})$/', $phone)) {
        $phoneErr = 'Please enter a valid phone number';
    }
}
if ($_FILES["avatar"]["type"] != "image/gif" || $_FILES["avatar"]["type"] != "image/jpeg" || $_FILES["avatar"]["type"] != "image/jpg" || $_FILES["avatar"]["type"] != "image/png") {
   $avatarErr = "khong dung dinh dang";
}
$role_type = isset($_POST['role_type']) ? $_POST['role_type'] : '';
$team = isset($_POST['team']) ? $_POST['team'] : '';
$position = isset($_POST['position']) ? $_POST['position'] : '';
?>