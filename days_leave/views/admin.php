<?php
/**
 * Created by PhpStorm.
 * User: hieu
 * Date: 06/08/2018
 * Time: 18:14
 */
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
}
?>

<?php
include_once('header.php');
include_once('sidenav.php');
require_once('../controllers/PostController.php');
$postController = new PostController();
$data = $postController->getPostAll();
$check_role_type = (int)$_SESSION['login']->role_type;
?>
<link rel="stylesheet" href="css/content.css">

<div class="content">
    <?php if ($check_role_type == 2 || $check_role_type == 3) { ?>
        <a href="register.php">
            <button class="button" id="create">Create</button>
        </a>
    <?php } ?>
    <form role="search" action="?action=search" style="float: right;" method="get">
        <input type="text" value="" name="key" placeholder="Search...">
        <button type="submit" id="searchsubmit" name="button" class="search">search</button>
    </form>
    <table id="customers">
        <tr>
            <th>Avatar</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Position</th>
            <th>Work_start_date
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
                <td class="work_start_date"><?php echo $row['work_start_date']?></td>
                <td>
                    <?php if ($check_role_type == 2 || $check_role_type == 3 || $_SESSION['login']->email == $row['email']) { ?>
                    <a href="edit.php?id=<?php echo $row['id'] ?>"><i class="fa fa-edit"
                                                                      style="background:#4caf5021;border-radius: 10px; padding: 5px 10px; font-size: 20px"></i></a>
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
    include ('../model/config.php');
    include_once('phantrang.php') ?>
</div>
