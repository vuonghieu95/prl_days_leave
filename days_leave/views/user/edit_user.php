<link rel="stylesheet" href="<?php echo getPublicUrl('css/register.css')?>">
<div class="div" style="width: 100%;height: 100px">
    <?php include_once(getRootPath('views/layouts/header.php')) ?>
</div>
<div class="side-bar" style="float: left;">
    <?php include_once(getRootPath('views/layouts/sidenav.php')) ?>
</div>
<?php
include_once(getRootPath('views/layouts/html.php'));
$nameErr = $emailErr = $phoneErr =$avatarErr='';

?>
<form action="<?php echo url('admin','editUser',['id'=>$data['id']]) ?>" method="Post" enctype="multipart/form-data"
      style="border:1px solid #ccc">
    <div class="edit" style="width: 600px; margin-left: 500px;">
        <h1>Edit</h1>
        <hr>
        <div class="div_trai" style="float: left; width: 45%">
            <input type ="hidden" name="id" value="<?php echo $data['id'] ?>" required>
            <label for="name"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="name" value="<?php echo $data['name'] ?>">
            <span style="color: red;" class="error"><?php echo isset($errors) && isset($errors['name']) ? $errors['name'] : '' ?></span><br>
            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" value="<?php echo $data['email'] ?>">
            <span style="color: red;" class="error"><?php echo isset($errors) && isset($errors['email']) ? $errors['email'] : '' ?></span><br>
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
<!--            <span style="color: red;" class="error">--><?php //echo isset($errors) && isset($errors['phone']) ? $errors['phone'] : '' ?><!--</span><br>-->
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
            <button type="submit" name="edit_user" value="1" class="signupbtn">Edit</button>
            <a href='javascript: history.go(-1)'>
                <button type="button" class="cancelbtn">Cancel</button>
            </a>
        </div>
    </div>
</form>
<?php include_once(getRootPath('views/layouts/footer.php')); ?>
