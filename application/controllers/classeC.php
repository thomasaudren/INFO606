<?php

include "/application/models/classeM.php";

class classeC
{	
	private $classe;

	public function __construct()
	{
		$this->classe= new classeM;
	}

	public function addClasse($idEta, $idNiveau, $lib)
	{
		return $this->classe->addClasse($idEta, $idNiveau, $lib);
	}

	public function getClasseById($id)
	{
	 	return $this->classe->getClasseById($id);
	}

	public function getClassesByIdEtablissement($id)
	{
		return $this->classe->getClassesByIdEtablissement($id);
	}

	public function generateLibClasseByDefault($level, $idEta)
	{
		return $this->classe->generateLibClasseByDefault($level, $idEta);
	}
}


