<?php

include "connexion.php";

class niveauM
{
	
	public function __construct()
	{
	}

	public function getNiveaux()
	{
		$ret; $i=0;
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT * 
			FROM niveau
SQL
);
		$stmt->execute();

		while($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$ret[$i]['id'] = $res['ID_NIVEAU'];
			$ret[$i]['lib'] = $res['LIB_NIVEAU'];
			$i++;
		}

		return $ret;
	}

}