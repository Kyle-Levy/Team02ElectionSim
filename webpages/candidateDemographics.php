<?php
session_start();

$mysqli = new mysqli('team02electionsim.cd0yrfnixnjv.us-east-2.rds.amazonaws.com', 'Team02Member', 'secret', 'Team02ElectionSim');

//User is an admin
if(isset($_SESSION['username']) && intval($_SESSION['role']) > 1) {
    $elections = "SELECT candidateID, electionID, candidate, party FROM electionCandidates";
    $result = $mysqli->query($elections);

    unset($candidates);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $candidateInfo[] = $row['candidateID']; //Will be used for setting value attribute of <option>
        $electionID = $row['electionID']; //Used to get electionName for display purposes in <option>

        $getElectionName = "SELECT electionName FROM elections WHERE electionID = '$electionID'";
        $electionNameResult = $mysqli->query($getElectionName);
        $row2 = mysqli_fetch_assoc($electionNameResult);


        $candidateInfo[] = $row2['electionName'];
        $candidateInfo[] = $row['candidate'];
        $candidateInfo[] = $row['party'];
        $candidates[] = $candidateInfo;
        unset($candidateInfo);
    }

} else{
    header("location: welcome.php");
}


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $currentCandidateID = $_POST['canID'];

    $getVoteCount = "SELECT candidate, party, votes FROM electionCandidates WHERE candidateID = '$currentCandidateID'";
    $result = $mysqli->query($getVoteCount);
    $row = mysqli_fetch_assoc($result);
    $canInfo[] = $row['candidate'];
    $canInfo[] = $row['party'];
    $canInfo[] = $row['votes'];
    $allInfo[] = $canInfo;

    $getAllVotesForCandidate = "SELECT userID FROM electionVotes WHERE candidateID = '$currentCandidateID'";
    $result = $mysqli->query($getAllVotesForCandidate);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $userID = $row['userID'];
        $allUsers[] = $userID;
    }


    if (isset($allUsers))
    {
    $allInfo[] = $allUsers;
    }
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

<form action = "candidateDemographics.php" method = "post" enctype="multipart/form-data" id="electionChoice">
    Candidate Demographic For:<select id="candidateNames" name="canID">
    </select>
    <input type="submit">
</form>
<div id="candidateDiv">

</div>



<script type="text/javascript">
    var allCandidates = <?php echo json_encode($candidates); ?>;
</script>
<script type ="text/javascript">
    var allInfo = <?php echo json_encode($allInfo); ?>;
</script>

<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/navbar.js"></script>
<script src="../js/candidateDemographics.js"></script>
</body>

</html>
