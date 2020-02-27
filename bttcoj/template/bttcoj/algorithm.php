<?php $show_title="算法分类 - BTTCOJ"; ?>
<?php include("template/$OJ_TEMPLATE/header.php");?>
<link rel="stylesheet" type="text/css" href="<?php echo $OJ_CDN_URL.$path_fix."template/$OJ_TEMPLATE"?>/css/jsmind.css" />
<style type="text/css">
	#jsmind_container {
		width: 100%;
		height: 600px;
	}
	#jsmind_container.a {
		color: #ffffff;
		text-decoration: none;
	}
</style>
<h1 class="ui header">算法标签 - 思维导图</h1>
<div id="jsmind_container" class="ui icon message"></div>
<script src="<?php echo $OJ_CDN_URL.$path_fix."template/$OJ_TEMPLATE"?>/js/jsmind.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $OJ_CDN_URL.$path_fix."template/$OJ_TEMPLATE"?>/js/jsmind.draggable.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo $OJ_CDN_URL.$path_fix."template/$OJ_TEMPLATE"?>/js/luogu.js" type="text/javascript" charset="utf-8"></script>

<?php include("template/$OJ_TEMPLATE/footer.php");?>
