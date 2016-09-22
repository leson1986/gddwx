<?php
/***********************************************************
 * Document Type: Configure
 * Update: 2006/11/10
 * Author: Akon
 * Remark: վںļ
 ***********************************************************/

    function dexit($err_msg='') {
        echo '<div style="font:12px Tahoma;border:1px solid #333;padding:10px;background:#EEE;color:#000"><b>Error : </b>';
        echo '<span style="color:#c00">' . $err_msg . '</span></div>';
        exit;
    }

    if (!defined('__SITE_ROOT')) dexit ( 'Site configure undefined!' );

    @ini_set('register_globals', 'on');                                          // ر register_globals

    // -------------------------------------------------------
    // ϵͳ
    // -------------------------------------------------------
    define ( '__CORE_PATH'  , __SITE_ROOT . 'core/' );                           //  core Ŀ¼
    define ( '__LANG_PATH'  , __CORE_PATH . 'language/' );                       //  language Ŀ¼
    define ( '__CLASS_PATH' , __CORE_PATH . 'classes/' );                        //  class Ŀ¼
    define ( '__COMM_PATH'  , __CORE_PATH . 'common/');                          //  common Ŀ¼
    define ( '__SMARTY_PATH', __CORE_PATH . 'smarty/' );                         //  smarty Ŀ¼
    define ( '__MODULE_PATH', __CORE_PATH . 'module/' );                         //  module Ŀ¼
    define ( '__MASTER_PATH', __SITE_ROOT . 'webmaster/' );                      //  webmaster Ŀ¼
    define ( '__UPLOAD_PATH', __SITE_ROOT . 'uploads/upload_files/' );           // ļϴĿ¼
    define ( '__DATBAK_PATH', __SITE_ROOT . 'uploads/data_backup/' );            // ݿⱸĿ�?

    // -------------------------------------------------------
    // ʼ԰
    // -------------------------------------------------------
    $ln = $CFG['lang']['multi'] && in_array($_GET['ln'], $CFG['lang']['pack']) ? $_GET['ln'] : $CFG['lang']['default'];
    $lang_core = __LANG_PATH . "{$ln}.core.php";
    $lang_page = __LANG_PATH . "{$ln}.page.php";
    if (file_exists($lang_core)) {
        include ($lang_core);                                                    // ں԰
        include ($lang_page);                                                    // ҳ԰
    }
    else dexit ( 'Language package file inexistence!' );
    $ln_ext = $ln==$CFG['lang']['default'] ? "" : ".{$ln}";                      // ԰չ
    unset ($CFG['lang'], $lang_core, $lang_page);

    // -------------------------------------------------------
    // ʵ MySQL ݿ
    // -------------------------------------------------------
    require ( __CORE_PATH . 'db.conf.php' );                                     //  MYSQL ݿļ
    require ( __CLASS_PATH . 'db_mysql.class.php' );                             //  MYSQL DB װ
    $db = new dbstuff();                                                         // ʵ MYSQL DB
    $db->connect ( $dbhost, $dbuser, $dbpass, $dbname, $dbcharset, $pconnect );  // ӵMYSQLݿ

    // -------------------------------------------------------
    // ʵ Smarty 
    // -------------------------------------------------------
    require ( __SMARTY_PATH . "Smarty.class.php" );                              //  Smarty 
    $tpl = new Smarty();                                                         // ʵ Smarty
    $tpl->template_dir       = $CFG['tpl']['template_dir'];                      // ģĿ¼
    $tpl->compile_dir        = $CFG['tpl']['template_dir'] . 'templates_c/';     // ģĿ¼
    $tpl->cache_dir          = $CFG['tpl']['template_dir'] . 'cache/';           // ģ�建��Ŀ¼
    $tpl->left_delimiter     = '<{';                                             // ģ��ʼ
    $tpl->right_delimiter    = '}>';                                             // ģ����
    $tpl->caching            = $CFG['tpl']['caching'];                           // ģ�?
    $tpl->cache_lifetime     = $CFG['tpl']['cache_lifetime'];                    // ģؽʱ
    unset ($CFG['tpl']);

    // -------------------------------------------------------
    // ȡվ
    // -------------------------------------------------------
    $query = $db->query("select * from `{$tablepre}system` where `id`='1'");
    if (!$db->num_rows($query)) $db->query("insert into `{$tablepre}system` (`id`) values ('1')");
    $row = $db->fetch_array($query);
    $charset                = $row["char_set"];                                  // ҳַ, ѡ 'utf-8', 'gb2312', 'big5', 'iso-8859-1'
    $sitename               = $row["site_name"];                                 // վ
    $sitekeywords           = $row["site_keywords"];                                 // վ
    $sitedescription        = $row["site_description"];                                 // վ
    $sitecert               = $row["site_cert"];                                 // վ
    $siteurl                = $row["site_url"];                                  // վURLַ
    $siteopen               = $row["site_open"];                                 // վ�?
    $sitemail               = $row["site_mail"];                                 // Ա
    $upfilesize             = $row["upfile_size"] * 1024;                        // ϴļС,ֽڣKB
    $allowfiletype          = $row["allow_file_type"];                           // ϴļʽ
    $thumbwidth             = $row["product_thumb_width"];                       // Ʒͼ
    $thumbheight            = $row["product_thumb_height"];                      // Ʒͼ
    $maxpicwidth            = $row["product_image_width"];                       // Ʒͼ
    $maxpicheight           = $row["product_image_height"];                      // Ʒͼ
    $gbookopen              = $row["gbook_open"];                                // Ƿ񿪷Ա
    $gbookpagesize          = $row["gbook_page_size"];                           // ÿҳʾ
    $gbookposttime          = $row["gbook_post_time"];                           // Լʱ
    $gbookpostverify        = $row["gbook_post_verify"];                         // ǷҪ
    $gbookpostguest         = $row["gbook_post_guest"];                          // Ƿû
    $is_test_space          = $row["site_is_test_space"];                        // ǷλڲԿռ
    $test_space_name        = $row["site_test_space_name"];                      // ԿռĿ¼
    $webmaster_skin         = "default/";                                        // ԿռĿ¼
    unset ($query, $row);

    // -------------------------------------------------------
    // ҳ泣�?
    // -------------------------------------------------------
    $tpl->assign('lang',$ln);
    $tpl->assign('charset',$charset);
    $tpl->assign('sitename',$sitename);
    $tpl->assign('sitekeywords',$sitekeywords);
    $tpl->assign('sitedescription',$sitedescription);
    $tpl->assign('siteurl',$siteurl);
    $tpl->assign('sitecert',$sitecert);
    $tpl->assign('sitemail',$sitemail);
    $tpl->assign('thumbwidth',$thumbwidth);
    $tpl->assign('thumbheight',$thumbheight);
    $tpl->assign('webmaster_skin',$webmaster_skin);

    // -------------------------------------------------------
    // վر״̬ʱʾʾҳ
    // -------------------------------------------------------
    if (!$siteopen && __SITE_ROOT=="./") {
        header('Content-Type: text/html; charset=utf-8');
        $tpl->display('webbuild.htm');
        exit;
    }

    // -------------------------------------------------------
    // 빲�?
    // -------------------------------------------------------
    require ( __COMM_PATH . 'common.func.php' );

    if(function_exists(session_cache_limiter)) session_cache_limiter("public, must-revalidate");
	
