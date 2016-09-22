<?php
    require ( 'init.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );
    require("./count/redhat.php");
	$plist = new PageList();
	
	//------------------------------------
	//接收参数
	//------------------------------------
    $menuid = intval($_GET["menuid"]);
	$classid = intval($_GET["classid"]);


	//------------------------------------
	//取出下载专区类别数据
	//------------------------------------
	$plist->RowName = "down_class";
    $plist->Execute("select * from `{$tablepre}case_class` order by `sort_order`");
	$plist->TplParse();
	
	//------------------------------------
	//取出产品类别
	//------------------------------------

	$plist->RowName = "class";
    $plist->Execute("select * from `{$tablepre}products_class`order by `sort_order`");
	$plist->TplParse();
	
	//------------------------------------
	//取出数据
	//------------------------------------
	$plist->RowName = "down";
	$plist->SetPageSize(20);
	$plist->SetUrlParam(array('classid','menuid'));
    $plist->Execute("select P.*,C.class_name from `{$tablepre}case` as P,`{$tablepre}case_class` as C where C.id = P.products_classid and `products_classid`={$classid} and `products_isvalid` = 1");
	$plist->TplParse();
	
	
	
	

	$tpl->assign("menuid",$menuid);
	$tpl->assign("count",$count);
	$tpl->assign("classid",$classid);
    $tpl->display("download_cn.html");
?>