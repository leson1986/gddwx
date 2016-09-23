<?php
    require ( 'init.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );
    require("./count/redhat.php");
	$plist = new PageList();
	
	//------------------------------------
	//接收参数
	//------------------------------------
    $menuid = intval($_GET["menuid"]);
	$id = intval($_GET["classid"]);

	if($id==201){	
	$title_new="最新资讯";
	$title_new_en="News";
	}
	elseif($id==202)
	{
	$title_new="特殊批文";
	$title_new_en="License";
	}
	elseif($id==203)
	{
	$title_new="财税代理";
	$title_new_en="Tax agent";
	}
	elseif($id==204)
	{
	$title_new="商标注册";
	$title_new_en="Trademark";
	}
	elseif($id==205)
	{
	$title_new="注册公司";
	$title_new_en="Company";
	}
	elseif($id==206)
	{
	$title_new="公司转让";
	$title_new_en="Transfer";
	}
	elseif($id==207)
	{
	$title_new="工商法规";
	$title_new_en="Law";
	}
	elseif($id==208)
	{
	$title_new="工商信息";
	$title_new_en="Information";
	}
	elseif($id==209)
	{
	$title_new="资料下载";
	$title_new_en="Download";
	}
	
	//------------------------------------
	//取出数据--最新消息
	//------------------------------------
	$plist->RowName = "gginfo";
    $plist->Execute("select * from `{$tablepre}article` where `article_id`=104");
	$plist->TplParse();
	
    //------------------------------------
	//取出数据－－联系方式
	//------------------------------------
	$plist->RowName = "lianxi";
    $plist->Execute("select * from `{$tablepre}article` where `article_id`=103");
	$plist->TplParse();

	//------------------------------------
	//取出数据
	//------------------------------------
	$plist->RowName = "news";
	$plist->SetPageSize(17);
	//$plist->SetUrlParam(array('classid','menuid','nav_id'));
	$plist->SetUrlParam(array('classid','menuid'));
    $plist->Execute("select * from `{$tablepre}news` where `classid`={$id} and `confirm` = 1 order by `posttime` desc");
	$plist->TplParse();


	$tpl->assign("menuid",$menuid);
	$tpl->assign("title_new",$title_new);
	$tpl->assign("title_new_en",$title_new_en);
	$tpl->assign("id",$classid);
    $tpl->display("news.html");
?>