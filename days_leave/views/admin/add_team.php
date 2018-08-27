<?php
include_once(getRootPath('views/layouts/html.php'));
?>
    <link rel="stylesheet" href="<?php echo getPublicUrl('css/register.css')?>">

<div class="div" style="width: 100%;height: 100px">
    <?php include_once(getRootPath('views/layouts/header.php')) ?>
</div>
<div class="header-main" style="float: right">
    <form action="<?php echo url('admin','addTeam')?>" method="Post" enctype="multipart/form-data" style="border:1px solid #ccc">
        <div class="container" style="width: 400px!important; margin-left: 500px">
            <h1>Add team</h1>

            <hr>

            <label for="name"><b>name</b></label>
            <input type="text" placeholder="Enter team" name="name" required>

            <label for="logo"><b>Logo</b></label>
            <input type="file" placeholder="Enter Logo" name="logo" ><br><br>

            <label for="description"><b>Description</b></label>
            <input type="text" placeholder="Enter description" name="description" required>

            <div class="clear-fix">
                <button type="submit" name="add_team" value="1" class="signupbtn" onclick="return  confirm('Are you sure you want to add this team?');">Add</button>
                <a href='javascript: history.go(-1)'> <button type="button" class="cancelbtn">Cancel</button></a>

            </div>
        </div>
    </form>
</div>
<div class="side-bar" style="float: left;">
    <?php include_once(getRootPath('views/layouts/sidenav.php')) ?>
</div>

</body>