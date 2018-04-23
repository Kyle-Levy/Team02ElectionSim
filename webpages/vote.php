<?php
/**
 * Created by PhpStorm.
 * User: Kyle Levy
 * Date: 4/18/2018
 * Time: 4:52 PM
 */
session_start();

$mysqli = new mysqli('team02electionsim.cd0yrfnixnjv.us-east-2.rds.amazonaws.com', 'Team02Member', 'secret', 'Team02ElectionSim');

if(isset($_SESSION['username'])) {

    $username = $mysqli->real_escape_string($_SESSION['username']);

    //Get precinct from username.
    $getPrecinctFromUsername = "SELECT id,city FROM users where (username = '$username')";
    $result = $mysqli->query($getPrecinctFromUsername);
    $row = mysqli_fetch_assoc($result);
    $userId = $row['id'];
    $precinct = $row['city']; //Change city to precinct

    //Find all electionID's in electionPrecinct where precinct = '$precinct'
    $getElectionIDs = "SELECT electionID FROM electionPrecinct where precinct = '$precinct'";
    $result = $mysqli->query($getElectionIDs);


    //If there are elections for the user's precinct
    if ($result->num_rows > 0) {

        //Get all he elections
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $allElectionIDS[] = $row['electionID'];
        }

        //Check if user has already voted on the elections available
        //In electionVoters check for all id's above if there is a row where electionID, username is an entry.
        //Create an array of all of those
        $getVotedOnIDs = "SELECT electionID FROM electionVotes WHERE userID = '$userId'";
        unset($result);
        $result = $mysqli->query($getVotedOnIDs);

        //If the user has voted, this will find what elections they voted for
        if ($result->num_rows > 0) {

            //Create previous voted on election array
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $votedOnElectionIDS[] = $row['electionID'];
            }


            //Remove ids from elections already voted on one by one
            for ($i = 0; $i < count($votedOnElectionIDS); $i++) {
                if (($key = array_search($votedOnElectionIDS[$i], $allElectionIDS)) !== false) {
                    unset($allElectionIDS[$key]);
                }
            }
        }

        //If there are any electionIDS
        /*
         * for(allElectionIDS){
         * create an array that holds all info for this election
         *
         * have the electionID and get the name, start, and end date from elections table and put all 4 into an array ($electionInfo[])
         *
         * use the electionID to get the candidates and their party, evens are name, odds are party
         *
         * }
         */

        if (count($allElectionIDS) > 0) {

            //Looking at all of the electionIDS
            for ($i = 0; $i < count($allElectionIDS); $i++) {
                //Get the current electionID
                $currentID = $allElectionIDS[$i];

                //Grab all of the info about current election
                $electionInfoQuery = "SELECT * FROM elections WHERE electionID = '$currentID'";
                $result = $mysqli->query($electionInfoQuery);
                $row = mysqli_fetch_assoc($result);

                //Store all election info into an array,
                // store that array into thisElections array,
                // then clear the election info array for later use
                $electionInfo[] = $row['electionID'];
                $electionInfo[] = $row['electionName'];
                $electionInfo[] = $row['startDate'];
                $electionInfo[] = $row['endDate'];
                $thisElection[] = $electionInfo;
                unset($electionInfo);

                //Get all of the candidates who are in this election
                $getCandidates = "SELECT candidate, party FROM electionCandidates WHERE electionID ='$currentID'";
                $result = $mysqli->query($getCandidates);

                //Store all candidate info into an array and clear the name and party to be safe,
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $candidateName = $row['candidate'];
                    $party = $row['party'];

                    $candidates[] = $candidateName;
                    $candidates[] = $party;

                    unset($candidateName);
                    unset($party);

                }

                //Store the candidates/party array into this election's array,
                //then clear the candidates
                // Next store this election into the overall election array
                // and clear thisElection array to be used again if there is another election
                $thisElection[] = $candidates;
                unset($candidates);
                $allElections[] = $thisElection;
                unset($thisElection);
            }


        } else {
            //All elections have been voted on
        }

    } else {
        //No elections available for your precinct/haven't even voted on any

    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        //$name is the electionID and $val is the vote for that election
        foreach ($_POST as $name => $val) {
            $getCandidateVote = "SELECT votes,candidateID FROM electionCandidates WHERE (candidate = '$val' and electionID = '$name')";
            $result = $mysqli->query($getCandidateVote);
            $row = mysqli_fetch_assoc($result);
            $votes = intval($row['votes']);
            $votes = $votes + 1;
            $canID = $row['candidateID'];

            $updateCandidateVotes = "UPDATE electionCandidates SET votes='$votes' WHERE candidateID = '$canID'";
            $mysqli->query($updateCandidateVotes);


            $updateUserVotes = "INSERT INTO electionVotes (electionID, userID, candidateID) VALUES ('$name','$userId','$canID')";


            $mysqli->query($updateUserVotes);
            header("location: welcome.php");
    }
    }
}


?>

<html>
<head>

</head>

<body>

<form action = "vote.php" method = "post" enctype="multipart/form-data" id="votingForm">
    <ul id="electionList">


    </ul>

    <input type="submit" value="Vote.">
</form>

<script src="../js/jquery-3.3.1.js"></script>
<script type="text/javascript">
var allElections = <?php echo json_encode($allElections); ?>;

</script>
<script src="../js/votingPage.js"></script>
</body>
</html>
