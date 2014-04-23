<?php

include "connexion.php";

class eleveM
{
	
	public function __construct()
	{
	}

	public function recupElevesByProf($id)
	{
		$ret="";
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT lib_profil FROM PROFIL pr, PERSONNE pe WHERE pe.id_personne = '{$id}' AND pe.id_profil = pr.id_profil  
SQL
);
		$stmt->execute();
		while ($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
	          $ret.=$res['lib_profil'];
		}
		return $ret;

	}

}