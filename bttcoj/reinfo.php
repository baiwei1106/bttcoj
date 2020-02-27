<?php
	$cache_time=10;
	$OJ_CACHE_SHARE=false;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
	require_once('./include/setlang.php');
	$view_title= "Welcome To Online Judge";
	
require_once("./include/const.inc.php");
if (!isset($_GET['sid'])){
	echo "No such code!\n";
	require_once("oj-footer.php");
	exit(0);
}
function is_valid($str2){
    global $_SESSION;
    if(isset($_SESSION[$OJ_NAME.'_'.'source_browser'])) return true;
    //return true; // 如果希望能然任何人都查看对比和RE,放开行首注释 if you fail to view diff , try remove the // at beginning of this line.
    $n=strlen($str2);
    $str=str_split($str2);
    $m=1;
    for($i=0;$i<$n;$i++){
    	if(is_numeric($str[$i])) $m++;
    }
    return $n/$m>3;
}


$ok=false;
$id=strval(intval($_GET['sid']));
$sql="SELECT * FROM `solution` WHERE `solution_id`=?";
$result=pdo_query($sql,$id);
$row=$result[0];
$lang=$row['language'];
$contest_id=intval($row['contest_id']);
$isRE=$row['result']==10;
if ($row && $row['user_id']==$_SESSION[$OJ_NAME.'_'.'user_id']) $ok=true;
if (isset($_SESSION[$OJ_NAME.'_'.'source_browser'])) $ok=true;
$view_reinfo="";
if ( isset($_SESSION[$OJ_NAME.'_'.'source_browser'])||
	($ok&&$lang!=3&&$contest_id==0&&                          // 防止打表过数据弱的题目
    !(                                                             // 默认禁止比赛中查看WAd对比和RE详情
    	(isset($OJ_EXAM_CONTEST_ID)&&$OJ_EXAM_CONTEST_ID>0)||      // 如果希望教学中无论练习或比赛均开放数据对比与运行错误，可以将这里
        (isset($OJ_ON_SITE_CONTEST_ID)&&$OJ_ON_SITE_CONTEST_ID>0)  // 的所有条件简化为 $ok，即38行到43行简化为: if($ok){
     ) )                                                            // if you want a friendly WA and RE, change line 38-43 to "if($ok){"
){
	if($row['user_id']!=$_SESSION[$OJ_NAME.'_'.'user_id'])
		$view_mail_link= "<a href='mail.php?to_user=".htmlentities($row['user_id'],ENT_QUOTES,"UTF-8")."&title=$MSG_SUBMIT $id'>Mail the auther</a>";
	
	$sql="SELECT `error` FROM `runtimeinfo` WHERE `solution_id`=?";
	$result=pdo_query($sql,$id);
	 $row=$result[0];
	if($row&&($OJ_SHOW_DIFF||isset($_SESSION[$OJ_NAME.'_'.'source_browser'])||$isRE)&&($OJ_TEST_RUN||is_valid($row['error'])||isset($_SESSION[$OJ_NAME.'_'.'source_browser']))){	
		$view_reinfo= htmlentities(str_replace("\n\r","\n",$row['error']),ENT_QUOTES,"UTF-8");
	}else{
		
		$view_reinfo="sorry , not available (RE:".$isRE.",OJ_SHOW_DIFF:".$OJ_SHOW_DIFF.",TR:".$OJ_TEST_RUN.",valid:".is_valid($row['error']).")";
	}
        
	
}else{
	
	$view_errors= "I am sorry, You could not view this message!";
	require("template/".$OJ_TEMPLATE."/error.php");
	exit(0);
	
}

/////////////////////////Template
require("template/".$OJ_TEMPLATE."/reinfo.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>

