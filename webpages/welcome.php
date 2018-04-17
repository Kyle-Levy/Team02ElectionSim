<?php
/**
 * Created by PhpStorm.
 * User: Kyle Levy
 * Date: 3/28/2018
 **/
session_start();
if(isset($_POST['logout'])){
    session_destroy();
    header("location: login.php");
}
?>

<html>
<head>
    <link href="../styles/homepage.css" type ="text/css" rel="stylesheet" />
</head>
    <body>
    <div id = "page">
<div>Welcome <?= $_SESSION['username']?>!</div>
<p id="roleNum"><?= $_SESSION['role']?></p>
<ul>
    <li><a href="changePassword.php">Change password</a></li>
    <li><a href=""</li>
    <form action = "welcome.php" method ="post" enctype="multipart/form-data">
    <li><input type="submit" name="logout" value = "Logout"></li>
    </form>

</ul>
    </div>
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/homepage.js"></script>
</body>
</html>
