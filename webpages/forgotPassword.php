<?php
session_start();
$_SESSION['message'] = ' ';
require_once ('../PHPMailer/PHPMailerAutoload.php');
$mysqli = new mysqli('team02electionsim.cd0yrfnixnjv.us-east-2.rds.amazonaws.com', 'Team02Member', 'secret', 'Team02ElectionSim');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
//If username/email found, send email with code, and go to code page sending through their username or email
    $identifier = $mysqli->real_escape_string($_POST['identifier']);

    $checkUsernameStatement = "SELECT email from users where username = " . "'$identifier'";
    $usernameResult = $mysqli->query($checkUsernameStatement);

    $checkEmailStatement = "SELECT email from users where email = " . "'$identifier'";
    $emailResult = $mysqli->query($checkEmailStatement);

    if ($usernameResult->num_rows != 0 || $emailResult->num_rows != 0) {
        if ($usernameResult->num_rows != 0) {
            //If email found by username query
            $row = mysqli_fetch_assoc($usernameResult);
        }

        if ($emailResult->num_rows != 0) {
            //If email found by email query
            $row = mysqli_fetch_assoc($emailResult);
        }

        $email = $row['email'];
        $resetCode = rand(100000, 999999);

        $result = $mysqli->query( "UPDATE users SET resetCode='$resetCode' WHERE email='$email'");

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '465';
        $mail->isHTML();
        $mail->Username = 'Team02ElectionSim@gmail.com';
        $mail->Password = 'kylekelseytyler';
        $mail->Subject = 'Password Reset';
        $mail->Body = 'Here is your reset code: ' . $resetCode;
        $mail->AddAddress($email);

        if(!$mail->send()) {
            echo 'Message was not sent.';
            echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent.';
            $_SESSION['email'] = $email;
            header("location: passReset.php");
        }


    }


//If username/email not found, display error
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
        <label for="identifierField">Username/Email Address</label>
        <input class = "fields" type="text" name="identifier" id="identifier" size="30" maxlength="30">

        <input type ="submit" value ="Submit" id = "changePass">
    </div>
</form>

</body>

</html>