<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	    $data['title'] = 'Menu';
	     
	    // on charge la view qui contient le corps de la page
	    $data['contents'] = 'menu';
	 
	    // on charge la page dans le template
	    $this->load->view('template/template', $data);

	}
	public function test($graine){
		$this->load->library('Jeu');
		$this->load->library('Exercice/Exercice');
		$this->jeu->replay($graine);
		$this->exercice->replay($graine);
		$this->exercice->init($graine);
	}

	public function formulaire()
	{
		$this->load->view('Form');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */