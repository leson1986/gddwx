<?php /* Smarty version 2.6.14, created on 2013-01-08 19:38:14
         compiled from index_cn.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'dodi_msubstr', 'index_cn.html', 10, false),array('modifier', 'correct_path', 'index_cn.html', 29, false),array('modifier', 'getThumb', 'index_cn.html', 29, false),)), $this); ?>
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
       <div id="notice"><p><MARQUEE scrollAmount=1 scrollDelay=4 width=610 align="left" onMouseOver="this.stop()" onMouseOut="this.start()">
		<?php unset($this->_sections['new']);
$this->_sections['new']['name'] = 'new';
$this->_sections['new']['loop'] = is_array($_loop=$this->_tpl_vars['news']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['new']['show'] = true;
$this->_sections['new']['max'] = $this->_sections['new']['loop'];
$this->_sections['new']['step'] = 1;
$this->_sections['new']['start'] = $this->_sections['new']['step'] > 0 ? 0 : $this->_sections['new']['loop']-1;
if ($this->_sections['new']['show']) {
    $this->_sections['new']['total'] = $this->_sections['new']['loop'];
    if ($this->_sections['new']['total'] == 0)
        $this->_sections['new']['show'] = false;
} else
    $this->_sections['new']['total'] = 0;
if ($this->_sections['new']['show']):

            for ($this->_sections['new']['index'] = $this->_sections['new']['start'], $this->_sections['new']['iteration'] = 1;
                 $this->_sections['new']['iteration'] <= $this->_sections['new']['total'];
                 $this->_sections['new']['index'] += $this->_sections['new']['step'], $this->_sections['new']['iteration']++):
$this->_sections['new']['rownum'] = $this->_sections['new']['iteration'];
$this->_sections['new']['index_prev'] = $this->_sections['new']['index'] - $this->_sections['new']['step'];
$this->_sections['new']['index_next'] = $this->_sections['new']['index'] + $this->_sections['new']['step'];
$this->_sections['new']['first']      = ($this->_sections['new']['iteration'] == 1);
$this->_sections['new']['last']       = ($this->_sections['new']['iteration'] == $this->_sections['new']['total']);
?> 		           
<a href="news_detail_cn.php?menuid=2&classid=<?php echo $this->_tpl_vars['news'][$this->_sections['new']['index']]['classid']; ?>
&id=<?php echo $this->_tpl_vars['news'][$this->_sections['new']['index']]['id']; ?>
" class="top_new"><font color='#FF0000'>&bull;&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['news'][$this->_sections['new']['index']]['news_title_en'])) ? $this->_run_mod_handler('dodi_msubstr', true, $_tmp, 0, 15) : dodi_msubstr($_tmp, 0, 15)); ?>
</font>&nbsp;&nbsp;</a>
		 <?php endfor; endif; ?>
                    </MARQUEE></p></div>
     
      <div id="cl"></div>
      <div id="gd_pro_l"><img src="images/gd_p1.jpg" width="14" height="14" /><span>��Ʒչʾ</span></div>
      <div id="gd_pro_r"><a href="products_cn.php"><img src="images/more.jpg" width="49" height="16" border="0" /></a></div>
      <div id="cl"></div>
      <div id="line_1"></div>  
	  <div id="gd_pro">

				<!--�����������������-->

<div id="colee_left" style="overflow:hidden;width:730px;">
<table cellpadding="0" cellspacing="0" border="0">
<tr><td id="colee_left1" valign="top" align="center">
<table cellpadding="2" cellspacing="0" border="0">
<tr align="center">
<?php unset($this->_sections['p']);
$this->_sections['p']['name'] = 'p';
$this->_sections['p']['loop'] = is_array($_loop=$this->_tpl_vars['products']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<td><div class="pm12"><a href="products_detail_cn.php?menuid=3&id=<?php echo $this->_tpl_vars['products'][$this->_sections['p']['index']]['id']; ?>
&classid=<?php echo $this->_tpl_vars['products'][$this->_sections['p']['index']]['products_classid']; ?>
"><img src="<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['products'][$this->_sections['p']['index']]['products_thumb'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)))) ? $this->_run_mod_handler('getThumb', true, $_tmp, 120, 120) : getThumb($_tmp, 120, 120)); ?>
" alt="<?php echo $this->_tpl_vars['products'][$this->_sections['p']['index']]['products_name']; ?>
" border="0"/></a></div><div class="pm122"><?php echo $this->_tpl_vars['products'][$this->_sections['p']['index']]['products_name']; ?>
</div></td>
<?php endfor; endif; ?>
</tr>
</table>
</td>
<td id="colee_left2" valign="top"></td>
</tr>
</table>
</div>
<script>
//ʹ��divʱ���뱣֤colee_left2��colee_left1����ͬһ����.
var speed=30//�ٶ���ֵԽ���ٶ�Խ��
var colee_left2=document.getElementById("colee_left2");
var colee_left1=document.getElementById("colee_left1");
var colee_left=document.getElementById("colee_left");
colee_left2.innerHTML=colee_left1.innerHTML
function Marquee3(){
if(colee_left2.offsetWidth-colee_left.scrollLeft<=0)//offsetWidth �Ƕ���Ŀɼ����
colee_left.scrollLeft-=colee_left1.offsetWidth//scrollWidth �Ƕ����ʵ�����ݵĿ��������߿��
else{
colee_left.scrollLeft++
}
}
var MyMar3=setInterval(Marquee3,speed)
colee_left.onmouseover=function() {clearInterval(MyMar3)}
colee_left.onmouseout=function() {MyMar3=setInterval(Marquee3,speed)}
</script>

<!--��������������-->


</div>
      <div id="cl"></div>
      <div id="gd_pro_l"><img src="images/gd_p1.jpg" width="14" height="14" /><span>��˾���</span></div>
      <div id="gd_pro_r"></div>
      <div id="cl"></div>
      <div id="line_1"></div>
      <div id="gd_pro"><div class="con_a">			
	<?php echo ((is_array($_tmp=$this->_tpl_vars['company'][0]['article_content'])) ? $this->_run_mod_handler('correct_path', true, $_tmp) : correct_path($_tmp)); ?>

</div></div>
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