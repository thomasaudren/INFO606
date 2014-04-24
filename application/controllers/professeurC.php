<?php

include "/application/models/professeurM.php";

class professeurC
{	
	private $professeur;

	public function __construct()
	{
		$this->professeur= new professeurM;
	}

	public function getClassesById($id)
	{
	 	return $this->professeur->getClassesById($id);
	}
}





