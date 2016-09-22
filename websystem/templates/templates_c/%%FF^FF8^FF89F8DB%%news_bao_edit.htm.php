<?php /* Smarty version 2.6.14, created on 2007-01-09 09:58:21
         compiled from news_bao_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'checked', 'news_bao_edit.htm', 18, false),array('modifier', 'correct_path', 'news_bao_edit.htm', 24, false),)), $this); ?>
<form name="news_edit" action="" method="post">
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
        <td width="80" align="center">订单号</td>
        <td align="left"><input name="news_title" type="text" class="text" value="<?php echo $this->_tpl_vars['news_title']; ?>
" size="80" /></td>
      </tr>
      
      <tr bgcolor="#FFFFFF">
        <td align="center">审核状态</td>
        <td align="left">
        <input type="radio" name="confirm" value="1" <?php echo ((is_array($_tmp=$this->_tpl_vars['confirm'])) ? $this->_run_mod_handler('checked', true, $_tmp, '1') : checked($_tmp, '1')); ?>
 />已通过
        <input type="radio" name="confirm" value="0" <?php echo ((is_array($_tmp=$this->_tpl_vars['confirm'])) ? $this->_run_mod_handler('checked', true, $_tmp, '0') : checked($_tmp, '0')); ?>
 />进行中
        </td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">内容</td>
        <td align="left"><textarea name="news_content" id="news_content" class="hide_textarea"><?php echo ((is_array($_tmp=$this->_tpl_vars['news_content'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>
</textarea>
        <iframe src="fck2/editor/fckeditor.html?InstanceName=news_content&amp;Toolbar=Custom" width="100%" height="350" frameborder="no" scrolling="No"></iframe></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">录入时间</td>
        <td align="left"><input name="posttime" type="text" class="text" value="<?php echo $this->_tpl_vars['posttime']; ?>
" size="30" />
        <span class="gray">修改时间对文章进行排序，格式：2006-10-17 10:05:00</span></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">录入作者</td>
        <td align="left"><input name="author" type="text" class="text" value="<?php echo $this->_tpl_vars['author']; ?>
" size="30" /></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">点击统计</td>
        <td align="left"><?php echo $this->_tpl_vars['click_count']; ?>
 次</td>
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