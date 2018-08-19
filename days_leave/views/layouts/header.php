<?php
$check_role_type = (int)$_SESSION['login']->role_type; ?>
<div class="logo_header">
    <a href="../index.php"> <img src="logo/logo_text.svg" alt="" style="height: 100%;width: 100%" ></a>
</div>
<div class="header">
    <div>
        <a href="info.php?id=<?php echo $_SESSION['login']->id ?>" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <img src="<?php echo $_SESSION['login']->avatar ?>" class="user-image" alt="User Image">
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs"><?php echo $_SESSION['login']->name ?></span>
        </a>
    </div>
    <br><br>
    <div class="home-header">
        <a href="admin.php" style="text-decoration: none; font-weight: bold; color: black">HOME |</a>
        <?php if ($check_role_type == 2 || $check_role_type == 3) { ?>
            <a href="addteam.php" style="text-decoration: none; font-weight: bold; color: black">ADD-TEAM |</a>
        <?php } ?>
        <a href="logout.php" style="text-decoration: none; font-weight: bold; color: black">Sign out</a>
    </div>
</div>

<h1 id="title" style="" >Administrator</h1>
