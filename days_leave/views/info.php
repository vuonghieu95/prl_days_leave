<?php session_start();
include_once('html.php');
require_once('../controllers/PostController.php');
$postController = new PostController();
$data = $postController->getResults(isset($_GET['id'])?$_GET['id']:'');
if ($data['id']!= $_GET['id']){
    header('Location: error.php');
}
?>
<link rel="stylesheet" href="css/info.css">
<div class="header-main" style="float: right">
    <?php include_once('header.php') ?>

    <div class="container" >
        <div class="row">
            <h1 style="padding-left: 30px">USER DETAIL</h1>
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
<div class="side-bar" style="float: left;">
    <?php include_once('sidenav.php') ?>
</div>
</body>
