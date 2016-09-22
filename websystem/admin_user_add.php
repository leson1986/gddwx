<?php

    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php' );
    require ( __COMM_PATH . 'checkform.func.php' );
    require ( __CLASS_PATH . 'page_edit.class.php' );

    // -------------------------------------------------------
    // ���մ��ݹ����ı���
    // -------------------------------------------------------
    $action = $_REQUEST["action"];
    $id     = addslashes($_REQUEST["id"]);

    // -------------------------------------------------------
    // ҳ���������
    // -------------------------------------------------------
    $page_title   = $ptitle["admin_user_add"];                  // ҳ�����
    $page_type    = "add";                                      // ҳ������
    $display_page = "admin_user_add.htm";                       // Smarty ģ��ҳ��
    $table_name   = "{$tablepre}admin_user";                    // ����
    $back_page    = "admin_user_list.php?sortby={$_GET['sortby']}&oexp={$_GET['oexp']}&page={$_GET['page']}";
                                                                // ���ص�ַ

    // -------------------------------------------------------
    // ����༭����
    // -------------------------------------------------------
    if ($action=="submit") {
        $admin_user = str_len_between($_POST["admin_user"], $clang["username"], 4, 20);
        $admin_user = dhtmlspecialchars(check_english($admin_user, $clang["username"]));
        $admin_pwd = dhtmlspecialchars(str_len_between($_POST["admin_pwd"], $clang["password"], 4, 30));
        $admin_pwd = comp_pwd($admin_pwd, $_POST["confirm_pwd"]);
        $admin_level = check_numeric($_POST["admin_level"], $clang["power_group"]);
        $admin_status = check_numeric($_POST["admin_status"], $clang["status"]);
        if (admin_exist($admin_user)) feedback($clang["admin_exist"]);
        if ($admin_level < $_SESSION["AdminLevel"]) feedback($clang["can_not_add_admin"]);
        $fields_arr = array(
            "admin_user" => $admin_user,
            "admin_pwd" => $admin_pwd,
            "admin_level" => $admin_level,
            "admin_status" => $admin_status
        );
    }

    // -------------------------------------------------------
    // ȡ�����д�������Ȩ�޵����б�
    // -------------------------------------------------------
    $query = $db->query("select `group_id`,`group_info` from `{$tablepre}admin_group` where `group_id`>='{$_SESSION['AdminLevel']}' order by `group_id` asc");
    while($row = $db->fetch_array($query)) {
        $group_ids[] = $row["group_id"];
        $group_infos[] = $row["group_info"];
    }
    $tpl->assign('group_ids', $group_ids);
    $tpl->assign('group_infos', $group_infos);
    $tpl->assign('admin_status_opt', array(1 => $clang["valid"], 0 => $clang["invalid"]));
    $tpl->assign('admin_status', 1);

    // -------------------------------------------------------
    // ִ��ҳ�洦��
    // -------------------------------------------------------
    show_page_head($page_type, $page_title);
    $pedit = new PageEdit($page_title, $back_page, $page_type); // ʵ����һ���༭ҳ��
    $pedit->SetParam($table_name);                              // �������ݿ������������ѯ����
    $pedit->InsertData($fields_arr);                            // ��������
    $pedit->TplParse($display_page);                            // �Զ�����������ݵ� Smarty ģ��
    show_page_foot();
    $db->close();
?>