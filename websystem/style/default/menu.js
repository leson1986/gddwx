window.onload = function() {
    if (getCookie("show_item") != null) {
        show_item= "opt_" + getCookie("show_item");
        try {
                $(show_item).style.display = "block";
                document.getElementsByName(getCookie("show_item"))[0].className = "select_title";
        }catch(e){}
    }
    var items = document.getElementsByClassName("title");
    items.push(document.getElementsByClassName("select_title")[0]);
    for (var i=0; i<items.length; i++) {
        if (items[i]) {
            items[i].onclick = function() {
                var o = $("opt_" + this.name);
                if (o.style.display != "block") {
                    var sels = document.getElementsByClassName("select_title");
                    for (var j=0; j<sels.length; j++) sels[j].className = "title";
                    var opts = document.getElementsByClassName("optiton");
                    for (j=0; j<opts.length; j++) opts[j].style.display = "none";
                    o.style.display = "block";
                    this.className = "select_title";
                    setCookie("show_item",this.name);
                }
                else {
                    this.className = "title";
                    o.style.display = "none";
                }
            }
        }
    }
}
