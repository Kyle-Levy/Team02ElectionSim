<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($_POST['candidateName'] as $value) {
        echo $value;
    }
}

//Check database for candidate first, then add if not there.

?>

<html>
<head>
    <link href="../styles/homepage.css" type ="text/css" rel="stylesheet" />
</head>
<body>
<div id = "page">
    <div>Create an election</div>
    <br>
    <div class="row">
        <div class="column">Candidate Name</div>
        <div class="column">Candidate Party</div>

    </div>
    <p id="roleNum"><?= $_SESSION['role']?></p>
    <form action = "createElection.php" method ="post" enctype="multipart/form-data">
    <ol id = "candidateList">
        <! Mandatory candidate one>
        <li><input type = "text" name="candidateName" required><select id="politicalParty" name="politicalAffiliation" required>
            <option value="Democratic">Democratic Party</option>
            <option value="Republican">Republican Party</option>
            <option value="Libertarian">Libertarian Party</option>
            <option value="Green">Green Party</option>
            <option value="Constitution">Constitution Party</option>
        </select></li>
        <br>
        <! Mandatory candidate two>
        <li><input type = "text" name="candidateName" required><select id="politicalParty" name="politicalAffiliation" required>
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
</body>
</html>


