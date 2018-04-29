<?php
/**
 * Created by PhpStorm.
 * User: Kyle Levy
 * Date: 4/28/2018
 * Time: 7:57 PM
 */
?>


<html>
<head>

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


<script src="../js/jquery-3.3.1.js"></script>
<script src="../js/navbar.js"></script>
</body>

</html>
