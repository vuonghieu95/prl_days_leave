<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
}
include_once('layouts/html.php');
require_once('../controllers/PostController.php');
$postController = new PostController();
$data = $postController->getPostAll();
?>
<div class="div" style="width: 100%;height: 100px">
    <?php include_once('layouts/header.php') ?>
</div>
<div class="side-bar" style="float: left;">
    <?php include_once('layouts/sidenav.php');
   ?>
</div>
<link rel="stylesheet" href="css/content.css">
<link rel="stylesheet" href="css/pagination.css">
<div class="content">
    <h1>Select</h1>
    <form role="search" action="?action=search" style="float: right;" method="get">
        <input type="text" value="<?php echo(isset($_GET['key']) ? $_GET['key'] : '') ?>" name="key"
               placeholder="Search...">
        <button type="submit" id="search_submit" class="search">search</button>
    </form>
    <form action="create_days_leave_member.php" method="post">
        <table id="customers" class="table">
            <tr>
                <th></th>
                <th>Avatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>

            </tr>
            <?php foreach ($data as $row): ?>
                <tr>
                    <td>
                        <label for="">
                            <input type="checkbox" class="check_item" onclick="check(this)">
                        </label>
                    </td>
                    <td class="avatar">
                        <img src="<?php echo $row['avatar'] ?>" width="30" alt=""></td>
                    <td class="username"><?php echo $row['name'] ?></td>
                    <td class="email"><?php echo $row['email'] ?></td>
                    <td class="phone"><?php echo $row['phone'] ?></td>

                </tr>

            <?php endforeach; ?>
        </table>
        <button type="submit">OK</button>

    </form>
    <?php
    include_once('../helper/Helper.php');
    include_once('../model/pagination.php');
    include_once('pagination.php') ?>
</div>
<script>
    function check(input){
        console.log($(input).val())
    }

</script>