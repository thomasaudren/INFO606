<?php
include("fct.php");

session_start();

if(!Utilisateur::isLogged()) {
	Utilisateur::checkLogin("login", "password");
	if(!Utilisateur::isLogged()) {
		header("Location: index.php");
	}
}

entete("Jeux");
sousmenu("Jeux");
?>

<div class="row">
	<div class="col-xs-6 col-md-4">
		<h2>Jeu de d�s</h2>
		<p>
			Ce jeu de d�s est en passe de d�tr�ner le tr�s c�l�bre Candy Crush.
		</p>
		<p><a class="btn btn-primary" href="jeux_des.php">Aller &raquo;</a></p>
	</div>
	<div class="col-xs-6 col-md-4">
		<h2>A venir...</h2>
		<p>
			Pour le moment, un seul jeu. C'est d�j� bien !!!
		</p>
		<!--<p><a class="btn btn-primary" href="jeux_suite.php">Aller &raquo;</a></p>-->
	</div>
</div>

<?php footer(); ?>
