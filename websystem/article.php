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
    $article_id = intval($_GET["article_id"]);

    // -------------------------------------------------------
    // 页面基本设置
    // -------------------------------------------------------
    $page_title   = $ptitle["article"];                        // 页面标题
    $page_type    = "edit";                                    // 页面类型
    $back_page    = "article.php?article_id={$article_id}";    // 返回页面
    $display_page = "article.htm";                             // Smarty 模板页面
    $table_name   = "{$tablepre}article";                      // 表名
    $condition    = "WHERE `article_id`='{$article_id}'";      // 查询条件

    // -------------------------------------------------------
    // 检测文档是否存在，不存在则创建
    // -------------------------------------------------------
    $query = $db->query("SELECT `id` FROM `{$table_name}` {$condition}");
    if (!$db->num_rows($query)) $db->query("INSERT INTO `{$table_name}` (`article_id`) VALUES ('$article_id')");

    // -------------------------------------------------------
    // 保存编辑数据
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