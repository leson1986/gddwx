<?php
    require ( 'init.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );
    require("./count/redhat.php");
	$plist = new PageList();
	
	//------------------------------------
	//接收参数
	//------------------------------------
    $menuid = intval($_GET["menuid"]);

	//------------------------------------
	//取出数据－－公司简介
	//------------------------------------
	$plist->RowName = "company";
    $plist->Execute("select * from `{$tablepre}article` where `article_id`=102");
	$plist->TplParse();
	
	//------------------------------------
	//取出数据－－联系方式
	//------------------------------------
	$plist->RowName = "lianxi";
    $plist->Execute("select * from `{$tablepre}article` where `article_id`=103");
	$plist->TplParse();

	//------------------------------------
	//取出数据--行业动态
	//------------------------------------
	$plist->RowName = "info";
    $plist->Execute("select * from `{$tablepre}news` where classid = 208 and `confirm` = 1 order by `posttime` desc limit 0,10");
	$plist->TplParse();

	//------------------------------------
	//取出数据--成功案例
	//------------------------------------
	$plist->RowName = "guide";
    $plist->Execute("select * from `{$tablepre}news` where classid = 206 and `confirm` = 1 order by `posttime` desc limit 0,10");
	$plist->TplParse();

	//------------------------------------
	//取出数据--推荐产品
	//------------------------------------
	$plist->RowName = "products";
    $plist->Execute("select * from `{$tablepre}products` where `products_istop` = 1 order by `products_pubtime`");
  $plist->TplParse();
	
	
	$tpl->assign("menuid",$menuid);
	$tpl->assign("count",$count);
    $tpl->display("index.html");
	
	
	/**
 * 获得指定分类同级的所有分类以及该分类下的子分类
 *
 * @access  public
 * @param   integer     $cat_id     分类编号
 * @return  array
 */
?>