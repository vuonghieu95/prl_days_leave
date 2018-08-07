<?php session_start();?><?php
include_once('header.php');
//include_once('sidenav.php');

require_once('../controllers/PostController.php');
$postController = new PostController();
$data= $postController->getPost();
?>

<html >
<table>
    <tr>
        <th>Avatar</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Position</th>
        <th>Work_start_date
        <th>Action</th>
    </tr>
    <?php foreach ($data as $row):?>
    <tr>
        <td class="avatar">
            <img src="<?php echo $row['avatar'] ?>" width="30" alt=""></td>
        <td class="username"><?php echo $row['name'] ?></td>
        <td class="email"><?php echo $row['email'] ?></td>
        <td class="phone"><?php echo $row['phone'] ?></td>
        <td class="position"><?php echo $row['position'] ?></td>
        <td>20-16-2028</td>
        <td>
            <a href="edit.php?id=<?php echo $row['id']?>"><i class="fa fa-edit" style="font-size:24px"></i></a>
            <?php if ($_SESSION['login'] != $row['email']){?>
            <a href="delete.php?id=<?php echo $row['id']?>"><i class="fa fa-trash" style="font-size:24px"></i></a>
            <?php }?>
        </td>
    </tr>
    <?php endforeach;?>
</table>
</html>

