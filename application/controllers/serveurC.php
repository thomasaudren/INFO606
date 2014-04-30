<?php 

include 'personneC.php';

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// Constante pour les types de requêtes
		define("MODE_ERREUR", 1);       // Aucune requête valide
		define("MODE_CONNEXION", 2);    // Requête de connexion

class serveurC extends CI_Controller {


	public function __construct()
	{
		 parent::__construct();
		 session_start();
	}

	public function connection_appli_serveur(){

		

		// Récupération de la requête en JSON
		$mode = MODE_ERREUR;
		$var = @file_get_contents('php://input');
		if(($requete = json_decode($var, true, 3)) !== NULL) {
			if(isset($requete['connexion']))	
				$mode = MODE_CONNEXION;
		}

		

		// Mode erreur
		if($mode == MODE_ERREUR) {
			$reponse = array('reponse' => array('code' => 'ERR'));
			header("Content-type: application/json");
			echo json_encode($reponse);
			die();
		}

		if($mode == MODE_CONNEXION) 
		{

			//$requete['connexion'] = array('login' => "audre001",'password' => "admin" );
			if(isset($requete['connexion']['login']) && isset($requete['connexion']['password'])) 
			{
				$login = strtoupper($requete['connexion']['login']);
				$password = md5($requete['connexion']['password']);
				$personne = new personneC();
				$test = NULL;
				
				try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=606', 'root', '');
		}
		catch (Exception $e)
		{
		        die('Erreur : ' . $e->getMessage());
		}

		$reponse_sql = $bdd->query("SELECT * 
								FROM personne 
								WHERE LOGIN LIKE '{$login}' 
									AND PASSWORD LIKE '{$password}'");
		

		
		$test = $reponse_sql->fetch(PDO::FETCH_OBJ);

				if($test)
				{
					$reponse = array('reponse' => array('code' => 'OK'));
				}
				else
				{
					$reponse = array('reponse' => array('code' => "KO"));
				}

			}
			else
			{
				$reponse = array('reponse' => array('code' => 'ERR'));
			}
			
			
		header("Content-type: application/json");
		echo json_encode($reponse);
		}


					/*if($monfichier = fopen('log.txt', 'a+'))
					{
						$ligne = fgets($monfichier);
						$foo = print_r("toto", true);
						fwrite($monfichier, $foo);
						fclose($monfichier);
					}*/



	}

	public function save_date(){
//echo $l." ".$ID." ".$GRAINE." ".$note;
		// Récupération de la requête en JSON
		$var = @file_get_contents('php://input');
		$requete = json_decode($var, true,3);
		
		

		
//$mode = MODE_CONNEXION;
		
//echo "\nla\n";
			/*$requete['save']['login'] = $l;
			$requete['save']['nom_exercice'] = $ID;
			$requete['save']['percent'] = $note;
			$requete['save']['graine'] = $GRAINE;*/
			echo json_encode($requete);
			if(isset($requete['save']['login']) 
				&& isset($requete['save']['nom_exercice'])
				&& isset($requete['save']['percent'])
				&& isset($requete['save']['graine'])
				) 
			{
				$login = strtoupper($requete['save']['login']);
				$NOM_EXERCICE = strtoupper($requete['save']['nom_exercice']);
				$GRAINE = $requete['save']['graine'];
				$PERCENT = $requete['save']['percent'];
				$DATE = NULL;
				
				try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=606', 'root', '');
		}
		catch (Exception $e)
		{
		        die('Erreur : ' . $e->getMessage());
		}
//echo "hello";
		$reponse_sql1 = $bdd->query("SELECT *
										FROM `exercice`
										WHERE `LIB_EXERCICE` LIKE '{$NOM_EXERCICE}'");
		$ID_EXERCICE = $reponse_sql1->fetch(PDO::FETCH_ASSOC);
		$ID_EXERCICE = $ID_EXERCICE['ID_EXERCICE'];
//echo " id exo".($ID_EXERCICE);
//echo "coucou";
		$reponse_sql2 = $bdd->query("INSERT INTO `exercer`
									(`ID_EXERCICE`, 
									`GRAINE`, 
									`PERCENT`,
									`DATE`, 
									`ID_PERSONNE`) 
									select {$ID_EXERCICE},'{$GRAINE}',{$PERCENT},NULL,
									p.`ID_PERSONNE`
											FROM personne p
											WHERE `LOGIN` LIKE '{$login}'
								");
		
	
		$test = $reponse_sql2;

				if($test)
				{
					$reponse = array('reponse' => array('code' => 'OK'));
				}
				else
				{
					$reponse = array('reponse' => array('code' => "KO"));
				}

			}
			else
			{
				$reponse = array('reponse' => array('code' => 'ERR'));
			}
			
			
		header("Content-type: application/json");
		echo json_encode($reponse);
		


	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */