<?php
//
//if (!isset($_SESSION['login'])){
//    header('Location: ../index.php');
//}
include_once(getRootPath('views/layouts/html.php'));
?>
<div class="div" style="width: 100%;height: 100px">
    <?php include_once(getRootPath('views/layouts/header.php')) ?>
</div>
<div class="side-bar" style="float: left;">
    <?php include_once(getRootPath('views/layouts/sidenav.php')) ?>
</div>
<div class="container">
    <?php
    if (empty($_SESSION['login'])) {
        session_destroy();
        return $this->redirect(['controller' => 'login', 'action' => 'index']);
    } ?>
    <?php
    $check_role_type = (int)$_SESSION['login']->role_type;
    ?>

    <h1 style="text-align: center"> TEAM </h1>
    <div class="content" style="margin-left: 330px">
        <form role="search" action="<?php echo url('admin', 'index') ?>" style="float: right;" method="get">
            <input type="hidden" value="<?php echo $_GET['team'] ?>" name="team"/>
            <input type="hidden" value="<?php echo(isset($_GET['controller']) ? $_GET['controller'] : '') ?>"
                   name="controller" placeholder="Search...">
            <input type="hidden" value="<?php echo(isset($_GET['action']) ? $_GET['action'] : '') ?>" name="action"
                   placeholder="Search...">
            <input type="text" value="<?php echo(isset($_GET['key']) ? $_GET['key'] : '') ?>" name="key"
                   placeholder="Search...">
            <button type="submit" id="search_submit" class="search">search</button>
        </form>
        <table id="customers">
            <tr>
                <th>Avatar</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Position</th>
                <th>Work start date
                <th>Action</th>
            </tr>
            <?php if (isset($data)) : ?>
                <?php foreach ($data['data'] as $row): ?>
                    <tr>
                        <td class="avatar">
                            <img src="<?php echo $row['avatar'] ?>" width="30" alt=""></td>
                        <td class="username"><?php echo $row['name'] ?></td>
                        <td class="email"><?php echo $row['email'] ?></td>
                        <td class="phone"><?php echo $row['phone'] ?></td>
                        <td class="position"><?php echo $row['position'] ?></td>
                        <td class="work_start_date"><?php echo $row['work_start_date'] ?></td>
                        <td>
                            <a href="<?php echo url('admin', 'info', ['id' => $row['id']]) ?>"><i
                                        class="fa fa-address-book-o"
                                        style="background:#4caf5021;border-radius: 10px; padding: 5px 10px; font-size: 20px"></i></a>
                            <?php if ($check_role_type == 2 || $check_role_type == 3 || $_SESSION['login'] == $row['email']) { ?>
                                <a href="<?php echo url('admin', 'editUser', ['id' => $row['id']]) ?>"><i
                                            class="fa fa-edit"
                                            style="background:#4caf5021;border-radius: 10px; padding: 5px 10px; font-size: 20px"></i></a>
                            <?php } ?>
                            <?php if ($check_role_type == 2 || $check_role_type == 3) { ?>
                                <a href="<?php echo url('admin', 'delUser', ['id' => $row['id']]) ?>"><i
                                            class="fa fa-trash"
                                            onclick="return  confirm('Are you sure you want to delete this item?');"
                                            style="background:#4caf5021;border-radius: 10px; padding: 5px 10px; font-size: 20px"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
        <?php include_once(getRootPath('models/pagination/pagination.php'));
        include_once(getRootPath('views/pagination.php')) ?>
    </div>
</div>
</body>