<?php
    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );

    // get main class
    $sql = "select * from `{$tablepre}admin_menu` where `parent_id`=0 and `isvalid`=1 order by `sort_order` asc";
    $query  = $db->query($sql);
    while($row = $db->fetch_array($query)) {
        // get sub class
        if (!empty($row["id"])) {
            $sql = "select * from `{$tablepre}admin_menu` where `parent_id`=".$row["id"]." order by `sort_order` asc";
            $query_sub = $db->query($sql);
            while($row_sub = $db->fetch_array($query_sub)) {
                $sub_class[] = array (
                    "sub_class_name" => $row_sub["class_name"],
                    "sub_class_value" => $row_sub["class_value"],
                    "sub_class_info" => $row_sub["class_info"]
                );
            }
        }
        $main_class[] = array (
            "main_class_id" => $row["id"],
            "main_class_name" => $row["class_name"],
            "main_class_info" => $row["class_info"],
            "main_class_sub" => $sub_class
        );
        // clear sub class array
        unset($sub_class);
    }

    // out put contents
    $tpl->assign('main_class',$main_class);
    $tpl->display('menu.htm');

    $db->close();
?>