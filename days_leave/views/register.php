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
<form action="register_process.php" method="Post" enctype="multipart/form-data" style="border:1px solid #ccc">
    <div class="container">
        <h1>Sign Up</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="name"><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="name" required>

        <label for="psw"><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="avatar"><b>Avatar</b></label>
        <input type="file" placeholder="Enter Avatar" name="avatar" required><br><br>

        <label for="phone"><b>Phone</b></label>
        <input type="text" placeholder="Enter Phone" name="phone" required>

        <label for="roletype"><b>Role_Type</b></label><br><br>
       <tr>
           <td>
               <input checked type="radio" name="roletype" value="1"> Member
               <input  type="radio" name="roletype" value="2"> Admin
               <input type="radio" name="roletype" value="3"> Leader <br><br>
           </td>
       </tr>
        <label for="team"><b>Team</b></label><br><br>
        <tr>
            <td>
            <td style="border: 1px solid black">

                <input checked type="radio" name="team" value="1"> Vinh
                <input  type="radio" name="team" value="2"> Hoàng
                <input type="radio" name="team" value="3"> Hùng<br><br>

            </td>
            </td>
        </tr>

        <label for="position"><b>Position</b></label><br><br>
        <tr>
            <td>
            <td style="border: 1px solid black">

                <input checked type="radio" name="position" value="1"> member
                <input  type="radio" name="position" value="2"> leader
                <input type="radio" name="position" value="3"> manager<br><br>

            </td>
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