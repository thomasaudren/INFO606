<?php

include "connexion.php";

class personneM
{
	public function __construct()
	{
	}

	public function connexion($log, $pass)
	{
		$stmt = myPDO::donneInstance()->query(<<<SQL
			SELECT login, password 
			FROM PERSONNE
			WHERE login='{$log}' AND password='{$pass}'
SQL
);
		if($stmt->fetch())
		{
			return true;
		}
		else
		{
			return false;
		}

	}

}