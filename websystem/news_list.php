<?php

    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );

    // -------------------------------------------------------
    // 接收传递过来的变量
    // -------------------------------------------------------
    $action = $_REQUEST["action"];
    $id = addslashes($_REQUEST["id"]);
    $classid = intval($_GET["classid"]);

    // -------------------------------------------------------
    // 批量操作
    // -------------------------------------------------------
    if (!empty($id)) {
        switch ($action) {
            case "del" : $db->query("delete from `{$tablepre}news` where id in ({$id}) and classid={$classid}"); break;
            case "confirm" : $db->query("update`{$tablepre}news` set `confirm`=1 where id in ({$id}) and classid={$classid}"); break;
            case "deconfirm" : $db->query("update`{$tablepre}news` set `confirm`=0 where id in ({$id}) and classid={$classid}"); break;
        }
    }

    // -------------------------------------------------------
    // 页面基本设置
    // -------------------------------------------------------
    $page_title   = $ptitle["news_list"];
    $page_size    = 15;
    $display_page = "news_list.htm";
    $keyword      = addslashes(substr($_REQUEST["keyword"], 0, 150));
    $sortby       = "posttime";
    $oexp         = "desc";
    $search_arr[] = array (
                        "field" => "news_title",
                        "keyword" => urldecode($keyword),
                        "condition" => "like",
                        "junk" => ""
                    );
    $search_junk  = "and";
    $query_sql    = "select * from `{$tablepre}news` where `classid`='{$classid}'";
    $url_para_arr = array ('classid', 'keyword');
    $tpl->assign("news_search", $ptitle["news_search"]);

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