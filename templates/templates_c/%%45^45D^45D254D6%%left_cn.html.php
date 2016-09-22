<?php /* Smarty version 2.6.14, created on 2013-01-08 19:38:14
         compiled from left_cn.html */ ?>
<table width="96%" border="0" align="center" cellpadding="0" cellspacing="0">
	      <tr><td style="padding-left:1px;"><img src="images/sotop.gif" width="194" height="35"></td></tr>
	      <tr><td align="center">
		  <table width="94%" border="0" cellspacing="0" cellpadding="0">
        <form id="form1" name="form1" method="post" action="search_cn.php"><tr>
          <td height="28" align="left">
            <label>
              <select name="Field">
                <option value="1">Names</option>
				<option value="2">Description</option>
              </select>
            </label></td>
        </tr>
        <tr>
          <td height="28" align="left">
		  	 <select name="BigClassName" style="width:180px;">
			 <?php $_from = $this->_tpl_vars['cat_tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['ca'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['ca']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cat']):
        $this->_foreach['ca']['iteration']++;
?>
                <option value="<?php echo $this->_tpl_vars['cat']['id']; ?>
"><?php echo $this->_tpl_vars['cat']['class_name']; ?>
</option>
				<?php $_from = $this->_tpl_vars['cat']['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['r'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['r']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['catr']):
        $this->_foreach['r']['iteration']++;
?>
				<option value="<?php echo $this->_tpl_vars['catr']['id']; ?>
">&nbsp;-<?php echo $this->_tpl_vars['catr']['class_name']; ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
			<?php endforeach; endif; unset($_from); ?>
              </select></td>
        </tr>
        <tr>
          <td height="28" align="left"><input name="Keyword" type="text" size="20" /></td>
        </tr>
        <tr>
          <td height="28" align="center"><input type="submit" name="Submit" value="Search" /></td>
        </tr></form>
      </table>
		  </td>
	      </tr>
          <tr>
            <td align="center" style="padding-left:1px;"><img src="images/lineso.gif" width="194" height="35"></td>
          </tr>
          <tr>
            <td height="20">
              <div >

				<ul class="sm1">
				<?php $_from = $this->_tpl_vars['cat_tree']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['c'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['c']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['cat']):
        $this->_foreach['c']['iteration']++;
?>
					<li class="sm11"><a href="products_cn.php?classid=<?php echo $this->_tpl_vars['cat']['id']; ?>
&menuid=3" class="left_menu2"><strong><?php echo $this->_tpl_vars['cat']['class_name']; ?>
</strong></a></li>
					<?php $_from = $this->_tpl_vars['cat']['child']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['r'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['r']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['catr']):
        $this->_foreach['r']['iteration']++;
?>
							<li class="sm22"><IMG src="images/arrow_6.gif" width=11 height="11">&nbsp;<a href="products_cn.php?classid=<?php echo $this->_tpl_vars['catr']['id']; ?>
&menuid=3"><?php echo $this->_tpl_vars['catr']['class_name']; ?>
</a></li>
					<?php endforeach; endif; unset($_from); ?>
					<?php endforeach; endif; unset($_from); ?>
				</ul>
				</div></td>
          </tr>
          <TR>
            <TD  height=1 colspan="2" background=images/naSzarym.gif><IMG height=1 src="images/1x1_pix.gif"  width=10></TD>
          </TR>
        </table>