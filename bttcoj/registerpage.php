<?php
////////////////////////////Common head
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
if(isset($OJ_REGISTER)&&!$OJ_REGISTER){
  $view_title= "<title>禁止注册!</title>";
  $view_errors.= "很抱歉，管理员已禁止注册新用户!";
  require("template/".$OJ_TEMPLATE."/error.php");
  exit(0);
}
	require_once('./include/setlang.php');
	$view_title= "Registe a new account";
	
///////////////////////////MAIN	
	
/////////////////////////Template
require("template/".$OJ_TEMPLATE."/registerpage.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>
