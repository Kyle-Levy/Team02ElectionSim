<?php
session_start();
$_SESSION['errorMessage'] = ' ';

$mysqli = new mysqli('team02electionsim.cd0yrfnixnjv.us-east-2.rds.amazonaws.com', 'Team02Member', 'secret', 'Team02ElectionSim');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $mysqli->real_escape_string($_SESSION['username']);
    $currentPass = md5($_POST['currentPass']);

    $checkForUser = "SELECT username from users where username = '$username' and password = '$currentPass'";
    $userResult = $mysqli->query($checkForUser);

//A username was found where the session username = the current pass
    if ($userResult->num_rows != 0) {
        $newPass = md5($_POST['newPass']);
        $newPassVerify = md5($_POST['newPassVerify']);
        if ($newPass == $newPassVerify) {
            $changePassword = "UPDATE users SET password='$newPass' WHERE username='$username'";
            $mysqli->query($changePassword);
            header("location: welcome.php");
        } else {
            $_SESSION['errorMessage'] = 'New Passwords Did Not Match';
        }
    } else {
        $_SESSION['errorMessage'] = 'Incorrect current pass';
    }
}



?>

<html>
<head>
    <link href="../styles/form.css" type ="text/css" rel="stylesheet" />
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

<form method ="post" enctype="multipart/form-data">
    <div id="page">
        <h2>Change password</h2>
        <h3><?= $_SESSION['errorMessage']?></h3>
        <label for="currentPass">Current Password:</label>
        <input class = "fields" type="password" name="currentPass" id="currentPass" size="30" maxlength="30">

        <label for="newPass">New Password:</label>
        <input class = "fields" type="password" name="newPass" id="newPass" size="30" maxlength="30">

        <label for="newPassVerify">Verify New Password:</label>
        <input class = "fields" type="password" name="newPassVerify" id="newPassVerify" size="30" maxlength="30">

        <input type ="submit" value ="Change Password" id = "changePass">
    </div>
</form>
<script src="../js/navbar.js"></script>
</body>

</html>

