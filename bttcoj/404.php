<?php
	require_once('./include/cache_start.php');
	$view_errors= "Error 404! 很抱歉您访问的网页未找到！\n";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
?>

