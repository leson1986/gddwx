<?php
    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );

    //$support_infomation = '����Ϣ���Է������� �����¶�����... ������<a href="#">�������</a>';
	$test = "test!!";
	$tpl->assign("test2",$test);
    if ($_GET["action"]=="top") {
        $tpl->assign('support_infomation',$support_infomation);//�������
        $tpl->display('top.htm');//ִ��ģ���ļ�
        exit;
    }
    else {
        if ($_GET["action"]=="switch") $tpl->assign('is_switch',true);
        $show_top = file_exists($tpl->template_dir."top.htm") ? true : false;
        $tpl->assign('show_top',$show_top);
        $tpl->display('index.htm');
    }
?>