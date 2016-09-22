<?php
    require ( 'init.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );
	require ( __LANG_PATH . 'en.core.php');
    require("./count/redhat.php");
	$plist = new PageList();
	
	//------------------------------------
	//?
	//------------------------------------
    $Field        = intval($_REQUEST["Field"]);
	$BigClassName = intval($_REQUEST["BigClassName"]);
	$Keyword      = dhtmlspecialchars($_REQUEST["Keyword"]);
	
	if(!empty($BigClassName))
	{
	$str = $BigClassName;
	$sqlclass = "select id from `{$tablepre}products_class` where parent_id={$BigClassName}";
	$rsc = $db->getAll($sqlclass);
		if(!empty($rsc)){
		foreach($rsc as $key=>$value){
			$str .= ", ".$value['id']; 
		}
		
		}
		$where = " and P.`products_classid` in ({$str})";
	}else{
		$where = "";
	}

	if($Field == 1){
		if(!empty($Keyword)){
		$where .= " and P.`products_title` like '%".$Keyword."%' ";
		}
	}elseif($Field == 2){
		if(!empty($Keyword)){
		$where .= " and P.`products_detail_en` like '%".$Keyword."%' ";
		}
	}

	//------------------------------------
	//?
	//------------------------------------
	$plist->RowName = "product";
	$plist->SetPageSize(30);
	$plist->SetUrlParam(array('classid','menuid'));
    $plist->Execute("select C.class_name_en,P.* from `{$tablepre}products` as P,`{$tablepre}products_class` as C where C.id = P.products_classid ".$where." and `products_isvalid` = 1 order by P.`products_pubtime`");
	$plist->TplParse();
	
	$tpl->assign("cat_tree", get_categories_tree(0));
	$tpl->assign("menuid",$menuid);
	$tpl->assign("count",$count);
    $tpl->display("search_cn.html");
	
	
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