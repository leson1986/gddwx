<?php /* Smarty version 2.6.14, created on 2006-12-21 18:40:47
         compiled from sqldump.htm */ ?>
<form action="" method="post" name="mysqldump">
<div class="maintable_div" style="width:750px">
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="maintable">
  <tr>
    <th align="left"><div class="thead"><?php echo $this->_tpl_vars['page_type']; ?>
</div></th>
  </tr>
  <tr>
    <td>
      <table width="750" border="0" align="center" cellpadding="3" cellspacing="0">
        <tr>
          <td width="140" align="right">备份文件名</td>
          <td><input name="bak_filename" type="text" id="bak_filename" value="<?php echo $this->_tpl_vars['bak_filename']; ?>
" size="50" />
            <span class="gray">包括文件扩展名</span></td>
        </tr>
        <tr>
          <td align="right">备份文件格式</td>
          <td><input name="bak_filetype" type="radio" value="sql" checked="checked" />
            SQL
            <input type="radio" name="bak_filetype" value="zip" />
            ZIP压缩文件
            <input type="radio" name="bak_filetype" value="gz" />
            GZIP压缩文件</td>
        </tr>
        <tr>
          <td align="right">添加文件注释</td>
          <td><input name="bak_comment" type="checkbox" id="bak_comment" value="1" checked="checked" />
          <span class="gray">是否在备份文件中添加SQL注释及服务器信息</span> </td>
        </tr>
        <tr>
          <td align="right">仅保留该备份文件</td>
          <td><input name="bak_nettoyage" type="checkbox" id="bak_nettoyage" value="1" />
            <span class="gray">该操作将清空备份目录下的所有文件，请慎重操作。</span></td>
        </tr>
        <tr>
          <td align="right">下载备份文件</td>
          <td><input name="bak_isdown" type="checkbox" id="bak_isdown" value="1" />
            <span class="gray">备份文件将提供下载而不保留在服务器目录中。</span></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</div>

<div class="formControl">
  <input name="submit" type="submit" class="button" value=" 创建新备份 " />
  <input name="return" type="button" class="button" value="返回上一页" onclick="history.go(-1)" />
  <input type="hidden" name="action" value="submit" />
</div>

</form>
<script language="javascript" type="text/javascript">
document.mysqldump.onsubmit = function() {
    if (this.bak_nettoyage.checked && !this.bak_isdown.checked) {
        if (!confirm("您选择了仅保留新创建的备份文件，该操作将删除备份目录下的所有文件，确认继续吗"))
            return false;
    }
}
</script>

<div class="maintable_div" style="width:750px">
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="maintable">
  <tr>
    <th align="left"><div class="thead">备份文件列表</div></th>
  </tr>
  <tr>
    <td>
    <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="datalist">
      <tr>
        <th align="center">文 件 名</th>
        <th align="center" width="140">文件大小</th>
        <th align="center" width="160">最后修改时间</th>
        <th align="center" width="100">操 作</th>
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
      <tr>
        <td>&nbsp;<?php echo $this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['filename']; ?>
</td>
        <td align="right"><?php echo $this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['filesize']; ?>
 Kb&nbsp;</td>
        <td align="center"><?php echo $this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['createdate']; ?>
</td>
        <td align="center"><a href="<?php echo $this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['downurl']; ?>
">下载</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['delurl']; ?>
" class="rdelete">删除</a></td>
      </tr>
      <?php endfor; endif; ?>
    </table>
    </td>
  </tr>
</table>
</div>