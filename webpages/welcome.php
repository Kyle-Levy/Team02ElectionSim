<?php
/**
 * Created by PhpStorm.
 * User: Kyle Levy
 * Date: 3/28/2018
 **/
session_start();
if(!isset($_SESSION['username'])){
    header("location: login.php");
}
if(isset($_POST['logout'])){
    session_destroy();
    header("location: login.php");
}


?>

<html>
<head>
    <link href="../styles/homepage.css" type ="text/css" rel="stylesheet" />
    <link href="../styles/navbar.css" type="text/css" rel="stylesheet"/>
</head>

    <body>
        <header>
            <div class = "container">

                <img src="../resources/Team02Logo.png" alt="logo" class="logo">

                 <nav>
                    <ul id="navBarList">
                        <li class="all"><a href="welcome.php">Home</a></li>
                    </ul>
                </nav>
            </div>
            <p id="roleNum"><?= $_SESSION['role']?></p>
            <p id="votingStatus"><?= $_SESSION['votingStatus']?></p>
        </header>

    <div id = "page">
<div>Welcome <?= $_SESSION['username']?>!</div>
<ul>
    <li><a href="changePassword.php">Change password</a></li>
    <li><a href="vote.php">Vote</a></li>

</ul>
    </div>
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/navbar.js"></script>
</body>
</html>
