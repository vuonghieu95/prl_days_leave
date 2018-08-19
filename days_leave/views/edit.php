<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="screen"
      href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
<?php
session_start();
if (!isset($_SESSION['login'])){
    header('Location: ../index.php');
}

include_once('layouts/html.php');
require_once('../model/PostModel.php');
require_once('../controllers/PostController.php');
require_once('../helper/Helper.php');
$postController = new PostController();
$data = $postController->getResults(isset($_GET['id']) ? $_GET['id'] : '');
$upd_id = $_SESSION['login']->id;
$check_role_type = (int)$_SESSION['login']->role_type;
if ($data['id'] != $_GET['id']) {
    header('Location: error.php');
}
$postModel = new PostModel();
$conn = $postModel->connect();
?>
<?php
$ins_id = $_SESSION['login']->id;
$nameErr = $emailErr = $phoneErr = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = $_POST["name"];
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Only letters and white space allowed";
        }
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
        $sql = "Select users.email from users where users.email = '" . $email . "'";
        $result = $conn->query($sql);
        $count_email = $result->rowCount();
        if ($count_email >= 1) {
            $emailErr = "Email exist";
        }
    }
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone is required";
    } else {
        $phone = $_POST["phone"];
        if (!preg_match('/^\+?([0-9]{1,4})\)?[-. ]?([0-9]{9})$/', $phone)) {
            $phoneErr = 'Please enter a valid phone number';
        }
    }
    $role_type = isset($_POST['role_type']) ? $_POST['role_type'] : '';
    $team = isset($_POST['team']) ? $_POST['team'] : '';
    $position = isset($_POST['position']) ? $_POST['position'] : '';

    if (!empty($email) || !empty($phone) || !empty($name) || !isset($nameErr) || !isset($phoneErr) || !empty($emailErr))
    {
        $data = $postController->getResults(isset($_POST['id']) ? $_POST['id'] : '');
        if ($_FILES['avatar']['name'] != null) {
        $avatar = ('/views/img/' . $_FILES['avatar']['name']);
    } else {
        $avatar = $data['avatar'];
    }
    $_SESSION['edit'] = ['id' => $_POST['id'], 'name' => $name, 'email' => $email, 'phone' => $phone,
        'role_type' => $role_type, 'team' => $team, 'avatar' => $avatar, 'position' => $position, 'work_start_date' => $work_start_date = $_POST['work_start_date']];

    header('location:confirm_edit.php?' . 'id=' .  $_POST['id']);
    }
}
?>
<div class="div" style="width: 100%;height: 100px">
    <?php include_once('layouts/header.php') ?>
</div>
<div class="side-bar" style="float: left;">
    <?php include_once('layouts/sidenav.php') ?>
</div>
<link rel="stylesheet" href="css/register.css">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="Post" enctype="multipart/form-data"
      style="border:1px solid #ccc">
    <div class="edit" style="width: 600px; margin-left: 500px;">
        <h1>Edit</h1>
        <hr>
        <div class="div_trai" style="float: left; width: 45%">
            <input type ="hidden" name="id" value="<?php echo $data['id'] ?>" required>
            <label for="name"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="name" value="<?php echo $data['name'] ?>">
            <span style="color: red;" class="error"> <?php echo $nameErr; ?></span>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" value="<?php echo $data['email'] ?>">
            <span style="color: red;" class="error"> <?php echo $emailErr; ?></span>
            <label for="avatar"><b>Avatar</b></label>
            <img src="<?php echo $data['avatar'] ?>" width="30" alt=""></td>
            <input type="file" placeholder="Enter Avatar" name="avatar"><br>
            <?php if ($check_role_type == 2 || $check_role_type == 3) { ?>
                <label for="work_start"><b>Work start date</b></label>
                <div id="datetimepicker" class="input">
                    <input class="add-on" autocomplete="off" type="text" name="work_start_date"
                           value="<?php echo $data['work_start_date'] ?>" style="text-align: center"/>
                </div>
            <?php } ?>
        </div>
        <div class="div_phai" style="float: right; width: 45%;">
            <label for="phone"><b>Phone</b></label>
            <input type="text" placeholder="Enter Phone" name="phone" value="<?php echo $data['phone'] ?>" required>
            <span style="color: red;" class="error"><?php echo $phoneErr; ?></span>
            <label for="role_type"><b>Role_Type</b></label><br>
            <tr>
                <td style="border: 1px solid black">
                    <input type="radio" name="role_type" value="<?php echo getConfig('role_type')['Member']?>"<?php if ( getConfig('role_type')['Member'] == $data['role_type']) echo "checked"; ?>>Member
                    <input type="radio" name="role_type" value="<?php echo getConfig('role_type')['Leader']?>"<?php if ( getConfig('role_type')['Leader'] == $data['role_type']) echo "checked"; ?>>Leader
                    <input type="radio" name="role_type" value="<?php echo getConfig('role_type')['Admin']?>"<?php if ( getConfig('role_type')['Admin'] == $data['role_type']) echo "checked"; ?>>Admin
                    <br>
                    <br>
                </td>
            </tr>
            <label for="team"><b>Team</b></label><br>
            <tr>
                <td>
                <td style="border: 1px solid black">
                    <input type="radio" name="team"
                           value="<?php echo getConfig('team')['Vinh']?>" <?php if (getConfig('team')['Vinh'] == $data['team_id']) echo "checked"; ?>>Vinh
                    <input type="radio" name="team"
                           value="<?php echo getConfig('team')['Hoang']?>" <?php if (getConfig('team')['Hoang'] == $data['team_id']) echo "checked"; ?>>Hoang
                    <input type="radio" name="team"
                           value="<?php echo getConfig('team')['Hung']?>" <?php if (getConfig('team')['Hung'] == $data['team_id']) echo "checked"; ?>>Hung
                    <input type="radio" name="team"
                           value="<?php echo getConfig('team')['Tuan']?>" <?php if (getConfig('team')['Tuan'] == $data['team_id']) echo "checked"; ?>>Tuan
                    <br>
                    <br>
                </td>
                </td>
            </tr>

            <label for="position"><b>Position</b></label><br>
            <tr>
                <td style="border: 1px solid black">
                    <input type="radio" name="position"
                           value="<?php echo getConfig('position')['Member']?>" <?php if (getConfig('position')['Member'] == $data['position_id']) echo "checked"; ?>>Member
                    <input type="radio" name="position"
                           value="<?php echo getConfig('position')['Leader']?>" <?php if (getConfig('position')['Leader'] == $data['position_id']) echo "checked"; ?>>Leader
                    <input type="radio" name="position"
                           value="<?php echo getConfig('position')['Manager']?>" <?php if (getConfig('position')['Manager'] == $data['position_id']) echo "checked"; ?>>Manager
                    <br>
                </td>
            </tr>
        </div>

        <div class="clear-fix">
            <button type="submit" class="signupbtn">Edit</button>
            <a href='javascript: history.go(-1)'>
                <button type="button" class="cancelbtn">Cancel</button>
            </a>
        </div>
    </div>
</form>
<?php include_once('layouts/footer.php'); ?>