
$(document).ready(function(){
    loadeventsTojudgeCombo();
    loadcandidateTojudgeCombo();

    var eventid = $('#eventcombo4judge').val();
    loadCriteriaByEventId(eventid); //update table when combo event changed..

});

function loadeventsTojudgeCombo(){
    console.log('>loading data to combo-judge after clearing..');
    $.ajax({
        url: '../server/judge_events/index.php',
        async: false,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var decode = response;
            console.log('>loading data to combo-judge..');
            if (decode) {
                if (decode.childs.length > 0) {
                    for (var i = 0; i < decode.childs.length; i++) {
                        var row = decode.childs; 
                        var html = '<option value="'+row[i].eventid+'">'+row[i].eventname+'</option>';
                        $("#eventcombo4judge").append(html);
                    }
                }
            }
        },
        error: function(error) {
            toastr.error('Error', error.message);
            return;
        }






    });
}

function loadcandidateTojudgeCombo(){
    $("#candidatecombo4judge").html('');
    $("#candidatecombo4judge").html('<option value=""></option>');
    console.log('>loading data to combo-judge after clearing..');
    $.ajax({
        url: '../server/contestants/index.php',
        async: false,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var decode = response;
            console.log('>loading data to combo-judge..');
            if (decode) {
                if (decode.childs.length > 0) {
                    for (var i = 0; i < decode.childs.length; i++) {
                        var row = decode.childs; 
                        var html = '<option value="'+row[i].contestantid+'">'+row[i].name+'</option>';
                        $("#candidatecombo4judge").append(html);
                    }  
                }
            }
        },
        error: function(error) {
            toastr.error('Error', error.message);
            return;
        }
    });
}

function loadContestantWhenEventComboChange(eventid){
    
    clear();
    $("#candidatecombo4judge").html('');
    console.log('>loading data to combo-judge after clearing..');
    $.ajax({
        url: '../server/contestants_Ext1/index.php/'+eventid,
        async: false,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var decode = response;
            //console.log(response);
            console.log('>loading data to combo-judge..');
            if (decode) {
                if (decode.childs.length > 0) {
                    for (var i = 0; i < decode.childs.length; i++) {
                        var row = decode.childs; 
                        var html = '<option value="'+row[i].contestantid+'">'+row[i].name+'</option>';
                        $("#candidatecombo4judge").append(html);
                    }
                }
            }
        },
        error: function(error) {
 
           toastr.error('Error!', error.message);
            return;
        }
    });
var eventid = $('#eventcombo4judge').val();
loadCriteriaByEventId(eventid); //update table when combo event changed..
}

function clear(){
    $('.candidatecombo4judge .select2-choice .select2-chosen').html('');
}

function loadCriteriaByEventId(id){
    console.log('here at loadCriteriaByEventId() fuction');
    var eventid = $('#eventcombo4judge').val();
    var defaultscore = 0;
    console.log('>loading data to judge table..');
    $("#sample_editable_6 tbody").html('');
    $.ajax({
        url: '../server/scores/index.php/'+id,
        async: false,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var decode = response;
            if (decode) {
                if (decode.childs.length > 0) {
                    for (var i = 0; i < decode.childs.length; i++) {
                        var row = decode.childs; 

                        var criteriaid = row[i].criteriaid.toString();
                        var rw = i.toString();
                        var x = 'i';
                        var r = [criteriaid + x + i];
                        var z = r.toString();

                        var html = '<tr>\
                                        <td style="display:none" width="130px"><input id="criteriaid'+rw+'" readonly value="'+row[i].criteriaid+'" style="border: 0px;background-color: #FFFFFF;" type="label" class="form-control"></td>\
                                        <td>' + row[i].criterianame + '</td>\
                                        <td>' + row[i].percentage + '%</td>\
                                        <td width="50px"><input type="number" onfocus="this.blur()" id="score'+rw+'" background-color: #F4F7F7;" min="70" max="100" type="number" placeholder="'+defaultscore+'"></td>\
                                        <td width="150px" style="text-align:center"><a onclick=savescore('+rw+') class="edit6'+rw+'">Save</a></td>\
                                    </tr>';

                        $("#sample_editable_6 tbody").append(html);
                    }
                }
            }
        },
        error: function(error) {
             toastr.error('Error', error.message);
            return;
        }
    });
}


function savescore(fieldId){
    var action = $('.edit6'+fieldId).html();
    if(action=='Save'){
        //alert('save function here');
        //document.getElementById("score"+fieldId).readOnly = true;
        //$('.edit6'+fieldId).html('Update');
       
        var criteriaid = $('#criteriaid'+fieldId).val();
        var score = $('#score'+fieldId).val();
        //var judgeid = 1;

        var empty = false;
        $('input[type="text"]').each(function() {
            $(this).val($(this).val().trim());
        });

        if ($('#eventcombo4judge').val() == '') {
            $('#eventcombo4judge').next('span').text('Activity Name is required!');
            empty = true;
        }

        if ($('#candidatecombo4judge').val() == '') {
            $('#candidatecombo4judge').next('span').text('Event Name is required!');
            empty = true;
        }
        if (score == '') {
            empty = true;
        }
        //if (judgeid == '') {
        //    empty = true;
       // }
        if (criteriaid == '') {
            empty = true;
        }

        if (empty == true) {
            toastr.error('Please input all the required fields correctly.', 'error!');
            return false;
        }
        $.ajax({
                url: '../server/scores/index.php',
                async: false,
                type: 'POST',
                crossDomain: true,
                dataType: 'json',
                data: {
                    eventid: $('#eventcombo4judge').val(),
                   // judgeid: judgeid,
                    criteriaid: criteriaid,
                    contestantid:$('#candidatecombo4judge').val(),
                    score:score
                },
                success: function(response) {
                    var decode = response;
                    console.log(decode);
                    if (decode.success == true) {
                         toastr.success('Server response', 'Records Successfully Saved!');
                         $('.edit6'+fieldId).html('Update');  
                    } else if (decode.success === false) {
                        toastr.error('Failed Saving Records!', 'Error!');
                    } 
                },
                error: function(error) { 
                    toastr.success('Server responds!', error.responseText);
                    //$('.edit6'+fieldId).html('Update');
                    return;
                }
        
        });
    }
    else if(action=='Update'){
        //alert('edit function here');
        //$('.edit6'+fieldId).html('Save');
        //document.getElementById("score"+fieldId).readOnly = false;

        var criteriaid = $('#criteriaid'+fieldId).val();
        var score = $('#score'+fieldId).val();
        var judgeid = 10;

        var empty = false;
        $('input[type="text"]').each(function() {
            $(this).val($(this).val().trim());
        });

        if ($('#eventcombo4judge').val() == '') {
            $('#eventcombo4judge').next('span').text('Start date is required.');
            empty = true;
        }

        if ($('#candidatecombo4judge').val() == '') {
            $('#candidatecombo4judge').next('span').text('End date is required.');
            empty = true;
        }
        if (score == '') {
            empty = true;
        }
        if (judgeid == '') {
            empty = true;
        }
        if (criteriaid == '') {
            empty = true;
        }

        if (empty == true) {
            toastr.error('Please input all the required fields correctly.', 'error!');
            return false;
        }
        
        $.ajax({
                url: '../server/scores/index.php',
                async: false,
                type: 'PUT',
                crossDomain: true,
                dataType: 'json',
                data: {
                    eventid: $('#eventcombo4judge').val(),
                    judgeid: judgeid,
                    criteriaid: criteriaid,
                    contestantid:$('#candidatecombo4judge').val(),
                    score:score
                },
                success: function(response) {
                    var decode = response;
                    if (decode.success == true) {
                        toastr.success('Server response', 'Records successfully updated!');
                    } else if (decode.success === false) {
                        toastr.error('failed saving records!', 'error!');
                    } 
                },
                error: function(error) { 
                    toastr.error('Server responds!', error.responseText);
                    return;
                }
        
        });
    }
    
}
$(document).on("click", "#sample_editable_6_new", function() {
    $('#modalAdd6').modal('show');
});