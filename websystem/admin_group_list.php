<?php

    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );

    if ($_SESSION["AdminLevel"]>1) feedback($clang["no_power"]);

    // -------------------------------------------------------
    // ���մ��ݹ����ı���
    // -------------------------------------------------------
    $action = $_REQUEST["action"];
    $id = addslashes($_REQUEST["id"]);

    // -------------------------------------------------------
    // ɾ����¼
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
    // ҳ���������
    // -------------------------------------------------------
    $page_title   = $ptitle["admin_group_list"];                // ҳ�����
    $page_size    = 100;                                        // ÿҳ��ʾ�ļ�¼����
    $display_page = "admin_group_list.htm";                     // Smarty ģ��ҳ��
    $sortby       = "id";                                       // Ĭ�������ֶ�
    $oexp         = "asc";                                      // Ĭ��������
    $search_junk  = "or";                                       // ���� SQL �Ӿ�������Ĺ�ϵ����
    $query_sql    = "select * from `{$tablepre}admin_group` where group_id>={$_SESSION['AdminLevel']}";
                                                                // SQL ��ѯ���

    // -------------------------------------------------------
    // ִ��ҳ�洦��
    // -------------------------------------------------------
    show_page_head("list",$page_title);
    $plist = new PageList($page_title, $page_size);             // ʵ����һ��������ʾҳ��
    $plist->SetSort($sortby, $oexp);                            // ����Ĭ������ʽ
    $plist->Execute($query_sql);                                // ִ��ҳ�洦��
    $plist->TplParse($display_page);                            // �Զ�����������ݵ� Smarty ģ��
    show_page_foot();
    $db->close();
?>