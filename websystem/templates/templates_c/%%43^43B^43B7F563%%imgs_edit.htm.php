<?php /* Smarty version 2.6.14, created on 2006-12-23 03:06:53
         compiled from imgs_edit.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'checked', 'imgs_edit.htm', 18, false),array('modifier', 'correct_path', 'imgs_edit.htm', 34, false),)), $this); ?>
<form name="imgs_edit" action="" method="post">
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
        <td width="80" align="center">所属分店</td>
        <td align="left"><?php echo $this->_tpl_vars['imgs_classid_box']; ?>
 <span class="red">*</span></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">分店名称</td>
        <td align="left"><input name="imgs_name" type="text" class="text" value="<?php echo $this->_tpl_vars['imgs_name']; ?>
" size="30" />
        <span class="red">*</span>
        <input name="imgs_index" type="checkbox" value="1" <?php echo ((is_array($_tmp=$this->_tpl_vars['imgs_index'])) ? $this->_run_mod_handler('checked', true, $_tmp, 1) : checked($_tmp, 1)); ?>
 /> 首页显示
        <input name="imgs_istop" type="checkbox" value="1" <?php echo ((is_array($_tmp=$this->_tpl_vars['imgs_istop'])) ? $this->_run_mod_handler('checked', true, $_tmp, 1) : checked($_tmp, 1)); ?>
 /> 分类置顶
        <input name="imgs_isvalid" type="checkbox" value="1" <?php echo ((is_array($_tmp=$this->_tpl_vars['imgs_isvalid'])) ? $this->_run_mod_handler('checked', true, $_tmp, 1) : checked($_tmp, 1)); ?>
 /> 有效</td>
      </tr>
      <!--<tr bgcolor="#FFFFFF">
        <td align="center">分店标题</td>
        <td align="left"><input name="imgs_title" type="text" class="text" value="<?php echo $this->_tpl_vars['imgs_title']; ?>
" size="80" />
        <span class="red">*</span></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">分店地址</td>
        <td align="left"><input name="imgs_url" type="text" class="text" value="<?php echo $this->_tpl_vars['imgs_url']; ?>
" size="50" />
        <span class="red">*</span></td>
      </tr>-->
      <tr bgcolor="#FFFFFF">
        <td align="center">分店图片</td>
        <td align="left"><input name="imgs_thumb" type="text" class="text" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['imgs_thumb'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>
" size="50" />
        <input type="button" name="Submit" class="button" value="上传图片" onclick="OpenUpLoad('imgs_edit','imgs_thumb',1)" />
        <span class="red">*</span></td>
      </tr>
      <!--<tr bgcolor="#FFFFFF">
        <td align="center">关 键 字</td>
        <td align="left"><input name="imgs_tags" type="text" value="<?php echo $this->_tpl_vars['imgs_tags']; ?>
" size="60" />
        <span class="gray">多个关键字请使用“ | ”分隔</span></td>
      </tr>-->
      <tr bgcolor="#FFFFFF">
        <td align="center">详细信息</td>
        <td align="left"><textarea name="imgs_detail" id="imgs_detail" class="hide_textarea"><?php echo ((is_array($_tmp=$this->_tpl_vars['imgs_detail'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>
</textarea>
        <iframe src="fck2/editor/fckeditor.html?InstanceName=imgs_detail&amp;Toolbar=Custom" width="100%" height="350" frameborder="no" scrolling="No"></iframe></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">分店介绍<br />
        <span class="gray">请简要说明</span></td>
        <td align="left"><textarea name="imgs_desc" style="width:99%;height:100px"><?php echo $this->_tpl_vars['imgs_desc']; ?>
</textarea></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">录入时间</td>
        <td align="left"><input name="imgs_pubtime" type="text" class="text" value="<?php echo $this->_tpl_vars['imgs_pubtime']; ?>
" size="30" />
        <span class="gray">修改时间对文章进行排序，格式：2006-10-17 10:05:00</span></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">录入作者</td>
        <td align="left"><input name="imgs_author" type="text" class="text" value="<?php echo $this->_tpl_vars['imgs_author']; ?>
" size="30" /></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td align="center">点击统计</td>
        <td align="left"><?php echo $this->_tpl_vars['imgs_click_count']; ?>
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