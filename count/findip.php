<?php
if($HTTP_GET_VARS["search"]=="ip2local")
 {
$redhat["ipdata"]="ip.csv";
if(!eregi("[0-9.]",$HTTP_GET_VARS["ip"])) {echo "<script language=\"JavaScript\">alert(\"IP��������,�޷���ѯ\");window.history.back(-1);</script>";exit;}
$ipvar=explode(".",$HTTP_GET_VARS["ip"]);
for ($i=0; $i<4; $i++) {
  $ipvar[$i]=sprintf("%03d", $ipvar[$i]);
}
  $ip2=implode(".",$ipvar);
  $file=file($redhat["ipdata"]);
  $a=0;
  $b=sizeof($file);
  while($a<($b-1))
    {
      $r=floor(($a+$b)/2);
      $tmp=explode(",",$file[$r]);
      if(strcmp($ip2,$tmp[0])>=0&&strcmp($ip2,$tmp[1])<=0){$msg=trim($tmp[2]).trim($tmp[3]).trim($tmp[4]).trim($tmp[5]);break;}
      if(strcmp($ip2,$tmp[0])>0) $a=$r;
      else $b=$r;
      if(!($a<$b-1)) $msg="δ֪����";
    }

echo "<br><br><p><center>����ѯ��IP:<font color=red>".$HTTP_GET_VARS["ip"]."</font><br><br>��ѯ���:<font color=blue>".$msg."</font></center></p><center><button onClick=\"javascript:window.location.href='".$HTTP_SERVER_VARS["PHP_SELF"]."'\">����</button></center>";
}
else {
?>
<form action="<?php echo $HTTP_SERVER_VARS["PHP_SELF"];?>" method="put">
<input type="hidden" name="search" value="ip2local">
<td>IPת������λ��</td><td>
<input type="text" name="ip" value="������IP��ַ" onClick="this.value=''"><input type="submit" value="��ѯ">
</form>
<?php
 }
?>