<?php /* Smarty version 2.6.14, created on 2013-01-10 08:17:18
         compiled from company_cn.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'correct_path', 'company_cn.html', 15, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head_cn.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <!--头部结束-->
   <div id="ind_center">
     <div class="left">
	 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left_a_cn.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	 </div>
     <div class="right">

      <div id="gd_pro_l"><img src="images/HaoSc23.png" width="18" height="18" /><span>公司简介</span></div>
      <div id="gd_pro_r"></div>
      <div id="cl"></div>
      <div id="line_1"></div>
      <div id="gd_pro">
      <div  class="con_a">
		  <?php echo ((is_array($_tmp=$this->_tpl_vars['company'][0]['article_content'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>

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