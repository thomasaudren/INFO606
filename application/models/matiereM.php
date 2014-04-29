<?php

include "connexion.php";

class matiereM
{
	
	public function __construct()
	{
	}

	public function getMatieres()
	{
		$ret; $i=0;
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT * 
			FROM matiere
SQL
);
		$stmt->execute();

		while($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$ret[$i]['id'] = $res['ID_MATIERE'];
			$ret[$i]['lib'] = $res['LIB_MATIERE'];
			$i++;
		}

		return $ret;
	}

}