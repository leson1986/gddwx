<?php
require("config.php");
global $redhat;
$begin_time=file($redhat["path"].$redhat["data1"]);
$count=sizeof($begin_time)+83832;
?>