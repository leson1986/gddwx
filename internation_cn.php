<?php
    require ( 'init.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );
    require("./count/redhat.php");
	$plist = new PageList();
	
	//------------------------------------
	//?
	//------------------------------------
    $menuid = intval($_GET["menuid"]);
	$id = intval($_GET["id"]);

	//------------------------------------
	//?
	//------------------------------------
	$plist->RowName = "company";
    $plist->Execute("select * from `{$tablepre}article` where `article_id`=105");
	$plist->TplParse();
	
	$plist->RowName = "title";
    $plist->Execute("select * from `{$tablepre}title` where `id`={$id}");
	$plist->TplParse();
	
	//------------------------------------
	//??
	//------------------------------------
	$plist->RowName = "class";
    $plist->Execute("select * from `{$tablepre}products_class`order by `sort_order`");
	$plist->TplParse();
	
	$tpl->assign("menuid",$menuid);
	$tpl->assign("count",$count);
	$tpl->assign("id",$id);
    $tpl->display("internation_cn.html");
?>