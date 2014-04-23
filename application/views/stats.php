<?php $this->load->view('template/header'); ?>

<h1 class="page-header">Vos élèves</h1>
<div class="ui-group">
        <div id="filters" class="filters button-group js-radio-button-group">
          <button class="btn is-checked" data-filter="*">show all</button>
          <button class="btn" data-filter=".metal">metal</button>
          <button class="btn" data-filter=".transition">transition</button>
          <button class="btn" data-filter="ium">–ium</button>
        </div>
</div>
<hr>
	<div id="container">

<?php

$dirname = 'c:/wamp/www/INFO606/application/assets/eleves/';
$dir = opendir($dirname); 
$trimmed = substr($dirname, 20);
$res="<table border='0' cellpading='0'><tr>";
while($file = readdir($dir)) {
	if($file != '.' && $file != '..' && !is_dir($dirname.$file))
	{
		$res.='<td><img class="item transition" style="height:100px;width:100px;float:left;" src="../'.$trimmed.$file.'">';
	}
}
$res.='</table>';
closedir($dir);
	echo $res;

?>
	</div>

<link href="../application/assets/css/sb-admin.css" rel="stylesheet"></link>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="../application/assets/js/isotope.pkgd.min.js"></script>

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


	$('img').click(function(){
			$.ajax({
	  url: "statsBy",
	  data: { name: "WAYNE001" },
		}).done(function(html) {
			$('#container').empty();
		  	$('#container').append(html);
		});
	});
</script>

<?php

$this->load->view("template/footer");


/*SELECT * FROM PERSONNE WHERE id_profil = '2'*/

//Recup de l'id personne 

//SELECT * FROM EXERCER WHERE id_personne = id_personne 

//Recup de l'id exercice
// de la graine
//du score

?>