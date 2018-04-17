<?php
session_start();


?>

<html>
<head>
    <link href="../styles/homepage.css" type ="text/css" rel="stylesheet" />
</head>
<body>
<div id = "page">
    <div>Create an election</div>
    <p id="roleNum"><?= $_SESSION['role']?></p>
    <ul id = "candidateList">
    </ul>

    <span>
    <label for="newCandidate">New Candidate: </label>
    <input type = "text" id="newCandidate">
    <label for="candidateParty">Candidate's Party</label>
    <input type ="text" id="candidateParty"</li>
    </span>

    <input type ="submit" id="addCandidate" value = "Add Candidate">

</div>
<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/createElection.js"></script>
</body>
</html>


