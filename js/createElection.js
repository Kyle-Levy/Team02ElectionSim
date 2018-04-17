$(document).on('click','#addCandidate',function(){

    var select = '<select name="politicalAffiliation">' +
        '<option value="Democratic">Democratic Party</option>' +
    '<option value="Republican">Republican Party</option>'+
    '<option value="Libertarian">Libertarian Party</option>'+
    '<option value="Green">Green Party</option>'+
    '<option value="Constitution">Constitution Party</option>'+
    '</select>';



    $('#candidateList').append('<li class="candidateInfo">' +'<input type = "text" name ="candidateName">'+ select  + '<input type = "image" src = "../resources/x.png" class ="deleteCandidate" alt ="Submit" width="25" height = "25" value = "Working" ></li>');

    });

$('#candidateList').on('click','.deleteCandidate',function(){
    var removeLi = this.parentElement;
    var liParent = removeLi.parentElement;
    liParent.removeChild(removeLi);
})