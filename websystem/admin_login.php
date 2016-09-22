<?php
    require_once ('init.inc.php');
    session_start();
    header("Expires: Mon, 26 Jul 1900 00:00:00 GMT");
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    setcookie('fck_upload','close');
    $Action = $_POST["action"];
    $AdminUser = filter_str($_POST["AdminUser"]);
    $AdminPwd = filter_str($_POST["AdminPwd"]);
    //$VerifyCode = filter_str($_POST["VerifyCode"]);
    if ($Action=="userlogin") {
        if ($AdminUser=="") {
            doJS("alert('{$clang[pls_username]}');location.href='admin_login.php';");
            exit;
        }
        elseif ($AdminPwd=="") {
            doJS("alert('{$clang[pls_password]}');location.href='admin_login.php';");
            exit;
        }
        //if (strcasecmp($VerifyCode, $_SESSION["VerifyCode"])) {
           // doJS("alert('{$clang[verifycode_err]}');location.href='admin_login.php';");
            //exit;
        //}
        else {
            $query = $db->query("select * from `{$tablepre}admin_user` where admin_user='$AdminUser' and admin_pwd='".md5(md5($AdminPwd))."'");
            if ($row = $db->fetch_array($query)) {
                if (!$row["admin_status"]) {
                    doJS("alert('{$clang[invalid_user]}');location.href='admin_login.php';");
                    exit;
                }
                $_SESSION["AdminLogin"] = true;
                $_SESSION["AdminUser"] = $AdminUser;
                $_SESSION["AdminLevel"] = $row["admin_level"];
                //session_unregister("VerifyCode");
                setcookie('fck_upload','open'); // 开启FCK上传权限;
                goto("index.php");
            }
            else {
                doJS("alert('{$clang[inexistent_user]}');location.href='admin_login.php';");
                exit;
            }
        }
    }
    elseif ($action=="logout") {
        session_destroy();
        goto("admin_login.php");
    }
    else {
        $tpl->display('admin_login.htm');
    }
?>
