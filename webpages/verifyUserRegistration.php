<?php
session_start();

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
        $changeVotingStatus = "UPDATE users SET verifiedByAdmin = 1 where id = $name";
        $mysqli->query($changeVotingStatus);
    }
}

?>

<html>
<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
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

    <input type="submit" value="Submit Changes">
</form>

<script src="../js/jquery-3.3.1.js"></script>
<script type="text/javascript">
    var allUsersAdmin = <?php echo json_encode($allUsers); ?>;
</script>
<script src="../js/verifyUserRegistration.js"></script>
</body>
</html>