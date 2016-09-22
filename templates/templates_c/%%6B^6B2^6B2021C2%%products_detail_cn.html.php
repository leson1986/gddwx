<?php /* Smarty version 2.6.14, created on 2013-01-08 20:03:49
         compiled from products_detail_cn.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'correct_path', 'products_detail_cn.html', 26, false),array('modifier', 'getThumb', 'products_detail_cn.html', 26, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head_cn.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <!--头部结束-->
   <div id="ind_center">
     <div class="left">
	 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left_cn.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	 </div>
     <div class="right">

      <div id="gd_pro_l"><img src="images/HaoSc23.png" width="18" height="18" /><SPAN class="STYLE5 STYLE8"><?php if ($this->_tpl_vars['product']):  echo $this->_tpl_vars['product'][0]['class_name'];  endif; ?></SPAN></div>
      <div id="gd_pro_r"></div>
      <div id="cl"></div>
      <div id="line_1"></div>
      <div id="gd_pro">
      <div  class="con_p">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top"height="300">
	  <table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td colspan="2"></td>
          </tr> 
        <tr>
          <td width="9%" valign="top"><a href="../<?php echo ((is_array($_tmp=$this->_tpl_vars['product'][0]['products_thumb'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>
" target="_blank"><img src="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product'][0]['products_thumb'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)))) ? $this->_run_mod_handler('getThumb', true, $_tmp, 184, 305) : getThumb($_tmp, 184, 305)); ?>
" width="184" height="152" align="left"style="margin:0 15px 15px 0; border:1px #999 solid" border="0"/></a></td>
          <td width="91%"><span class="product_detail">
            <div style="margin:0 0 8px 0"><span class="fb">产品型号:</span> <?php echo $this->_tpl_vars['product'][0]['products_desc']; ?>
</div>
            <div style="margin:0 0 8px 0"><span class="fb">产 品 名: </span><?php echo $this->_tpl_vars['product'][0]['products_name']; ?>
</div>
			
			</span>
		 </td>
        </tr>
<tr><td height="25"></td></tr>
        <tr>
          <td height="30" colspan="2">
		  <span class="product_content"><?php echo ((is_array($_tmp=$this->_tpl_vars['product'][0]['products_detail'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>
</span>
		  </td>
        </tr>
<!--        <tr>
          <td colspan="2" align="center">END</td>
        </tr>-->
        <tr>
          <td height="30" colspan="2" align="center"><img src="images/p_detail.gif" width="10" height="12" border="0"/>&nbsp;<a href="javascript:history.go(-1)">返回</a>&nbsp;<img src="images/p_detail.gif" width="10" height="12"border="0"/></td>
          </tr>
      </table></td>
    </tr>
  </table>
	  </div>
      
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

