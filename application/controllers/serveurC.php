<?php 

include 'personneC.php';

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class serveurC extends CI_Controller {


	public function __construct()
	{
		 parent::__construct();
		 session_start();
	}

	public function connection_appli_serveur(){

		// Constante pour les types de requêtes
		define("MODE_ERREUR", 1);       // Aucune requête valide
		define("MODE_CONNEXION", 2);    // Requête de connexion

		// Récupération de la requête en JSON
		$mode = MODE_ERREUR;
		if(($requete = json_decode(@file_get_contents('php://input'), true, 3)) !== NULL) {
			if(isset($requete['connexion']))	
				$mode = MODE_CONNEXION;
		}

		// Mode erreur
		if($mode == MODE_ERREUR) {
			$reponse = array('reponse' => array('code' => 'ERR'));
			header("Content-type: application/json");
			echo json_encode($reponse);
		}

		// Requête de connexion
		if($mode == MODE_CONNEXION) {
			if(isset($requete['connexion']['login']) && isset($requete['connexion']['password'])) {
				$login = strtoupper($requete['connexion']['login']);
				$password = $requete['connexion']['password'];

				$personne = new personneC();
				
				


				if($personne->connexion($login,$password))
				//if((strcmp($login, "toto") == 0) && (strcmp($password, "toto") == 0))
					$reponse = array('reponse' => array('code' => 'OK'));
				else
					$reponse = array('reponse' => array('code' => "KO"));
			}
			else
				$reponse = array('reponse' => array('code' => 'ERR'));

			header("Content-type: application/json");
			echo json_encode($reponse);
}





	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */