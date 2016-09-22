<?php /* Smarty version 2.6.14, created on 2013-01-10 13:47:40
         compiled from feedback.htm */ ?>
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
    <title>反馈信息</title>
    <link href="style/<?php echo $this->_tpl_vars['webmaster_skin']; ?>
/global.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="container">
<div class="maintable_div" style="width:500px;margin-top:60px">
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0" class="maintable">
  <tr>
    <th align="left"><div class="thead">反馈信息</div></th>
  </tr>
  <tr>
    <td>
        <center class="msg_body">
        <div class="msg_content">
        <?php echo $this->_tpl_vars['content']; ?>

        </div>
        <div class="msg_url">
        <a href="<?php echo $this->_tpl_vars['url']; ?>
"><?php echo $this->_tpl_vars['url_tip']; ?>
</a>
        </div>
        </center>
    </td>
  </tr>
</table>
</div>
</div>
</body>
</html>