<?php

include "/application/models/personneM.php";

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

	public function getProfilByIdPersonne($id)
	{
		return $this->personne->getProfilByIdPersonne($id);
	}

	public function getEtablissementByIdPersonne($id)
	{
		return $this->personne->getEtablissementByIdPersonne($id);
	}

	public function personneToEtablissementByIdPersonneAndIdEtablissement($idPer, $idEta)
	{
		return $this->personne->personneToEtablissementByIdPersonneAndIdEtablissement($idPer, $idEta);
	}

	public function personneToClasseByIdPersonneAndIdClasse($idPer, $idCla)
	{
		return $this->personne->personneToClasseByIdPersonneAndIdClasse($idPer, $idCla);
	}

	public function generateLoginByNomPersonne($nom)
	{
		return $this->personne->generateLoginByNomPersonne($nom);
	}

	public function addPersonne($nom, $prenom, $date, $login, $profil)
	{
		return $this->personne->addPersonne($nom, $prenom, $date, $login, $profil);
	}
}