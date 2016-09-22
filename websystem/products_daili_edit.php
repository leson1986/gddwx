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
	$classid = intval($_GET["classid"]);

    // -------------------------------------------------------
    // 页面基本设置
    // -------------------------------------------------------
    $page_title   = $ptitle["products_edit"];
    $page_type    = "edit";
    $display_page = "products_daili_edit.htm";
    $table_name   = "{$tablepre}products_daili";
    $condition    = "WHERE `id`='{$id}'";
    $back_page    = "products_daili_list.php?classid=$classid&sortby={$_GET['sortby']}&oexp={$_GET['oexp']}&page={$_GET['page']}&products_classid={$_GET['products_classid']}&keyword={$_GET['keyword']}";


    // -------------------------------------------------------
    // 保存编辑数据
    // -------------------------------------------------------
    if ($action=="submit") {
        $products_name = dhtmlspecialchars(check_empty($_POST["products_name"],$clang[products_name]));
        $products_thumb = dhtmlspecialchars($_POST["products_thumb"]);
        $products_title = dhtmlspecialchars($_POST["products_title"]);
        $fields_arr = array(
            "products_classid" => $classid,
            "products_name" => $products_name,
            "products_title" => $products_title,
            "products_thumb" => $products_thumb,
			
            "products_detail" => $_POST["products_detail"],
            "products_desc" => $_POST["products_desc"],
            "products_desc_en" => $_POST["products_desc_en"],
            "products_detail_en" => $_POST["products_detail_en"],
			
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
	$pedit->UpdateData($fields_arr);
    $pedit->TplParse($display_page);
    show_page_foot();
    $db->close();
?>