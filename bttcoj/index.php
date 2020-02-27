<?php
////////////////////////////Common head
	$cache_time=30;
	$OJ_CACHE_SHARE=true;
	require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
    require_once('./include/memcache.php');
	require_once('./include/setlang.php');
	require_once('./include/my_func.inc.php');
	require_once('./include/const.inc.php');

	$view_title= "Welcome To Online Judge";
 $result=false;	
	if(isset($OJ_ON_SITE_CONTEST_ID)){
		header("location:contest.php?cid=".$OJ_ON_SITE_CONTEST_ID);
		exit();
	}
///////////////////////////MAIN	
function checkd($cid,$pid){
	//require_once("./include/db_info.inc.php");
	global $OJ_NAME;
	
	$sql="SELECT count(*) FROM `solution` WHERE `contest_id`=? AND `num`=? AND `result`='4' AND `user_id`=?";
	$result=pdo_query($sql,$cid,$pid,$_SESSION[$OJ_NAME.'_'.'user_id']);
	 $row=$result[0];
	$ac=intval($row[0]);
  if ($ac>0) return  "<span class=\"status accepted\"><i class=\"checkmark icon\"></i></span>";
	$sql="SELECT count(*) FROM `solution` WHERE `contest_id`=? AND `num`=? AND `result`!=4 and `problem_id`!=0  AND `user_id`=?";
	$result=pdo_query($sql,$cid,$pid,$_SESSION[$OJ_NAME.'_'.'user_id']);
	$row=$result[0];
	$sub=intval($row[0]);
	
	if ($sub>0) return "<span class=\"status wrong_answer\"><i class=\"remove icon\"></i></span>";
	else return "";
}

function formatTimeLength($length)
{
  $hour = 0;
  $minute = 0;
  $second = 0;
  $result = '';

  if($length >= 60){
    $second = $length%60;
    if($second > 0){ $result = $second.'秒';}
    $length = floor($length/60);
    if($length >= 60){
      $minute = $length%60;
      if($minute == 0){ if($result != ''){ $result = '0分' . $result;}}
      else{ $result = $minute.'分'.$result;}
      $length = floor($length/60);
      if($length >= 24){
      	$hour = $length%24;
        if($hour == 0){ if($result != ''){ $result = '0小时' . $result;}}
        else{ $result = $hour . '小时' . $result;}
        $length = floor($length / 24);
        $result = $length . '天' . $result;
      }
      else{ $result = $length . '小时' . $result;}
    }
    else{ $result = $length . '分' . $result;}
  }
  else{ $result = $length . '秒';
  }
  return $result;
}
	
	// $view_news="";
	$sql=	"select * "
			."FROM `news` "
			."WHERE `defunct`!='Y'"
			."ORDER BY `importance` ASC,`time` DESC "
			."LIMIT 10";
	$result=mysql_query_cache($sql);//mysql_escape_string($sql));
	$view_news = Array();
	$cut_news=0;
	if (!$result){
		$view_news[0][0]= "暂无公告";
		$view_news[0][1]= "2018-01-01";
	}else{
		//$view_news.= "<table width=96%>";
		
		foreach ($result as $row){
			$view_news[$cut_news][0]=" <a href=\"article.php?news_id=".$row['news_id']."\">".$row['title']."</a>";
			$view_news[$cut_news++][1]=date("Y-m-d",strtotime($row['time']));
			// $view_news.= "<tr><td><td><big><b>".$row['title']."</b></big>-<small>[".$row['user_id']."]</small></tr>";
			// $view_news.= "<tr><td><td>".$row['content']."</tr>";
		}
		
		// $view_news.= "<tr><td width=20%><td>This <a href=http://cm.baylor.edu/welcome.icpc>ACM/ICPC</a> OnlineJudge is a GPL product from <a href=https://github.com/zhblue/hustoj>hustoj</a></tr>";
		// $view_news.= "</table>";
	}
$view_apc_info="";

$sql=	"SELECT UNIX_TIMESTAMP(date(in_date))*1000 md,count(1) c FROM (select * from solution order by solution_id desc limit 8000) solution  where result<13 group by md order by md desc limit 200";
	$result=mysql_query_cache($sql);//mysql_escape_string($sql));
	$chart_data_all= array();
//echo $sql;
     
    foreach ($result as $row){
		array_push($chart_data_all,array($row['md'],$row['c']));
    }
    
$sql=	"SELECT UNIX_TIMESTAMP(date(in_date))*1000 md,count(1) c FROM  (select * from solution order by solution_id desc limit 8000) solution where result=4 group by md order by md desc limit 200";
	$result=mysql_query_cache($sql);//mysql_escape_string($sql));
	$chart_data_ac= array();
//echo $sql;
    
    foreach ($result as $row){
		array_push($chart_data_ac,array($row['md'],$row['c']));
    }
  if(isset($_SESSION[$OJ_NAME.'_'.'administrator'])){
  	$sql="select avg(sp) sp from (select  count(1) sp,judgetime from solution where result>3 and judgetime>convert(now()-100,DATETIME)  group by judgetime order by sp) tt;";
  	$result=mysql_query_cache($sql);
  	$speed=$result[0][0]; 
  }else{
        $speed=$chart_data_all[0][1];
  }

 

  $sql = "SELECT * FROM `contest` WHERE `defunct`='N' ORDER BY `contest_id` DESC LIMIT 5";

	$result1 = mysql_query_cache($sql);
  
  $view_contest = Array();
  $i = 0;

  foreach($result1 as $row){
    $view_contest[$i][0] = "<a href='contest.php?cid=".$row['contest_id']."'>".$row['title']."</a>";
    $start_time = strtotime($row['start_time']);
    $end_time = strtotime($row['end_time']);
    $now = time();
                                
    $length = $end_time-$start_time;
    $left = $end_time-$now;

    if($now>$end_time){
      $view_contest[$i][1] .= "<span class=\"ui header\"><div class=\"ui mini grey label\">已结束</div></span>";

    }else if ($now<$start_time){
		$view_contest[$i][1] .= "<span class=\"ui header\"><div class=\"ui mini red label\">未开始</div></span>";

    }else{
      $view_contest[$i][1] .= "<span class=\"ui header\"><div class=\"ui mini green label\">进行中</div></span>";
    }
    $view_contest[$i][2] = $row['start_time'];


    $i++;
	}
	
	$where="where defunct='N' ";
	$sql = "SELECT `user_id`,`nick`,`school`,`solved`,`submit` FROM `users` $where ORDER BY `solved` DESC,submit,reg_time  LIMIT 25";
	$result = pdo_query($sql);
	if($result) 
		$rank_rows_cnt=count($result);
  else
		$rank_rows_cnt=0;
	for ( $i=0;$i<$rank_rows_cnt;$i++ ) {
					
			$row=$result[$i];
			
			$rank ++;

			$view_rank[$i][0]= $rank;
			$view_rank[$i][1]=  "<a href='userinfo.php?user=" .htmlentities ( $row['user_id'],ENT_QUOTES,"UTF-8") . "'>" . $row['user_id'] . "</a>";
			//$view_rank[$i][2]=  $row['school'] ;
			$view_rank[$i][2]=  htmlentities ( $row['school'] ,ENT_QUOTES,"UTF-8") ;

	}




/////////////////////////Template
require("template/".$OJ_TEMPLATE."/index.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>
