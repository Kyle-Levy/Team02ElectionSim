var navBar = $('#navBarList');
var roleNum = $('#roleNum').text();
var votingStatus = $('#votingStatus').text();
//All users can vote
if(roleNum >= 0 && votingStatus >0){
    navBar.append("<li><a href='vote.php' class='user'>Vote</a></li>");
}

if(roleNum >=1){
//Confirm voter is who they say they are (in-person)
    navBar.append("<li><a href='confirmVoter.php' class='manager'>Confirm Voter</a></li>");
}

if(roleNum >=2){
    navBar.append("<li><a href='verifyUserRegistration.php' class='admin'>Verify Voter</a></li>");
    navBar.append("<li><a href='createElection.php' class='admin'>Create Election</a></li>");
    //Creates elections and verifies registration manually
}

var logout = '<li><form action = "welcome.php" method ="post" enctype="multipart/form-data">' +
    '<button type="submit" id="logout" name="logout" value = "Logout">Logout</button>' +
    '</form></li>';


navBar.append(logout);

