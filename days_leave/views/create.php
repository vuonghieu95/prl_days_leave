<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
}
include_once('layouts/html.php');
require_once('../model/PostModel.php');
require_once('../controllers/PostController.php');
$postController = new PostController();
$team = $postController->getTeam();
$postModel = new PostModel();
$conn = $postModel->connect();
?>
<?php

$ins_id = $_SESSION['login']->id;
$nameErr = $emailErr = $phoneErr = $avatarErr='';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once('../validation/validate.php');
    if (empty($email) || empty($phone) || empty($name) || !empty($nameErr) || !empty($phoneErr) || !empty($emailErr) || !empty($avatarErr)) {

        if (isset($_FILES['avatar']['name'])) {
            if ($_FILES["avatar"]["type"] == "image/gif" || $_FILES["avatar"]["type"] == "image/jpeg" || $_FILES["avatar"]["type"] == "image/jpg" || $_FILES["avatar"]["type"] == "image/png") {
                $avatar = ('/views/tmp_img/' . $_FILES['avatar']['name']);
                $target_dir = "tmp_img/";
                $target_file = $target_dir . basename($avatar);
                if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                    $_SESSION['tmp_avatar'] = $avatar;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }else {
                $avatarErr = "failed";
            }
        } else {
            $avatar = '';
        }
    } else {
        require_once('../controllers/PostController.php');
        if (isset($_FILES['avatar']['name'])) {

            if ($_FILES["avatar"]["type"] != "image/gif" || $_FILES["avatar"]["type"] != "image/jpeg" ||
                $_FILES["avatar"]["type"] != "image/jpg" || $_FILES["avatar"]["type"] != "image/png") {

                $avatarErr = "failed";
            }else {
                $target_dir = "img/";

                $target_file = $target_dir . basename($_FILES["avatar"]["name"]);

                if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
                    echo "The file " . basename($_FILES["avatar"]["name"]) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        } elseif (isset($_SESSION['tmp_avatar'])) {
            $target_dir = "img/";

            $target_file = $target_dir . basename($_SESSION['tmp_avatar']);
            if (move_uploaded_file($_SESSION['tmp_avatar'], $target_file)) {
                echo "The file " . basename($_SESSION['tmp_avatar']) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        $postController = new PostController();
        $postController->addUser();
        header('Location:admin.php');
    }
}
?>
    <link rel="stylesheet" href="css/register.css">
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen"
          href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
    <div class="div" style="width: 100%;height: 100px">
        <?php include_once('layouts/header.php') ?>
    </div>
    <div class="side-bar" style="float: left;">
        <?php include_once('layouts/sidenav.php') ?>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="Post" enctype="multipart/form-data"
          style=" width: 700px !important; margin-left: 500px   ">
        <div class="container" style="width: 800px">
            <h1>Create-User</h1>
            <p>Please fill in this form to create an account.</p>
            <hr>
            <div class="div_trai" style="float: left; width: 45%">
                <label for="name"><b>Username</b></label>
                <input type="text" placeholder="Enter Username" name="name"
                       value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
                <span style="color: red;" class="error"> <?php echo $nameErr; ?></span>
                <label for="psw"><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="password" required>

                <label for="email"><b>Email</b></label>
                <input type="text" placeholder="Enter Email" name="email"
                       value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                <span style="color: red;" class="error"> <?php echo $emailErr; ?></span>

                <label for="avatar"><b>Avatar</b></label>
                <img src="<?php echo isset($avatar) ? $avatar : '' ?>" width="30" alt="">
                <input type="file" placeholder="Enter Avatar" name="avatar" value="">
                <span style="color: red;" class="error"> <?php echo $avatarErr; ?></span>
                <input type="hidden" name="tmp_avatar" value="<?php echo isset($avatar) ? $avatar : '' ?>">
                <label for="phone"><b>Phone</b></label>
                <input type="text" placeholder="Enter Phone" name="phone"
                       value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>">
                <span style="color: red;" class="error"><?php echo $phoneErr; ?></span>
            </div>

            <div class="div_phai" style="float: right; width: 45%;">
                <label for="work_start"><b>Work start date</b></label>
                <div id="datetimepicker" class="input">
                    <input class="add-on" autocomplete="off" type="text" name="work_start_date"
                           style="text-align: center"/>
                </div>

                <label for="role_type"><b>Role_Type</b></label><br>
                <tr>
                    <td>
                        <input checked type="radio" name="role_type" value="1"> Member
                        <input type="radio" name="role_type" value="2"> Admin
                        <input type="radio" name="role_type" value="3"> Leader <br><br>
                    </td>
                </tr>
                <label for="team"><b>Team</b></label>
                <tr>

                    <td style="border: 1px solid black">
                        <?php foreach ($team as $row): ?>
                            <input checked type="radio" name="team"
                                   value="<?php echo $row['id'] ?>"><?php echo " " . $row['name'] ?>
                        <?php endforeach; ?>
                    </td>

                </tr>
                <br><br>
                <label for="position"><b>Position</b></label>
                <tr>
                    <td>
                    <td style="border: 1px solid black">

                        <input checked type="radio" name="position" value="1"> member
                        <input type="radio" name="position" value="2"> leader
                        <input type="radio" name="position" value="3"> manager<br><br>

                    </td>
                    </td>
                </tr>
            </div>

            <div class="clear-fix">
                <button type="submit" class="signupbtn">Create</button>
                <a href='javascript: history.go(-1)'>
                    <button type="button" class="cancelbtn">Cancel</button>
                </a>
            </div>
        </div>
    </form>

<?php include_once('layouts/footer.php'); ?>