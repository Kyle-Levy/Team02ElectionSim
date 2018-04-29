<?php
session_start();
require_once ('../PHPMailer/PHPMailerAutoload.php');
$mysqli = new mysqli('team02electionsim.cd0yrfnixnjv.us-east-2.rds.amazonaws.com', 'Team02Member', 'secret', 'Team02ElectionSim');


if(isset($_SESSION['username']) && intval($_SESSION['role']) > 1) {
    //Query all users with voting status of 0 (will only allow checkbox if 1 for verifiedByAdmin and 1 for activatedByEmail)  and get (firstName, lastName, idNum, social, )
    $grabUsers = "SELECT id,firstName, lastName, idNum, social FROM users WHERE votingStatus = 0 and verifiedByAdmin = 0 and activatedByEmail = 1";
    $result = $mysqli->query($grabUsers);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $person[] = $row['id'];
        $person[] = $row['firstName'];
        $person[] = $row['lastName'];
        $person[] = $row['idNum'];
        $person[] = $row['social'];
        $allUsers[] = $person;
        unset($person);
    }


}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    foreach ($_POST as $name => $val) {
        $valNum = intval($val);

        if ($valNum == 1 || $valNum == -1) {
        $getUserEmail = "SELECT email FROM users WHERE id = '$name'";
        $result = $mysqli->query($getUserEmail);

        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];

            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = '465';
            $mail->isHTML();
            $mail->Username = 'Team02ElectionSim@gmail.com';
            $mail->Password = 'kylekelseytyler';
            $mail->AddAddress($email);

            $mail->Subject = 'Admin Verification';





        if ($valNum == 1) {
            $changeVotingStatus = "UPDATE users SET verifiedByAdmin = 1 where id = '$name'";
            if($mysqli->query($changeVotingStatus)){
                $mail->Body = 'Your account has been verified';
            }

        } else if ($valNum == -1) {
            //delete
            $mail->Body = 'You have been denied';

        }

            if(!$mail->send()) {
                echo 'Message was not sent.';
                echo 'Mailer error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent.';
                $_SESSION['email'] = $email;
            }

            }
    }
    header("location:welcome.php");
    }


?>

<html>
<head>
    <link href="../styles/table.css" type="text/css" rel="stylesheet"/>
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
<form form action = "verifyUserRegistration.php" method = "post" enctype="multipart/form-data" id="checkboxForm">
    <table id="userTable">
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Identification #</th>
            <th>Social</th>
            <th>Confirm Registration</th>
            <th>Deny Registration</th>
            <th>Do Nothing</th>
        </tr>

    </table>

    <button type="submit" class="submit"><span>Submit Changes</span></button>
</form>

<script src="../js/jquery-3.3.1.js"></script>
<script type="text/javascript">
    var allUsersAdmin = <?php echo json_encode($allUsers); ?>;
</script>
<script src="../js/verifyUserRegistration.js"></script>
<script src="../js/navbar.js"></script>
</body>
</html>