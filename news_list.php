<?php
    require ( 'init.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );
    require("./count/redhat.php");
	$plist = new PageList();
	
	//------------------------------------
	//���ղ���
	//------------------------------------
    $menuid = intval($_GET["menuid"]);
	$id = intval($_GET["classid"]);

	if($id==201){	
	$title_new="������Ѷ";
	$title_new_en="News";
	}
	elseif($id==202)
	{
	$title_new="��������";
	$title_new_en="License";
	}
	elseif($id==203)
	{
	$title_new="��˰����";
	$title_new_en="Tax agent";
	}
	elseif($id==204)
	{
	$title_new="�̱�ע��";
	$title_new_en="Trademark";
	}
	elseif($id==205)
	{
	$title_new="ע�ṫ˾";
	$title_new_en="Company";
	}
	elseif($id==206)
	{
	$title_new="��˾ת��";
	$title_new_en="Transfer";
	}
	elseif($id==207)
	{
	$title_new="���̷���";
	$title_new_en="Law";
	}
	elseif($id==208)
	{
	$title_new="������Ϣ";
	$title_new_en="Information";
	}
	elseif($id==209)
	{
	$title_new="��������";
	$title_new_en="Download";
	}
	
	//------------------------------------
	//ȡ������--������Ϣ
	//------------------------------------
	$plist->RowName = "gginfo";
    $plist->Execute("select * from `{$tablepre}article` where `article_id`=104");
	$plist->TplParse();
	
    //------------------------------------
	//ȡ�����ݣ�����ϵ��ʽ
	//------------------------------------
	$plist->RowName = "lianxi";
    $plist->Execute("select * from `{$tablepre}article` where `article_id`=103");
	$plist->TplParse();

	//------------------------------------
	//ȡ������
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