$(document).on('click','#addCandidate',function(){

    var select = '<select name="politicalAffiliation[]">' +
        '<option value="Democratic">Democratic Party</option>' +
    '<option value="Republican">Republican Party</option>'+
    '<option value="Libertarian">Libertarian Party</option>'+
    '<option value="Green">Green Party</option>'+
    '<option value="Constitution">Constitution Party</option>'+
    '</select>';



    $('#candidateList').append('<li class="candidateInfo">' +'<input type = "text" name ="candidateName[]">'+ select  + '<input type = "image" src = "../resources/x.png" class ="deleteCandidate" alt ="button" width="25" height = "25" value = "Working" ></li>');

    });


$(document).on('click','#addPrecinct',function(){




    $('#precinctList').append('<li><input type ="text" name="precinct[]">' + '<input type = "image" src = "../resources/x.png" class ="deletePrecinct" alt ="button" width="25" height = "25" value = "Working" ></li>');

});

$('#candidateList').on('click','.deleteCandidate',function(){
    var removeLi = this.parentElement;
    var liParent = removeLi.parentElement;
    liParent.removeChild(removeLi);
});

$('#precinctList').on('click','.deletePrecinct',function(){
    var removeLi = this.parentElement;
    var liParent = removeLi.parentElement;
    liParent.removeChild(removeLi);
});