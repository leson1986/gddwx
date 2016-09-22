<?php

    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );
    require ( __CLASS_PATH . 'tree.class.php' );

    // -------------------------------------------------------
    // 接收传递过来的变量
    // -------------------------------------------------------
    $action = $_REQUEST["action"];
    $id = addslashes($_REQUEST["id"]);
    $classid = intval($_GET["classid"]);
    $keyword = addslashes(substr($_REQUEST["keyword"], 0, 150));
    // -------------------------------------------------------
    // 批量操作
    // -------------------------------------------------------
    if (!empty($id)) {
        switch ($action) {
            case "del" : $db->query("delete from `{$tablepre}products_daili` where id in ({$id})"); break;
            case "confirm" : $db->query("update`{$tablepre}products_daili` set `products_isvalid`=1 where id in ({$id})"); break;
            case "deconfirm" : $db->query("update`{$tablepre}products_daili` set `products_isvalid`=0 where id in ({$id})"); break;
        }
    }

    // -------------------------------------------------------
    // 页面基本设置
    // -------------------------------------------------------
    $page_title   = $ptitle["products_list"];
    $page_size    = 15;
    $display_page = "products_daili_list.htm";
    $sortby       = "products_pubtime";
    $oexp         = "desc";
    $search_arr[] = array (
                        "field" => "products_name",
                        "keyword" => urldecode($keyword),
                        "condition" => "like",
                        "junk" => "or"
                    );
    $search_junk  = "and";
    $query_sql    = "select * from `{$tablepre}products_daili` where products_classid={$classid}";
    $url_para_arr = array ('classid','keyword');
    $tpl->assign("products_search", $ptitle["products_search"]);

    // -------------------------------------------------------
    // 执行页面处理
    // -------------------------------------------------------
    show_page_head("list",$page_title);
    $plist = new PageList($page_title, $page_size);
    $plist->SetSearch($search_arr, $search_junk);
    $plist->SortOpen = true;
    $plist->SetSort($sortby, $oexp);
    $plist->SetUrlParam($url_para_arr);
    $plist->Execute($query_sql);
    $plist->TplParse($display_page);
	$tpl->assign("classid",$classid);
    show_page_foot();
    $db->close();
?>