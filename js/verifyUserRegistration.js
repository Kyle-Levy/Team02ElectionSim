var usersArr = allUsersAdmin;

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
    var confirm = $('<input>').attr({
        type: "radio",
        name: usersArr[i][0],
        value: 1,
        required: true
    });

    var deny = $('<input>').attr({
        type: "radio",
        name: usersArr[i][0],
        value: -1,
        required: true
    });

    var doNothing = $('<input>').attr({
        type: "radio",
        name: usersArr[i][0],
        value: 0,
        required: true,
        checked: true
    });

    var confirmTD = $('<td></td>').append(confirm);
    var denyTD = $('<td></td>').append(deny);
    var doNothingTD = $('<td></td>').append(doNothing);
    outerTR.append(confirmTD);
    outerTR.append(denyTD);
    outerTR.append(doNothingTD);
    $('#userTable').append(outerTR);
}