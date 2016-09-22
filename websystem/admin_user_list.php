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

    // -------------------------------------------------------
    // 删除记录
    // -------------------------------------------------------
    if ($action=="del" && !empty($id)) {
        $query = $db->query("select admin_user,admin_level from `{$tablepre}admin_user` where id in ($id)");
        if ($db->num_rows($query)) {
            $row = $db->fetch_array($query);
            if ($row["admin_user"]==$_SESSION["AdminUser"])
                feedback($clang["can_not_del_self"]);
            elseif ($row["admin_level"]==0 && $_SESSION["AdminLevel"]!=0)
                feedback($clang["can_not_del_sys_usr"]);
            else
                $db->query("delete from `{$tablepre}admin_user` where id in ($id)");
        }
    }

    // -------------------------------------------------------
    // 页面基本设置
    // -------------------------------------------------------
    $page_title   = $ptitle["admin_user_list"];                 // 页面标题
    $page_size    = 10;                                         // 每页显示的记录条数
    $display_page = "admin_user_list.htm";                      // Smarty 模板页面
    $keyword      = addslashes(substr($_REQUEST["keyword"],0,150));  // 搜索关键字
    $sortby       = "id";                                       // 默认排序字段
    $oexp         = "asc";                                      // 默认排序方向
    $search_arr[] = array (                                     // 需要的搜索字段及特性
                        "field" => "admin_user",                // 字段名
                        "keyword" => urldecode($keyword),       // 关键字
                        "condition" => "like",                  // 查询条件
                        "junk" => "or"                          // 条件关系
                    );
    $search_junk  = "or";                                       // 搜索 SQL 子句与主体的关系特性
    $query_sql    = "select U.*,G.group_info from `{$tablepre}admin_user` as U,`{$tablepre}admin_group` as G where U.admin_level=G.group_id and U.admin_level>={$_SESSION['AdminLevel']}";
                                                                // SQL 查询语句
    $url_para_arr = array ('keyword');                          // 需要传递的 URL 参数数组

    // -------------------------------------------------------
    // 执行页面处理
    // -------------------------------------------------------
    show_page_head("list",$page_title);
    $plist = new PageList($page_title, $page_size);             // 实例化一个数据显示页面
    $plist->SetSearch($search_arr, $search_junk);               // 设置搜索条件
    $plist->SortOpen = true;                                    // 开启页面字段排序功能
    $plist->SetSort($sortby, $oexp);                            // 设置默认排序方式
    $plist->SetUrlParam($url_para_arr);                         // 设置 URL 需要传递的参数数组
    $plist->Execute($query_sql);                                // 执行页面处理
    $plist->TplParse($display_page);                            // 自动解析相关数据到 Smarty 模板
    show_page_foot();
    $db->close();
?>