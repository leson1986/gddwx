<?php
//online.php
require("./count/system_var.php");
$onlinemsg=file($redhat["path"].$redhat["data7"]);
$onlinefriend=sizeof($onlinemsg);
echo "<a href=\"redhat.php\" target=\"_blank\">��ǰ����<font color=red>".$onlinefriend."</font>��</a>";
?>