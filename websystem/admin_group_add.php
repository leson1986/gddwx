<?php

    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php' );
    require ( __COMM_PATH . 'checkform.func.php' );
    require ( __CLASS_PATH . 'page_edit.class.php' );

    if ($_SESSION["AdminLevel"]>1) feedback($clang["no_power"]);

    // -------------------------------------------------------
    // ���մ��ݹ����ı���
    // -------------------------------------------------------
    $action = $_REQUEST["action"];
    $id     = addslashes($_REQUEST["id"]);

    // -------------------------------------------------------
    // ҳ���������
    // -------------------------------------------------------
    $page_title   = $ptitle["admin_group_add"];                // ҳ�����
    $page_type    = "add";                                     // ҳ������
    $display_page = "admin_group_edit.htm";                    // Smarty ģ��ҳ��
    $table_name   = "{$tablepre}admin_group";                  // ����
    $back_page    = "admin_group_list.php";                    // ���ص�ַ

    // -------------------------------------------------------
    // ����༭����
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