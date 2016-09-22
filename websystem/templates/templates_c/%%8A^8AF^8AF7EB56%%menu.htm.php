<?php /* Smarty version 2.6.14, created on 2013-01-10 13:44:14
         compiled from menu.htm */ ?>
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
 -- 后台管理</title>
    <script language="JavaScript" type="text/javascript" src="../scripts/prototype.js"></script>
    <script language="JavaScript" type="text/javascript" src="../scripts/common.js"></script>
    <script language="JavaScript" type="text/javascript" src="style/<?php echo $this->_tpl_vars['webmaster_skin']; ?>
menu.js"></script>
    <link href="style/<?php echo $this->_tpl_vars['webmaster_skin']; ?>
/menu.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container">
  <ul id="menu">

<?php unset($this->_sections['sec1']);
$this->_sections['sec1']['name'] = 'sec1';
$this->_sections['sec1']['loop'] = is_array($_loop=$this->_tpl_vars['main_class']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sec1']['show'] = true;
$this->_sections['sec1']['max'] = $this->_sections['sec1']['loop'];
$this->_sections['sec1']['step'] = 1;
$this->_sections['sec1']['start'] = $this->_sections['sec1']['step'] > 0 ? 0 : $this->_sections['sec1']['loop']-1;
if ($this->_sections['sec1']['show']) {
    $this->_sections['sec1']['total'] = $this->_sections['sec1']['loop'];
    if ($this->_sections['sec1']['total'] == 0)
        $this->_sections['sec1']['show'] = false;
} else
    $this->_sections['sec1']['total'] = 0;
if ($this->_sections['sec1']['show']):

            for ($this->_sections['sec1']['index'] = $this->_sections['sec1']['start'], $this->_sections['sec1']['iteration'] = 1;
                 $this->_sections['sec1']['iteration'] <= $this->_sections['sec1']['total'];
                 $this->_sections['sec1']['index'] += $this->_sections['sec1']['step'], $this->_sections['sec1']['iteration']++):
$this->_sections['sec1']['rownum'] = $this->_sections['sec1']['iteration'];
$this->_sections['sec1']['index_prev'] = $this->_sections['sec1']['index'] - $this->_sections['sec1']['step'];
$this->_sections['sec1']['index_next'] = $this->_sections['sec1']['index'] + $this->_sections['sec1']['step'];
$this->_sections['sec1']['first']      = ($this->_sections['sec1']['iteration'] == 1);
$this->_sections['sec1']['last']       = ($this->_sections['sec1']['iteration'] == $this->_sections['sec1']['total']);
?>
    <li class="item"><a class="title" name="<?php echo $this->_tpl_vars['main_class'][$this->_sections['sec1']['index']]['main_class_id']; ?>
" title="<?php echo $this->_tpl_vars['main_class'][$this->_sections['sec1']['index']]['main_class_info']; ?>
" href="#"><?php echo $this->_tpl_vars['main_class'][$this->_sections['sec1']['index']]['main_class_name']; ?>
</a>
      <ul id="opt_<?php echo $this->_tpl_vars['main_class'][$this->_sections['sec1']['index']]['main_class_id']; ?>
" class="optiton">
<?php unset($this->_sections['sec2']);
$this->_sections['sec2']['name'] = 'sec2';
$this->_sections['sec2']['loop'] = is_array($_loop=$this->_tpl_vars['main_class'][$this->_sections['sec1']['index']]['main_class_sub']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sec2']['show'] = true;
$this->_sections['sec2']['max'] = $this->_sections['sec2']['loop'];
$this->_sections['sec2']['step'] = 1;
$this->_sections['sec2']['start'] = $this->_sections['sec2']['step'] > 0 ? 0 : $this->_sections['sec2']['loop']-1;
if ($this->_sections['sec2']['show']) {
    $this->_sections['sec2']['total'] = $this->_sections['sec2']['loop'];
    if ($this->_sections['sec2']['total'] == 0)
        $this->_sections['sec2']['show'] = false;
} else
    $this->_sections['sec2']['total'] = 0;
if ($this->_sections['sec2']['show']):

            for ($this->_sections['sec2']['index'] = $this->_sections['sec2']['start'], $this->_sections['sec2']['iteration'] = 1;
                 $this->_sections['sec2']['iteration'] <= $this->_sections['sec2']['total'];
                 $this->_sections['sec2']['index'] += $this->_sections['sec2']['step'], $this->_sections['sec2']['iteration']++):
$this->_sections['sec2']['rownum'] = $this->_sections['sec2']['iteration'];
$this->_sections['sec2']['index_prev'] = $this->_sections['sec2']['index'] - $this->_sections['sec2']['step'];
$this->_sections['sec2']['index_next'] = $this->_sections['sec2']['index'] + $this->_sections['sec2']['step'];
$this->_sections['sec2']['first']      = ($this->_sections['sec2']['iteration'] == 1);
$this->_sections['sec2']['last']       = ($this->_sections['sec2']['iteration'] == $this->_sections['sec2']['total']);
?>
        <li><a href="<?php echo $this->_tpl_vars['main_class'][$this->_sections['sec1']['index']]['main_class_sub'][$this->_sections['sec2']['index']]['sub_class_value']; ?>
" target="mainFrame" title="<?php echo $this->_tpl_vars['main_class'][$this->_sections['sec1']['index']]['main_class_sub'][$this->_sections['sec2']['index']]['sub_class_info']; ?>
"><?php echo $this->_tpl_vars['main_class'][$this->_sections['sec1']['index']]['main_class_sub'][$this->_sections['sec2']['index']]['sub_class_name']; ?>
</a></li>
<?php endfor; endif; ?>
      </ul>
    </li>
<?php endfor; endif; ?>
  </ul>
</div>
</body>
</html>