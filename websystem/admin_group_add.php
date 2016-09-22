<?php

    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php' );
    require ( __COMM_PATH . 'checkform.func.php' );
    require ( __CLASS_PATH . 'page_edit.class.php' );

    if ($_SESSION["AdminLevel"]>1) feedback($clang["no_power"]);

    // -------------------------------------------------------
    // 接收传递过来的变量
    // -------------------------------------------------------
    $action = $_REQUEST["action"];
    $id     = addslashes($_REQUEST["id"]);

    // -------------------------------------------------------
    // 页面基本设置
    // -------------------------------------------------------
    $page_title   = $ptitle["admin_group_add"];                // 页面标题
    $page_type    = "add";                                     // 页面类型
    $display_page = "admin_group_edit.htm";                    // Smarty 模板页面
    $table_name   = "{$tablepre}admin_group";                  // 表名
    $back_page    = "admin_group_list.php";                    // 返回地址

    // -------------------------------------------------------
    // 保存编辑数据
    // -------------------------------------------------------
    if ($action=="submit") {
        $group_id = check_numeric($_POST["group_id"],$clang["admin_group_id"]);
        $group_name = dhtmlspecialchars(check_english($_POST["group_name"],$clang["admin_group_name"]));
        $group_info = dhtmlspecialchars(str_len_between($_POST["group_info"],$clang["admin_group_info"],0,20));
        if (group_exist($group_name)) feedback($clang["admin_group_exist"]);
        if ($group_id<$_SESSION["AdminLevel"] || $group_id==0) feedback($clang["can_not_add_admin_group"]);
        $fields_arr = array(
            "group_id" => $group_id,
            "group_name" => $group_name,
            "group_info" => $group_info
        );
    }

    // -------------------------------------------------------
    // 执行页面处理
    // -------------------------------------------------------
    show_page_head($page_type, $page_title);
    $pedit = new PageEdit($page_title, $back_page, $page_type); // 实例化一个编辑页面
    $pedit->SetParam($table_name);                              // 设置数据库基本参数，查询条件
    $pedit->InsertData($fields_arr);                            // 更新数据
    $pedit->TplParse($display_page);                            // 自动解析相关数据到 Smarty 模板
    show_page_foot();
    $db->close();
?>