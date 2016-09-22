<?php /* Smarty version 2.6.14, created on 2007-05-15 14:28:57
         compiled from products_daili_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'correct_path', 'products_daili_edit.htm', 20, false),)), $this); ?>
<form name="products_edit" action="" method="post">
<div class="maintable_div" style="width:800px">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" class="maintable">
  <tr>
    <th align="left"><div class="thead"><?php echo $this->_tpl_vars['page_title']; ?>
</div></th>
  </tr>
  <tr>
    <td>
    <table width="800" border="0" align="center" cellpadding="0" cellspacing="0" class="datalist">
      <tr bgcolor="#FFFFFF">
        <td align="center">名称</td>
        <td align="left"><input name="products_name" type="text" value="<?php echo $this->_tpl_vars['products_name']; ?>
" size="40"/></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">名称(EN)</td>
        <td align="left"><input name="products_title" type="text" value="<?php echo $this->_tpl_vars['products_title']; ?>
" size="40"/></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">图片</td>
        <td align="left"><input name="products_thumb" type="text" class="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['products_thumb'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>
" size="50" />
        <input type="button" name="Submit" class="button" value="上传图片" onclick="OpenUpLoad('products_edit','products_thumb',1)" /></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">产品简介</td>
        <td align="left"><textarea name="products_desc" id="products_desc" class="hide_textarea"><?php echo ((is_array($_tmp=$this->_tpl_vars['products_desc'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>
</textarea>
			<iframe src="fck2/editor/fckeditor.html?InstanceName=products_desc&amp;Toolbar=Custom" width="100%" height="350" frameborder="no" scrolling="No"></iframe></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">产品简介(EN)</td>
        <td align="left"><textarea name="products_desc_en" id="products_desc_en" class="hide_textarea"><?php echo ((is_array($_tmp=$this->_tpl_vars['products_desc_en'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>
</textarea>
			<iframe src="fck2/editor/fckeditor.html?InstanceName=products_desc_en&amp;Toolbar=Custom" width="100%" height="350" frameborder="no" scrolling="No"></iframe></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">详细信息</td>
        <td align="left"><textarea name="products_detail" id="products_detail" class="hide_textarea"><?php echo ((is_array($_tmp=$this->_tpl_vars['products_detail'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>
</textarea>
        <iframe src="fck2/editor/fckeditor.html?InstanceName=products_detail&amp;Toolbar=Custom" width="100%" height="350" frameborder="no" scrolling="No"></iframe></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">详细信息(EN)</td>
        <td align="left"><textarea name="products_detail_en" id="products_detail_en" class="hide_textarea"><?php echo ((is_array($_tmp=$this->_tpl_vars['products_detail_en'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>
</textarea>
        <iframe src="fck2/editor/fckeditor.html?InstanceName=products_detail_en&amp;Toolbar=Custom" width="100%" height="350" frameborder="no" scrolling="No"></iframe></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">录入时间</td>
        <td align="left"><input name="products_pubtime" type="text" class="text" value="<?php echo $this->_tpl_vars['products_pubtime']; ?>
" size="30" />
        <span class="gray">修改时间对文章进行排序，格式：2006-10-17 10:05:00</span></td>
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