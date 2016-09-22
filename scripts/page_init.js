/***********************************************************
 * Document Type: JavaScript
 * Update: 2006/10/31
 * Author: akon
 * Remark: 页面初始化脚本
 ***********************************************************/

 function OpenBuyWin(id) {
    var url = "mao_basket_cn.php?id=" + id;
    window.open(url,'Basket','location=no,menubar=no,resizable=yes,scrollbars=yes,titlebar=no,toolbar=no,width=10,height=10,top=0,left=0');
 }

 function OpenBuyWinEn(id) {
    var url = "basket.php?l=en&id=" + id;
    window.open(url,'Basket','location=no,menubar=no,resizable=no,scrollbars=yes,titlebar=no,toolbar=no,width=10,height=10,top=0,left=0');
 }

 function ViewOrder(id) {
    var url = "mao_vieworder_cn.php?orderid=" + id;
    window.open(url,'ViewOrder','location=no,menubar=no,resizable=no,scrollbars=yes,titlebar=no,toolbar=no,width=10,height=10,top=100,left=100');
 }

 function ViewOrderEn(orderid) {
    var url = "vieworder.php?l=en&orderid=" + orderid;
    window.open(url,'ViewOrder','location=no,menubar=no,resizable=no,scrollbars=yes,titlebar=no,toolbar=no,width=10,height=10,top=100,left=100');
 }

 function check_login(frm) {
     if (frm.username.value=="") {alert("用户名不能为空!");frm.username.focus();return false;}
     if (frm.password.value=="") {alert("密码不能为空!");frm.password.focus();return false;}
     if (frm.username.value.length<4) {alert("用户名不能小于4个字符!");frm.username.focus();return false;}
     if (frm.username.value.length>20) {alert("用户名不能大于20个字符!");frm.username.focus();return false;}
     if (frm.password.value.length<4) {alert("密码不能小于4个字符!");frm.password.focus();return false;}
     if (frm.password.value.length>40) {alert("密码不能大于40个字符!");frm.password.focus();return false;}
     frm.submit();
     return true;
 }

 function check_login_en(frm) {
     if (frm.Username.value=="") {alert("Please enter username !");frm.Username.focus();return false;}
     if (frm.Password.value=="") {alert("Please enter Password !");frm.Password.focus();return false;}
     if (frm.Username.value.length<4) {alert("Invalid username !");frm.Username.focus();return false;}
     if (frm.Username.value.length>20) {alert("Invalid username !");frm.Username.focus();return false;}
     if (frm.Password.value.length<4) {alert("Invalid Password !");frm.Password.focus();return false;}
     if (frm.Password.value.length>40) {alert("Invalid Password !");frm.Password.focus();return false;}
     frm.submit();
     return true;
 }

 function check_register(frm) {
     if (frm.Username.value=="") {alert("用户名不能为空!");frm.Username.focus();return false;}
     if (frm.Password.value=="") {alert("密码不能为空!");frm.Password.focus();return false;}
     if (frm.Username.value.length<4) {alert("用户名不能小于4个字符!");frm.Username.focus();return false;}
     if (frm.Username.value.length>20) {alert("用户名不能大于20个字符!");frm.Username.focus();return false;}
     if (frm.Password.value.length<4) {alert("密码不能小于4个字符!");frm.Password.focus();return false;}
     if (frm.Password.value.length>40) {alert("密码不能大于40个字符!");frm.Password.focus();return false;}
     if (frm.Password.value!=frm.ConfirmPwd.value) {alert("两次输入的密码不一致!");frm.Password.focus();return false;}
     if (!isMail(frm.email.value) && frm.email.value!="") {alert("请输入正确的邮箱格式!");frm.email.focus();return false;}
 }

  function check_register_en(frm) {
     if (frm.Username.value=="") {alert("Please enter username !");frm.Username.focus();return false;}
     if (frm.Password.value=="") {alert("Please enter Password !");frm.Password.focus();return false;}
     if (frm.Username.value.length<4) {alert("Invalid username !");frm.Username.focus();return false;}
     if (frm.Username.value.length>20) {alert("Invalid username !");frm.Username.focus();return false;}
     if (frm.Password.value.length<4) {alert("Invalid Password !");frm.Password.focus();return false;}
     if (frm.Password.value.length>40) {alert("Invalid Password !");frm.Password.focus();return false;}
     if (frm.Password.value!=frm.ConfirmPwd.value) {alert("Please confirm your password !");frm.Password.focus();return false;}
     if (!isMail(frm.email.value) && frm.email.value!="") {alert("Invalid E-mail !");frm.email.focus();return false;}
 }