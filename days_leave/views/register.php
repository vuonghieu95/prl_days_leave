<?php
require_once('../controllers/PostController.php');
$postController = new PostController();
$team = $postController->getTeam();

?>
<link rel="stylesheet" href="css/register.css">
<link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" media="screen"
      href="http://tarruda.github.com/bootstrap-datetimepicker/assets/css/bootstrap-datetimepicker.min.css">
<form action="register_process.php" method="Post" enctype="multipart/form-data" style="border:1px solid #ccc">
    <div class="container" style="width: 800px">
        <h1>Sign Up</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <div class="div_trai" style="float: left; width: 45%">

            <label for="name"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="name" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <label for="email"><b>Email</b></label>
            <input type="text" placeholder="Enter Email" name="email" required>

            <label for="avatar"><b>Avatar</b></label>
            <input type="file" placeholder="Enter Avatar" name="avatar" required><br><br>
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
            <input type="text" placeholder="Enter Phone" name="phone" required><br><br>

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
                        <input checked type="radio" name="team" value="<?php echo $row['id']?>"><?php echo $row['name']?>
                    <?php endforeach; ?>
<!--                    <input checked type="radio" name="team" value="1"> Vinh-->
<!--                    <input type="radio" name="team" value="2"> Hoàng-->
<!--                    <input type="radio" name="team" value="3"> Hùng<br><br>-->

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
            <button type="submit" class="signupbtn">Sign Up</button>
            <a href="admin.php">
                <button type="button" class="cancelbtn">Cancel</button>
            </a>
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
