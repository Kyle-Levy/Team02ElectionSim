$(document).on('click','#addCandidate',function(){
        var newCandidate = $('#newCandidate').val();
        var candidateParty = $('#candidateParty').val();

        if(newCandidate.length > 0 && candidateParty.length > 0){
            $('#candidateList').append('<li class="candidateInfo">' +'<p>' + newCandidate + '</p>'+ ', ' + '<p>' + candidateParty + '</p>'+ '</li>');
        }
    });
