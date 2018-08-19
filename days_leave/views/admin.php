<?php session_start();

if (!isset($_SESSION['login'])){
    header('Location: ../index.php');
}

include_once('layouts/html.php');
?>
<div class="div" style="width: 100%;height: 100px">
    <?php include_once('layouts/header.php') ?>
</div>
<div class="header-main" style="float: right">
    <div class="container">
        <?php include_once('content_admin.php') ?>
    </div>
</div>
<div class="side-bar" style="float: left;">
    <?php include_once('layouts/sidenav.php') ?>
</div>

</body>