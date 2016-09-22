<?php
    require ( 'init.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );
    require("./count/redhat.php");
	$plist = new PageList();
	
	//------------------------------------
	//ղ
	//------------------------------------
    $menuid = intval($_GET["menuid"]);
	$id = intval($_GET["id"]);

	//------------------------------------
	//ȡ
	//------------------------------------
	$plist->RowName = "company";
    $plist->Execute("select * from `{$tablepre}article` where `article_id`=103");
	$plist->TplParse();
	
	$plist->RowName = "title";
    $plist->Execute("select * from `{$tablepre}title` where `id`={$id}");
	$plist->TplParse();
	
	//------------------------------------
	//ȡƷ
	//------------------------------------
	$plist->RowName = "class";
    $plist->Execute("select * from `{$tablepre}products_class`order by `sort_order`");
	$plist->TplParse();
	
	$tpl->assign("menuid",$menuid);
	$tpl->assign("count",$count);
	$tpl->assign("id",$id);
    $tpl->display("howtobuy.html");
?>