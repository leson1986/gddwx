<?php
//定义一些变量
session_start();
require("./count/system_var.php");
?>
<?php
//IP禁止访问检测
$ipfile=file($redhat["path"].$redhat["badip"]);
$ipvar=explode(".",$redhat["ip"]);
for ($i=0; $i<4; $i++) {
  $ipvar[$i]=sprintf("%03d", $ipvar[$i]);
}
$tmpip=implode(".",$ipvar);
for($i=0;$i<sizeof($ipfile);$i++)
{
  $ipfile[$i]=trim($ipfile[$i]);
  if(($redhat["ip"]==$ipfile[$i])||($redhat["ip"]==$tmpip))
  {
   cant_visited();//禁止访问
   break;
  }
}
$a=0;
$b=sizeof($ipfile);
while($a<$b-1)
{
$r=floor(($a+$b)/2);
$ipfilevar=explode(",",$ipfile[$r]);
if((strcmp($tmpip,$ipfilevar[0])>=0&&strcmp($tmpip,$ipfilevar[1])<=0)||(strcmp($redhat["ip"],$ipfilevar[0])>=0&&strcmp($redhat["ip"],$ipfilevar[1])<=0)) {cant_visited();break;}
if(strcmp($tmpip,$ipfilevar[0])>0) $a=$r;
else $b=$r;
if(!($a<$b-1)) break;
}
unset($tmpip,$a,$b,$r,$ipfilevar,$tmpip);//清除变量( 可有可无的)
$cookietime=time()+118500;
setcookie("nowtime",time(),$cookietime);//设置COOKIE以便可以访问其它页面
?>
<?php
//开始分析浏览器
if(strpos($os,"NetCaptor")) $redhat["browse"]="NetCaptor";
elseif(strpos($os,"MSIE 6")) $redhat["browse"]="MSIE 6.x";
elseif(strpos($os,"MSIE 5")) $redhat["browse"]="MSIE 5.x";
elseif(strpos($os,"MSIE 4")) $redhat["browse"]="MSIE 4.x";
elseif(strpos($os,"Netscape")) $redhat["browse"]="Netscape";
elseif(strpos($os,"Opera")) $redhat["browse"]="Opera";
else $redhat["browse"]="other";

//分析操作系统
if(strpos($os,"Windows NT 5.0")) $redhat["os"]="Windows2000";
elseif(strpos($os,"Windows NT 5.1")) $redhat["os"]="WindowsXP";
elseif(strpos($os,"Windows NT")) $redhat["os"]="WindowsNT";
elseif(strpos($os,"Windows 9")) $redhat["os"]="Windows9x";
elseif(strpos($os,"unix")) $redhat["os"]="unix";
elseif(strpos($os,"linux")) $redhat["os"]="linux";
elseif(strpos($os,"SunOS")) $redhat["os"]="SunOS";
elseif(strpos($os,"BSD")) $redhat["os"]="FreeBSD";
elseif(strpos($os,"Mac")) $redhat["os"]="Mac";
else $redhat["os"]="Other";
//操作系统和浏览器分析完毕

//把IP转换成地理位置
$ipfile=file($redhat["ipdata"]);
$ipvar=explode(".",$redhat["ip"]);
for ($i=0; $i<4; $i++) {
  $ipvar[$i]=sprintf("%03d", $ipvar[$i]);
}
$tmpip=implode(".",$ipvar);
$a=0;
$b=sizeof($ipfile);
while($a<$b-1)
{
$r=floor(($a+$b)/2);
$ipfilevar=explode(",",$ipfile[$r]);
if(strcmp($tmpip,$ipfilevar[0])>=0&&strcmp($tmpip,$ipfilevar[1])<=0) {$ip1=trim($ipfilevar[2]).trim($ipfilevar[3]).trim($ipfilevar[4]).trim($ipfilevar[5]);break;}
if(strcmp($tmpip,$ipfilevar[0])>0) $a=$r;
else $b=$r;
if(!($a<$b-1)) $ip1="未知地区";
}
//echo $ip1;
$redhat["ipfrom"]=$ip1;

//统计访问者是从何URL而来
/*
$info = getenv("QUERY_STRING");
$check_query=explode("HTTP_REFERER",$info);
if(sizeof($check_query)>1) $HTTP_REFERER="直接浏览器输入";
*/
if(!$HTTP_SESSION_VARS["sent_from"])
  {
    if($HTTP_SERVER_VARS["HTTP_REFERER"]== "")
      {
        $redhat["fromurl"] = "直接浏览器输入";
      }
     else
      {
        $redhat["fromurl"] = $HTTP_SERVER_VARS["HTTP_REFERER"];
      }
   }
else
   {
   $redhat["fromurl"]=$HTTP_SESSION_VARS["sent_from"];
   session_unregister("sent_from");
   $backflag=true;
   }
?>

<?php
/*
echo $os."<br>";
echo $redhat["ip"]."<br>";
echo $redhat["ipfrom"]."<br>";
echo $redhat["fromurl"]."<br>";
echo $redhat["os"]."<br>";
echo $redhat["browse"]."<br>";
*/
?>
<?php
//写入数据
##########################
//时间写入（＊年月日及其它的所有信息）
$fp=fopen($redhat["path"].$redhat["data1"],"r");
//$tmpmsg=fread($fp,filesize($redhat["path"].$redhat["data1"]));
fclose($fp);
$msg=$redhat["time"]."^_^".$redhat["ip"]."^_^".$redhat["ipfrom"]."^_^".$redhat["fromurl"]."^_^".$redhat["os"]."^_^".$redhat["browse"]."\n".$tmpmsg;
$fp=fopen($redhat["path"].$redhat["data1"],"w");
flock($fp,2);
fwrite($fp,$msg);
fclose($fp);
//时间写入完毕

//时间写入 （24小时）
$hour=date("H");
$filetime=file($redhat["path"].$redhat["data2"]);
if(trim($filetime[0])!=date("d")) //如果时间已经过期则更新数据
 {
   $fp=fopen($redhat["path"].$redhat["data2"],"w");
   flock($fp,2);
   fwrite($fp,date("d",$redhat["time"])."\n"."00^_^0\n01^_^0\n03^_^0\n04^_^0\n05^_^0\n06^_^0\n07^_^0\n08^_^0\n09^_^0\n10^_^0\n11^_^0\n12^_^0\n13^_^0\n14^_^0\n15^_^0\n16^_^0\n17^_^0\n18^_^0\n19^_^0\n20^_^0\n21^_^0\n22^_^0\n23^_^0\n");
   fclose($fp);
 }
$filetime=file($redhat["path"].$redhat["data2"]);
for($i=1;$i<sizeof($filetime);$i++)
{
  $filetime[$i]=trim($filetime[$i]);
  $timevar=explode("^_^",$filetime[$i]);
  if($timevar[0]==$hour) {$timevar[1]=$timevar[1]+1;$inputtime=$inputtime.$timevar[0]."^_^".$timevar[1]."\n";continue;}//find the hour is same to the time_data
  else $inputtime=$inputtime.$filetime[$i]."\n";
}
$inputtime=trim($filetime[0])."\n".$inputtime;
$fp=fopen($redhat["path"].$redhat["data2"],"w");
if(!trim($inputtime)) {echo "bad".$inputtime."===".$redhat["fromurl"];exit;}
flock($fp,2);
fwrite($fp,$inputtime);
fclose($fp);
//时间写入完毕

//写入访问者IP及IP的地理位置
$fileip=file($redhat["path"].$redhat["data3"]);
for($i=0;$i<sizeof($fileip);$i++)
{
 $fileip[$i]=trim($fileip[$i]);
 $fileipvar=explode("^_^",$fileip[$i]);
 if($redhat["ip"]==$fileipvar[0]) {$fileipvar[2]=$fileipvar[2]+1;$ipmsg=$ipmsg.$redhat["ip"]."^_^".$redhat["ipfrom"]."^_^".$fileipvar[2]."\n";$findip=true;}//if find the IP in the ip_data
 else $ipmsg=$ipmsg.$fileip[$i]."\n";
}
if(!$findip) $ipmsg=$redhat["ip"]."^_^".$redhat["ipfrom"]."^_^1\n".$ipmsg;//else if ip isn't int the in_data,insert into new ip-data
$fp=fopen($redhat["path"].$redhat["data3"],"w");
flock($fp,2);
fwrite($fp,$ipmsg);
fclose($fp);
//写入IP及IP的地理位置完毕

//写入浏览器
$browsedata=file($redhat["path"].$redhat["data4"]);
for($i=0;$i<sizeof($browsedata);$i++)
{
  $browsedata[$i]=trim($browsedata[$i]);
  $browsevar=explode("^_^",$browsedata[$i]);
  if($browsevar[0]==$redhat["browse"]) {$findbrowse=true;$browsevar[1]=$browsevar[1]+1;$inputbrowse=$inputbrowse.$browsevar[0]."^_^".$browsevar[1]."\n";}
  else $inputbrowse=$inputbrowse.$browsedata[$i]."\n";
}
if(!$findbrowse) $inputbrowse=$redhat["browse"]."^_^1\n".$inputbrowse;
$fp=fopen($redhat["path"].$redhat["data4"],"w");
flock($fp,2);
fwrite($fp,$inputbrowse);
fclose($fp);
//写入浏览器完毕

//写入操作系统
$osdata=file($redhat["path"].$redhat["data5"]);
for($i=0;$i<sizeof($osdata);$i++)
{
  $osdata[$i]=trim($osdata[$i]);
  $osvar=explode("^_^",$osdata[$i]);
  if($osvar[0]==$redhat["os"]) {$findos=true;$osvar[1]=$osvar[1]+1;$inputos=$inputos.$osvar[0]."^_^".$osvar[1]."\n";}
  else $inputos=$inputos.$osdata[$i]."\n";
}
if(!$findos) $inputos=$redhat["os"]."^_^1\n".$inputos;
$fp=fopen($redhat["path"].$redhat["data5"],"w");
flock($fp,2);
fwrite($fp,$inputos);
fclose($fp);
//写入操作系统完毕

//写入访问者来访URL
$fromurl=file($redhat["path"].$redhat["data6"]);
for($i=0;$i<sizeof($fromurl);$i++)
{
  $fromurl[$i]=trim($fromurl[$i]);
  $tmpurl=explode("^_^",$fromurl[$i]);
  if($tmpurl[0]==$redhat["fromurl"]){$findurl=true;$tmpurl[1]=$tmpurl[1]+1;$inputurl=$inputurl.$tmpurl[0]."^_^".$tmpurl[1]."\n";continue;}
  else $inputurl=$inputurl.$fromurl[$i]."\n";
}
if(!$findurl) $inputurl=$redhat["fromurl"]."^_^1\n".$inputurl;
$fp=fopen($redhat["path"].$redhat["data6"],"w");
flock($fp,2);
fwrite($fp,$inputurl);
fclose($fp);
//写入访问者来访URL完毕

//在线人数程序开始
$online=file($redhat["path"].$redhat["data7"]);
for($i=0;$i<sizeof($online);$i++)
{
  $online[$i]=trim($online[$i]);
  if(!$online[$i]) continue;
  $onlinetmp=explode("^_^",$online[$i]);
  if(($redhat["time"]-$onlinetmp[0])>=$redhat["onlinetime"])  continue;//已经掉线
  if(($onlinetmp[1]==$redhat["ip"])&&(($redhat["time"]-$onlinetmp[0])<$redhat["onlinetime"])) $onlinecheck=true;//存在且没有掉线
  $msgonline=$msgonline.$online[$i]."\n"; //没有找到IP则继续
}
if(!$onlinecheck) $msgonline=$redhat["time"]."^_^".$redhat["ip"]."\n".$msgonline;
$fp=fopen($redhat["path"].$redhat["data7"],"w");
flock($fp,2);
fwrite($fp,$msgonline);
fclose($fp);
//$onlinemsg=file($redhat["path"].$redhat["data7"]);
//$onlinefriend=sizeof($onlinemsg);
//if($redhat["ouput"])
//echo "<a href=\"redhat.php\" target=\"_blank\">当前在线<font color=red>".$onlinefriend."</font>人</a>";
//在线人数统计程序结束
//数据写入完毕
#############################
if($backflag) echo "<script language=\"JavaScript\">window.location.href=\"".$HTTP_GET_VARS["backurl"]."\";</script>";
?>
<?php
//一个函数
function cant_visited()
 {
  global $redhat;
  echo "<script language=\"JavaScript\">alert(\"对不起,您的IP是:".$redhat["ip"].",已经被本站列为禁止访问的列表中,有问题请与本站管理员联系!!\");window.close(\"this.window\");</script>";
  exit;
  return false;
 }
?>