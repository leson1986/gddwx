<?php /* Smarty version 2.6.14, created on 2010-08-26 16:13:39
         compiled from admin_menu_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_radios', 'admin_menu_edit.htm', 33, false),)), $this); ?>
<style type="text/css">
body {background:#F0F0F0}
</style>

<form name="tree_edit" action="" method="post" onSubmit="return false;">
  <div class="maintable_div">
  <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="maintable">
    <tr>
      <td>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="datalist">
          <tr>
            <td width="100" align="center">�ϼ��˵�</td>
            <td><?php echo $this->_tpl_vars['parend_id']; ?>
</td>
          </tr>
          <tr>
            <td align="center">�˵�����</td>
            <td><input name="sort_order" type="text" class="text" value="<?php echo $this->_tpl_vars['sort_order']; ?>
" size="5" /></td>
          </tr>
          <tr>
            <td align="center">�˵�����</td>
            <td><input name="class_name" type="text" class="text" value="<?php echo $this->_tpl_vars['class_name']; ?>
" size="40" /></td>
          </tr>
          <tr>
            <td align="center">�˵�URL</td>
            <td><input name="class_value" type="text" class="text" value="<?php echo $this->_tpl_vars['class_value']; ?>
" size="40" /></td>
          </tr>
          <tr>
            <td align="center">��ʾ��Ϣ</td>
            <td><input name="class_info" type="text" class="text" value="<?php echo $this->_tpl_vars['class_info']; ?>
" size="40" /></td>
          </tr>
          <tr>
            <td align="center">�Ƿ񱣻�</td>
            <td><?php echo smarty_function_html_radios(array('name' => 'issafe','options' => $this->_tpl_vars['class_issafe'],'checked' => $this->_tpl_vars['class_issafe_val'],'separator' => "&nbsp;"), $this);?>
</td>
          </tr>
          <tr>
            <td align="center">�Ƿ���Ч</td>
            <td><?php echo smarty_function_html_radios(array('name' => 'isvalid','options' => $this->_tpl_vars['class_isvalid'],'checked' => $this->_tpl_vars['class_isvalid_val'],'separator' => "&nbsp;"), $this);?>
</td>
          </tr>
        </table></td>
    </tr>
  </table>
</div>
<div class="formControl">
    <input type="button" name="edit" value=" ����༭ " class="button" onClick="return checkfrm(this.form,'edit')" />
    <input type="button" name="add" value=" �������� " class="button" onClick="return checkfrm(this.form,'add')" />
    <input type="button" name="del" value=" ɾ������ " class="button" onClick="if(confirm('ȷ��ɾ����')){location.href='?act=del&id=<?php echo $this->_tpl_vars['menu_id']; ?>
'}" />
    <input type="button" name="return" value="������һҳ" class="button" onclick="history.go(-1)" />
    <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['menu_id']; ?>
" />
</div>
</form>

<script language="javascript" type="text/javascript">
var menu_id="<?php echo $this->_tpl_vars['menu_id']; ?>
";
if (isNaN(menu_id) || menu_id=="0") {
    document.tree_edit.edit.style.display="none";
    document.tree_edit.del.style.display="none";
    document.tree_edit.action="?act=add";
}
else {
    document.tree_edit.add.style.display="none";
    document.tree_edit.action="?act=edit";
}
function checkfrm(frm,act) {
    if (frm.sort_order.value=="" || isNaN(frm.sort_order.value)) {alert("������һ����������!");frm.sort_order.focus();return false}
    if (frm.class_name.value=="") {alert("������˵�����!");frm.class_name.focus();return false}
    frm.submit();
}
</script>