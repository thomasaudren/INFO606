<?php 

include 'personneC.php';

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
	     
	 
	    // on charge la page dans le template
	    $this->load->view('connexion');

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

	public function stats(){
		$this->load->view('stats');
	}

	public function statsBy(){
		$this->load->view('statsByEleve');
	}

	public function init(){
		$this->load->view('init');
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
															
				}
	    	}

	    	if($_SESSION['profil']=="Professeur")
			{
				$data['contents'] = 'menu';
			}
			else if($_SESSION['profil']=="Developpeur")
			{
				$data['contents'] = 'Form';
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