
function _(id) {return document.getElementById(id);}
const emailL = _("emailL");
const passwordL = _("passwordL");
function submitForm() {
    const formdata = new FormData();
    formdata.append("emailL", _("emailL").value);
    formdata.append("passwordL", _("passwordL").value);
    const ajax_1 = new XMLHttpRequest();
    ajax_1.open("POST", 'login/bad_credentials.php');
    ajax_1.onreadystatechange = function () {
        if (ajax_1.readyState === 4 && ajax_1.status === 200) {
            if (ajax_1.responseText === "success") {
                emailL.setCustomValidity("");
            } else if (ajax_1.responseText === "nothing") {
                emailL.setCustomValidity("bad credentials");
            }else if (ajax_1.responseText === "verify"){
                emailL.setCustomValidity("Please verify your email");
            }
        }
    };
    ajax_1.send(formdata);
}

emailL.onchange = submitForm;
emailL.onkeyup = submitForm;
passwordL.onchange = submitForm;
passwordL.onkeyup = submitForm;