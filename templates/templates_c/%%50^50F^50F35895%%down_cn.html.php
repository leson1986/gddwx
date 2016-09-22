<?php /* Smarty version 2.6.14, created on 2013-01-09 02:03:18
         compiled from down_cn.html */ ?>
<table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td align="center"><img src="images/down.gif" width="193" height="24"></td>
          </tr>
		  <tr><td height="15"></td></tr>
           <?php unset($this->_sections['case']);
$this->_sections['case']['name'] = 'case';
$this->_sections['case']['loop'] = is_array($_loop=$this->_tpl_vars['down_class']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['case']['show'] = true;
$this->_sections['case']['max'] = $this->_sections['case']['loop'];
$this->_sections['case']['step'] = 1;
$this->_sections['case']['start'] = $this->_sections['case']['step'] > 0 ? 0 : $this->_sections['case']['loop']-1;
if ($this->_sections['case']['show']) {
    $this->_sections['case']['total'] = $this->_sections['case']['loop'];
    if ($this->_sections['case']['total'] == 0)
        $this->_sections['case']['show'] = false;
} else
    $this->_sections['case']['total'] = 0;
if ($this->_sections['case']['show']):

            for ($this->_sections['case']['index'] = $this->_sections['case']['start'], $this->_sections['case']['iteration'] = 1;
                 $this->_sections['case']['iteration'] <= $this->_sections['case']['total'];
                 $this->_sections['case']['index'] += $this->_sections['case']['step'], $this->_sections['case']['iteration']++):
$this->_sections['case']['rownum'] = $this->_sections['case']['iteration'];
$this->_sections['case']['index_prev'] = $this->_sections['case']['index'] - $this->_sections['case']['step'];
$this->_sections['case']['index_next'] = $this->_sections['case']['index'] + $this->_sections['case']['step'];
$this->_sections['case']['first']      = ($this->_sections['case']['iteration'] == 1);
$this->_sections['case']['last']       = ($this->_sections['case']['iteration'] == $this->_sections['case']['total']);
?> 
          <tr>
            <td height="20">
              <div align="center">
                
                <a href="download_cn.php?menuid=7&classid=<?php echo $this->_tpl_vars['down_class'][$this->_sections['case']['index']]['id']; ?>
" class="left_menu"><?php echo $this->_tpl_vars['down_class'][$this->_sections['case']['index']]['class_name']; ?>
</a></div></td>
          </tr>
		  <?php endfor; endif; ?>
        </table>