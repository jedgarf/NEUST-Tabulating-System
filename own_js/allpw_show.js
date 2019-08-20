    function show() {
    var p = document.getElementById('pwd');
    p.setAttribute('type', 'text');
    var p1 = document.getElementById('pwd1');
    p1.setAttribute('type', 'text');
    var p2 = document.getElementById('pwd2');
    p2.setAttribute('type', 'text');
}

function hide() {
    var p = document.getElementById('pwd');
    p.setAttribute('type', 'password');
    var p1 = document.getElementById('pwd1');
    p1.setAttribute('type', 'password');
    var p2 = document.getElementById('pwd2');
    p2.setAttribute('type', 'password');
}

var pwShown = 0;

document.getElementById("eye").addEventListener("click", function () {
    if (pwShown == 0) {
        pwShown = 1;
        show();
    } else {
        pwShown = 0;
        hide();
    }
}, false);