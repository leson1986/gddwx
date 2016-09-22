<?php

    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __CLASS_PATH . 'gd_image.class.php');

    $action = $_REQUEST['action'];
    $fName = $_REQUEST['fName'];
    $cName = $_REQUEST['cName'];
    $IsImage = $_REQUEST['IsImage'] ? "True" : "False";

    if ($action=="upload") {

        $up_file_dir = __UPLOAD_PATH ."month_" .date("ym")."/";
        $ext_name = get_file_ext($_FILES["upfile"]["name"]);
        $uploadfile = $up_file_dir.date("mdhis").".".$ext_name;
        $upload_ok = false;

        if ($IsImage=="True" && !IsImgFile($ext_name))
            $feedmsg = "无效的图片格式文件!";
        elseif (!IsValidFile($ext_name))
            $feedmsg = "禁止上传扩展名为 \'$ext_name\' 的文件！请与管理员联系！";
        elseif($_FILES["upfile"]["size"]>$upfilesize)
            $feedmsg = "文件大小超出限制!";
        else {
            if(!is_dir($up_file_dir)){ //检查上传目录是否存在，不存在则创建
                if (!@mkdir($up_file_dir,0777)) $feedmsg = "权限不足无法创建目录: $up_file_dir,请联系管理员将目录设置为可写!";
            }
            if (move_uploaded_file($_FILES["upfile"]["tmp_name"], $uploadfile)) {
               $upload_ok = true;
               $feedmsg = "文件上传成功!";
               if (in_array($ext_name , array ('jpg', 'jpeg', 'bmp', 'png',))) {
                   $GDImage = new GDImage;
                   $load = $GDImage->loadFile($uploadfile);
                   if($load){
                       $GDImage->mkThumb($maxpicwidth, $maxpicheight);
                       $GDImage->build($uploadfile);
                       $feedmsg .= " 图片自动缩放成功! \\n宽: {$maxpicwidth} 像素(px)\\n高: {$maxpicheight} 像素(px)";
                   }
                   else $feedmsg .= " 图片自动缩放失败!";
               }
               $uploadfile = str_replace( __SITE_ROOT, "/", $uploadfile);
            }
            else
               $feedmsg = "文件上传失败!";
        }

        if ($is_test_space) $uploadfile = "/".$test_space_name.$uploadfile; // 如果为测试空间服务器，重新设定文件路径

        if (!empty($feedmsg)) alert($feedmsg);
        // 执行最后的JS代码
        if ($upload_ok) doJS("opener.document.$fName.$cName.value='$uploadfile';self.close()");
        else goto("uploadfile.php?fName=$fName&cName=$cName");
    }
    else {
        $tpl->assign("fName", $fName);
        $tpl->assign("cName", $cName);
        $tpl->assign("IsImage", $_REQUEST['IsImage']);
        $tpl->display('uploadfile.htm');
    }
?>