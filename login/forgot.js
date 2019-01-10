

function _(id) {
    return document.getElementById(id);
}
function submitForm() {
    const formdata = new FormData();
    formdata.append("email", _("email").value);
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "forgot_pass.php");
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4 && ajax.status === 200) {
            if (ajax.responseText === "success") {
                _("display").textContent = "";
                email.setCustomValidity("User Does Not Exists");
            } else if (ajax.responseText === "nothing") {
                email.setCustomValidity("");
                console.log("we are here now");
            }
        }
    };
    ajax.send(formdata);
}

email.onchange = submitForm;
email.onkeyup = submitForm;
