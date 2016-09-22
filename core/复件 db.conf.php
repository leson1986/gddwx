<?php
/***********************************************************
 * Document Type: Configure
 * Update: 2006/11/10
 * Author: Akon
 * Remark: 数据库连接配置
 ***********************************************************/

    $is_local    = 0;                // 是否位于本地开发环境
    $dbhost      = 'mysql.sql10.eznowdata.com';      // 数据库服务器
    $pconnect    = 0;                // 数据库持久连接 0=关闭, 1=打开
    $dbcharset   = "gbk";           // MySQL 字符集，可选 'gbk', 'big5', 'utf8', 'latin1'
    $tablepre   = "anyizhi_";          // 国际贸易

    // ----------------------------------------------------
    // 本机 MYSQL 配置
    // ----------------------------------------------------
    if ($is_local) {
        $dbuser = 'sq_antetech';
        $dbpass = 'antetech2013';
        $dbname = 'sq_antetech';
    }

    // ----------------------------------------------------
    // 服务器 MYSQL 配置
    // ----------------------------------------------------
    else {
        $dbuser = 'sq_antetech';
        $dbpass = 'antetech2013';
        $dbname = 'sq_antetech';
    }
?>