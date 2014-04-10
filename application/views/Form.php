<?php


?>

<html>
<head>
	<link href="/application/assets/css/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
</head>
<body>
	<form action="/application/utils/init.php" method='POST' enctype="multipart/form-data">
		<input type='text' placeholder='nom' name='nomExercice' /><br>
		<input type='text' placeholder='auteur' name='createur' /><br>
		<input type='text' placeholder='langue' name='langue' /><br>
		<input type='text' placeholder='matiere' name='matiere' /><br>
		<input type='text' placeholder='niveau' name='niveau' /><br>
		<input type="file" name="exercice" /></br>
		<input type='submit' value='Envoyer' />
</body>
</html>