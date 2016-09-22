<?php

    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );

    if ($_SESSION["AdminLevel"]>1) feedback($clang["no_power"]);

    // -------------------------------------------------------
    // 接收传递过来的变量
    // -------------------------------------------------------
    $action = $_REQUEST["action"];
    $id = addslashes($_REQUEST["id"]);

    // -------------------------------------------------------
    // 删除记录
    // -------------------------------------------------------
    if ($action=="del" && !empty($id)) {
        $query = $db->query("select group_id from `{$tablepre}admin_group` where id in ($id)");
        if ($db->num_rows($query)) {
            $row = $db->fetch_array($query);
            if ($row["group_id"]==0) feedback($clang["can_not_del_admin_group"]);
            else $db->query("delete from `{$tablepre}admin_group` where id in ($id)");
        }
    }

    // -------------------------------------------------------
    // 页面基本设置
    // -------------------------------------------------------
    $page_title   = $ptitle["admin_group_list"];                // 页面标题
    $page_size    = 100;                                        // 每页显示的记录条数
    $display_page = "admin_group_list.htm";                     // Smarty 模板页面
    $sortby       = "id";                                       // 默认排序字段
    $oexp         = "asc";                                      // 默认排序方向
    $search_junk  = "or";                                       // 搜索 SQL 子句与主体的关系特性
    $query_sql    = "select * from `{$tablepre}admin_group` where group_id>={$_SESSION['AdminLevel']}";
                                                                // SQL 查询语句

    // -------------------------------------------------------
    // 执行页面处理
    // -------------------------------------------------------
    show_page_head("list",$page_title);
    $plist = new PageList($page_title, $page_size);             // 实例化一个数据显示页面
    $plist->SetSort($sortby, $oexp);                            // 设置默认排序方式
    $plist->Execute($query_sql);                                // 执行页面处理
    $plist->TplParse($display_page);                            // 自动解析相关数据到 Smarty 模板
    show_page_foot();
    $db->close();
?>