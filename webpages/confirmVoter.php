<?php
session_start();

$mysqli = new mysqli('team02electionsim.cd0yrfnixnjv.us-east-2.rds.amazonaws.com', 'Team02Member', 'secret', 'Team02ElectionSim');

if(isset($_SESSION['username']) && intval($_SESSION['role']) > 0) {
    //Query all users with voting status of 0 (will only allow checkbox if 1 for verifiedByAdmin and 1 for activatedByEmail)  and get (firstName, lastName, idNum, social, )
    $grabUsers = "SELECT id,firstName, lastName, idNum, social FROM users WHERE votingStatus = 0 and verifiedByAdmin = 1 and activatedByEmail = 1";
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
        $changeVotingStatus = "UPDATE users SET votingStatus = 1 where id = $name";
        $mysqli->query($changeVotingStatus);
        header("location: welcome.php");
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

<form form action = "confirmVoter.php" method = "post" enctype="multipart/form-data" id="checkboxForm">
<table id="userTable">
<tr>
    <th>User ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Identification #</th>
    <th>Social</th>
    <th>Confirm Voter?</th>
</tr>

</table>

    <input type="submit" value="Submit Changes">
</form>

<script src="../js/jquery-3.3.1.js"></script>
<script type="text/javascript">
    var allUsersManager = <?php echo json_encode($allUsers); ?>;
</script>
<script src="../js/confirmVoter.js"></script>
<script src="../js/navbar.js"></script>
</body>
</html>
