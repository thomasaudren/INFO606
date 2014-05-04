<?php

include "/application/models/eleveM.php";

class eleveC
{	
	private $eleve;

	public function __construct()
	{
		$this->eleve= new eleveM;
	}

	public function getElevesByIdProf($id)
	{
	 	return $this->eleve->getElevesByIdProf($id);
	}

	public function getClasseById($id)
	{
		return $this->eleve->getClasseById($id);
	}

	public function getExercicesByIdEleve($id)
	{
		return $this->eleve->getExercicesByIdEleve($id);
	}

	public function getMoyenneMathsById($id)
	{
		return $this->eleve->getMoyenneMathsById($id);
	}

	public function getMoyenneFraById($id)
	{
		return $this->eleve->getMoyenneFraById($id);
	}

	public function getElevesByEtablissement($id)
	{
		return $this->eleve->getElevesByEtablissement($id);
	}
}