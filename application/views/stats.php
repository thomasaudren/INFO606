<?php 

$eleveC = new eleveC(); 
$classeC = new classeC(); 
$professeurC = new professeurC();

?>

<div id="head">
<h1 class="page-header" style='text-align:center'>Vos élèves</h1>
<a style='margin-left:2%;margin-top:-4%' type='button' class='btn btn-danger' href="/INFO606/welcome/redirect">Retour</a>
<div class="ui-group" style='text-align:center'>
        <div id="filters" class="filters button-group js-radio-button-group">
<?php
	if($_SESSION['profil']=="Professeur")
	{
		$classes = $professeurC->getClassesById($_SESSION['id']);
		if(isset($classes[0]['error']))
		{
			$menu="<p>Pas de classes disponible</p>";
		}
		else
		{
			$i=0;
			$menu="<button class='btn is-checked' data-filter='*'>Tous</button>\t";
			while($i < sizeof($classes))
			{
				$menu.="<button class='btn' data-filter='.".$classes[$i]['lib']."'>".$classes[$i]['lib']."</button>\t";
				$i++;
			}
		}

		echo $menu;
	}
	else if($_SESSION['profil']=="Directeur")
	{
		$classes = $classeC->getClassesByIdEtablissement($_SESSION['idEta']);

		if(isset($classes[0]['error']))
		{
			$menu="<p>Pas de classes disponible</p>";
		}
		else
		{
			$i=0;
			$menu="<button class='btn is-checked' data-filter='*'>Tous</button>\t";
			while($i < sizeof($classes))
			{
				$menu.="<button class='btn' data-filter='.".$classes[$i]['lib']."'>".$classes[$i]['lib']."</button>\t";
				$i++;
			}
		}

		echo $menu;
	}

?>
        </div>
</div>
<hr>
</div>
<!--<div id="head_custom"></div>-->
	<div id="container">

<?php

$dirname = 'c:/wamp/www/INFO606/application/assets/eleves/';
$dir = opendir($dirname);
$trimmed = substr($dirname, 20);
$res="<table border='0' cellpading='0'><tr>";
if($_SESSION['profil']=="Professeur")
{
	$eleves = $eleveC->getElevesByIdProf($_SESSION['id']);	
}
else if($_SESSION['profil']=='Directeur')
{
	$eleves = $eleveC->getElevesByEtablissement($_SESSION['idEta']);
}

$i=0;
if(isset($eleves[0]['error']))
{
	$res.="<p>Aucun élève disponible</p>";
	$i=1;
}
else
{
	while ($i < sizeof($eleves)) 
	{
		$classe = $classeC->getClasseById($eleves[$i]['idClasseEleve']);
		if(file_exists("application/assets/eleves/".$eleves[$i]['loginEleve'].".png"))
		{
			$res.="<td><img class='img-circle item ".$classe['lib']."' style='margin-top:1.2%;height:100px;width:100px;float:left;' name='"
				.$eleves[$i]['loginEleve']."' src='".base_url()."application/assets/eleves/".$eleves[$i]['loginEleve'].".png'>";
		}
		else
		{
			$res.="<td><img class='img-circle item ".$classe['lib']."' style='margin-top:1.2%;height:100px;width:100px;float:left;' name='"
				.$eleves[$i]['loginEleve']."' src='".base_url()."application/assets/eleves/Unknown.png'>";
		}
		
		$i++;
	}
}

$res.='</table>';
closedir($dir);
	echo $res;

?>
	</div>
<div id="container_custom"></div>

<link href="../application/assets/css/sb-admin.css" rel="stylesheet"></link>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript" src="../application/assets/js/isotope.pkgd.min.js"></script>
<script type="text/javascript" src="../application/assets/js/script.js"></script>
<script type="text/javascript">
var $container = $('#container');
// init
$container.isotope({
  // options
  itemSelector: '.item',
  layoutMode: 'fitRows'
});
</script>

<script type="text/javascript">
	// init Isotope
	var $container = $('#container').isotope({
	  // options
	});
	// filter items on button click
	$('#filters').on( 'click', 'button', function() {
	  var filterValue = $(this).attr('data-filter');
	  $container.isotope({ filter: filterValue });
	});
</script>

<?php

$this->load->view("template/footer");

?>