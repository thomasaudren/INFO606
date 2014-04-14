<?php

include "/application/models/personneM.php";

class personneC
{	
	public function __construct()
	{
	}

	public function connexion($log, $pass)
	{
		$personne = new personneM();
		$pass_md5=md5($pass);
		return $personne->connexion($log, $pass_md5);
	}

}