<?php

include("fct.php");

session_start();

global $variableGlobale;
if(Utilisateur::isLogged()) {
	$login = $_SESSION[$variableGlobale]->login;
	Utilisateur::unlog();
	Utilisateur::$messageLogin = "Vous êtes délogué.";
}
else {
	Utilisateur::checkLogin("login", "password");
	if(Utilisateur::isLogged()) {
		header("Location: main.php");
	}
	$login = "";
}

enteteHTML();
?>
  </head>

  <body>
  	
    <div class="container">  	
      <h2 class="form-signin-heading">Connexion</h2>
		<?php
		if(Utilisateur::$erreurLogin != "")
			boiteAlerte(Utilisateur::$erreurLogin);
		if(Utilisateur::$messageLogin != "")
			boiteSucces(Utilisateur::$messageLogin);
		?>	      
      <form role="form" action="" method="post">
        <div class="form-group">
          <label for="login">Login</label>
          <input type="text" name="login" class="form-control" placeholder="Saisir votre login" value="<?php echo $login; ?>">
        </div>
        <div class="form-group">
          <label for="password">Mot de passe</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Saisir votre mot de passe">
        </div>
        <button class="btn btn-large btn-primary" type="submit">Valider</button>
      </form>
      
<?php footer(); ?>
