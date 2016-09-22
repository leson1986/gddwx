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
	$id = intval($_GET["id"]);


	//------------------------------------
	//取出数据
	//------------------------------------
	$plist->RowName = "news";
	$plist->SetPageSize(20);
	$plist->SetUrlParam(array('id','menuid'));
    $plist->Execute("select * from `{$tablepre}news` where `id`={$id}");
	$plist->TplParse();
	
	
	$plist->RowName = "title";
	$plist->Execute("select * from `{$tablepre}title` where `id` = {$classid}");
	$plist->TplParse();
	
	//------------------------------------
	//取出产品类别
	//------------------------------------
	$plist->RowName = "class";
    $plist->Execute("select * from `{$tablepre}products_class`order by `sort_order`");
	$plist->TplParse();
		
	$tpl->assign("menuid",$menuid);
	$tpl->assign("classid",$classid);
	$tpl->assign("count",$count);
	$tpl->assign("id",$id);
    $tpl->display("news_detail_cn.html");
?>