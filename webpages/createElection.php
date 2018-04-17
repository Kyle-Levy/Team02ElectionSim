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
    <br>
    <div class="row">
        <div class="column">Candidate Name</div>
        <div class="column">Candidate Party</div>

    </div>
    <p id="roleNum"><?= $_SESSION['role']?></p>
    <form>
    <ol id = "candidateList">
        <! Mandatory candidate one>
        <li><input type = "text" name="candidateName"><select id="politicalParty" name="politicalAffiliation">
            <option value="Democratic">Democratic Party</option>
            <option value="Republican">Republican Party</option>
            <option value="Libertarian">Libertarian Party</option>
            <option value="Green">Green Party</option>
            <option value="Constitution">Constitution Party</option>
        </select></li>
        <br>
        <! Mandatory candidate two>
        <li><input type = "text" name="candidateName"><select id="politicalParty" name="politicalAffiliation">
            <option value="Democratic">Democratic Party</option>
            <option value="Republican">Republican Party</option>
            <option value="Libertarian">Libertarian Party</option>
            <option value="Green">Green Party</option>
            <option value="Constitution">Constitution Party</option>
        </select></li>


    </ol>
    <input type = "submit" value = "Submit Election">
    </form>
    <! Add a form submit button>
    <input type ="submit" id="addCandidate" value = "Add Candidate">



</div>
<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/createElection.js"></script>
</body>
</html>


