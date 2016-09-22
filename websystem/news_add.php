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
    $classid= intval($_GET["classid"]);
    if (!is_numeric($classid)) feedback($clang["pls_enter_news_class"]);

    // -------------------------------------------------------
    // ҳ���������
    // -------------------------------------------------------
    $page_title   = $ptitle["news_add"];                        // ҳ�����
    $page_type    = "add";                                      // ҳ������
    $display_page = "news_edit.htm";                            // Smarty ģ��ҳ��
    $table_name   = "{$tablepre}news";                          // ����
    $condition    = "WHERE `classid`='{$classid}'";             // ��ѯ����
    $back_page    = "news_list.php?sortby={$_GET['sortby']}&oexp={$_GET['oexp']}&page={$_GET['page']}&classid={$classid}&keyword={$_GET['keyword']}";

    // -------------------------------------------------------
    // ����༭����
    // -------------------------------------------------------
    if ($action=="submit") {
        $news_title = dhtmlspecialchars(check_empty($_POST["news_title"],$clang[news_title]));
        $news_title_en = dhtmlspecialchars($_POST["news_title_en"]);

        $confirm = dhtmlspecialchars(check_numeric($_POST["confirm"],$clang[news_confirm]));
        $tags = dhtmlspecialchars($_POST["tags"]);
        $summary = dhtmlspecialchars($_POST["summary"]);
        $posttime = date ("Y-m-d H:i:s", strtotime($_POST["posttime"]));
        $author = dhtmlspecialchars($_POST["author"]);
        $fields_arr = array(
            "classid" => $classid,
            "news_title" => $news_title,
            "news_title_en" => $news_title_en,
            "confirm" => $confirm,
            "tags" => $tags,
            "news_content" => $_POST["news_content"],
            "news_content_en" => $_POST["news_content_en"],
            "summary" => $summary,
            "posttime" => $posttime,
            "author" => $author
        );
    }

    // -------------------------------------------------------
    // ����������Ϣ
    // -------------------------------------------------------
    $tpl->assign("classid", $classid);
    $tpl->assign("isnew", 0);
    $tpl->assign("confirm", 1);
    $tpl->assign('posttime', date("Y-m-d H:i:s"));
    $tpl->assign('author', $_SESSION["AdminUser"]);

    // -------------------------------------------------------
    // ִ��ҳ�洦��
    // -------------------------------------------------------
	$tpl->assign("classid", $classid);
    show_page_head($page_type, $page_title);
    $pedit = new PageEdit($page_title, $back_page, $page_type); // ʵ����һ���༭ҳ��
    $pedit->SetParam($table_name, $condition);                  // �������ݿ������������ѯ����
    $pedit->InsertData($fields_arr);                            // ��������
    $pedit->TplParse($display_page);                            // �Զ�����������ݵ� Smarty ģ��
    show_page_foot();
    $db->close();
?>