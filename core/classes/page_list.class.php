<?php
/***********************************************************
 * Document Type: Classes
 * Update: 2006/11/08
 * Author: Akon
 * Remark: 用于页面数据显示
 ***********************************************************/

include_once ( __CLASS_PATH . 'page.class.php' );

Class PageList {

    var $PageTitle;     // 页面标题
    var $PageSize;      // 每页显示的记录条数
    var $CurrPage;      // 当前页
    var $QuerySQL;      // 需要执行的 SQL 语句
    var $QueryRes;
    var $RowResult;
    var $PageList;      // 输出的分页效果
    var $UrlParam;      // URL 链接需要传递的参数
    var $SearchKey;     // 搜索字段数组
    var $SearchArr;     // 搜索字段数组
    var $SearchJunk;    // 搜索SQL子句条件串
    var $PageResult;    // 显示的分页结果
    var $SortOpen;      // 是否开启页面排序功能
    var $HavePage;
    var $SortBy;
    var $oExp;
    var $SortUrlParam;
    var $RowName = "row_result";

    // ------------------------------------------------
    // 构造函数
    // ------------------------------------------------
    function PageList($PageTitle="", $PageSize="") {
        $this->PageTitle = $PageTitle;
        $this->PageSize = $PageSize;
        $this->CurrPage = is_numeric($_REQUEST["page"]) ? $_REQUEST["page"] : 1;
        $this->SearchKey = addslashes(substr($_REQUEST["keyword"],0,150));
        $this->SortOpen = false;
        $this->HavePage = empty($PageSize) ? false : true;
        $SortBy = addslashes($_REQUEST["sortby"]);
        $oExp = strtoupper(addslashes($_REQUEST["oexp"]));
        if (!empty($SortBy) && ($oExp=="DESC" || $oExp=="ASC")) {
            $this->SortBy = $SortBy;
            $this->oExp = $oExp;
        }
    }

    // ------------------------------------------------
    // 设置排序
    // ------------------------------------------------
    function SetSort($SortBy="", $oExp="desc") {
        if (empty($_REQUEST["sortby"])) {
            $this->SortBy = $SortBy;
            $this->oExp = strtoupper($oExp);
        }
    }

    // -----------------------------------------------
    // 设置搜索条件
    // -----------------------------------------------
    function SetSearch($SearchArr, $SearchJunk="") {
        $this->SearchArr = $SearchArr;
        $this->SearchJunk = $SearchJunk;
    }

    // -----------------------------------------------
    // 设置每页显示的记录数
    // -----------------------------------------------
    function SetPageSize($PageSize) {
        $this->PageSize = $PageSize;
        $this->HavePage = true;
    }

    // ------------------------------------------------
    // 获取排序链接地址
    // ------------------------------------------------
    function GetSortUrl() {
        if ($this->SortOpen) {
            $SortUrl = "sortby={$this->SortBy}&amp;oexp=".strtolower($this->oExp);
            $this->SortUrlParam = empty($this->UrlParam) ? $SortUrl : $SortUrl ."&amp;" . $this->UrlParam;
        }
        else $this->SortUrlParam = $this->UrlParam;
        return $this->SortUrlParam;
    }

    // ------------------------------------------------
    // 获取URL传递的参数
    // ------------------------------------------------
    function SetUrlParam($UrlParamArr) {
        if (is_array($UrlParamArr)) {
            foreach ($UrlParamArr as $Para) {
                if (!empty($_REQUEST[$Para])) {
                    if (!empty($this->UrlParam)) $this->UrlParam .= "&amp;";
                    $this->UrlParam .= "{$Para}=" . urlencode($_REQUEST[$Para]);
                }
            }
        }
    }

    // ------------------------------------------------
    // 生成排序SQL语句
    // ------------------------------------------------
    function BuildOrderSQL() {
        return empty($this->SortBy) ? "" : " ORDER BY `{$this->SortBy}` {$this->oExp}";
    }

    // ------------------------------------------------
    // 生成搜索SQL语句
    // ------------------------------------------------
    function BuildSearchSQL() {
        $this->SearchJunk = strtoupper($this->SearchJunk);
        if (is_array($this->SearchArr)) {
            $First = true;
            foreach ($this->SearchArr as $key=>$val) {
                if (is_array($val)) {
                    $Junk = $val["junk"]!="and" && $val["junk"]!="or" ? "" : strtoupper($val["junk"]);
                    $Field = $val["field"];
                    $Condition = strtoupper($val["condition"]);
                    $Keyword = $val["keyword"];
                    if (!empty($Field) && !empty($Condition) && !empty($Keyword)) {
                        if ($First) {
                            $Junk = "";
                            $First = false;
                        }
                        else $Junk = " {$Junk}";
                        switch ($Condition) { // LIKE , < , > , = , <> ,
                            case "LIKE": $SqlClause .= "{$Junk} `{$Field}` LIKE '%{$Keyword}%'"; break;
                            case "<":
                            case ">":
                            case "=":
                            case "<>": $SqlClause .= "{$Junk} `{$Field}`{$Condition}'{$Keyword}'"; break;
                        }
                    }
                }
            }
            if (!empty($SqlClause) && ($this->SearchJunk=="AND" || $this->SearchJunk=="OR")) $SqlClause = " {$this->SearchJunk} ({$SqlClause})";
            return $SqlClause;
        }
    }

    // ------------------------------------------------
    // 生成最后的SQL语句
    // ------------------------------------------------
    function BuildSQL() {
        return $this->QuerySQL . $this->BuildSearchSQL() . $this->BuildOrderSQL();
    }

    // ------------------------------------------------
    // 执行查询
    // ------------------------------------------------
    function Execute($QuerySQL) {
        global $db;
        $this->QuerySQL = $QuerySQL;
        if ($this->HavePage) {
            $page = new Page();
            $page->BuildPage($this->BuildSQL(), $this->PageSize, $this->GetSortUrl());
            $this->PageList = $page->GetPageList();
            $this->QuerySQL = $page->GetLimitSQL();
        }
        $this->QueryRes = $db->query($this->QuerySQL);
        while ($row = $db->fetch_array($this->QueryRes)) $this->RowResult[] = $row;
    }
    function Execute_en($QuerySQL) {
        global $db;
        $this->QuerySQL = $QuerySQL;
        if ($this->HavePage) {
            $page = new Page();
            $page->BuildPage($this->BuildSQL(), $this->PageSize, $this->GetSortUrl());
            $this->PageList = $page->GetPageList_en();
            $this->QuerySQL = $page->GetLimitSQL();
        }
        $this->QueryRes = $db->query($this->QuerySQL);
        while ($row = $db->fetch_array($this->QueryRes)) $this->RowResult[] = $row;
    }
    // ------------------------------------------------
    // 解析模板排序信息
    // ------------------------------------------------
    function TplParseSort() {
        global $tpl;
        $oExp = $this->oExp=="DESC" ? "asc" : "desc";
        if (is_array($this->RowResult)) {
            foreach ($this->RowResult as $key => $val) {
                if (is_array($val)) {
                    foreach ($val as $k => $v) {
                        if (!empty($this->UrlParam)) $UrlParam = "{$this->UrlParam}&amp;";
                        $tpl->assign("sort_{$k}", "?{$UrlParam}sortby={$k}&amp;oexp={$oExp}&amp;page={$this->CurrPage}");
                    }
                }
            }
        }
    }

    // ------------------------------------------------
    // 解析模板信息
    // ------------------------------------------------
    function TplParse($TplPage="") {
        global $tpl,$charset;
        @header("Content-type: text/html; charset={$charset}");
        if ($this->SortOpen) $this->TplParseSort();
        $tpl->assign('page_title', $this->PageTitle);
        $tpl->assign('url_param', $this->UrlParam);
        $tpl->assign('search_key', $this->SearchKey);
        $tpl->assign($this->RowName, $this->RowResult);
        $this->RowResult = "";
        if ($this->HavePage) {
            $tpl->assign('sort_url_param', $this->SortUrlParam);
            $tpl->assign('curr_page', $this->CurrPage);
            $tpl->assign('page_list', $this->PageList);
        }
        if (!empty($TplPage)) $tpl->display($TplPage);
    }
    function TplParse_en($TplPage="") {
        global $tpl,$charset;
        @header("Content-type: text/html; charset={$charset}");
        if ($this->SortOpen) $this->TplParseSort();
        $tpl->assign('page_title', $this->PageTitle);
        $tpl->assign('url_param', $this->UrlParam);
        $tpl->assign('search_key', $this->SearchKey);
        $tpl->assign($this->RowName, $this->RowResult);
        $this->RowResult = "";
        if ($this->HavePage) {
            $tpl->assign('sort_url_param', $this->SortUrlParam);
            $tpl->assign('curr_page', $this->CurrPage);
            $tpl->assign('page_list', $this->PageList);
        }
        if (!empty($TplPage)) $tpl->display($TplPage);
    }
}
