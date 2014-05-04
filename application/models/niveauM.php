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
		if($i==0)
		{
			$ret[$i]['error'] = "Aucun niveau";
		}

		return $ret;
	}

	public function getNiveauByIdNiveau($id)
	{
		$ret;
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT * 
			FROM niveau
			WHERE id_niveau = '{$id}'
SQL
);
		$stmt->execute();
		$nbr=$stmt->rowCount();
		if($nbr==0)
		{
			$ret['error']="Problème de récupération des niveaux";
		}
		else
		{
			while($res = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$ret['lib']=$res['LIB_NIVEAU'];
				$ret['id']=$res['ID_NIVEAU'];
			}
		}

		return $ret;
	}

}