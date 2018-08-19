<?php session_start();
if (!isset($_SESSION['login'])){
    header('Location: ../index.php');
}

include_once('layouts/html.php');
?>
<link rel="stylesheet" href="css/content.css">
<div class="div" style="width: 100%;height: 100px">
    <?php include_once('layouts/header.php') ?>
</div>
<div class="side-bar" style="float: left;">
    <?php include_once('layouts/sidenav.php') ?>
</div>
<div class="header-main" style="float: right">

    <div class="container">
      <div class="content-admin " style="text-align: center">

         <?php  echo "Error <br> <a href='javascript: history.go(-1)'>Back</a>";?>
      </div>
    </div>
</div>

</body>
