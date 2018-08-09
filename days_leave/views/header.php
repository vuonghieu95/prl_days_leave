<?php $check_role_type = (int)$_SESSION['login']->role_type;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administrator</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" media="screen"
          href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
</head>
<body>
<div class="" style="float: right;">
    <a href="admin.php" style="text-decoration: none">HOME  |</a>
    <?php if ($check_role_type == 2 || $check_role_type == 3) { ?>
        <a href="addteam.php" style="text-decoration: none">ADD-TEAM|</a>
    <?php } ?>
    <a href="logout.php" style="text-decoration: none">Sign out</a>
</div>
<h1>Administrator</h1>

