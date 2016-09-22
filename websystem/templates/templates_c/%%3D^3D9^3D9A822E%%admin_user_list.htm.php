<?php /* Smarty version 2.6.14, created on 2013-09-05 12:19:15
         compiled from admin_user_list.htm */ ?>
<div class="maintable_div" style="width:700px">
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="maintable">
  <tr>
    <th align="left"><div class="thead"><?php echo $this->_tpl_vars['page_title']; ?>
</div></th>
  </tr>
  <tr>
    <td>
    <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="datalist">
      <tr class="title">
        <th width="70" align="center"><a href="<?php echo $this->_tpl_vars['sort_id']; ?>
">编号</a></th>
        <th width="170" align="center"><a href="<?php echo $this->_tpl_vars['sort_admin_user']; ?>
">用户名</a></th>
        <th width="190" align="center"><a href="<?php echo $this->_tpl_vars['sort_group_info']; ?>
">权限组</a></th>
        <th width="100" align="center"><a href="<?php echo $this->_tpl_vars['sort_admin_status']; ?>
">状态</a></th>
        <th width="136" align="center">操作</th>
      </tr>
      <?php unset($this->_sections['sec']);
$this->_sections['sec']['name'] = 'sec';
$this->_sections['sec']['loop'] = is_array($_loop=$this->_tpl_vars['row_result']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sec']['show'] = true;
$this->_sections['sec']['max'] = $this->_sections['sec']['loop'];
$this->_sections['sec']['step'] = 1;
$this->_sections['sec']['start'] = $this->_sections['sec']['step'] > 0 ? 0 : $this->_sections['sec']['loop']-1;
if ($this->_sections['sec']['show']) {
    $this->_sections['sec']['total'] = $this->_sections['sec']['loop'];
    if ($this->_sections['sec']['total'] == 0)
        $this->_sections['sec']['show'] = false;
} else
    $this->_sections['sec']['total'] = 0;
if ($this->_sections['sec']['show']):

            for ($this->_sections['sec']['index'] = $this->_sections['sec']['start'], $this->_sections['sec']['iteration'] = 1;
                 $this->_sections['sec']['iteration'] <= $this->_sections['sec']['total'];
                 $this->_sections['sec']['index'] += $this->_sections['sec']['step'], $this->_sections['sec']['iteration']++):
$this->_sections['sec']['rownum'] = $this->_sections['sec']['iteration'];
$this->_sections['sec']['index_prev'] = $this->_sections['sec']['index'] - $this->_sections['sec']['step'];
$this->_sections['sec']['index_next'] = $this->_sections['sec']['index'] + $this->_sections['sec']['step'];
$this->_sections['sec']['first']      = ($this->_sections['sec']['iteration'] == 1);
$this->_sections['sec']['last']       = ($this->_sections['sec']['iteration'] == $this->_sections['sec']['total']);
?>
      <tr bgcolor="#F0F0F0">
        <td align="center"><?php echo $this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['id']; ?>
</td>
        <td align="center"><?php echo $this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['admin_user']; ?>
</td>
        <td align="center"><?php echo $this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['group_info']; ?>
</td>
        <td align="center"><span class=<?php if ($this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['admin_status']): ?>"green">有效<?php else: ?>"gray">无效<?php endif; ?></span></td>
        <td align="center"><a href="admin_user_edit.php?<?php echo $this->_tpl_vars['sort_url_param']; ?>
&page=<?php echo $this->_tpl_vars['curr_page']; ?>
&id=<?php echo $this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['id']; ?>
">编辑</a>&nbsp;&nbsp;&nbsp;<a href="?<?php echo $this->_tpl_vars['sort_url_param']; ?>
&page=<?php echo $this->_tpl_vars['curr_page']; ?>
&action=del&id=<?php echo $this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['id']; ?>
" class="rdelete">删除</a></td>
      </tr>
      <?php endfor; endif; ?>
      <tr bgcolor="#F0F0F0">
        <td colspan="7"><div class="PageControl"><?php echo $this->_tpl_vars['page_list']; ?>
</div></td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</div>

<div class="formControl">
  <input type="button" name="submit" value="新增管理员" class="button" onclick="location.href='admin_user_add.php?<?php echo $this->_tpl_vars['sort_url_param']; ?>
&page=<?php echo $this->_tpl_vars['curr_page']; ?>
';" />
  <input type="button" name="return" value="返回上一页" class="button" onclick="history.go(-1)" />
</div>