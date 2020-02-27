<?php
        $OJ_CACHE_SHARE=true;
        $cache_time=10;
        require_once('./include/cache_start.php');
    require_once('./include/db_info.inc.php');
        require_once('./include/setlang.php');
        $view_title= $MSG_CONTEST.$MSG_RANKLIST;
        $title="";
        require_once("./include/const.inc.php");
        require_once("./include/my_func.inc.php");
class TM{
        var $solved=0;
        var $time=0;
        var $p_wa_num;
        var $p_ac_sec;
        var $user_id;
        var $nick;
        var $school;
        function TM(){
                $this->solved=0;
                $this->time=0;
                $this->p_wa_num=array(0);
                $this->p_ac_sec=array(0);
        }
        function Add($pid,$sec,$res){
//              echo "Add $pid $sec $res<br>";
                if (isset($this->p_ac_sec[$pid])&&$this->p_ac_sec[$pid]>0)
                        return;
                if ($res!=4){
                        if(isset($this->p_wa_num[$pid])){
                                $this->p_wa_num[$pid]++;
                        }else{
                                $this->p_wa_num[$pid]=1;
                        }
                }else{
                        $this->p_ac_sec[$pid]=$sec;
                        $this->solved++;
                        if(!isset($this->p_wa_num[$pid])) $this->p_wa_num[$pid]=0;
                        $this->time+=$sec+$this->p_wa_num[$pid]*1200;
//                      echo "Time:".$this->time."<br>";
//                      echo "Solved:".$this->solved."<br>";
                }
        }
}


function s_cmp($A,$B){
//      echo "Cmp....<br>";
        if ($A->school!=$B->school) return $A->school<$B->school;
        else return $A->solved<$B->solved;
}

// contest start time
if (!isset($_GET['cid'])) die("No Such Contest!");
$cid=intval($_GET['cid']);

if($OJ_MEMCACHE){
	$sql="SELECT `start_time`,`title`,`end_time` FROM `contest` WHERE `contest_id`=$cid";
        require("./include/memcache.php");
        $result = mysql_query_cache($sql);
        if($result) $rows_cnt=count($result);
        else $rows_cnt=0;
}else{
	$sql="SELECT `start_time`,`title`,`end_time` FROM `contest` WHERE `contest_id`=?";
        $result = pdo_query($sql,$cid);
        if($result) $rows_cnt=count($result);
        else $rows_cnt=0;
}


$start_time=0;
$end_time=0;
if ($rows_cnt>0){
//       $row=$result[0];

        if($OJ_MEMCACHE)
                $row=$result[0];
        else
                 $row=$result[0];
        $start_time=strtotime($row['start_time']);
        $end_time=strtotime($row['end_time']);
        $title=$row['title'];
        
}
if(!$OJ_MEMCACHE)
if ($start_time==0){
        $view_errors= "No Such Contest";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
}

if ($start_time>time()){
        $view_errors= "Contest Not Started!";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
}
if(!isset($OJ_RANK_LOCK_PERCENT)) $OJ_RANK_LOCK_PERCENT=0;
$lock=$end_time-($end_time-$start_time)*$OJ_RANK_LOCK_PERCENT;

//echo $lock.'-'.date("Y-m-d H:i:s",$lock);

if($OJ_MEMCACHE){
	$sql="SELECT count(1) as pbc FROM `contest_problem` WHERE `contest_id`='$cid'";
//        require("./include/memcache.php");
        $result = mysql_query_cache($sql);
        if($result) $rows_cnt=count($result);
        else $rows_cnt=0;
}else{
	$sql="SELECT count(1) as pbc FROM `contest_problem` WHERE `contest_id`=?";
        $result = pdo_query($sql,$cid);
        if($result) $rows_cnt=count($result);
        else $rows_cnt=0;
}

if($OJ_MEMCACHE)
        $row=$result[0];
else
        $row=$result[0];

// $row=$result[0];
$pid_cnt=intval($row['pbc']);

if($OJ_MEMCACHE){
	$sql="SELECT
        users.user_id,users.nick,users.school,solution.result,solution.num,solution.in_date
                FROM
                        (select * from solution where solution.contest_id='$cid' and num>=0 and problem_id>0) solution
                inner join users
                on users.user_id=solution.user_id and users.defunct='N'
        ORDER BY users.user_id,in_date";
        $result = mysql_query_cache($sql);
        if($result) $rows_cnt=count($result);
        else $rows_cnt=0;
}else{
	$sql="SELECT
        users.user_id,users.nick,users.school,solution.result,solution.num,solution.in_date
                FROM
                        (select * from solution where solution.contest_id=? and num>=0 and problem_id>0) solution
                inner join users
                on users.user_id=solution.user_id and users.defunct='N'
        ORDER BY users.user_id,in_date";
        $result = pdo_query($sql,$cid);
        if($result) $rows_cnt=count($result);
        else $rows_cnt=0;
}
$user_cnt=0;
$user_name='';
$U=array();
//$U[$user_cnt]=new TM();
for ($i=0;$i<$rows_cnt;$i++){
        $row=$result[$i];
        $n_user=$row['user_id'];
        $school=$row['school'];
        if (strcmp($user_name,$n_user)){
                $user_cnt++;
                $U[$user_cnt]=new TM();
                
                $U[$user_cnt]->user_id=$row['user_id'];
                $U[$user_cnt]->nick=$row['nick'];
                $U[$user_cnt]->school=$row['school'];
                
                $user_name=$n_user;
        }
        if(time()<$end_time+3600&&$lock<strtotime($row['in_date']))
        $U[$user_cnt]->Add($row['num'],strtotime($row['in_date'])-$start_time,0);
        else
        $U[$user_cnt]->Add($row['num'],strtotime($row['in_date'])-$start_time,intval($row['result']));
        
}
usort($U,"s_cmp");

class SC{
        var $renshu=0;
        var $solved=0;
        var $time=0;
        var $p_wa_num=array();
        var $p_ac_num=array();
        var $school;
        function TM(){
                $this->renshu=0;
                $this->solved=0;
                $this->time=0;
                $this->p_wa_num=array(0);
                $this->p_ac_num=array(0);
        }
        function Add($flag,$pid){
                $out=$flag;
                if ($flag==4){
                        if(isset($this->p_ac_num[$pid])){
                                $this->p_ac_num[$pid]++;
                        }else{
                                $this->p_ac_num[$pid]=1;
                        }
                }else{
                        if(isset($this->p_wa_num[$pid])){
                                $this->p_wa_num[$pid]++;
                        }else{
                                $this->p_wa_num[$pid]=1;
                        }
                }
        }
}
$S=array();
$school_cnt=0;
for ($i=0;$i<$user_cnt;$i++){
        $row=$U[$i];
        $school=$row->school;
        if (strcmp($school_name,$school)){
                $school_cnt++;
                $S[$school_cnt]=new SC();
                $S[$school_cnt]->school=$school;
                $school_name=$school;
        }
        $S[$school_cnt]->renshu++;
        $S[$school_cnt]->solved+=$row->solved;
        $S[$school_cnt]->time+=$row->time;
        $tac=$row->p_ac_sec;
        $twa=$row->p_wa_num;
        for($j=0;$j<intval($pid_cnt);$j++){
                if (isset($tac[$j])&&$tac[$j]>0){
                        $S[$school_cnt]->ADD(4,$j);
                }
                if (isset($twa[$j])&&$twa[$j]>0){
                        $S[$school_cnt]->ADD(1,$j);
                }
                
        }
        
}
function ss_cmp($A,$B){
        //      echo "Cmp....<br>";
                if ($A->solved/$A->renshu!=$B->solved/$B->renshu) return $A->solved/$A->renshu<$B->solved/$B->renshu;
                else return $A->time<$B->time;
        }
usort($S,"ss_cmp");
// $out=json_encode($U);


// {"solved":7,
//         "time":25935,
//         "p_wa_num":{"0":0,"3":1,"5":0,"7":0,"4":0,"9":2,"6":2},
//         "p_ac_sec":{"0":1124,"3":972,"5":1333,"7":3109,"4":4119,"9":4389,"6":4889},
//         "user_id":"1614860029",
//         "nick":"16-\u7535\u5b50-\u902f\u5fd7\u660e",
//         "school":""
// }

// $out=json_encode($U);
// $out=$user_name;
////firstblood
$first_blood=array();
for($i=0;$i<$pid_cnt;$i++){
      $first_blood[$i]="";
}


if($OJ_MEMCACHE){
	$sql="select num,user_id from
        (select num,user_id from solution where contest_id=$cid and result=4 order by solution_id ) contest
        group by num";
        $fb = mysql_query_cache($sql);
        if($fb) $rows_cnt=count($fb);
        else $rows_cnt=0;
}else{
	$sql="select num,user_id from
        (select num,user_id from solution where contest_id=? and result=4 order by solution_id ) contest
        group by num";
        $fb = pdo_query($sql,$cid);
        if($fb) $rows_cnt=count($fb);
        else $rows_cnt=0;
}
for ($i=0;$i<$rows_cnt;$i++){
         $row=$fb[$i];
         $first_blood[$row['num']]=$row['user_id'];
}

/////////////////////////Template
require("template/".$OJ_TEMPLATE."/contestrank-team.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
        require_once('./include/cache_end.php');
?>
