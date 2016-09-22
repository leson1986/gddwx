<?php

    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );

    // -------------------------------------------------------
    // ���մ��ݹ����ı���
    // -------------------------------------------------------
    $action = $_REQUEST["action"];
    $id = addslashes($_REQUEST["id"]);

    // -------------------------------------------------------
    // ɾ����¼
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
    // ҳ���������
    // -------------------------------------------------------
    $page_title   = $ptitle["admin_user_list"];                 // ҳ�����
    $page_size    = 10;                                         // ÿҳ��ʾ�ļ�¼����
    $display_page = "admin_user_list.htm";                      // Smarty ģ��ҳ��
    $keyword      = addslashes(substr($_REQUEST["keyword"],0,150));  // �����ؼ���
    $sortby       = "id";                                       // Ĭ�������ֶ�
    $oexp         = "asc";                                      // Ĭ��������
    $search_arr[] = array (                                     // ��Ҫ�������ֶμ�����
                        "field" => "admin_user",                // �ֶ���
                        "keyword" => urldecode($keyword),       // �ؼ���
                        "condition" => "like",                  // ��ѯ����
                        "junk" => "or"                          // ������ϵ
                    );
    $search_junk  = "or";                                       // ���� SQL �Ӿ�������Ĺ�ϵ����
    $query_sql    = "select U.*,G.group_info from `{$tablepre}admin_user` as U,`{$tablepre}admin_group` as G where U.admin_level=G.group_id and U.admin_level>={$_SESSION['AdminLevel']}";
                                                                // SQL ��ѯ���
    $url_para_arr = array ('keyword');                          // ��Ҫ���ݵ� URL ��������

    // -------------------------------------------------------
    // ִ��ҳ�洦��
    // -------------------------------------------------------
    show_page_head("list",$page_title);
    $plist = new PageList($page_title, $page_size);             // ʵ����һ��������ʾҳ��
    $plist->SetSearch($search_arr, $search_junk);               // ������������
    $plist->SortOpen = true;                                    // ����ҳ���ֶ�������
    $plist->SetSort($sortby, $oexp);                            // ����Ĭ������ʽ
    $plist->SetUrlParam($url_para_arr);                         // ���� URL ��Ҫ���ݵĲ�������
    $plist->Execute($query_sql);                                // ִ��ҳ�洦��
    $plist->TplParse($display_page);                            // �Զ�����������ݵ� Smarty ģ��
    show_page_foot();
    $db->close();
?>