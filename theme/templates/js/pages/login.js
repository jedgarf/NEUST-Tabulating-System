sessionStorage['islogin'] = false;

function getuser(){
	console.log('hello',$("#username").val());
	var empty = false;
	var _username;
	var _password;
    $('input[type="text"]').each(function() {
        $(this).val($(this).val().trim());
    });

    if ($("#username").val() == '') {
        $("#username").next('span').text('username is required.');
        empty = true;
        _username = $("#username").val();
    }

    if ($('#password').val() == '') {
        $('#password').next('span').text('password is required.');
        empty = true;
        _password = $('#password');
    }
    var data = [];

       
        $.ajax({
            url: '../server/finduser/',
            async: true,
            type: 'POST',
            dataType: 'json',
            data: {
                username: $("#username").val(),
                password: $('#password').val()
            },
            success: function(response) {
                console.log(response.childs.acctype);
                var type = response.childs.acctype;

                if(type == "admin"){
                    console.log('admin form');
                    toastr.success('Success', 'Welcome Admin!');
                    sessionStorage['islogin'] = true;
                    sessionStorage['user'] = response.childs.username;
                    sessionStorage['currentUser'] = JSON.stringify(response.childs);
                    window.location = 'dashboard.php';

                } else if(type == "judge")  {
                    console.log('judge form');
                    toastr.success('Success', 'Welcome Judge!');
                    sessionStorage['islogin'] = true;
                    sessionStorage['user'] = response.childs.username;
                    sessionStorage['currentUser'] = JSON.stringify(response.childs);
                    window.location = '../judge/mainform.php';
                }
            },
            error: function(error) {
                console.log("Error:",error);
                toastr.error('Error', error.message);
                return;
            }
        });
}

function forgotpass(){

    console.log('data 1:',$("#username").val());
    console.log('data 2:',$("#quest").val());
    console.log('data 3:',$("#ans").val());
    console.log('data 4:',$("#pass").val());
    console.log('data 4:',$("#repass").val());

    var empty = false;
    //var _username;
    //var _quest;
    //var _ans;
    //var _pass;
    //var _repass;

    $('input[type="text"]').each(function() {
        $(this).val($(this).val().trim());
    });

    if ($("#username").val() == '') {
        $("#username").next('span').text('username is required.');
        empty = true;
        //_username = $("#username").val();
    }

    if ($("#quest").val() == '') {
        $("#quest").next('span').text('security question is required.');
        empty = true;
        //_quest = $("#quest").val();
    }

    if ($("#ans").val() == '') {
        $("#ans").next('span').text('answer is required.');
        empty = true;
        //_ans = $("#ans").val();
    }

    if ($("#pass").val() == '') {
        $("#pass").next('span').text('new password is required.');
        empty = true;
        //_pass = $("#pass").val();
    }
    if ($("#repass").val() == '') {
        $("#repass").next('span').text('retyping password is required.');
        empty = true;
        //_repass = $("#repass").val();
    }

    var data = [];

       
        $.ajax({
            url: '../server/forgotuser/',
            async: true,
            type: 'POST',
            dataType: 'json',
            data: {
                username: $("#username").val(),
                quest: $("#quest").val(),
                ans: $("#ans").val(),
                pass: $("#pass").val(),
                repass: $("#repass").val()
            },
            success: function(response) {
                console.log(response.childs.acctype);
                var type = response.childs.acctype;

                if(type == "admin"){
                    console.log('admin form');
                    toastr.success('Success', 'Welcome Admin!');
                    sessionStorage['islogin'] = true;
                    sessionStorage['user'] = response.childs.username;
                    sessionStorage['currentUser'] = JSON.stringify(response.childs);
                    window.location = 'dashboard.php';

                } else if(type == "judge")  {
                    console.log('judge form');
                    toastr.success('Success', 'Welcome Judge!');
                    window.location = '../judge/mainform.php';
                }
            },
            error: function(error) {
                //console.log("Error:",error);
                toastr.error('Error', error.message);
                return;
            }
        });
}