<?php /* Smarty version 2.6.14, created on 2011-07-17 18:49:02
         compiled from case_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'correct_path', 'case_edit.htm', 24, false),)), $this); ?>
<form name="products_edit" action="" method="post">
<div class="maintable_div" style="width:800px">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" class="maintable">
  <tr>
    <th align="left"><div class="thead">编辑下载专区</div></th>
  </tr>
  <tr>
    <td valign="top">
    <table width="800" border="0" align="center" cellpadding="0" cellspacing="0" class="datalist">
      <tr bgcolor="#FFFFFF">
        <td align="center">类型</td>
        <td align="left"><?php echo $this->_tpl_vars['products_classid_box']; ?>
<span class="red">*</span></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">名称</td>
        <td align="left"><input name="products_name" type="text" value="<?php echo $this->_tpl_vars['products_name']; ?>
" size="40"/></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">名称(EN)</td>
        <td align="left"><input name="products_name_en" type="text" value="<?php echo $this->_tpl_vars['products_name_en']; ?>
" size="40"/></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">上传资料</td>
        <td align="left"><input name="products_thumb" type="text" class="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['products_thumb'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>
" size="50" />
        <input type="button" name="Submit" class="button" value="上传文件" onclick="OpenUpLoad('products_edit','products_thumb',0)" />
        <span class="red">*</span></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">上传资料(EN)</td>
        <td align="left"><input name="products_thumb_en" type="text" class="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['products_thumb_en'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>
" size="50" />
        <input type="button" name="Submit" class="button" value="上传文件" onclick="OpenUpLoad('products_edit','products_thumb',0)" />
        <span class="red">*</span></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">录入时间</td>
        <td align="left"><input name="products_pubtime" type="text" class="text" value="<?php echo $this->_tpl_vars['products_pubtime']; ?>
" size="30" /></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">录入作者</td>
        <td align="left"><input name="products_author" type="text" class="text" value="<?php echo $this->_tpl_vars['products_author']; ?>
" size="30" /></td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</div>

<div class="formControl">
  <input type="submit" name="submit" value=" 保存编辑 " class="button" />
  <input type="button" name="return" value="返回上一页" class="button" onclick="history.go(-1)" />
  <input type="hidden" name="action" value="submit" />
  <input type="hidden" name="id" value="<?php echo $this->_tpl_vars['id']; ?>
" />
  <input type="hidden" name="classid" value="<?php echo $this->_tpl_vars['classid']; ?>
" />
</div>
</form>