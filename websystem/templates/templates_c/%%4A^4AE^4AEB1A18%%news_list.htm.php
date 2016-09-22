<?php /* Smarty version 2.6.14, created on 2013-11-28 16:41:00
         compiled from news_list.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'light_keyword', 'news_list.htm', 19, false),)), $this); ?>
<div class="maintable_div" style="width:800px">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" class="maintable">
  <tr>
    <th align="left"><div class="thead"><?php echo $this->_tpl_vars['page_title']; ?>
</div></th>
  </tr>
  <tr>
    <td>
    <table width="800" border="0" align="center" cellpadding="0" cellspacing="0" class="datalist">
      <tr class="title">
        <th width="35" align="center" bgcolor="#D8E0E5">选中</th>
        <th align="center" bgcolor="#D8E0E5"><a href="<?php echo $this->_tpl_vars['sort_news_title']; ?>
">标题</a></th>
        <th width="130" align="center" bgcolor="#D8E0E5"><a href="<?php echo $this->_tpl_vars['sort_posttime']; ?>
">录入时间</a></th>
        <th width="80" align="center" bgcolor="#D8E0E5"><a href="<?php echo $this->_tpl_vars['sort_author']; ?>
">录入作者</a></th>
        <th width="50" align="center" bgcolor="#D8E0E5"><a href="<?php echo $this->_tpl_vars['sort_confirm']; ?>
">状态</a></th>
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
      <tr bgcolor="#F0F0F0">
        <td align="center"><input name="id" type="checkbox" value="<?php echo $this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['id']; ?>
" /></td>
        <td align="left">&nbsp;<a href="news_edit.php?<?php echo $this->_tpl_vars['sort_url_param']; ?>
&page=<?php echo $this->_tpl_vars['curr_page']; ?>
&id=<?php echo $this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['id']; ?>
" title="点击编辑该记录"><?php echo ((is_array($_tmp=$this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['news_title'])) ? $this->_run_mod_handler('light_keyword', true, $_tmp, $this->_tpl_vars['search_key']) : light_keyword($_tmp, $this->_tpl_vars['search_key'])); ?>
</a></td>
        <td align="center"><?php echo $this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['posttime']; ?>
</td>
        <td align="center"><?php echo $this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['author']; ?>
</td>
        <td align="center"><span class=<?php if ($this->_tpl_vars['row_result'][$this->_sections['sec']['index']]['confirm']): ?>"green">有效<?php else: ?>"gray">无效<?php endif; ?></span></td>
        </tr>
      <?php endfor; endif; ?>
      <tr bgcolor="#F0F0F0">
        <td colspan="5">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="noborder">
            <tr>
              <td align="center" width="30"><input name="chkAll" type="checkbox" onclick="CheckAll('id')" /></td>
              <td align="left">全部选中</td>
              <td><div class="PageControl"><?php echo $this->_tpl_vars['page_list']; ?>
</div></td>
            </tr>
          </table></td>
      </tr>
    </table>
    </td>
  </tr>
</table>
</div>

<div class="formControl">
  <input type="button" name="submit" value="添加" class="button" onclick="location.href='news_add.php?<?php echo $this->_tpl_vars['sort_url_param']; ?>
&page=<?php echo $this->_tpl_vars['curr_page']; ?>
';" />
  <input type="button" name="submit" value="审核所选" class="button" onclick="location.href='?<?php echo $this->_tpl_vars['sort_url_param']; ?>
&page=<?php echo $this->_tpl_vars['curr_page']; ?>
&action=confirm&id='+getOperaValue('id');" />
  <input type="button" name="submit" value="取消审核" class="button" onclick="location.href='?<?php echo $this->_tpl_vars['sort_url_param']; ?>
&page=<?php echo $this->_tpl_vars['curr_page']; ?>
&action=deconfirm&id='+getOperaValue('id');" />
  <input type="button" name="submit" value="删除所选" class="button" onclick="batchDel('?<?php echo $this->_tpl_vars['sort_url_param']; ?>
&page=<?php echo $this->_tpl_vars['curr_page']; ?>
&action=del&id=',getOperaValue('id'));" />
  <input type="button" name="return" value="返回上一页" class="button" onclick="history.go(-1)" />
</div>

<div class="maintable_div" style="width:800px">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" class="maintable">
  <tr>
    <th align="left"><div class="thead"><?php echo $this->_tpl_vars['news_search']; ?>
</div></th>
  </tr>
  <tr>
    <td>
    <div class="searchbox">
      <form name="search" action="<?php echo $this->_tpl_vars['search_url']; ?>
" method="post">
        <strong>搜索关键字 :</strong>
        <input name="keyword" type="text" value="<?php echo $this->_tpl_vars['keyword']; ?>
" style="width:300px" class="text" />
        <input type="submit" name="submit" value=" 搜 索 " class="button" />
      </form>
    </div>
    </td>
  </tr>
</table>
</div>