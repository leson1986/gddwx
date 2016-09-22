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

    // -------------------------------------------------------
    // 页面基本设置
    // -------------------------------------------------------
    $page_title   = $ptitle["system"];                         // 页面标题
    $page_type    = "edit";                                    // 页面类型
    $back_page    = "system.php";                              // 返回页面
    $display_page = "system.htm";                              // Smarty 模板页面
    $table_name   = "{$tablepre}system";                       // 表名
    $condition    = "WHERE `id`='1'";                          // 查询条件

    // -------------------------------------------------------
    // 保存编辑数据
    // -------------------------------------------------------
    if ($action=="submit") {
        $char_set = dhtmlspecialchars(check_empty($_POST["char_set"],$clang["char_set"]));
        $site_name = dhtmlspecialchars(check_empty($_POST["site_name"],$clang["site_name"]));
        $site_url = dhtmlspecialchars(check_empty($_POST["site_url"],$clang["site_url"]));
        $site_cert = dhtmlspecialchars($_POST["site_cert"]);
        $site_mail = dhtmlspecialchars(check_email($_POST["site_mail"],$clang["site_mail"],true));
		$site_keywords = dhtmlspecialchars($_POST["site_keywords"]);
		$site_description = dhtmlspecialchars($_POST["site_description"]);
		
        $upfile_size = check_numeric($_POST["upfile_size"],$clang["allow_upload_size"]);
        $allow_file_type = dhtmlspecialchars($_POST["allow_file_type"]);
        $product_thumb_width = check_numeric($_POST["product_thumb_width"],$clang["product_thumb_width"],true);
        $product_thumb_height = check_numeric($_POST["product_thumb_height"],$clang["product_thumb_height"],true);
        $product_image_width = check_numeric($_POST["product_image_width"],$clang["product_image_width"],true);
        $product_image_height = check_numeric($_POST["product_image_height"],$clang["product_image_height"],true);
        $gbook_open = check_numeric($_POST["gbook_open"],$clang["gbook_open"],true);
        $gbook_page_size = check_numeric($_POST["gbook_page_size"],$clang["gbook_page_size"],true);
        $gbook_post_time = check_numeric($_POST["gbook_post_time"],$clang["gbook_post_time"],true);
        $gbook_post_verify = check_numeric($_POST["gbook_post_verify"],$clang["gbook_post_verfify"],true);
        $gbook_post_guest = check_numeric($_POST["gbook_post_guest"],$clang["gbook_post_guest"],true);

        if ($_SESSION["AdminLevel"]==0) {
            $site_is_test_space = intval($_POST["site_is_test_space"]);
            $site_test_space_name = dhtmlspecialchars(check_english($_POST["site_test_space_name"],$clang["site_test_space_name"],true));
            if ($site_is_test_space) {
                if (strlen($site_test_space_name)<2)
                    feedback($clang["site_test_space_no_empty"]);
                if (!file_exists(GetRootPath()."/$site_test_space_name/init.inc.php"))
                    feedback($clang["site_test_space_inexistence"]);
            }
            $site_open = check_numeric($_POST["site_open"],$clang["site_open"]);
            $fields_arr = array(
                "char_set" => $char_set,
                "site_name" => $site_name,
                "site_url" => $site_url,
                "site_cert" => $site_cert,
				"site_keywords" => $site_keywords,
				"site_description" => $site_description,
                "site_is_test_space" => $site_is_test_space,
                "site_test_space_name" => $site_test_space_name,
                "site_open" => $site_open,
                "site_mail" => $site_mail,
                "upfile_size" => $upfile_size,
                "allow_file_type" => $allow_file_type,
                "product_thumb_width" => $product_thumb_width,
                "product_thumb_height" => $product_thumb_height,
                "product_image_width" => $product_image_width,
                "product_image_height" => $product_image_height,
                "gbook_open" => $gbook_open,
                "gbook_page_size" => $gbook_page_size,
                "gbook_post_time" => $gbook_post_time,
                "gbook_post_verify" => $gbook_post_verify,
                "gbook_post_guest" => $gbook_post_guest
            );
        }
        else {
            $fields_arr = array(
                "char_set" => $char_set,
                "site_name" => $site_name,
                "site_url" => $site_url,
                "site_cert" => $site_cert,
                "site_mail" => $site_mail,
				"site_keywords" => $site_keywords,
				"site_description" => $site_description,
                "upfile_size" => $upfile_size,
                "allow_file_type" => $allow_file_type,
                "product_thumb_width" => $product_thumb_width,
                "product_thumb_height" => $product_thumb_height,
                "product_image_width" => $product_image_width,
                "product_image_height" => $product_image_height,
                "gbook_open" => $gbook_open,
                "gbook_page_size" => $gbook_page_size,
                "gbook_post_time" => $gbook_post_time,
                "gbook_post_verify" => $gbook_post_verify,
                "gbook_post_guest" => $gbook_post_guest
            );
        }
    }

    $tpl->assign("AdminLevel",$_SESSION["AdminLevel"]);

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