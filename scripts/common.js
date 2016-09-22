/***********************************************************
 * Document Type: JavaScript
 * Update: 2006/11/10
 * Author: Akon
 * Remark: JavaScript Common Libray
 ***********************************************************/

// --- Show Element
function Show(obj) {var o=$(obj);o.style.display = '';}

// --- Hidden Element
function Hidden(obj) {var o=$(obj);o.style.display = 'none';}

// --- Get URL Param
function GetUrlParam( paramName )
{
    var oRegex = new RegExp( '[\?&]' + paramName + '=([^&]+)', 'i' ) ;
    var oMatch = oRegex.exec( window.location.search ) ;
    if ( oMatch && oMatch.length > 1 )
        return oMatch[1] ;
    else
        return '' ;
}

// --- Select All Checkbox
function CheckAll(eName){
    var checks = document.getElementsByName(eName);
    var chkAll = document.getElementsByName("chkAll")
    if (chkAll.checked)
        chkAll.checked=false;
    else
        chkAll.checked=true;
    for (var i=0;i<checks.length;i++){
        checks[i].checked=chkAll.checked;
    }
}

// --- Return checkbox selected values "," separation can be used in batch operation
function getOperaValue(eName) {
    var checks = document.getElementsByName(eName);
    var res = "";
    for (var i=0;i<checks.length;i++) {
        if (checks[i].checked) {
            if (!isNaN(checks[i].value)) {
                if (!res=="") res += ",";
                res += checks[i].value;
            }
        }
    }
    return res;
}

// --- Batch delete operation
function batchDel(url,val) {
    if (val=="") {
        alert("请选择您要删除的记录!");
        return;
    }
    if (confirm('一旦删除将无法恢复，确认删除吗？')) self.location.href = url + val;
}

// --- Dynamic change forms ClassName
function ChangeTrClassName(ClassName,tr1,tr2) {
    if (!ClassName || !tr1 || !tr2) {return}
    var list = document.getElementsByClassName(ClassName);
    if (!list) {return}
    for (var i=0;i<list.length;i++) {
        var list_tr = list[i].getElementsByTagName("tr");
        for (var j=0;j<list_tr.length;j++){
            if (list_tr[j].className != "blank" && list_tr[j].className != "title") {
                (j%2==0)?(list_tr[j].className = tr1):(list_tr[j].className = tr2);
            }
        }
    }
}

// --- Dynamic change the background color forms
function ChangeTrColor(ClassName,tr1,tr2) {
    if (!ClassName) {return}
    var list = document.getElementsByClassName(ClassName);
    if (!list) {return}
    for (var i=0;i<list.length;i++) {
        var list_tr = list[i].getElementsByTagName("tr");
        for (var j=0;j<list_tr.length;j++){
            if (list_tr[j].className != "blank" && list_tr[j].className != "title") {
                list_tr[j].style.cursor = "default";
                list_tr[j].onmouseover = function() {this.className=tr1;};
                list_tr[j].onmouseout = function() {this.className=tr2;};
            }
        }
    }
}

// --- Automatic zooming image size by ClassName
function ReSizeImg(cName,w,h){
    var reImgs = document.getElementsByTagName("img");
    for (i=0;i<reImgs.length;i++){
        if (reImgs[i].className==cName && (reImgs[i].height>h || reImgs[i].width>w)) {
            if (reImgs[i].height==reImgs[i].width) {
                reImgs[i].height=h;reImgs[i].width=w;
            } else if (reImgs[i].height>reImgs[i].width) {
                reImgs[i].height=h;
            } else if (reImgs[i].height<reImgs[i].width){
                reImgs[i].width=w;
            }
        }
    }
}

// --- Set cookie by sName
function setCookie(sName,sValue,expireHours) {
    var cookieString = sName + "=" + escape(sValue);
    if (expireHours>0) {
         var date = new Date();
         date.setTime(date.getTime + expireHours * 3600 * 1000);
         cookieString = cookieString + "; expire=" + date.toGMTString();
    }
    document.cookie = cookieString;
}

// --- Get cookie by sName
function getCookie(sName) {
  var aCookie = document.cookie.split("; ");
  for (var i=0; i < aCookie.length; i++){
    var aCrumb = aCookie[i].split("=");
    if (escape(sName) == aCrumb[0])
      return unescape(aCrumb[1]);
  }
  return null;
}

// --- Delete cookie by sName
function delCookie(sName) {
  var date = new Date();
  document.cookie = sName + "= ; expires=" + date.toGMTString();
}

// --- Open upload file window
function OpenUpLoad(fName,cName,IsImage) {
    var url = "uploadfile.php?fName="+fName+"&cName="+cName+"&IsImage="+IsImage;
    window.open(url,'UploadFile','height=40,width=400,resizable=no,top=300,left=300');
}

function isMail(mail) {
    var patrn = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    if (!patrn.test(mail))
        return false;
    else
        return true;
}

function isBetween(value, min, max) {
    return (isNaN(value) == false  && value >= min && value <= max);
}

function isDate(value) {
    return (/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2})$/.test(value));
}

function isEmpty(value) {
    return (/^\s*$/.test(value));
}

function isChinese(str) {
    if(escape(str).indexOf("%u")!=-1){return true;}
    return false;
}