<?php
/**
 * Created by PhpStorm.
 * User: Kyle Levy
 * Date: 3/28/2018
 **/
session_start();
if(!isset($_SESSION['username'])){
    header("location: login.php");
} else{
    //Username is set

    $username = $_SESSION['username'];
    $mysqli = new mysqli('team02electionsim.cd0yrfnixnjv.us-east-2.rds.amazonaws.com', 'Team02Member', 'secret', 'Team02ElectionSim');

    $updateStatus = "SELECT votingStatus, verifiedByAdmin, activatedByEmail FROM users WHERE username ='$username'";
    $result = $mysqli->query($updateStatus);

    $row = mysqli_fetch_assoc($result);
    $_SESSION['votingStatus'] = $row['votingStatus'];
    $_SESSION['verifiedByAdmin'] = $row['verifiedByAdmin'];
    $_SESSION['activatedByEmail'] = $row['activatedByEmail'];

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
        <p id="verifiedStatus"><?=$_SESSION['verifiedByAdmin']?></p>
        <p id="emailStatus"><?=$_SESSION['activatedByEmail']?></p>
<ul id="status">

</ul>
    </div>
    <script src="../js/jquery-3.3.1.js"></script>
    <script src="../js/navbar.js"></script>
    <script src="../js/homepageStatus.js"></script>
</body>
</html>
