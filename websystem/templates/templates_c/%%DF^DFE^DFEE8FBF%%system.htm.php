<?php /* Smarty version 2.6.14, created on 2013-09-05 12:19:11
         compiled from system.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'selected', 'system.htm', 16, false),)), $this); ?>
<form name="system_set" action="" method="post">
<div class="maintable_div" style="width:750px">
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="maintable">
  <tr>
    <th align="left"><div class="thead"><?php echo $this->_tpl_vars['page_title']; ?>
</div></th>
  </tr>
  <tr>
    <td style="padding:5px 15px">
    <fieldset>
      <legend>网站基本信息</legend>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
        <tr>
          <td width="140" align="right">页面字符集<br /></td>
          <td width="588">
          <select name="char_set">
            <option value="utf-8" <?php echo ((is_array($_tmp=$this->_tpl_vars['char_set'])) ? $this->_run_mod_handler('selected', true, $_tmp, "utf-8") : selected($_tmp, "utf-8")); ?>
>utf-8</option>
            <option value="iso-8859-1" <?php echo ((is_array($_tmp=$this->_tpl_vars['char_set'])) ? $this->_run_mod_handler('selected', true, $_tmp, "iso-8859-1") : selected($_tmp, "iso-8859-1")); ?>
>iso-8859-1</option>
            <option value="gb2312"  <?php echo ((is_array($_tmp=$this->_tpl_vars['char_set'])) ? $this->_run_mod_handler('selected', true, $_tmp, 'gb2312') : selected($_tmp, 'gb2312')); ?>
>gb2312</option>
            <option value="big5" <?php echo ((is_array($_tmp=$this->_tpl_vars['char_set'])) ? $this->_run_mod_handler('selected', true, $_tmp, 'big5') : selected($_tmp, 'big5')); ?>
>big5</option>
          </select>
          <span class="gray">默认为gb2312,如无特殊需要请勿修改</span></td>
          </tr>
        <tr>
          <td align="right">网站名称</td>
          <td><input name="site_name" type="text" value="<?php echo $this->_tpl_vars['site_name']; ?>
" class="text" size="40" /></td>
          </tr>
        <tr>
          <td align="right">网站URL地址<br /></td>
          <td><input name="site_url" type="text" value="<?php echo $this->_tpl_vars['site_url']; ?>
" class="text" size="40" /></td>
          </tr>
        <tr>
          <td align="right">网站备案号</td>
          <td><input name="site_cert" type="text" value="<?php echo $this->_tpl_vars['site_cert']; ?>
" class="text" size="40" /></td>
          </tr>
        <tr>
          <td align="right">管理员邮箱</td>
          <td><input name="site_mail" type="text" value="<?php echo $this->_tpl_vars['site_mail']; ?>
" class="text" size="40" /></td>
        </tr>
		<tr>
          <td align="right">网站关键字：</td>
          <td><textarea name="site_keywords" class="text" style="height:60px;width:500px"><?php echo $this->_tpl_vars['site_keywords']; ?>
</textarea></td>
        </tr>
		<tr>
          <td align="right">网站描述：</td>
          <td><textarea name="site_description" class="text" style="height:60px;width:500px"><?php echo $this->_tpl_vars['site_description']; ?>
</textarea></td>
        </tr>
    <?php if ($this->_tpl_vars['AdminLevel'] == '0'): ?>
        <tr>
          <td align="right">网站位于测试空间</td>
          <td><select name="site_is_test_space">
            <option value="1" <?php echo ((is_array($_tmp=$this->_tpl_vars['site_is_test_space'])) ? $this->_run_mod_handler('selected', true, $_tmp, '1') : selected($_tmp, '1')); ?>
>是</option>
            <option value="0" <?php echo ((is_array($_tmp=$this->_tpl_vars['site_is_test_space'])) ? $this->_run_mod_handler('selected', true, $_tmp, '0') : selected($_tmp, '0')); ?>
>否</option>
          </select>
          <span class="gray">设置该项可以将网站轻松向正式空间转移</span>
          </td>
        </tr>
        <tr>
          <td align="right">测试空间目录名称</td>
          <td><input name="site_test_space_name" type="text" value="<?php echo $this->_tpl_vars['site_test_space_name']; ?>
" class="text" size="40" />
          <span class="gray">例如: test 或 zhqiao/test</span></td>
        </tr>
        <tr>
          <td align="right">网站对外开放</td>
          <td><select name="site_open">
            <option value="1" <?php echo ((is_array($_tmp=$this->_tpl_vars['site_open'])) ? $this->_run_mod_handler('selected', true, $_tmp, '1') : selected($_tmp, '1')); ?>
>开放</option>
            <option value="0" <?php echo ((is_array($_tmp=$this->_tpl_vars['site_open'])) ? $this->_run_mod_handler('selected', true, $_tmp, '0') : selected($_tmp, '0')); ?>
>关闭</option>
          </select>
          </td>
        </tr>
    <?php endif; ?>
      </table>
    </fieldset>
    <fieldset>
      <legend>上传设置</legend>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
        <tr>
         <td width="140" align="right">允许上传的文件大小</td>
          <td><input name="upfile_size" type="text" value="<?php echo $this->_tpl_vars['upfile_size']; ?>
" class="text" size="20" />
            <span class="gray">KB (千字节,1024KB=1MB)</span></td>
        </tr>
        <tr>
          <td align="right" valign="top">允许上传的文件格式</td>
          <td><textarea name="allow_file_type" class="text" style="height:60px;width:500px"><?php echo $this->_tpl_vars['allow_file_type']; ?>
</textarea><br />
          <span class="gray">请输入小写扩展名，用 | 符号分隔，例如：jpg|gif|bmp</span></td>
        </tr>
      </table>
    </fieldset>
    <fieldset>
      <legend>图片设置</legend>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
        <tr>
          <td width="140" align="right">产品缩略图宽</td>
          <td><input name="product_thumb_width" type="text" value="<?php echo $this->_tpl_vars['product_thumb_width']; ?>
" class="text" size="10" />
            <span class="gray">自动缩放(width:px)</span></td>
        </tr>
        <tr>
          <td align="right">产品缩略图高</td>
          <td><input name="product_thumb_height" type="text" value="<?php echo $this->_tpl_vars['product_thumb_height']; ?>
" class="text" size="10" />
            <span class="gray">自动缩放(height:px)</span></td>
        </tr>
        <tr>
          <td width="140" align="right">产品大图宽</td>
          <td><input name="product_image_width" type="text" value="<?php echo $this->_tpl_vars['product_image_width']; ?>
" class="text" size="10" />
            <span class="gray">超出该尺寸将自动调整(width:px)</span></td>
        </tr>
        <tr>
          <td align="right">产品大图高</td>
          <td><input name="product_image_height" type="text" value="<?php echo $this->_tpl_vars['product_image_height']; ?>
" class="text" size="10" />
            <span class="gray">超出该尺寸将自动调整(height:px)</span></td>
        </tr>
      </table>
    </fieldset>
<!--    <fieldset>
      <legend>留言本设置</legend>
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
        <tr>
          <td align="right">是否开放留言本</td>
          <td><select name="gbook_open">
            <option value="1" <?php echo ((is_array($_tmp=$this->_tpl_vars['gbook_open'])) ? $this->_run_mod_handler('selected', true, $_tmp, '1') : selected($_tmp, '1')); ?>
>开放</option>
            <option value="0" <?php echo ((is_array($_tmp=$this->_tpl_vars['gbook_open'])) ? $this->_run_mod_handler('selected', true, $_tmp, '0') : selected($_tmp, '0')); ?>
>关闭</option>
          </select>
          </td>
        </tr>
        <tr>
          <td width="140" align="right">每页显示留言数量</td>
          <td><input name="gbook_page_size" type="text" value="<?php echo $this->_tpl_vars['gbook_page_size']; ?>
" class="text" size="10" />
            <span class="gray">条</span></td>
        </tr>
        <tr>
          <td align="right">留言间隔时间</td>
          <td><input name="gbook_post_time" type="text" value="<?php echo $this->_tpl_vars['gbook_post_time']; ?>
" class="text" size="10" />
            <span class="gray">秒,可防止恶意刷新</span></td>
        </tr>
        <tr>
          <td align="right">发布留言是否需要审核</td>
          <td><select name="gbook_post_verify">
            <option value="1" <?php echo ((is_array($_tmp=$this->_tpl_vars['gbook_post_verify'])) ? $this->_run_mod_handler('selected', true, $_tmp, '1') : selected($_tmp, '1')); ?>
>需要审核</option>
            <option value="0" <?php echo ((is_array($_tmp=$this->_tpl_vars['gbook_post_verify'])) ? $this->_run_mod_handler('selected', true, $_tmp, '0') : selected($_tmp, '0')); ?>
>直接发布</option>
          </select></td>
        </tr>
        <tr>
          <td align="right">允许匿名用户发表留言</td>
          <td><select name="gbook_post_guest">
            <option value="1" <?php echo ((is_array($_tmp=$this->_tpl_vars['gbook_post_guest'])) ? $this->_run_mod_handler('selected', true, $_tmp, '1') : selected($_tmp, '1')); ?>
>是</option>
            <option value="0" <?php echo ((is_array($_tmp=$this->_tpl_vars['gbook_post_guest'])) ? $this->_run_mod_handler('selected', true, $_tmp, '0') : selected($_tmp, '0')); ?>
>否</option>
          </select></td>
        </tr>
      </table>
    </fieldset>-->
    </td>
  </tr>
</table>
</div>

<div class="formControl">
    <table width="740" border="0" align="center" cellpadding="3" cellspacing="0">
      <tr>
        <td width="140">&nbsp;</td>
        <td width="588" align="left"><input name="submit" type="submit" class="button" value=" 保存设置 " />
          <input name="reset" type="reset" class="button" value="重置表单" />
          <input name="return" type="button" class="button" value="返回上一页" onclick="history.go(-1)" />
          <input type="hidden" name="action" value="submit" /></td>
      </tr>
    </table>
</div>
</form>