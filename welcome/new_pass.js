function _(id) {
    return document.getElementById(id);
}
const password = _("newPass");
const user = _("newUser");
const email = _("newEmail");
const check = _('check');
const confirm_password = _("conPass");
const pass_val = new RegExp("^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@])(?=.{8,16})");
function validate_pass() {
    if (password.value === confirm_password.value) {
        confirm_password.setCustomValidity('');
    }
    else {
        confirm_password.setCustomValidity("Passwords Don't Match Dumb Ass");
    }
}
function check_regex() {
    if ((pass_val.test(password.value))) {
        password.setCustomValidity('');
    } else {
        password.setCustomValidity("At least one upper character and one lower character should be there At least one digit, and either ! or @ and min length 8");
    }
}

function submitForm() {
    const formdata = new FormData();
    formdata.append("email", _("newEmail").value);
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "emailInUse.php");
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4 && ajax.status === 200) {
            if (ajax.responseText === "success") {
                email.setCustomValidity("");
            } else if (ajax.responseText === "nothing") {
                email.setCustomValidity("This email already exists");
            }
        }
    };
    ajax.send(formdata);
}

function submitUser() {
    const formdata = new FormData();
    formdata.append("username", _("newUser").value);
    console.log("the new username " + user.value);
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "userInUse.php");
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4 && ajax.status === 200) {
            if (ajax.responseText === "success") {
                user.setCustomValidity("");
            } else if (ajax.responseText === "nothing") {
                user.setCustomValidity("This username already exists");
            }
        }
    };
    ajax.send(formdata);
}

(function submitCheck() {
    const formdata = new FormData();
    formdata.append("check", check.value);
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "check_checked.php");
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4 && ajax.status === 200) {
            if (ajax.responseText === "success") {
                check.checked = true;
            } else if (ajax.responseText === "nothing") {
                check.checked = false;
            }
        }
    };
    ajax.send(formdata);
})();

function checks(){
        const formdata = new FormData();
        formdata.append("check", check.value);
        const ajax = new XMLHttpRequest();
        ajax.open("POST", "check.php");
        ajax.onreadystatechange = function () {
            if (ajax.readyState === 4 && ajax.status === 200) {
                if (ajax.responseText === "success") {
                    check.checked = true;
                } else if (ajax.responseText === "nothing") {
                    check.checked = false;
                }
            }
        };
        ajax.send(formdata);
}

user.onchange = submitUser;
user.onkeyup = submitUser;
email.onchange = submitForm;
email.onkeyup = submitForm;
password.onchange = check_regex;
password.onkeyup = check_regex;
password.onchange = validate_pass;
confirm_password.onkeyup = validate_pass;