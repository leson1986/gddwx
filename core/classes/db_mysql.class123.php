<?php
/***********************************************************
 * Document Type: Classes
 * Update: 2006/11/06
 * Author: Akon
 * Remark: MYSQL װ
 ***********************************************************/

class dbstuff {

    /**
     * ִвѯ
     *
     * @var integer
     */
    var $querynum = 0;

    /**
     * һ MySQL 
     *
     * @param string $dbhost    ݿ,԰˿ں
     * @param string $dbuser    ݿû
     * @param string $dbpw      ݿ
     * @param string $dbname    ݿ
     * @param boolean $pconnect ݿ־ 0=ر, 1=
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
     * ָݿ
     *
     * @param string $dbname    ݿ
     * @return boolean  ɹ򷵻 TRUEʧ򷵻 FALSE
     */
    function select_db($dbname) {
        return mysql_select_db($dbname);
    }

    /**
     * ӽȡһΪ飬飬߼
     *
     * @param resource $result      
     * @param integer $result_type  (MYSQL_BOTH),MYSQL_ASSOC,MYSQL_NUM
     * @return mixed    ظݴӽȡõɵ飬ûи�?FALSE
     */
    function fetch_array($result, $result_type = MYSQL_ASSOC) {
        return mysql_fetch_array($result, $result_type);
    }

    /**
     * һ MySQL ѯ
     *
     * @param string $sql   SQLѯ
     * @param string $type
     * @return resource һѯ
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
     * ȡǰһβӰļ¼
     *
     * @return integer
     */
    function affected_rows() {
        return mysql_affected_rows();
    }

    /**
     * һıϢ
     *
     * @return string
     */
    function error() {
        return mysql_error();
    }

    /**
     * һеĴϢֱ
     *
     * @return integer
     */
    function errno() {
        return intval(mysql_errno());
    }

    /**
     * ȡý
     *
     * @param resource $result  
     * @param integer $row  ֶ
     * @return mixed    ؽһԪ
     */
    function result($result, $row) {
        $result = @mysql_result($result, $row);
        return $result;
    }

    /**
     * гݿеı
     *
     * @param string $database  ݿ
     * @return resource ݿеıFalse
     */
    function list_tables($database) {
        return @mysql_list_tables($database);
    }

    /**
     * ȡñ
     *
     * @param resource $result  
     * @param integer $i
     * @return string   
     */
    function tablename($result,$i) {
        return mysql_tablename($result,$i);
    }

    /**
     * ȡýеĿ
     *
     * @param resource $result  
     * @return integer
     */
    function num_rows($result) {
        return mysql_num_rows($result);
    }

    /**
     * ȡýֶεĿ
     *
     * @param resource $result  
     * @return integer
     */
    function num_fields($result) {
        return mysql_num_fields($result);
    }

    /**
     * ͷŽڴ
     *
     * @param resource $result  
     * @return boolean  ɹTRUE,ʧܷFALSE
     */
    function free_result($result) {
        return mysql_free_result($result);
    }

    /**
     * ȡһ INSERT  ID
     *
     * @return integer
     */
    function insert_id() {
        return mysql_insert_id();
    }

    /**
     *  ӽȡһΪö
     *
     * @param resource $result  
     * @return array    ظȡõɵ,ûи򷵻FALSE
     */
    function fetch_row($result) {
        return mysql_fetch_row($result);
    }

    /**
     * ȡϢΪ󷵻
     *
     * @param resource $result  
     * @return object   һֶϢĶ
     */
    function fetch_fields($result) {
        return mysql_fetch_field($result);
    }

    /**
     * ȡ MySQL Ϣ
     *
     * @return string   ʹõķ�?
     */
    function version() {
        return mysql_get_server_info();
    }

    /**
     * رݿ
     *
     * @return boolean  ɹTRUE,ʧܷFALSE
     */
    function close() {
        return mysql_close();
    }

    /**
     * ж
     *
     * @param string $message   Ҫ
     * @param string $sql       жϵSQL
     */
    function halt($message = '', $sql = '') {
        require ( __CLASS_PATH . '/db_mysql_error.inc.php' );
    }
	
	    /**
     * 新的数据处理函数
     * add by tim    
     */
    //查询数据�?
    function db_query($sql)
    {
       if(empty($sql)) return false;					//如果SQL语句为空则返回FALSE
       return mysql_query($sql);
    }


	/**
	 * 功能：数据插入函�?
	 * 参数�?sql SQL语句
	 * 返回�?或新插入数据的ID
	 */
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
        //echo $sql;exit;
		return $this->insert($sql);
	}
	
	
}


?>