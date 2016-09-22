<?php
    require ( 'init.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );
    require("./count/redhat.php");
	$plist = new PageList();
	
	//------------------------------------
	//ղ
	//------------------------------------
    $menuid = intval($_GET["menuid"]);

	//------------------------------------
	//ȡ
	//------------------------------------
	$plist->RowName = "company";
    $plist->Execute("select * from `{$tablepre}article` where `article_id`=102");
	$plist->TplParse();
	
	//------------------------------------
	//ȡ
	//------------------------------------
	$plist->RowName = "news";
    $plist->Execute("select * from `{$tablepre}news` where `confirm` = 1 order by `posttime` desc limit 0,105");
	$plist->TplParse();
	
	//------------------------------------
	//ȡƷ
	//------------------------------------
	$plist->RowName = "products";
    $plist->Execute("select * from `{$tablepre}products` where `products_istop` = 1 order by `products_pubtime`");
	$plist->TplParse();
	
	$tpl->assign("cat_tree", get_categories_tree(0));
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
     判断当前分类中全是是否是底级分类，
     如果是取出底级分类上级分类，
     如果不是取当前分类及其下的子分类0
    */
    $sql = "SELECT count(*) FROM `{$tablepre}products_class` WHERE parent_id = '$cat_id' ";
    if ($GLOBALS['db']->getOne($sql) || $parent_id == 0)
    {
        /* 获取当前分类及其子分类 */
        $sql = 'SELECT id, class_name_en, sort_order, parent_id '.
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