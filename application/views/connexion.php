<html>
	<head>
		<title>Connexion</title>
		<link href=<?php echo base_url()."application/assets/css/bootstrap/css/bootstrap.css" ?> rel="stylesheet" type="text/css"/>
	</head>
	<body style="background-image:url('http://localhost/INFO606/application/assets/img/background/conn.png');background-repeat: no-repeat; background-attachment: fixed; background-size: cover; ">
		<div style='width:20%;margin-top:10%;margin-left:40%' class='well'>
			<form align='center' action=<?php echo base_url().'welcome/redirect' ?> method='POST'> 
				<input type='text' name='login' class='form-control' placeholder='Login' required/>
				<input type='password' name='pass' class='form-control' placeholder='Pass' required/>
				<input type='submit' value='Se connecter' class='btn btn-primary' />
			</form>
		</div>
	</body>
</html>

<?php 

include "/application/models/eleveM.php";

ini_set('display_errors', 1);

$m = new eleveM();
try{
	$m->recupElevesByProf(2); 
} 
catch (PDOException $e) {
echo"<pre>";
    echo 'Échec : ' . $e->getMessage();
var_dump($e);
echo"</pre>";
}
