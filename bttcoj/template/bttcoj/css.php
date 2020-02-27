<?php 
	$dir=basename(getcwd());
	if($dir=="discuss3"||$dir=="admin") $path_fix="../";
	else $path_fix="";
?>
<link rel="stylesheet" href="<?php echo $OJ_CDN_URL.$path_fix."template/$OJ_TEMPLATE"?>/css/style.css">
<link rel="stylesheet" href="<?php echo $OJ_CDN_URL.$path_fix."template/$OJ_TEMPLATE"?>/css/tomorrow.css">
<link rel="stylesheet" href="<?php echo $OJ_CDN_URL.$path_fix."template/$OJ_TEMPLATE"?>/css/mathjax.css">
<link rel="stylesheet" href="<?php echo $OJ_CDN_URL.$path_fix."template/$OJ_TEMPLATE"?>/css/index.css?v=1.2">
<link href="https://cdnjs.loli.net/ajax/libs/semantic-ui/2.4.1/semantic.min.css" rel="stylesheet">
<link href="https://cdnjs.loli.net/ajax/libs/KaTeX/0.10.0/katex.min.css" rel="stylesheet">
<link href="https://cdnjs.loli.net/ajax/libs/morris.js/0.5.1/morris.css" rel="stylesheet">
<link href="https://fonts.loli.net/css?family=Fira+Mono" rel="stylesheet">
<link href="https://fonts.loli.net/css?family=Lato:400,700,400italic,700italic&subset=latin" rel="stylesheet">
<link href="https://fonts.loli.net/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=latin-ext" rel="stylesheet">
<link href="https://fonts.loli.net/css?family=Exo+2:600" rel="stylesheet">
