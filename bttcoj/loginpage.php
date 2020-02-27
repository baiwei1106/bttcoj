<?php
$cache_time=1;
require_once('./include/cache_start.php');
    require_once("./include/db_info.inc.php");
	require_once("./include/setlang.php");
	$view_title= "LOGIN";

	if (isset($_SESSION[$OJ_NAME.'_'.'user_id'])){
	$view_errors= "很抱歉，请您重新登陆!\n";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(1);
}

/////////////////////////Template
require("template/".$OJ_TEMPLATE."/loginpage.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>

