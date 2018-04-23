<?php
session_start();

$mysqli = new mysqli('team02electionsim.cd0yrfnixnjv.us-east-2.rds.amazonaws.com', 'Team02Member', 'secret', 'Team02ElectionSim');

if(isset($_SESSION['username']) && isset($_SESSION['role'])) {
    //Query all users with voting status of 0 (will only allow checkbox if 1 for verifiedByAdmin and 1 for activatedByEmail)  and get (firstName, lastName, idNum, social, )
    $grabUsers = "SELECT id,firstName, lastName, idNum, social, verifiedByAdmin, activatedByEmail FROM users WHERE votingStatus = 0";
    $result = $mysqli->query($grabUsers);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $person[] = $row['id'];
        $person[] = $row['firstName'];
        $person[] = $row['lastName'];
        $person[] = $row['idNum'];
        $person[] = $row['social'];
        $person[] = $row['verifiedByAdmin'];
        $person[] = $row['activatedByEmail'];
        $allUsers[] = $person;
        unset($person);
    }


}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    foreach ($_POST as $name => $val) {
        $changeVotingStatus = "UPDATE users SET votingStatus = 1 where id = $name";
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
<form form action = "confirmVoter.php" method = "post" enctype="multipart/form-data" id="checkboxForm">
<table id="userTable">
<tr>
    <th>User ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Identification #</th>
    <th>Social</th>
    <th>Verified By Admin</th>
    <th>Activated By Email</th>
    <th>Confirm Voter?</th>
</tr>

</table>

    <input type="submit" value="Submit Changes">
</form>

<script src="../js/jquery-3.3.1.js"></script>
<script type="text/javascript">
    var allUsers = <?php echo json_encode($allUsers); ?>;
</script>
<script src="../js/confirmVoter.js"></script>
</body>
</html>
