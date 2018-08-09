<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="screen"
      href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">

<?php
require_once('../controllers/PostController.php');
$postController = new PostController();
$data = $postController->getResults();

?>
<link rel="stylesheet" href="css/register.css">
<form action="editabc.php" method="Post" enctype="multipart/form-data" style="border:1px solid #ccc">
    <div class="container" style="width: 800px;">
        <h1>Edit</h1>
        <hr>
        <div class="div_trai" style="float: left; width: 45%">
        <input type="hidden" placeholder="Enter id" name="id" value="<?php echo $data['id'] ?>" required>
        <label for="name"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="name" value="<?php echo $data['name'] ?>" required>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" value="<?php echo $data['email'] ?>" required>

        <label for="avatar"><b>Avatar</b></label>
        <input type="file" placeholder="Enter Avatar" name="avatar" value="<?php echo $data['avatar'] ?>"
               ><br><br>
            <label for="work_start"><b>Work_start_date</b></label>
            <div id="datetimepicker" class="input-append date">
                <input type="text" name="work_start_date"></input>
                <span class="add-on">
                <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                </span>
            </div>
        </div>
        <div class="div_phai" style="float: right; width: 45%;">
        <label for="phone"><b>Phone</b></label>
        <input type="text" placeholder="Enter Phone" name="phone" value="<?php echo $data['phone'] ?>" required>

        <label for="roletype"><b>Role_Type</b></label><br><br>
<!--            --><?php //var_dump($data);?><!--;-->
        <tr>
            <td style="border: 1px solid black">
                <input type="radio" name="roletype" value="1" <?php if (1 == $data['role_type']) echo "checked"; ?>>member
                <input type="radio" name="roletype" value="2" <?php if (2 == $data['role_type']) echo "checked"; ?>>Leader
                <input type="radio" name="roletype" value="3" <?php if (3 == $data['role_type']) echo "checked"; ?>>Admin <br>
                <br>
            </td>
        </tr>
        <label for="team"><b>Team</b></label><br><br>
        <tr>
            <td>
            <td style="border: 1px solid black">
                <input type="radio" name="team" value="1" <?php if (1 == $data['team_id']) echo "checked"; ?>>Vinh
                <input type="radio" name="team" value="2" <?php if (2 == $data['team_id']) echo "checked"; ?>>Hoang
                <input type="radio" name="team" value="3" <?php if (3 == $data['team_id']) echo "checked"; ?>>Hung <br>
                <br>
            </td>
            </td>
        </tr>

        <label for="position"><b>Position</b></label>
        <tr>
            <td style="border: 1px solid black">
                <input type="radio" name="position" value="1" <?php if (1 == $data['position_id']) echo "checked"; ?>>member
                <input type="radio" name="position" value="2" <?php if (2 == $data['position_id']) echo "checked"; ?>>Leader
                <input type="radio" name="position" value="3" <?php if (3 == $data['position_id']) echo "checked"; ?>>Manager <br>
                <br>
            </td>
        </tr>
        </div>

        <div class="clearfix">
            <a href="admin.php">  <button type="button" class="cancelbtn">Cancel</button></a>
            <button type="submit" class="signupbtn">Sign Up</button>
        </div>
    </div>
</form>
<script type="text/javascript"
        src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js">
</script>
<script type="text/javascript"
        src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js">
</script>
<script type="text/javascript"
        src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
</script>
<script type="text/javascript"
        src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
</script>
<script type="text/javascript">
    $('#datetimepicker').datetimepicker({
        format: 'dd/MM/yyyy hh:mm:ss',
        language: 'pt-BR'
    });
</script>