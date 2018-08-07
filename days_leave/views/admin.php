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
?>
<link rel="stylesheet" href="css/content.css">


<div class="content" >

    <a href="register.php">
        <button class="button" id="create">Create</button>
    </a>
    <form role="search" action="/" style="float: right;" method="get">
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
                <td>20-16-2028</td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id'] ?>"><i class="fa fa-edit" style="background:#4caf5021;border-radius: 10px; padding: 5px 10px; font-size: 20px"></i></a>
                    <?php if ($_SESSION['login'] != $row['email']) { ?>
                        <a href="delete.php?id=<?php echo $row['id'] ?>"><i class="fa fa-trash"
                                                                            style="background:#4caf5021;border-radius: 10px; padding: 5px 10px; font-size: 20px"></i></a>
                    <?php } ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>



