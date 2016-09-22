<?php /* Smarty version 2.6.14, created on 2006-12-21 18:40:17
         compiled from admin_user_add.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin_user_add.htm', 27, false),array('function', 'html_radios', 'admin_user_add.htm', 32, false),)), $this); ?>
<form name="user_add" action="" method="post">
<div class="maintable_div" style="width:600px">
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="maintable">
  <tr>
    <th align="left"><div class="thead"><?php echo $this->_tpl_vars['page_title']; ?>
</div></th>
  </tr>
  <tr>
    <td>
    <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="datalist">
      <tr bgcolor="#FFFFFF">
        <td align="center">用户名</td>
        <td align="left"><input name="admin_user" type="text" class="text" size="30" />
          <span class="red">*</span></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">密&nbsp;&nbsp; 码</td>
        <td align="left"><input name="admin_pwd" class="text" type="password" size="30" /> <span class="red">*</span></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">确认密码</td>
        <td align="left"><input name="confirm_pwd" class="text" type="password" size="30" /> <span class="red">*</span></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">权限组</td>
        <td align="left">
        <select name="admin_level">
         <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['group_ids'],'output' => $this->_tpl_vars['group_infos'],'selected' => $this->_tpl_vars['admin_level']), $this);?>

        </select></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">状&nbsp;&nbsp; 态</td>
        <td align="left"><?php echo smarty_function_html_radios(array('name' => 'admin_status','options' => $this->_tpl_vars['admin_status_opt'],'checked' => $this->_tpl_vars['admin_status'],'separator' => "&nbsp;"), $this);?>
</td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</div>

<div class="formControl">
  <input type="submit" name="submit" value=" 保存设置 " class="button" />
  <input type="button" name="return" value="返回上一页" class="button" onclick="history.go(-1)" />
  <input type="hidden" name="action" value="submit" />
</div>
</form>