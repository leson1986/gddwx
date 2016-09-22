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
            $feedmsg = "��Ч��ͼƬ��ʽ�ļ�!";
        elseif (!IsValidFile($ext_name))
            $feedmsg = "��ֹ�ϴ���չ��Ϊ \'$ext_name\' ���ļ����������Ա��ϵ��";
        elseif($_FILES["upfile"]["size"]>$upfilesize)
            $feedmsg = "�ļ���С��������!";
        else {
            if(!is_dir($up_file_dir)){ //����ϴ�Ŀ¼�Ƿ���ڣ��������򴴽�
                if (!@mkdir($up_file_dir,0777)) $feedmsg = "Ȩ�޲����޷�����Ŀ¼: $up_file_dir,����ϵ����Ա��Ŀ¼����Ϊ��д!";
            }
            if (move_uploaded_file($_FILES["upfile"]["tmp_name"], $uploadfile)) {
               $upload_ok = true;
               $feedmsg = "�ļ��ϴ��ɹ�!";
               if (in_array($ext_name , array ('jpg', 'jpeg', 'bmp', 'png',))) {
                   $GDImage = new GDImage;
                   $load = $GDImage->loadFile($uploadfile);
                   if($load){
                       $GDImage->mkThumb($maxpicwidth, $maxpicheight);
                       $GDImage->build($uploadfile);
                       $feedmsg .= " ͼƬ�Զ����ųɹ�! \\n��: {$maxpicwidth} ����(px)\\n��: {$maxpicheight} ����(px)";
                   }
                   else $feedmsg .= " ͼƬ�Զ�����ʧ��!";
               }
               $uploadfile = str_replace( __SITE_ROOT, "/", $uploadfile);
            }
            else
               $feedmsg = "�ļ��ϴ�ʧ��!";
        }

        if ($is_test_space) $uploadfile = "/".$test_space_name.$uploadfile; // ���Ϊ���Կռ�������������趨�ļ�·��

        if (!empty($feedmsg)) alert($feedmsg);
        // ִ������JS����
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