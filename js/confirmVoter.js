var usersArr = allUsers;

for(var i = 0; i<usersArr.length;i++){
    var outerTR = $('<tr></tr>');

    //usersArr[i][j] where i is the current user, and j is a detail which corresponds
    //to how the array is constructed in the initial creating of the array in confirmVoter.php
    for(var j = 0; j<usersArr[i].length;j++){
        var innerTD = $('<td></td>');
        var detail = usersArr[i][j];
        innerTD.append(detail);
        outerTR.append(innerTD);
    }

    //Append with checkbox that has it's (name and value) = to the userID, so when posted, if it is there, you change that user's votingStatus to 1.
    var check = $('<input>').attr({
        type: "checkbox",
        name: usersArr[i][0],
        value: usersArr[i][0]
    });

    var checkboxTD = $('<td></td>').append(check);
    outerTR.append(checkboxTD);
    $('#userTable').append(outerTR);
}