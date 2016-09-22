<?php
/***********************************************************
 * Document Type: Classes
 * Update: 2006/11/06
 * Author: Akon
 * Remark: Mysql数据库备份类
 ***********************************************************/

class mysqldump {

    var $version="1.0"; // 数据库备份类版本
    var $link;
    var $errr; // 错误信息
    var $dbhost; // 数据库服务器
    var $dbname; // 数据库用户名
    var $filename; // 备份文件文件名
    var $sousdir = __DATBAK_PATH; // 存放备份文件的目录
    var $format_out; // = "no_comment" 时, 不为备份文件添加注释
    var $dbcharset; // MySQL 字符集, 可选 'gbk', 'big5', 'utf8', 'latin1'
    var $isdown; // True/False, 输出下载或创建文件
    var $compress_gz; // True/False, 是否使用gzip压缩格式
    var $compress_zip; // True/False, 是否使用zip压缩格式
    var $contents;

    /**
     * 类构造函数
     *
     * @param string $dbhost    数据库服务器
     * @param string $dbuser    数据库用户名
     * @param string $dbpass    数据库密码
     * @param string $dbname    数据库名
     * @param string $dbcharset MySQL 字符集, 可选 'gbk', 'big5', 'utf8', 'latin1'
     * @param string $link
     * @return void
     */
    function mysqldump( $dbhost, $dbuser, $dbpass, $dbname, $dbcharset="gbk", $link=NULL) {
        if ($link) {
            $this->link = $link;
        }
        else {
            $this->link = @mysql_connect($dbhost, $dbuser, $dbpass);
            if (!$this->link ) {
                $this->errr=$this->message("err_mysql");
                return false;
            }
        }
        if ($dbcharset) // 设定数据库字符集
            mysql_query("SET character_set_connection={$dbcharset}, character_set_results={$dbcharset}, character_set_client=binary");
        if (!mysql_select_db($dbname)) {
            $this->errr=$this->message("err_base");
            return false;
        }
        $this->dbname = $dbname;
        $this->dbhost = $dbhost;
        $this->dbcharset = $dbcharset;
    }

    /**
     * 将内容写入文件
     *
     * @param string $fp    fp handle
     * @param string $val   文件内容
     */
    function write ($fp, $val) {
        if ($this->isdown)
            echo $val;
        else
            fwrite($fp, $val);
    }

    /**
     * 下载备份文件
     *
     * @param string $filename
     */
    function downfile($filename) {
        header("Content-type: application/force-download");
        header("Content-Disposition: inline; filename=\"" . "".$filename . "\"");
        header("Expires: Mon, 1 Jul 1999 01:00:00 GMT");
        header("Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0");
    }

    function dumpDatabase() {
            $this->contents = "";
            $ltable = mysql_list_tables($this->dbname,$this->link); // 列出数据库中的表
            $nb_row = mysql_num_rows($ltable); // 取得结果集中行的数目
            for ($i=0; $i<$nb_row; $i++) {
                $tablename = mysql_tablename($ltable, $i);
                $this->contents .= $this->addStruComment($tablename); // 添加插入表结构的注释
                $this->contents .= "DROP TABLE IF EXISTS `$tablename`;\n";
                $query = "SHOW CREATE TABLE $tablename";  // 创建表结构
                $tbcreate = mysql_query($query); // 取出表中所有数据
                $row = mysql_fetch_array($tbcreate);
                $create = $row[1].";";
                $this->contents .= "$create\n\n";
                $this->contents .= $this->addRecoveryComment($tablename); // 添加表数据的注释
                $query = "SELECT * FROM $tablename";
                $datacreate = mysql_query($query);
                if (mysql_num_rows($datacreate) > 0) {
                    $qinsert = "LOCK TABLES $tablename WRITE; \n";
                    $qinsert .= "INSERT INTO `$tablename` values \n  ";
                    while($row12 = mysql_fetch_assoc($datacreate)) {
                           $row12 = array_map(array($this, 'separe'), $row12);
                           $data = implode(",",$row12);
                           $data = "$qinsert($data)";
                           $this->contents .= "$data\n";
                           $qinsert=", ";
                    }
                    $this->contents .= "\nUNLOCK TABLES;\n\n";
                }
                $this->contents .= "-- --------------------------------------------------------\n\n";
            }
        return $this->contents;
    }

    /**
     * 生成备份文件
     *
     * @param string $file 文件名
     */
    function backup($file="") {
        if($this->isdown){$this->sousdir="";}
        if ($this->errr) {
            return false;
        }
        else{
            if ($file) { // 如果已经指定文件名则使用指定的文件名
                $this->filename=$this->sousdir.$file;
            }
            else{ // 以当前日期及年份设置输出的文件名
                $this->filename = $this->sousdir.$this->dbname."_".date("ymd_his_")."bak".".sql";
            }
           if ($this->isdown) { // 下载文件
                $this->downfile($this->filename);
           }
           else{ // 保存到指定目录
                @mkdir($this->sousdir,777);
                $fp = @fopen($this->filename,"w");
                if (!$fp) {$this->errr=$this->message("err_file"); return false;}
           }
           $this->write($fp,$this->addHeadComment()); // 添加备份文件 header 注释
            // 列出所有表
            $ltable = mysql_list_tables($this->dbname,$this->link);
            $nb_row = mysql_num_rows($ltable);
            $i = 0;
            while ($i < $nb_row) { // 遍历所有表
                $tablename = mysql_tablename($ltable, $i);
                $this->write($fp,$this->addStruComment($tablename)); // 添加插入表结构的注释
                $this->write($fp,"DROP TABLE IF EXISTS `$tablename`;\n"); // 如果表已经存在则覆盖
                $query = "SHOW CREATE TABLE $tablename";  // 创建表结构
                // 取出表中所有数据
                $tbcreate = mysql_query($query);
                $row = mysql_fetch_array($tbcreate);
                $create = $row[1].";";
                $this->write($fp,"$create\n\n");
                $this->write($fp,$this->addRecoveryComment($tablename));  // 添加表数据的注释
                $query = "SELECT * FROM $tablename";
                $datacreate = mysql_query($query);
                if (mysql_num_rows($datacreate) > 0) {
                    $qinsert = "LOCK TABLES $tablename WRITE; \n";
                    $qinsert .= "INSERT INTO `$tablename` values \n  ";
                    while($row12 = mysql_fetch_assoc($datacreate)) {
                           $row12 = array_map(array($this, 'separe'), $row12);
                           $data = implode(",",$row12);
                           $data = "$qinsert($data)";
                           $this->write($fp,"$data\n");
                           $qinsert=", ";
                    }
                    $this->write($fp,";\n");
                    $this->write($fp,"UNLOCK TABLES; \n");
                    $this->write($fp,"\n");
                }
                $i++;
                $this->write($fp,"-- --------------------------------------------------------\n\n");
          }
            if (!$this->isdown)
                fclose($fp);
        }
        if ($this->compress_gz && !$this->isdown)
            $this->compress_gz();
        if ($this->compress_zip && !$this->isdown)
            $this->compress_zip($file);
    }

    /**
     * 组合数据
     *
     * @param string $table 从数据库中取出数据
     * @return string 将数据转义并添加''
     */
    function separe($table) {
        $table=mysql_escape_string($table);
        if (is_numeric($table)) { return $table;}
        if (!$table) {return "NULL";}
        return "'".$table."'";
    }

    /**
     * 将SQL备份文件压缩为gzip文件格式
     *
     * @return boolean 压缩失败将返回False
     */
    function compress_gz() {
        if ($this->filename and !$this->errr) {
            $fp = @fopen($this->filename,"rb");
            $zp = @gzopen(str_replace(".sql","",$this->filename).".gz", "wb9");
            if (!$zp or !$fp) {$this->errr =$this->message("err_compress"); return false; }
            while(!feof($fp)) {
                $data=fgets($fp, 8192);
                gzwrite($zp,$data);
            }
            fclose($fp);
            gzclose($zp);
            unlink($this->filename);
            $this->filename=str_replace(".sql","",$this->filename).".gz";
        }
    }

    /**
     * 将SQL备份文件压缩为zip文件格式
     *
     */
    function compress_zip() {
        if ($this->filename and !$this->errr) {
            include ( __CLASS_PATH . '/zip.class.php');
            $zip = new Zip;
            $contents = fread (fopen($this->filename,"rb"), filesize ($this->filename));
            $zip->add_File($contents,str_replace($this->sousdir,"",$this->filename));
            unlink($this->filename);
            $this->filename=str_replace(".sql","",$this->filename).".zip";
            fputs(fopen($this->filename,"wb"),$zip->get_file());
        }
    }

    /**
     * 清除备份文件目录下的所有文件
     *
     */
    function nettoyage() {
        if (!$this->errr) {
            if ($dir = @opendir($this->sousdir)) {
                while($file = @readdir($dir)) {
                    @unlink($this->sousdir.$file);
                }
                @closedir($dir);
            }
        }
    }

    /**
     * 返回错误信息
     *
     * @param string $numero 错误信息
     * @return string 返回一错误字符串
     */
    function message($numero) {
        $message['err_compress'] = $cmsg['dump_err_compress'];
        $message['err_file'] = $cmsg['dump_err_file'];
        $message['err_base'] = $cmsg['dump_err_base'];
        $message['err_mysql'] = $cmsg['dump_err_mysql'];
        return $message[$numero];
    }

    /**
     * 为SQL备份文件添加 header 注释及服务器信息
     *
     * @return string 注释
     */
    function addHeadComment() {
        if ($this->format_out<>"no_comment") {
            $server_info = mysql_get_server_info($this->link);
            return  "-- MYSQL 数据库备份 \n"
                . "-- version $this->version \n"
                . "-- http://www.zhqiao.cn \n"
                . "-- \n"
                . "-- 主机: $this->dbhost \n"
                . "-- 生成日期: ".date("Y 年 m 月 d 日 H:i:s")." \n"
                . "-- 服务器版本: $server_info \n"
                . "-- \n"
                . "--  数据库: $this->dbname \n"
                . "--  字符集: $this->dbcharset \n"
                . "-- \n\n"
                . "-- --------------------------------------------------------\n";
        }
    }

    /**
     * 为SQL备份文件的创建数据库结构部份添加注释
     *
     * @param string $tablename 数据库表名
     * @return string 注释
     */
    function addStruComment($tablename) {
        if ($this->format_out<>"no_comment") {
            return  "--\n"
                . "-- 导出表中的数据 '$tablename' \n"
                . "--\n"
                . "\n";
        }
    }

    /**
     * 为SQL备份文件的导出数据部分添加注释
     *
     * @param string $tablename 数据库表名
     * @return string 注释
     */
    function addRecoveryComment ($tablename) {
        if ($this->format_out<>"no_comment") {
            return "--\n"
                . "-- 导出表中的数据 '$tablename' \n"
                . "--\n"
                . "\n";
        }
    }
}