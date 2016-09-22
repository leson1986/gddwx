<?php
//online.php
require("./count/system_var.php");
$onlinemsg=file($redhat["path"].$redhat["data7"]);
$onlinefriend=sizeof($onlinemsg);
echo "<a href=\"redhat.php\" target=\"_blank\">当前在线<font color=red>".$onlinefriend."</font>人</a>";
?>