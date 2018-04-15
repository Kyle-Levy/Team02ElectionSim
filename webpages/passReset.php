<?php
session_start();
$_SESSION['message'] = ' ';
$email = $_SESSION['email'];
require_once ('../PHPMailer/PHPMailerAutoload.php');
$mysqli = new mysqli('team02electionsim.cd0yrfnixnjv.us-east-2.rds.amazonaws.com', 'Team02Member', 'secret', 'Team02ElectionSim');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $codeInput = $mysqli->real_escape_string($_POST['code']);

    //Where there is a username in the database that equals the login field, or there is an email that equals the login field, and the password equals the correct password.
    $checkForUser = "SELECT username from users where email = '$email' and resetCode = '$codeInput'";
    $userResult = $mysqli->query($checkForUser);

    if($userResult->num_rows != 0){

        //Grab array from query
        $infoArr = mysqli_fetch_assoc($userResult);
        //print_r($infoArr);
        //User is set to the username stored in database and role is set to role associated with username in database
        $user = $infoArr['username'];

        $tempPassword = generateRandomString(10);
        $cTempPassword = md5($tempPassword);

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = '465';
        $mail->isHTML();
        $mail->Username = 'Team02ElectionSim@gmail.com';
        $mail->Password = 'kylekelseytyler';
        $mail->Subject = 'Temporary Password';
        $mail->Body = 'Here is your new temporary password: ' . $tempPassword . ' You can choose to reset your password upon logging in once again.';
        $mail->AddAddress($email);

        $mysqli->query( "UPDATE users SET password='$cTempPassword' WHERE email='$email'");

        if(!$mail->send()) {
            echo 'Password was not sent.';
            echo 'Mailer error: ' . $mail->ErrorInfo;
        } else {
            echo 'New password has been sent.';
            session_destroy();
            header("location: login.php");
        }

        //Set username and role for session.

    }


}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>

<html>
<head>
    <link href="../styles/form.css" type ="text/css" rel="stylesheet" />
</head>
<body>

<form method ="post" enctype="multipart/form-data">
    <div id="page">
        <h2>Enter reset code</h2>
        <label for="code">Enter your code</label>
        <input class = "fields" type="text" name="code" id="code" size="30" maxlength="30">

        <input type ="submit" value ="Submit" id = "submitID">
    </div>
</form>

</body>

</html>
