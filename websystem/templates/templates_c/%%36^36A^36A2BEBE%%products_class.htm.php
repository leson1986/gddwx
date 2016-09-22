<?php /* Smarty version 2.6.14, created on 2013-01-17 10:55:10
         compiled from products_class.htm */ ?>
<div class="maintable_div" style="width:700px">
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="0" class="maintable">
    <tr>
      <th align="left"><div class="thead"><?php echo $this->_tpl_vars['page_type']; ?>
</div></th>
    </tr>
    <tr>
      <td>
        <table width="700" border="0" cellspacing="0" cellpadding="0" class="datalist">
          <tr>
            <th width="220">&nbsp;<a href="javascript: _list.d.openAll();">展开</a>&nbsp; | &nbsp;<a href="javascript: _list.d.closeAll();">闭合</a> </th>
            <th width="476" align="right"><input type="button" name="add" value=" 新增分类 " class="button" onclick="_edit.location='products_class.php?act=form'" />&nbsp;</th>
          </tr>
          <tr>
            <td><iframe name="_list" src="products_class.php?act=list" width="220" height="400" marginwidth="0" marginheight="0" scrolling="yes" frameborder="0"></iframe></td>
            <td valign="top"><iframe name="_edit" src="products_class.php?act=form" width="100%" height="350" marginwidth="0" marginheight="0" scrolling="auto" frameborder="0"></iframe></td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</div>