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

	public function getExercicesByIdEleve($id)
	{
		$ret; $i=0;
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT * FROM EXERCER ex, EXERCICE exercice, MATIERE ma WHERE ex.id_personne = '{$id}' 
			AND ex.id_exercice = exercice.id_exercice AND exercice.id_matiere = ma.id_matiere 
SQL
);
		$stmt->execute();


		while($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
	          $ret[$i]['libExo'] = $res['LIB_EXERCICE'];
	          $ret[$i]['libMat'] = $res['LIB_MATIERE'];
	          $ret[$i]['percent'] = $res['PERCENT'];
	          $ret[$i]['graine'] = $res['GRAINE'];
	          $i++;
		}
		if($i==0)
		{
			$ret[$i]['error']= "Cet élève n'a fait aucun exercice...";
		}

		return $ret;
	}


	public function getMoyenneMathsById($id)
	{
		$ret; $i=0;
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT PERCENT, LIB_EXERCICE, ex.DATE FROM EXERCER ex, EXERCICE exercice, MATIERE ma WHERE ex.id_personne = '{$id}' 
			AND ex.id_exercice = exercice.id_exercice AND exercice.id_matiere = ma.id_matiere AND ma.lib_matiere='Mathématiques'
SQL
);
		$stmt->execute();

		while($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
	          $ret[$i]['percent'] = $res['PERCENT'];
	          $ret[$i]['lib'] = $res['LIB_EXERCICE'];
	          $ret[$i]['date'] = $res['DATE'];
	          $i++;
		}

		return $ret;
	}

	public function getMoyenneFraById($id)
	{
		$ret; $i=0;
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT PERCENT, LIB_EXERCICE, ex.DATE FROM EXERCER ex, EXERCICE exercice, MATIERE ma WHERE ex.id_personne = '{$id}' 
			AND ex.id_exercice = exercice.id_exercice AND exercice.id_matiere = ma.id_matiere AND ma.lib_matiere='Français'
SQL
);
		$stmt->execute();

		while($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
	          $ret[$i]['percent'] = $res['PERCENT'];
	          $ret[$i]['lib'] = $res['LIB_EXERCICE'];
	          $ret[$i]['date'] = $res['DATE'];
	          $i++;
		}

		return $ret;
	}
}