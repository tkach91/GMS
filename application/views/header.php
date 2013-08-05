<?php header('Content-Type: text/html; charset=utf-8'); ?>
<html>
	<head>
		<title><?php echo $title;?></title>
	</head>
	<body>
		<script type="text/javascript" src="/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="/js/datepicker/datepicker.js"></script>
		<script type="text/javascript" src="/js/jquery.tablesorter/jquery.tablesorter.min.js"></script>
		<link rel="stylesheet" type="text/css" media="all" href="/js/datepicker/datepicker.css"/>
		<link rel="stylesheet" type="text/css" media="print, projection, screen" href="/js/jquery.tablesorter/themes/blue/style.css"/> 
		<link rel="stylesheet" type="text/css" media="print, projection, screen" href="/theme/style.css"/> 
		<div class = "header"><h1><?php echo $heading;?></h1></div>
	</body>
</html>