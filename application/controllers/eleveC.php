<?php

include "/application/models/eleveM.php";

class eleveC
{	
	private $eleve;

	public function __construct()
	{
		$this->eleve= new eleveM;
	}

	public function recupElevesByProf($id)
	{
	 	return $this->eleve->recupElevesByProf($id);
	}

	public function getClasseById($id)
	{
		return $this->eleve->getClasseById($id);
	}

	public function getExercicesByIdEleve($id)
	{
		return $this->eleve->getExercicesByIdEleve($id);
	}
}