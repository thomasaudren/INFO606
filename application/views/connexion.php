<?php



?>
<html>
<head>
	<title>Connexion</title>
	<link href="http://localhost/INFO606/application/assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
</head>
<body style="background-image:url('http://localhost/INFO606/application/assets/img/background/conn.png');background-size:100%;">
	<div style='width:20%;margin-top:10%;margin-left:40%' class='well'>
		<form align='center' action=<?php echo 'index.php/welcome/redirect' ?> method='POST'> 
			<input type='text' name='login' class='form-control' placeholder='Login' required/>
			<input type='password' name='pass' class='form-control' placeholder='Pass' required/>
			<input type='submit' value='Se connecter' class='btn btn-primary' />
		</form>
	</div>
</body>
</html>