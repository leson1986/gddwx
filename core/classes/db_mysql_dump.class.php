<?php
/***********************************************************
 * Document Type: Classes
 * Update: 2006/11/06
 * Author: Akon
 * Remark: Mysql���ݿⱸ����
 ***********************************************************/

class mysqldump {

    var $version="1.0"; // ���ݿⱸ����汾
    var $link;
    var $errr; // ������Ϣ
    var $dbhost; // ���ݿ������
    var $dbname; // ���ݿ��û���
    var $filename; // �����ļ��ļ���
    var $sousdir = __DATBAK_PATH; // ��ű����ļ���Ŀ¼
    var $format_out; // = "no_comment" ʱ, ��Ϊ�����ļ����ע��
    var $dbcharset; // MySQL �ַ���, ��ѡ 'gbk', 'big5', 'utf8', 'latin1'
    var $isdown; // True/False, ������ػ򴴽��ļ�
    var $compress_gz; // True/False, �Ƿ�ʹ��gzipѹ����ʽ
    var $compress_zip; // True/False, �Ƿ�ʹ��zipѹ����ʽ
    var $contents;

    /**
     * �๹�캯��
     *
     * @param string $dbhost    ���ݿ������
     * @param string $dbuser    ���ݿ��û���
     * @param string $dbpass    ���ݿ�����
     * @param string $dbname    ���ݿ���
     * @param string $dbcharset MySQL �ַ���, ��ѡ 'gbk', 'big5', 'utf8', 'latin1'
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
        if ($dbcharset) // �趨���ݿ��ַ���
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
     * ������д���ļ�
     *
     * @param string $fp    fp handle
     * @param string $val   �ļ�����
     */
    function write ($fp, $val) {
        if ($this->isdown)
            echo $val;
        else
            fwrite($fp, $val);
    }

    /**
     * ���ر����ļ�
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
            $ltable = mysql_list_tables($this->dbname,$this->link); // �г����ݿ��еı�
            $nb_row = mysql_num_rows($ltable); // ȡ�ý�������е���Ŀ
            for ($i=0; $i<$nb_row; $i++) {
                $tablename = mysql_tablename($ltable, $i);
                $this->contents .= $this->addStruComment($tablename); // ��Ӳ����ṹ��ע��
                $this->contents .= "DROP TABLE IF EXISTS `$tablename`;\n";
                $query = "SHOW CREATE TABLE $tablename";  // ������ṹ
                $tbcreate = mysql_query($query); // ȡ��������������
                $row = mysql_fetch_array($tbcreate);
                $create = $row[1].";";
                $this->contents .= "$create\n\n";
                $this->contents .= $this->addRecoveryComment($tablename); // ��ӱ����ݵ�ע��
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
     * ���ɱ����ļ�
     *
     * @param string $file �ļ���
     */
    function backup($file="") {
        if($this->isdown){$this->sousdir="";}
        if ($this->errr) {
            return false;
        }
        else{
            if ($file) { // ����Ѿ�ָ���ļ�����ʹ��ָ�����ļ���
                $this->filename=$this->sousdir.$file;
            }
            else{ // �Ե�ǰ���ڼ��������������ļ���
                $this->filename = $this->sousdir.$this->dbname."_".date("ymd_his_")."bak".".sql";
            }
           if ($this->isdown) { // �����ļ�
                $this->downfile($this->filename);
           }
           else{ // ���浽ָ��Ŀ¼
                @mkdir($this->sousdir,777);
                $fp = @fopen($this->filename,"w");
                if (!$fp) {$this->errr=$this->message("err_file"); return false;}
           }
           $this->write($fp,$this->addHeadComment()); // ��ӱ����ļ� header ע��
            // �г����б�
            $ltable = mysql_list_tables($this->dbname,$this->link);
            $nb_row = mysql_num_rows($ltable);
            $i = 0;
            while ($i < $nb_row) { // �������б�
                $tablename = mysql_tablename($ltable, $i);
                $this->write($fp,$this->addStruComment($tablename)); // ��Ӳ����ṹ��ע��
                $this->write($fp,"DROP TABLE IF EXISTS `$tablename`;\n"); // ������Ѿ������򸲸�
                $query = "SHOW CREATE TABLE $tablename";  // ������ṹ
                // ȡ��������������
                $tbcreate = mysql_query($query);
                $row = mysql_fetch_array($tbcreate);
                $create = $row[1].";";
                $this->write($fp,"$create\n\n");
                $this->write($fp,$this->addRecoveryComment($tablename));  // ��ӱ����ݵ�ע��
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
     * �������
     *
     * @param string $table �����ݿ���ȡ������
     * @return string ������ת�岢���''
     */
    function separe($table) {
        $table=mysql_escape_string($table);
        if (is_numeric($table)) { return $table;}
        if (!$table) {return "NULL";}
        return "'".$table."'";
    }

    /**
     * ��SQL�����ļ�ѹ��Ϊgzip�ļ���ʽ
     *
     * @return boolean ѹ��ʧ�ܽ�����False
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
     * ��SQL�����ļ�ѹ��Ϊzip�ļ���ʽ
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
     * ��������ļ�Ŀ¼�µ������ļ�
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
     * ���ش�����Ϣ
     *
     * @param string $numero ������Ϣ
     * @return string ����һ�����ַ���
     */
    function message($numero) {
        $message['err_compress'] = $cmsg['dump_err_compress'];
        $message['err_file'] = $cmsg['dump_err_file'];
        $message['err_base'] = $cmsg['dump_err_base'];
        $message['err_mysql'] = $cmsg['dump_err_mysql'];
        return $message[$numero];
    }

    /**
     * ΪSQL�����ļ���� header ע�ͼ���������Ϣ
     *
     * @return string ע��
     */
    function addHeadComment() {
        if ($this->format_out<>"no_comment") {
            $server_info = mysql_get_server_info($this->link);
            return  "-- MYSQL ���ݿⱸ�� \n"
                . "-- version $this->version \n"
                . "-- http://www.zhqiao.cn \n"
                . "-- \n"
                . "-- ����: $this->dbhost \n"
                . "-- ��������: ".date("Y �� m �� d �� H:i:s")." \n"
                . "-- �������汾: $server_info \n"
                . "-- \n"
                . "--  ���ݿ�: $this->dbname \n"
                . "--  �ַ���: $this->dbcharset \n"
                . "-- \n\n"
                . "-- --------------------------------------------------------\n";
        }
    }

    /**
     * ΪSQL�����ļ��Ĵ������ݿ�ṹ�������ע��
     *
     * @param string $tablename ���ݿ����
     * @return string ע��
     */
    function addStruComment($tablename) {
        if ($this->format_out<>"no_comment") {
            return  "--\n"
                . "-- �������е����� '$tablename' \n"
                . "--\n"
                . "\n";
        }
    }

    /**
     * ΪSQL�����ļ��ĵ������ݲ������ע��
     *
     * @param string $tablename ���ݿ����
     * @return string ע��
     */
    function addRecoveryComment ($tablename) {
        if ($this->format_out<>"no_comment") {
            return "--\n"
                . "-- �������е����� '$tablename' \n"
                . "--\n"
                . "\n";
        }
    }
}