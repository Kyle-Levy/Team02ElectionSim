<?php
session_start();
$_SESSION['message'] = '';

$mysqli = new mysqli('team02electionsim.cd0yrfnixnjv.us-east-2.rds.amazonaws.com', 'Team02Member', 'secret', 'Team02ElectionSim');

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $electionName = $mysqli->real_escape_string($_POST['electionName']);
    $start = $mysqli->real_escape_string($_POST['start']);
    $end = $mysqli->real_escape_string($_POST['end']);


    $electionTableQuery = "INSERT INTO elections (electionName, startDate, endDate)" . "VALUES ('$electionName', '$start', '$end')";


    if($mysqli->query($electionTableQuery) === true){
        //Creating election name, start, and end, successful, continue

        //Get autocreated electionID
        $getElectionQuery = "SELECT electionID from elections where (electionName = '$electionName' and startDate ='$start' and endDate ='$end')";
        $electionIdQuery = $mysqli->query($getElectionQuery);
        $row = mysqli_fetch_assoc($electionIdQuery);

        $electionID = $row['electionID'];

        //Puts all candidates names, and their political affliation in the electionCadidates table, alongside 0 votes as well as the electionID
        for($i = 0; $i < count($_POST['candidateName']); $i++){
            $candidate = $_POST['candidateName'][$i];
            $party = $_POST['politicalAffiliation'][$i];

            $electionCandidateTable = "INSERT INTO electionCandidates (electionID, candidate, party, votes)" . "VALUES ('$electionID', '$candidate', '$party', 0)";
            $mysqli->query($electionCandidateTable);
        }

        for($i = 0; $i < count($_POST['precinct']); $i++){
            $precinct = $_POST['precinct'][$i];
            $electionPrecinctTable = "INSERT INTO electionPrecinct (electionID, precinct)" . "VALUES ('$electionID', '$precinct')";

            if(!$mysqli->query($electionPrecinctTable)){
                $_SESSION['message'] = "Query could not be inserted into electionPrecinct table";
            }
        }

    } else {
        $_SESSION['message'] = "Election could not be added to election table";
    }
    
    
    
    
    

}



?>

<html>
<head>
    <link href="../styles/homepage.css" type ="text/css" rel="stylesheet" />
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

<div id = "page">
    <p><?=$_SESSION['message']?></p>
    <h3>Create an election</h3>
    <br>
    <p id="roleNum"><?= $_SESSION['role']?></p>
    <form action = "createElection.php" method ="post" enctype="multipart/form-data">
        <label>Name Of Election:</label>
        <input type="text" name="electionName">
        <br>
        <label>Start date:</label>
        <input type="date" name="start">

        <label>End date:</label>
        <input type="date" name="end">

        <ol id="precinctList">
            <li><input type ="text" name="precinct[]"></li>
        </ol>

        <input type="button" id="addPrecinct" value="Add Precinct">

        <div class="row">
            <div class="column">Candidate Name</div>
            <div class="column">Candidate Party</div>

        </div>
    <ol id = "candidateList">
        <! Mandatory candidate one>
        <li><input type = "text" name="candidateName[]"><select id="politicalParty" name="politicalAffiliation[]">
            <option value="Democratic">Democratic Party</option>
            <option value="Republican">Republican Party</option>
            <option value="Libertarian">Libertarian Party</option>
            <option value="Green">Green Party</option>
            <option value="Constitution">Constitution Party</option>
        </select></li>
        <br>
        <! Mandatory candidate two>
        <li><input type = "text" name="candidateName[]"><select id="politicalParty" name="politicalAffiliation[]">
            <option value="Democratic">Democratic Party</option>
            <option value="Republican">Republican Party</option>
            <option value="Libertarian">Libertarian Party</option>
            <option value="Green">Green Party</option>
            <option value="Constitution">Constitution Party</option>
        </select></li>
    </ol>
        <input type ="button" id="addCandidate" value = "Add Candidate">
        <input type = "submit" value = "Submit Election">
    </form>





</div>
<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/createElection.js"></script>
<script src="../js/navbar.js"></script>
</body>
</html>


