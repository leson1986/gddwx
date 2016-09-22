<?php
    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );

    //$support_infomation = '该消息来自服务器！ 又有新动作了... 详情请<a href="#">点击这里</a>';
	$test = "test!!";
	$tpl->assign("test2",$test);
    if ($_GET["action"]=="top") {
        $tpl->assign('support_infomation',$support_infomation);//定义变量
        $tpl->display('top.htm');//执行模板文件
        exit;
    }
    else {
        if ($_GET["action"]=="switch") $tpl->assign('is_switch',true);
        $show_top = file_exists($tpl->template_dir."top.htm") ? true : false;
        $tpl->assign('show_top',$show_top);
        $tpl->display('index.htm');
    }
?>