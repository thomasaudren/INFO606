<?php

include "connexion.php";

class classeM
{
	
	public function __construct()
	{
	}

	public function getClasseById($id)
	{
		$ret;
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT * 
			FROM classe 
			WHERE id_classe = '{$id}'
SQL
);
		$stmt->execute();

		while($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$ret['id'] = $res['ID_CLASSE'];
			$ret['lib'] = $res['LIB_CLASSE'];
		}

		return $ret;
	}

}