var votingStatus = $('#votingStatus').text();
var verifiedStatus = $('#verifiedStatus').text();
var emailStatus = $('#emailStatus').text();

var verificationList = $('#status');

if(votingStatus == 0){
    votingStatus = 'not ';
} else{
    votingStatus = ''
}

if(verifiedStatus == 0){
    verifiedStatus = 'not ';
}else{
    verifiedStatus = '';
}

if(emailStatus ==0){
    emailStatus = 'not ';
} else{
    emailStatus = '';
}
verificationList.append('<li>You are ' + votingStatus + 'registered to vote.</li>');
verificationList.append('<li>You have ' + verifiedStatus + 'been verified by an admin.</li>');
verificationList.append('<li>You have ' + emailStatus + 'activated your email.</li>');