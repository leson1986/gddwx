<?php /* Smarty version 2.6.14, created on 2013-01-09 00:04:13
         compiled from news_detail.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'correct_path', 'news_detail.html', 26, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <!--头部结束-->
   <div id="ind_center">
     <div class="left">
	 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left_a.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	 </div>
     <div class="right">

      <div id="gd_pro_l"><img src="images/HaoSc23.png" width="18" height="18" /><span>NEWS</span></div>
      <div id="gd_pro_r"></div>
      <div id="cl"></div>
      <div id="line_1"></div>
      <div id="gd_pro">
      <div  class="con_a">
		 <table width="100%" border="0" cellspacing="0" cellpadding="0">   
    <tr>
      <td height="25" align="center" class="news_detail"><?php echo $this->_tpl_vars['news'][0]['news_title_en']; ?>
</td>
    </tr>
    <tr>
      <td align="center" class="news_list" height="28">Author<?php echo $this->_tpl_vars['news'][0]['author']; ?>
&nbsp;&nbsp;Date<?php echo $this->_tpl_vars['news'][0]['posttime']; ?>
</td>
    </tr>
    <tr>
      <td align="center" background="images/product_line.gif" height="1"></td>
    </tr>
    <tr>
      <td align="left" class="news_list" height="300" valign="top"><div style="margin:10px 0 0 0; text-align:left"><?php echo ((is_array($_tmp=$this->_tpl_vars['news'][0]['news_content_en'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>
</div>               </td>
    </tr>
    <tr>
      <td align="center" height="20">END<br />
        <a href="javascript:history.go(-1)" class="news">BACK</a></td>
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
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

