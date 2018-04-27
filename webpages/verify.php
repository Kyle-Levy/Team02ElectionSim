<?php
//Used to verify user registration via email

session_start();

if(isset($_GET['email']) && isset($_GET['hash'])){
    $mysqli = new mysqli('team02electionsim.cd0yrfnixnjv.us-east-2.rds.amazonaws.com', 'Team02Member', 'secret', 'Team02ElectionSim');
    $email = $mysqli->real_escape_string($_GET['email']);
    $hash = $mysqli->real_escape_string($_GET['hash']);

    $checkDatabaseForHash = "SELECT id FROM users where email ='$email' and hash = '$hash'";
    $result = $mysqli->query($checkDatabaseForHash);

    if($result->num_rows == 1){
        $infoArr = mysqli_fetch_assoc($result);

        $id = $infoArr['id'];

        $verifyUser = "UPDATE users SET activatedByEmail = 1 WHERE id ='$id'";
        if($mysqli->query($verifyUser)){
            $_SESSION['verifiedMessage'] = "Account verified";
            header("location: login.php");
        }

    }


}