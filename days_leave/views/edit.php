<?php
require_once('../controllers/PostController.php');
$postController = new PostController();
$data = $postController->getResults();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
<form action="editabc.php" method="Post" enctype="multipart/form-data" style="border:1px solid #ccc">
    <div class="container">
        <h1>Edit</h1>
        <hr>
        <input type="hidden" placeholder="Enter id" name="id" value="<?php echo $data['id'] ?>" required>
        <label for="name"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="name" value="<?php echo $data['name'] ?>" required>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" value="<?php echo $data['email'] ?>" required>

        <label for="avatar"><b>Avatar</b></label>
        <input type="file" placeholder="Enter Avatar" name="avatar" value="<?php echo $data['avatar'] ?>"
               ><br><br>

        <label for="phone"><b>Phone</b></label>
        <input type="text" placeholder="Enter Phone" name="phone" value="<?php echo $data['phone'] ?>" required>

        <label for="roletype"><b>Role_Type</b></label><br><br>
        <tr>
            <td>
                <?php if ($data['role_type'] == 1) { ?>
                    <input checked type="radio" name="roletype" value="<?php echo $data['role_type'] ?>"> Member
                    <input type="radio" name="roletype" value="<?php echo $data['role_type'] ?>"> Admin
                    <input type="radio" name="roletype" value="<?php echo $data['role_type'] ?>"> Leader <br><br>
                <?php } ?>
                <?php if ($data['role_type'] == 2) { ?>
                    <input type="radio" name="roletype" value="<?php echo $data['role_type'] ?>"> Member
                    <input checked type="radio" name="roletype" value="<?php echo $data['role_type'] ?>"> Admin
                    <input type="radio" name="roletype" value="<?php echo $data['role_type'] ?>"> Leader <br><br>
                <?php } ?>
                <?php if ($data['role_type'] == 3) { ?>
                    <input type="radio" name="roletype" value="<?php echo $data['role_type'] ?>"> Member
                    <input type="radio" name="roletype" value="<?php echo $data['role_type'] ?>"> Admin
                    <input checked type="radio" name="roletype" value="<?php echo $data['role_type'] ?>"> Leader <br><br>
                <?php } ?>
            </td>
        </tr>
        <label for="team"><b>Team</b></label><br><br>
        <tr>
            <td>
            <td style="border: 1px solid black">
                <?php if ($data['team_id'] == 1) { ?>
                    <input checked type="radio" name="team" value="<?php echo $data['team_id'] ?>"> Vinh
                    <input type="radio" name="team" value="<?php echo $data['team_id'] ?>"> Hoàng
                    <input type="radio" name="team" value="<?php echo $data['team_id'] ?>"> Hùng<br>
                <?php }?>
                <?php if ($data['team_id'] == 2) { ?>
                    <input  type="radio" name="team" value="<?php echo $data['team_id'] ?>"> Vinh
                    <input checked type="radio" name="team" value="<?php echo $data['team_id'] ?>"> Hoàng
                    <input type="radio" name="team" value="<?php echo $data['team_id'] ?>"> Hùng<br>
                <?php }?>
                <?php if ($data['team_id'] == 3) { ?>
                    <input  type="radio" name="team" value="<?php echo $data['team_id'] ?>"> Vinh
                    <input checked type="radio" name="team" value="<?php echo $data['team_id'] ?>"> Hoàng
                    <input type="radio" name="team" value="<?php echo $data['team_id'] ?>"> Hùng<br>
                <?php }?>

            </td>
            </td>
        </tr>

        <label for="position"><b>Position</b></label>
        <tr>
            <td>
                <?php if ($data['position_id'] == 1) { ?>
                    <input checked type="radio" name="position" value="<?php echo $data['position_id'] ?>"> Member
                    <input type="radio" name="position" value="<?php echo $data['position_id'] ?>"> Admin
                    <input type="radio" name="position" value="<?php echo $data['position_id'] ?>"> Leader <br><br>
                <?php } ?>
                <?php if ($data['position_id'] == 2) { ?>
                    <input type="radio" name="position" value="<?php echo $data['position_id'] ?>"> Member
                    <input checked type="radio" name="position" value="<?php echo $data['position_id'] ?>"> Admin
                    <input type="radio" name="position" value="<?php echo $data['position_id'] ?>"> Leader <br><br>
                <?php } ?>
                <?php if ($data['position_id'] == 3) { ?>
                    <input type="radio" name="position" value="<?php echo $data['position_id'] ?>"> Member
                    <input type="radio" name="position" value="<?php echo $data['position_id'] ?>"> Admin
                    <input checked type="radio" name="position" value="<?php echo $data['position_id'] ?>"> Leader <br><br>
                <?php } ?>
            </td>
        </tr>
        <label>
            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
        </label>

        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

        <div class="clearfix">
            <button type="button" class="cancelbtn">Cancel</button>
            <button type="submit" class="signupbtn">Sign Up</button>
        </div>
    </div>
</form>
</body>
</html>