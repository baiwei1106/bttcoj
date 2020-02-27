<?php $show_title="题目分类 - BTTCOJ"; ?>
<?php include("template/$OJ_TEMPLATE/header.php");?>
<div class="padding">
    <div style="margin-top: 0px; margin-bottom: 14px; padding-bottom: 0px; " >
        <p class="transition visible">
           <h1 style="margin-left: 10px; display: inline-block; ">题目标签</h1>
		<div style="margin-left: 10px; display: inline-block; ">
<a style="margin-left: 10px; " href="algorithm.php" class="ui labeled icon mini green button"><i class="plus icon"></i> 查看思维导图</a>
</div>
        </p>
        <div class="ui existing segment">
        <?php echo $view_category?>
        </div>
    </div>
<?php include("template/$OJ_TEMPLATE/footer.php");?>
