<?php /* Smarty version 2.6.14, created on 2013-01-10 12:09:04
         compiled from index.htm */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->_tpl_vars['charset']; ?>
" lang="<?php echo $this->_tpl_vars['charset']; ?>
">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $this->_tpl_vars['charset']; ?>
" />
    <meta http-equiv="Content-Language" content="<?php echo $this->_tpl_vars['charset']; ?>
" />
    <title><?php echo $this->_tpl_vars['sitename']; ?>
 -- 后台管理</title>
    <link href="style/<?php echo $this->_tpl_vars['webmaster_skin']; ?>
menu.css" rel="stylesheet" type="text/css" media="all" />
    <script language="JavaScript" type="text/javascript" src="../scripts/prototype.js"></script>
    <script language="JavaScript" type="text/javascript" src="../scripts/common.js"></script>
</head>

<?php if ($this->_tpl_vars['is_switch']): ?>
    <script language="JavaScript" type="text/javascript" src="style/<?php echo $this->_tpl_vars['webmaster_skin']; ?>
switchbar.js"></script>
    <link href="style/<?php echo $this->_tpl_vars['webmaster_skin']; ?>
switchbar.css" rel="stylesheet" type="text/css" />
    <body>
      <div id="switchbar"><img src="style/<?php echo $this->_tpl_vars['webmaster_skin']; ?>
arrow_3.gif" alt="显示/隐藏菜单栏" id="arrow"/></div>
    </body>
<?php else: ?>
    <?php if ($this->_tpl_vars['show_top']): ?>
    <frameset rows="100,*" cols="*" frameborder="no" border="0" framespacing="0">
      <frame src="index.php?action=top" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" />
    <?php endif; ?>
      <frameset cols="160,6,*" frameborder="no" border="0" framespacing="0" id="FrameMain">
        <frame src="menu.php" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" />
        <frame src="index.php?action=switch" name="switchFrame" scrolling="No" noresize="noresize" id="switchFrame" />
        <frame src="main.php" name="mainFrame" scrolling="yes" noresize="noresize" id="mainFrame" />
      </frameset>
    <?php if ($this->_tpl_vars['show_top']): ?>
    </frameset>
    <?php endif; ?>
    <noframes>
    <body>
    </body>
    </noframes>
<?php endif; ?>
</html>