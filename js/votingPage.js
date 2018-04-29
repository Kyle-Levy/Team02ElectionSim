/*
allElections.length = # of different elections
allElections[#][0] = infoArray
allElections[#][0][0] = electionID
allElections[#][0][1] = electionName
allElections[#][0][2] = startDate
allElections[#][0][3] = endDate
allElections[#][1] = candidateArray
allElections[#][1][Even #] = candidateName
allElections[#][1][Odd  #] = candidateParty

<h3><?=$allElections[0][0][1]?></h3>

    <div><label>Start: </label>electionStart <label>End: </label>electionEnd</div>
    <input type='radio' value='<?=$allElections[0][1][0]?>' name='<?=$allElections[0][0][0]?>'><?=$allElections[0][1][0]?>   <?=$allElections[0][1][1]?><br>
 */

//Processing allElections array into a form
for(var i = 0; i < allElections.length;i++){

    var electionStart = allElections[i][0][2];
    electionStart = makeDate(electionStart);
    var electionEnd = allElections[i][0][3];
    electionEnd = makeDate(electionEnd);

    if(currentlyRunning(new Date(),electionStart, electionEnd)) {
        var electionTable = $('<table class="election"></table>');
        var electionID = allElections[i][0][0];

        var electionName = allElections[i][0][1];
        var electionNameTR = $('<tr></tr>').append('<th colspan="3">' + electionName + '</th>')
        electionTable.append(electionNameTR);

        var startDate = "Start Date: " + electionStart.toDateString();
        var endDate = "End Date: " + electionEnd.toDateString();
        var datesTR = $('<tr></tr>').append('<th colspan="3">' +
            startDate + '<br>' + endDate + '</th>');
        electionTable.append(datesTR);

        var columnTitles = $('<tr></tr>');
        columnTitles.append('<th>Candidate Name</th>');
        columnTitles.append('<th>Candidate Party</th>');
        columnTitles.append('<th>Vote</th>');
        electionTable.append(columnTitles);

        //Add all candidates
        for (var j = 0; j < allElections[i][1].length; j += 2) {
            var candidateName = allElections[i][1][j];
            var party = allElections[i][1][j + 1];

            var person = $('<input>').attr({
                type: "radio",
                value: candidateName,
                name: electionID,
                required: true
            });

            var candidateTR = $('<tr></tr>');
            candidateTR.append('<td>' + candidateName +'</td>');
            candidateTR.append('<td>' + party + '</td>');
            candidateTR.append(person);
            electionTable.append(candidateTR);
        }

        $('#electionList').append(electionTable);
    }
}

function makeDate(mySQLDate){
    var yyyy = mySQLDate[0] + mySQLDate[1] + mySQLDate[2] + mySQLDate[3];

    var mm =  mySQLDate[5] +  + mySQLDate[6];
    mm = parseInt(mm) -1;//Because January = 0 and December = 11;

    var dd =  mySQLDate[8]  + mySQLDate[9];

    var returnDate = new Date (yyyy,mm,dd);

    return returnDate
}

function currentlyRunning(currentDate, startDate, endDate){
    return(currentDate >= startDate && currentDate < endDate)
}