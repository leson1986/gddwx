<?php /* Smarty version 2.6.14, created on 2013-01-10 13:43:55
         compiled from admin_login.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->_tpl_vars['charset']; ?>
" lang="<?php echo $this->_tpl_vars['charset']; ?>
">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['charset']; ?>
" />
    <meta http-equiv="Content-Language" content="<?php echo $this->_tpl_vars['charset']; ?>
" />
    <title><?php echo $this->_tpl_vars['sitename']; ?>
 -- ��̨����</title>
    <link href="images/login.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
<div id="ctr" align="center">
  <div class="login">
        <div class="login-form">
            <img src="images/login.gif" alt="Login" />
            <form action="" method="post" name="loginForm" id="loginForm">
            <input type="hidden" name="action" value="userlogin" />
            <div class="form-block">
                <div class="inputlabel">�û���</div>
                <div><input name="AdminUser" type="text" class="inputbox" size="15" /></div>
                <div class="inputlabel">����</div>
                <div><input name="AdminPwd" type="password" class="inputbox" size="15" /></div>
                <div align="left"><input type="submit" name="submit" class="button" value="�� ¼" /></div>
            </div>
            </form>
        </div>
        <div class="login-text">
            <div class="ctr"><img src="images/security.png" width="64" height="64" alt="security" /></div>
            <p>��ʹ����Ч���û�������������¼�����̨</p>
      </div>
    </div>
</div>
</body>
</html>
<script language="javascript" type="text/javascript">
window.onload = function() {
    document.loginForm.AdminUser.focus();
    if (top != self) parent.location.href='admin_login.php';
}
document.loginForm.onsubmit = function() {
    if (this.AdminUser.value=="") {alert("����������û���!");this.AdminUser.select();return false}
    if (this.AdminPwd.value=="") {alert("�������������!");this.AdminPwd.select();return false}
    if (this.VerifyCode.value.length<4) {alert("��������֤��!");this.VerifyCode.focus();return false}
}
</script>