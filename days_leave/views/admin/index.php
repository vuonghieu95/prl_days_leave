<?php
include_once(getRootPath('views/layouts/html.php'));
?>
<div class="div" style="width: 100%;height: 100px">
    <?php include_once(getRootPath('views/layouts/header.php')) ?>
</div>
<div class="header-main" style="float: right">
    <div class="container">
        <?php

        if (empty($_SESSION['login'])) {
            session_destroy();
            return $this->redirect(['controller' => 'login', 'action' => 'index']);
        } ?>
        <?php
        $check_role_type = (int)$_SESSION['login']->role_type;
        ?>

        <div class="content-admin">
            <?php if ($check_role_type == 2 || $check_role_type == 3) { ?>
                <a href="<?php echo url('admin', 'addUser') ?>">
                    <button class="button" style="margin-left: 7px " id="create">Create</button>
                </a>
            <?php } ?>
            <div class="dropdown" style="margin-right: 50px">
                <span><button id="position">Position</button></span>
                <div class="dropdown-content">
                    <form action="<?php echo url('admin', 'index') ?>" method="get">
                        <input type="hidden" value="<?php echo(isset($_GET['controller']) ? $_GET['controller'] : '') ?>"
                               name="controller" placeholder="Search...">
                        <input type="hidden" value="<?php echo(isset($_GET['action']) ? $_GET['action'] : '') ?>"
                               name="action" placeholder="Search...">
                        <input type="hidden" value="" name="manager" placeholder="Search...">
                        <button type="submit" id="search_submit" class="search">Manager</button>
                    </form>
                    <form action="?action=search" method="get">
                        <input type="hidden"
                               value="<?php echo(isset($_GET['controller']) ? $_GET['controller'] : '') ?>"
                               name="controller" placeholder="Search...">
                        <input type="hidden" value="<?php echo(isset($_GET['action']) ? $_GET['action'] : '') ?>"
                               name="action" placeholder="Search...">
                        <input type="hidden" value="" name="leader" placeholder="Search...">
                        <button type="submit" id="search_submit" class="search">Leader</button>
                    </form>
                    <form action="?action=search" method="get">
                        <input type="hidden"
                               value="<?php echo(isset($_GET['controller']) ? $_GET['controller'] : '') ?>"
                               name="controller" placeholder="Search...">
                        <input type="hidden" value="<?php echo(isset($_GET['action']) ? $_GET['action'] : '') ?>"
                               name="action" placeholder="Search...">
                        <input type="hidden" value="" name="member" placeholder="Search...">
                        <button type="submit" id="search_submit" class="search">Member</button>
                    </form>

                </div>
            </div>
            <form role="search" action="<?php echo url('admin', 'index') ?>" style="float: right;" method="get">
                <input type="hidden" value="<?php echo(isset($_GET['controller']) ? $_GET['controller'] : '') ?>"
                       name="controller" placeholder="Search...">
                <input type="hidden" value="<?php echo(isset($_GET['action']) ? $_GET['action'] : '') ?>" name="action"
                       placeholder="Search...">
                <input type="text" value="<?php echo(isset($_GET['key']) ? $_GET['key'] : '') ?>" name="key"
                       placeholder="Search...">
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
                                            class="fa fa-address-book-o" style=""></i></a>
                                <?php if ($check_role_type == 2 || $check_role_type == 3 || $_SESSION['login']->email == $row['email']): ?>
                                    <a href="<?php echo url('admin', 'editUser', ['id' => $row['id']]) ?>"><i
                                                class="fa fa-edit" style=""></i></a>
                                <?php endif; ?>
                                <?php if ($check_role_type == 2 || $check_role_type == 3) { ?>
                                    <a href="<?php echo url('admin', 'delUser', ['id' => $row['id']]) ?>"><i
                                                class="fa fa-trash" id="delete"
                                                onclick="return  confirm('Are you sure you want to delete this item?');"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>

            <?php
            include_once(getRootPath('models/pagination/pagination.php'));
            include_once(getRootPath('views/pagination.php')) ?>
        </div>
    </div>
</div>
<div class="side-bar" style="float: left;">
    <?php include_once(getRootPath('views/layouts/sidenav.php')) ?>
</div>

</body>