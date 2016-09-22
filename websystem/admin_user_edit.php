<?php

    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php' );
    require ( __COMM_PATH . 'checkform.func.php' );
    require ( __CLASS_PATH . 'page_edit.class.php' );

    // -------------------------------------------------------
    // 接收传递过来的变量
    // -------------------------------------------------------
    $action = $_REQUEST["action"];
    $id     = addslashes($_REQUEST["id"]);

    // -------------------------------------------------------
    // 页面基本设置
    // -------------------------------------------------------
    $page_title   = $ptitle["admin_user_edit"];                 // 页面标题
    $page_type    = "edit";                                     // 页面类型
    $display_page = "admin_user_edit.htm";                      // Smarty 模板页面
    $table_name   = "{$tablepre}admin_user";                    // 表名
    $condition    = "WHERE `id`='{$id}'";                       // 查询条件
    $back_page    = "admin_user_list.php?sortby={$_GET['sortby']}&oexp={$_GET['oexp']}&page={$_GET['page']}";
                                                                // 返回地址

    // -------------------------------------------------------
    // 保存编辑数据
    // -------------------------------------------------------
    if ($action=="submit") {
        $admin_user = str_len_between($_POST["admin_user"], $clang["username"], 4, 20);
        $admin_user = dhtmlspecialchars(check_english($admin_user, $clang["username"]));
        $admin_pwd = dhtmlspecialchars(str_len_between($_POST["admin_pwd"], $clang["password"], 4, 30, true));
        $admin_pwd = comp_pwd($admin_pwd, $_POST["confirm_pwd"], true);
        $admin_level = check_numeric($_POST["admin_level"], $clang["power_group"]);
        $admin_status = check_numeric($_POST["admin_status"], $clang["status"]);
        if ($admin_level<$_SESSION["AdminLevel"]) feedback($clang["can_not_edit_admin"]);
        if (!empty($admin_pwd)) {
            $fields_arr = array(
                "admin_user" => $admin_user,
                "admin_pwd" => $admin_pwd,
                "admin_level" => $admin_level,
                "admin_status" => $admin_status
            );
        }
        else {
            $fields_arr = array(
                "admin_user" => $admin_user,
                "admin_level" => $admin_level,
                "admin_status"  => $admin_status
            );
        }
    }

    // -------------------------------------------------------
    // 取出所有大于自身权限的组列表
    // -------------------------------------------------------
    $query = $db->query("select `group_id`,`group_info` from `{$tablepre}admin_group` where `group_id`>='{$_SESSION['AdminLevel']}' order by `group_id` asc");
    while($row = $db->fetch_array($query)) {
        $group_ids[] = $row["group_id"];
        $group_infos[] = $row["group_info"];
    }
    $tpl->assign('group_ids', $group_ids);
    $tpl->assign('group_infos', $group_infos);
    $tpl->assign('admin_status_opt', array(1 => $clang["valid"], 0 => $clang["invalid"]));

    // -------------------------------------------------------
    // 执行页面处理
    // -------------------------------------------------------
    show_page_head($page_type, $page_title);
    $pedit = new PageEdit($page_title, $back_page, $page_type); // 实例化一个编辑页面
    $pedit->SetParam($table_name, $condition);                  // 设置数据库基本参数，查询条件
    $pedit->UpdateData($fields_arr);                            // 更新数据
    $pedit->TplParse($display_page);                            // 自动解析相关数据到 Smarty 模板
    show_page_foot();
    $db->close();
?>