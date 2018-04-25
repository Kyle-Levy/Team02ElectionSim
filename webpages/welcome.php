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
    <style type="text/css">
        nav, footer {
            clear: both;
            color: #ffffff;
            background-color: #aeaca8;
            height: 30px;}
        nav ul {
            margin: 0px;
            padding: 5px 0px 5px 30px;}
        nav li {
            display: inline;
            margin-right: 40px;}
        nav li  {color: #ffffff;}
        nav li a:hover, li.current{
            color: #000000;}
        a {
            text-decoration: none;}
    </style>

</head>
    <body>
    <nav>
        <ul id="navBarList">
            <li class="current"><a href="welcome.php">Homepage</a></li>
            <li>Next</li>
            <li>Last</li>
        </ul>
    </nav>
    <div id = "page">
<div>Welcome <?= $_SESSION['username']?>!</div>
<p id="roleNum"><?= $_SESSION['role']?></p>
<ul>
    <li><a href="changePassword.php">Change password</a></li>
    <li><a href=""</li>
    <form action = "welcome.php" method ="post" enctype="multipart/form-data">
    <li><input type="submit" name="logout" value = "Logout"></li>
    </form>
    <li><a href="vote.php">Vote</a></li>
</ul>
    </div>
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/homepage.js"></script>
</body>
</html>
