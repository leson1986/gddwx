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
    $page_title   = ���Իظ�;
    $page_type    = "edit";
    $display_page = "reply_edit.htm";
    $table_name   = "{$tablepre}reply";
    $condition    = "WHERE `id`='{$id}'";
    $back_page    = "reply_list.php?sortby={$_GET['sortby']}&oexp={$_GET['oexp']}&page={$_GET['page']}&classid={$classid}&keyword={$_GET['keyword']}";

    // -------------------------------------------------------
    // ����༭����
    // -------------------------------------------------------
    if ($action=="submit") {
        $fields_arr = array(
            "return_content" => dhtmlspecialchars($_POST["return_content"]),
        );
    }

    // -------------------------------------------------------
    // ִ��ҳ�洦��
    // -------------------------------------------------------
    show_page_head($page_type, $page_title);
    $pedit = new PageEdit($page_title, $back_page, $page_type);
    $pedit->SetParam($table_name, $condition);
    $pedit->UpdateData($fields_arr);
    $pedit->TplParse($display_page);
    show_page_foot();
    $db->close();
?>