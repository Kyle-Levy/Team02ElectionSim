var roleNum = $('#roleNum').text();

//All users can vote

if(roleNum == 0){

    $('ul').append('<li>' + "Vote." + '</li>');
} else if(roleNum ==1){
//Confirm voter is who they say they are (in-person)
} else if(roleNum ==2){
    $('ul').append('<li>' + '<a href="../webpages/createElection.php">Create election.</a>' + '</li>');
    //Creates elections and verifies registration manually
}




