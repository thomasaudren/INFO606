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
if(isset($res[0]['error']))
{
	$ret.="Aucun exercice disponible pour cet élève";
	$i=1;
}
else
{
	$ret.='<table class="table table-bordered"><thead><tr><th>Nom de l\'exercice<th>Matière<th>Score</tr>';
	while ($i < sizeof($res))
	{
		//La graine se récupère aussi via $res[$i]['graine'];
		if($res[$i]['percent']>50)
		{
			$ret.="<tr class='success'><td>".$res[$i]['libExo']."<td>".$res[$i]['libMat']."<td>".$res[$i]['percent'];
		}
		else if($res[$i]['percent']<50)
		{
			$ret.="<tr class='danger'><td>".$res[$i]['libExo']."<td>".$res[$i]['libMat']."<td>".$res[$i]['percent'];
		}
		else if($res[$i]['percent']==50)
		{
			$ret.="<tr class='warning'><td>".$res[$i]['libExo']."<td>".$res[$i]['libMat']."<td>".$res[$i]['percent'];	
		}
		$i++;
	}
	$ret.='</table><br><hr>';
}












echo $ret;
?>