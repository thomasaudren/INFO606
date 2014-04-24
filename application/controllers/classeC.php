<?php

include "/application/models/classeM.php";

class classeC
{	
	private $classe;

	public function __construct()
	{
		$this->classe= new classeM;
	}

	public function getClasseById($id)
	{
	 	return $this->classe->getClasseById($id);
	}
}


