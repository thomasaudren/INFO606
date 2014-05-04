<?php

include "../../connexion.php";

class paysM
{
	public function __construct()
	{
	}

	public function addPays($nom)
	{
		$stmt = myPDO::donneInstance()->query(<<<SQL
			INSERT INTO PAYS (nom_pays)
       		VALUES('{$nom}')
SQL
);

	}

	public function rechercher($nom)
	{
		$stmt = myPDO::donneInstance()->query(<<<SQL
			select * from PAYS
       		WHERE nom_pays='{$nom}' 
SQL
);
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
