<?php

include "/application/models/exerciceM.php";

class exerciceC
{	
	private $exercice;

	public function __construct()
	{
		$this->exercice= new exerciceM;
	}

	public function ajoutExercice($nom, $idDev, $idNiv, $idMat)
	{
	 	return $this->exercice->ajoutExercice($nom, $idDev, $idNiv, $idMat);
	}
	
}