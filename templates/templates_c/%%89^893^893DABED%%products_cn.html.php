<?php /* Smarty version 2.6.14, created on 2013-01-08 19:38:18
         compiled from products_cn.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'correct_path', 'products_cn.html', 22, false),array('modifier', 'getThumb', 'products_cn.html', 22, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head_cn.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <!--ͷ������-->
   <div id="ind_center">
     <div class="left">
	 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left_cn.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	 </div>
     <div class="right">

      <div id="gd_pro_l"><img src="images/HaoSc23.png" width="18" height="18" /><span>��Ʒչʾ</span></div>
      <div id="gd_pro_r"></div>
      <div id="cl"></div>
      <div id="line_1"></div>
      <div id="gd_pro">
      <div  class="con_p">
		  <div id="pm">
	  <ul class="pm1">
<?php unset($this->_sections['p']);
$this->_sections['p']['name'] = 'p';
$this->_sections['p']['loop'] = is_array($_loop=$this->_tpl_vars['product']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['p']['show'] = true;
$this->_sections['p']['max'] = $this->_sections['p']['loop'];
$this->_sections['p']['step'] = 1;
$this->_sections['p']['start'] = $this->_sections['p']['step'] > 0 ? 0 : $this->_sections['p']['loop']-1;
if ($this->_sections['p']['show']) {
    $this->_sections['p']['total'] = $this->_sections['p']['loop'];
    if ($this->_sections['p']['total'] == 0)
        $this->_sections['p']['show'] = false;
} else
    $this->_sections['p']['total'] = 0;
if ($this->_sections['p']['show']):

            for ($this->_sections['p']['index'] = $this->_sections['p']['start'], $this->_sections['p']['iteration'] = 1;
                 $this->_sections['p']['iteration'] <= $this->_sections['p']['total'];
                 $this->_sections['p']['index'] += $this->_sections['p']['step'], $this->_sections['p']['iteration']++):
$this->_sections['p']['rownum'] = $this->_sections['p']['iteration'];
$this->_sections['p']['index_prev'] = $this->_sections['p']['index'] - $this->_sections['p']['step'];
$this->_sections['p']['index_next'] = $this->_sections['p']['index'] + $this->_sections['p']['step'];
$this->_sections['p']['first']      = ($this->_sections['p']['iteration'] == 1);
$this->_sections['p']['last']       = ($this->_sections['p']['iteration'] == $this->_sections['p']['total']);
?>	 
       <li>

<div class="midholder">
								<div>
									<p style="border:1px solid #666666; padding:5px;"><a href="products_detail_cn.php?menuid=3&id=<?php echo $this->_tpl_vars['product'][$this->_sections['p']['index']]['id']; ?>
&classid=<?php echo $this->_tpl_vars['product'][$this->_sections['p']['index']]['products_classid']; ?>
"><img src="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product'][$this->_sections['p']['index']]['products_thumb'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)))) ? $this->_run_mod_handler('getThumb', true, $_tmp, 120, 120) : getThumb($_tmp, 120, 120)); ?>
" width="120" height="120"  border="0"/></a></p>
								</div>
							</div>
							<a href="products_detail_cn.php?menuid=3&id=<?php echo $this->_tpl_vars['product'][$this->_sections['p']['index']]['id']; ?>
&classid=<?php echo $this->_tpl_vars['product'][$this->_sections['p']['index']]['products_classid']; ?>
"><span class="fb">��Ʒ�ͺ�:</span> <?php echo $this->_tpl_vars['product'][$this->_sections['p']['index']]['products_desc']; ?>
</a>
							<a href="products_detail_cn.php?menuid=3&id=<?php echo $this->_tpl_vars['product'][$this->_sections['p']['index']]['id']; ?>
&classid=<?php echo $this->_tpl_vars['product'][$this->_sections['p']['index']]['products_classid']; ?>
"><span class="fb">�� Ʒ ��: </span><?php echo $this->_tpl_vars['product'][$this->_sections['p']['index']]['products_name']; ?>
</a>
							<a href="products_detail_cn.php?menuid=3&id=<?php echo $this->_tpl_vars['product'][$this->_sections['p']['index']]['id']; ?>
&classid=<?php echo $this->_tpl_vars['product'][$this->_sections['p']['index']]['products_classid']; ?>
" class="morelink ico">detail.</a>
</li>
<?php endfor; endif; ?>
</ul>
		  </div>
		  
		  
		  
	  </div>
      
     </div>
     <div style="clear:both"></div>
	 <div class="PageControl"><?php echo $this->_tpl_vars['page_list']; ?>
</div>
    <div id="cl"></div>

   </div>
   <div id="ind_c_bot"><img src="images/gan_11.jpg" width="988" height="3" /></div>
      <div id="cl"></div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer_cn.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

