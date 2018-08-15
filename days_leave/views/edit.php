<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="screen"
      href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
<?php
session_start();
include_once('html.php');
include_once('header.php');

require_once('../controllers/PostController.php');
$postController = new PostController();
$data = $postController->getResults(isset($_GET['id']) ? $_GET['id'] : '');
$upd_id = $_SESSION['login']->id;
$check_role_type = (int)$_SESSION['login']->role_type;
if ($data['id'] != $_GET['id']) {
    header('Location: error.php');
}
?>
<?php

$ins_id = $_SESSION['login']->id;
$nameErr = $emailErr = $phoneErr = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = $_POST["name"];
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = $_POST["email"];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone is required";
    } else {
        $phone = $_POST["phone"];
        if (!preg_match('/^\+?([0-9]{1,4})\)?[-. ]?([0-9]{10})$/', $phone)) {
            $phoneErr = 'Please enter a valid phone number';
        }
    }
    $roletype = isset($_POST['roletype']) ? $_POST['roletype'] : '';
    $team = isset($_POST['team']) ? $_POST['team'] : '';
    $position = isset($_POST['position']) ? $_POST['position'] : '';
    $_SESSION['edit'] = ['id' => $ins_id, 'name' => $name, 'email' => $email, 'phone' => $phone,
        'role_type' => $roletype, 'team' => $team, 'position' => $position, 'work_start_date' => $work_start_date = $_POST['work_start_date']];

    header('location:confirm_edit.php');
}
?>
<link rel="stylesheet" href="css/register.css">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="Post" enctype="multipart/form-data"
      style="border:1px solid #ccc">
    <div class="container" style="width: 600px; margin-left: 500px;">
        <h1>Edit</h1>
        <hr>
        <div class="div_trai" style="float: left; width: 45%">
            <input type="hidden" placeholder="Enter id" name="id" value="<?php echo $data['id'] ?>" required>
            <label for="name"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="name" value="<?php echo $data['name'] ?>">
            <span style="color: red;" class="error"> <?php echo $nameErr; ?></span>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" value="<?php echo $data['email'] ?>">
            <span style="color: red;" class="error"> <?php echo $emailErr; ?></span>
            <label for="avatar"><b>Avatar</b></label>
            <img src="<?php echo $data['avatar'] ?>" width="30" alt=""></td>
            <input type="file" placeholder="Enter Avatar" name="avatar"><br><br>
            <?php if ($check_role_type == 2 || $check_role_type == 3) { ?>
                <label for="work_start"><b>Work_start_date</b></label>
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
            <label for="roletype"><b>Role_Type</b></label><br><br>
            <tr>
                <td style="border: 1px solid black">
                    <input type="radio" name="roletype" value="1" <?php if (1 == $data['role_type']) echo "checked"; ?>>member
                    <input type="radio" name="roletype" value="2" <?php if (2 == $data['role_type']) echo "checked"; ?>>Leader
                    <input type="radio" name="roletype" value="3" <?php if (3 == $data['role_type']) echo "checked"; ?>>Admin
                    <br>
                    <br>
                </td>
            </tr>
            <label for="team"><b>Team</b></label><br><br>
            <tr>
                <td>
                <td style="border: 1px solid black">
                    <input type="radio" name="team" value="1" <?php if (1 == $data['team_id']) echo "checked"; ?>>Vinh
                    <input type="radio" name="team" value="2" <?php if (2 == $data['team_id']) echo "checked"; ?>>Hoang
                    <input type="radio" name="team" value="3" <?php if (3 == $data['team_id']) echo "checked"; ?>>Hung
                    <br>
                    <br>
                </td>
                </td>
            </tr>

            <label for="position"><b>Position</b></label>
            <tr>
                <td style="border: 1px solid black">
                    <input type="radio" name="position"
                           value="1" <?php if (1 == $data['position_id']) echo "checked"; ?>>member
                    <input type="radio" name="position"
                           value="2" <?php if (2 == $data['position_id']) echo "checked"; ?>>Leader
                    <input type="radio" name="position"
                           value="3" <?php if (3 == $data['position_id']) echo "checked"; ?>>Manager <br>
                    <br>
                </td>
            </tr>
        </div>

        <div class="clearfix">
            <button type="submit" class="signupbtn">Edit</button>
            <a href='javascript: history.go(-1)'>
                <button type="button" class="cancelbtn">Cancel</button>
            </a>
        </div>
    </div>
</form>
<?php include_once('footer.php'); ?>