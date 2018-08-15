<?php session_start();
include_once('html.php');
//$postController = new PostController();
//$postController->editController(isset($_POST['id'])?$_POST['id']:'');
?>

<div class="header-main" style="float: right">
    <?php include_once('header.php') ?>

    <div class="container">
        <div class="content_admin" style="margin-left: 140px">
            <label for="">Avatar: </label>
            <span><?php echo $_SESSION['edit']['avatar'] ?></span>
            <label for="">Username: </label>
            <span><?php echo $_SESSION['edit']['name'] ?></span>
            <label for="">Email: </label>
            <span><?php echo $_SESSION['edit']['email'] ?></span>
            <label for="">Phone: </label>
            <span><?php echo $_SESSION['edit']['phone'] ?></span>
            <label for="">Work start date: </label>
            <span><?php echo $_SESSION['edit']['work_start_date'] ?></span>
            <label for="">Role_type: </label>
            <span><?php echo $_SESSION['edit']['role_type'] ?></span>
            <label for="">Team: </label>
            <span><?php echo $_SESSION['edit']['team'] ?></span>
        </div>

    </div>
</div>
<div class="side-bar" style="float: left;">
    <?php include_once('sidenav.php') ?>
</div>

</body>