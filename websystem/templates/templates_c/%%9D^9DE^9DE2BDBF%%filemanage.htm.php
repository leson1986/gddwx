<?php /* Smarty version 2.6.14, created on 2006-12-21 18:40:49
         compiled from filemanage.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'urlencode', 'filemanage.htm', 64, false),)), $this); ?>
<div class="maintable_div" style="width:750px">
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="maintable">
  <tr>
    <th align="left"><div class="thead"><?php echo $this->_tpl_vars['page_type']; ?>
</div></th>
  </tr>
  <tr>
    <td>
    <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="datalist">
      <tr>
        <th align="center" width="365">文 件 名</th>
        <th align="center" width="120">文件大小</th>
        <th align="center" width="140">最后修改时间</th>
        <th align="center" width="100">操 作</th>
      </tr>
    <?php if ($this->_tpl_vars['currpath'] != ""): ?>
      <tr>
        <td><img src="images/fileico/upper.gif" border="0" align="absmiddle" style="margin:0px 6px 0px 0px"/><a href="?currpath=<?php echo $this->_tpl_vars['to_upper_path']; ?>
">返回上一级目录</a></td>
        <td align="right">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td align="center">&nbsp;</td>
      </tr>
    <?php endif; ?>
      <?php unset($this->_sections['sec']);
$this->_sections['sec']['name'] = 'sec';
$this->_sections['sec']['loop'] = is_array($_loop=$this->_tpl_vars['folder_result']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
        <td><img src="images/fileico/<?php echo $this->_tpl_vars['folder_result'][$this->_sections['sec']['index']]['fileicon']; ?>
.gif" align="absmiddle" style="margin:0px 6px 0px 0px"/><a href="<?php echo $this->_tpl_vars['folder_result'][$this->_sections['sec']['index']]['filelink']; ?>
"><?php echo $this->_tpl_vars['folder_result'][$this->_sections['sec']['index']]['filename']; ?>
</a>    </td>
        <td align="right"><?php echo $this->_tpl_vars['folder_result'][$this->_sections['sec']['index']]['filesize']; ?>
 Kb&nbsp;</td>
        <td align="center"><?php echo $this->_tpl_vars['folder_result'][$this->_sections['sec']['index']]['createdate']; ?>
</td>
        <td align="center"><a href="<?php echo $this->_tpl_vars['folder_result'][$this->_sections['sec']['index']]['delurl']; ?>
" class="rdelete">删除</a></td>
      </tr>
      <?php endfor; endif; ?>
      <?php unset($this->_sections['sec']);
$this->_sections['sec']['name'] = 'sec';
$this->_sections['sec']['loop'] = is_array($_loop=$this->_tpl_vars['file_result']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
        <td><img src="images/fileico/<?php echo $this->_tpl_vars['file_result'][$this->_sections['sec']['index']]['fileicon']; ?>
.gif" align="absmiddle" style="margin:0px 6px 0px 0px"/><a href="<?php echo $this->_tpl_vars['file_result'][$this->_sections['sec']['index']]['filelink']; ?>
" target="_blank"><?php echo $this->_tpl_vars['file_result'][$this->_sections['sec']['index']]['filename']; ?>
</a>    </td>
        <td align="right"><?php echo $this->_tpl_vars['file_result'][$this->_sections['sec']['index']]['filesize']; ?>
 Kb&nbsp;</td>
        <td align="center"><?php echo $this->_tpl_vars['file_result'][$this->_sections['sec']['index']]['createdate']; ?>
</td>
        <td align="center"><a href="<?php echo $this->_tpl_vars['file_result'][$this->_sections['sec']['index']]['downurl']; ?>
">下载</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['file_result'][$this->_sections['sec']['index']]['delurl']; ?>
" class="rdelete">删除</a></td>
      </tr>
      <?php endfor; endif; ?>
      <tr>
        <td colspan="4">
        <div>
        当前路径：<span class="gray"><?php echo $this->_tpl_vars['dir_name']; ?>
</span>&nbsp;&nbsp;
        可用空间：<span class="gray"><?php echo $this->_tpl_vars['total_space']; ?>
 MB</span>&nbsp;&nbsp;
        剩余空间：<span class="gray"><?php echo $this->_tpl_vars['free_space']; ?>
 MB</span>&nbsp;&nbsp;
        </div>
        </td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</div>

<div class="formControl">
  <input name="newfolder" type="button" value="新建文件夹" class="button" onclick="createFolder()" />
  <input name="uploadfile" type="button" value=" 上传文件 " class="button" />
  <input type="button" name="return" value="返回上级目录" class="button" onclick="self.location.href='?currpath=<?php echo $this->_tpl_vars['to_upper_path']; ?>
'" />
</div>

<script language="javascript" type="text/javascript">
function createFolder() {
    var FolderName = prompt("请输入文件夹名称!","");
    if (FolderName!="") {
        self.location.href="?action=newfolder&currpath=<?php echo ((is_array($_tmp=$this->_tpl_vars['currpath'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
&foldername="+FolderName;
    }
}
</script>