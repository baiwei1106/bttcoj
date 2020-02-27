<?php $show_title=$title." - 公告 - BTTCOJ"; ?>
<?php include("template/$OJ_TEMPLATE/header.php");?>
<div class="padding">
  <h1><?php echo $title?></h1>
 	<p style="margin-bottom: -5px; ">
	<!-- <img style="vertical-align: middle; margin-bottom: 2px; margin-right: 2px; " src="<%= syzoj.utils.gravatar(article.user.email, 34) %>" width="17" height="17"> -->
	<b style="margin-right: 30px; "><i class="edit icon"></i><a class="black-link" href="userinfo.php?user=<?php echo $user_id?>"> <?php echo $user_id?></a></b>
	<b style="margin-right: 30px; "><i class="calendar icon"></i> <?php echo $time?></b>
 	</p>
  <div class="ui existing segment">
	  <div id="content" class="font-content"><?php echo $content?></div>
  </div>
</div>

<?php include("template/$OJ_TEMPLATE/footer.php");?>