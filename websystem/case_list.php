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
    $products_classid = intval($_GET["products_classid"]);
    $keyword = addslashes(substr($_REQUEST["keyword"], 0, 150));

    // -------------------------------------------------------
    // 批量操作
    // -------------------------------------------------------
    if (!empty($id)) {
        switch ($action) {
            case "del" : $db->query("delete from `{$tablepre}case` where id in ({$id})"); break;
            case "confirm" : $db->query("update`{$tablepre}case` set `products_isvalid`=1 where id in ({$id})"); break;
            case "deconfirm" : $db->query("update`{$tablepre}case` set `products_isvalid`=0 where id in ({$id})"); break;
        }
    }

    // -------------------------------------------------------
    // 页面基本设置
    // -------------------------------------------------------
    $page_title   = $ptitle["products_list"];
    $page_size    = 15;
    $display_page = "case_list.htm";
    $sortby       = "products_pubtime";
    $oexp         = "desc";
    $search_arr[] = array (
                        "field" => "class_name",
                        "keyword" => urldecode($keyword),
                        "condition" => "like",
                        "junk" => "or"
                    );
    $search_arr[] = array (
                        "field" => "products_name",
                        "keyword" => urldecode($keyword),
                        "condition" => "like",
                        "junk" => "or"
                    );
    $search_arr[] = array (
                        "field" => "products_url",
                        "keyword" => urldecode($keyword),
                        "condition" => "like",
                        "junk" => "or"
                    );
    $search_junk  = "and";
    $query_sql    = "select C.class_name,S.* from `{$tablepre}case` as S, `{$tablepre}case_class` as C where S.products_classid=C.id";
    if ($products_classid>0) $query_sql .= " and S.products_classid={$products_classid}";
    $url_para_arr = array ('products_classid','keyword');
    $tpl->assign("products_search", $ptitle["products_search"]);

    // -------------------------------------------------------
    // 其他处理 (生成下拉列表)
    // -------------------------------------------------------
    $tree = new Tree("{$tablepre}case_class",0);
    $tpl->assign('products_classid_box', $tree ->_makeSelBox("products_classid",$products_classid,true,"location.href='?products_classid='+this.value;"));

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
    show_page_foot();
    $db->close();
?>