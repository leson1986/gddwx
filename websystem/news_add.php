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
    $page_title   = $ptitle["news_add"];                        // 页面标题
    $page_type    = "add";                                      // 页面类型
    $display_page = "news_edit.htm";                            // Smarty 模板页面
    $table_name   = "{$tablepre}news";                          // 表名
    $condition    = "WHERE `classid`='{$classid}'";             // 查询条件
    $back_page    = "news_list.php?sortby={$_GET['sortby']}&oexp={$_GET['oexp']}&page={$_GET['page']}&classid={$classid}&keyword={$_GET['keyword']}";

    // -------------------------------------------------------
    // 保存编辑数据
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
    // 解析基本信息
    // -------------------------------------------------------
    $tpl->assign("classid", $classid);
    $tpl->assign("isnew", 0);
    $tpl->assign("confirm", 1);
    $tpl->assign('posttime', date("Y-m-d H:i:s"));
    $tpl->assign('author', $_SESSION["AdminUser"]);

    // -------------------------------------------------------
    // 执行页面处理
    // -------------------------------------------------------
	$tpl->assign("classid", $classid);
    show_page_head($page_type, $page_title);
    $pedit = new PageEdit($page_title, $back_page, $page_type); // 实例化一个编辑页面
    $pedit->SetParam($table_name, $condition);                  // 设置数据库基本参数，查询条件
    $pedit->InsertData($fields_arr);                            // 更新数据
    $pedit->TplParse($display_page);                            // 自动解析相关数据到 Smarty 模板
    show_page_foot();
    $db->close();
?>