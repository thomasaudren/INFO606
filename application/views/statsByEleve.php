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


$ret.='<div id="chartsMaths" style="width:50%; height:400px;display: inline-block;"></div><div id="chartsFrancais" style="width:50%; height:400px;display: inline-block;"></div>';

$stats = $eleveC->getMoyenneMathsById($idEleve);
$moyenne = 0;
$i=0;
while($i<sizeof($stats))
{
	$moyenne=$moyenne+$stats[$i]['percent'];
	$i++;
}
$moyenne = $moyenne/sizeof($stats);

$ret.="<script>$(function () { 
    $('#chartsMaths').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Mathématiques'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor)
                    }
                }
            }
        },
       	series: [{
            type: 'pie',
            name: 'Mathématiques',
            data: [
                ['% de réussite ',  $moyenne],
                ['% d\'échec ', 100-$moyenne]
            ]
        }]
    });
});
</script>";

$stats = $eleveC->getMoyenneFraById($idEleve);
$moyenne = 0;
$i=0;
while($i<sizeof($stats))
{
	$moyenne=$moyenne+$stats[$i]['percent'];
	$i++;
}
$moyenne = $moyenne/sizeof($stats);

$ret.="<script>$(function () { 
    $('#chartsFrancais').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            text: 'Français'
        },
        tooltip: {
    	    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor)
                    }
                }
            }
        },
       	series: [{
            type: 'pie',
            name: 'Mathématiques',
            data: [
                ['% de réussite ',  $moyenne],
                ['% d\'échec ', 100-$moyenne]
                /*{
                    name: '',
                    y: 10,
                    sliced: true,
                    selected: true
                }*/
            ]
        }]
    });
});
</script>";

}

echo $ret;
?>