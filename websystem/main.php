<?php
    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php');

    show_page_head("list","��ӭ��������̨");

//    if ($is_test_space && $_SESSION["AdminGroup"]==0) {
//        if (!file_exists(GetRootPath()."/$test_space_name/init.inc.php")) {
//            alert("��վ����Ϊλ�ڲ��Կռ�,�����Կռ�Ŀ¼�����ڻ��Ҳ��������ʼ���ļ�!");
//        }
//    }

    show_page_foot();
?>