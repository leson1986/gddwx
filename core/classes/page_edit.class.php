<?php
/***********************************************************
 * Document Type: Classes
 * Update: 2006/11/08
 * Author: Akon
 * Remark: ڱ༭/
 ***********************************************************/

class PageEdit {

    var $PageTitle;        // ҳ
    var $BackPage;         // صҳ
    var $PageType;         // ҳ edit/add
    var $TableName;        // 
    var $Condition;        // ѯ
    var $QuerySQL;         // ִеSQL
    var $QueryRes;
    var $QueryRow;

    // ------------------------------------------------
    // 趨ʾϢ
    // ------------------------------------------------
    var $_must_table;
    var $_must_condition;
    var $_record_inexistent;
    var $_update_successful;
    var $_update_failed;
    var $_insert_successful;
    var $_insert_failed;
    var $_back_list;

    // ------------------------------------------------
    // 캯
    // ------------------------------------------------
    function PageEdit($PageTitle, $BackPage, $PageType="edit") {
        global $cmsg;
        $this->PageTitle = $PageTitle;
        $this->BackPage = $BackPage;
        $this->PageType = $PageType;
        $this->_must_table = $cmsg["edit_must_table"];
        $this->_must_condition = $cmsg["edit_must_condition"];
        $this->_record_inexistent = $cmsg["edit_record_inexistent"];
        $this->_update_successful = $cmsg["edit_update_successful"];
        $this->_update_failed = $cmsg["edit_update_failed"];
        $this->_insert_successful = $cmsg["edit_insert_successful"];
        $this->_insert_failed = $cmsg["edit_insert_failed"];
        $this->_back_list = $cmsg["edit_back_list"];
    }

    // ------------------------------------------------
    // û
    // ------------------------------------------------
    function SetParam($TableName, $Condition="") {
        global $db;
        $this->TableName = $TableName;
        $this->Condition = $Condition;
        if (empty($this->TableName)) $this->FeedBack($this->_must_table);
        elseif (empty($this->Condition) && $this->PageType=="edit") $this->FeedBack($this->_must_condition);
        elseif ($this->PageType=="edit"){
            $this->QuerySQL = "SELECT * FROM `{$this->TableName}` {$this->Condition}";
            $this->QueryRes = $db->query($this->QuerySQL);
            if (!$db->num_rows($this->QueryRes)) $this->FeedBack($this->_record_inexistent);
            else $this->QueryRow = $db->fetch_array($this->QueryRes);
        }
    }

    // ------------------------------------------------
    //  Update SQL 
    // ------------------------------------------------
    function BuildUpdateSQL($FieldsArr) {
        foreach ($FieldsArr as $k=>$v) {
            if (!empty($SqlStr)) $SqlStr .= ", ";
            $SqlStr .= "`{$k}`='{$v}'";
        }
        return "UPDATE `{$this->TableName}` SET {$SqlStr} {$this->Condition}";
    }

    // ------------------------------------------------
    //  Insert SQL 
    // ------------------------------------------------
    function BuildInsertSQL($FieldsArr) {
        foreach ($FieldsArr as $k=>$v) {
            if (!empty($keys) && !empty($vals)) {
                $keys .= ", "; $vals .= ", ";
            }
            $keys .= "`{$k}`"; $vals .= "'{$v}'";
        }
        return "INSERT INTO `{$this->TableName}` ({$keys}) VALUES ({$vals})";
    }

    // ------------------------------------------------
    //  SQL 
    // ------------------------------------------------
    function DebugSQL($FieldsArr) {
        if (is_array($FieldsArr)) echo $this->PageType=="edit" ? $this->BuildUpdateSQL($FieldsArr) : $this->BuildInsertSQL($FieldsArr);
    }

    // ------------------------------------------------
    // 
    // ------------------------------------------------
    function UpdateData($FieldsArr) {
        global $db, $cmsg;
        if (is_array($FieldsArr)) {
            $Query = $db->query($this->BuildUpdateSQL($FieldsArr));
            if ($Query) $this->feedback($this->_update_successful, $this->BackPage, $this->_back_list);
            else $this->FeedBack($this->_update_failed);
        }
    }

    // ------------------------------------------------
    // 
    // ------------------------------------------------
	
    function InsertData($FieldsArr) {
        global $db, $cmsg;
        if (is_array($FieldsArr)) {
            $Query = $db->query($this->BuildInsertSQL($FieldsArr));
            if ($Query) $this->feedback($this->_insert_successful, $this->BackPage, $this->_back_list);
            else $this->FeedBack($this->_insert_failed);
        }
    }

    // ------------------------------------------------
    // ݵģ
    // ------------------------------------------------
    function TplParseRow() {
        global $tpl;
        if (is_array($this->QueryRow) && $this->PageType=="edit") {
            foreach ($this->QueryRow as $k => $v) $tpl->assign($k, $v);
        }
    }

    // ------------------------------------------------
    // ģϢ
    // ------------------------------------------------
    function TplParse($TplPage) {
        global $tpl,$charset;
        @header("Content-type: text/html; charset={$charset}");
        $this->TplParseRow();
        $tpl->assign('page_title', $this->PageTitle);
        $tpl->assign('back_page', $this->BackPage);
        $tpl->display($TplPage);
    }

    // ------------------------------------------------
    // 󱨸
    // ------------------------------------------------
    function FeedBack($HaltMsg, $Url="javascript:history.go(-1);", $UrlTip='') {
        global $clang;
        if (empty($url_tip)) $url_tip = $clang['goto_back'];
        feedback($HaltMsg, $Url, $UrlTip);
    }
}
