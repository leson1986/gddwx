<?php
    require ( 'init.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );
    require("./count/redhat.php");
	$plist = new PageList();
	
	//------------------------------------
	//?
	//------------------------------------
    $menuid = intval($_GET["menuid"]);

	//------------------------------------
	//?
	//------------------------------------
	$plist->RowName = "company";
    $plist->Execute("select * from `{$tablepre}article` where `article_id`=102");
	$plist->TplParse();
	
	//------------------------------------
	//?
	//------------------------------------
	$plist->RowName = "news";
    $plist->Execute("select * from `{$tablepre}news` where `confirm` = 1 order by `posttime` desc limit 0,105");
	$plist->TplParse();
	
	//------------------------------------
	//??
	//------------------------------------
	$plist->RowName = "products";
    $plist->Execute("select * from `{$tablepre}products` order by `products_pubtime`");
	$plist->TplParse();
	
	$tpl->assign("cat_tree", get_categories_tree(0));
	$tpl->assign("site_name",$site_name);
	$tpl->assign("site_keywords",$site_keywords);
	$tpl->assign("menuid",$menuid);
	$tpl->assign("count",$count);
    $tpl->display("index_cn.html");
	
	
	/**
 * ���ָ������ͬ�������з����Լ��÷����µ��ӷ���
 *
 * @access  public
 * @param   integer     $cat_id     ������
 * @return  array
 */
function get_categories_tree($cat_id = 0)
{
	global $db, $tablepre;
    if ($cat_id > 0)
    {
        $sql = "SELECT parent_id FROM  {$tablepre}products_class WHERE id = '$cat_id'";
        $parent_id = $db->getOne($sql);
    }
    else
    {
        $parent_id = 0;
    }

    /*
     �жϵ�ǰ������ȫ���Ƿ��ǵ׼����࣬
     �����ȡ���׼������ϼ����࣬
     �������ȡ��ǰ���༰���µ��ӷ���0
    */
    $sql = "SELECT count(*) FROM `{$tablepre}products_class` WHERE parent_id = '$cat_id' ";
    if ($GLOBALS['db']->getOne($sql) || $parent_id == 0)
    {
        /* ��ȡ��ǰ���༰���ӷ��� */
        $sql = 'SELECT id, class_name, sort_order, parent_id '.
                 "FROM `{$tablepre}products_class` " .
                "WHERE parent_id = '$cat_id' ORDER BY sort_order ASC";
		$result = $db->query($sql);
		

		//$res = $GLOBALS['db']->getAll($sql);
		
		$row = array();
		while ($row = mysql_fetch_assoc($result))
		//foreach ($row AS $res)
		{
			$cater_id  = $row['id'];
			$res[$row['id']] = $row;
			
			$sql = "SELECT count(*) from `{$tablepre}products_class` where parent_id = '$cater_id' ";
			if ($GLOBALS['db']->getOne($sql))
			{
			   $res[$row['id']]['child'] =get_categories_tree($cater_id);
			   
			   }
		}
    }
    
    return $res;
}
?>