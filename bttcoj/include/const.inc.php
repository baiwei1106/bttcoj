<?php if(file_exists("include/db_info.inc.php")){
		require_once("include/db_info.inc.php");
	if(isset($OJ_LANG)){
		require_once("./lang/$OJ_LANG.php");
	}
}
$MSG_Pending="等待";
	$MSG_Pending_Rejudging="等待重判";
	$MSG_Compiling="编译中";
	$MSG_Running_Judging="运行并评判";
	$MSG_Accepted="答案正确";
	$MSG_Presentation_Error="格式错误";
	$MSG_Wrong_Answer="答案错误";
	$MSG_Time_Limit_Exceed="时间超限";
	$MSG_Memory_Limit_Exceed="内存超限";
	$MSG_Output_Limit_Exceed="输出超限";
	$MSG_Runtime_Error="运行错误";
	$MSG_Compile_Error="编译错误";
	$MSG_Runtime_Click="运行错误(点击看详细)";
	$MSG_Compile_Click="编译错误(点击看详细)";
	$MSG_Compile_OK="编译成功";
        $MSG_Click_Detail="点击看详细";
        $MSG_Manual="人工判题";
        $judge_icon = array(
                "<i class=\"hourglass half icon\"></i>", 
                "<i class=\"hourglass half icon\"></i>", 
                "<i class=\"spinner icon\"></i>", 
                "<i class=\"spinner icon\"></i>", 
                "<i class=\"checkmark icon\"></i>", 
                "<i class=\"server icon\"></i>", 
                "<i class=\"remove icon\"></i>", 
                "<i class=\"clock icon\"></i>", 
                "<i class=\"microchip icon\"></i>", 
                "<i class=\"print icon\"></i>", 
                "<i class=\"bomb icon\"></i>", 
                "<i class=\"code icon\"></i>",
                "<i class=\"ban icon\"></i>", 
                "<i class=\"file outline icon\"></i>", 
                "<i class=\"server icon\"></i>", 
                "<i class=\"folder open outline icon\"></i>", 
                "<i class=\"minus icon\"></i>", 
                "<i class=\"ban icon\"></i>"
              );
              $judge_result=Array($MSG_Pending,$MSG_Pending_Rejudging,$MSG_Compiling,$MSG_Running_Judging,$MSG_Accepted,$MSG_Presentation_Error,$MSG_Wrong_Answer,$MSG_Time_Limit_Exceed,$MSG_Memory_Limit_Exceed,$MSG_Output_Limit_Exceed,$MSG_Runtime_Error,$MSG_Compile_Error,$MSG_Compile_OK,$MSG_TEST_RUN);
              $judge_style=Array("waiting",
              "status waiting",
              "status compiling",
              "status running",
              "status accepted",
              "status judgement_failed",
              "status wrong_answer",
              "status time_limit_exceeded",
              "status memory_limit_exceeded",
              "status output_limit_exceeded",
              "status runtime_error",
              "status compile_error",
              
              "status invalid_interaction",
              "status file_error",
              "status system_error",
              "status no_testdata",
              "status partially_correct",
              "status skipped");
$jresult=Array($MSG_PD,$MSG_PR,$MSG_CI,$MSG_RJ,$MSG_AC,$MSG_PE,$MSG_WA,$MSG_TLE,$MSG_MLE,$MSG_OLE,$MSG_RE,$MSG_CE,$MSG_CO,$MSG_TR);
$judge_color=Array("gray","gray","orange","orange","green","red","red","red","red","red","red","navy ","navy");
$language_name=Array("C","C++","Pascal","Java","Ruby","Bash","Python3","PHP","Perl","C#","Obj-C","FreeBasic","Scheme","Clang","Clang++","Lua","JavaScript","Go","Other Language");
$language_ext=Array( "c", "cc", "pas", "java", "rb", "sh", "py", "php","pl", "cs","m","bas","scm","c","cc","lua","js","go" );
$PID="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
$ball_color=Array('#66cccc','red','green','pink','yellow','violet','magenta','maroon','olive','chocolate');
$ball_name=Array('蒂芙妮蓝','红','green','pink','yellow','violet','magenta','maroon','olive','chocolate');
?>
