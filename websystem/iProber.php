<?php

    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );

/*
    +--------------------------------------------------------------------------
    |   iProber v0.022
    |   ========================================
    |   by Tahiti
    |   dEpoch Studio
    |   http://www.depoch.net
    |   ========================================
    |   Web: http://www.depoch.net
    |   Time: 20th August 2005
    |   Email: depoch@gmail.com
    +---------------------------------------------------------------------------
    |
    |   > PHP PROBER
    |   > Script written by Tahiti
    |   > Date started: 27th June 2004
    |
    +--------------------------------------------------------------------------

/* Functions in this file */
/**************************/

    // bar($percent)
    // find_command($commandName)
    // getcon($varName)
    // get_key($keyName)
    // isfun($funName)
    // sys_freebsd()
    // sys_linux()
    // test_float()
    // test_int()
    // test_io()
    // do_command($commandName, $args)

    header("content-Type: text/html; charset={$charset}");
    error_reporting(E_ERROR | E_WARNING | E_PARSE);
    ob_start();

    $valInt = (false == empty($_POST['pInt']))?$_POST['pInt']:"δ����";
    $valFloat = (false == empty($_POST['pFloat']))?$_POST['pFloat']:"δ����";
    $valIo = (false == empty($_POST['pIo']))?$_POST['pIo']:"δ����";
    $mysqlReShow = "none";
    $mailReShow = "none";
    $funReShow = "none";
    $opReShow = "none";
    $sysReShow = "none";

    define("YES", "<span class='resYes'>YES</span>");
    define("NO", "<span class='resNo'>NO</span>");
    define("ICON", "<span class='icon'>2</span>&nbsp;");
    $phpSelf = $_SERVER[PHP_SELF] ? $_SERVER[PHP_SELF] : $_SERVER[SCRIPT_NAME];
    define("PHPSELF", preg_replace("/(.{0,}?\/+)/", "", $phpSelf));

    if ($_GET['act'] == "phpinfo")
    {
        phpinfo();
        exit();
    }
    elseif($_POST['act'] == "TEST_1")
    {
        $valInt = test_int();
    }
    elseif($_POST['act'] == "TEST_2")
    {
        $valFloat = test_float();
    }
    elseif($_POST['act'] == "TEST_3")
    {
        $valIo = test_io();
    }
    elseif($_POST['act'] == "CONNECT")
    {
        $mysqlReShow = "show";
        $mysqlRe = "MYSQL���Ӳ��Խ����";
        $mysqlRe .= (false !== @mysql_connect($_POST['mysqlHost'], $_POST['mysqlUser'], $_POST['mysqlPassword']))?"MYSQL��������������, ":
        "MYSQL����������ʧ��, ";
        $mysqlRe .= "���ݿ� <b>".$_POST['mysqlDb']."</b> ";
        $mysqlRe .= (false != @mysql_select_db($_POST['mysqlDb']))?"��������":
        "����ʧ��";
    }
    elseif($_POST['act'] == "SENDMAIL")
    {
        $mailReShow = "show";
        $mailRe = "MAIL�ʼ����Ͳ��Խ��������";
        $mailRe .= (false !== @mail($_POST["mailReceiver"], "MAIL SERVER TEST", "This email is sent by iProber.\r\n\r\ndEpoch Studio\r\nhttp://depoch.net"))?"���":"ʧ��";
    }
    elseif($_POST['act'] == "FUNCTION_CHECK")
    {
        $funReShow = "show";
        $funRe = "���� <b>".$_POST['funName']."</b> ֧��״���������".isfun($_POST['funName']);
    }
    elseif($_POST['act'] == "CONFIGURATION_CHECK")
    {
        $opReShow = "show";
        $opRe = "���ò��� <b>".$_POST['opName']."</b> �������".getcon($_POST['opName']);
    }


    // ϵͳ����


    switch (PHP_OS)
    {
        case "Linux":
        $sysReShow = (false !== ($sysInfo = sys_linux()))?"show":
        "none";
        break;
        case "FreeBSD":
        $sysReShow = (false !== ($sysInfo = sys_freebsd()))?"show":
        "none";
        break;
        default:
        break;
    }

/*========================================================================*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<? echo $charset?>" />
<title>PHP̽�� iProber V0.022</title>
<meta name="keywords" content="php̽��,̽�����,php̽�����,̽��,iProber,dEpoch Studio" />
<style type="text/css">
<!--
/*******************************GENERAL**********************************/
body,div,p,ul,form,h1 { margin:0px; padding:0px;}
div,a,input { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #666666; }
div { margin-left:auto; margin-right:auto; }
li { list-style-type:none; }
input { border: 1px solid #999999; background:#f5f5f5; }
a { text-decoration:none; color:#5599ff; }
a.arrow { font-family:Webdings, sans-serif; font-size:10px; }
a.arrow:hover { color:#ff0000; }
.resYes { font-size: 9px; font-weight: bold; color: #33CC00; }
.resNo { font-size: 9px; font-weight: bold; color: #FF0000; }
.myButton { font-size:10px; font-weight:bold;  background:#CCFFFF; }
.bar { border:1px solid #999999; height:8px; font-size:2px; }
.bar li {  background:#ccffff; height:8px; font-size:2px;}
.jump { height:20px; width:15px; float:right; line-height:10px; text-align:right; }
/****************************HEADER**************************************/
#top { width:720px; }
#top h1 { color:#7fc643; font-size:35px; width:300px; float:left; }
#top h1 b { color:#ffb300; font-size:50px; font-family: Webdings, sans-serif; font-weight:normal; }
#top h1 span { font-size:10px; padding-left:10px; color:#999999; }
#t1 { float:right; text-align:right; padding:15px 0px 30px 0px; }
#t1 a { color:#999999; line-height:18px; }

#t2 { border:1px solid #CCCCCC; border-bottom:none;  padding:2px; clear:both; height:30px; }
#t2 ul { background-color:#2359B1; height:30px; }
#t2 li {  padding:5px 0px; height:20px; line-height:20px; }
#t2 a { color:#FFFFFF; }
#t2 a:hover { color:#81B0FF; }
#t21 { float:left; }
#t21 a { padding:10px; border-right:1px solid #FFFFFF; }
#t22 { float:right; }

#t3 { border:1px solid #cccccc; border-top:3px solid #BFC1C0; }
#t3 p { border-top:1px solid #FFFFFF; height:22px; line-height:22px; padding-left:5px; background:#F5F5F5;  }
#t3 b { font-size:10px; color:#cc3300; }
#t3 a { color:#666666; }
#t3 a:hover { text-decoration:underline; }
/*****************************MAIN****************************************/
#main { width:720px; }
#main th { text-align:left; padding:5px 0px; }
#main table { clear:both;}
fieldset { border:3px double #9FACB7; margin-top:15px; padding:10px; }
legend { background:#5599ff;    color:#FFFFFF; padding:5px 10px; }
fieldset td { border-bottom:1px dotted #dedede; padding:5px 0px; }

#m4 { background-color:#efefef; }
#m4 th,#m4 td { background:#ffffff; padding:3px; border-bottom:none; text-align:center; }
#m4 th { font-weight:normal; color:#444444; }
/****************************FOOTER***************************************/
#footer { width:720px; }
#footer td { text-align:center; padding:1px 3px; font-size:10px; }
#footer a { font-size:10px; }
#f1 { text-align:right; padding:15px; }

#f2 {float:left; border:1px solid #dddddd; }
#f2 td { background:#FF9900; }
#f2 a { color:#ffffff; }

#f3 { border: 1px solid #888888; float:right; }
#f3 a { color:#222222; }
#f31 { background:#2359B1; color:#FFFFFF; }
#f32 { background:#dddddd; }
-->
</style>
</head>
<body>
<form method="post" action="<?=PHPSELF."#bottom"?>"  id="main_form">
  <div id="main">
<!-- =============================================================
����������
============================================================= -->
        <fieldset>
        <legend>����������<a name="sec1" id="sec1"></a></legend>
        <p class="jump"><a href="#top" class="arrow">5</a><br />
            <a href="#bottom" class="arrow">6</a></p>
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <?if("show"==$sysReShow){?>
            <tr>
                <td>������������ CPU</td>
                <td>CPU������
                    <?=$sysInfo['cpu']['num']?>
                    <br />
                    <?=$sysInfo['cpu']['detail']?></td>
            </tr>
            <?}?>
            <tr>
                <td>������ʱ��</td>
                <td><?=date("Y��n��j�� H:i:s")?>
&nbsp;����ʱ�䣺
                    <?=gmdate("Y��n��j�� H:i:s",time()+8*3600)?></td>
            </tr>
            <?if("show"==$sysReShow){?>
            <tr>
                <td>����������ʱ��</td>
                <td><?=$sysInfo['uptime']?></td>
            </tr>
            <?}?>
            <tr>
                <td>����������/IP��ַ</td>
                <td><?=$_SERVER['SERVER_NAME']?>
                    (
                    <?=@gethostbyname($_SERVER['SERVER_NAME'])?>
                    )</td>
            </tr>
            <tr>
                <td>����������ϵͳ
                    <?$os = explode(" ", php_uname());?></td>
                <td><?=$os[0];?>
&nbsp;�ں˰汾��
                    <?=$os[2]?></td>
            </tr>
            <tr>
                <td>��������</td>
                <td><?=$os[1];?></td>
            </tr>
            <tr>
                <td>��������������</td>
                <td><?=$_SERVER['SERVER_SOFTWARE']?></td>
            </tr>
            <tr>
                <td>Web����˿�</td>
                <td><?=$_SERVER['SERVER_PORT']?></td>
            </tr>
            <tr>
                <td>����������Ա</td>
                <td><a href="mailto:<?=$_SERVER['SERVER_ADMIN']?>">
                    <?=$_SERVER['SERVER_ADMIN']?>
                    </a></td>
            </tr>
            <tr>
                <td>���ļ�·��</td>
                <td><?=$_SERVER['PATH_TRANSLATED']?></td>
            </tr>
            <tr>
                <td>Ŀǰ���п���ռ�&nbsp;diskfreespace</td>
                <td><?=round((@disk_free_space(".")/(1024*1024)),2)?>
                    M</td>
            </tr>
            <?if("show"==$sysReShow){?>
            <tr>
                <td>�ڴ�ʹ��״��</td>
                <td> �����ڴ棺��
                    <?=$sysInfo['memTotal']?>M, ��ʹ��
                    <?=$sysInfo['memUsed']?>M, ����
                    <?=$sysInfo['memFree']?>M, ʹ����
                    <?=$sysInfo['memPercent']?>%
                    <?=bar($sysInfo['memPercent'])?>
                    SWAP������
                    <?=$sysInfo['swapTotal']?>M, ��ʹ��
                    <?=$sysInfo['swapUsed']?>M, ����
                    <?=$sysInfo['swapFree']?>M, ʹ����
                    <?=$sysInfo['swapPercent']?>%
                    <?=bar($sysInfo['swapPercent'])?>
                </td>
            </tr>
            <tr>
                <td>ϵͳƽ������</td>
                <td><?=$sysInfo['loadAvg']?></td>
            </tr>
            <?}?>
        </table>
        </fieldset>
<!-- =============================================================
PHP��������
============================================================== -->
        <fieldset>
        <legend>PHP��������<a name="sec2" id="sec2"></a></legend>
        <p class="jump"><a href="#top" class="arrow">5</a><br />
            <a href="#bottom" class="arrow">6</a></p>
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td width="49%">PHP���з�ʽ</td>
                <td width="51%"><?=strtoupper(php_sapi_name())?></td>
            </tr>
            <tr>
                <td>PHP�汾</td>
                <td><?=PHP_VERSION?></td>
            </tr>
            <tr>
                <td>�����ڰ�ȫģʽ</td>
                <td><?=getcon("safe_mode")?></td>
            </tr>
            <tr>
                <td>����ʹ��URL���ļ�&nbsp;allow_url_fopen</td>
                <td><?=getcon("allow_url_fopen")?></td>
            </tr>
            <tr>
                <td>����̬�������ӿ�&nbsp;enable_dl</td>
                <td><?=getcon("enable_dl")?></td>
            </tr>
            <tr>
                <td>��ʾ������Ϣ&nbsp;display_errors</td>
                <td><?=getcon("display_errors")?></td>
            </tr>
            <tr>
                <td>�Զ�����ȫ�ֱ���&nbsp;register_globals</td>
                <td><?=getcon("register_global")?></td>
            </tr>
            <tr>
                <td>�����������ʹ���ڴ���&nbsp;memory_limit</td>
                <td><?=getcon("memory_limit")?></td>
            </tr>
            <tr>
                <td>POST����ֽ���&nbsp;post_max_size</td>
                <td><?=getcon("post_max_size")?></td>
            </tr>
            <tr>
                <td>��������ϴ��ļ�&nbsp;upload_max_filesize</td>
                <td><?=getcon("upload_max_filesize")?></td>
            </tr>
            <tr>
                <td>���������ʱ��&nbsp;max_execution_time</td>
                <td><?=getcon("max_execution_time")?>
                    ��</td>
            </tr>
            <tr>
                <td>magic_quotes_gpc</td>
                <td><?=(1===get_magic_quotes_gpc())?YES:NO?></td>
            </tr>
            <tr>
                <td>magic_quotes_runtime</td>
                <td><?=(1===get_magic_quotes_runtime())?YES:NO?></td>
            </tr>
            <tr>
                <td>�����õĺ���&nbsp;disable_functions</td>
                <td><?=(""==($disFuns=get_cfg_var("disable_functions")))?"��":str_replace(",","<br />",$disFuns)?></td>
            </tr>
            <tr>
                <td>PHP��Ϣ&nbsp;PHPINFO</td>
                <td><?=(false!==eregi("phpinfo",$disFuns))?NO:"<a href='$phpSelf?act=phpinfo' target='_blank' class='static'>PHPINFO</a>"?></td>
            </tr>
        </table>
        </fieldset>
<!-- =============================================================
PHP���֧��
============================================================== -->
        <fieldset>
        <legend>PHP���֧��<a name="sec3" id="sec3"></a></legend>
        <p class="jump"><a href="#top" class="arrow">5</a><br />
            <a href="#bottom" class="arrow">6</a></p>
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td width="38%">ƴд��� ASpell Library</td>
                <td width="12%"><?=isfun("aspell_check_raw")?></td>
                <td width="38%">�߾�����ѧ���� BCMath</td>
                <td width="12%"><?=isfun("bcadd")?></td>
            </tr>
            <tr>
                <td>�������� Calendar</td>
                <td><?=isfun("cal_days_in_month")?></td>
                <td>DBA���ݿ�</td>
                <td><?=isfun("dba_close")?></td>
            </tr>
            <tr>
                <td>dBase���ݿ�</td>
                <td><?=isfun("dbase_close")?></td>
                <td>DBM���ݿ�</td>
                <td><?=isfun("dbmclose")?></td>
            </tr>
            <tr>
                <td>FDF�����ϸ�ʽ</td>
                <td><?=isfun("fdf_get_ap")?></td>
                <td>FilePro���ݿ�</td>
                <td><?=isfun("filepro_fieldcount")?></td>
            </tr>
            <tr>
                <td>Hyperwave���ݿ�</td>
                <td><?=isfun("hw_close")?></td>
                <td>ͼ�δ��� GD Library</td>
                <td><?=isfun("gd_info")?></td>
            </tr>
            <tr>
                <td>IMAP�����ʼ�ϵͳ</td>
                <td><?=isfun("imap_close")?></td>
                <td>Informix���ݿ�</td>
                <td><?=isfun("ifx_close")?></td>
            </tr>
            <tr>
                <td>LDAPĿ¼Э��</td>
                <td><?=isfun("ldap_close")?></td>
                <td>MCrypt���ܴ���</td>
                <td><?=isfun("mcrypt_cbc")?></td>
            </tr>
            <tr>
                <td>��ϡ���� MHash</td>
                <td><?=isfun("mhash_count")?></td>
                <td>mSQL���ݿ�</td>
                <td><?=isfun("msql_close")?></td>
            </tr>
            <tr>
                <td>SQL Server���ݿ�</td>
                <td><?=isfun("mssql_close")?></td>
                <td>MySQL���ݿ�</td>
                <td><?=isfun("mysql_close")?></td>
            </tr>
            <tr>
                <td>SyBase���ݿ�</td>
                <td><?=isfun("sybase_close")?></td>
                <td>Yellow Pageϵͳ</td>
                <td><?=isfun("yp_match")?></td>
            </tr>
            <tr>
                <td>Oracle���ݿ�</td>
                <td><?=isfun("ora_close")?></td>
                <td>Oracle 8 ���ݿ�</td>
                <td><?=isfun("OCILogOff")?></td>
            </tr>
            <tr>
                <td>PREL�����﷨ PCRE</td>
                <td><?=isfun("preg_match")?></td>
                <td>PDF�ĵ�֧��</td>
                <td><?=isfun("pdf_close")?></td>
            </tr>
            <tr>
                <td>Postgre SQL���ݿ�</td>
                <td><?=isfun("pg_close")?></td>
                <td>SNMP�������Э��</td>
                <td><?=isfun("snmpget")?></td>
            </tr>
            <tr>
                <td>VMailMgr�ʼ�����</td>
                <td><?=isfun("vm_adduser")?></td>
                <td>WDDX֧��</td>
                <td><?=isfun("wddx_add_vars")?></td>
            </tr>
            <tr>
                <td>ѹ���ļ�֧��(Zlib)</td>
                <td><?=isfun("gzclose")?></td>
                <td>XML����</td>
                <td><?=isfun("xml_set_object")?></td>
            </tr>
            <tr>
                <td>FTP</td>
                <td><?=isfun("ftp_login")?></td>
                <td>ODBC���ݿ�����</td>
                <td><?=isfun("odbc_close")?></td>
            </tr>
            <tr>
                <td>Session֧��</td>
                <td><?=isfun("session_start")?></td>
                <td>Socket֧��</td>
                <td><?=isfun("socket_accept")?></td>
            </tr>
        </table>
        </fieldset>
<!-- =============================================================
���������ܼ��
============================================================== -->
        <fieldset>
        <legend>���������ܼ��<a name="sec4" id="sec4"></a></legend>
        <p class="jump"><a href="#top" class="arrow">5</a><br />
            <a href="#bottom" class="arrow">6</a></p>
        <table width="100%" cellpadding="0" cellspacing="1" border="0" id="m4">
            <tr>
                <th>������</th>
                <th>����������������<br />
                    (1+1����300���)</th>
                <th>����������������<br />
                    (��ƽ��300���)</th>
                <th>����I/O��������<br />
                    (��ȡ10K�ļ�10000��)</th>
            </tr>
            <tr>
                <td>Tahiti �ĵ���(P4 1.7G 256M WinXP)</td>
                <td> 1.421��</td>
                <td> 1.358��</td>
                <td> 0.177��</td>
            </tr>
            <tr>
                <td>PIPNI��ѿռ�(2004/06/28 02:08)</td>
                <td> 2.545��</td>
                <td> 2.545��</td>
                <td>0.171�� </td>
            </tr>
            <tr>
                <td>�񻰿Ƽ���CGI��(2004/06/28 02:03)</td>
                <td> 0.797��</td>
                <td> 0.729��</td>
                <td>0.156��</td>
            </tr>
            <tr>
                <td>������ʹ�õ���̨������</td>
                <td><b>
                    <?=$valInt?>
                    </b><br />
                    <input type="submit" value="TEST_1" class="myButton"  name="act" /></td>
                <td><b>
                    <?=$valFloat?>
                    </b><br />
                    <input type="submit" value="TEST_2" class="myButton"  name="act" /></td>
                <td><b>
                    <?=$valIo?>
                    </b><br />
                    <input type="submit" value="TEST_3" class="myButton"  name="act" /></td>
            </tr>
        </table>
        </fieldset>
<!-- =============================================================
�Զ�����
============================================================== -->
        <?php
    $isMysql = (false !== function_exists("mysql_query"))?"":" disabled";
    $isMail = (false !== function_exists("mail"))?"":" disabled";
?>
        <fieldset>
        <legend>�Զ�����<a name="sec5" id="sec5"></a></legend>
        <p class="jump"><a href="#top" class="arrow">5</a><br />
            <a href="#bottom" class="arrow">6</a></p>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <th colspan="4">MYSQL���Ӳ���</th>
            </tr>
            <tr>
                <td>MYSQL������</td>
                <td><input type="text" name="mysqlHost" value="localhost" <?=$isMysql?> /></td>
                <td> MYSQL�û��� </td>
                <td><input type="text" name="mysqlUser" <?=$isMysql?> /></td>
            </tr>
            <tr>
                <td> MYSQL�û����� </td>
                <td><input type="text" name="mysqlPassword" <?=$isMysql?> /></td>
                <td> MYSQL���ݿ����� </td>
                <td><input type="text" name="mysqlDb" />
&nbsp;<input type="submit" class="myButton" value="CONNECT" <?=$isMysql?>  name="act" /></td>
            </tr>
            <?php if("show"==$mysqlReShow){?>
            <tr>
                <td colspan="4"><?=$mysqlRe?></td>
            </tr>
            <?}?>
            <tr>
                <th colspan="4">MAIL�ʼ����Ͳ���</th>
            </tr>
            <tr>
                <td>���ŵ�ַ</td>
                <td colspan="3"><input type="text" name="mailReceiver" size="50" <?=$isMail?> />
&nbsp;<input type="submit" class="myButton" value="SENDMAIL" <?=$isMail?>  name="act" /></td>
            </tr>
            <?php if("show"==$mailReShow){?>
            <tr>
                <td colspan="4"><?=$mailRe?></td>
            </tr>
            <?}?>
            <tr>
                <th colspan="4">����֧��״��</th>
            </tr>
            <tr>
                <td>��������</td>
                <td colspan="3"><input type="text" name="funName" size="50" />
&nbsp;<input type="submit" class="myButton" value="FUNCTION_CHECK" name="act" /></td>
                <?php if("show"==$funReShow){?>
            <tr>
                <td colspan="4"><?=$funRe?></td>
            </tr>
            <?}?>
            </tr>

            <tr>
                <th colspan="4">PHP���ò���״��</th>
            </tr>
            <tr>
                <td>��������</td>
                <td colspan="3"><input type="text" name="opName" size="40" />
&nbsp;<input type="submit" class="myButton" value="CONFIGURATION_CHECK" name="act" /></td>
            </tr>
            <?php if("show"==$opReShow){?>
            <tr>
                <td colspan="4"><?=$opRe?></td>
            </tr>
            <?}?>
        </table>
        </fieldset>
    </div><br/>
    <input type="hidden" name="pInt" value="<?=$valInt?>" />
    <input type="hidden" name="pFloat" value="<?=$valFloat?>" />
    <input type="hidden" name="pIo" value="<?=$valIo?>" />
</form>
</body>
</html>
<?php
/*=============================================================
    ������
=============================================================*/
/*=============================================================
    ��⺯��֧��
=============================================================*/
    function isfun($funName)
    {
        return (false !== function_exists($funName))?YES:NO;
    }
/*=============================================================
    ���PHP���ò���
=============================================================*/
    function getcon($varName)
    {
        switch($res = get_cfg_var($varName))
        {
            case 0:
            return NO;
            break;
            case 1:
            return YES;
            break;
            default:
            return $res;
            break;
        }

    }
/*=============================================================
    ����������������
=============================================================*/
    function test_int()
    {
        $timeStart = gettimeofday();
        for($i = 0; $i < 3000000; $i++);
        {
            $t = 1+1;
        }
        $timeEnd = gettimeofday();
        $time = ($timeEnd["usec"]-$timeStart["usec"])/1000000+$timeEnd["sec"]-$timeStart["sec"];
        $time = round($time, 3)."��";
        return $time;
    }
/*=============================================================
    ����������������
=============================================================*/
    function test_float()
    {
        $t = pi();
        $timeStart = gettimeofday();
        for($i = 0; $i < 3000000; $i++);
        {
            sqrt($t);
        }
        $timeEnd = gettimeofday();
        $time = ($timeEnd["usec"]-$timeStart["usec"])/1000000+$timeEnd["sec"]-$timeStart["sec"];
        $time = round($time, 3)."��";
        return $time;
    }
/*=============================================================
    ����IO��������
=============================================================*/
    function test_io()
    {
        $fp = fopen(PHPSELF, "r");
        $timeStart = gettimeofday();
        for($i = 0; $i < 10000; $i++)
        {
            fread($fp, 10240);
            rewind($fp);
        }
        $timeEnd = gettimeofday();
        fclose($fp);
        $time = ($timeEnd["usec"]-$timeStart["usec"])/1000000+$timeEnd["sec"]-$timeStart["sec"];
        $time = round($time, 3)."��";
        return($time);
    }
/*=============================================================
    ������
=============================================================*/
    function bar($percent)
    {
    ?>
<ul class="bar">
    <li style="width:<?=$percent?>%">&nbsp;</li>
</ul>
<?php
    }
/*=============================================================
    ϵͳ����̽�� LINUX
=============================================================*/
    function sys_linux()
    {
        // CPU
        if (false === ($str = @file("/proc/cpuinfo"))) return false;
        $str = implode("", $str);
        @preg_match_all("/model\s+name\s{0,}\:+\s{0,}([\w\s\)\(.]+)[\r\n]+/", $str, $model);
        //@preg_match_all("/cpu\s+MHz\s{0,}\:+\s{0,}([\d\.]+)[\r\n]+/", $str, $mhz);
        @preg_match_all("/cache\s+size\s{0,}\:+\s{0,}([\d\.]+\s{0,}[A-Z]+[\r\n]+)/", $str, $cache);
        if (false !== is_array($model[1]))
            {
            $res['cpu']['num'] = sizeof($model[1]);
            for($i = 0; $i < $res['cpu']['num']; $i++)
            {
                $res['cpu']['detail'][] = "���ͣ�".$model[1][$i]." ���棺".$cache[1][$i];
            }
            if (false !== is_array($res['cpu']['detail'])) $res['cpu']['detail'] = implode("<br />", $res['cpu']['detail']);
            }


        // UPTIME
        if (false === ($str = @file("/proc/uptime"))) return false;
        $str = explode(" ", implode("", $str));
        $str = trim($str[0]);
        $min = $str / 60;
        $hours = $min / 60;
        $days = floor($hours / 24);
        $hours = floor($hours - ($days * 24));
        $min = floor($min - ($days * 60 * 24) - ($hours * 60));
        if ($days !== 0) $res['uptime'] = $days."��";
        if ($hours !== 0) $res['uptime'] .= $hours."Сʱ";
        $res['uptime'] .= $min."����";

        // MEMORY
        if (false === ($str = @file("/proc/meminfo"))) return false;
        $str = implode("", $str);
        preg_match_all("/MemTotal\s{0,}\:+\s{0,}([\d\.]+).+?MemFree\s{0,}\:+\s{0,}([\d\.]+).+?SwapTotal\s{0,}\:+\s{0,}([\d\.]+).+?SwapFree\s{0,}\:+\s{0,}([\d\.]+)/s", $str, $buf);

        $res['memTotal'] = round($buf[1][0]/1024, 2);
        $res['memFree'] = round($buf[2][0]/1024, 2);
        $res['memUsed'] = ($res['memTotal']-$res['memFree']);
        $res['memPercent'] = (floatval($res['memTotal'])!=0)?round(($res['memUsed']/$res['memTotal'])*90,2):0;

        $res['swapTotal'] = round($buf[3][0]/1024, 2);
        $res['swapFree'] = round($buf[4][0]/1024, 2);
        $res['swapUsed'] = ($res['swapTotal']-$res['swapFree']);
        $res['swapPercent'] = (floatval($res['swapTotal'])!=0)?round(($res['swapUsed']/$res['swapTotal'])*90,2):0;

        // LOAD AVG
        if (false === ($str = @file("/proc/loadavg"))) return false;
        $str = explode(" ", implode("", $str));
        $str = array_chunk($str, 3);
        $res['loadAvg'] = implode(" ", $str[0]);

        return $res;
    }
/*=============================================================
    ϵͳ����̽�� FreeBSD
=============================================================*/
    function sys_freebsd()
    {
        //CPU
        if (false === ($res['cpu']['num'] = get_key("hw.ncpu"))) return false;
        $res['cpu']['detail'] = get_key("hw.model");

        //LOAD AVG
        if (false === ($res['loadAvg'] = get_key("vm.loadavg"))) return false;
        $res['loadAvg'] = str_replace("{", "", $res['loadAvg']);
        $res['loadAvg'] = str_replace("}", "", $res['loadAvg']);

        //UPTIME
        if (false === ($buf = get_key("kern.boottime"))) return false;
        $buf = explode(' ', $buf);
        $sys_ticks = time() - intval($buf[3]);
        $min = $sys_ticks / 60;
        $hours = $min / 60;
        $days = floor($hours / 24);
        $hours = floor($hours - ($days * 24));
        $min = floor($min - ($days * 60 * 24) - ($hours * 60));
        if ($days !== 0) $res['uptime'] = $days."��";
        if ($hours !== 0) $res['uptime'] .= $hours."Сʱ";
        $res['uptime'] .= $min."����";

        //MEMORY
        if (false === ($buf = get_key("hw.physmem"))) return false;
        $res['memTotal'] = round($buf/1024/1024, 2);
        $buf = explode("\n", do_command("vmstat", ""));
        $buf = explode(" ", trim($buf[2]));

        $res['memFree'] = round($buf[5]/1024, 2);
        $res['memUsed'] = ($res['memTotal']-$res['memFree']);
        $res['memPercent'] = (floatval($res['memTotal'])!=0)?round(($res['memUsed']/$res['memTotal'])*90,2):0;

        $buf = explode("\n", do_command("swapinfo", "-k"));
        $buf = $buf[1];
        preg_match_all("/([0-9]+)\s+([0-9]+)\s+([0-9]+)/", $buf, $bufArr);
        $res['swapTotal'] = round($bufArr[1][0]/1024, 2);
        $res['swapUsed'] = round($bufArr[2][0]/1024, 2);
        $res['swapFree'] = round($bufArr[3][0]/1024, 2);
        $res['swapPercent'] = (floatval($res['swapTotal'])!=0)?round(($res['swapUsed']/$res['swapTotal'])*90,2):0;

        return $res;
    }

/*=============================================================
    ȡ�ò���ֵ FreeBSD
=============================================================*/
    function get_key($keyName)
    {
        return do_command('sysctl', "-n $keyName");
    }

/*=============================================================
    ȷ��ִ���ļ�λ�� FreeBSD
=============================================================*/
    function find_command($commandName)
    {
        $path = array('/bin', '/sbin', '/usr/bin', '/usr/sbin', '/usr/local/bin', '/usr/local/sbin');
        foreach($path as $p)
        {
            if (@is_executable("$p/$commandName")) return "$p/$commandName";
        }
        return false;
    }

/*=============================================================
    ִ��ϵͳ���� FreeBSD
=============================================================*/
    function do_command($commandName, $args)
    {
        $buffer = "";
        if (false === ($command = find_command($commandName))) return false;
        if ($fp = @popen("$command $args", 'r'))
            {
                while (!@feof($fp))
                {
                    $buffer .= @fgets($fp, 4096);
                }
                return trim($buffer);
            }
        return false;
    }
?>
