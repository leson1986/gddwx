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
    $article_id = intval($_GET["article_id"]);

    // -------------------------------------------------------
    // ҳ���������
    // -------------------------------------------------------
    $page_title   = $ptitle["article"];                        // ҳ�����
    $page_type    = "edit";                                    // ҳ������
    $back_page    = "article.php?article_id={$article_id}";    // ����ҳ��
    $display_page = "article.htm";                             // Smarty ģ��ҳ��
    $table_name   = "{$tablepre}article";                      // ����
    $condition    = "WHERE `article_id`='{$article_id}'";      // ��ѯ����

    // -------------------------------------------------------
    // ����ĵ��Ƿ���ڣ��������򴴽�
    // -------------------------------------------------------
    $query = $db->query("SELECT `id` FROM `{$table_name}` {$condition}");
    if (!$db->num_rows($query)) $db->query("INSERT INTO `{$table_name}` (`article_id`) VALUES ('$article_id')");

    // -------------------------------------------------------
    // ����༭����
    // -------------------------------------------------------
    if ($action=="submit") {
        $fields_arr = array(
            "article_content" => $_POST["article_content"],
            "article_content_en" => $_POST["article_content_en"],
            "posttime" => date("Y-m-d H:i:s"),
            "author" => $_SESSION["AdminUser"]
        );
    }

    // -------------------------------------------------------
    // ִ��ҳ�洦��
    // -------------------------------------------------------
    show_page_head($page_type, $page_title);
    $pedit = new PageEdit($page_title, $back_page, $page_type); // ʵ����һ���༭ҳ��
    $pedit->SetParam($table_name, $condition);                  // �������ݿ������������ѯ����
    $pedit->UpdateData($fields_arr);                            // ��������
    $pedit->TplParse($display_page);                            // �Զ�����������ݵ� Smarty ģ��
    show_page_foot();
    $db->close();

?>