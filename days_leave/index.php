<?php
session_start();

if (isset($_SESSION['login'])){
    return header('Location: views/admin.php');
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="views/css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<div class="wrapper">
<h2>Login Form</h2>

<form action="views/checklogin.php" method="post">
    <div class="imgcontainer">
        <img src="views/img/user.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
        <label for="uname"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

       <button type="submit" name="btn_submit">Login</button>
        <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
        </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
        <button type="button" class="cancelbtn">Cancel</button>
        <a href="views/register.php">Register</a>
        <span class="psw">Forgot <a href="#">password?</a></span>
    </div>
</form>
</div>

</body>
</html>

