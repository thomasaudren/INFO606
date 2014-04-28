<?php 

include '/application/controllers/eleveC.php';
include '/application/controllers/classeC.php';
include '/application/controllers/professeurC.php';
$eleveC = new eleveC(); 
$classeC = new classeC(); 
$professeurC = new professeurC();
$data['title'] = 'Statistiques';
$this->load->view('template/header', $data); ?>

<div id="head">
<h1 class="page-header" style='text-align:center'>Vos élèves</h1>
<a style='margin-left:2%;margin-top:-4%' type='button' class='btn btn-danger' href="/INFO606/welcome/redirect">Retour</a>
<div class="ui-group" style='text-align:center'>
        <div id="filters" class="filters button-group js-radio-button-group">
<?php 
	
	$classes = $professeurC->getClassesById($_SESSION['id']);
	
	$i=0;
	$menu="<button class='btn is-checked' data-filter='*'>Tous</button>\t";
	while($i < sizeof($classes))
	{
		$menu.="<button class='btn' data-filter='.".$classes[$i]['lib']."'>".$classes[$i]['lib']."</button>\t";
		$i++;
	}

	echo $menu;
?>
        </div>
</div>
<hr>
</div>
<div id="head_custom"></div>
	<div id="container">

<?php

$dirname = 'c:/wamp/www/INFO606/application/assets/eleves/';
$dir = opendir($dirname);
$trimmed = substr($dirname, 20);
$res="<table border='0' cellpading='0'><tr>";
$eleves = $eleveC->recupElevesByProf($_SESSION['id']);

$i=0;

while ($i < sizeof($eleves)) 
{
	$classe = $classeC->getClasseById($eleves[$i]['idClasseEleve']);
	$res.="<td><img class='img-circle item ".$classe['lib']."' style='height:100px;width:100px;float:left;' name='".$eleves[$i]['loginEleve']."' src='".base_url()."application/assets/eleves/".$eleves[$i]['loginEleve'].".png'>";
	
	$i++;
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