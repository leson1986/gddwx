<?php
    require ( 'init.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );
    require("./count/redhat.php");
	$plist = new PageList();
	
	//------------------------------------
	//���ղ���
	//------------------------------------
    $menuid = intval($_GET["menuid"]);

	//------------------------------------
	//ȡ�����ݣ�����˾���
	//------------------------------------
	$plist->RowName = "company";
    $plist->Execute("select * from `{$tablepre}article` where `article_id`=102");
	$plist->TplParse();
	
	//------------------------------------
	//ȡ�����ݣ�����ϵ��ʽ
	//------------------------------------
	$plist->RowName = "lianxi";
    $plist->Execute("select * from `{$tablepre}article` where `article_id`=103");
	$plist->TplParse();

	//------------------------------------
	//ȡ������--��ҵ��̬
	//------------------------------------
	$plist->RowName = "info";
    $plist->Execute("select * from `{$tablepre}news` where classid = 208 and `confirm` = 1 order by `posttime` desc limit 0,10");
	$plist->TplParse();

	//------------------------------------
	//ȡ������--�ɹ�����
	//------------------------------------
	$plist->RowName = "guide";
    $plist->Execute("select * from `{$tablepre}news` where classid = 206 and `confirm` = 1 order by `posttime` desc limit 0,10");
	$plist->TplParse();

	//------------------------------------
	//ȡ������--�Ƽ���Ʒ
	//------------------------------------
	$plist->RowName = "products";
    $plist->Execute("select * from `{$tablepre}products` where `products_istop` = 1 order by `products_pubtime`");
  $plist->TplParse();
	
	
	$tpl->assign("menuid",$menuid);
	$tpl->assign("count",$count);
    $tpl->display("index.html");
	
	
	/**
 * ���ָ������ͬ�������з����Լ��÷����µ��ӷ���
 *
 * @access  public
 * @param   integer     $cat_id     ������
 * @return  array
 */
?>