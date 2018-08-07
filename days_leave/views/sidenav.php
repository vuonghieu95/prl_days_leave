
<div class="container">
    <div class="sidenav">
        <div class="info">
            <div class="icon">
                <img src="img/user.png" alt="" width="100%", height="100%">
            </div>
            <div class="hello-info">
                Hello Administrator
            </div>
        </div>
        <button class="dropdown-btn">TEAM
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="content.php?team=1">Vinh</a>
            <a href="content.php?team=2">Hoàng</a>
            <a href="#">Hùng</a>
            <a href="#">Quý</a>
        </div>
        <button class="dropdown-btn">TEAM
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-container">
            <a href="#">Vinh</a>
            <a href="#">Hoàng</a>
            <a href="#">Hùng</a>
            <a href="#">Quý</a>
        </div>
        <a href="addteam.php">
            <button>add team</button></a>
    </div>

    <div class="content">
<!--        --><?php //include_once ('content.php')?>
        <a href="logout.php"><button class="abc" style="float: right">Sign out</button></a>
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