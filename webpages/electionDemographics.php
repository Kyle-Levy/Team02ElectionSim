<?php
session_start();

$mysqli = new mysqli('team02electionsim.cd0yrfnixnjv.us-east-2.rds.amazonaws.com', 'Team02Member', 'secret', 'Team02ElectionSim');

//User is an admin
if(isset($_SESSION['username']) && intval($_SESSION['role']) > 1) {
    $elections = "SELECT electionID, electionName FROM elections";
    $result = $mysqli->query($elections);

    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $electionInfo[] = $row['electionID'];
        $electionInfo[] = $row['electionName'];
        $allElections[] = $electionInfo;
        unset($electionInfo);
    }

} else{
    header("location: welcome.php");
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    unset($currentElectionInfo);
    unset($electionDetails);
    unset($precincts);
    unset($candidateArr);
    $currentElectionID = $_POST['electionID'];

    $getElectionDetails = "SELECT electionName, startDate, endDate FROM elections WHERE electionID = '$currentElectionID'";
    $resultDetails = $mysqli->query($getElectionDetails);

    $row = mysqli_fetch_assoc($resultDetails);
    $electionDetails[] = $row['electionName'];
    $electionDetails[] = $row['startDate'];
    $electionDetails[] = $row['endDate'];

    $currentElectionInfo[] = $electionDetails;

    $allPrecincts = "SELECT precinct FROM electionPrecinct where electionID = '$currentElectionID'";
    $resultP = $mysqli-> query($allPrecincts);

    while ($row = mysqli_fetch_array($resultP, MYSQLI_ASSOC)) {
        $precincts[] = $row['precinct'];
    }

    $currentElectionInfo[] = $precincts;


    $allCandidates = "SELECT candidate, party, votes FROM electionCandidates WHERE electionID = '$currentElectionID'";
    $resultC = $mysqli->query($allCandidates);

    while ($row = mysqli_fetch_array($resultC, MYSQLI_ASSOC)) {
        $candidateInfo[] = $row['candidate'];
        $candidateInfo[] = $row['party'];
        $candidateInfo[] = $row['votes'];

        $candidateArr[] = $candidateInfo;
        unset($candidateInfo);
    }
    $currentElectionInfo[] = $candidateArr;
}

?>


<html>
<head>

    <link href="../styles/navbar.css" type="text/css" rel="stylesheet"/>
    <link href="../styles/electionDemographic.css" type="text/css" rel="stylesheet"/>
    <link href="../styles/table.css" type="text/css" rel="stylesheet"/>
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

<form action = "electionDemographics.php" method = "post" enctype="multipart/form-data" id="electionChoice">
Election Demographic For:<select id="electionNames" name="electionID">
</select>
    <input type="submit">
</form>
<div id="electionDiv">

</div>



<script type="text/javascript">
    var allElections = <?php echo json_encode($allElections); ?>;
</script>
<script type ="text/javascript">
    var currentElectionInfo = <?php echo json_encode($currentElectionInfo); ?>;
</script>

<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/navbar.js"></script>
<script src="../js/electionDemographics.js"></script>
</body>

</html>
