<?php

    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php' );
    require ( __CLASS_PATH . 'db_mysql_dump.class.php' );

    $dir_name = __DATBAK_PATH; // 指定备份文件目录

    //-------------------------------------
    // 创建备份文件
    //-------------------------------------
    if ($_POST["action"]=="submit") {
        $dump = new mysqldump($dbhost, $dbuser, $dbpass, $dbname, $dbcharset);
        if (!$_POST["bak_comment"]) $dump->format_out = "no_comment"; // 是否添加文件注释
        if ($_POST["bak_nettoyage"]) $dump->nettoyage(); // 是否清空备份目录下的所有文件
        $_POST["bak_isdown"] ? $dump->isdown = 1 : $dump->isdown = 0; // 是否下载
        switch ($_POST["bak_filetype"]) {
            case "zip": $dump->compress_zip = 1; break; // 使用ZIP压缩格式
            case "gz": $dump->compress_gz = 1; break; // 使用GZIP压缩格式
        }
        $dump->backup($_POST["bak_filename"]);
        if ($dump->errr) feedback($dump->errr);
        elseif ($dump->isdown==0) feedback($clang["db_bak_successful"], "sqldump.php");
        else exit;
    }

    //-------------------------------------
    // 下载备份文件
    //-------------------------------------
    if ($_GET["action"]=="downbak") {
        $filepath = $dir_name.$_GET["file"];
        down_file($filepath) ? exit : feedback($clang["db_bak_file_inexistence"], "sqldump.php");
    }

    //-------------------------------------
    // 删除备份文件
    //-------------------------------------
    if ($_GET["action"]=="delbak")
        @unlink($dir_name.$_GET["file"]);

    //-------------------------------------
    // 列出所有备份文件(.gz/.zip/.sql格式文件)
    //-------------------------------------
    $dir = @opendir($dir_name);
    while ($file_name = @readdir($dir)) {
        $file = $dir_name . $file_name; // 取得绝对路径
        $ext_name = get_file_ext($file_name); // 取出扩展名
        if ( $ext_name == "gz" || $ext_name == "sql" || $ext_name == "zip") { // 是否备份文件格式
            $row_result[] = array(
            "filename" => $file_name,
            "filesize" => sprintf ("%01.2f", @filesize($file)/1024),
            "createdate" => date("Y-m-d H:i:s", @filemtime($file)),
            "downurl" => "?action=downbak&file=".urlencode($file_name),
            "delurl" => "?action=delbak&file=".urlencode($file_name)
            );
        }
    }
    @closedir($dir); // 关闭目录

    /* --- 输出HTML --- */
    $page_type = "数据库备份";
    show_page_head("list",$page_type);
    $tpl->assign("page_type", $page_type);
    $tpl->assign("bak_filename",$dbname."_".date("ymd_his_")."bak.sql");
    $tpl->assign("row_result",$row_result);
    $tpl->display("sqldump.htm");
    show_page_foot(); // 显示页面底部
?>