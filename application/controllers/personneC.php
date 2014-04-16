<?php

include "/var/www/html/INFO606/application/models/personneM.php";

class personneC
{	
	private $personne;

	public function __construct()
	{
		$this->personne= new personneM;
	}

	public function connexion($log, $pass)
	{
		$pass_md5=md5($pass);
		return $this->personne->connexion($log, $pass_md5);
	}

	public function getPersonneByLogin($log)
	{
		return $this->personne->getPersonneByLogin($log);
	}

	public function getProfilById($id)
	{
		return $this->personne->getProfilById($id);
	}
}