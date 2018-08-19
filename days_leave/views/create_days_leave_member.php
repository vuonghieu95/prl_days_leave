<?php session_start();
if (!isset($_SESSION['login'])){
    header('Location: ../index.php');
}

include_once ('layouts/html.php');
?>
<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="screen"
      href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
<div class="div" style="width: 100%;height: 100px">
    <?php include_once('layouts/header.php') ?>
</div>
<div class="side-bar" style="float: left;">
    <?php include_once('layouts/sidenav.php') ?>
</div>
<form action="create_days_member_process.php" method="Post" enctype="multipart/form-data" style="border:1px solid #ccc">
    <div class="container" style="text-align: center ; width: 400px !important;margin-left: 500px !important;">
        <h1>Register</h1>
        <hr>
        <label for="name"><b>Name</b></label>
        <a href="select_name.php"><input type="text" name="name"></a>
        <label for="work_start"><b>Date_leave</b></label>
        <div id="datetimepicker" class="input">
            <input class="add-on" autocomplete="off" type="text" name="work_start_date" style="text-align: center"/>
        </div>
        <label for="to date"><b>To Date</b></label>
        <div id="datetimepicker1" class="input">
            <input class="add-on" autocomplete="off" type="text" name="to_date" style="text-align: center"/>
        </div>
        <label for="description"><b>Description</b></label>
        <textarea class="description" name="description" rows="5" id="comment" required></textarea>
        <div class="clear-fix">
            <button type="submit" class="signupbtn">Add</button>

            <a href='javascript: history.go(-1)'>
                <button type="button" class="cancelbtn">Cancel</button>
            </a>
        </div>
    </div>
</form>
</body>
</html>
<script type="text/javascript"
        src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js">
</script>
<script type="text/javascript"
        src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
</script>
<script type="text/javascript">
    $('#datetimepicker').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss',
        language: 'pt-BR'
    });
</script>
<script type="text/javascript">
    $('#datetimepicker1').datetimepicker({
        format: 'yyyy-MM-dd hh:mm:ss',
        language: 'pt-BR'
    });
</script>