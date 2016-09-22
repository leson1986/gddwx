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
    $classid= intval($_GET["classid"]);
    if (!is_numeric($classid)) feedback($clang["pls_enter_news_class"]);

    // -------------------------------------------------------
    // 页面基本设置
    // -------------------------------------------------------
    $page_title   = $ptitle["news_edit"];
    $page_type    = "edit";
    $display_page = "news_edit.htm";
    $table_name   = "{$tablepre}news";
    $condition    = "WHERE `id`='{$id}' and `classid`='{$classid}'";
    $back_page    = "news_list.php?sortby={$_GET['sortby']}&oexp={$_GET['oexp']}&page={$_GET['page']}&classid={$classid}&keyword={$_GET['keyword']}";

    // -------------------------------------------------------
    // 保存编辑数据
    // -------------------------------------------------------
    if ($action=="submit") {
        $news_title = dhtmlspecialchars(check_empty($_POST["news_title"],$clang[news_title]));
        $news_title_en = dhtmlspecialchars($_POST["news_title_en"]);
        $fields_arr = array(
            "classid" => $classid,
            "news_title" => $news_title,
            "news_title_en" => $news_title_en,
            "confirm" => intval($_POST["confirm"]),
            "tags" => dhtmlspecialchars($_POST["tags"]),
            "news_content" => $_POST["news_content"],
            "news_content_en" => $_POST["news_content_en"],
            "summary" => dhtmlspecialchars($_POST["summary"]),
            "posttime" => date ("Y-m-d H:i:s", strtotime($_POST["posttime"])),
            "author" => dhtmlspecialchars($_POST["author"]),
        );
    }

    // -------------------------------------------------------
    // 执行页面处理
    // -------------------------------------------------------
	$tpl->assign("classid", $classid);
    show_page_head($page_type, $page_title);
    $pedit = new PageEdit($page_title, $back_page, $page_type);
    $pedit->SetParam($table_name, $condition);
    $pedit->UpdateData($fields_arr);
    $pedit->TplParse($display_page);
    show_page_foot();
    $db->close();
?>