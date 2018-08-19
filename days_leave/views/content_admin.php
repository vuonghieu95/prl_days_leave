<?php
if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
} ?>

<?php
include_once('layouts/header.php');
require_once('../controllers/PostController.php');
$postController = new PostController();
$data = $postController->getPostAll();
$check_role_type = (int)$_SESSION['login']->role_type;
?>

<link rel="stylesheet" href="css/sidebar.css">
<link rel="stylesheet" href="css/content.css">
<link rel="stylesheet" href="css/pagination.css">
<div class="content-admin">
    <?php if ($check_role_type == 2 || $check_role_type == 3) { ?>
        <a href="create.php">
            <button class="button" style="margin-left: 7px " id="create">Create</button>
        </a>
    <?php } ?>
    <div class="dropdown" style="margin-right: 50px">
        <span><button id="position">Position</button></span>
        <div class="dropdown-content">
            <form action="?action=search" method="get">
                <input type="hidden" value="" name="manager" placeholder="Search...">
                <button type="submit" id="search_submit" class="search">Manager</button>
            </form>
            <form action="?action=search" method="get">
                <input type="hidden" value="" name="leader" placeholder="Search...">
                <button type="submit" id="search_submit" class="search">Leader</button>
            </form>
            <form action="?action=search" method="get">
                <input type="hidden" value="" name="member" placeholder="Search...">
                <button type="submit" id="search_submit" class="search">Member</button>
            </form>

        </div>
    </div>
    <form role="search" action="?action=search" style="float: right;" method="get">
        <input type="text" value="<?php echo(isset($_GET['key']) ? $_GET['key'] : '') ?>" name="key" placeholder="Search...">
        <button type="submit" id="search_submit" class="search">search</button>
    </form>
    <table id="customers" class="table">
        <tr>
            <th>Avatar</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Position</th>
            <th>Work start date
            <th>Action</th>
        </tr>
        <?php foreach ($data as $row): ?>

            <tr>
                <td class="avatar">
                    <img src="<?php echo $row['avatar'] ?>" width="30" alt=""></td>
                <td class="username"><?php echo $row['name'] ?></td>
                <td class="email"><?php echo $row['email'] ?></td>
                <td class="phone"><?php echo $row['phone'] ?></td>
                <td class="position"><?php echo $row['position'] ?></td>
                <td class="work_start_date"><?php echo $row['work_start_date'] ?></td>
                <td>
                    <a href="info.php?id=<?php echo $row['id'] ?>"><i class="fa fa-address-book-o" style=""></i></a>
                    <?php if ($check_role_type == 2 || $check_role_type == 3 || $_SESSION['login']->email == $row['email']) { ?>
                        <a href="edit.php?id=<?php echo $row['id'] ?>"><i class="fa fa-edit" style=""></i></a>
                    <?php } ?>
                    <?php if ($check_role_type == 2 || $check_role_type == 3) { ?>
                        <a href="delete.php?id=<?php echo $row['id'] ?>"><i class="fa fa-trash" id="delete"
                                                                            onclick="return  confirm('Are you sure you want to delete this item?');"></i></a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php
    include_once ('../helper/Helper.php');
    include_once('../model/pagination.php');
    include_once('pagination.php') ?>
</div>