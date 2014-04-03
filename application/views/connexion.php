<?php


?>
<html>
<head>
	<title>Connexion</title>
	<link href="/application/assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<div style='width:300px'>
		<form class='well' action=<?php echo 'index.php/welcome/redirect' ?> method='POST'> 
			<input type='text' name='login' class='form-control' placeholder='Login'/>
			<input type='password' name='pass' class='form-control' placeholder='Pass'/>
			<input type='submit' value='Se connecter' class='btn btn-primary' />
		</form>
	</div>
</body>
</html>