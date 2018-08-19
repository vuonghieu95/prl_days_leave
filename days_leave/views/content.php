<?php
session_start();
if (!isset($_SESSION['login'])){
    header('Location: ../index.php');
}
include_once('layouts/html.php');
require_once('../controllers/PostController.php');
$postController = new PostController();
$data=$postController->getPost();
?>

<link rel="stylesheet" href="css/pagination.css">
<link rel="stylesheet" href="css/content.css">

<div class="div" style="width: 100%;height: 100px">
    <?php include_once('layouts/header.php') ?>
</div>
<div class="side-bar" style="float: left;">
    <?php include_once('layouts/sidenav.php') ?>
</div>

<h1> TEAM <?php ?></h1>
<div class="content">
    <?php if ($check_role_type == 2 || $check_role_type == 3) { ?>
    <a href="create.php">
        <button class="button" style="background:#4CAF50;border-radius: 10px; padding: 5px 10px; font-size: 20px">Create</button>
    </a>
<?php }?>
    <form role="search" action="content.php?action=search" style="float: right;" method="get">
        <input type="hidden" value="<?php echo $_GET['team']?>" name="team" />
        <input type="text" value="<?php echo(isset($_GET['key']) ? $_GET['key'] : '') ?>" name="key" placeholder="Search...">
        <button type="submit" id="search_submit" class="search">search</button>
    </form>
    <table id="customers" >
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
                <td class="work_start_date"><?php echo $row['work_start_date']?></td>
                <td>
                    <a href="info.php?id=<?php echo $row['id'] ?>"><i class="fa fa-address-book-o"
                                                                      style="background:#4caf5021;border-radius: 10px; padding: 5px 10px; font-size: 20px"></i></a>
                    <?php if ($check_role_type == 2 || $check_role_type == 3 || $_SESSION['login'] == $row['email']) { ?>
                    <a href="edit.php?id=<?php echo $row['id'] ?>"><i class="fa fa-edit" style="background:#4caf5021;border-radius: 10px; padding: 5px 10px; font-size: 20px"></i></a>
                    <?php }?>
                    <?php if ($check_role_type == 2 || $check_role_type == 3) { ?>
                        <a href="delete.php?id=<?php echo $row['id'] ?>"><i class="fa fa-trash" onclick="return  confirm('Are you sure you want to delete this item?');"
                                                                            style="background:#4caf5021;border-radius: 10px; padding: 5px 10px; font-size: 20px"></i></a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <?php
    include_once ('../helper/Helper.php');
    include_once ('../model/pagination_team.php');
    include_once ('pagination.php');
    ?>


