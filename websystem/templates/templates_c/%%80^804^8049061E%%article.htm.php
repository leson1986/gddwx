<?php /* Smarty version 2.6.14, created on 2013-01-22 10:32:23
         compiled from article.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'correct_path', 'article.htm', 13, false),)), $this); ?>
<form name="article_edit" action="" method="post">
<div class="maintable_div" style="width:750px">
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="maintable">
  <tr>
    <th align="left"><div class="thead"><?php echo $this->_tpl_vars['page_title']; ?>
</div></th>
  </tr>
  <tr>
    <td>
    <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="datalist">
      <tr bgcolor="#FFFFFF">
        <td width="80" align="center" valign="top">文本内容</td>
        <td align="left">
        <textarea name="article_content" id="article_content" class="hide_textarea"><?php echo ((is_array($_tmp=$this->_tpl_vars['article_content'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>
</textarea>
        <iframe src="fck2/editor/fckeditor.html?InstanceName=article_content&amp;Toolbar=Custom" width="100%" height="400" frameborder="no" scrolling="no"></iframe></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">文本内容(EN)</td>
        <td align="left">
<textarea name="article_content_en" id="article_content_en" class="hide_textarea"><?php echo ((is_array($_tmp=$this->_tpl_vars['article_content_en'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>
</textarea>
        <iframe src="fck2/editor/fckeditor.html?InstanceName=article_content_en&amp;Toolbar=Custom" width="100%" height="400" frameborder="no" scrolling="no"></iframe></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">上次编辑</td>
        <td align="left"><?php echo $this->_tpl_vars['author']; ?>
  [ <?php echo $this->_tpl_vars['posttime']; ?>
 ]</td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</div>

<div class="formControl">
  <input type="submit" name="Submit" value=" 保存设置 " class="button" />
  <input type="button" name="return" value="返回上一页" class="button" onclick="history.go(-1)" />
  <input type="hidden" name="action" value="submit" />
  <input type="hidden" name="article_id" value="<?php echo $this->_tpl_vars['article_id']; ?>
" />
</div>
</form>