<?php
/***********************************************************
 * Document Type: Classes
 * Update: 2006/11/06
 * Author: Akon
 * Remark: Mysql数据库的分页类
 ***********************************************************/

Class Page {

    var $PageSize;      // 每页显示多少条
    var $CurrPage;      // 当前页
    var $PageCount;     // 共多少页
    var $RecordCount;   // 共多少条记录
    var $SQL;           // 需要执行查询的 SQL 语句
    var $UrlVal;        // 需要传递的URL

    // ------------------------------------------------
    // 创建分页
    // ------------------------------------------------
    function BuildPage($SQL, $PageSize=15, $UrlVal="") {
        global $db;
        $this->SQL = $SQL;
        $this->PageSize = is_numeric($PageSize) ? $PageSize : 15;
        $query = $db->query($this->SQL);
        $this->RecordCount = $db-> num_rows($query);
        $this->PageCount = ceil($this->RecordCount/$this->PageSize);
        $this->CurrPage = $this->GetCurrPage();
        $this->UrlVal = empty($UrlVal) ? "?page=" : "?{$UrlVal}&amp;page=";
    }

    // ------------------------------------------------
    // 获取分面后的 SQL 语句
    // ------------------------------------------------
    function GetLimitSQL() {
        return $this->SQL . " LIMIT " . (($this->CurrPage-1) * $this->PageSize) . ',' . $this->PageSize;
    }

    // ------------------------------------------------
    // 获取当前页
    // ------------------------------------------------
    function GetCurrPage() {
        $CurrPage = intval($_REQUEST["page"]);
        if (empty($CurrPage)) $CurrPage = 1;
        if ($CurrPage>$this->PageCount) $CurrPage = $this->PageCount;
        if ($CurrPage<1) $CurrPage = 1;
        return $CurrPage;
    }

    // ------------------------------------------------
    // 获取最后的分页内容
    // ------------------------------------------------
    function GetPageList() {
        global $cmsg;
        $BtnName = "pageBtn"; $CurrName = "currBtn"; $FirstName = "firstBtn"; $LastName = "lastBtn";
        $OutPut .= "<a href='{$this->UrlVal}1' class=\"{$FirstName}\">&lt;&lt;</a>\n";
        if ($this->CurrPage < 6 || $this->PageCount<10) {
            for ($i = 1; $i < 10; $i++) {
                $OutPut .= "<a href='{$this->UrlVal}{$i}' class=\"" ;
                $OutPut .= $this->CurrPage==$i ? $CurrName : $BtnName;
                $OutPut .= "\">{$i}</a>\n";
                if ($i>=$this->PageCount) break;
            }
        }
        elseif ($this->CurrPage > 5 && $this->CurrPage < $this->PageCount - 4) {
            for ($i = $this->CurrPage-4; $i < $this->CurrPage+5; $i++) {
                $OutPut .= "<a href='{$this->UrlVal}{$i}' class=\"" ;
                $OutPut .= $this->CurrPage==$i ? $CurrName : $BtnName;
                $OutPut .= "\">{$i}</a>\n";
                if ($i>=$this->PageCount) break;
            }
        }
        elseif ($this->CurrPage + 5 > $this->PageCount) {
            for ($i = $this->PageCount-8; $i < $this->PageCount+1; $i++) {
                if ($i>1) {
                    $OutPut .= "<a href='{$this->UrlVal}{$i}' class=\"" ;
                    $OutPut .= $this->CurrPage==$i ? $CurrName : $BtnName;
                    $OutPut .= "\">{$i}</a>\n";
                }
            }
        }
        $OutPut .= "<a href='{$this->UrlVal}{$this->PageCount}' class=\"{$LastName}\">&gt;&gt;</a>\n";
        $OutPut .= "<span class=\"pageInfo\">{$cmsg['page_total']}";
        $OutPut .= "<span class=\"pageNum\">{$this->CurrPage}</span>/";
        $OutPut .= "<span class=\"pageNum\">{$this->PageCount}</span>{$cmsg['page_pages']}";
        $OutPut .= "<span class=\"pageNum\">{$this->PageSize}</span>/";
        $OutPut .= "<span class=\"pageNum\">{$this->RecordCount}</span>{$cmsg['page_records']}</span>";
        return "\n<span class=\"page_list\">\n{$OutPut}\n</span>\n";
    }
	
	    function GetPageList_en() {
        global $cmsg;
        $BtnName = "pageBtn"; $CurrName = "currBtn"; $FirstName = "firstBtn"; $LastName = "lastBtn";
        $OutPut .= "<a href='{$this->UrlVal}1' class=\"{$FirstName}\">&lt;&lt;</a>\n";
        if ($this->CurrPage < 6 || $this->PageCount<10) {
            for ($i = 1; $i < 10; $i++) {
                $OutPut .= "<a href='{$this->UrlVal}{$i}' class=\"" ;
                $OutPut .= $this->CurrPage==$i ? $CurrName : $BtnName;
                $OutPut .= "\">{$i}</a>\n";
                if ($i>=$this->PageCount) break;
            }
        }
        elseif ($this->CurrPage > 5 && $this->CurrPage < $this->PageCount - 4) {
            for ($i = $this->CurrPage-4; $i < $this->CurrPage+5; $i++) {
                $OutPut .= "<a href='{$this->UrlVal}{$i}' class=\"" ;
                $OutPut .= $this->CurrPage==$i ? $CurrName : $BtnName;
                $OutPut .= "\">{$i}</a>\n";
                if ($i>=$this->PageCount) break;
            }
        }
        elseif ($this->CurrPage + 5 > $this->PageCount) {
            for ($i = $this->PageCount-8; $i < $this->PageCount+1; $i++) {
                if ($i>1) {
                    $OutPut .= "<a href='{$this->UrlVal}{$i}' class=\"" ;
                    $OutPut .= $this->CurrPage==$i ? $CurrName : $BtnName;
                    $OutPut .= "\">{$i}</a>\n";
                }
            }
        }
        $OutPut .= "<a href='{$this->UrlVal}{$this->PageCount}' class=\"{$LastName}\">&gt;&gt;</a>\n";
        $OutPut .= "<span class=\"pageInfo\">{$cmsg['page_total_en']}";
        $OutPut .= "<span class=\"pageNum\">{$this->CurrPage}</span>/";
        $OutPut .= "<span class=\"pageNum\">{$this->PageCount}</span>{$cmsg['page_pages_en']}";
        $OutPut .= "<span class=\"pageNum\">{$this->PageSize}</span>/";
        $OutPut .= "<span class=\"pageNum\">{$this->RecordCount}</span>{$cmsg['page_records_en']}</span>";
        return "\n<span class=\"page_list\">\n{$OutPut}\n</span>\n";
    }
}