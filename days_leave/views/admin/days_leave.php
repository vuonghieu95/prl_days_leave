<?php include_once(getRootPath('views/layouts/html.php')); ?>
<link rel="stylesheet" href="<?php echo getPublicUrl('css/content.css') ?>">
<link rel="stylesheet" href="<?php echo getPublicUrl('css/pagination.css') ?>">
<div class="div" style="width: 100%;height: 100px">
    <?php include_once(getRootPath('views/layouts/header.php')) ?>
</div>
<div class="side-bar" style="float: left;">
    <?php include_once(getRootPath('views/layouts/sidenav.php')) ?>
</div>
<div class="content" style="margin-left: 350px">
    <h3 style="text-align: center; font-weight: bold;color: black;">Days Leave</h3>

    <a href="<?php echo url('daysleave', 'addDaysLeave') ?>">
        <button class="button" style="background:#4CAF50;border-radius: 10px; padding: 5px 10px; font-size: 20px">
            Create
        </button>
    </a>
    <form role="search" action="?action=search" style="float: right;" method="get">
        <input type="hidden" value="<?php echo(isset($_GET['controller']) ? $_GET['controller'] : '') ?>"
               name="controller" placeholder="Search...">
        <input type="hidden" value="<?php echo(isset($_GET['action']) ? $_GET['action'] : '') ?>"
               name="action" placeholder="Search...">
        <input type="text" value="" name="key" placeholder="Search...">
        <button type="submit" id="search_submit" name="button" class="search">search</button>
    </form>
    <table id="customers">
        <tr>
            <th>Avatar</th>
            <th>Name</th>
            <th>Days Leave</th>
            <th>To Date</th>
            <th>Note</th>
            <th>Action</th>

            <?php if (isset($data)) : ?>
            <?php foreach ($data['data'] as $row): ?>
        <tr>
            <td class="avatar">
                <img src="<?php echo $row['avatar'] ?>" width="30" alt=""></td>
            <td class="username"><?php echo $row['name'] ?></td>

            <td class="days-leave"><?php echo $row['date_leave'] ?></td>
            <td class="to_date"><?php echo !empty(strtotime($row['to_date'])) ? $row['to_date'] : "" ?></td>
            <td class="note"><?php echo $row['note'] ?></td>
            <td>
                <?php if ($check_role_type == 2 || $check_role_type == 3 || $_SESSION['login']->email == $row['email']) { ?>
                    <a href="<?php echo url('daysLeave', 'deleteDaysLeave', ['id' => $row['id']]) ?>"><i
                                class="fa fa-trash"
                                onclick="return  confirm('Are you sure you want to delete this item?');"
                                style="background:#4caf5021;border-radius: 10px; padding: 5px 10px; font-size: 20px"></i></a>
                <?php } ?>
            </td>
        </tr>
        <?php endforeach; ?>
        <?php endif; ?>
    </table>

    <?php
    include_once(getRootPath('models/pagination_days.php'));
    include_once(getRootPath('views/pagination.php')) ?>
</div>