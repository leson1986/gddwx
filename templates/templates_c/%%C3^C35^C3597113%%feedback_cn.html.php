<?php /* Smarty version 2.6.14, created on 2013-01-10 19:41:58
         compiled from feedback_cn.html */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "head_cn.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
 <!--ͷ������-->
   <div id="ind_center">
     <div class="left">
	 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "left_a_cn.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	 </div>
     <div class="right">

      <div id="gd_pro_l"><img src="images/HaoSc23.png" width="18" height="18" /><span>���Է���</span></div>
      <div id="gd_pro_r"></div>
      <div id="cl"></div>
      <div id="line_1"></div>
      <div id="gd_pro">
     <div style="padding:15px 20px 10px 20px; color:#000000">
		  <div class="main_con">
       	   
            <p>
        	<form action="" method="post" id="form" onSubmit="return chkMessage(this.form)">
          <table width="100%" border="0" cellspacing="0" cellpadding="2" class="f_bold">
         <!-- <?php if ($this->_tpl_vars['gbook_type'] != ""): ?>
        <tr>
          <td>:</td>
          <td>
          <select name="gbook_type" id="gbook_type" style="background:#333; color:#ccc;">
             <?php echo $this->_tpl_vars['gbook_type']; ?>

          </select>
          </td>
        </tr>-->
<?php endif; ?> 
            <tr>
            <td width="15%">����:</td>
            <td width="85%"><div class="input_s1"><input name="username" type="text" id="username" maxlength="50" /></div></td>
          </tr>
          <tr>
            <td>�绰:</td>
            <td><div class="input_s1"><input name="phone" type="text" id="phone" maxlength="50" /></div></td>
          </tr>
          <tr>
            <td>����:</td>
            <td><div class="input_s1"><input name="email" type="text" id="email" maxlength="50" /></div></td>
          </tr>
          <tr>
            <td>��ַ:</td>
            <td><div class="input_s1"><input name="address" type="text" id="address" maxlength="225" /></div></td>
          </tr>
<tr>
            <td valign="top">��Ϣ:</td>
            <td><textarea name="content" cols="50" rows="5" id="content" class="textarea"></textarea></td>
          </tr>
          <tr>
            <td height="41">&nbsp;</td>
            <td>
              <input type="submit" name="button" id="button" value="�ύ" class="btn" />&nbsp;&nbsp;<input type="reset" name="Reset" id="button" value="���" class="btn" />
              <input name="act" type="hidden" id="act" value="post">  
              </td>
          </tr>
        </table>
       	  </form>
          </p>
          <script type="text/javascript" src="scripts/script_common.js"></script>
      </div>
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