<?php

    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php' );

    $root_path = __UPLOAD_PATH; // ָ��Ŀ¼(�ļ��ϴ�Ŀ¼)
    $dir_name = $root_path;

    if ($_GET["currpath"]!="") $dir_name = "$currpath"."/";
    if ($dir_name==$root_path) $currpath = "";

    //-------------------------------------
    // �����ļ�
    //-------------------------------------
    if ($_GET["action"]=="downfile") {
        $filepath = $dir_name.$_GET["file"];
        down_file($_GET["file"]) ? exit : feedback("��Ҫ���ص��ļ������ڣ������Ѿ���ɾ��!");
    }

    //-------------------------------------
    // �½�Ŀ¼
    //-------------------------------------
    if ($_GET["action"]=="newfolder" && $_GET["foldername"]!="") {
        if (file_exists($dir_name.$_GET["foldername"])) {
            feedback("Ŀ¼�Ѿ����ڣ�");
        }
        elseif (!@mkdir($dir_name.$_GET["foldername"],"7777")) {
            feedback("û���㹻��Ȩ�޴���Ŀ¼��");
        };
    }

    //-------------------------------------
    // ɾ��Ŀ¼
    //-------------------------------------
    if ($_GET["action"]=="delfolder") {
        if (!@rmdir($dir_name.$_GET["folder"])) {
            feedback("Ŀ¼�ǿգ�\\n��ɾ����Ŀ¼�µ������ļ�����ִ��ɾ����");
        }
    }

    //-------------------------------------
    // ɾ���ļ�
    //-------------------------------------
    if ($_GET["action"]=="delfile")
        @unlink($dir_name.$_GET["file"]);

    //-------------------------------------
    // �г������ļ�(*.all)
    //-------------------------------------
    $dir = @opendir($dir_name);
    if ($dir) {
        $free_space = sprintf("%01.2f",@disk_free_space(".")/1024/1024);
        $total_space = sprintf("%01.2f",@disk_total_space(".")/1024/1024);
        if ($currpath!="" && $dir_name!=$root_path) $to_upper_path = GetParentFolder($dir_name);
        while ($file_name = @readdir($dir)) {
            $file = $dir_name . $file_name;
            if ($file_name!="." && $file_name!="..") {
                if (is_dir($file)) {
                     $folder_result[] = array(
                        "fileicon" => "folder",
                        "filename" => $file_name,
                        "filelink" => "?currpath=".urlencode($file),
                        "filesize" => sprintf ("%01.2f", @filesize($file)/1024),
                        "createdate" => date("Y-m-d H:i:s", @filemtime($file)),
                        "downurl" => "?action=downbak&file=".urlencode($file),
                        "delurl" => "?action=delfolder&folder=".urlencode($file_name)."&currpath=".urlencode(dirname($file)),
                    );
                }
                else {
                    $file_result[] = array(
                        "fileicon" => getFileIcon(basename($file_name)),
                        "filename" => $file_name,
                        "filelink" => $file,
                        "filesize" => sprintf ("%01.2f", @filesize($file)/1024),
                        "createdate" => date("Y-m-d H:i:s", @filemtime($file)),
                        "downurl" => "?action=downfile&file=".urlencode($file),
                        "delurl" => "?action=delfile&file=".urlencode($file_name)."&currpath=".urlencode(dirname($file)),
                    );
                }
            }
        }
        @closedir($dir); // �ر�Ŀ¼
    }

    /* --- ���HTML --- */
    $page_type = "�ϴ��ļ�����";
    show_page_head("list",$page_type);
    $tpl->assign("page_type", $page_type);
    $tpl->assign("folder_result",$folder_result);
    $tpl->assign("file_result",$file_result);
    $tpl->assign("currpath",$currpath);
    $tpl->assign("dir_name",$dir_name);
    $tpl->assign("free_space",$free_space);
    $tpl->assign("total_space",$total_space);
    $tpl->assign("to_upper_path",$to_upper_path);
    $tpl->display("filemanage.htm");
    show_page_foot(); // ��ʾҳ��ײ�


function getFileIcon($file_name) {
    $ext_name = get_file_ext($file_name);
    switch ($ext_name) {
      case "jpg": $FileIcon = "jpg"; break;
      case "gif": $FileIcon = "gif"; break;
      case "bmp": $FileIcon = "bmp"; break;
      case "png": $FileIcon = "png"; break;
      case "zip":
      case "rar":
      case "gz":
      case "cab": $FileIcon = "zip"; break;
      case "swf": $FileIcon = "swf"; break;
      case "mdb": $FileIcon = "mdb"; break;
      case "doc": $FileIcon = "doc"; break;
      case "xls": $FileIcon = "xls"; break;
      case "ppt": $FileIcon = "ppt"; break;
      case "pdf": $FileIcon = "pdf"; break;
      case "mp3":
      case "m3u":
      case "wmv":
      case "wma": $FileIcon = "wma"; break;
      case "css": $FileIcon = "css"; break;
      case "xml": $FileIcon = "xml"; break;
      case "xsl": $FileIcon = "xsl"; break;
      case "txt": $FileIcon = "txt"; break;
      case "ini": $FileIcon = "ini"; break;
      case "dll":
      case "db":
      case "dat": $FileIcon = "dll"; break;
      case "sql": $FileIcon = "sql"; break;
      case "chm":
      case "hlp": $FileIcon = "chm"; break;
      case "iso":
      case "bin":
      case "nrg":
      case "bin": $FileIcon = "iso"; break;
      case "img": $FileIcon = "img"; break;
      case "ttf":
      case "ttc": $FileIcon = "font"; break;
      case "hdr": $FileIcon = "hdr"; break;
      case "cat": $FileIcon = "cat"; break;
      default: $FileIcon = "unknow";
    }
    return $FileIcon;
}