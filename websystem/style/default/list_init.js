window.onload = function() {
    var dels = document.getElementsByClassName("rdelete");
    if (dels) {
        for (var i=0;i<dels.length;i++) {
            dels[i].onclick = function() {
                return confirm("ȷ��ɾ����");
            }
        }
    }
    ChangeTrColor("datalist","data_tr3","data_tr4");
}
