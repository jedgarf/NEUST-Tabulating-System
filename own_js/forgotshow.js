function show1() {
    var p1 = document.getElementById('pwd1');
    p1.setAttribute('type', 'text');
    var p2 = document.getElementById('pwd2');
    p2.setAttribute('type', 'text');
}

function hide1() {
    var p1 = document.getElementById('pwd1');
    p1.setAttribute('type', 'password');
    var p2 = document.getElementById('pwd2');
    p2.setAttribute('type', 'password');
}

var pwShown1 = 0;

document.getElementById("eye").addEventListener("click", function () {
    if (pwShown1 == 0) {
        pwShown1 = 1;
        show1();
    } else {
        pwShown1 = 0;
        hide1();
    }
}, false);