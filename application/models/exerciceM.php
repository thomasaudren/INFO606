<?php


include "connexion.php";

class exerciceM
{

	public function __construct()
	{
	}

	public function ajoutExercice($nom, $idDev, $idNiv, $idMat)
	{
		$stmt = myPDO::donneInstance()->query(<<<SQL
			INSERT INTO EXERCICE (ID_MATIERE, ID_NIVEAU, ID_PERSONNE, LIB_EXERCICE)
       		VALUES('{$idMat}','{$idNiv}', '{$idDev}', '{$nom}')
SQL
);
	}
}