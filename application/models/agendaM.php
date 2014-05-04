<?php


<?php

include "connexion.php";

class niveauM
{
	
	public function __construct()
	{
	}

	public function getAgendaByIdClasse($id)
	{
		$ret;
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT * 
			FROM AGENDA a, CLASSE c
			WHERE c.id_agenda = a.id_agenda
			AND id_classe = '{$id}'
SQL
);
		$stmt->execute();
		while($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$ret['id'] = $res['ID_AGENDA'];
		}

		return $ret;
	}

	public function getPagesByIdAgenda($id)
	{
		$ret; $i=0;
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT * 
			FROM PAGE 			
			WHERE id_agenda = '{$id}'
SQL
);
		$stmt->execute();

		while($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			$ret[$i]['date'] = $res['DATE_PAGE'];
			$ret[$i]['content'] = $res['CONTENT_PAGE'];
			$i++;
		}
		if($i==0)
		{
			$ret[$i]['error']="Il n'y a aucune page dans cet agenda";
		}

		return $ret;

	}

}