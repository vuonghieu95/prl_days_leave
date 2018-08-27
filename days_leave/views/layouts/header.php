<?php

if (empty($_SESSION['login'])) {
    session_destroy();
    return $this->redirect(['controller' => 'login', 'action' => 'index']);
} ?>
<?php
$check_role_type = (int)$_SESSION['login']->role_type; ?>
<div class="logo_header">
    <a href="<?php echo url('admin','index')?>"> <img src="../../views/logo/logo_text.svg" alt="" style="height: 100%;width: 100%" ></a>
</div>
<div class="header">
    <div>
        <a href="<?php echo url('admin','info',['id'=>$_SESSION['login']->id]) ?>" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="<?php echo $_SESSION['login']->avatar ?>" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs"><?php echo $_SESSION['login']->name ?></span>
        </a>
    </div>
    <br><br>
    <div class="home-header">
        <a href="<?php echo url('admin','index')?>" style="text-decoration: none; font-weight: bold; color: black">HOME |</a>
        <?php if ($check_role_type == 2 || $check_role_type == 3) { ?>
            <a href="<?php echo url('admin','addTeam')?>" style="text-decoration: none; font-weight: bold; color: black">ADD-TEAM |</a>
        <?php } ?>
        <a href="<?php echo url('login','logout')?>"onclick="return  confirm('Are you sure you want to sign out?');" style="text-decoration: none; font-weight: bold; color: black">Sign out</a>
    </div>
</div>

<h1 id="title" style="" >Administrator</h1>

