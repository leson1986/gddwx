<?php
/***********************************************************
 * Document Type: Classes
 * Update: 2006/11/06
 * Author: Akon
 * Remark: MYSQL ����װ��
 ***********************************************************/

class dbstuff {

    /**
     * ִ�в�ѯ����
     *
     * @var integer
     */
    var $querynum = 0;

    /**
     * ��һ���� MySQL ������������
     *
     * @param string $dbhost    ���ݿ������,���԰����˿ں�
     * @param string $dbuser    ���ݿ��û���
     * @param string $dbpw      ���ݿ�����
     * @param string $dbname    ���ݿ���
     * @param boolean $pconnect ���ݿ�־����� 0=�ر�, 1=��
     */
    function connect($dbhost, $dbuser, $dbpw, $dbname = '', $dbcharset, $pconnect = 0) {
        if($pconnect) {
            if(!@mysql_pconnect($dbhost, $dbuser, $dbpw))
                $this->halt('Can not connect to MySQL server');
        }
        else {
            if(!@mysql_connect($dbhost, $dbuser, $dbpw))
                $this->halt('Can not connect to MySQL server');
        }
        if($this->version() > '4.1') {
            if(!$dbcharset && in_array(strtolower($charset), array('gbk', 'big5', 'utf-8'))) {
                $dbcharset = str_replace('-', '', $charset);
            }
            if($dbcharset)
                mysql_query("SET character_set_connection=$dbcharset, character_set_results=$dbcharset, character_set_client=binary");
            if($this->version() > '5.0.1')
                mysql_query("SET sql_mode=''");
        }
        if($dbname)
            mysql_select_db($dbname);
    }

    /**
     * ��ָ�������ݿ�
     *
     * @param string $dbname    ���ݿ���
     * @return boolean  ����ɹ��򷵻� TRUE��ʧ���򷵻� FALSE
     */
    function select_db($dbname) {
        return mysql_select_db($dbname);
    }

    /**
     * �ӽ������ȡ��һ����Ϊ�������飬���������飬����߼���
     *
     * @param resource $result      �����
     * @param integer $result_type  (MYSQL_BOTH),MYSQL_ASSOC,MYSQL_NUM
     * @return mixed    ���ظ��ݴӽ����ȡ�õ������ɵ����飬���û�и������򷵻� FALSE��
     */
    function fetch_array($result, $result_type = MYSQL_ASSOC) {
        return mysql_fetch_array($result, $result_type);
    }

    /**
     * ����һ�� MySQL ��ѯ
     *
     * @param string $sql   SQL��ѯ���
     * @param string $type
     * @return resource ����һ����ѯ�����
     */
    function query($sql, $type = '') {
        global $debug, $discuz_starttime, $sqldebug;
        $func = $type == 'UNBUFFERED' && @function_exists('mysql_unbuffered_query') ?
            'mysql_unbuffered_query' : 'mysql_query';
        if(!($query = $func($sql)) && $type != 'SILENT')
            $this->halt('MySQL Query Error', $sql);
        $this->querynum++;
        return $query;
    }

    /**
     * ȡ��ǰһ�β�����Ӱ��ļ�¼����
     *
     * @return integer
     */
    function affected_rows() {
        return mysql_affected_rows();
    }

    /**
     * ������һ�������������ı�������Ϣ
     *
     * @return string
     */
    function error() {
        return mysql_error();
    }

    /**
     * ������һ�������еĴ�����Ϣ�����ֱ���
     *
     * @return integer
     */
    function errno() {
        return intval(mysql_errno());
    }

    /**
     * ȡ�ý������
     *
     * @param resource $result  �����
     * @param integer $row  �ֶ�
     * @return mixed    ���ؽ������һ����Ԫ������
     */
    function result($result, $row) {
        $result = @mysql_result($result, $row);
        return $result;
    }

    /**
     * �г����ݿ��еı�
     *
     * @param string $database  ���ݿ�
     * @return resource �������ݿ��еı��False
     */
    function list_tables($database) {
        return @mysql_list_tables($database);
    }

    /**
     * ȡ�ñ���
     *
     * @param resource $result  �����
     * @param integer $i
     * @return string   ����
     */
    function tablename($result,$i) {
        return mysql_tablename($result,$i);
    }

    /**
     * ȡ�ý�������е���Ŀ
     *
     * @param resource $result  �����
     * @return integer
     */
    function num_rows($result) {
        return mysql_num_rows($result);
    }

    /**
     * ȡ�ý�������ֶε���Ŀ
     *
     * @param resource $result  �����
     * @return integer
     */
    function num_fields($result) {
        return mysql_num_fields($result);
    }

    /**
     * �ͷŽ���ڴ�
     *
     * @param resource $result  �����
     * @return boolean  �ɹ�����TRUE,ʧ�ܷ���FALSE
     */
    function free_result($result) {
        return mysql_free_result($result);
    }

    /**
     * ȡ����һ�� INSERT ���������� ID
     *
     * @return integer
     */
    function insert_id() {
        return mysql_insert_id();
    }

    /**
     *  �ӽ������ȡ��һ����Ϊö������
     *
     * @param resource $result  �����
     * @return array    ���ظ�����ȡ�õ������ɵ�����,û�и������򷵻�FALSE
     */
    function fetch_row($result) {
        return mysql_fetch_row($result);
    }

    /**
     * �������ȡ������Ϣ����Ϊ���󷵻�
     *
     * @param resource $result  �����
     * @return object   ����һ�������ֶ���Ϣ�Ķ���
     */
    function fetch_fields($result) {
        return mysql_fetch_field($result);
    }

    /**
     * ȡ�� MySQL ��������Ϣ
     *
     * @return string   ������ʹ�õķ������汾
     */
    function version() {
        return mysql_get_server_info();
    }

    /**
     * �ر����ݿ�����
     *
     * @return boolean  �ɹ�����TRUE,ʧ�ܷ���FALSE
     */
    function close() {
        return mysql_close();
    }

    /**
     * �ж����
     *
     * @param string $message   ��Ҫ���������
     * @param string $sql       �жϵ�SQL���
     */
    function halt($message = '', $sql = '') {
        require ( __CLASS_PATH . '/db_mysql_error.inc.php' );
    }
	
	function getOne($sql, $limited = false)
    {
        if ($limited == true)
        {
            $sql = trim($sql . ' LIMIT 1');
        }

        $res = $this->query($sql);
        if ($res !== false)
        {
            $row = mysql_fetch_row($res);

            if ($row !== false)
            {
                return $row[0];
            }
            else
            {
                return '';
            }
        }
        else
        {
            return false;
        }
    }
	
	
	
	function getAll($sql)
    {
        $res = $this->query($sql);
        if ($res !== false)
        {
            $arr = array();
            while ($row = mysql_fetch_assoc($res))
            {
                $arr[] = $row;
            }

            return $arr;
        }
        else
        {
            return false;
        }
    }

/*
���Է�����������
*/
    function db_query($sql)
    {
       if(empty($sql)) return false;					
       return mysql_query($sql);
    }
	function insert($sql = ""){
		$results = $this->db_query($sql);
		if (!$results)
			return 0;
		else
			return @mysql_insert_id();
	}
function insertData($tablename,$data)
	{
        foreach ($data as $k=>$v) {
            if (!empty($keys) && !empty($vals)) {
                $keys .= ", "; $vals .= ", ";
            }
            $keys .= "`{$k}`"; $vals .= "'{$v}'";
        }
		$sql = "INSERT INTO " . $tablename . "(" . $keys . ") VALUES (" . $vals . ")";
        
		return $this->insert($sql);
	}
}
?>