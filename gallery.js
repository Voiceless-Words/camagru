
function saveComment() {
    function _(id) {
        return document.getElementById(id);
    }

    const formdata = new FormData();
    formdata.append("comment", _("image_comment").value);
    formdata.append("image_id", _("image_id").value);
    const ajax = new XMLHttpRequest();
    ajax.open("POST", "saveComment.php");
    ajax.onreadystatechange = function () {
        if (ajax.readyState === 4 && ajax.status === 200) {
            if (ajax.responseText === "success") {
                alert("comment saved");
            } else if (ajax.responseText === "nothing") {
                alert("comment not saved");
            }
        }
    };
    ajax.send(formdata);
    _("image_comment").value = "";
}