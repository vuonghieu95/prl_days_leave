<?php
require_once('../controllers/PostController.php');
$postController = new PostController();
$team = $postController->getTeam();
$check_role_type = (int)$_SESSION['login']->role_type;

?>
<div class="container">
    <div class="sidenav">

        <div class="info">
            <div class="icon">
                <img src="<?php echo $_SESSION['login']->avatar?>" style="border-radius: 60px" alt="" width="70px", height="70px">
            </div>
            <div class="hello-info" style="font-size: 20px">
                Hello: <?php echo $_SESSION['login']->name?><br>
                    <i class="fa fa-circle text-success" style="text-decoration: none"></i> Online
            </div>
        </div>
        <button class="dropdown-btn">Team Manager
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container ">

            <?php foreach ($team as $row): ?>
                <a href="content.php?team=<?php echo $row['id']?>" style="text-decoration: none !important;"><?php echo $row['name']?></a>
            <?php endforeach; ?>
        </div>

        <button class="dropdown-btn">Days Leave Manager
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="days_leave.php" style="text-decoration: none !important;">Employee</a>
        </div>
    </div>
</div>

<script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function () {
            this.classList.toggle("active");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>