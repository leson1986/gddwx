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
          <td width="140" align="right">�����ļ���</td>
          <td><input name="bak_filename" type="text" id="bak_filename" value="<?php echo $this->_tpl_vars['bak_filename']; ?>
" size="50" />
            <span class="gray">�����ļ���չ��</span></td>
        </tr>
        <tr>
          <td align="right">�����ļ���ʽ</td>
          <td><input name="bak_filetype" type="radio" value="sql" checked="checked" />
            SQL
            <input type="radio" name="bak_filetype" value="zip" />
            ZIPѹ���ļ�
            <input type="radio" name="bak_filetype" value="gz" />
            GZIPѹ���ļ�</td>
        </tr>
        <tr>
          <td align="right">����ļ�ע��</td>
          <td><input name="bak_comment" type="checkbox" id="bak_comment" value="1" checked="checked" />
          <span class="gray">�Ƿ��ڱ����ļ������SQLע�ͼ���������Ϣ</span> </td>
        </tr>
        <tr>
          <td align="right">�������ñ����ļ�</td>
          <td><input name="bak_nettoyage" type="checkbox" id="bak_nettoyage" value="1" />
            <span class="gray">�ò�������ձ���Ŀ¼�µ������ļ��������ز�����</span></td>
        </tr>
        <tr>
          <td align="right">���ر����ļ�</td>
          <td><input name="bak_isdown" type="checkbox" id="bak_isdown" value="1" />
            <span class="gray">�����ļ����ṩ���ض��������ڷ�����Ŀ¼�С�</span></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</div>

<div class="formControl">
  <input name="submit" type="submit" class="button" value=" �����±��� " />
  <input name="return" type="button" class="button" value="������һҳ" onclick="history.go(-1)" />
  <input type="hidden" name="action" value="submit" />
</div>

</form>
<script language="javascript" type="text/javascript">
document.mysqldump.onsubmit = function() {
    if (this.bak_nettoyage.checked && !this.bak_isdown.checked) {
        if (!confirm("��ѡ���˽������´����ı����ļ����ò�����ɾ������Ŀ¼�µ������ļ���ȷ�ϼ�����"))
            return false;
    }
}
</script>

<div class="maintable_div" style="width:750px">
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="maintable">
  <tr>
    <th align="left"><div class="thead">�����ļ��б�</div></th>
  </tr>
  <tr>
    <td>
    <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" class="datalist">
      <tr>
        <th align="center">�� �� ��</th>
        <th align="center" width="140">�ļ���С</th>
        <th align="center" width="160">����޸�ʱ��</th>
        <th align="center" width="100">�� ��</th>
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
">����</a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['delurl']; ?>
" class="rdelete">ɾ��</a></td>
      </tr>
      <?php endfor; endif; ?>
    </table>
    </td>
  </tr>
</table>
</div>