var candidatesArr = allCandidates;



//Put all elections into a <select></select> dropdown bar
for(var i = 0; i<candidatesArr.length;i++){

    var canID = candidatesArr[i][0];
    var electionName = candidatesArr[i][1];
    var candidateName = candidatesArr[i][2];
    var candidateParty = candidatesArr[i][3];


    var candidateOption = $('<option></option>').attr({
        value: canID
    });

    candidateOption.append(electionName + ' - ' + candidateName + ' - ' + candidateParty);

    $('#candidateNames').append(candidateOption);
}


if(allInfo != null){
    var canName = allInfo[0][0];
    var party = allInfo[0][1];
    var votes = allInfo[0][2];
    var userArr = allInfo[1];
    var candidateDiv = $('#candidateDiv');

    var candidateInfo = $('<table></table>');

    var canInfoTR = $('<tr></tr>');
    canInfoTR.append('<th>Name: ' + canName + '</th>');
    canInfoTR.append('<th>Party: ' + party + '</th>');
    canInfoTR.append('<th>Votes: ' + votes + '</th>');

    candidateInfo.append(canInfoTR);

    candidateDiv.append(candidateInfo);

    var userVoteList = $('<ul id="userVoteList"></ul>');

    for(var i = 0; i< userArr.length; i++){
        userVoteList.append('<li>' + userArr[i] + '</li>')
    }
    candidateDiv.append('<h3>UserIDs:</h3>');
    candidateDiv.append(userVoteList);


}

function makeDateObject(mySQLDate){
    var yyyy = mySQLDate[0] + mySQLDate[1] + mySQLDate[2] + mySQLDate[3];

    var mm =  mySQLDate[5] +  + mySQLDate[6];
    mm = parseInt(mm) -1;//Because January = 0 and December = 11;

    var dd =  mySQLDate[8]  + mySQLDate[9];

    var returnDate = new Date (yyyy,mm,dd);

    return returnDate
}

function indexOfLargest(voteArray){

    var smallest = voteArray[0];
    var index = 0;
    for(var i = 0; i < voteArray.length; i++){
        if(voteArray[i] > smallest){
            smallest = voteArray[i];
            index = i;
        }
    }

    return index;
}

//Use this before displaying the winner of an election.
//if(currentlyRunning(new Date(),electionStart, electionEnd)) {