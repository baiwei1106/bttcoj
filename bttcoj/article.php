<?php
////////////////////////////Common head
	$cache_time=30;
	$OJ_CACHE_SHARE=true;
	require_once('./include/cache_start.php');
        require_once('./include/db_info.inc.php');
        require_once('./include/memcache.php');
	require_once('./include/setlang.php');

///////////////////////////MAIN	
    if(isset($_GET['news_id'])){
        $id=intval($_GET['news_id']);
        $sql="SELECT * FROM `news` WHERE `news_id`=?";
        $result=pdo_query($sql,$id);
        $rows_cnt=count($result);
        foreach ($result as $row){
            $user_id=$row['user_id'];
            $title=$row['title'];
            $content=$row['content'];
            $time=date("Y-m-d",strtotime($row['time']));
        }
        if($rows_cnt==0){
            $view_errors.= "很抱歉，您找的公告不存在!";
            require("template/".$OJ_TEMPLATE."/error.php");
            exit(0);
        }
    }
    else{
        $view_errors.= "很抱歉，参数错误!";
        require("template/".$OJ_TEMPLATE."/error.php");
        exit(0);
    }


/////////////////////////Template
require("template/".$OJ_TEMPLATE."/article.php");
/////////////////////////Common foot
if(file_exists('./include/cache_end.php'))
	require_once('./include/cache_end.php');
?>
