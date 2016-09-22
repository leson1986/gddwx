<?php
/***********************************************************
 * Document Type: Configure
 * Update: 2006/11/10
 * Author: Akon
 * Remark: 站诤募
 ***********************************************************/

    function dexit($err_msg='') {
        echo '<div style="font:12px Tahoma;border:1px solid #333;padding:10px;background:#EEE;color:#000"><b>Error : </b>';
        echo '<span style="color:#c00">' . $err_msg . '</span></div>';
        exit;
    }

    if (!defined('__SITE_ROOT')) dexit ( 'Site configure undefined!' );

    @ini_set('register_globals', 'on');                                          // 乇 register_globals

    // -------------------------------------------------------
    // 系统
    // -------------------------------------------------------
    define ( '__CORE_PATH'  , __SITE_ROOT . 'core/' );                           //  core 目录
    define ( '__LANG_PATH'  , __CORE_PATH . 'language/' );                       //  language 目录
    define ( '__CLASS_PATH' , __CORE_PATH . 'classes/' );                        //  class 目录
    define ( '__COMM_PATH'  , __CORE_PATH . 'common/');                          //  common 目录
    define ( '__SMARTY_PATH', __CORE_PATH . 'smarty/' );                         //  smarty 目录
    define ( '__MODULE_PATH', __CORE_PATH . 'module/' );                         //  module 目录
    define ( '__MASTER_PATH', __SITE_ROOT . 'webmaster/' );                      //  webmaster 目录
    define ( '__UPLOAD_PATH', __SITE_ROOT . 'uploads/upload_files/' );           // 募洗目录
    define ( '__DATBAK_PATH', __SITE_ROOT . 'uploads/data_backup/' );            // 菘獗改柯?

    // -------------------------------------------------------
    // 始园
    // -------------------------------------------------------
    $ln = $CFG['lang']['multi'] && in_array($_GET['ln'], $CFG['lang']['pack']) ? $_GET['ln'] : $CFG['lang']['default'];
    $lang_core = __LANG_PATH . "{$ln}.core.php";
    $lang_page = __LANG_PATH . "{$ln}.page.php";
    if (file_exists($lang_core)) {
        include ($lang_core);                                                    // 诤园
        include ($lang_page);                                                    // 页园
    }
    else dexit ( 'Language package file inexistence!' );
    $ln_ext = $ln==$CFG['lang']['default'] ? "" : ".{$ln}";                      // 园展
    unset ($CFG['lang'], $lang_core, $lang_page);

    // -------------------------------------------------------
    // 实 MySQL 菘
    // -------------------------------------------------------
    require ( __CORE_PATH . 'db.conf.php' );                                     //  MYSQL 菘募
    require ( __CLASS_PATH . 'db_mysql.class.php' );                             //  MYSQL DB 装
    $db = new dbstuff();                                                         // 实 MYSQL DB
    $db->connect ( $dbhost, $dbuser, $dbpass, $dbname, $dbcharset, $pconnect );  // 拥MYSQL菘

    // -------------------------------------------------------
    // 实 Smarty 
    // -------------------------------------------------------
    require ( __SMARTY_PATH . "Smarty.class.php" );                              //  Smarty 
    $tpl = new Smarty();                                                         // 实 Smarty
    $tpl->template_dir       = $CFG['tpl']['template_dir'];                      // 模目录
    $tpl->compile_dir        = $CFG['tpl']['template_dir'] . 'templates_c/';     // 模目录
    $tpl->cache_dir          = $CFG['tpl']['template_dir'] . 'cache/';           // 模板缓存目录
    $tpl->left_delimiter     = '<{';                                             // 模开始
    $tpl->right_delimiter    = '}>';                                             // 模结束
    $tpl->caching            = $CFG['tpl']['caching'];                           // 模寤?
    $tpl->cache_lifetime     = $CFG['tpl']['cache_lifetime'];                    // 模亟时
    unset ($CFG['tpl']);

    // -------------------------------------------------------
    // 取站
    // -------------------------------------------------------
    $query = $db->query("select * from `{$tablepre}system` where `id`='1'");
    if (!$db->num_rows($query)) $db->query("insert into `{$tablepre}system` (`id`) values ('1')");
    $row = $db->fetch_array($query);
    $charset                = $row["char_set"];                                  // 页址, 选 'utf-8', 'gb2312', 'big5', 'iso-8859-1'
    $sitename               = $row["site_name"];                                 // 站
    $sitekeywords           = $row["site_keywords"];                                 // 站
    $sitedescription        = $row["site_description"];                                 // 站
    $sitecert               = $row["site_cert"];                                 // 站
    $siteurl                = $row["site_url"];                                  // 站URL址
    $siteopen               = $row["site_open"];                                 // 站饪?
    $sitemail               = $row["site_mail"];                                 // 员
    $upfilesize             = $row["upfile_size"] * 1024;                        // 洗募小,纸冢KB
    $allowfiletype          = $row["allow_file_type"];                           // 洗募式
    $thumbwidth             = $row["product_thumb_width"];                       // 品图
    $thumbheight            = $row["product_thumb_height"];                      // 品图
    $maxpicwidth            = $row["product_image_width"];                       // 品图
    $maxpicheight           = $row["product_image_height"];                      // 品图
    $gbookopen              = $row["gbook_open"];                                // 欠窨员
    $gbookpagesize          = $row["gbook_page_size"];                           // 每页示
    $gbookposttime          = $row["gbook_post_time"];                           // 约时
    $gbookpostverify        = $row["gbook_post_verify"];                         // 欠要
    $gbookpostguest         = $row["gbook_post_guest"];                          // 欠没
    $is_test_space          = $row["site_is_test_space"];                        // 欠位诓钥占
    $test_space_name        = $row["site_test_space_name"];                      // 钥占目录
    $webmaster_skin         = "default/";                                        // 钥占目录
    unset ($query, $row);

    // -------------------------------------------------------
    // 页娉Ｏ?
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
    // 站乇状态时示示页
    // -------------------------------------------------------
    if (!$siteopen && __SITE_ROOT=="./") {
        header('Content-Type: text/html; charset=utf-8');
        $tpl->display('webbuild.htm');
        exit;
    }

    // -------------------------------------------------------
    // 牍苍?
    // -------------------------------------------------------
    require ( __COMM_PATH . 'common.func.php' );

    if(function_exists(session_cache_limiter)) session_cache_limiter("public, must-revalidate");
	
