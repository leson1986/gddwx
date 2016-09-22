<?php
/***********************************************************
 * Document Type: Includes
 * Update: 2006/11/06
 * Author: Akon
 * Remark: MYSQL 服务器错误信息
 ***********************************************************/
@header('Content-Type: text/html; charset=utf-8');
if (!isset($cmsg)) global $cmsg;
$timestamp = time();
$errmsg = '';

$dberror = $this->error();
$dberrno = $this->errno();

if($dberrno == 1114) {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>服务器连接过多</title>
</head>
<body bgcolor="#FFFFFF">
<table cellpadding="0" cellspacing="0" border="0" width="600" align="center" height="85%">
  <tr align="center" valign="middle">
    <td>
    <table cellpadding="10" cellspacing="0" border="0" width="80%" align="center" style="font-family:Tahoma; color: #666666; font-size: 12px">
    <tr>
      <td valign="middle" align="center" bgcolor="#EBEBEB">
        <br><b style="font-size: 14px">服务器连接过多</b>
        <br><br><br>对不起,浏览人数超过服务器限制,请稍候再试...
        <br>
        <br><br>
      </td>
    </tr>
    </table>
    </td>
  </tr>
</table>
</body>
</html>
<?
} else {
    echo '
<style type="text/css">
<!--
    table.mysqlerror {margin:5px;font:12px Tahoma}
    span.errinfo {color:#222}
    span.errtitle {font-weight:bold;}
-->
</style>
<table width="600" border="0" cellpadding="3" cellspacing="0" class="mysqlerror">';
    if($message) {
        echo '
  <tr>
    <td width="65" align="center" valign="top"><span class="errtitle">'.$cmsg['mysql_err_info'].' :</span></td>
    <td valign="top"><span class="errinfo">'.$message.'</span></td>
  </tr>';
    }
    echo '
  <tr>
    <td align="center" valign="top"><span class="errtitle">'.$cmsg['mysql_err_time'].' :</span></td>
    <td valign="top"><span class="errinfo">'.date("Y-m-d H:i:s").'</span></td>
  </tr>
  <tr>
    <td align="center" valign="top"><span class="errtitle">'.$cmsg['mysql_err_file'].' :</span></td>
    <td valign="top"><span class="errinfo">'.$_SERVER['PHP_SELF'].'</span></td>
  </tr>';

    if($sql) {
        echo '
  <tr>
    <td align="center" valign="top"><span class="errtitle">'.$cmsg['mysql_err_sql'].' :</span></td>
    <td valign="top"><span class="errinfo">'.htmlspecialchars($sql).'</span></td>
  </tr>';
    }
    echo '
  <tr>
    <td align="center" valign="top"><span class="errtitle">'.$cmsg['mysql_err_error'].' :</span></td>
    <td valign="top"><span class="errinfo">'.$dberror.'</span></td>
  </tr>
  <tr>
    <td align="center" valign="top"><span class="errtitle">'.$cmsg['mysql_err_errno'].' :</span></td>
    <td valign="top"><span class="errinfo"># '.$dberrno.'</span></td>
  </tr>
</table>';
}
exit();
?>