<?php
/**
 * Created by PhpStorm.
 * User: Kyle Levy
 * Date: 3/28/2018
 **/
session_start();

?>

<html>
<head>
    <body>
<div>Welcome <?= $_SESSION['username']?>! Your role number is <?= $_SESSION['role']?></div>
<ul>
    <li><a href="changePassword.php">Change password</a></li>
</ul>
</body>
</head>
</html>
