<?php

    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php' );
    require ( __CLASS_PATH . 'db_mysql_dump.class.php' );

    $dir_name = __DATBAK_PATH; // ָ�������ļ�Ŀ¼

    //-------------------------------------
    // ���������ļ�
    //-------------------------------------
    if ($_POST["action"]=="submit") {
        $dump = new mysqldump($dbhost, $dbuser, $dbpass, $dbname, $dbcharset);
        if (!$_POST["bak_comment"]) $dump->format_out = "no_comment"; // �Ƿ�����ļ�ע��
        if ($_POST["bak_nettoyage"]) $dump->nettoyage(); // �Ƿ���ձ���Ŀ¼�µ������ļ�
        $_POST["bak_isdown"] ? $dump->isdown = 1 : $dump->isdown = 0; // �Ƿ�����
        switch ($_POST["bak_filetype"]) {
            case "zip": $dump->compress_zip = 1; break; // ʹ��ZIPѹ����ʽ
            case "gz": $dump->compress_gz = 1; break; // ʹ��GZIPѹ����ʽ
        }
        $dump->backup($_POST["bak_filename"]);
        if ($dump->errr) feedback($dump->errr);
        elseif ($dump->isdown==0) feedback($clang["db_bak_successful"], "sqldump.php");
        else exit;
    }

    //-------------------------------------
    // ���ر����ļ�
    //-------------------------------------
    if ($_GET["action"]=="downbak") {
        $filepath = $dir_name.$_GET["file"];
        down_file($filepath) ? exit : feedback($clang["db_bak_file_inexistence"], "sqldump.php");
    }

    //-------------------------------------
    // ɾ�������ļ�
    //-------------------------------------
    if ($_GET["action"]=="delbak")
        @unlink($dir_name.$_GET["file"]);

    //-------------------------------------
    // �г����б����ļ�(.gz/.zip/.sql��ʽ�ļ�)
    //-------------------------------------
    $dir = @opendir($dir_name);
    while ($file_name = @readdir($dir)) {
        $file = $dir_name . $file_name; // ȡ�þ���·��
        $ext_name = get_file_ext($file_name); // ȡ����չ��
        if ( $ext_name == "gz" || $ext_name == "sql" || $ext_name == "zip") { // �Ƿ񱸷��ļ���ʽ
            $row_result[] = array(
            "filename" => $file_name,
            "filesize" => sprintf ("%01.2f", @filesize($file)/1024),
            "createdate" => date("Y-m-d H:i:s", @filemtime($file)),
            "downurl" => "?action=downbak&file=".urlencode($file_name),
            "delurl" => "?action=delbak&file=".urlencode($file_name)
            );
        }
    }
    @closedir($dir); // �ر�Ŀ¼

    /* --- ���HTML --- */
    $page_type = "���ݿⱸ��";
    show_page_head("list",$page_type);
    $tpl->assign("page_type", $page_type);
    $tpl->assign("bak_filename",$dbname."_".date("ymd_his_")."bak.sql");
    $tpl->assign("row_result",$row_result);
    $tpl->display("sqldump.htm");
    show_page_foot(); // ��ʾҳ��ײ�
?>