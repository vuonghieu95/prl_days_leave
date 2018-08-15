<?php session_start(); ?><?php

include_once('sidenav.php');
require_once('../controllers/PostController.php');
$postController = new PostController();
$data = $postController->getDays_Leave();
$check_role_type = (int)$_SESSION['login']->role_type;
include_once('html.php');
include_once('header.php');
?>

<link rel="stylesheet" href="css/content.css">
<link rel="stylesheet" href="css/phantrang.css">
<div class="content" >
<h3 style="text-align: center">Lịch nghỉ</h3>
    <a href="create_days_leave.php">
        <button class="button" style="background:#4CAF50;border-radius: 10px; padding: 5px 10px; font-size: 20px">Create</button>
    </a>
    <a href="create_days_leave_member.php">
        Create for another people
    </a>
    <form role="search" action="?action=search" style="float: right;" method="get">
        <input type="text" value="" name="key" placeholder="Search...">
        <button type="submit" id="searchsubmit" name="button" class="search">search</button>
    </form>
    <table id="customers">
        <tr>
            <th>Avatar</th>
            <th>Name</th>
            <th>Days-Leave</th>
            <th>Note</th>
            <th>Action</th>
        </tr>
        <?php foreach ($data as $row): ?>
            <tr>
                <td class="avatar">
                    <img src="<?php echo $row['avatar'] ?>" width="30" alt=""></td>
                <td class="username"><?php echo $row['name'] ?></td>
                <td class="days-leave"><?php echo $row['date_leave'] ?></td>
                <td class="note"><?php echo $row['note'] ?></td>
                <td>
                    <?php if ($check_role_type == 2 || $check_role_type == 3 || $_SESSION['login']->email == $row['email']) { ?>
                    <a href="edit.php?id=<?php echo $row['id'] ?>"><i class="fa fa-edit" style="background:#4caf5021;border-radius: 10px; padding: 5px 10px; font-size: 20px"></i></a>
                    <?php } ?>
                    <?php if ($check_role_type == 2 || $check_role_type == 3 || $_SESSION['login']->email == $row['email']) { ?>
                        <a href="delete.php?id=<?php echo $row['id'] ?>"><i class="fa fa-trash"onclick="return  confirm('Are you sure you want to delete this item?');"
                                                                            style="background:#4caf5021;border-radius: 10px; padding: 5px 10px; font-size: 20px"></i></a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php
    include_once ('../model/pagination_days.php');
    include_once ('pagination/paginate.php')?>
</div>