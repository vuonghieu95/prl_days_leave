<?php session_start();
include_once('html.php');
?>
<link rel="stylesheet" href="css/content.css">

<div class="header-main" style="float: right">
    <?php include_once('header.php') ?>

    <div class="container">
      <div class="content-admin " style="text-align: center">

         <?php  echo "Error <br> <a href='javascript: history.go(-1)'>Trở lại</a>";?>
      </div>
    </div>
</div>
<div class="side-bar" style="float: left;">
    <?php include_once('sidenav.php') ?>
</div>
</body>
