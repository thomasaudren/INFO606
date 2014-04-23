<?php

include "connexion.php";


$personne = new personneC();
$ok = $personne->getPersonneByLogin("WAYNE001");

$ok['id'];

$ret="";
		$stmt = myPDO::donneInstance()->prepare(<<<SQL
			SELECT * FROM EXERCER ex, EXERCICE exercice, MATIERE ma WHERE ex.id_personne = {$ok['id']} 
			AND ex.id_exercice = exercice.id_exercice AND exercice.id_matiere = ma.id_matiere 
SQL
);
		$stmt->execute();
		while ($res = $stmt->fetch(PDO::FETCH_ASSOC))
		{
	          $ret.="<div>Exercice : ".$res['LIB_EXERCICE']."<br>Matière : ".$res['LIB_MATIERE']."<br>Score : ".$res['PERCENT']."<br><hr>";
		}

		echo $ret;
?>