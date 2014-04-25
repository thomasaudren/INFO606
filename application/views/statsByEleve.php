<?php

include "connexion.php";
include "/application/controllers/eleveC.php";
$loginEleve = $_POST['name'];
$personneC = new personneC();
$eleveC = new eleveC();
$eleve = $personneC->getPersonneByLogin($loginEleve);
$idEleve = $eleve['id'];

$res = $eleveC->getExercicesByIdEleve($idEleve);
$ret="";

$i=0;
//La graine se récupère aussi via $res[$i]['graine'];
if(isset($res[0]['error']))
{
	$ret.="Aucun exercice disponible pour cet élève";
	$i=1;
}

while ($i < sizeof($res))
{
	$ret.="<div>Exercice : ".$res[$i]['libExo']."<br>Matière : ".$res[$i]['libMat']."<br>Score : ".$res[$i]['percent']."<br><hr>";
	$i++;
}

	echo $ret;

?>