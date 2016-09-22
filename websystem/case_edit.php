<?php

    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php' );
    require ( __COMM_PATH . 'checkform.func.php' );
    require ( __CLASS_PATH . 'page_edit.class.php' );
    require ( __CLASS_PATH . 'tree.class.php' );

    // -------------------------------------------------------
    // 接收传递过来的变量
    // -------------------------------------------------------
    $action = $_REQUEST["action"];
    $id     = addslashes($_REQUEST["id"]);

    // -------------------------------------------------------
    // 页面基本设置
    // -------------------------------------------------------
    $page_title   = $ptitle["products_edit"];
    $page_type    = "edit";
    $display_page = "case_edit.htm";
    $table_name   = "{$tablepre}case";
    $condition    = "WHERE `id`='{$id}'";
    $back_page    = "case_list.php?sortby={$_GET['sortby']}&oexp={$_GET['oexp']}&page={$_GET['page']}&products_classid={$_GET['products_classid']}&keyword={$_GET['keyword']}";


    // -------------------------------------------------------
    // 保存编辑数据
    // -------------------------------------------------------
    if ($action=="submit") {
        $products_classid = check_numeric($_POST["products_classid"],$clang[products_classid]);
        if ($products_classid==0) feedback($cmsg['products_class_null']);
        $products_name = dhtmlspecialchars(check_empty($_POST["products_name"],$clang[products_name]));
        $products_thumb = dhtmlspecialchars($_POST["products_thumb"]);
        $products_thumb_en = dhtmlspecialchars($_POST["products_thumb_en"]);
        $fields_arr = array(
            "products_classid" => $products_classid,
            "products_name" => $products_name,
            "products_name_en" => dhtmlspecialchars($_POST["products_name_en"]),
            "products_thumb" => $products_thumb,
            "products_thumb_en" => $products_thumb_en,
			
            "products_desc" => dhtmlspecialchars($_POST["products_desc"]),
            "products_detail" => $_POST["products_detail"],
            "products_tags" => dhtmlspecialchars($_POST["products_tags"]),
            "products_isvalid" => 1,
            "products_istop" => intval($_POST["products_istop"]),
            "products_index" => intval($_POST["products_index"]),
            "products_pubtime" => date ("Y-m-d H:i:s", strtotime($_POST["products_pubtime"])),
            "products_author" => dhtmlspecialchars($_POST["products_author"]),
        );
    }

    // -------------------------------------------------------
    // 执行页面处理
    // -------------------------------------------------------
    show_page_head($page_type, $page_title);
    $pedit = new PageEdit($page_title, $back_page, $page_type);
    $pedit->SetParam($table_name, $condition);
    $tree = new Tree("{$tablepre}case_class", 0);
    $tpl->assign('products_classid_box', $tree ->_makeSelBox("products_classid", $pedit->QueryRow["products_classid"], true, "")); // 生成下拉列表
    $pedit->UpdateData($fields_arr);
    $pedit->TplParse($display_page);
    show_page_foot();
    $db->close();
?>