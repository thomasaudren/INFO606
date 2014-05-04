<?php

include "connexion.php";

class personneM
{
	public function __construct()
	{
	}

	public function connexion($log, $pass)
	{
		$stmt = myPDO::donneInstance()->query(<<<SQL
			SELECT login, password 
			FROM PERSONNE
			WHERE login='{$log}' AND password='{$pass}'
SQL
);
		if($stmt->fetch())
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function getProfilByIdPersonne($id)
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

	public function getPersonneByLogin($log)
	{
		$ret;
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT nom_personne, prenom_personne, p.id_personne FROM PERSONNE p WHERE login = '{$log}'
SQL
);
		/*$stmt = $dbh->prepare("SELECT nom_personne, prenom_personne FROM PERSONNE WHERE login = '{$log}'");*/
		$stmt->execute();
		while ($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
	          $ret['nom']=$res['nom_personne'];
	          $ret['prenom']=$res['prenom_personne'];
			  $ret['profil']=$this->getProfilByIdPersonne($res['id_personne']);
			  $ret['id']=$res['id_personne'];
		}

	    return $ret;
	}

	public function getEtablissementByIdPersonne($id)
	{
		$ret; $i=0;
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT et.id_etablissement, lib_etablissement FROM PERSONNE p, APPARTENIR_PER_ETA e, ETABLISSEMENT et WHERE p.id_personne = e.id_personne 
																							AND e.id_etablissement = et.id_etablissement 
																							AND p.id_personne = '{$id}'
SQL
);
		$stmt->execute();
		while ($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			  $ret[$i]['id']=$res['id_etablissement'];
			  $ret[$i]['lib']=$res['lib_etablissement'];
			  $i++;
		}

	    return $ret;
	}


	public function personneToEtablissementByIdPersonneAndIdEtablissement($idPer, $idEta)
	{
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			INSERT INTO APPARTENIR_PER_ETA
       		VALUES('{$idPer}','{$idEta}')
SQL
);
		$stmt->execute();
	}

	public function personneToClasseByIdPersonneAndIdClasse($idPer, $idCla)
	{
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			INSERT INTO APPARTENIR_PER_CLA
       		VALUES('{$idPer}','{$idCla}')
SQL
);
		$stmt->execute();
	}

	public function generateLoginByNomPersonne($nom)
	{
		$nom = strtoupper($nom);

		if(strlen($nom)>5)
		{
			$nom=substr($nom,0,5); 
		}
		
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT login FROM PERSONNE
SQL
);
		$stmt->execute();

		$i=0;
		while($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$login = substr($res['login'], 0, 5);
			if($login==$nom)
			{
				$i++;
			}
		}
		if($i>0)
		{
			$i=$i+1;
			if(strlen($i)==1)
			{
				$login = $nom.'00'.$i;
			}
			else if(strlen($i)==2)
			{
				$login = $nom.'0'.$i;
			}
			else
			{
				$login = $nom.$i;
			}
		}
		else
		{
			$login = $nom.'001';
		}

		$login = strtoupper($login);
		
		return $login;
	}

	public function addPersonne($nom, $prenom, $date, $login, $profil)
	{
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			INSERT INTO PERSONNE
       		VALUES('', '{$profil}','{$nom}','{$prenom}','{$date}', '', '{$login}')
SQL
);
		$stmt->execute();
	}

}