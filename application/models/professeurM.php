<?php

include "connexion.php";

class professeurM
{
	
	public function __construct()
	{
	}

	public function getClassesById($id)
	{
		$ret;
		$i=0;
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT * 
			FROM classe c, APPARTENIR_PER_CLA apc 
			WHERE c.id_classe = apc.id_classe
			AND apc.id_personne = '{$id}' 
SQL
);
		$stmt->execute();

		while($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$ret[$i]['id'] = $res['ID_CLASSE'];
			$ret[$i]['lib'] = $res['LIB_CLASSE'];
			$i++;
		}
		if($i==0)
		{
			$ret[$i]['error']="Pas de classes";
		}

		return $ret;
	}

}