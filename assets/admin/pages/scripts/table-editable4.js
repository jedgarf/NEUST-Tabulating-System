
var SecretPassphrase = 'dhanVincent';  // you may edit 'dhanVincent' but please dont remove this ..

$(document).ready(function() {
    loadjudgecombo();
    getjudges();

    // this is for the encryption -->
    // var encrypted = CryptoJS.AES.encrypt('your string', "Secret Passphrase");
    // var decrypted = CryptoJS.AES.decrypt(encrypted, "Secret Passphrase");
    //decrypted.toString(CryptoJS.enc.Utf8);

});

var TableEditable4 = function () {

    var handleTable4 = function () {

        var table4 = $('#sample_editable_4');

        var oTable4 = table4.dataTable({

            // Uncomment below line("dom" parameter) to fix the dropdown overflow issue in the datatable cells. The default datatable layout
            // setup uses scrollable div(table-scrollable) with overflow:auto to enable vertical scroll(see: assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js). 
            // So when dropdowns used the scrollable div should be removed. 
            //"dom": "<'row'<'col-md-6 col-sm-12'l><'col-md-6 col-sm-12'f>r>t<'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>",

            "lengthMenu": [
                [-1, 5, 15, 20],
                ["All", 5, 15, 20] // change per page values here
            ],

            // Or you can use remote translation file
            //"language": {
            //   url: '//cdn.datatables.net/plug-ins/3cfcc339e89/i18n/Portuguese.json'
            //},

            // set the initial value
            "pageLength": 10,

            "language": {
                "lengthMenu": " _MENU_ records"
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ] // set first column as a default sort by asc
        });

        var tableWrapper4 = $("#sample_editable_4_wrapper");

        tableWrapper4.find(".dataTables_length select").select2({
            showSearchInput: false //hide search box with special css class
        }); // initialize select3 dropdown

    }

    return {

        //main function to initiate the module
        init: function () {
            handleTable4();
        }

    };

}();

//------------------------------------------------------------------my code---------------------------------------------------------------------

function clearjudgefields(){
    $("#judgefname").val('');
    $("#judgemname").val('');
    $("#judgelname").val('');
    $("#judgeuname").val('');
    $("#judgepword").val('');
    $("#cjudgepword").val('');
    $("#cjudgegender").val('');
}

function loadjudgecombo() {
    $("#judgecombo").html('');
    console.log('>loading data to combo-judge after clearing..');
    $.ajax({
        url: '../server/events/index.php',
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
                        $("#judgecombo").append(html);
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

function saveJudge(){

    var empty = false;
    $('input[type="text"]').each(function() {
        $(this).val($(this).val().trim());
    });

    if ($("#judgefname").val() == '') {
        $("#judgefname").next('span').text('First Name is required.');
        empty = true;
    }

    if ($("#judgemname").val() == '') {
        $("#judgemname").next('span').text('Middle Name is required.');
        empty = true;
    }

    if ($("#judgelname").val() == '') {
        $("#judgelname").next('span').text('Last Name is required.');
        empty = true;
    }

    if ($('#judgeuname').val() == '') {
        $('#judgeuname').next('span').text('username is required.');
        empty = true;
    }
    if ($('#judgepword').val() == '') {
        $('#judgepword').next('span').text('password is required.');
        empty = true;
    }
    if ($('#cjudgepword').val() == '' || $('#cjudgepword').val() != $('#judgepword').val()) {
        $('#cjudgepword').next('span').text('password did not match');
        empty = true;
    }
    if ($('#judgecombo').val() == '') {
        $('#judgecombo').next('span').text('Start date is required.');
        empty = true;
    }
    if($('#cjudgepword').val() != $('#judgepword').val()){
        $('#cjudgepword').next('span').text('password did not match');
        toastr.error('Error', 'password did not match');
        empty = true;
    }
    if($('#cjudgegender').val() == ''){
        $('#cjudgegender').next('span').text('Please input gender');
        toastr.error('Error', 'gender has no value');
        empty = true;
    }
    if (empty == true) {
        toastr.error('Error in Textfield!', 'Please input all the required fields correctly!');
        return false;
    }



    $.ajax({
            url: '../server/judges/index.php',
            async: false,
            type: 'POST',
            crossDomain: true,
            dataType: 'json',
            data: {
                judgefname: $('#judgefname').val(),
                judgemname: $('#judgemname').val(),
                judgelname: $('#judgelname').val(),
                judgeuname: $('#judgeuname').val(),
                judgepword:$('#judgepword').val(),
                eventid:$('#judgecombo').val(),
                gender:$('#judgegender').val()

            },
            success: function(response) {
                var decode = response;
                if (decode.success == true) {
                    console.log('records saved in judge account');
                    getjudges();
                    toastr.success('Success', 'Records successfully inserted!');
                    clearjudgefields();
                } else if (decode.success === false) {
                    console.log('failed saving records');
                    toastr.error('Failed saving records!',decode.msg);
                    return;
                }
            },
            error: function(error) {
                toastr.error('Error', error.message);
                return;
            }
    });
}

function getjudges() {
    console.log('>loading data to judge table..');
    $("#sample_editable_4 tbody").html('');
    $.ajax({
        url: '../server/judges/index.php',
        async: false,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var decode = response;
            if (decode) {
                if (decode.childs.length > 0) {
                    for (var i = 0; i < decode.childs.length; i++) {
                        var row = decode.childs; 
                        var html = '<tr>\
                                        <td style="display:none">' + row[i].userid + '</td>\
                                        <td>' + row[i].userfirstname + '\
                                        ' + row[i].usermiddlename + '\
                                        ' + row[i].userlastname + '</td>\
                                        <td>' + row[i].username + '</td>\
                                        <td style="display:none">' + CryptoJS.AES.encrypt(row[i].password, SecretPassphrase) + '</td>\
                                        <td>' + row[i].gender + '</td>\
                                        <td>' + row[i].gender + '</td>\
                                        <td><a data-id="'+row[i].userid+'" href="javascript:void(0)" data-toggle="modal" class="config judgemodal" data-original-title="" title="">Edit</td>\
                                        <td><a onClick="confirmjudgedelete('+row[i].userid+')" href="javascript:void(0)">Delete</a></td>\
                                    </tr>';
                        $("#sample_editable_4 tbody").append(html);
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
function getjudgesbygender(gender) {
    console.log('>loading data to judge table..');
    $("#sample_editable_4 tbody").html('');
    $.ajax({
        url: '../server/judges_ext1/index.php/'+gender,
        async: false,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var decode = response;
            if (decode) {
                if (decode.childs.length > 0) {
                    for (var i = 0; i < decode.childs.length; i++) {
                        var row = decode.childs; 
                        var html = '<tr>\
                                        <td style="display:none">' + row[i].userid + '</td>\
                                        <td>' + row[i].userfirstname + '\
                                        ' + row[i].usermiddlename + '\
                                        ' + row[i].userlastname + '</td>\
                                        <td>' + row[i].username + '</td>\
                                        <td style="display:none">' + CryptoJS.AES.encrypt(row[i].password, SecretPassphrase) + '</td>\
                                        <td>' + row[i].gender + '</td>\
                                        <td><a data-id="'+row[i].userid+'" href="javascript:void(0)" data-toggle="modal" class="config judgemodal" data-original-title="" title="">Edit</td>\
                                        <td><a onClick="confirmjudgedelete('+row[i].userid+')" href="javascript:void(0)">Delete</a></td>\
                                    </tr>';
                        $("#sample_editable_4 tbody").append(html);
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
function confirmjudgedelete(id){
    if (confirm('delete this record?')) {
        deletejudge(id);
    } else {
        
    }
}

function deletejudge(id){
    $.ajax({
        url: '../server/judges/index.php/' + id,
        async: true,
        type: 'DELETE',
        success: function(response) {
            var decode = response;
            if (decode.success == true) {
                getjudges();
                toastr.success('Success', 'Records successfully deleted!');
            } else if (decode.success === false) {
                return;
            }

        }
    });
}

function updatejudge(id){
    
    var empty = false;
    if ($("#judgefname_modal").val() == '') {
        $("#judgefname_modal").next('span').text('First Name is required.');
        empty = true;
    }
    /*if ($("#judgemname_modal").val() == '') {
        $("#judgemname_modal").next('span').text('Middle Name is required.');
        empty = true;
    }*/
    if ($("#judgelname_modal").val() == '') {
        $("#judgelname_modal").next('span').text('Lastname Name is required.');
        empty = true;
    }

    if ($('#judgeuname_modal').val() == '') {
        $('#judgeuname_modal').next('span').text('Username is required.');
        empty = true;
    }
    if ($('#judgepword_modal').val() == '') {
        $('#judgepword_modal').next('span').text('Password is required.');
        empty = true;
    }
    if ($('#judgecombo_modal').val() == '') {
        $('#judgecombo_modal').next('span').text('Eventname is required.');
        empty = true;
    }
    if ($('#judgeid_modal').val() == '') {
        $('#judgeid_modal').next('span').text('Start date is required.');
        empty = true;
    }
    if($('#judgepword_modal').val() != $('#cjudgepword_modal').val()){
        $('#cjudgepword_modal').next('span').text('password did not match');
        toastr.error('Error', 'Password Did Not Match!');
        empty = true;
    }
    if ($('#cjudgegender_modal').val() == '') {
        $('#cjudgegender_modal').next('span').text('gender is required.');
        empty = true;
    }
    if (empty == true) {
        toastr.error('Error', 'Please input all the required fields correctly');
        return false;
    }
    
    $.ajax({
            url: '../server/judges/index.php/'+id,
            async: false,
            type: 'PUT',
            crossDomain: true,
            dataType: 'json',
            data: {
                judgecombo: $("#judgecombo_modal").val(),
                judgefname: $("#judgefname_modal").val(),
                judgemname: $("#judgemname_modal").val(),
                judgelname: $("#judgelname_modal").val(),
                judgeuname: $('#judgeuname_modal').val(),
                judgepword: $('#judgepword_modal').val(),
                judgeid: $('#judgeid_modal').val(),
                judgegender: $('#cjudgegender_modal').val()
            },
            success: function(response) {
                var decode = response;

                if (decode.success == true) {
                   toastr.success('Success', 'Records successfuly updated');
                   getjudges();
                } else if (decode.success === false) {
                    toastr.error('Error', 'Failed updating records');
                    getjudges();
                    return;
                }
            },
            error: function(error) {
                return;
            }
        });
}

$(document).on("click", ".judgemodal", function() {
    var id = $(this).data('id'); 
    getJudge_pushToMdal(id);
    $('#static4').modal('show');
});

function getJudge_pushToMdal(id) {
    $.ajax({
        url: '../server/judges/index.php/'+id,
        async: false,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var decode = response;
            if (decode) {
                loadValuesToJudgeCombo_Modal();
                $('#judgefname_modal').val(decode.childs[0].userfirstname);
                $('#judgemname_modal').val(decode.childs[0].usermiddlename);
                $('#judgelname_modal').val(decode.childs[0].userlastname);
                $('#judgeuname_modal').val(decode.childs[0].username);
                // $('#judgepword_modal').val(decode.childs[0].judgepword);
                $('#judgeid_modal').val(decode.childs[0].userid);
                $('#judgegender_modal').val(decode.childs[0].gender);
            }
        },
        error: function(error) {
           toastr.error('error loading activities!', error.responseText);
            return;
        }
    });
}

function loadValuesToJudgeCombo_Modal(){
    $("#judgecombo_modal").html('');
    $.ajax({
        url: '../server/events/index.php',
        async: false,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            var decode = response; 
            if (decode) {
                if (decode.childs.length > 0) {
                    for (var i = 0; i < decode.childs.length; i++) {
                        var row = decode.childs; 
                        var html = '<option value="'+row[i].eventid+'">'+row[i].eventname+'</option>';
                        $("#judgecombo_modal").append(html);
                    }
                }
            }
        },
        error: function(error) {
            console.log('error: ', error);
            return;
        }
    });
}

$(document).on("click", "#sample_editable_4_new", function() {
    $('#modalAdd4').modal('show');
});