<html>
	<head>
		<meta charset="utf-8">
		<link href="css/style.css" rel="stylesheet">
		<?php include ('menu.php'); ?>
		<?php include ('content.php'); ?>
		<title>GameName</title>
	</head>
	<body>
		<?php
		
		if(isset($_GET['page']))
			$page = $_GET['page'];
		else
			$_GET += ['page' => '1'];
		
		?>
		<?php echo Menu::renderMenu($_GET['page'])?>
		<?php echo Content::getPage($_GET['page'])?>
	</body>
</html>
