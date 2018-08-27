<link rel="stylesheet" href="<?php echo getPublicUrl('css/register.css')?>">
<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="screen"
      href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
<div class="div" style="width: 100%;height: 100px">
    <?php include_once(getRootPath('views/layouts/header.php')) ?>
</div>
<div class="side-bar" style="float: left;">
    <?php include_once(getRootPath('views/layouts/sidenav.php')) ?>
</div>
<?php
include_once(getRootPath('views/layouts/html.php'));
$msg = $emailErr = $phoneErr =$avatarErr='';
?>
<form action="<?php echo url('admin','addUser')?>" method="Post" enctype="multipart/form-data" style=" width: 700px !important; margin-left: 500px   ">
    <div class="container" style="width: 800px">
        <h1>Create-User</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <div class="div_trai" style="float: left; width: 45%">
            <label for="name"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="name"
                   value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>">
            <span style="color: red;" class="error"><?php echo isset($errors) && isset($errors['name']) ? $errors['name'] : '' ?></span><br>
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email"
                   value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
            <span style="color: red;" class="error"><?php echo isset($errors) && isset($errors['email']) ? $errors['email'] : '' ?></span><br>

            <label for="avatar"><b>Avatar</b></label>
            <img src="<?php echo isset($avatar) ? $avatar : '' ?>" width="30" alt="">
            <input type="file" placeholder="Enter Avatar" name="avatar" value="">
            <span style="color: red;" class="error"> <?php echo $avatarErr; ?></span>
            <input type="hidden" name="tmp_avatar" value="<?php echo isset($avatar) ? $avatar : '' ?>">
            <label for="phone"><b>Phone</b></label>
            <input type="text" placeholder="Enter Phone" name="phone"
                   value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>">
            <span style="color: red;" class="error"><?php echo isset($errors) && isset($errors['phone']) ? $errors['phone'] : '' ?></span><br>
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
            <button type="submit" name="add_user" value="1" class="signupbtn">Create</button>
            <a href='javascript: history.go(-1)'>
                <button type="button" class="cancelbtn">Cancel</button>
            </a>
        </div>
    </div>
</form>

<?php include_once(getRootPath('views/layouts/footer.php')); ?>