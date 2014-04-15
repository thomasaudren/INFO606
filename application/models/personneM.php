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

	public function getProfilById($id)
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
			SELECT nom_personne, prenom_personne, id_personne FROM PERSONNE WHERE login = '{$log}'
SQL
);
		/*$stmt = $dbh->prepare("SELECT nom_personne, prenom_personne FROM PERSONNE WHERE login = '{$log}'");*/
		$stmt->execute();
		while ($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
	          $ret['nom']=$res['nom_personne'];
	          $ret['prenom']=$res['prenom_personne'];
			  $ret['profil']=$this->getProfilById($res['id_personne']);
		}
	    return $ret;
	}



}