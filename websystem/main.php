<?php
    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php');

    show_page_head("list","欢迎进入管理后台");

//    if ($is_test_space && $_SESSION["AdminGroup"]==0) {
//        if (!file_exists(GetRootPath()."/$test_space_name/init.inc.php")) {
//            alert("网站设置为位于测试空间,但测试空间目录不存在或找不到程序初始化文件!");
//        }
//    }

    show_page_foot();
?>