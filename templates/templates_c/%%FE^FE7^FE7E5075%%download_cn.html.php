<?php /* Smarty version 2.6.14, created on 2013-01-09 02:03:18
         compiled from download_cn.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'correct_path', 'download_cn.html', 19, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head_cn.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <!--头部结束-->
   <div id="ind_center">
     <div class="left">
	 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "down_cn.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	 </div>
     <div class="right">

      <div id="gd_pro_l"><img src="images/HaoSc23.png" width="18" height="18" /><span>下载中心</span></div>
      <div id="gd_pro_r"></div>
      <div id="cl"></div>
      <div id="line_1"></div>
      <div id="gd_pro">
      <div  class="con_a">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
 <?php unset($this->_sections['cases']);
$this->_sections['cases']['name'] = 'cases';
$this->_sections['cases']['loop'] = is_array($_loop=$this->_tpl_vars['down']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cases']['show'] = true;
$this->_sections['cases']['max'] = $this->_sections['cases']['loop'];
$this->_sections['cases']['step'] = 1;
$this->_sections['cases']['start'] = $this->_sections['cases']['step'] > 0 ? 0 : $this->_sections['cases']['loop']-1;
if ($this->_sections['cases']['show']) {
    $this->_sections['cases']['total'] = $this->_sections['cases']['loop'];
    if ($this->_sections['cases']['total'] == 0)
        $this->_sections['cases']['show'] = false;
} else
    $this->_sections['cases']['total'] = 0;
if ($this->_sections['cases']['show']):

            for ($this->_sections['cases']['index'] = $this->_sections['cases']['start'], $this->_sections['cases']['iteration'] = 1;
                 $this->_sections['cases']['iteration'] <= $this->_sections['cases']['total'];
                 $this->_sections['cases']['index'] += $this->_sections['cases']['step'], $this->_sections['cases']['iteration']++):
$this->_sections['cases']['rownum'] = $this->_sections['cases']['iteration'];
$this->_sections['cases']['index_prev'] = $this->_sections['cases']['index'] - $this->_sections['cases']['step'];
$this->_sections['cases']['index_next'] = $this->_sections['cases']['index'] + $this->_sections['cases']['step'];
$this->_sections['cases']['first']      = ($this->_sections['cases']['iteration'] == 1);
$this->_sections['cases']['last']       = ($this->_sections['cases']['iteration'] == $this->_sections['cases']['total']);
?>  
    <tr>
      <td width="87%" height="26"><img src="images/down_01.gif" width="28" height="10" /><?php echo $this->_tpl_vars['down'][$this->_sections['cases']['index']]['products_name']; ?>
</td>
      <td width="13%"><a  href="<?php echo ((is_array($_tmp=$this->_tpl_vars['down'][$this->_sections['cases']['index']]['products_thumb'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>
" target="_blank"><img src="images/down_02.gif" width="65" height="13" border="0" /></a></td>
    </tr>
<?php endfor; endif; ?>	
    <tr>
      <td height="26">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="20" colspan="2" bgcolor="#EAEAEA"><div class="PageControl"><?php echo $this->_tpl_vars['page_list']; ?>
</div></td>
    </tr>
  </table>
		  </div>
	  </div>
      
     </div>
    <div id="cl"></div>

   </div>
   <div id="ind_c_bot"><img src="images/gan_11.jpg" width="988" height="3" /></div>
      <div id="cl"></div>


	 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer_cn.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

