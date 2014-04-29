<?php

include "/application/models/niveauM.php";

class niveauC
{	
	private $niveau;

	public function __construct()
	{
		$this->niveau= new niveauM;
	}

	public function getNiveaux()
	{
	 	return $this->niveau->getNiveaux();
	}
}