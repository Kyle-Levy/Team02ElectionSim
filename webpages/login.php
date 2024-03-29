<?php
session_start();
$_SESSION['message'] = ' ';
if(!isset($_SESSION['verifiedMessage'])){
    $_SESSION['verifiedMessage'] = '';
}
$mysqli = new mysqli('team02electionsim.cd0yrfnixnjv.us-east-2.rds.amazonaws.com', 'Team02Member', 'secret', 'Team02ElectionSim');

    if(isset($_SESSION['username'])){
        header("location: welcome.php");
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $_SESSION['verifiedMessage'] = '';
        $username = $mysqli->real_escape_string($_POST['username']);
        $password = md5($_POST['pass']);

        //Where there is a username in the database that equals the login field, or there is an email that equals the login field, and the password equals the correct password.
        $checkForUser = "SELECT username,rolenum, votingStatus, verifiedByAdmin,activatedByEmail from users where (username = '$username' or email = '$username') and password = '$password'";
        $userResult = $mysqli->query($checkForUser);

        if($userResult->num_rows != 0){

            //Grab array from query
            $infoArr = mysqli_fetch_assoc($userResult);
            //print_r($infoArr);
            //User is set to the username stored in database and role is set to role associated with username in database
            $user = $infoArr['username'];
            $role = $infoArr['rolenum'];
            $votingStatus = $infoArr['votingStatus'];
            $verifiedByAdmin = $infoArr['verifiedByAdmin'];
            $activatedByEmail = $infoArr['activatedByEmail'];

            //Set username and role for session.
            $_SESSION['username'] = $user;
            $_SESSION['role'] = $role;
            $_SESSION['votingStatus'] = $votingStatus;
            $_SESSION['verifiedByAdmin'] = $verifiedByAdmin;
            $_SESSION['activatedByEmail'] = $activatedByEmail;

            header("location: welcome.php");
        }
    }
?>

<html>
	<head>
		<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
		<meta content="utf-8" http-equiv="encoding">
		<link href="../styles/form.css" type ="text/css" rel="stylesheet" />
		<title> User Login </title>
	</head>
	<body>
        <form action = "login.php" method ="post" enctype="multipart/form-data">
                <div id="page">
                    <p><?=$_SESSION['message']?></p>
                    <p><?=$_SESSION['verifiedMessage']?></p>
                    <h2 id="loginTitle">Login</h2>


                        <label for="username">Email/Username:</label>
                        <input class="fields" type="text" name="username" id="username" size="30" maxlength="30" >

                        <label for="pass">Password:</label>
                        <input class="fields" type="password" name="pass" id="pass" size="30" maxlength="30">

                        <span>
                        <a href="form.php">Register</a>

                        <input type ="submit" value ="Login" id = "loginButton">
                        </span>

                        <a href="forgotPassword.php">Forgot Password?</a>
                </div>
        </form>
			<script src="../js/jquery-3.3.1.js"></script>
	</body>

</html>