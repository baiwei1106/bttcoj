<?php 
	$url=basename($_SERVER['REQUEST_URI']);
	$dir=basename(getcwd());
	if($dir=="discuss3") $path_fix="../";
	else $path_fix="";
 	if(isset($OJ_NEED_LOGIN)&&$OJ_NEED_LOGIN&&(
                  $url!='loginpage.php'&&
                  $url!='lostpassword.php'&&
                  $url!='lostpassword2.php'&&
                  $url!='registerpage.php'
                  ) && !isset($_SESSION[$OJ_NAME.'_'.'user_id'])){
 
           header("location:".$path_fix."loginpage.php");
           exit();
        }

	if($OJ_ONLINE){
		require_once($path_fix.'include/online.php');
		$on = new online();
	}
?>

<!DOCTYPE html>
<html lang="zh-CN" style="position: fixed; width: 100%; overflow: hidden; ">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=1200">
    <meta name="keywords" content="BTTCACM,包头师范学院ACM协会,BTTCOJ,Online Judge,包头师范学院Online judge,信息学,信息学竞赛,acm,竞赛,onlineJudge,BTTCOnlinejudge,信息学学习" />
    <meta name="description" content="包头师范学院ACM程序设计协会，是基于国际大学生ACM程序设计竞赛而成立的实践类学习型的学生社团，包头师范学院程序设计协会热忱欢迎对编程有兴趣或想学好编程的同学的加入！" />
    <title><?php echo $show_title?></title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>
    <script src="https://cdnjs.loli.net/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body style="position: relative; margin-top: 49px; height: calc(100% - 49px); overflow-y: overlay; ">
<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>
    <div class="ui fixed borderless menu" style="position: fixed; height: 49px; ">
        <div class="ui container">
            <!--<a class="header item" href="/"><img src="<%= syzoj.config.logo.url %>" style="width: <%= width %>; height: <%= height %>; "></a>-->
            <a class="header item" href="/"><span style="font-family: 'Exo 2'; font-size: 1.5em; font-weight: 600; "><?php echo $OJ_NAME?></span></a>
            <a class="item <?php if ($url=="") echo "active";?>" href="/"><i class="home icon"></i> 首页</a>
            <a class="item <?php if ($url=="problemset.php") echo "active";?>" href="<?php echo $path_fix?>problemset.php"><i class="list icon"></i> 题库</a>
            <a class="item <?php if ($url=="contest.php") echo "active";?>" href="<?php echo $path_fix?>contest.php"><i class="calendar icon"></i> 比赛</a>
            <a class="item <?php if ($url=="status.php") echo "active";?>" href="<?php echo $path_fix?>status.php"><i class="tasks icon"></i> 评测</a>
            <a class="item <?php if ($url=="ranklist.php") echo "active";?>" href="<?php echo $path_fix?>ranklist.php"><i class="signal icon"></i> 排名</a>
            <!--<a class="item <?php //if ($url=="contest.php") echo "active";?>" href="/discussion/global"><i class="comments icon"></i> 讨论</a>-->
            <a class="item <?php if ($url=="faqs.php") echo "active";?>" href="<?php echo $path_fix?>faqs.php"><i class="help circle icon"></i> 帮助</a>
            
            <?php if(isset($_GET['cid'])){
            	$cid=intval($_GET['cid']);
            ?>
            <!-- <span class="item" href="#">[</span>
            <a class="item active" href="<?php echo $path_fix?>contest.php?cid=<?php echo $cid?>">问题</a>
            <a class="item active" href="<?php echo $path_fix?>status.php?cid=<?php echo $cid?>">提交记录</a>
            <a class="item active" href="<?php echo $path_fix?>contestrank.php?cid=<?php echo $cid?>">排名</a>
            <a class="item active" href="<?php echo $path_fix?>contestrank-team.php?cid=<?php echo $cid?>">队伍排名</a>
            <span class="item" href="#">]</span> -->
            <a id="back_to_contest" class="item" href="<?php echo $path_fix?>contest.php?cid=<?php echo $cid?>"><i class="arrow left icon"></i> 返回比赛</a>
            <?php }?>
            
            
            <div class="right menu">
            	
            	<?php if(isset($_SESSION[$OJ_NAME.'_'.'user_id'])){
            		

				?>
	              <a href="<?php echo $path_fix?>/userinfo.php?user=<?php echo $_SESSION[$OJ_NAME.'_'.'user_id']?>" style="color: inherit; ">
	              <div class="ui simple dropdown item">
	              	<?php echo $_SESSION[$OJ_NAME.'_'.'user_id']; ?>
	              		<i class="dropdown icon"></i>
                <div class="menu">
                  <a class="item" href="<?php echo $path_fix?>modifypage.php"><i class="edit icon"></i>修改资料</a>
               <?php if(isset($_SESSION[$OJ_NAME.'_'.'administrator'])||isset($_SESSION[$OJ_NAME.'_'.'contest_creator'])||isset($_SESSION[$OJ_NAME.'_'.'problem_editor'])){ ?>
                  <a class="item" href="<?php echo $path_fix ?>/admin"><i class="settings icon"></i>后台管理</a>
                  <?php } ?>
                  <a class="item" href="<?php echo $path_fix?>/logout.php"><i class="power icon"></i>注销</a>
                </div>
              </div>
              </a>
              	<?php } else { ?>
              		

                <div class="item">
                    <a class="ui button" style="margin-right: 0.5em; " href="<?php echo $path_fix?>/loginpage.php">
                        登录
                    </a>
		<?php if(isset($OJ_REGISTER)&&$OJ_REGISTER ){ ?>
                    <a class="ui primary button" href="<?php echo $path_fix?>/registerpage.php">
                        注册
                    </a>
		<?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div style="margin-top: 28px; ">
    <div class="ui main container">
