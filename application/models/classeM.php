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

	public function getClassesByIdEtablissement($id)
	{
		$ret; $i=0;
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT * 
			FROM classe c, etablissement e 
			WHERE c.id_etablissement = e.id_etablissement
			AND e.id_etablissement = '{$id}'
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
			$ret[$i]['error']= "Aucune classe dans l'établissement...";
		}

		return $ret;
	}

	public function addClasse($idEta, $idNiveau, $lib)
	{
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			INSERT INTO AGENDA
			VALUES('')
SQL
);
		$stmt->execute();
		$id = myPDO::donneInstance()->lastInsertId();
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			INSERT INTO CLASSE
       		VALUES('', '{$idEta}','{$idNiveau}','{$id}', '{$lib}')
SQL
);
		$stmt->execute();
	}

	public function generateLibClasseByDefault($level, $idEta)
	{
		$classes = $this->getClassesByIdEtablissement($idEta);

		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT * 
			FROM niveau
			WHERE id_niveau = '{$level}'
SQL
);
		$stmt->execute();
		while($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$level=$res['LIB_NIVEAU'];
		}

		$i=0; $count=0;
		if($level == "CP")
		{
			while($i<sizeof($classes))
			{
				if($level == "CP")
				{
					$lib = substr($res[$i]['lib'], 0, 2);
				}
				else
				{
					$lib = substr($res[$i]['lib'], 0, 3);
				}

				if($level==$lib)
				{
					$count++;
				}
				$i++;
			}
		}

		$i=$i+1;
		$lib = $level.'-'.$i;

		return $lib;
	}

}