<?php
include("fct.php");
include("De.php");

session_start();

// V�rifie que l'utilisateur est loggu�
if(!Utilisateur::isLogged()) {
	Utilisateur::checkLogin("login", "password");
	if(!Utilisateur::isLogged()) {
		header("Location: index.php");
	}
}

// Affiche le menu et le sous-menu
entete("Jeux");
sousmenu("Jeux", "Jeux de d�s");

// Constante pour la navigation
define("MODE_NONE", 0);         // Mode par d�faut
define("MODE_DEBUT", 1);        // Lancement d'une nouvelle partie
define("MODE_CHECK", 2);        // V�rification de ce qui a �t� cliqu� + lancer suivant
define("MODE_LANCER", 3);       // Affichage du lancer

// R�cup�ration du mode en cours ; si non pr�sent, retour au mode par d�faut
if(isset($_POST['mode'])) {	
	$mode = ($_POST['mode']);
}
else {
	$mode = MODE_NONE;
	unset($_SESSION['jeuDe']);
}

// Permet de contr�ler la validit� des formulaires (retour en arri�re, rechargement...)
if(!Transaction::check()) {
	$mode = MODE_NONE;
	unset($_SESSION['jeuDe']);
}

// V�rification de la saisie
if($mode == MODE_CHECK) {
	$_SESSION['jeuDe']->recupereReponse();
	
	if($_SESSION['jeuDe']->estFini()) {
		boiteInfo("Ton score est de ".$_SESSION['jeuDe']->getBonnnesReponses()." bonne(s) r�ponse(s).", false);
		$_SESSION['jeuDe']->afficheRecapitulatif();

		// Ceci est la cha�ne � sauvegarder
		$str = $_SESSION['jeuDe']->toString();
		//echo $str;
		
		// On peut r�cup�rer le jeu depuis la m�me cha�ne (l'affichage doit �tre le m�me) 
		/*$tmp = De::fromString($str);
		$tmp->afficheRecapitulatif();*/

		/*
			$requete['save']['login'] = $l;
			$requete['save']['nom_exercice'] = $ID;
			$requete['save']['percent'] = $note;
			$requete['save']['graine'] = $GRAINE;
		*/
		//print_r($str);
$donnees = json_encode(array('save' => 
					array('login' => Utilisateur::getPseudo(),
						'nom_exercice' => "JEU",
						'percent' => "{$_SESSION['jeuDe']->getBonnnesReponses()}",
						'graine' => "{$str}")
					));
			$params = array('http' => array(
		'header' => array("Accept: application/json", "Content-type: application/json"),
		'method' => 'POST',
		'content' => $donnees));
			$url = "http://localhost/INFO606/serveurC/save_date";
		
	$contexte = stream_context_create($params);
	if(!($fp = @fopen($url, 'rb', false, $contexte))) {
		throw new Exception("Erreur lors de l'acc�s � $url, $php_errormsg");
	}
	if(($reponse = @stream_get_contents($fp)) === false) {
		throw new Exception("Probl�me lors de la lecture des donn�es depuis $url, $php_errormsg");
	}

	echo "reponce du serveur : ".$reponse;

		
?>
<center>
	<form class="form-inline" method="post" action="">
		<input type="hidden" name="mode" value="<?php echo MODE_DEBUT; ?>">
		<?php Transaction::input(); ?>
		<button class="btn btn-success" type="submit">Recommencer</button>
	</form>	
</center>
<?php
	}
	else
		$mode = MODE_LANCER;
}

// Initialisation du jeu
if($mode == MODE_DEBUT) {
	$_SESSION['jeuDe'] = new De(6, 3, NB_LANCERS);
	$mode = MODE_LANCER;
}

// Affichage du lancer courant
if($mode == MODE_LANCER) {
	progressBar(0, NB_LANCERS - 1, $_SESSION['jeuDe']->courant);
	?>
	<center>
		<div class="alert"><?php $_SESSION['jeuDe']->afficheTirageCourant(); ?><br/></div>		
		<div class="alert alert-warning">Compte les points puis clique sur le bouton correspondant</div>
		<form class="form-inline" method="post" action="">
			<input type="hidden" name="mode" value="<?php echo MODE_CHECK; ?>">
			<?php Transaction::input(); ?>
		<?php
			$_SESSION['jeuDe']->afficheBoutons();
		?>
		</form>
	</center>
	<?php
}

// Mode par d�faut
if($mode == MODE_NONE) {
	boiteInfo("Pour lancer une partie, cliquez sur le bouton D�marrer.", false);
	
	?>
<center>
	<form class="form-inline" method="post" action="">
		<input type="hidden" name="mode" value="<?php echo MODE_DEBUT; ?>">
		<?php Transaction::input(); ?>
		<button class="btn btn-success" type="submit">D�marrer</button>
	</form>	
</center>
	<?php
}

footer(); 
?>
