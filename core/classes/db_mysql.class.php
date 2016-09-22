<?php
/***********************************************************
 * Document Type: Classes
 * Update: 2006/11/06
 * Author: Akon
 * Remark: MYSQL 语句封装类
 ***********************************************************/

class dbstuff {

    /**
     * 执行查询次数
     *
     * @var integer
     */
    var $querynum = 0;

    /**
     * 打开一个到 MySQL 服务器的连接
     *
     * @param string $dbhost    数据库服务器,可以包括端口号
     * @param string $dbuser    数据库用户名
     * @param string $dbpw      数据库密码
     * @param string $dbname    数据库名
     * @param boolean $pconnect 数据库持久连接 0=关闭, 1=打开
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
     * 打开指定的数据库
     *
     * @param string $dbname    数据库名
     * @return boolean  如果成功则返回 TRUE，失败则返回 FALSE
     */
    function select_db($dbname) {
        return mysql_select_db($dbname);
    }

    /**
     * 从结果集中取得一行作为关联数组，或数字数组，或二者兼有
     *
     * @param resource $result      结果集
     * @param integer $result_type  (MYSQL_BOTH),MYSQL_ASSOC,MYSQL_NUM
     * @return mixed    返回根据从结果集取得的行生成的数组，如果没有更多行则返回 FALSE。
     */
    function fetch_array($result, $result_type = MYSQL_ASSOC) {
        return mysql_fetch_array($result, $result_type);
    }

    /**
     * 发送一条 MySQL 查询
     *
     * @param string $sql   SQL查询语句
     * @param string $type
     * @return resource 返回一个查询结果集
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
     * 取得前一次操作所影响的记录行数
     *
     * @return integer
     */
    function affected_rows() {
        return mysql_affected_rows();
    }

    /**
     * 返回上一个操作产生的文本错误信息
     *
     * @return string
     */
    function error() {
        return mysql_error();
    }

    /**
     * 返回上一个操作中的错误信息的数字编码
     *
     * @return integer
     */
    function errno() {
        return intval(mysql_errno());
    }

    /**
     * 取得结果数据
     *
     * @param resource $result  结果集
     * @param integer $row  字段
     * @return mixed    返回结果集中一个单元的内容
     */
    function result($result, $row) {
        $result = @mysql_result($result, $row);
        return $result;
    }

    /**
     * 列出数据库中的表
     *
     * @param string $database  数据库
     * @return resource 返回数据库中的表或False
     */
    function list_tables($database) {
        return @mysql_list_tables($database);
    }

    /**
     * 取得表名
     *
     * @param resource $result  结果集
     * @param integer $i
     * @return string   表名
     */
    function tablename($result,$i) {
        return mysql_tablename($result,$i);
    }

    /**
     * 取得结果集中行的数目
     *
     * @param resource $result  结果集
     * @return integer
     */
    function num_rows($result) {
        return mysql_num_rows($result);
    }

    /**
     * 取得结果集中字段的数目
     *
     * @param resource $result  结果集
     * @return integer
     */
    function num_fields($result) {
        return mysql_num_fields($result);
    }

    /**
     * 释放结果内存
     *
     * @param resource $result  结果集
     * @return boolean  成功返回TRUE,失败返回FALSE
     */
    function free_result($result) {
        return mysql_free_result($result);
    }

    /**
     * 取得上一步 INSERT 操作产生的 ID
     *
     * @return integer
     */
    function insert_id() {
        return mysql_insert_id();
    }

    /**
     *  从结果集中取得一行作为枚举数组
     *
     * @param resource $result  结果集
     * @return array    返回根据所取得的行生成的数组,没有更多行则返回FALSE
     */
    function fetch_row($result) {
        return mysql_fetch_row($result);
    }

    /**
     * 结果集中取得列信息并作为对象返回
     *
     * @param resource $result  结果集
     * @return object   返回一个包含字段信息的对象。
     */
    function fetch_fields($result) {
        return mysql_fetch_field($result);
    }

    /**
     * 取得 MySQL 服务器信息
     *
     * @return string   返回所使用的服务器版本
     */
    function version() {
        return mysql_get_server_info();
    }

    /**
     * 关闭数据库连接
     *
     * @return boolean  成功返回TRUE,失败返回FALSE
     */
    function close() {
        return mysql_close();
    }

    /**
     * 中断输出
     *
     * @param string $message   需要输出的内容
     * @param string $sql       中断的SQL语句
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
留言反馈函数调用
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