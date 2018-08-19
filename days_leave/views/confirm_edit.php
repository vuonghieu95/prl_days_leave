<?php session_start();
if (!isset($_SESSION['login'])){
    header('Location: ../index.php');
}

include_once('layouts/html.php');
require_once('../helper/Helper.php');
$team = getConfig('team');
$team = array_flip($team);
$role_type = getConfig('role_type');
$role_type = array_flip($role_type);
$position = getConfig('position');
$position = array_flip($position);

?>
<link rel="stylesheet" href="css/confirm.css">
<div class="div" style="width: 100%;height: 100px">
    <?php include_once('layouts/header.php') ?>
</div>
<div class="header-main" style="float: right">

    <div class="container">
        <div class="content_admin"
             style="margin-left: 140px; width: 400px; border-radius: 10px; border: 1px solid black; padding: 10px">

            <label for="">Avatar: </label>
            <img src="<?php echo $_SESSION['edit']['avatar'] ?>" alt="" width="50px"><br>
            <label for="">Username: </label>
            <span><?php echo $_SESSION['edit']['name'] ?></span><br>
            <label for="">Email: </label>
            <span><?php echo $_SESSION['edit']['email'] ?></span><br>
            <label for="">Phone: </label>
            <span><?php echo $_SESSION['edit']['phone'] ?></span><br>
            <label for="">Work start date: </label>
            <span><?php echo $_SESSION['edit']['work_start_date'] ?></span><br>
            <label for="">Role_type: </label>
            <span><?php echo $role_type[$_SESSION['edit']['role_type']] ?></span><br>
            <label for="">Team: </label>
            <a href="content.php?team=<?php echo $_SESSION['edit']['team'] ?>"><?php echo $team[$_SESSION['edit']['team']] ?></a><br>
            <label for="">Position: </label>
            <?php echo $position[$_SESSION['edit']['position']] ?><br>
        </div>
        <div class="message" style="width: 500px !important; height: 100%; text-align: center">
            <h4 style="margin-left: 170px">Are you sure you want to edit this item?</h4>
            <a href="confirm_edit_process.php">
                <button id="btn-yes" type="submit">Yes
                </button>
            </a>
            <a href='javascript: history.go(-1)'>
                <button id="btn-cancel" type="button" style="" class="cancelbtn">Cancel
                </button>
            </a>
        </div>


    </div>
</div>
<div class="side-bar" style="float: left;">
    <?php include_once('layouts/sidenav.php') ?>
</div>

</body>