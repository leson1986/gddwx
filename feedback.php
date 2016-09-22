<?php
    require ( 'init.inc.php' );
    require ( __CLASS_PATH . 'page_list.class.php' );
    require("./count/redhat.php");
	$plist = new PageList();

    $act = $_POST['act'];

    
    $cname = 'Message';
    $tablename = "`{$tablepre}reply`";

    if($gbookopen==1){
        AlertMsg("Sorry! The Feedback was close!",1);   //是否开户留言功能
    }
    //ip访问限制
    if(!empty($gbook_limit_ip)){
        $guestip = GetIP();
        //echo $guestip; exit;
        $arr_ip = explode('||',$gbook_limit_ip);
        foreach($arr_ip as $val){
            if($val==$guestip){
                AlertMsg("Sorry,you can't see it!",1);
                break;
            }
        }
    }

   if($act=='post'){
      //  $gbook_type = $_POST["gbook_type"];
        $username  = $_POST["username"];
        $phone  = $_POST["phone"];
        $email  = $_POST["email"];
        $address  = $_POST["address"];
        $content  = $_POST["content"];
        $pubtime = date("Y-m-d H:i:s");

        if(empty($username)||empty($phone)||empty($email)||empty($address)||empty($content)){
            AlertMsg("Please writer the info!",0);
        }
        $fields_arr = array(
          //  "stype" => $gbook_type,
            "name" => $username,
            "tel" => $phone,
            "add" => $address,
            "email" => $email,            
            "content" => dhtmlspecialchars($content),
            "pubtime" => $pubtime,
            "status" => 1,
        );
        $db->insertData($tablename,$fields_arr);  //插入数据
        AlertMsg('You have successfully submitted a message, thank you.', 'feedback.php');
    }

    //留言类别
  //  $gbook_type = "";
//    $arry_type = explode('||',$gbook_sort);
//    if(is_array($arry_type)){
//        foreach($arry_type as $value){
//           $gbook_type .= "<option value='{$value}'>{$value}</option>";
//        }
//    }
//
//    $banner_img = '1-4.swf';  //banner图片
//    
//    $page_url = 'contact.php';
   // $left_nav = GetLeftNav($page_url,2,$article_id);
    
    
    $sitename = $cname.'-'.$sitename;    

    $tpl->assign('nav_8','cur');
    $tpl->assign('sitename',$sitename);
    $tpl->assign('sitekeywords',$sitekeywords);
    $tpl->assign('banner_img',$banner_img);
    $tpl->assign('banner_height','193');
    $tpl->assign('page_title',$cname);
    $tpl->assign('left_nav',$left_nav);   
    $tpl->assign('gbook_type',$gbook_type);
    $tpl->display("feedback.html");
?>
