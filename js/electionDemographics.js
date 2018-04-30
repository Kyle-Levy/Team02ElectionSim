var electionsArr = allElections;



//Put all elections into a <select></select> dropdown bar
for(var i = 0; i<electionsArr.length;i++){

    var electionID = electionsArr[i][0];
    var electionName = electionsArr[i][1];

    var electionOption = $('<option></option>').attr({
        value: electionID
    });

    electionOption.append(electionName);

    $('#electionNames').append(electionOption);
}


if(currentElectionInfo != null){
    var electionName = currentElectionInfo[0][0];

    var electionStart = currentElectionInfo[0][1];
    electionStart = makeDateObject(electionStart);

    var electionEnd = currentElectionInfo[0][2];
    electionEnd = makeDateObject(electionEnd);

    var precincts = currentElectionInfo[1];
    var candidateArrays = currentElectionInfo[2];

    var today = new Date();


    var electionIsOver = (electionEnd < today);
    var electionInProgress = (today > electionStart && electionEnd > today);

    var progressString;
    if(electionIsOver){
        progressString = "Status: Ended";
    } else if(electionInProgress){
        progressString = "Status: In Progress";
    } else{
        progressString = "Status: Upcoming";
    }

    var electionInfo = $('<table></table>');

    var nameTR = $('<tr><th colspan="2">' + electionName + '</th></tr>');
    var datesTR = $('<tr><th> Start Date: ' + electionStart.toDateString() + '</th><th> End Date: ' + electionEnd.toDateString() + '</th></tr>')
    var statusTR = $('<tr><th colspan="2">' + progressString + '</th></tr>');
    electionInfo.append(nameTR);
    electionInfo.append(datesTR);
    electionInfo.append(statusTR);



    var precinctList = $('<ul id="precinctList"></ul>');

    for(i = 0; i < precincts.length;i++){
        precinctList.append('<li class="precinct">' + precincts[i] + '</li>');
    }




    var electionTable = $('<table></table>');

    var headerTR = $('<tr></tr>');
    headerTR.append('<th> Candidate Name </th>');
    headerTR.append('<th> Candidate Party </th>');
    headerTR.append('<th> Votes </th>');

    electionTable.append(headerTR);



    var voteArray = [];

    for(i = 0; i< candidateArrays.length;i++){
        var candidateTR = $('<tr></tr>');
        //Candidate Name
        candidateTR.append('<td>' + candidateArrays[i][0] + '</td>');
        //Candidate Party
        candidateTR.append('<td>' + candidateArrays[i][1] + '</td>');
        //Candidate Votes
        candidateTR.append('<td>' + candidateArrays[i][2] + '</td>');
        voteArray.push(parseInt(candidateArrays[i][2]));

        electionTable.append(candidateTR);
    }

    if(electionIsOver){
        //Find the winner
        var indexOfWinner = indexOfLargest(voteArray);
        var winnerName = candidateArrays[indexOfWinner][0];

        var winnerTR = $('<tr><th colspan="2">Winner: ' + winnerName + '</th></tr>');
        electionInfo.append(winnerTR);
    }

    $('#electionDiv').append(electionInfo);
    $('#electionDiv').append('<h3>Precincts:</h3>');
    $('#electionDiv').append(precinctList);
    $('#electionDiv').append(electionTable);
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