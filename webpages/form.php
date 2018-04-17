<?php
session_start();
$_SESSION['message'] = ' ';

$mysqli = new mysqli('team02electionsim.cd0yrfnixnjv.us-east-2.rds.amazonaws.com', 'Team02Member', 'secret', 'Team02ElectionSim');

require_once ('../PHPMailer/PHPMailerAutoload.php');



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
                    $num = rand(100000,999999);
                    $insertStatement = "INSERT INTO users (username, password, email, firstname, lastname, rolenum, resetCode)" .
                                        " VALUES ('$username', '$pass', '$email', '$firstname', '$lastname', 0, $num )";

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

                    <label>Date of Birth:</label>
                    <input type="date" name="bday" required>

                <label>Gender:</label>
                    <input type = "radio" name ="gender" value ="male" required> Male<br>
                    <input type = "radio" name ="gender" value ="female"> Female<br>
                    <input type = "radio" name ="gender" value ="other"> Other<br>
                <label>Home Address:</label>
                <label>Address line 1:</label>
                    <input type="text" name="address1" required>

                    <label>Address Line 2:</label>
                    <input type="text" name="address2">

                    <label>City:</label>
                    <input type="text" name="city" required>

                    <label>State:</label>
                    <select name="state" required>
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </select>

                    <label>ZIP:</label>
                    <input type="text" size="10" maxlength="10" name="zip" required>

                <label>Phone Number:</label>
                <input type="text" name="phone" required>

                <label>ID:</label>
                    <input type="text" name="id" required>

                <label>Social Security:</label>
                    <input type="text" size="9" maxlength="9" name="social" required>

                <label>Political Party:</label>

                    <select id="politicalParty" name="politicalAffiliation" required>
                        <option value="Democratic">Democratic Party</option>
                        <option value="Republican">Republican Party</option>
                        <option value="Libertarian">Libertarian Party</option>
                        <option value="Green">Green Party</option>
                        <option value="Constitution">Constitution Party</option>
                    </select>

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