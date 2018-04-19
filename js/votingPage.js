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
    var message = '<li>';
    var electionID = allElections[i][0][0];
    var electionName = allElections[i][0][1];
    var electionStart = allElections[i][0][2];
    var electionEnd = allElections[i][0][3];
    message += '<h3>' + electionName + '</h3>' + '<div><label>Start: </label>'+ electionStart + '<label>End: </label>' + electionEnd +'</div>';

    for(var j = 0; j < allElections[i][1].length;j+=2){
        var name = allElections[i][1][j];
        var party = allElections[i][1][j+1];


        var person = '<div>' + '<input type="radio" id="currentInput">' + name + '      ' + party + '</div>';
        $('#currentInput').attr('value', name);
        $('#currentInput').attr('name', electionID);
        $('#currentInput').removeAttr('id');
        message+= person;
    }
    message+='</li>';
    $('#electionList').append(message);
}

/*
for(var i=0; i<test.length;i++){
$('#tester').append('<li>' +test[i]+ '</li>');
}*/