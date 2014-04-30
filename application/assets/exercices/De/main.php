<?php
include("fct.php");

session_start();

if(!Utilisateur::isLogged()) {
	Utilisateur::checkLogin("login", "password");
	if(!Utilisateur::isLogged()) {
		header("Location: index.php");
	}
}

entete();

?>
      <div class="jumbotron">
        <h1>Plateforme éducative</h1>
        <p>Bla bla bla... bla bla....</p>
      </div>
      <div class="row">
        <div class="col-xs-6 col-md-4">
          <h2>Jeux</h2>
          <p>Dans cette partie, vous avez accès à tous les jeux.
          </p>
          <p><a class="btn btn-primary" href="jeux.php">Aller &raquo;</a></p>
        </div>
        <div class="col-xs-6 col-md-4">
          <h2>Profil</h2>
          <p>Dans cette partie, vous avez accès à toutes les informations concernant votre profil (informations personnelles, statistiques, etc.).
          </p>
          <p><a class="btn btn-primary" href="profil.php">Aller &raquo;</a></p>
       </div>
      </div>

<?php footer(); ?>
