<?php

global $Config ;

// SECURITY: You must explicitelly enable this "connector". (Set it to "true").
$Config['Enabled'] = false;
if ($_COOKIE["fck_upload"]==="open") {
    $Config['Enabled'] = true;
}

// Path to user files relative to the document root.
$Config['UserFilesPath'] = str_replace(__SITE_ROOT,"/",__UPLOAD_PATH);
if ($is_test_space)
    $Config['UserFilesPath'] = "/$test_space_name".$Config['UserFilesPath'];

// Fill the following value it you prefer to specify the absolute path for the
// user files directory. Usefull if you are using a virtual directory, symbolic
// link or alias. Examples: 'C:\\MySite\\UserFiles\\' or '/root/mysite/UserFiles/'.
// Attention: The above 'UserFilesPath' must point to the same directory.
$Config['UserFilesAbsolutePath'] = __UPLOAD_PATH ;

$Config['AllowedExtensions']['File']    = array() ;
$Config['DeniedExtensions']['File']     = array('php','php3','php5','phtml','asp','aspx','ascx','jsp','cfm','cfc','pl','bat','exe','dll','reg','cgi') ;

$Config['AllowedExtensions']['Image']   = array('jpg','gif','jpeg','png','bmp') ;
$Config['DeniedExtensions']['Image']    = array() ;

$Config['AllowedExtensions']['Flash']   = array('swf','fla') ;
$Config['DeniedExtensions']['Flash']    = array() ;

$Config['AllowedExtensions']['Media']   = array('swf','fla','jpg','gif','jpeg','png','bmp','mp3','wma','wmv','avi','mpg','mpeg') ;
$Config['DeniedExtensions']['Media']    = array() ;

?>