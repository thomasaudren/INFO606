<?php 

include 'personneC.php';
include 'classeC.php';
include 'eleveC.php';
include 'professeurC.php';
include 'matiereC.php';
include 'niveauC.php';
include 'agendaC.php';

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {


	public function __construct()
	{
		 parent::__construct();
		 session_start();
	}
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->load->view('welcome_message');

		// définition des données variables du template
	    $data['title'] = 'Connexion';
	     
	 	if(isset($_SESSION['id']))
	 	{
	 		$data['title'] = 'Accueil';
	 		if($_SESSION['profil']=="Professeur")
			{
				$data['contents'] = 'menu';
			}
			else if($_SESSION['profil']=="Developpeur")
			{
				$data['contents'] = 'form';
			}
			else if($_SESSION['profil']=="Directeur")
			{
				$data['contents'] = 'menu';
			}
	 		$this->load->view('template/template', $data);
	 	}
	    // on charge la page dans le template
	    else 
	    {
	    	$this->load->view('connexion');
	    }

	}
	public function test($graine){
		$this->load->library('Jeu');
		$this->load->library('Exercice/Exercice');
		$this->jeu->replay($graine);
		$this->exercice->replay($graine);
		$this->exercice->init($graine);
	}

	public function logout(){
		$_SESSION = array();
		session_destroy();
		$this->load->view('connexion');
	}

	public function replay($exoName,$seed){
		//echo $exoName." ".$seed;
		//echo "coucou";
		include("/application/assets/exercices/".$exoName."/".$exoName.".php");
		$tmp = $exoName::fromString($seed);
		$tmp->afficheRecapitulatif();
	}

	public function verifProfilProf()
	{
		$res;
		if($_SESSION['profil']=="Professeur" || $_SESSION['profil']=="Directeur")
		{
			$res = true;
		}
		else
		{
			$res = false;
		}
		return $res;
	}

	public function stats(){
		if($this->verifProfilProf())
		{
			$this->load->view('stats');
		}
		else
		{
			$this->redirect();
		}
	}

	public function statsBy(){
		if($this->verifProfilProf())
		{
			$this->load->view('statsByEleve');
		}
		else
		{
			$this->redirect();
		}
	}

	public function login(){
		$this->load->view('test');
	}

	public function init(){
		$this->load->view('init');
	}

	public function param(){
		$this->load->view('param');
	}

	public function essa(){
		$this->load->view('test');
	}

	public function addStudent(){
		if($this->verifProfilProf())
		{
			$personneC = new personneC();
			$login = $personneC->generateLoginByNomPersonne($_POST['nom']);
			$personneC->addPersonne($_POST['nom'], $_POST['prenom'], $_POST['birthday'], $login, 1);
			$personne = $personneC->getPersonneByLogin($login);
			$personneC->personneToEtablissementByIdPersonneAndIdEtablissement($personne['id'], $_POST['eta']);
			$personneC->personneToClasseByIdPersonneAndIdClasse($personne['id'], $_POST['classe']);

			header('Location: param');
		}
		else
		{
			$this->redirect();
		}
	}

	public function addClasse(){
		if($this->verifProfilProf())
		{
			$classeC = new classeC();
			if(empty($_POST['lib']))
			{
				$lib = $classeC->generateLibClasseByDefault($_POST['niveau'], $_POST['eta']);
			}
			else
			{
				$lib = $_POST['lib'];
			}
			$classeC->addClasse($_POST['eta'], $_POST['niveau'], $lib);

			header('Location: param');
		}
		else
		{
			$this->redirect();
		}
	}

	public function getClasses()
	{
		$classeC = new classeC();
		$classes = $classeC->getClassesByIdEtablissement($_POST['id']);
		$i=0; $options="";
		while($i<sizeof($classes))
		{
			$options.="<option value='".$classes[$i]['id']."'>".$classes[$i]['lib']."</option>";
			$i++;
		}

		echo $options;
	}

	public function redirect()
	{
		$data['title'] = 'Accueil';
		if(isset($_POST['login']) && isset($_POST['pass']))
		{
			$personne = new personneC;
			// définition des données variables du template
	    	
	    	// on charge la view qui contient le corps de la page
			$data['contents'] = '';
	    	
	    	
				if($personne->connexion(strtoupper ($_POST['login']), $_POST['pass']))
				{
					$P = $personne->getPersonneByLogin($_POST['login']);
					//Gestion erreurs
					
					$_SESSION['login'] = $_POST['login'];
					$_SESSION['profil'] = $P['profil'];
					$_SESSION['id'] = $P['id'];
					$_SESSION['nom'] = $P['nom'];
					$_SESSION['prenom'] = $P['prenom'];

					if($P['profil']=='Professeur' || $P['profil']=='Directeur')
					{
						$PE=$personne->getEtablissementByIdPersonne($P['id']);
						$_SESSION['idEta'] = $PE[0]['id'];
					}
															
				}
	    	}

	    	if($_SESSION['profil']=="Professeur")
			{
				$data['contents'] = 'menu';
			}
			else if($_SESSION['profil']=="Developpeur")
			{
				$data['contents'] = 'form';
			}
						
		
		else
		{
			 redirect('welcome', 'refresh');
		}
			$this->load->view('template/template', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */