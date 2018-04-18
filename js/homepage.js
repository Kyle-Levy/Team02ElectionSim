var roleNum = $('#roleNum').text();


if(roleNum == 0){

    $('ul').append('<li>' + "Vote." + '</li>');
} else if(roleNum ==1){
    
} else if(roleNum ==2){
    $('ul').append('<li>' + '<a href="../webpages/createElection.php">Create election.</a>' + '</li>');
}




