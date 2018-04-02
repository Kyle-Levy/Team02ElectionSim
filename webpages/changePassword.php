<?php
session_start();
$_SESSION['errorMessage'] = ' ';

$mysqli = new mysqli('localhost', 'root', 'secret', 'electoralapp');

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
</head>
<body>

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

</body>

</html>

