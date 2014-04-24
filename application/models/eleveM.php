<?php

include "connexion.php";

class eleveM
{
	
	public function __construct()
	{
	}

	public function recupElevesByProf($id)
	{
		$ret; $i=0;
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
		SELECT DISTINCT * 
		FROM personne p, apartenir_per_cla a
		WHERE p.ID_PERSONNE = a.ID_PERSONNE
		AND a.ID_CLASSE = (SELECT ID_CLASSE
                  FROM apartenir_per_cla 
                  WHERE ID_PERSONNE = (SELECT ID_PERSONNE 
                                       FROM personne 
                                       WHERE ID_PERSONNE = '{$id}'))
		AND p.ID_PERSONNE != '{$id}' 
SQL
);
		$stmt->execute();

		while ($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
	          $ret[$i]['nomEleve']=$res['NOM_PERSONNE'];
	          $ret[$i]['prenomEleve']=$res['PRENOM_PERSONNE'];
	          $ret[$i]['loginEleve']=$res['LOGIN'];
	          $ret[$i]['birthdayEleve']=$res['DATE_NAISSANCE'];
	          $ret[$i]['idClasseEleve']=$res['ID_CLASSE'];

	          $i++;
		}

		return $ret;
	}

	public function getClasseById($id)
	{
		$ret;
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT c.id_classe, lib_classe 
			FROM classe c, apartenir_per_cla apc, personne p
			WHERE c.id_classe = apc.id_classe AND p.id_personne = apc.id_personne
			AND p.id_personne = '{$id}'
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