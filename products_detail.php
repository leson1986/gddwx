<?php
    require ( 'init.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );
	require ( __LANG_PATH . 'en.core.php');
    require("./count/redhat.php");
	$plist = new PageList();
	
	//------------------------------------
	//接收参数
	//------------------------------------
    $menuid = intval($_GET["menuid"]);
	$id = intval($_GET["id"]);
	$classid = intval($_GET["classid"]);

	//------------------------------------
	//取出产品类别
	//------------------------------------
	$plist->RowName = "class";
    $plist->Execute("select * from `{$tablepre}products_class`order by `sort_order`");
	$plist->TplParse();

	// -------------------------------------
    //取出产品分类--产品
   	// -------------------------------------
	$plist->RowName = "products";
    $plist->Execute("select * from `{$tablepre}products` where `products_classid` = {$classid} and `products_isvalid` = 1 order by `products_pubtime");
	$plist->TplParse();
	
	//------------------------------------
	//取出产品类别
	//------------------------------------
	
	$plist->RowName = "product";
    $plist->Execute("select C.class_name_en,P.* from `{$tablepre}products` as P,`{$tablepre}products_class` as C where C.id = P.products_classid and P.`id` = {$id} and `products_isvalid` = 1 order by P.`products_pubtime`");
	$plist->TplParse();
	
	$tpl->assign("cat_tree", get_categories_tree(0));
	$tpl->assign("menuid",$menuid);
	$tpl->assign("classid",$classid);
	$tpl->assign("id",$id);
	$tpl->assign("count",$count);
    $tpl->display("products_detail.html");


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