<?php

include "../../connexion.php";

class paysM
{
	public function __construct()
	{
	}

	public function creerPays($nom)
	{
		$stmt = myPDO::donneInstance()->query(<<<SQL
			INSERT INTO PAYS (nom_pays)
       		VALUES('{$nom}')
SQL
);
var_dump($stmt->fetch());

	}

	public function rechercher($nom)
	{
		$stmt = myPDO::donneInstance()->query(<<<SQL
			select * from PAYS
       		WHERE nom_pays='{$nom}' 
SQL
);
		var_dump($stmt->fetch());
		if($stmt->fetch())
		{
			return $stmt->fetch();
		}
		else 
			return NULL;

	}

	private function supprimer($nom)
	{
		$stmt = myPDO::donneInstance()->query(<<<SQL
			DELETE FROM PAYS 
			WHERE nom_pays='{$nom}' 
SQL
);
	}


}
