<?php
    require ( 'init.inc.php' );
    require ( __COMM_PATH . 'checkadmin.inc.php' );
    require ( __COMM_PATH . 'pagecontrol.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );
	
	
    // -------------------------------------------------------
    // ���մ��ݹ����ı���
    // -------------------------------------------------------
    $id = addslashes($_REQUEST["id"]);
	$action = $_REQUEST["action"];
	
    // -------------------------------------------------------
    // ��������(ɾ��,���,ȡ�����)
    // -------------------------------------------------------
    if (!empty($id)) {
        switch ($action) {
            case "del" : $db->query("delete from `{$tablepre}reply` where id in ($id)"); break;
            case "confirm" : $db->query("update `{$tablepre}reply` set `status`=1 where id in ($id)"); break;
            case "deconfirm" : $db->query("update `{$tablepre}reply` set `status`=0 where id in ($id)"); break;
        }
    }
	
	// -------------------------------------------------------
    // ҳ���������
    // -------------------------------------------------------
	
    $page_title   = $ptitle["reply_list"];
    $page_size    = 15;
    $display_page = "reply_list.htm";
    $keyword      = addslashes(substr($_REQUEST["keyword"], 0, 150));
    $sortby       = "pubtime";
    $oexp         = "desc";
    $search_arr[] = array (
                  array("field" => "name","keyword" => urldecode($keyword),"condition" => "like","junk" => "or"),
				  array("field" => "reply_title","keyword" => urldecode($keyword),"condition" => "like","junk" => "or"),
				  array("field" => "add","keyword" => urldecode($keyword),"condition" => "like","junk" => "or"),
                    );
 
    $query_sql    = "select * from `{$tablepre}reply`"; 
	$search_junk  = "and";
    $url_para_arr = array ('', 'keyword');
    $tpl->assign("reply_search", $ptitle["reply_search"]);
	
	
    // -------------------------------------------------------
    // ִ��ҳ�洦��
    // -------------------------------------------------------
    show_page_head("list",$page_title);
    $plist = new PageList($page_title, $page_size);
    $plist->SetSearch( $search_junk,$search_arr);
    $plist->SortOpen = true;
    $plist->SetSort($sortby, $oexp);
    $plist->SetUrlParam($url_para_arr);
    $plist->Execute($query_sql);
    $plist->TplParse($display_page);
    show_page_foot();
    $db->close();
?>