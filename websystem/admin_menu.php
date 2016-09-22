<?php
    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php');
    require ( __COMM_PATH . 'checkform.func.php' );
    require ( __CLASS_PATH . 'tree.class.php');


    $table_name = "{$tablepre}admin_menu"; // ���ڴ洢����ı���
    $tree_name = "����˵�Ŀ¼"; // Ŀ¼������
    $tree = new Tree($table_name,0);
    $id = intval($_REQUEST["id"]);
    $act = $_REQUEST["act"];

    switch ($act) {
        case "add":
        case "edit":
            $parent_id = check_numeric($_POST["parent_id"],"�ϼ��˵�ID");
            $sort_order = check_numeric($_POST["sort_order"],"�˵�����");
            $class_name = dhtmlspecialchars(check_empty($_POST["class_name"],"�˵�����"));
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
            if ($act=="add") { // ��������
                $sql = create_insert_sql($table_name,$fields_arr);
                $result = $db->query($sql);
                doJS("parent._list.location.reload();parent.parent.leftFrame.location.reload()");
                goto("?act=form&id=$id");
            }
            elseif ($act=="edit") { //���༭����
                $condition = "WHERE `id`='$id'";
                $sql = create_update_sql($table_name, $fields_arr, $condition);
                $result = $db->query($sql);
                doJS("parent._list.location.reload();parent.parent.leftFrame.location.reload()");
                goto("?act=form&id=$id");
            }
            break;
        case "del":
            // ɾ������
            $db->query("delete from `$table_name` where id='$id'");
            doJS("parent._list.location.reload();parent.parent.leftFrame.location.reload()");
        case "form":
            $sel_box_name = "parent_id"; // �����б� name && id
            $class_issafe_val = 0;        // �Ƿ񱣻�Ĭ��ֵ
            $class_isvalid_val = 1;      // �Ƿ���ЧĬ��ֵ
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
            // ���HTMLҳ��
            $page_type = "�˵��༭";
            show_page_head("edit",$page_type);
            $tpl->assign('parend_id', $tree -> _makeSelBox($sel_box_name,$selID,true));    // ���������б�
            $tpl->assign('sort_order', $sort_order);
            $tpl->assign('class_name', $class_name);
            $tpl->assign('class_value', $class_value);
            $tpl->assign('class_info', $class_info);
            $tpl->assign('class_issafe', array(1 => '����',0 => '������'));
            $tpl->assign('class_isvalid', array(1 => '��Ч',0 => '��Ч'));
            $tpl->assign('class_issafe_val', $class_issafe_val);
            $tpl->assign('class_isvalid_val', $class_isvalid_val);
            $tpl->assign('menu_id', $id);
            $tpl->display('admin_menu_edit.htm');
            show_page_foot();
            $db->close();
            break;
        case "list": // ��ʾĿ¼��
            $header_content = '<link rel="StyleSheet" href="../scripts/dtree.css" type="text/css" />';
            $header_content .= "\n".'<script type="text/javascript" src="../scripts/dtree.js"></script>';
            show_xhtml_header($header_content);
            doJS($tree -> get_jstree("?act=form","_edit",$tree_name));
            show_xhtml_footer();
            break;
        default:
            // ��ʾҳ�����
            $page_type = "�˵�����";
            show_page_head("edit",$page_type);
            $tpl->assign("page_type", $page_type);
            $tpl->display('admin_menu.htm');
            // ��ʾҳ��ײ�
            show_page_foot();
    }
?>