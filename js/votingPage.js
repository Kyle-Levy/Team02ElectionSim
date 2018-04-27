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
    var outerLI = $("<li></li>");
    var electionDiv = $('<table class="election"></table>');
    var electionID = allElections[i][0][0];
    var electionName = allElections[i][0][1];
    var electionStart = allElections[i][0][2];
    electionStart = makeDate(electionStart).toDateString();

    //TODO only show election if today's date is inbetween the two elections.

    var electionEnd = allElections[i][0][3];
    var message = '<h3>' + electionName + '</h3>' + '<div><label>Start: </label>'+ electionStart + '<label>End: </label>' + electionEnd +'</div>';
    electionDiv.append(message);

    //Add all candidates
    for(var j = 0; j < allElections[i][1].length;j+=2){
        var candidateName = allElections[i][1][j];
        var party = allElections[i][1][j+1];

        var person = $('<input>').attr({
            type: "radio",
            value: candidateName,
            name: electionID,
            required: true
        });

        var tail = candidateName + '     '  + party +'<br>';
        electionDiv.append(person);
        electionDiv.append(tail);
        outerLI.append(electionDiv);
    }

    $('#electionList').append(outerLI);
}

function getDate(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1;
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd = '0'+dd
    }

    if(mm<10) {
        mm = '0'+mm
    }

    today = mm + '/' + dd + '/' + yyyy;
    var check = new Date()
}

function makeDate(mySQLDate){
    var yyyy = mySQLDate[0] + mySQLDate[1] + mySQLDate[2] + mySQLDate[3];

    var mm =  mySQLDate[5] +  + mySQLDate[6];
    mm = parseInt(mm) -1;//Because January = 0 and December = 11;

    var dd =  mySQLDate[8]  + mySQLDate[9];

    var returnDate = new Date (yyyy,mm,dd);

    return returnDate
}