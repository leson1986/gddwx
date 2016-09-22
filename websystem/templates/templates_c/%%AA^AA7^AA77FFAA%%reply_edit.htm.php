<?php /* Smarty version 2.6.14, created on 2011-05-18 12:51:53
         compiled from reply_edit.htm */ ?>
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
        <td width="80" align="center">回复内容</td>
        <td align="left"><textarea name="return_content" id="return_content" class="hide_textarea"><?php echo $this->_tpl_vars['return_content']; ?>
</textarea>
          <iframe src="fck2/editor/fckeditor.html?InstanceName=return_content&amp;Toolbar=Custom" width="100%" height="350" frameborder="no" scrolling="No"></iframe></td>
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
</div>
</form>