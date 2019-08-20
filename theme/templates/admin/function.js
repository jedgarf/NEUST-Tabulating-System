function w3_open() {
    document.getElementsByClassName("w3-sidenav")[0].style.display = "block";
}

function w3_close() {
    document.getElementsByClassName("w3-sidenav")[0].style.display = "none";
}

function Highlight() {
   $(".btn").css("background-color","yellow");
}

function validateQty(event) {
    var key = window.event ? event.keyCode : event.which;
if (event.keyCode == 8 || event.keyCode == 46
 || event.keyCode == 37 || event.keyCode == 39) {
    return true;
}
else if ( key < 48 || key > 57 ) {
    return false;
}
else return true;
};

 function onlyAlphabets(e, t) {
            try {
                if (window.event) {
                    var charCode = window.event.keyCode;
                }
                else if (e) {
                    var charCode = e.which;
                }
                else { return true; }

                if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 32 || charCode == 8 || charCode == 9 || charCode == 46)
                    return true;
                else
                    return false;
            }
            catch (err) {
                alert(err.Description);
            }
        }

function isStudId(keyCode){
return ((charCode >= 65 && charCode <= 90) || (charCode >= 48 && charCode <= 57) || charCode == 9 || charCode == 8 || charCode == 173);
       
}