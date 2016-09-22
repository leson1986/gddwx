window.onload = function() {
    var dels = document.getElementsByClassName("rdelete");
    if (dels) {
        for (var i=0;i<dels.length;i++) {
            dels[i].onclick = function() {
                return confirm("È·ÈÏÉ¾³ýÂð£¿");
            }
        }
    }
    var style = GetUrlParam("s");
    alert(location)
    if (style=="list") {
        ChangeTrColor("datalist","#ECECEF","#F0F0F0");
    }
    else if (style=="edit") {
        ChangeTrClassName("datalist","date_tr1","data_tr2");
    }
    else if (style=="add") {
        ChangeTrClassName("datalist","date_tr1","data_tr2");
    }
}
