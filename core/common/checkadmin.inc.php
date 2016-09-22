<?php
    session_start();
    if (!($_SESSION["AdminLogin"]===true && $_SESSION["AdminUser"]!=null)) header("location: admin_login.php");
