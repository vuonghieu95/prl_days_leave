<link rel="stylesheet" href="<?php echo getPublicUrl('css/info.css')?>">
<div class="div" style="width: 100%;height: 100px">
    <?php include_once(getRootPath('views/layouts/header.php')) ?>
</div>
<div class="side-bar" style="float: left;">
    <?php include_once(getRootPath('views/layouts/sidenav.php')) ?>
</div>
<?php
include_once(getRootPath('views/layouts/html.php'));
?>
<div class="header-main" style="float: right">
    <h2 style="padding-left: 30px">USER DETAIL</h2>

    <div class="container" >
        <div class="row">
            <div class="detail">
                <?php isset($data['avatar']) ? $data['avatar'] : '' ?>
                <div class="image">
                    <img src="<?php echo $data['avatar'] ?>" class="img-detail" alt="User Image">
                    <p class="name"><?php echo $data['name'] ?></p>
                </div>
                <div class="info-detail">
                    <p class="name-detail"><?php echo"Name: ". $data['name'] ?></p>
                    <p class="name-detail"><?php echo"Email: ". $data['email'] ?></p>
                    <p class="name-detail"><?php echo "Phone: ".$data['phone'] ?></p>
                    <p class="name-detail"><?php echo"Work start: " . $data['work_start_date'] ?></p>
                    <p class="name-detail"><?php echo"Team: ". $data['team'] ?></p>
                    <p class="name-detail"><?php echo"Position: ". $data['position'] ?></p>

                </div>
            </div>

        </div>
    </div>
</div>