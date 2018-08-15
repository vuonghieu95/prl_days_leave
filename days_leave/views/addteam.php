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
<form action="add-team-process.php" method="Post" enctype="multipart/form-data" style="border:1px solid #ccc">
    <div class="container">
        <h1>Add team</h1>

        <hr>

        <label for="name"><b>name</b></label>
        <input type="text" placeholder="Enter team" name="name" required>

        <label for="logo"><b>Logo</b></label>
        <input type="file" placeholder="Enter Logo" name="logo" ><br><br>

        <label for="description"><b>Description</b></label>
        <input type="text" placeholder="Enter description" name="description" required>

        <div class="clearfix">
            <button type="submit" class="signupbtn" onclick="return  confirm('Are you sure you want to add this team?');">Add</button>
            <a href='javascript: history.go(-1)'> <button type="button" class="cancelbtn">Cancel</button></a>

        </div>
    </div>
</form>
</body>
</html>