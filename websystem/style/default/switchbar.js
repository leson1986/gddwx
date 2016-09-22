var x = 0;
function switch_menu(action) {
    if (x<170) {
        width = action=="show" ? x : 160-x;
        parent.document.getElementById("FrameMain").cols = width+",6,*";
        x += 15;
    }
    else {
        x = 0;
        clearInterval(timer);
    }
}
window.onload = function() {
    if (getCookie("show_menu")=="hidden") {
        $("arrow").src = "style/default/arrow_4.gif";
        timer = setInterval('switch_menu("hide")',1);
    }
    $("switchbar").onclick = function() {
        if (getCookie("show_menu")=="hidden") {
            $("arrow").src = "style/default/arrow_3.gif";
            timer = setInterval('switch_menu("show")',1);
            setCookie("show_menu","show");
        }
        else {
            $("arrow").src = "style/default/arrow_4.gif";
            timer = setInterval('switch_menu("hide")',1);
            setCookie("show_menu","hidden");
        }
    }
    $("switchbar").onmouseover = function() {this.style.background = "#B4D8F3"}
    $("switchbar").onmouseout = function() {this.style.background = "#E0E0E0"}
}