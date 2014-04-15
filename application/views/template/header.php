<!DOCTYPE>
<html>
<head>
    <title><?php echo $title; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href=<?php echo base_url()."application/assets/css/style.css" ?> rel="stylesheet" type="text/css"/>
    <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
</head>
 
<body>
	
	<div style='text-align:right' id='header'>
		<div id="identifiant" >
			<?php echo $_SESSION['nom']." ".$_SESSION['profil']; ?>
		</div>
		<div class="notifications">
			<img height='50px' src=<?php echo base_url().'application/assets/img/icons/Notif.png' ?> />
			<div id="notif">
			</div>
		</div>
		<a href=<?php echo base_url().'welcome/logout' ?>>
			<img height='50px' src=<?php echo base_url().'application/assets/img/icons/Deco.png' ?> />
		</a>
	</div>