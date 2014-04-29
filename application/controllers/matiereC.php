<?php

include "/application/models/matiereM.php";

class matiereC
{	
	private $matiere;

	public function __construct()
	{
		$this->matiere= new matiereM;
	}

	public function getMatieres()
	{
	 	return $this->matiere->getMatieres();
	}
}