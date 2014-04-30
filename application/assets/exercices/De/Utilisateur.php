<?php

// C'est le nom de la variable globale contenant l'utilisateur en cours
global $variableGlobale;
$variableGlobale = "bdutilisateur";

// Classe correspondant à un utilisateur
class Utilisateur {
	public static $erreurLogin;    // Dernière erreur de login
	public static $messageLogin;   // Dernière erreur de login
	
	public $login;                 // Login de l'utilisateur
	public $nom;                   // Nom de l'utilisateur

	// Création d'un utilisateur
	function Utilisateur($login, $nom) {
		$this->login = $login;
		$this->nom = $nom;
	}

	// Vérifie si l'utilisateur est loggué
	static function isLogged() {
		global $variableGlobale;
		
		return (isset($_SESSION[$variableGlobale]));
	}
	
	// Récupère le nom
	static function getNom() {
		global $variableGlobale;
		return $_SESSION[$variableGlobale]->nom;
	}

	// Récupère le pseudo
	static function getPseudo() {
		global $variableGlobale;
		return $_SESSION[$variableGlobale]->login;
	}

	// Délogue l'intervenant
	static function unlog() {
		global $variableGlobale;
		
		unset($_SESSION[$variableGlobale]);
	}

	// Récupère le login/mot de passe
	static function checkLogin($log, $pass) {
		
		global $db,$variableGlobale;

		Utilisateur::$erreurLogin = "";

		// Connexion
		/*if(isset($_POST[$log]) && isset($_POST[$pass])) {
			$login = mysql_real_escape_string($_POST[$log]);
			$password = mysql_real_escape_string($_POST[$pass]);

			// Création de l'objet intervenant ($_SESSION['intervenant'])
			if($requete = $db->sql_query("SELECT * FROM `".BD_UTILISATEURS."` WHERE uti_login='$login' AND uti_motdepasse=MD5('$password')")) {
				if($tableau = $db->sql_fetchrow($requete))
					$_SESSION[$variableGlobale] = new Utilisateur($tableau['uti_login'], $tableau['uti_nom']);
				else
					Utilisateur::$erreurLogin = "Mauvais login";
			}
			else {
				Utilisateur::$erreurLogin = "Erreur de base de données.";
			}		
		}*/	

		// Envoi de la requête
		if(isset($_POST[$log]) && isset($_POST[$pass])) {
			
			$login = mysql_real_escape_string($_POST[$log]);
			$password = mysql_real_escape_string($_POST[$pass]);

	$donnees = json_encode(array('connexion' => array('login' => $login, 'password' => $password)));
	print_r($donnees);
	//$reponse = Utilisateur::postRequest("http://localhost/serveur/index.php", $donnees);
$reponse = Utilisateur::postRequest("http://localhost/INFO606/index.php/serveurC/connection_appli_serveur", $donnees);
//$reponse = json_encode(array('reponse' => array('code' => "OK" )));
print_r($reponse);
	// Analyse de la réponse
	$array = json_decode($reponse, true);
	print_r($array);
	//echo "Code de retour = ".$array['reponse']['code'];
	if($array['reponse']['code'] == "OK")
					$_SESSION[$variableGlobale] = new Utilisateur($login, "ON S EN TAPE");
	else if($array['reponse']['code'] == "KO")
					Utilisateur::$erreurLogin = "Mauvais login";
	else
		Utilisateur::$erreurLogin = "Erreur de base de données.";

			
}

	}

	// Envoi une requête JSON
static function postRequest($url, $donnees) {
	
	/*$reponse =  json_encode(
					array('reponse' => 
							array('code' => "OK" )
						)
					);
	*/
	$params = array('http' => array(
		'header' => array("Accept: application/json", "Content-type: application/json"),
		'method' => 'POST',
		'content' => $donnees));
		
	$contexte = stream_context_create($params);
	
	if(!($fp = @fopen($url, 'rb', false, $contexte))) {
		throw new Exception("Erreur lors de l'accès à $url, $php_errormsg");
	}
	if(($reponse = @stream_get_contents($fp)) === false) {
		throw new Exception("Problème lors de la lecture des données depuis $url, $php_errormsg");
	}
	
	return $reponse;
}


} // class Utilisateur

?>