<?php
/***********************************************************
 * Document Type: Function
 * Update: 2006/09/13
 * Author: akon
 * Remark: 公用自定函数
 ***********************************************************/

    /*
     * 执行JS脚本
     *
     * @param string $script_str    需要执行的脚本代码
     */
    function doJS($script_str="") {
        global $charset;
        @header("Content-type: text/html; charset={$charset}");
        echo "<script language=\"javascript\" type=\"text/javascript\">\n";
        echo "{$script_str}\n";
        echo "</script>\n";
    }

    /*
     * 弹出信息窗口
     *
     * @param string $string    提示信息
     */
    function alert($string="") {
        global $charset;
        @header("Content-type: text/html; charset={$charset}");
        echo "<script language=\"javascript\" type=\"text/javascript\">\n";
        echo "alert(\"{$string}\")\n";
        echo "</script>\n";
    }

    /*
     * 跳转到指定的页面
     *
     * @param string $url       需要转到的URL地址
     * @param string $target    目标窗体
     */
    function goto($url,$target="self") {
        global $charset;
        @header("Content-type: text/html; charset={$charset}");
        echo" <script language=\"javascript\" type=\"text/javascript\">";
        echo $url=="back" ? "history.back(-1)" : "{$target}.location='{$url}'";
        echo "</script>";
    }

    /**
     * 过滤特殊字符,用于过滤SQL语句
     *
     * @param string $string
     * @return string 返回一个安全的SQL字符串
     */
    function filter_str($string) {
        return str_replace(array('%', "'", '`', '*', '@', '\\', '&'), array('', '', '', '', '', '', ''), dhtmlspecialchars($string));
    }

    /**
     * 可用于判断HTML页面 CheckBox 的选中状态
     *
     * @param string $val1 值1
     * @param string $val2 值2
     */
    function checked($val1,$val2) {
        if ($val1==$val2) echo 'checked="checked"';
    }

    /**
     * 可用于判断HTML页面 Selected 的选中状态
     *
     * @param string $val1 值1
     * @param string $val2 值2
     */
    function selected($val1,$val2) {
        if ($val1==$val2) echo 'selected="selected"';
    }

    /**
     * 按指定字符切割字符串(支持UTF-8)
     *
     * @param string $string    需要切割的原始字符
     * @param integer $length   切割的字符数量
     * @param string $dot       字符超出时的补充字符
     * @return string 返回一个切割后的字符串
     */
    function cutstr($string, $length, $dot = ' ...') {
        global $charset;
        if(strlen($string) <= $length) return $string;
        $strcut = '';
        if(strtolower($charset) == 'utf-8') {
            $n = $tn = $noc = 0;
            while ($n < strlen($string)) {
                $t = ord($string[$n]);
                if($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                    $tn = 1; $n++; $noc++;
                } elseif(194 <= $t && $t <= 223) {
                    $tn = 2; $n += 2; $noc += 2;
                } elseif(224 <= $t && $t < 239) {
                    $tn = 3; $n += 3; $noc += 2;
                } elseif(240 <= $t && $t <= 247) {
                    $tn = 4; $n += 4; $noc += 2;
                } elseif(248 <= $t && $t <= 251) {
                    $tn = 5; $n += 5; $noc += 2;
                } elseif($t == 252 || $t == 253) {
                    $tn = 6; $n += 6; $noc += 2;
                } else {
                    $n++;
                }
                if ($noc >= $length) break;
             }
            if ($noc > $length) $n -= $tn;
            $strcut = substr($string, 0, $n);
        }
        else {
            for($i = 0; $i < $length - 3; $i++) $strcut .= ord($string[$i]) > 127 ? $string[$i].$string[++$i] : $string[$i];
        }
        return $strcut.$dot;
    }

    /**
     * 反转换 htmlentities 转换的字符
     *
     * @param string $string    需要转换的字符串
     * @return string
     */
    function unhtmlentities ($string) {
       $trans_tbl1 = get_html_translation_table (HTML_ENTITIES);
       foreach ( $trans_tbl1 as $ascii => $htmlentitie ) $trans_tbl2[$ascii] = '&#'.ord($ascii).';';
       $trans_tbl1 = array_flip ($trans_tbl1);
       $trans_tbl2 = array_flip ($trans_tbl2);
       return strtr (strtr ($string, $trans_tbl1), $trans_tbl2);
    }

    /**
     * 转换所有字符为HTML格式
     *
     * @param string $string    需要格式化的字符串或字符数组
     * @return string
     */
    function dhtmlspecialchars($string) {
        if(is_array($string)) {
            foreach($string as $key => $val)  $string[$key] = dhtmlspecialchars($val);
        }
        else {
            $string = preg_replace('/&amp;((#(\d{3,5}|x[a-fA-F0-9]{4})|[a-zA-Z][a-z0-9]{2,5});)/', '&\\1',
            str_replace(array('&', '"', '<', '>'), array('&amp;', '&quot;', '&lt;', '&gt;'), $string));
        }
        return $string;
    }

    /**
     * 加亮关键字
     *
     * @param string $string    需要加亮的字符串
     * @param string $keyword   关键字
     * @return string   返回一个加亮后的字符串
     */
    function light_keyword($string,$keyword) {
        return str_replace($keyword,"<span class=\"highlight_keyword\">$keyword</span>",$string);
    }

    /**
     * 是否合法的邮件格式
     *
     * @param string $email 需要检测的字符串
     * @return mixed    非法格式返回FALSE,否则返回原始字符串
     */
    function is_email($email) {
        return strlen($email) > 6 && preg_match("/^[-_+.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+([a-z]{2,4})|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email);
    }

    /**
     * 是否有效的日期格式
     *
     * @param string $ymd   需要检测的字符串
     * @param string $sep   年月日之间的分隔字符
     * @return mixed    非法格式返回FALSE,否则返回原始字符串
     */
    function is_date($ymd, $sep='-') {
        if(!empty($ymd)) {
            list($year, $month, $day) = explode($sep, $ymd);
            return checkdate($month, $day, $year);
        } else return false;
    }

    /**
     * 是否有效的URL地址
     *
     * @param string $url   需要检测的字符串
     * @return mixed    非法格式返回FALSE,否则返回原始字符串
     */
    function is_url($url) {
         return preg_match("/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"])*$/", $url);
     }

    /**
     * 是否有效的身份证号码(15-18位)
     *
     * @param string $string    需要检测的字符串
     * @return mixed    非法格式返回FALSE,否则返回原始字符串
     */
    function is_idcard($string) {
         return preg_match("/^\d{15}(\d{2}[A-Za-z0-9])?$/", $string);
     }

    /**
     * 检测字符串是否只包含英文(A-Za-z0-9)
     *
     * @param string $string    需要检测的字符串
     * @return mixed    非法格式返回FALSE,否则返回原始字符串
     */
    function is_english($string) {
        return preg_match("/^[A-Za-z0-9]+$/", $string);
     }

    /**
     * 获取客户端IP地址
     *
     * @return string   返回一个IP地址
     */
    function GetIP() {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            $ip = getenv("REMOTE_ADDR");
        else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = "unknown";
       return($ip);
    }

     /**
     * 获取当前页面的URL地址
     *
     * @return string   返回当前页面的URL地址,包括所有URL参数
     */
    function get_curr_url() {
        $port = $_SERVER["SERVER_PORT"]=="80" ? "" : ":".$_SERVER["SERVER_PORT"];
        $querystr = empty($_SERVER['QUERY_STRING']) ? "" : "?".$_SERVER["QUERY_STRING"];
        return "http://".$_SERVER["SERVER_ADDR"].$port.$_SERVER['PHP_SELF'].$querystr;
    }

    /**
     * 按指定长度生成随机字符串
     *
     * @param interger $length  字符串长度
     * @param boolean $onlynum  是否(True/False)仅限数字
     * @param boolean $upper    是否(True/False)将字符转换为大写
     * @return string 返回指定长度生成随机字符串
     */
    function getRndCode($length=4, $onlynum=true, $upper=false) {
        $codestr = "0123456789";
        $codestr .= $onlynum ? "" : "abcdefghijklmnopqrstuvwxyz";
        for($i=0; $i=999; $i++){
            $order=mt_rand(0,strlen($codestr));
            $codechars .= $codestr[$order];
            if (strlen($codechars)>=$length) break;
        }
        return $upper ? strtoupper($codechars) : $codechars;
    }

    /**
     * 获取指定路径文件的相关信息
     *
     * @param string $filepath  文件名及路径
     * @return array    返回一个包含该文件(路径、文件名、扩展名)小写数组字符
     */
    function get_file_info($filepath) {
        $filename = strtolower(basename($filepath));
        $fileinfo["name"] = $filename;
        $fileinfo["ext"]  = trim(substr(strrchr($filename, '.'), 1));
        $fileinfo["main"] = substr($filename, 0, strlen($filename) - strlen($fileinfo["ext"]) - 1);
        $fileinfo["path"] = str_replace($filename,"",$filepath);
        return $fileinfo;
    }

    /**
     * 获取指定的文件的扩展名
     *
     * @param string $filename  文件名
     * @return string   返回一个小写的文件扩展名
     */
    function get_file_ext($filename) {
        return strtolower(trim(substr(strrchr($filename, '.'), 1)));
    }

    /**
     * 下载一个指定的文件
     *
     * @param string $filepath  文件名及路径
     * @return mixed    如果文件不存在则返回false
     */
    function down_file($filepath) {
        if (!file_exists($filepath)) return false;
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Component: must-revalidate, post-check=0, pre-check=0");
        header("Content-Length: " . filesize($filepath));
        header("Content-Disposition: attachment; filename=\"" . basename($filepath) . "\"");
        header('Content-Transfer-Encoding: binary');
        readfile("$filepath");
        exit;
    }

    /**
     * 检测是否被允许的上传文件格式
     *
     * @param string $ext_name  文件扩展名
     * @return boolean  合法(True)/非法(False)
     */
    function IsValidFile($ext_name) {
        global $allowfiletype;
        return in_array(strtolower($ext_name), explode('|',$allowfiletype));
    }

    /**
     * 是否图片格式文件
     *
     * @param string $ext_name  文件扩展名
     * @return boolean  返回TRUE或FALSE
     */
    function IsImgFile($ext_name) {
        return in_array(strtolower($ext_name), array('gif', 'jpg', 'jpeg', 'bmp', 'png'));
    }

    /**
     * 获取上一级路径
     *
     * @param string $folderPath    原始路径
     * @return string   返回原始路径的上一级路径
     */
    function GetParentFolder( $folderPath ) {
        $sPattern = "-[/\\\\][^/\\\\]+[/\\\\]?$-" ;
        return preg_replace( $sPattern, '', $folderPath ) ;
    }

    /**
     * 获取网站根路径
     *
     * @return string
     */
    function GetRootPath() {
        $sRealPath = realpath( './' ) ;
        $sSelfPath = $_SERVER['PHP_SELF'] ;
        $sSelfPath = substr( $sSelfPath, 0, strrpos( $sSelfPath, '/' ) ) ;
        return substr( $sRealPath, 0, strlen( $sRealPath ) - strlen( $sSelfPath ) ) ;
    }

    /**
     * 转换指定资源中的路径为正确的路径
     *
     * @param string $original_resource  需要转换的内容
     * @return string
     */
    function correct_path($original_resource) {
        global $is_test_space, $test_space_name;
        if ($is_test_space) {
            $file_true_path = __UPLOAD_PATH;
            $file_true_path = str_replace(__SITE_ROOT, "/", $file_true_path);
            $original_resource = str_replace($file_true_path, "/" . $test_space_name . $file_true_path, $original_resource);
            return str_replace("/" . $test_space_name . "/" . $test_space_name . $file_true_path, "/" . $test_space_name . $file_true_path, $original_resource);
        }
        else {
            $file_true_path = __UPLOAD_PATH;
            $file_true_path = str_replace(__SITE_ROOT, "/", $file_true_path);
            return str_replace("/" . $test_space_name . $file_true_path, $file_true_path, $original_resource);
        }
    }

    /**
     * 生成图片缩略图
     *
     * @param string $imgfile   文件路径及文件名
     * @param integer $maxW     图片最大宽度
     * @param integer $maxH     图片最大高度
     * @param boolean $remake   是否重新生成缩略图
     * @return array    [message]相关信息/[thumb] 缩略图文件路径及地址
     */
    function mkThumb($imgfile,$maxW=400,$maxH=300,$remake=false) {
        global $is_test_space, $test_space_name;
        $imgfile = __SITE_ROOT . $imgfile;
        $imgfile = str_replace("//","/", $imgfile);

        //if ($is_test_space && strlen($test_space_name)>2) $imgfile = str_replace("/$test_space_name","", $imgfile);
        if ($is_test_space && strlen($test_space_name)>2) {
			$imgfile = str_replace("./$test_space_name",".", $imgfile);

		} else {
			$path = substr(__UPLOAD_PATH, strlen(__SITE_ROOT));
			$imgfile = str_replace('./' . $path,'' . $path, $imgfile);
		}

        $thumb_file = $imgfile;

        if (!file_exists($imgfile)) {
            $info["message"] = 2; // 源文件不存在
            return $info;
        }

		
        include_once ( __CLASS_PATH . 'gd_image.class.php');
		
        $GDImage = new GDImage;
        $img_info = get_file_info($imgfile);

        $thumb_file = $img_info["path"].$maxW."x".$maxH.".".$img_info["main"].".".$img_info["ext"];	

        $load = $GDImage->loadFile($imgfile);
		//echo $load;
        if($load){
            if (!file_exists($thumb_file) || $remake==true) {
                $GDImage->mkThumb($maxW, $maxH);
                $GDImage->build($thumb_file);
                $info["message"] = 0; // 生成缩略图成功
            }
            else $info["message"] = 1; // 文件已经存在或不允许被重写
        }
        else $info["message"] = 3; // 载入源文件失败
        $info["thumb"] = $thumb_file;
        return $info;
    }

    /**
     * 获取图片缩略图
     *
     * @param string $imgfile   文件路径及文件名
     * @param integer $maxW     图片最大宽度
     * @param integer $maxH     图片最大高度
     * @return string    缩略图文件路径及地址
     */
    function getThumb($imgfile,$maxW=400,$maxH=300) {
        $img = mkThumb($imgfile,$maxW,$maxH);
        return ($img["message"]==0 || $img["message"]==1) ? $img["thumb"] : $imgfile;
    }

    /**
     * 获取相反的排序方向
     *
     * @param string $oexp          当前排序方向
     * @param string $default_exp   默认排序方向
     * @return string   返回一个相反的排序方向
     */
    function get_sort_exp($oexp,$default_exp="desc")
    {
        switch (strtolower($oexp)) {
            case "asc": $oexp = "asc"; break;
            case "desc": $oexp = "desc"; break;
            default: $oexp = $default_exp; break;
        }
        return ($oexp=="desc") ? "asc" : "desc";
    }

    /**
     * 创建插入数据的SQL语句
     *
     * @param string $table_name    数据库表名
     * @param array $fields_arr     字段/值数组，例如: $fields_arr = array("Username" => "$Username");
     * @return string   返回一条可执行的SQL语句
     */
    function create_insert_sql($table_name, $fields_arr) {
        foreach ($fields_arr as $k=>$v) {
            if (!empty($keys) && !empty($vals)) {
                $keys .= ", "; $vals .= ", ";
            }
            $keys .= "`{$k}`"; $vals .= "'{$v}'";
        }
        return "insert into `{$table_name}` ({$keys}) values ({$vals})";
    }

    /**
     * 创建修改数据的SQL语句
     *
     * @param string $table_name    数据库表名
     * @param array $fields_arr     字段/值数组，例如: $fields_arr = array("Username" => "$Username");
     * @param string $condition     SQL语句条件，例如: WHERE `id`='$id'
     * @return string   返回一条可执行的SQL语句
     */
    function create_update_sql($table_name, $fields_arr, $condition) {
        foreach ($fields_arr as $k=>$v) {
            if (!empty($sql_str)) $sql_str .= ", ";
            $sql_str .= "`{$k}`='{$v}'";
        }
        return "UPDATE `{$table_name}` SET {$sql_str} {$condition}";
    }

    /**
     * 创建SQL搜索子句
     * $search_arr   : SQL搜索数组
     * $par_junk     : and , 将返回 and (...) 形式子句
     *                 or , 将返回 or (...) 形式子句
     *                 空 , 将返回 ... 子句
     * 例 :
     * $search_arr[] = array( "field" => "title", "keyword" => "aa", "condition" => "like", "junk" => "and" );
     * $search_arr[] = array( "field" => "title", "keyword" => "bb", "condition" => "=", "junk" => "or" );
     * $search_arr[] = array( "field" => "title", "keyword" => "cc", "condition" => ">", "junk" => "and" );
     * create_search_sql($search_arr,"and")
     * 将返回 ： and (`title` like '%aa%' or `title`='bb' and `title`>'cc')
     * 注 ：
     * 数组各字段不能为空
     * field         字段名
     * keyword       搜索关键字
     * condition     查询条件            like , = , > , < , <>
     * junk          条件查询关系        and , or
     */
    function create_search_sql($search_arr,$par_junk="") {
        $first = true;
        foreach ($search_arr as $key=>$val) {
            if (is_array($val)) {
                $junk = ($val["junk"]!="and" && $val["junk"]!="or") ? "" : $val["junk"];
                $field = $val["field"];
                $condition = $val["condition"];
                $keyword = $val["keyword"];
                if (!empty($field) && !empty($condition) && !empty($keyword)) {
                    if ($first) {
                        $junk = "";
                        $first = false;
                    }
                    else $junk = " {$junk}";
                    switch ($condition) { // like , < , > , = , <> ,
                        case "like": $sql_clause .= "{$junk} `{$field}` like '%{$keyword}%'"; break;
                        case "<":
                        case ">":
                        case "=":
                        case "<>": $sql_clause .= "{$junk} `{$field}`{$condition}'{$keyword}'"; break;
                    }
                }
            }
        }
        if (!empty($sql_clause) && ($par_junk=="and" || $par_junk=="or")) $sql_clause = " {$par_junk} ({$sql_clause})";
        return $sql_clause;
    }

    /**
     * 显示XHTML文档Header
     *
     * @param string $header_content    需要插入在Header中的内容
     */
    function show_xhtml_header($header_content="") {
        global $charset;
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="'.$charset.'" lang="'.$charset.'">
<head>
<meta http-equiv="Content-Type" content="text/html; charset='.$charset.'" />
<meta http-equiv="Content-Language" content="'.$charset.'" />'."\n";
        if (!empty($header_content)) echo $header_content."\n";
        echo "</head>\n\n<body>\n";
    }

    /**
     * 显示XHTML文档Footer
     *
     * @param string $foot_content  需要插入在Footer中的内容
     */
    function show_xhtml_footer($foot_content="") {
        if (!empty($foot_content)) echo "\n".$foot_content;
        echo "\n</body>\n</html>";
    }

    /**
     * 信息反馈
     *
     * @param string $content   提示信息内容
     * @param string $url       返回链接地址
     * @param string $url_tip   返回链接提示文字
     */
    function feedback($content, $url="javascript:history.go(-1);", $url_tip='') {
        global $tpl, $clang;
        if (empty($url_tip)) $url_tip = $clang['goto_back'];
		if (empty($url)) $url = "javascript:history.go(-1);";
        $tpl->assign("content",$content);
        $tpl->assign("url",$url);
        $tpl->assign("url_tip",$url_tip);
        $tpl->display("feedback.htm");
        exit;
    }
    function feedback_en($content, $url="javascript:history.go(-1);", $url_tip='') {
        global $tpl, $clang;
        if (empty($url_tip)) $url_tip = $clang['goto_back_en'];
		if (empty($url)) $url = "javascript:history.go(-1);";
        $tpl->assign("content",$content);
        $tpl->assign("url",$url);
        $tpl->assign("url_tip",$url_tip);
        $tpl->display("feedback_en.htm");
        exit;
    }
    /**
     * AJAX 处理响应
     *
     * @param string $status_code   响应代码
     * @param string $msg 响应消息
     */
    function ajax_response($status_code, $msg="") {
        global $charset;
        header("Content-type:application/xml");
        echo "<?xml version=\"1.0\" encoding=\"{$charset}\"?>\r\n";
        echo "<response>";
        echo "<status>{$status_code}</status>";
        if (!empty($msg)) echo "<message>{$msg}</message>";
        echo "</response>";
        die();
    }

    /**
     * 查询用户是否已经存在
     *
     * @param string $admin_user  用户名
     * @return boolean  存在则返回TRUE，否则返回FALSE
     */
    function admin_exist($admin_user) {
        global $tablepre, $db;
        if (!empty($admin_user)) {
            $query = $db->query("select `admin_user` from `{$tablepre}admin_user` where `admin_user`='{$admin_user}'");
            return $db->num_rows($query) ? true : false;
        }
    }
	/*留言反馈取信息函数*/
        function AlertMsg($msg,$url) {
            global $charset;
            @header("Content-type: text/html; charset={$charset}");
            if (is_int($url)==true)
            {
                if ($url==0)
                {
                    echo "<script>alert(\"$msg\");window.close();</script>";
                }
                else
                {
                    echo "<script>alert(\"$msg\");history.go(-$url);</script>";
                }
            }
            else
            {
                echo "<script>alert(\"$msg\");window.location=\"$url\";</script>";
            }
            exit;
        }
    /**
     * 查询组是否已经存在
     *
     * @param string $group_name 组名称
     * @return boolean  存在则返回TRUE，否则返回FALSE
     */
    function group_exist($group_name) {
        global $tablepre, $db;
        if (!empty($group_name)) {
            $query = $db->query("select `group_name` from `{$tablepre}admin_group` where `group_name`='{$group_name}'");
            return $db->num_rows($query) ? true : false;
        }
    }
    //---------------------------------------------
    // 以下为兼容PHP5函数
    //---------------------------------------------

    if (!function_exists("file_get_contents")) {
        /**
         * 将整个文件读入一个字符串(兼容PHP3)
         *
         * @param string $f  文件名及路径
         * @return string 文件内容
         */
        function file_get_contents($f) {
            $h = @fopen ($f, "rb");
            if ($h) $c = @fread ($h, @filesize ($f));
            else return false;
            fclose ($h);
            return $c;
        }
    }

    if (!function_exists("file_put_contents")) {
        /**
         * 将一个字符串写入文件(兼容PHP3、PHP4)
         *
         * @param string $f  文件名及路径
         * @param string $d  需要写入的内容
         * @return mixed 写入文档失败则返回FALSE
         */
        function file_put_contents ($f,$d) {
            $fp = @fopen($f,"wb");
            if (!$fp) return false;
            fwrite($fp, $d);
            fclose($fp);
        }
    }

    if (!function_exists('http_build_query')){
        /**
         * 生成 url-encoded 之后的请求字符串
         *
         * @param array $a  关联（或下标）数组
         * @return string   Query URL 字符串
         */
        function http_build_query($a) {
            $f = '';$ret = '';
            foreach ($a as $i => $j) {
                if (!empty($j)) {
                    $ret .= "{$f}{$i}=".urlencode($j);
                    $f='&';
                }
            }
            return $ret;
        }
    }
        /**
         * 截取
         *
         * 
         *
         */
	function dodi_msubstr (&$fStr, $fStart, $fLen, $fCode = "gb2312",$show = '...') {
      if(function_exists('mb_substr')) {
          if(mb_strlen($fStr, $fCode) > $fLen) {
              return mb_substr ($fStr, $fStart, $fLen, $fCode) . $show;
          }
          return mb_substr ($fStr, $fStart, $fLen, $fCode);
      }else if(function_exists('iconv_substr')) {
          if(iconv_strlen($fStr, $fCode)>$fLen) {
              return iconv_substr ($fStr, $fStart, $fLen, $fCode) . $show;
          }
          return iconv_substr ($fStr, $fStart, $fLen, $fCode);
      }

      $fCode = strtolower($fCode);
      switch ($fCode) {
          case "utf-8" : 
              preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $fStr, $ar);  
              if(func_num_args() >= 3) {  
                  if (count($ar[0]) > $fLen) {
                      return join("", array_slice($ar[0], $fStart, $fLen)) . $show; 
                  }
                  return join("", array_slice($ar[0], $fStart, $fLen)); 
              } else {  
                  return join("", array_slice($ar[0], $fStart)); 
              } 
              break;
          default:
              $fStart = $fStart * 2;
              $fLen   = $fLen * 2;
              $strlen = strlen($fStr);
              for ( $i = 0; $i < $strlen; $i++ ) {
                  if ( $i >= $fStart && $i < ( $fStart + $fLen ) ) {
                      if ( ord(substr($fStr, $i, 1)) > 129 ) $tmpstr .= substr($fStr, $i, 2);
                      else $tmpstr .= substr($fStr, $i, 1);
                  }
                  if ( ord(substr($fStr, $i, 1)) > 129 ) $i++;
              }
              if ( strlen($tmpstr) < $strlen ) $tmpstr .= $show;
              return $tmpstr;
      }
  }