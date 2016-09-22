<?php
    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php');
    require ( __COMM_PATH . 'checkform.func.php' );
    require ( __CLASS_PATH . 'tree.class.php');


    $table_name = "{$tablepre}admin_menu"; // 用于存储分类的表名
    $tree_name = "管理菜单目录"; // 目录树名称
    $tree = new Tree($table_name,0);
    $id = intval($_REQUEST["id"]);
    $act = $_REQUEST["act"];

    switch ($act) {
        case "add":
        case "edit":
            $parent_id = check_numeric($_POST["parent_id"],"上级菜单ID");
            $sort_order = check_numeric($_POST["sort_order"],"菜单排序");
            $class_name = dhtmlspecialchars(check_empty($_POST["class_name"],"菜单名称"));
            $class_value = dhtmlspecialchars($_POST["class_value"]);
            $class_info = dhtmlspecialchars($_POST["class_info"]);
            $issafe = dhtmlspecialchars($_POST["issafe"]);
            $isvalid = dhtmlspecialchars($_POST["isvalid"]);
            $fields_arr = array(
                    "parent_id" => "$parent_id",
                    "sort_order" => "$sort_order",
                    "class_name" => "$class_name",
                    "class_value" => "$class_value",
                    "class_info" => "$class_info",
                    "issafe" => "$issafe",
                    "isvalid" => "$isvalid"
            );
            if ($act=="add") { // 新增分类
                $sql = create_insert_sql($table_name,$fields_arr);
                $result = $db->query($sql);
                doJS("parent._list.location.reload();parent.parent.leftFrame.location.reload()");
                goto("?act=form&id=$id");
            }
            elseif ($act=="edit") { //　编辑分类
                $condition = "WHERE `id`='$id'";
                $sql = create_update_sql($table_name, $fields_arr, $condition);
                $result = $db->query($sql);
                doJS("parent._list.location.reload();parent.parent.leftFrame.location.reload()");
                goto("?act=form&id=$id");
            }
            break;
        case "del":
            // 删除分类
            $db->query("delete from `$table_name` where id='$id'");
            doJS("parent._list.location.reload();parent.parent.leftFrame.location.reload()");
        case "form":
            $sel_box_name = "parent_id"; // 下拉列表 name && id
            $class_issafe_val = 0;        // 是否保护默认值
            $class_isvalid_val = 1;      // 是否有效默认值
            if (!empty($id)) {
                $sql = "select * from `$table_name` where `id`='$id'";
                $query = $db->query($sql);
                if ($db->num_rows($query)) {
                    $row = $db->fetch_array($query);
                    $selID = $row["parent_id"];
                    $class_issafe_val = $row["issafe"];
                    $class_isvalid_val = $row["isvalid"];
                    $sort_order = $row["sort_order"];
                    $class_name = $row["class_name"];
                    $class_value = $row["class_value"];
                    $class_info = $row["class_info"];
                }
            }
            // 输出HTML页面
            $page_type = "菜单编辑";
            show_page_head("edit",$page_type);
            $tpl->assign('parend_id', $tree -> _makeSelBox($sel_box_name,$selID,true));    // 生成下拉列表
            $tpl->assign('sort_order', $sort_order);
            $tpl->assign('class_name', $class_name);
            $tpl->assign('class_value', $class_value);
            $tpl->assign('class_info', $class_info);
            $tpl->assign('class_issafe', array(1 => '保护',0 => '不保护'));
            $tpl->assign('class_isvalid', array(1 => '有效',0 => '无效'));
            $tpl->assign('class_issafe_val', $class_issafe_val);
            $tpl->assign('class_isvalid_val', $class_isvalid_val);
            $tpl->assign('menu_id', $id);
            $tpl->display('admin_menu_edit.htm');
            show_page_foot();
            $db->close();
            break;
        case "list": // 显示目录树
            $header_content = '<link rel="StyleSheet" href="../scripts/dtree.css" type="text/css" />';
            $header_content .= "\n".'<script type="text/javascript" src="../scripts/dtree.js"></script>';
            show_xhtml_header($header_content);
            doJS($tree -> get_jstree("?act=form","_edit",$tree_name));
            show_xhtml_footer();
            break;
        default:
            // 显示页面标题
            $page_type = "菜单设置";
            show_page_head("edit",$page_type);
            $tpl->assign("page_type", $page_type);
            $tpl->display('admin_menu.htm');
            // 显示页面底部
            show_page_foot();
    }
?>