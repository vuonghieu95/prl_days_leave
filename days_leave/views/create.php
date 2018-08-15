<?php
session_start();
require_once('../controllers/PostController.php');
$postController = new PostController();
$team = $postController->getTeam();
?>
<?php

$ins_id = $_SESSION['login']->id;
$nameErr = $emailErr =$phoneErr='';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = $_POST["name"];
    }
    if (empty($_POST['password'])){
        $passErr = "Password is required";
    }else {
        $password = md5($_POST['password']);
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
        if(!preg_match('/^\+?([0-9]{1,4})\)?[-. ]?([0-9]{10})$/', $phone) ) {
            $phoneErr = 'Please enter a valid phone number';
        }
    }

    $roletype = isset($_POST['roletype'])?$_POST['roletype']:'';
    $team = isset($_POST['team'])?$_POST['team']:'';
    $position = isset($_POST['position'])?$_POST['position']:'';

    if (empty($email) || empty($phone) || empty($name)) {
    } else {
        require_once('../controllers/PostController.php');

        $target_dir = "img/";  // thư mục chứa file upload

        $target_file = $target_dir . basename($_FILES["avatar"]["name"]); // link sẽ upload file lên

        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) { // nếu upload file không có lỗi
            echo "The file " . basename($_FILES["avatar"]["name"]) . " has been uploaded.";
        } else { // Upload file có lỗi
            echo "Sorry, there was an error uploading your file.";
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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="Post" enctype="multipart/form-data" style="border:1px solid #ccc">
    <div class="container" style="width: 800px">
        <h1>Create-User</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <div class="div_trai" style="float: left; width: 45%">

            <label for="name"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="name" >
            <span style="color: red;" class="error"> <?php echo $nameErr; ?></span>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" >
            <span style="color: red;" class="error"> <?php echo $emailErr; ?></span>

            <label for="avatar"><b>Avatar</b></label>
            <input type="file" placeholder="Enter Avatar" name="avatar" required><br><br>

            <label for="phone"><b>Phone</b></label>
            <input type="text" placeholder="Enter Phone" name="phone" >
            <span style="color: red;" class="error"><?php echo $phoneErr; ?></span>
            <br><br>
        </div>

        <div class="div_phai" style="float: right; width: 45%;">
            <label for="work_start"><b>Work_start_date</b></label>
            <div id="datetimepicker" class="input">
                <input class="add-on" autocomplete="off" type="text" name="work_start_date" style="text-align: center"/>
            </div>

            <label for="roletype"><b>Role_Type</b></label><br>
            <tr>
                <td>
                    <input checked type="radio" name="roletype" value="1"> Member
                    <input type="radio" name="roletype" value="2"> Admin
                    <input type="radio" name="roletype" value="3"> Leader <br><br>
                </td>
            </tr>
            <label for="team"><b>Team</b></label>
            <tr>
                <td>
                <td style="border: 1px solid black">
                    <?php foreach ($team as $row): ?>
                        <input checked type="radio" name="team" value="<?php echo $row['id']?>"><?php echo" ". $row['name']?>
                        <br>
                    <?php endforeach; ?>
                </td>
                </td>
            </tr>

            <label for="position"><b>Position</b></label><br><br>
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

        <div class="clearfix">
            <button type="submit" class="signupbtn">Create</button>
            <a href='javascript: history.go(-1)'> <button type="button" class="cancelbtn">Cancel</button></a>
        </div>
    </div>
</form>

<?php include_once ('footer.php');?>