<?php
include("fct.php");

session_start();

if(!Utilisateur::isLogged()) {
	Utilisateur::checkLogin("login", "password");
	if(!Utilisateur::isLogged()) {
		header("Location: index.php");
	}
}

entete("Profil");
sousmenu("Profil");
?>

<div class="row">
	<div class="span6">
		<h3>Informations personnelles</h3>
		<p>
			Cette section a pour but d'afficher vos informations personnelles.
		</p>
		<p><a class="btn" href="profil_gestion.php">Aller &raquo;</a></p>
	</div>
	<div class="span6">
		<h3>Statistiques</h3>
		<p>
			Cette section a pour but d'afficher vos statistiques.
		</p>
		<p><a class="btn" href="profil_stats.php">Aller &raquo;</a></p>
	</div>
</div>

<?php footer(); ?>
