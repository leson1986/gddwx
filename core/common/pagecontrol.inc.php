<?php
/***********************************************************
 * Document Type: Templates
 * Update: 2006/09/12
 * Author: akon
 * Remark: 页面处理
 ***********************************************************/

    /*
     * 显示页面标题
     * $page_type  : 页面类型，list为数据列表,add为数据添加页面
     * $page_title : 页面标题
     */
    function show_page_head($page_type,$page_title) {
        global $charset,$webmaster_skin;
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="'.$charset.'" lang="'.$charset.'">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset='.$charset.'" />
    <meta http-equiv="Content-Language" content="'.$charset.'" />
    <title>'.$page_title.'</title>
    <link href="style/'.$webmaster_skin.'global.css" rel="stylesheet" type="text/css" />
    <script language="JavaScript" type="text/javascript" src="../scripts/prototype.js"></script>
    <script language="JavaScript" type="text/javascript" src="../scripts/common.js"></script>
    <script language="JavaScript" type="text/javascript" src="../scripts/alert.js"></script>
    <script language="JavaScript" type="text/javascript" src="style/'.$webmaster_skin.$page_type.'_init.js"></script>
</head>

<body>
<div id="container">
';
    }

    /*
     * 显示数据列表页面Footer
     */
    function show_page_foot() {
        echo '
</div>
</body>
</html>';
    }
?>