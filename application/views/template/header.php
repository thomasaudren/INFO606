<!DOCTYPE>
<html>
<head>
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="http://localhost/INFO606/application/assets/css/style.css" rel="stylesheet" type="text/css"/>
    <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
</head>
 
<body>
	<?php echo $_SESSION['nom']." ".$_SESSION['profil']; ?>
	<div style='text-align:right' id='header'>
		<div class="notifications">
			<img height='50px' src='http://localhost/INFO606/application/assets/img/icons/Notif.png' />
			<div id="notif">
			</div>
		</div>
		<img height='50px' src='http://localhost/INFO606/application/assets/img/icons/Deco.png' />
	</div>