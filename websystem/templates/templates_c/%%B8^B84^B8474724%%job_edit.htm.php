<?php /* Smarty version 2.6.14, created on 2007-01-08 15:23:18
         compiled from job_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'checked', 'job_edit.htm', 50, false),)), $this); ?>
<form name="job_edit" action="" method="post">
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
        <td width="80" align="center">招聘职位</td>
        <td align="left"><input name="jobs" type="text" class="text" value="<?php echo $this->_tpl_vars['jobs']; ?>
" size="50" /></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">招聘人数</td>
        <td align="left"><input name="number" type="text" value="<?php echo $this->_tpl_vars['number']; ?>
" size="5" class="text" />
          <span class="gray">人</span></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">工作地点</td>
        <td align="left"><input name="place" type="text" value="<?php echo $this->_tpl_vars['place']; ?>
" size="30" class="text" /></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">工资待遇</td>
        <td align="left"><input name="salary" type="text" value="<?php echo $this->_tpl_vars['salary']; ?>
" size="30" class="text" />
          <span class="gray">例如：3000~4000 元</span></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">发布时间</td>
        <td align="left"><input name="posttime" type="text" class="text" value="<?php echo $this->_tpl_vars['posttime']; ?>
" size="30" />
          <span class="gray">可使用自由的日期格式(中文除外)，例：<em>Tuesday, 17 October, 2006</em> 或 <em>2006-10-17</em></span></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">有效期限</td>
        <td align="left"><input name="expires" type="text" value="<?php echo $this->_tpl_vars['expires']; ?>
" size="5" class="text" />
          <span class="gray">天</span></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">工作职责</td>
        <td align="left"><textarea name="resbility" style="width:500px;height:60px"><?php echo $this->_tpl_vars['resbility']; ?>
</textarea></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">职位要求</td>
        <td align="left"><textarea name="require" class="hide_textarea"><?php echo $this->_tpl_vars['require']; ?>
</textarea>
          <iframe src="fck2/editor/fckeditor.html?InstanceName=require&amp;Toolbar=Custom" width="100%" height="350" frameborder="no" scrolling="No"></iframe></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">审核状态</td>
        <td align="left">
		<input type="radio" name="status" value="1" <?php echo ((is_array($_tmp=$this->_tpl_vars['status'])) ? $this->_run_mod_handler('checked', true, $_tmp, '1') : checked($_tmp, '1')); ?>
 />已审核
        <input type="radio" name="status" value="0" <?php echo ((is_array($_tmp=$this->_tpl_vars['status'])) ? $this->_run_mod_handler('checked', true, $_tmp, '0') : checked($_tmp, '0')); ?>
 />未审核
        <span class="gray">未通过审核的文章将不会被显示</span>	</td>
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