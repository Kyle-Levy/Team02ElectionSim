<?php
session_start();
$_SESSION['message'] = ' ';

$mysqli = new mysqli('team02electionsim.cd0yrfnixnjv.us-east-2.rds.amazonaws.com', 'Team02Member', 'secret', 'Team02ElectionSim');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
//If passwords are equal, and the emails are equal
		if(($_POST['pass'] == $_POST['verifyPass']) && ($_POST['emailAddress'] == $_POST['verifyEmailAddress'])){

                $firstname = $mysqli->real_escape_string($_POST['firstName']);
		        $lastname = $mysqli->real_escape_string($_POST['lastName']);
				$username = $mysqli->real_escape_string($_POST['username']);

				$email = $mysqli->real_escape_string($_POST['emailAddress']);
				$pass = md5($_POST['pass']);


				$checkUsernameStatement = "SELECT username from users where username = " . "'$username'";
				$usernameResult = $mysqli->query($checkUsernameStatement);

                $checkEmailStatement = "SELECT email from users where email = " . "'$email'";
                $emailResult = $mysqli->query($checkEmailStatement);

                if($emailResult->num_rows != 0){
                    //Display email is taken
                    $_SESSION['message'] .= " Email is already taken";
                }

                if($usernameResult->num_rows != 0){
                    //Display username is taken
                    $_SESSION['message'] .= " Username is already taken";
                }
				if($usernameResult->num_rows == 0 && $emailResult->num_rows == 0){
				    //Username and email not taken
                    $insertStatement = "INSERT INTO users (username, password, email, firstname, lastname, rolenum)" .
                                        " VALUES ('$username', '$pass', '$email', '$firstname', '$lastname', 0)";

                    if($mysqli->query($insertStatement) === true){
                        $_SESSION['message'] = 'Registration successful! Added $username to the database!';
                        header("location: login.php");
                    } else {
                        $_SESSION['message'] = "User could not be added to the database";
                    }
                }



		}
		else {
		    $_SESSION['message'] = "Passwords do not match/emails do not match";
        }
}

?>

<html>
	<head>
		<title> User ID Registration </title>
        <link href="../styles/form.css" type ="text/css" rel="stylesheet" />
	</head>
	<body>
		<form action = "form.php" method ="post" enctype="multipart/form-data">

				
				<div id="page"><h2>Registration:</h2>
				
                <div><?= $_SESSION['message'] ?></div>
				<label>Name:</label>
					<input class="names"  type="text" name="firstName" size="30" maxlength="30" placeholder="First" required>
					<input class="names"  type="text" name="lastName" size="30" maxlength="30" placeholder="Last" required>
				
				
				<label>Email:</label>
					<input class="fields" type="email" name="emailAddress" size="30" maxlength="30" required>
				
				<label>Verify Email:</label>
					<input class="fields" type="email" name="verifyEmailAddress" size="30" maxlength="30" required>


				<label>Username:</label>
					<input class="fields" type="text" name="username" size="30" maxlength="30" required>
				
				<label>Password:</label>
					<input class="fields" type="password" name="pass" size="30" maxlength="30" required>
			
				<label>Verify Password:</label>
					<input class="fields" type="password" name="verifyPass" size="30" maxlength="30" required>
					
					<input type ="submit" value ="Register">
					
					
				</div>
		</form>
	</body>

</html>