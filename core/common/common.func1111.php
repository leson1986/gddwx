<?php
/***********************************************************
 * Document Type: Function
 * Update: 2006/09/13
 * Author: akon
 * Remark: Զ
 ***********************************************************/

    /*
     * ִJSű
     *
     * @param string $script_str    ҪִеĽű
     */
    function doJS($script_str="") {
        global $charset;
        @header("Content-type: text/html; charset={$charset}");
        echo "<script language=\"javascript\" type=\"text/javascript\">\n";
        echo "{$script_str}\n";
        echo "</script>\n";
    }

    /*
     * Ϣ
     *
     * @param string $string    ʾϢ
     */
    function alert($string="") {
        global $charset;
        @header("Content-type: text/html; charset={$charset}");
        echo "<script language=\"javascript\" type=\"text/javascript\">\n";
        echo "alert(\"{$string}\")\n";
        echo "</script>\n";
    }

    /*
     * תָҳ
     *
     * @param string $url       ҪתURLַ
     * @param string $target    Ŀ�?
     */
    function goto($url,$target="self") {
        global $charset;
        @header("Content-type: text/html; charset={$charset}");
        echo" <script language=\"javascript\" type=\"text/javascript\">";
        echo $url=="back" ? "history.back(-1)" : "{$target}.location='{$url}'";
        echo "</script>";
    }

    /**
     * ַ,ڹSQL
     *
     * @param string $string
     * @return string һȫSQLַ
     */
    function filter_str($string) {
        return str_replace(array('%', "'", '`', '*', '@', '\\', '&'), array('', '', '', '', '', '', ''), dhtmlspecialchars($string));
    }

    /**
     * жHTMLҳ CheckBox ѡ״̬
     *
     * @param string $val1 ֵ1
     * @param string $val2 ֵ2
     */
    function checked($val1,$val2) {
        if ($val1==$val2) echo 'checked="checked"';
    }

    /**
     * жHTMLҳ Selected ѡ״̬
     *
     * @param string $val1 ֵ1
     * @param string $val2 ֵ2
     */
    function selected($val1,$val2) {
        if ($val1==$val2) echo 'selected="selected"';
    }

    /**
     * ַָиַ(֧UTF-8)
     *
     * @param string $string    Ҫиԭʼַ
     * @param integer $length   иַ
     * @param string $dot       ַʱĲַ
     * @return string һиַ
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
     * ת htmlentities תַ
     *
     * @param string $string    Ҫתַ
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
     * תַΪHTMLʽ
     *
     * @param string $string    Ҫʽַַ
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
     * ؼ
     *
     * @param string $string    Ҫַ
     * @param string $keyword   ؼ
     * @return string   һַ
     */
    function light_keyword($string,$keyword) {
        return str_replace($keyword,"<span class=\"highlight_keyword\">$keyword</span>",$string);
    }

    /**
     * ǷϷʼʽ
     *
     * @param string $email Ҫַ
     * @return mixed    ǷʽFALSE,򷵻ԭʼַ
     */
    function is_email($email) {
        return strlen($email) > 6 && preg_match("/^[-_+.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+([a-z]{2,4})|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email);
    }

    /**
     * ǷЧڸʽ
     *
     * @param string $ymd   Ҫַ
     * @param string $sep   ֮ķַָ
     * @return mixed    ǷʽFALSE,򷵻ԭʼַ
     */
    function is_date($ymd, $sep='-') {
        if(!empty($ymd)) {
            list($year, $month, $day) = explode($sep, $ymd);
            return checkdate($month, $day, $year);
        } else return false;
    }

    /**
     * ǷЧURLַ
     *
     * @param string $url   Ҫַ
     * @return mixed    ǷʽFALSE,򷵻ԭʼַ
     */
    function is_url($url) {
         return preg_match("/^http:\/\/[A-Za-z0-9]+\.[A-Za-z0-9]+[\/=\?%\-&_~`@[\]\':+!]*([^<>\"])*$/", $url);
     }

    /**
     * ǷЧ֤(15-18λ)
     *
     * @param string $string    Ҫַ
     * @return mixed    ǷʽFALSE,򷵻ԭʼַ
     */
    function is_idcard($string) {
         return preg_match("/^\d{15}(\d{2}[A-Za-z0-9])?$/", $string);
     }

    /**
     * ַǷֻӢ(A-Za-z0-9)
     *
     * @param string $string    Ҫַ
     * @return mixed    ǷʽFALSE,򷵻ԭʼַ
     */
    function is_english($string) {
        return preg_match("/^[A-Za-z0-9]+$/", $string);
     }

    /**
     * ȡͻIPַ
     *
     * @return string   һIPַ
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
     * ȡǰҳURLַ
     *
     * @return string   صǰҳURLַ,URL
     */
    function get_curr_url() {
        $port = $_SERVER["SERVER_PORT"]=="80" ? "" : ":".$_SERVER["SERVER_PORT"];
        $querystr = empty($_SERVER['QUERY_STRING']) ? "" : "?".$_SERVER["QUERY_STRING"];
        return "http://".$_SERVER["SERVER_ADDR"].$port.$_SERVER['PHP_SELF'].$querystr;
    }

    /**
     * ַָ
     *
     * @param interger $length  ַ
     * @param boolean $onlynum  Ƿ(True/False)
     * @param boolean $upper    Ƿ(True/False)ַתΪд
     * @return string ַָ
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
     * ȡָ·ļϢ
     *
     * @param string $filepath  ļ·
     * @return array    һļ(·ļչ)Сдַ
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
     * ȡָļչ
     *
     * @param string $filename  ļ
     * @return string   һСдļչ
     */
    function get_file_ext($filename) {
        return strtolower(trim(substr(strrchr($filename, '.'), 1)));
    }

    /**
     * һָļ
     *
     * @param string $filepath  ļ·
     * @return mixed    ļ򷵻false
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
     * Ƿϴļʽ
     *
     * @param string $ext_name  ļչ
     * @return boolean  Ϸ(True)/Ƿ(False)
     */
    function IsValidFile($ext_name) {
        global $allowfiletype;
        return in_array(strtolower($ext_name), explode('|',$allowfiletype));
    }

    /**
     * ǷͼƬʽļ
     *
     * @param string $ext_name  ļչ
     * @return boolean  TRUEFALSE
     */
    function IsImgFile($ext_name) {
        return in_array(strtolower($ext_name), array('gif', 'jpg', 'jpeg', 'bmp', 'png'));
    }

    /**
     * ȡһ·
     *
     * @param string $folderPath    ԭʼ·
     * @return string   ԭʼ·һ·
     */
    function GetParentFolder( $folderPath ) {
        $sPattern = "-[/\\\\][^/\\\\]+[/\\\\]?$-" ;
        return preg_replace( $sPattern, '', $folderPath ) ;
    }

    /**
     * ȡվ·
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
     * תָԴе·Ϊȷ·
     *
     * @param string $original_resource  Ҫת
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
     * ͼƬͼ
     *
     * @param string $imgfile   ļ·ļ
     * @param integer $maxW     ͼƬ
     * @param integer $maxH     ͼƬ߶
     * @param boolean $remake   Ƿͼ
     * @return array    [message]Ϣ/[thumb] ͼļ·ַ
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
            $info["message"] = 2; // Դļ
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
                $info["message"] = 0; // ͼɹ
            }
            else $info["message"] = 1; // ļѾڻ����?
        }
        else $info["message"] = 3; // Դļʧ
        $info["thumb"] = $thumb_file;
        return $info;
    }

    /**
     * ȡͼƬͼ
     *
     * @param string $imgfile   ļ·ļ
     * @param integer $maxW     ͼƬ
     * @param integer $maxH     ͼƬ߶
     * @return string    ͼļ·ַ
     */
    function getThumb($imgfile,$maxW=400,$maxH=300) {
        $img = mkThumb($imgfile,$maxW,$maxH);
        return ($img["message"]==0 || $img["message"]==1) ? $img["thumb"] : $imgfile;
    }

    /**
     * ȡ�?
     *
     * @param string $oexp          ǰ
     * @param string $default_exp   Ĭ
     * @return string   һ�?
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
     * ݵSQL
     *
     * @param string $table_name    ݿ
     * @param array $fields_arr     ֶ/ֵ�? $fields_arr = array("Username" => "$Username");
     * @return string   һִеSQL
     */
//    function create_insert_sql($table_name, $fields_arr) {
//        foreach ($fields_arr as $k=>$v) {
//            if (!empty($keys) && !empty($vals)) {
//                $keys .= ", "; $vals .= ", ";
//            }
//            $keys .= "`{$k}`"; $vals .= "'{$v}'";
//        }
//        return "insert into `{$table_name}` ({$keys}) values ({$vals})";
//    }

    /**
	
	        /*
        函数名称：AlertMsg($msg,$url)
        功能：提示信息并导向
        返回值：关闭/返回/跳转�?url
        */
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

     /*
     *
     * @param string $table_name    ݿ
     * @param array $fields_arr     ֶ/ֵ�? $fields_arr = array("Username" => "$Username");
     * @param string $condition     SQL: WHERE `id`='$id'
     * @return string   һִеSQL
     */
    function create_update_sql($table_name, $fields_arr, $condition) {
        foreach ($fields_arr as $k=>$v) {
            if (!empty($sql_str)) $sql_str .= ", ";
            $sql_str .= "`{$k}`='{$v}'";
        }
        return "UPDATE `{$table_name}` SET {$sql_str} {$condition}";
    }

    /**
     * SQLӾ
     * $search_arr   : SQL
     * $par_junk     : and ,  and (...) ʽӾ
     *                 or ,  or (...) ʽӾ
     *                  ,  ... Ӿ
     *  :
     * $search_arr[] = array( "field" => "title", "keyword" => "aa", "condition" => "like", "junk" => "and" );
     * $search_arr[] = array( "field" => "title", "keyword" => "bb", "condition" => "=", "junk" => "or" );
     * $search_arr[] = array( "field" => "title", "keyword" => "cc", "condition" => ">", "junk" => "and" );
     * create_search_sql($search_arr,"and")
     *   and (`title` like '%aa%' or `title`='bb' and `title`>'cc')
     * ע 
     * ֶβΪ
     * field         ֶ
     * keyword       ؼ
     * condition     ѯ            like , = , > , < , <>
     * junk          ѯϵ        and , or
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
     * ʾXHTMLĵHeader
     *
     * @param string $header_content    ҪHeaderе
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
     * ʾXHTMLĵFooter
     *
     * @param string $foot_content  ҪFooterе
     */
    function show_xhtml_footer($foot_content="") {
        if (!empty($foot_content)) echo "\n".$foot_content;
        echo "\n</body>\n</html>";
    }

    /**
     * Ϣ
     *
     * @param string $content   ʾϢ
     * @param string $url       ӵַ
     * @param string $url_tip   ʾ
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
     * AJAX Ӧ
     *
     * @param string $status_code   Ӧ
     * @param string $msg ӦϢ
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
     * ѯûǷѾ
     *
     * @param string $admin_user  û
     * @return boolean  򷵻TRUE򷵻FALSE
     */
    function admin_exist($admin_user) {
        global $tablepre, $db;
        if (!empty($admin_user)) {
            $query = $db->query("select `admin_user` from `{$tablepre}admin_user` where `admin_user`='{$admin_user}'");
            return $db->num_rows($query) ? true : false;
        }
    }
	    /**
     * 创建插入数据的SQL语句
     *
     * @param string $table_name    数据库表�?
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
     * ѯǷѾ
     *
     * @param string $group_name 
     * @return boolean  򷵻TRUE򷵻FALSE
     */
    function group_exist($group_name) {
        global $tablepre, $db;
        if (!empty($group_name)) {
            $query = $db->query("select `group_name` from `{$tablepre}admin_group` where `group_name`='{$group_name}'");
            return $db->num_rows($query) ? true : false;
        }
    }
    //---------------------------------------------
    // ΪPHP5
    //---------------------------------------------

    if (!function_exists("file_get_contents")) {
        /**
         * ļһַ(PHP3)
         *
         * @param string $f  ļ·
         * @return string ļ
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
         * һַдļ(PHP3PHP4)
         *
         * @param string $f  ļ·
         * @param string $d  Ҫд
         * @return mixed дĵʧ򷵻FALSE
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
         *  url-encoded ַ֮
         *
         * @param array $a  ±�?
         * @return string   Query URL ַ
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
         * ȡ
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